<?php

use App\Company;
use Tests\TestCase;

class CompanyCreateTest extends TestCase
{
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
