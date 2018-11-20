<?php
namespace app\admin\controller;


use think\Response;

class BaseAdmin
{
    public $request=null;
    public function __construct()
    {
        $this->request = request();
        if($this->request->method()=='OPTIONS'){
            Response::create(['code'=> 20000,'msg'=> '请求成功'], 'json')->send();
            exit;
        }

    }

    public function _post($param,$string='')
    {
       return isset($this->request->post()[$param])? $this->request->post()[$param]:$string;
    }

    public function _get($param,$string='')
    {
        return isset($this->request->get()[$param])? $this->request->get()[$param]:$string;
    }
}