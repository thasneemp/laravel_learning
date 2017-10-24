<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

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
     *  @SWG\Get(
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
        return $this->response->json($content = [
            "android_version" => "1.0.3",
            "ios_version" => "1.1",
            "force_update" => false
        ]);
    }
}
