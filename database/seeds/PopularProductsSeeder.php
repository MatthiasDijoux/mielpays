<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopularProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                "id" => 1,
                "id_product" => 1,
                "quantite_acheté" => 15
            ],
            [
                "id" => 2,
                "id_product" => 2,
                "quantite_acheté" => 30
            ],
        ];

        DB::table('popularProducts')->insert(
            $array
        );
    }
}
