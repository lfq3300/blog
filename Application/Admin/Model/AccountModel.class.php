<?php
namespace Admin\Model;
use Admin\Model\CommonModel;
class AccountModel extends CommonModel{

    protected  $_validate  = array(
        array('account', 'require','账户不能为空', self::EXISTS_VALIDATE , 'regex'),
        array('account', 'require','账户已存在',  self::EXISTS_VALIDATE, 'unique'),
        array('password', 'require','密码不能为空', self::EXISTS_VALIDATE , 'regex'),
    );

    public  function  fountAdminRoot($map){
        if(M("account")->where(array("level"=>"-100000000"))->count()==0){
            $map["level"] = "-100000000  ";
           return  M("account")->add($map); //创建超级管理员成功
            //不用创建权限目录了   只要是-100000000  全部目录拿出来
        }
    }

    public  function  getAccountInfo($level){
        if ($level == "-100000000"){
            $ret = M("account")
                ->where(array("level"=>array("neq","-100000000")))
                ->field("account,if(level = 1,'用户','管理员') as level,id,if(status = 1,'正常','禁止登录') as status")
                ->select();
            return $ret;
        }
        if ($level == "1"){
            $ret = M("account")
                ->where(array("level"=>'user'))
                ->field("account,'用户' as level,id,if(status = 1,'正常','禁止登录') as status")
                ->select();
            return $ret;
        }
    }


    public  function  addAccount($data){

    }

    public  function setPower($level){
        if($level == "-100000000"){
            $oneData = M("admin_menu")->where(array("p_id"=>0))->select();
            foreach ($oneData as $key =>$menu){
                $id = $menu["id"];
                $oneData[$key]["twoMenu"] = M("admin_menu")->where(array("p_id"=>$id))->select();
            }
            return $oneData;
        }else  if($level == "1"){
            $oneData = M("admin_menu")->where(array("p_id"=>0,"hide"=>0))->select();
            foreach ($oneData as $key =>$menu){
                $id = $menu["id"];
                $oneData[$key]["twoMenu"] = M("admin_menu")->where(array("p_id"=>$id))->select();
            }
            return $oneData;
        }
    }
}