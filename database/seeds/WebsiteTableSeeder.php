<?php

use Illuminate\Database\Seeder;

use App\Website;

 use Carbon\Carbon;

class WebsiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	 $sql = file_get_contents(database_path() . '\seeds\WebsiteData.sql');
    
         DB::statement($sql);
    
    }
}