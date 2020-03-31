<?php

use Illuminate\Database\Seeder;

class PizzaFaloPizzaLoader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/PizzaFaloData.sql');

        DB::statement($sql);
    }
}
