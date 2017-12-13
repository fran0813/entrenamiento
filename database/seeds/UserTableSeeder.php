<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
	    $role_user  = Role::where('name', 'User')->first();

	    $employee = new User();
	    $employee->name = 'Admin';
	    $employee->email = 'admin@example.com';
	    $employee->password = bcrypt('123456');
	    $employee->save();
	    $employee->roles()->attach($role_admin);

	    $manager = new User();
	    $manager->name = 'User';
	    $manager->email = 'user@example.com';
	    $manager->password = bcrypt('123456');
	    $manager->save();
	    $manager->roles()->attach($role_user);
    }
}
