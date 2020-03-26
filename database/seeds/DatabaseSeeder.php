<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(WebsiteTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ItemSchemaTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        $this->call(PizzaTablesSeeder::class);
        $this->call(PizzaCategorySeeder::class);
    }
}
