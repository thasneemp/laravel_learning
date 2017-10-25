<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Transformerse\UserTransformerEasyLogin;
use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class AuthController
 *
 * @package App\Api\V1\Controllers
 *
 * @SWG\Swagger(
 *     basePath="",
 *     host="localhost:8000",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0",
 *         title="iShop API",
 *         @SWG\Contact(name="Muhammed Thasneem", url="https://www.google.com"),
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */
class AuthController extends Controller
{
    //


    use Helpers;

    /**
     * Check force update
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */

    /**
     * @SWG\Get(
     *     path="/api/forceupdate",
     *     summary="Check force update",
     *     description="Check force update",
     *     operationId="api.auth.forceUpdate",
     *     tags={"Force Update"},
     *     consumes={"application/x-www-form-urlencoded"},
     *     @SWG\Response(
     *         response=200,
     *         description="Force check status"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Internal Server Error. Reasons could be Verification code generation failed, Token generation failed, New User creation failed if user does not exists",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Unprocessable Entity. Expected required parameters are not in the request",
     *     )
     *  )
     */
    public function forceUpdate(Request $request)
    {
        $content = [
            "android_version" => "1.0.3",
            "ios_version" => "1.1",
            "force_update" => false
        ];
        return $this->response->array($content);
    }


    public function insertUser(Request $request)
    {
        try {

            User::unguard();
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]);
            User::reguard();
            try {
                $token = JWTAuth::fromUser($user);
            } catch (JWTException $e) {
                return $this->response->error(config('messages.auth.tokenFailed'), 200);
            }
            $user->setAttribute('token', $token);
        } catch (JWTException $exception) {
            return $this->response->error("could not create token", 500);
        }

        return $this->response->item($user, new UserTransformerEasyLogin());

    }


}
