<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Raul',
            'last_name' => 'Remesal van Merode',
            'email' => 'test@example.com',
            'password' => Hash::make('welkom1'),
        ]);

        Permission::create([
            'name' => 'Add & Edit',
        ]);
        Permission::create([
            'name' => 'View',
        ]);
        Permission::create([
            'name' => 'Delete',
        ]);

        Role::create([
            'name' => 'Admin'
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,

        ]);
    }
}
