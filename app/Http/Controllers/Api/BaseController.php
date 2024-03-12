<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function SendResponse($result, $message, $code = 200){
        $response = [
            'success' => true,
            'message' => $message,
            'data'    => collect($result),
        ];
        // dd($response['data']);
        return response()->json($response, $code);
    }

    public function SendError($error, $errorMessages = [], $code = 404){
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

}
