<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->create(
            [
                'name' => 'Jorex Bacero',
                'email' => 'jdbacero@gmail.com',
                'is_admin' => true
            ]
        );
        User::factory()->create(
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'is_admin' => false
            ]
        );

        Document::factory(3)->create();
    }
}
