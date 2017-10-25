<?php
/**
 * Created by PhpStorm.
 * User: muhammed
 * Date: 10/25/2017
 * Time: 2:45 PM
 */

namespace App\Api\V1\Controllers;


use App\Http\Controllers\Controller;
use App\Transformerse\UserTransformerEasyLogin;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    use Helpers;

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 401);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function index()
    {
        //fetch all users from storage
        $user = User::all();

        return $this->response->collection($user, new UserTransformerEasyLogin());
    }
}