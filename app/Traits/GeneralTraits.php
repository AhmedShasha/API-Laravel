<?php

namespace App\Traits;

use ValueError;

trait GeneralTraits
{
    // Get current language
    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    // return error message
    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }

    // return success message
    public function returnSuccess($successNum = '200', $msg)
    {
        return response()->json([
            'status' => true,
            'successNum' => $successNum,
            'msg' => $msg
        ]);
    }

    // return data
    public function returnData($key, $value, $msg)
    {
        return response()->json([
            'status' => true,
            'successNum' => '200',
            'msg' => $msg,
            $key => $value
        ]);
    }

    //  login error
    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    // input valedation
    public function getErrorCode($input)
    {
        if ($input == 'email') return 'E404';
        elseif ($input == 'password') return 'P404';
    }

    //  return validation error
    public function returnValidationError($code = 'E001', $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }
}
