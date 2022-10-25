<?php

namespace App\Http\Controllers\user\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserApiModel;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    public function get() {

        $my_apis = UserApiModel::getMyApis(auth::Id());

        $data['my_id'] = auth::Id();
        $data['api_keys'] = array();

        if($my_apis) {
            foreach ($my_apis as $api) {
                $data['api_keys'][] = array(
                    "id" => $api->id,
                    'name' => $api->name,
                    'api_key' => $api->api_key,
                    'created_date' => $api->created_at
                );
            }
        }

        return view('user.api.userapi', $data);

    }

    public function add_api(Request $request)
    {
        header('Content-Type: application/json');
        $name = $request->input('name');
        if(!$name) {
            $json = '{"status":"error","text":"Ошибка, введите имя ключа"}';
        }else {
            if(mb_strlen($name,'UTF-8') < 3 OR mb_strlen($name,'UTF-8') > 20) {
                $json = '{"status":"error","text":"Ошибка, длинна имени не должна быть меньше 3 и более 20 символов"}';
            }else {
                if(!preg_match_all('/^[a-z0-9а-яё;]+$/iu', $name)) {
                    $json = '{"status":"error","text":"Ошибка, разрешены только буквы и цифры 0-9"}';
                }else {
                    $check_name = UserApiModel::checkName(auth::Id(), $name);
                    if($check_name) {
                        $json = '{"status":"error","text":"Ошибка, данное имя уже существует"}';
                    }else {
                        
                        $add = UserApiModel::addApiKey(auth::Id(), $name);

                        $json = '{"status":"ok","text":"Успешно"}';

                    }
                }
            }
        }

        return $json;

    }

    public function delete_api(Request $request) {

        header('Content-Type: application/json');

        (int)$id_api = $request->input('id');

        $info_api = UserApiModel::infoApi($id_api);

        if($info_api->id) {

            if($info_api->user_id == auth::Id()){
                $delete = UserApiModel::delete_api($info_api->id);
            }

        }

        return 1;
    }
}
