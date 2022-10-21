<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\userModel;

class MyProfileController extends Controller
{
    public function get() {

        $user = userModel::getUser(auth::id());

        $data['usermail'] = $user->email;

        $data['name'] = $user->name;

        switch($user->access_status) {
            case 0 :
                $data['user_status'] = "Пользователь";
                break;
            case 1 :
                $data['user_status'] = "Админ";
                break;

            default:
                $data['user_status'] = "Error";
                break;

        }

        $data['api_key'] = $user->api_key;


        return View::make('user.myprofile', $data);
    }

    public function generate_api() {

        $user = userModel::getUser(auth::id());

        if(!$user->api_key) {
            $token_set = auth::id()."-".rand(100,9999999);

            userModel::addTokeUser(auth::id(),$token_set);

        }

        return redirect()->route('myprofile');
    }
}
