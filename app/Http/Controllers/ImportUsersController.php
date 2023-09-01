<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\User;
use App\Models\UserTest;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ImportUsersController extends Controller
{
    protected $path = 'https://randomuser.me/api/?results=5000';

    public function importUsers(User $user){

        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL,$this->path );
            curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $response = curl_exec($curl);
            $response = json_decode($response);

            $updated = $user->storeUsers($response->results);
            $all_users = User::count();

            return response()->json([
                'all_users' =>$all_users,
                'created_users' =>count($response->results)-$updated,
                'updated_users' =>$updated,
                'status' => true,
            ]);

        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

}
