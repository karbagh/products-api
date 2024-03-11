<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Device;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'first_name' => 'Shinmag',
            'last_name' => 'Admin',
            'email' => 'info@shinmag.am',
            'role_id' => Role::query()->where('slug', Str::slug('Administrator'))->first(),
        ]);
    }
}
