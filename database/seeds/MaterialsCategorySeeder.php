<?php

use Illuminate\Database\Seeder;

class MaterialsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pizza_materials_category')->delete();

        \DB::table('pizza_materials_category')->insert([

            0 => [
                'id'         => 1,
                'name'       => 'Pizza Alapok',
            ],
            1 => [
                'id'         => 3,
                'name'       => 'Húsfeltétek',
            ],
            2 => [
                'id'         => 5,
                'name'       => 'Zöldség Feltétek',
            ],
            3 => [
                'id'         => 2,
                'name'       => 'Sajtok',
            ],
            4 => [
                'id'         => 4,
                'name'       => 'Halak',
            ],
            5 => [
                'id'         => 6,
                'name'       => 'Szószok',
            ],
            6 => [
                'id'         => 7,
                'name'       => 'Egyéb',
            ],

        ]);
    }
}
