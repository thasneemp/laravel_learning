<?php
/**
 * Created by PhpStorm.
 * User: muhammed
 * Date: 10/25/2017
 * Time: 2:14 PM
 */

namespace App\Transformerse;

use App\User as User;
use Storage;

class UserTransformerEasyLogin extends \League\Fractal\TransformerAbstract
{
    public static function transform(User $user)
    {
        $token = "";

        if ($user->name == "") {
            $name = "";
        } else {
            $name = $user->name;
        }

        if ($user->email == "") {
            $email = "";
        } else {
            $email = $user->email;
        }
        if (isset($user->token) && $user->token != "") {
            $token = $user->token;
        }

        $user = [
            'id' => (int)$user->id,
            'name' => $user->name,
            'email' => $user->email

        ];
        if($token != "")
            array_set($user, 'token', $token);
        return $user;
    }
}