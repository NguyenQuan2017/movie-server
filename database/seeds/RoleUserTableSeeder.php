<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = Role::all();
        $array_roles_id = Role::all()->pluck('id')->toArray();
        $first_id_role = array_first($array_roles_id);
        $last_id_role = array_last($array_roles_id);
        User::all()->each(function ($user) use ($roles,$first_id_role, $last_id_role) {
            $user->roles()->attach(
                $roles->random(rand( $first_id_role, $last_id_role))->pluck('id')->toArray()
            );
        });
    }
}
