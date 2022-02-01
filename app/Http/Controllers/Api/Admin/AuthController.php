<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTraits;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    use GeneralTraits;
    public function login(Request $request)
    {
        try {
            // validation
            $rules = [
                'email' => 'required',
                'password' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            // login operation

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('admin-api')->attempt($credentials); // go to guard 'admin-api' -> provider admin -> model admin

            if (!$token)
                return $this->returnError('A404', 'User Not Found');

            // return data
            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token;
            // return token
            return $this->returnData('token',$admin,'Login Successfully');


        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
