<?php

namespace App\Http\Controllers\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\posts\PostModel;

class CreatePostController extends Controller
{
    public function get() {
        $data['1'] = 1;
        return View::make('posts.create', $data);
    }

    public function add(Request $request) {

        header('Content-Type: application/json');

        if(!$request->input('name')) {
            $data = '{"status":"error","text":"Ошибка, введите имя поста"}';
        }else {
            $image = $request->input('img');
            if(!$request->file('img')) {
                $data = '{"status":"error","text":"Ошибка, загрузите картинку"}';
            }else {
                if($request->hasFile('img')){

                    foreach ($request->files as $file) {

                        //get file name with extenstion
                        $fileNameWithExt = $file->getClientOriginalName();
                        $validate_file = pathinfo ($fileNameWithExt, PATHINFO_EXTENSION);

                        if($validate_file == "png" OR $validate_file == "jpeg" OR $validate_file == "jpg" OR $validate_file == "gif") {

                            $patch = public_path() . '/posts/'.auth::Id().'_'.rand(1000,999999).'_'.rand(100,999)."/";

                            $name_file = rand(1000,9999).$fileNameWithExt;

                            $ip_user = $request->ip();

                            $file->move($patch,$name_file);

                            PostModel::add_post($request->input('name'),$patch.$name_file,$request->ip());

                            $data = '{"status":"ok","text":"Успешно"}';

                        }else {
                            $data = '{"status":"error","text":"Ошибка, загрузить можно только картинку."}';
                        }

                    }

                }

            }
        }

        return $data;
    }
}
