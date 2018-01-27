<?php
namespace Home\Controller;
use Think\Controller;
class LogController extends Controller{
    public  function index(){
        $root = I("get.p");
        $page = I("get.page",1,"intval");
        $size = I("get.size",20,"intval");
        if($root === C("POWER")){
            $data = D("log")->getlist($page,$size,true);
        }else{
            $data = D("log")->getlist($page,$size);
        }
        $root = $root?$root:"root";
        $this->assign("data",$data);
        $this->assign("count",count($data));
        $this->assign("rootdata",$root);
        $this->display();
    }

    public  function  getNextLog(){
        $root = I("post.p");
        $page = I("post.page",1,"intval");
        $size = I("post.size",20,"intval");
        if($root === C("POWER")){
            $data = D("log")->getlist($page,$size,true);
        }else{
            $data = D("log")->getlist($page,$size);
        }
        if(!empty($data)){
            foreach ($data as $key=>$item){
                $data[$key]["content"] = html_entity_decode($item["content"]);
            }
            returnJson(1,"success",$data);
        }else{
            returnJson(-1,"error",false);
        }
    }
}