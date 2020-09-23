<?php

namespace Tests\Feature;

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCriaCompany()
    {
        $createCompany = Company::create([
            'name' => 'Roob Tester',
            'email' => 'example@example.com',
            'logo' => 'ssssss',
            'website' => 'www.testekzas.com',
        ]);
    }
}
