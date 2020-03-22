<?php

use Illuminate\Database\Seeder;

use App\Website;

 use Carbon\Carbon;

class PizzaTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pizza_materialalias = file_get_contents(database_path() . '/seeds/pizza_materialalias.sql');
        $pizza_materials     = file_get_contents(database_path() . '/seeds/pizza_materials.sql');
        $pizza_pizzaalias    = file_get_contents(database_path() . '/seeds/pizza_pizzaalias.sql');
        $pizza_pizzas        = file_get_contents(database_path() . '/seeds/pizza_pizzas.sql');

        DB::statement($pizza_materialalias);
        DB::statement($pizza_materials);
        DB::statement($pizza_pizzaalias);
        DB::statement($pizza_pizzas);

    }
}
