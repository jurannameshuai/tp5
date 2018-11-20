<?php
namespace app\admin\controller;

use app\admin\common\Util;

class Upload extends BaseAdmin {

    public function uploadImg(){
        $file = $this->request->file('image');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $result=[
                    'img_url'=>$this->request->domain()."/uploads/".$info->getSaveName(),
                    'index'=>$this->request->post()['index']
                ];
                return Util::reSuJs($result);
            }else{
                // 上传失败获取错误信息
                return  Util::reErJs($file->getError());
            }
        }
    }
}