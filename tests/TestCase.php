<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMix();

        // AppServiceProvider skips view sharing on the CLI, which includes the test runner.
        View::share('adminMenus', json_decode(File::get(resource_path('menus.json')), false));
    }
}
