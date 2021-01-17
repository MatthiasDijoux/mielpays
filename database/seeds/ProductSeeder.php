<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
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
                "name" => "Miel de sapin",
                "prix" => "11",
                "quantite" => "50",
                "id_producer" => 1,

            ],
            [
                "id" => 2,
                "name" => "Miel de rhododendron",
                "prix" => "21",
                "quantite" => "10",
                "id_producer" => 2,
            ],
            [
                "id" => 3,
                "name" => "Miel de montagne",
                "prix" => "41",
                "quantite" => "20",
                "id_producer" => 3,
            ],
        ];

        DB::table('product')->insert(
            $array
        );
    }
}
