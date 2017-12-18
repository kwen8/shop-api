<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
			'name' => 'admin',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()
		]);
		DB::table('users')->insert([
			'name' => 'admin1',
			'email' => 'admin1@admin1.com',
			'password' => bcrypt('admin'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()
		]);
		$user = User::find(1);
		$user->assignRole('superAdmin');
		$admin = User::find(2);
		$admin->assignRole('admin');
	}
}
