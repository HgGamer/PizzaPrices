<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$sql = file_get_contents(database_path() . '/seeds/CategoryData.sql');

         DB::statement($sql);

    }
}
