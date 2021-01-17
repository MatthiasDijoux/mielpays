<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
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
                "name" => "admin",
                "email" => "matthias.dijoux11@gmail.com",
                "password" => bcrypt('admin'),
                "id_role" => "1",
            ],
            [
                "id" => 2,
                "name" => "mieléo",
                "email" => "leo@gmail.com",
                "password" => bcrypt('user'),
                "id_role" => 3,
            ],
            [
                "id" => 3,
                "name" => "Mielébas",
                "email" => "lebas@gmail.com",
                "password" => bcrypt('user'),
                "id_role" => 2,
            ],

        ];

        DB::table('users')->insert(
            $array
        );
    }
}
