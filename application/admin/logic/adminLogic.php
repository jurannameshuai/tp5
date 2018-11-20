<?php
namespace app\admin\logic;

use app\admin\common\Util;
use app\admin\model\AdminUser;
use think\Session;

class adminLogic{
    function adminLogin($account='',$password='')
    {
        $userModel=new AdminUser();
        $userInfo=$userModel->checkAdminUser($account,md5($password));
        if($userInfo){
            $adminId=$userInfo['id'];
            $token=strtoupper(md5(time()));
            Cache($token,$adminId);
            return Util::reSuJs(['token'=>$token]);
        }else{
            return Util::reErJs('用户不存在，请重新输入!');
        }
    }

    function adminInfo($token)
    {
        $userModel=new AdminUser();
        $adminId=Cache($token);
        if(!$adminId){
            return Util::reErJs("登录超时，请重新登录");
        }
        $adminInfo=$userModel->getAdminInfo($adminId);
        if(!$adminInfo){
            return Util::reErJs("登录超时，请重新登录");
        }
        return Util::reSuJs([
            'roles'=>['admin'],
            'name'=>$adminInfo['name']
        ]);
    }
}