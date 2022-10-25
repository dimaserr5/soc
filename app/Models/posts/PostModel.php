<?php

namespace App\Models\posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostModel extends Model
{
    public static function add_post($name,$patch,$ip) {
        DB::table('posts')->insert([
            'name' => $name,
            'patch' => $patch,
            'id_user' => auth::id(),
            'ip_user' => $ip,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
