<?php

namespace Tests\Feature;

use App\Models\MenuCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_basic_test()
    {
        MenuCategory::create(['name' => 'Vorspeisen', 'order' => 1, 'status' => 1]);
        View::share('menuCategories', MenuCategory::all());

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Vorspeisen');
    }

    public function test_login_page_renders()
    {
        $this->get('/login')->assertStatus(200);
    }

    public function test_guest_is_redirected_to_login()
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_logged_in_user_is_redirected_away_from_login()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/login')->assertRedirect('/home');
    }
}
