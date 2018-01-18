<?php 
namespace Admin\Controller;
use Think\Controller;
use OSS\Core\OssException;

class UploadController extends Controller{
    private $accessKeyId = "LTAIY4XqQzbNhNFK";//去阿里云后台获取秘钥
    private $accessKeySecret = "LfFYPXwKjLAETz6UJRwaHh9tWa9a3B";//去阿里云后台获取秘钥
    private $endpoint = "oss-cn-shenzhen.aliyuncs.com";//你的阿里云OSS地址
    private $bucket = "t1img"; //oss中的文件上传空间
    private $ossClient;

    public function __construct()
    {
        vendor('oss.autoload');
        $this->ossClient = new \OSS\OssClient($this->accessKeyId, $this->accessKeySecret,$this->endpoint);
    }

	public function UploadImg($maxWidth = 640){
		 $result = 0;
		 if ($_FILES["file"]["error"] === 0){
         	 $upload = new \Think\Upload(C("PICTURE_UPLOAD"));// 实例化上传类
         	 $info =  $upload->uploadOne($_FILES['file']);
	         if(!$info) {
	            $msg = $upload->getError();
	         }else{
                $object = 'newadmin/'.date('Y-m-d').'/'.$info['savename'];//想要保存文件的名称
                $info['path'] =  $upload->rootPath.$info['savepath'].$info['savename'];
                 try{
                      $this->ossClient->uploadFile($this->bucket,$object,$info['path']);
                     $result = 1;
                     //删除文件
                     unlink($info['path']);
                     $info['path'] = $object;
                     $info['root_path'] =  C('IMG_BASE_URL').$object;
                     $msg = '上传成功';
                 } catch(OssException $e) {
                     $msg = $e->getMessage();
                 }
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
                 $object = 'newadmin/'.date('Y-m-d').'/'.$info['savename'];//想要保存文件的名称
                $info['path'] =  $upload->rootPath.$info['savepath'].$info['savename'];
                 try{
                     $this->ossClient->uploadFile($this->bucket,$object,$info['path']);
                     $result = 1;
                     //删除文件
                     unlink($info['path']);
                     $info['path'] = $object;
                     $info['root_path'] =  C('IMG_BASE_URL').$object;
                     $msg = '上传成功';
                 } catch(OssException $e) {
                     $msg = $e->getMessage();
                 }
	         }
      }else{
          $msg = '上传错误';
      }
     returnJson($result,$msg,$info);
	}
}	
?>