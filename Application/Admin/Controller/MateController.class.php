<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26 0026
 * Time: 上午 10:07
 */

namespace Home\Controller;
use Think\Controller;
class MateController extends Controller{
    public  function  index(){
        $class = I("get.l",0,"intval");
        $root = (string)I("get.p");
        if($root === C("POWER")){
            $this->assign("root",true);
            $data = D("Alumnus")->getAll($class);
        }else{
            $data = D("Alumnus")->getInfo($class);
        }
        if($class==0){
            $this->assign("alert","匹配参数不正确,无法查看详情");
        }
        $this->assign("data",$data);
        $this->display();
    }
}