<?php
namespace App\Http\Controllers\API;
trait ApiresponseTrait{
    public function ApiResponse($data=null,$message=null,$status=null){
        $array=[
            'Data'=>$data,
            'message'=>$message,
            'status'=>$status
        ];
        return response($array);

    }
}
