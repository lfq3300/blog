<?php
namespace Admin\Controller;
use Think\Controller;

class UploadController extends Controller{
    public function UploadImg($maxWidth = 640){
        $result = 0;
        $msg = '';
        $data = array();
        if ($_FILES["file"]["error"] === 0){
            $upload = new \Think\Upload(C("PICTURE_UPLOAD"));// 实例化上传类
            $info =  $upload->uploadOne($_FILES['file']);
            if(!$info) {
                $msg = $upload->getError();
            }else{
                $result = 1;
                $msg = '上传成功';
                $info['path'] =  C("ADMIN_UPLOAD_ROOT").$upload->dbPath.$info['savepath'].$info['savename'];
                $info['root_path'] =  C("ADMIN_ROOT").$upload->dbPath.$info['savepath'].$info['savename'];
            }
        }else{
            $msg = '上传错误';
        }
        returnJson($result,$msg,$info);
    }


    public function UploadUserFace($maxWidth = 640){
        $result = 0;
        $msg = '';
        $data = array();
        if ($_FILES["file"]["error"] === 0){
            $upload = new \Think\Upload(C("PICTURE_UPLOAD"));// 实例化上传类
            $info =  $upload->uploadOne($_FILES['file']);
            if(!$info) {
                $msg = $upload->getError();
            }else{
                $result = 1;
                $msg = '上传成功';
                $info['path'] =  C("ADMIN_UPLOAD_ROOT").$upload->dbPath.$info['savepath'].$info['savename'];
                $info['root_path'] =  C("ADMIN_ROOT").$upload->dbPath.$info['savepath'].$info['savename'];
            }
        }else{
            $msg = '上传错误';
        }
        returnJson($result,$msg,$info);
    }
}
?>