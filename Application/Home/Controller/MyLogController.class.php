<?php
namespace Home\Controller;
use Think\Controller;
class MyLogController extends Controller {
    public function index(){
        $this->assign("title","个人日志");
        $this->display();
    }
}
