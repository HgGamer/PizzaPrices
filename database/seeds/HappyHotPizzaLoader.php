<?php

use Illuminate\Database\Seeder;

class HappyHotPizzaLoader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/HappyHotData.sql');

        DB::statement($sql);
    }
}
