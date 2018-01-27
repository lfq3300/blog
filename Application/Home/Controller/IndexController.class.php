<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
    public function index(){
        $typeId = I("get.typeid");
        $key = I("get.key");
        $p = I("get.p");
        $page =I("get.page",1,"intval");
        $size =I("get.size",10,"intval");
        list($first,$two) = D("Blogger")->getNav();
        $root = false;
        if($p == C("POWER")){
            $root = true;
        }else{
            $root = false;
        }
        if($typeId){
            list($data,$count) = D("Blogger")->getIndexTypeBlog($typeId,$page,$size,$root);
            $Page    = new \Think\Page($count,7);
            $show    = $Page->show();
            $this->assign('page',$show);
        }else if($key){
            list($data,$count) = D("Blogger")->getIndexKeyBlog($key,$page,$size,$root);
            $Page    = new \Think\Page($count,7);
            $show    = $Page->show();
            $this->assign('page',$show);
        }else{
            $data = D("Blogger")->getIndex($root);
        }
        $this->assign("title","Mr.L's Blog");
        $this->assign("data",$data);
        $this->assign("firsttnav",$first);
        $this->assign("twotnav",$two);
        $this->display();


    }

    public function  blog(){
        $p = I("get.p");
        $root = false;
        if($p == C("POWER")){
            $root = true;
        }else{
            $root = false;
        }
        $id = I("get.id");
        $data = D("Blogger")->getInfo($id,$root);
        list($first,$two) = D("Blogger")->getNav();
        $this->assign("title",$data["title"]."一Mr.L's Blog");
        $this->assign("data",$data);
        $this->assign("firsttnav",$first);
        $this->assign("twotnav",$two);
        $this->display();
    }

}
