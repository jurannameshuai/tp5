<?php

namespace app\admin\common;

class Util{
    static public function reSuArr($data,$message=""){
        return [
            'code'=>20000,
            'data'=>$data,
            'message'=>$message
        ];
    }

    static public function reErArr($message="",$code=0,$data=[]){
        return [
            'code'=>$code,
            'data'=>$data,
            'message'=>$message
        ];
    }

    static public function reSuJs($data=[],$message=""){
        return json_encode(self::reSuArr($data,$message));
    }

    static  public function reErJs($message="",$code=0,$data=[]){
        return json_encode(self::reErArr($message,$code,$data));
    }


}