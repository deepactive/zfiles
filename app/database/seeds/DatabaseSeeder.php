<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}

}


class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
                'id' => 1,
                'username' => 'firstuser',
                'password' => Hash::make('first_password'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));
        User::create(array(
                'id' => 2,
                'username' => 'seconduser',
                'password' => Hash::make('second_password'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
        ));    
    }
}

