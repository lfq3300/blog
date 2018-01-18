<?php
namespace Home\Controller;
use Think\Controller;
class BlogController extends Controller {
    public function index(){
        $id = I("get.id");
        $data = D("Blogger")->getInfo($id);
        $this->assign("title",$data["title"]);
        $this->assign("data",$data);
        $this->display();
    }
}
