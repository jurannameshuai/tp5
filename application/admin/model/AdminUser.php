<?php
namespace app\admin\model;

use think\Model;

class AdminUser extends Model{
    public function checkAdminUser($account,$password)
    {
        $admin=$this->where(['account'=>$account,'password'=>$password])->find();
        return $admin;
    }

    public function getAdminInfo($adminId)
    {
        return $this->get($adminId);
    }
}