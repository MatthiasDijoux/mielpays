<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProducersSeeder extends Seeder
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
                "name" => "miel974",
                "id_user" => 1,
                "adresse" => '',
                "lat" => '-21.1365964',
                "lng" => '55.4543792'

            ],
            [
                "id" => 2,
                "name" => "mieléo",
                "id_user" => 2,
                "adresse" => '',
                "lat" => '-21.1638525',
                "lng" => '55.3106975'
            ],
            [
                "id" => 3,
                "name" => "Mielébas",
                "id_user" => 3,
                "adresse" => '',
                "lat" => '-21.168151',
                "lng" => '55.2924158'
            ],
        ];

        DB::table('producer')->insert(
            $array
        );
    }
}
