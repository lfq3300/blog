<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{
    public function index(){
        $typeId = I("get.typeid");
        $key = I("get.key");
        $page =I("get.page",1,"intval");
        $size =I("get.size",10,"intval");
        list($first,$two) = D("Blogger")->getNav();
        if($typeId){
            list($data,$count) = D("Blogger")->getIndexTypeBlog($typeId,$page,$size);
            $Page    = new \Think\Page($count,7);
            $show    = $Page->show();
            $this->assign('page',$show);
        }else if($key){
            list($data,$count) = D("Blogger")->getIndexKeyBlog($key,$page,$size);
            $Page    = new \Think\Page($count,7);
            $show    = $Page->show();
            $this->assign('page',$show);
        }else{
            $data = D("Blogger")->getIndex();
        }
        $this->assign("title","Mr.L's Blog");
        $this->assign("data",$data);
        $this->assign("firsttnav",$first);
        $this->assign("twotnav",$two);
        $this->display();


    }

    public function  blog(){
        $id = I("get.id");
        $data = D("Blogger")->getInfo($id);
        list($first,$two) = D("Blogger")->getNav();
        $this->assign("title",$data["title"]."一Mr.L's Blog");
        $this->assign("data",$data);
        $this->assign("firsttnav",$first);
        $this->assign("twotnav",$two);
        $this->display();
    }

}
