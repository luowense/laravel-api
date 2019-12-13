<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'collaborator';
        $role_user->save();

        $role_psychologist = new Role();
        $role_psychologist->name = 'psychologist';
        $role_psychologist->save();

        $role_superAdmin = new Role();
        $role_superAdmin->name = 'super admin';
        $role_superAdmin->save();
    }
}
