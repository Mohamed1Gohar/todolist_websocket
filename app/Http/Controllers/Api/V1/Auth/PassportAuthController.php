<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginPassportRequest;
use App\Http\Requests\Api\Auth\RegisterPassportRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

class PassportAuthController extends Controller
{
    use ApiResponser;
    /**
     * Registration Req
     */
    public function register(RegisterPassportRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $success['name'] =  $user->name;
        $success['token'] = $user->createToken('M.Gohar-BE-Passport-Auth')->accessToken;

        return $this->responseSuccess('User register successfully.', $success);
    }

    /**
     * Login Req
     */
    public function login(LoginPassportRequest $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($data)){
            $user = Auth::user();
            $success['name'] = $user->name;
            $success['token'] = $user->createToken('M.Gohar-BE-Passport-Auth')-> accessToken;

            return $this->responseSuccess('User login successfully.', $success, 200);
        } else {
            return $this->responseError('unauthenticated access !');
        }
    }

    public function userInfo()
    {

        $user = auth()->user();
        return $this->responseSuccess('User Info', ['user' => $user]);
    }
}
