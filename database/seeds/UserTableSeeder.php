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

	    $create_admin = new User();
	    $create_admin->name = 'Admin';
	    $create_admin->email = 'admin@example.com';
	    $create_admin->password = bcrypt('123456');
	    $create_admin->save();
	    $create_admin->roles()->attach($role_admin);

	    $create_user = new User();
	    $create_user->name = 'User';
	    $create_user->email = 'user@example.com';
	    $create_user->password = bcrypt('123456');
	    $create_user->save();
	    $create_user->roles()->attach($role_user);
    }
}
