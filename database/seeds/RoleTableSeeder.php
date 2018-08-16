<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'admin', 'description' => 'this is admin'],
            ['name' => 'user' , 'description' => 'this is user']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
