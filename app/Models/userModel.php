<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class userModel extends Model
{
    public static function getUser($id){
        $user = DB::table('users')->where('id', $id)->first();
        return $user;
    }

}
