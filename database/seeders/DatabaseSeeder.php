<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissionTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the PermissionTableSeeder to create all the permissions
        $this->call(PermissionTableSeeder::class);

        // Create the Admin user
        $user = User::create([
            'name' => 'shafa khan', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // Create the Admin role
        $role = Role::create(['name' => 'Admin']);
        
        // Retrieve all permissions
        $permissions = Permission::pluck('id','id')->all();
       
        // Sync all permissions with the Admin role
        $role->syncPermissions($permissions);

        // Assign the Admin role to the user
        $user->assignRole('Admin');
    }
}
