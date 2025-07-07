<?php

class ResponseService {

    public static function response($payload, $statusCode, $success = null){
        $response = [];
        $response["payload"] = $payload;
        $response["status"] = $statusCode;
        $response["success"] = $success;
        return json_encode($response);
    }


}