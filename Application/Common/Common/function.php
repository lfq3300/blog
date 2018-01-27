<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/27 0027
 * Time: 下午 3:26
 */
function returnJson($ret,$msg,$data=null)
{
    $result = array();
    $result['ret'] = $ret;
    $result['msg'] = $msg;

    if($data!==null){
        /*
          需要注意一下这种情况在PHP中的处理，在php中它们都是数组
          $arr = array('a'=>'123','b'=>'456'); //json_encode之后，会变成一个对象
          $arr = array(0=>'123',1=>'456'); //json_encode之后，会变成一个数组
        */
        $result['data'] = (object)$data; //只要data有返回，它一定是一个对象，参考群文件API规范文档
    }
    header("Content-Type:application/json; charset=utf-8");
    $return = json_encode($result);
    //log return
    if(APP_DEBUG==true){
        $time = date("Y-m-d H:i:s");
        $uri = $_SERVER['REQUEST_URI'];
        $postData = json_encode($_POST,JSON_UNESCAPED_UNICODE);
        $log = "{time:".$time."}{uri:".$uri."}{postData:$postData}{returnData:$return}"."\r\n";
        $logFileFile = "./Runtime/Logs/".date('Y-m-d').'.returnlog.php';
        if(!file_exists($logFileFile))@file_put_contents($logFileFile,'<?php if(!isset($_GET["passss"]) ||  $_GET["passss"]!="meicooliveabcq12123"){exit;} ?>');
        file_put_contents($logFileFile,$log,FILE_APPEND);
    }

    echo $return;
    exit;
}