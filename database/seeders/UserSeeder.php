<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserTest;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public $path = 'https://randomuser.me/api/?results=5000';
    public function run(): void
    {

        $time_start = microtime(true);

        $time_start = microtime(true);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$this->path );
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);

        $response = curl_exec($curl);
        $response = json_decode($response);

//dd($response);

        $users_data = [];
        foreach ($response->results as $res){
            $users_data[] = [
                'first_name'=> $res->name->first,
                'last_name' => $res->name->last,
                'email' => $res->email,
                'age' => $res->dob->age,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }


        $chunks = array_chunk($users_data, 1000);
        foreach ($chunks as $user){
            UserTest::insert($user);
        }

        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);
        dd(number_format((float) $execution_time, 10) );



    }
}
