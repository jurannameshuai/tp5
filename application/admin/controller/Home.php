<?php
namespace app\admin\controller;


use app\admin\common\Util;
use think\Db;

class Home extends BaseAdmin{
    public function getHomeImageData(){
        $result=db('home_img')->field("id,img_url,jump_url")->where('del_flag',0)->select();
        return Util::reSuJs($result);
    }

    public function saveHomeImageData(){
        $imgList=$this->_post('imgList');
        if(!$imgList){
            return Util::reErJs("参数错误");
        }
        Db::startTrans();
        try{
            Db::table('tkl_home_img')->where('del_flag',0)->update(['del_flag'=>1]);
            foreach($imgList as $val){
                if($val['id']!=0){
                    //已有的更新
                    $data=[
                        'img_url'=>$val['img_url'],
                        'jump_url'=>$val['jump_url'],
                        'del_flag'=>0
                    ];
                    Db::table('tkl_home_img')->where('id',$val['id'])->update($data);
                }else{
                    //没有的新增
                    $data=[
                        'img_url'=>$val['img_url'],
                        'jump_url'=>$val['jump_url'],
                    ];
                    Db::table('tkl_home_img')->insert($data);
                }
            }
            // 提交事务
            Db::commit();
            return Util::reSuJs();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return Util::reErJs('网络错误，请稍后再试！');
        }

    }
}