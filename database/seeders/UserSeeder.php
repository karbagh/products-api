<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(1)->create([
            'first_name' => 'Products',
            'last_name' => 'Admin',
            'email' => 'info@products.test',
        ]);
    }
}
