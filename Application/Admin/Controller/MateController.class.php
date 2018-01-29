<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26 0026
 * Time: 上午 10:07
 */

namespace Admin\Controller;
use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
class MateController extends AdminController{
    public  function  index(){
        $Builder = new AdminListBuilder();
        $page = I("get.page",1,"intval");
        $key = I("get.key");
        list($data,$total) = D("Alumnus")->getAll($page,20,$key);
        $Builder
            ->title("同学录")
            ->query($key,(bool)$key,'',"姓名查询")
            ->powerAdd("add")
            ->powerRemove("delete")
            ->keyText("name","姓名")
            ->keyText("telephone","电话")
            ->keyText("qq","QQ")
            ->keyText("wx","微信")
            ->keyText("address","学校")
            ->keyText("other","其他")
            ->keyHtml("shuoming","备注")
            ->keyText("class","所在班级")
            ->powerEdit("edit?id=###")
            ->data($data)
            ->pagination($total,20)
            ->display();
    }
    public  function  add(){
        if($_POST){
            $data = array(
                "name" =>I("post.name"),
                "telephone" =>I("post.telephone"),
                "qq" =>I("post.qq"),
                "wx" =>I("post.wx"),
                "address" =>I("post.address"),
                "shuoming" =>I("post.shuoming"),
                "class" =>I("post.class"),
                "status" =>I("post.status"),
                "other" =>I("post.other"),
            );
            if (D("Alumnus")->add($data)){
                $this->success("成功",U("index"));
            }else{
                $this->error("失败");
            }
        }else{
            $Builder = new AdminConfigBuilder();
            $Builder->title("新增同学")
                ->keyText("name","姓名")
                ->keyText("telephone","电话")
                ->keyText("qq","QQ")
                ->keyText("wx","微信")
                ->keyText("address","学校")
                ->keyTextarea("other","其他")
                ->keySmallEditor("shuoming","备注","",array('style'=>"width:700px;height:150px"))
                ->keyText("class","所在班级")
                ->keySelect("status","目前状态",'',array("1"=>"工作","2"=>"读书","3"=>"其他"))
                ->buttonSubmit()
                ->display();
        }
    }

    public  function  edit(){
        if($_POST){
            $id =I("post.id");
            $data = array(
                "name" =>I("post.name"),
                "telephone" =>I("post.telephone"),
                "qq" =>I("post.qq"),
                "wx" =>I("post.wx"),
                "address" =>I("post.address"),
                "shuoming" =>I("post.shuoming"),
                "class" =>I("post.class"),
                "status" =>I("post.status"),
                "other" =>I("post.other"),
            );
            $ret = D("Alumnus")->where(array("id"=>$id))->save($data);
            if ($ret===false){
                $this->error("失败");
            }else{
                $this->success("成功",U("index"));
            }
        }else{
            $id = I("get.id");
            $data = D("Alumnus")->getInfo($id);
            $Builder = new AdminConfigBuilder();
            $Builder->title("修改信息")
                ->keyHidden("id")
                ->keyText("name","姓名")
                ->keyText("telephone","电话")
                ->keyText("qq","QQ")
                ->keyText("wx","微信")
                ->keyText("address","学校")
                ->keyTextarea("other","其他")
                ->keySmallEditor("shuoming","备注","",array('style'=>"width:700px;height:150px"))
                ->keyText("class","所在班级")
                ->keySelect("status","目前状态",$data["status"],array("1"=>"工作","2"=>"读书","3"=>"其他"))
                ->buttonSubmit()
                ->data($data)
                ->display();
        }
    }
    public  function  delete($ids){
        $map['id'] = array("in",$ids);
        $ret =  M('Alumnus')->where($map)->delete();
        if($ret){
            $this->success("删除成功",U('index'));
        }else{
            $this->error(M('Alumnus')->getError());
        }
    }
}