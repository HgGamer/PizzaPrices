<?php

use Illuminate\Database\Seeder;

class WebsiteTableSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = file_get_contents(database_path() . '/seeds/WebsiteData2.sql');

        DB::statement($sql);

    }
}
