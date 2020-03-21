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
            'name' => 'Chudi Richárd',
            'email' => '@gmail.com',
            'type' => 'admin',
            'password' => bcrypt('adminCR'),
        ]);
        DB::table('users')->insert([
            'name' => 'Sipos Dávid',
            'email' => 'sipos22@msn.com',
            'type' => 'admin',
            'password' => bcrypt('adminSD'),
        ]);
        DB::table('users')->insert([
            'name' => 'Korsós Tibor',
            'email' => 'korsos.tibor9b@gmail.com',
            'type' => 'admin',
            'password' => bcrypt('adminKT'),
        ]);
    }
}
