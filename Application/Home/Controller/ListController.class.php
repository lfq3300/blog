<?php
namespace Home\Controller;
use Think\Controller;
class ListController extends Controller {
    public function index(){
        $page = I("get.page","1");
        $size = I("get.size",20);
        $data = D("Blogger")->getlist($page,$size);
        $this->assign("title","博客列表");
        $this->assign("pageindex","2");
        $this->assign("data",$data);
        $this->display();
    }
}
