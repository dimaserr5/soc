<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserApiModel extends Model
{
    public static function getMyApis($user_id) {
        $user = DB::table('apis')->where('user_id', $user_id)->get();

        return $user;
    }

    public static function checkName($user_id, $name) {
        $where_type = ['user_id' => $user_id, 'name' => $name];

        $query = DB::table('apis')->where($where_type)->first();

        return $query;
    }

    public static function addApiKey($user_id, $name) {
        DB::table('apis')->insert([
            'user_id' => $user_id,
            'name' => $name,
            'api_key' => $user_id."-".rand(10000,99999999)."-".rand(100,999999)
        ]);
    }

}
