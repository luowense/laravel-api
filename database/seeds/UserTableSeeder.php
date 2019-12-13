<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'collaborator')->first();
        $role_psychologist = Role::where('name', 'psychologist')->first();
        $role_superAdmin = Role::where('name', 'super admin')->first();

        $user = new User();
        $user->name = 'user name';
        $user->email = 'user@user.com';
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($role_user);

        $psychologist = new User();
        $psychologist->name = 'psychologist name';
        $psychologist->email = 'psychologist@psychologist.com';
        $psychologist->password = bcrypt('psychologist');
        $psychologist->save();
        $psychologist->roles()->attach($role_psychologist);

        $superAdmin = new User();
        $superAdmin->name = 'super admin name';
        $superAdmin->email = 'admin@admin.com';
        $superAdmin->password = bcrypt('admin');
        $superAdmin->save();
        $superAdmin->roles()->attach($role_superAdmin);
    }
}
