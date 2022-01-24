<?php

namespace App\Traits;

use ValueError;

trait GeneralTraits
{
    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }

    public function returnSuccess($successNum = '200', $msg)
    {
        return response()->json([
            'status' => true,
            'successNum' => $successNum,
            'msg' => $msg
        ]);
    }

    public function returnData($key, $value, $msg )
    {
        return response()->json([
            'status' => true,
            'successNum' => '200',
            'msg' => $msg,
            $key => $value
        ]);
    }
}
