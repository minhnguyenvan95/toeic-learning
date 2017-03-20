<?php
namespace App\Http\Controllers;
class Helper{
    public static function ApiResponse($data,$status = 'success',array $opt = null){
        $data = ['status' => $status, 'message' => $data];
        if($opt != null)
	        foreach ($opt as $key => $value) {
	        	$data[$key] = $value;
	        }
        return $data;
    }
}

?>