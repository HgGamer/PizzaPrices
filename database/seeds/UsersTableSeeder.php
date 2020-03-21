<?php

use Illuminate\Database\Seeder;

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
            'id' => 1,
            'name' => 'Chudi Richárd',
            'email' => '@gmail.com',
            'type' => 'admin',
            'password' => bcrypt('adminCR'),
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Sipos Dávid',
            'email' => 'sipos22@msn.com',
            'type' => 'admin',
            'password' => bcrypt('asdasd'),
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Korsós Tibor',
            'email' => 'korsos.tibor9b@gmail.com',
            'type' => 'admin',
            'password' => bcrypt('adminKT'),
        ]);
    }
}
