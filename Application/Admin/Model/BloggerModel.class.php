<?php
namespace Admin\Model;
use Admin\Model\CommonModel;
class BloggerModel extends CommonModel{
    public  function datalist($page,$size){
        $data = M("blogger")->page($page,$size)->order("sort desc,save_time")->select();
        $total = M("blogger")->count();
        return array($data,$total);
    }
    public  function addlog($data){
        $ret = M("blogger")->add($data);
       return $ret;
    }

    public  function  savelog($id,$data){
        $ret = M("blogger")->where(array("id"=>$id))->save($data);
        if($ret === false){
            return false;
        }else{
            return true;
        }
    }

    public  function  getInfo($id){
       return  M("blogger")->where(array("id"=>$id))->find();
    }
}