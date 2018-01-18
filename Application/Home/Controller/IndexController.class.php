<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $data = D("Blogger")->getIndex();
        $this->assign("title","首页");
        $this->assign("data",$data);
        $this->assign("pageindex","1");
        $this->display();
    }
}
