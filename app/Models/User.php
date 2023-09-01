<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'age',
    ];


    public function storeUsers($response){
        $updated = 0;
        $chunks = array_chunk($response, 100);

        foreach ($chunks as $users){
            foreach ($users as $res){
                $updated = \DB::transaction(function() use ($res, $updated) {
                      $user = User::updateOrCreate(
                        ['first_name'=>$res->name->first,'last_name'=>$res->name->last],
                        ['email'=>$res->email,'age'=>$res->dob->age]
                    );
                     if(!$user->wasRecentlyCreated){
                         $updated++;
                     }
                     return $updated;
                });
            }
        }

        return $updated;
    }
}
