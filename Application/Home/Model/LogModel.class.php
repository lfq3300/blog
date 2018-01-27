<?php
namespace Home\Model;
use Home\Model\CommonModel;
class LogModel extends CommonModel{
    public  function  getlist($page,$size,$root){
        if($root){
            return M("log")->page($page,$size)->field("id as logid,DATE_FORMAT(add_time,'%Y-%m-%d') as add_time,content")->select();
        }else{
            return M("log")->where(array("privacy"=>2))->page($page,$size)->field("id as logid,DATE_FORMAT(add_time,'%Y-%m-%d') as add_time,content")->select();
        }

    }
}