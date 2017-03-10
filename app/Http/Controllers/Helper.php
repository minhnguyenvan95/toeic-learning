<?php
namespace App\Http\Controllers;
class Helper{
    public static function ApiResponse($data,$status = 'success'){
        return ['status' => $status, 'message' => $data];
    }
}

?>