<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
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
                "name" => "Admin",

            ],
            [
                "id" => 2,
                "name" => "Client",
            ],
            [
                "id" => 3,
                "name" => "Producteur",
            ],
        ];

        DB::table('role')->insert(
            $array
        );
    }
}
