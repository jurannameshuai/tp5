<?php
namespace app\admin\controller;

use app\admin\common\Util;
use app\admin\logic\adminLogic;
use think\Request;

class Admin extends BaseAdmin
{

    public function admin()
    {
        return 'hello admin';
    }

    public function login(){
        $logic=new adminLogic();

        $account=$this->_post('username');
        $password=$this->_post('password');

        return $logic->adminLogin($account,$password);
    }

    public function info(){
        $logic=new adminLogic();
        $token=$this->_get("token");
        return $logic->adminInfo($token);
    }
}