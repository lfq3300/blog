<?php
namespace Home\Model;
use Home\Model\CommonModel;
class BloggerModel extends CommonModel{
    public  function  getIndex(){
        $data = M("blogger")->page(1,5)->order("sort desc,save_time")->field("id,cover_img,author,DATE_FORMAT(add_time,'%Y/%m/%d') AS add_time ,title,introduction")->select();
        return $data;
    }
    public  function  getInfo($id){
       return  M("blogger")->where(array("id"=>$id))->find();
    }

    public  function  getlist($page,$list){
        $data = M("blogger")->page($page,$list)->order("sort desc,save_time")->field("id,cover_img,author,DATE_FORMAT(add_time,'%Y/%m/%d') AS add_time ,title,introduction")->select();
        return $data;
    }
}