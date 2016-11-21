<?php

use Illuminate\Database\Seeder;

class DefaultAdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'name' => 'administrator',
        'email' => 'administrator@email.com',
        'password' => bcrypt('administrator'),
    ]);
    }
}
