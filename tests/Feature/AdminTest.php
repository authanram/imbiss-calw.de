<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // layouts/backend reads these superglobals directly, test requests don't populate them.
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['REQUEST_URI'] = '/';

        Role::create(['name' => 'admin', 'label' => 'Admin']);
        Role::create(['name' => 'editor', 'label' => 'Editor']);

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
        $this->admin->assignRole('editor');
    }

    public function test_user_without_role_cannot_access_admin_routes()
    {
        $this->actingAs(User::factory()->create())
            ->get('/admin/users')
            ->assertNotFound();
    }

    public function test_editor_cannot_access_admin_only_routes()
    {
        $editor = User::factory()->create();
        $editor->assignRole('editor');

        $this->actingAs($editor)->get('/admin')->assertOk();
        $this->actingAs($editor)->get('/admin/users')->assertNotFound();
    }

    public function test_admin_pages_render()
    {
        $permission = Permission::create(['name' => 'edit-menus', 'label' => 'Edit menus']);
        $role = Role::whereName('admin')->first();
        $role->givePermissionTo($permission);
        $category = MenuCategory::create(['name' => 'Suppen', 'order' => 1, 'status' => 1]);
        Menu::create(['menu_category_id' => $category->id, 'number' => 1, 'name' => 'Pho', 'price' => 9.5, 'status' => 1]);

        $this->actingAs($this->admin);

        foreach ([
            '/admin', '/admin/roles', '/admin/roles/create', "/admin/roles/{$role->id}", "/admin/roles/{$role->id}/edit",
            '/admin/permissions', '/admin/permissions/create', "/admin/permissions/{$permission->id}", "/admin/permissions/{$permission->id}/edit",
            '/admin/users', '/admin/users/create', "/admin/users/{$this->admin->id}", "/admin/users/{$this->admin->id}/edit",
            '/menu-categories', '/menus', '/menus/create',
        ] as $url) {
            $this->get($url)->assertOk();
        }

        $this->get("/admin/roles/{$role->id}/edit")
            ->assertSee('<option value="edit-menus" selected>Edit menus</option>', false)
            ->assertSee('<input type="hidden" name="_method" value="PATCH">', false);

        $this->get("/admin/users/{$this->admin->id}/edit")
            ->assertSee('<option value="admin" selected>Admin</option>', false)
            ->assertSee('value="'.$this->admin->email.'"', false);
    }

    public function test_index_paginates_with_bootstrap_markup()
    {
        Permission::insert(collect(range(1, 16))->map(fn ($i) => ['name' => "permission-{$i}"])->all());

        $this->actingAs($this->admin)
            ->get('/admin/permissions')
            ->assertSee('page-item', false);
    }

    public function test_admin_can_manage_permissions_and_roles()
    {
        $this->actingAs($this->admin);

        $this->post('/admin/permissions', ['name' => 'publish', 'label' => 'Publish'])
            ->assertRedirect('/admin/permissions');
        $permission = Permission::whereName('publish')->firstOrFail();

        $this->patch("/admin/permissions/{$permission->id}", ['name' => 'publish', 'label' => 'Publish menus'])
            ->assertRedirect('/admin/permissions');
        $this->assertSame('Publish menus', $permission->fresh()->label);

        $this->post('/admin/roles', ['name' => 'publisher', 'permissions' => ['publish']])
            ->assertRedirect('/admin/roles');
        $role = Role::whereName('publisher')->firstOrFail();
        $this->assertTrue($role->permissions->contains($permission));

        $this->delete("/admin/roles/{$role->id}")->assertRedirect('/admin/roles');
        $this->assertNull($role->fresh());
    }

    public function test_admin_can_create_and_update_users()
    {
        $this->actingAs($this->admin);

        $this->post('/admin/users', ['name' => 'Kim', 'email' => 'kim@example.com', 'password' => 'secret', 'roles' => ['editor']])
            ->assertRedirect('/admin/users');
        $user = User::whereEmail('kim@example.com')->firstOrFail();
        $this->assertTrue(Hash::check('secret', $user->password));
        $this->assertTrue($user->hasRole('editor'));

        $this->patch("/admin/users/{$user->id}", ['name' => 'Kim', 'email' => 'kim@example.com', 'password' => 'changed', 'roles' => ['admin']])
            ->assertRedirect('/admin/users');
        $user->refresh();
        $this->assertTrue(Hash::check('changed', $user->password));
        $this->assertTrue($user->hasRole('admin'));
        $this->assertFalse($user->hasRole('editor'));

        $this->delete("/admin/users/{$user->id}")->assertRedirect('/admin/users');
        $this->assertNull($user->fresh());
    }

    public function test_validation_errors_keep_old_input()
    {
        $this->actingAs($this->admin)
            ->from('/admin/users/create')
            ->post('/admin/users', ['name' => 'Kim'])
            ->assertRedirect('/admin/users/create')
            ->assertSessionHasErrors(['email', 'password', 'roles']);

        $this->get('/admin/users/create')->assertSee('value="Kim"', false);
    }

    public function test_permissions_are_registered_as_gates()
    {
        $permission = Permission::create(['name' => 'edit-menus']);
        Role::whereName('editor')->first()->givePermissionTo($permission);

        $this->app->getProvider(AppServiceProvider::class)->boot();

        $editor = User::whereKey($this->admin->id)->firstOrFail();
        $this->assertTrue(Gate::forUser($editor)->allows('edit-menus'));
        $this->assertFalse(Gate::forUser(User::factory()->create())->allows('edit-menus'));
    }
}
