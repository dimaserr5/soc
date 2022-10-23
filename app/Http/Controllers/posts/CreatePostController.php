<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CreatePostController extends Controller
{
    public function get() {
        $data['1'] = 1;
        return View::make('posts.create', $data);
    }
}
