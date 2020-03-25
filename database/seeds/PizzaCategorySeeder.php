<?php

use Illuminate\Database\Seeder;

class PizzaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/pizza_category.sql');

        DB::statement($sql);
    }
}
