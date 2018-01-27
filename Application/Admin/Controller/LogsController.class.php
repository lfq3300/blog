<?php
namespace Admin\Controller;
use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
class LogsController extends AdminController{
    public  function  index()
    {
        $page = I("get.page",1,"intval");
        list($data,$total) = D("Log")->getData($page,20);
        $Builder = new AdminListBuilder();
        $Builder
            ->title("日志列表")
            ->powerAdd("add")
            ->powerRemove("delete")
            ->keyHtml("content","日志内容")
            ->keyText("add_time","添加时间")
            ->keyText("save_time","修改时间")
            ->keyStatus("status","是否显示",array("1"=>"显示","2"=>"不显示"))
            ->keyStatus("privacy","是否个人可见",array("1"=>"仅个人可见","2"=>"全部人可见"))
            ->powerEdit("edit?id=###")
            ->data($data)
            ->pagination($total,20)
            ->display();
    }
    public  function  add(){
       if($_POST){
           $data["content"] = I("post.content");
           $data["status"] = I("post.status");
           $data["privacy"] = I("post.privacy");
           $data["add_time"] = date("Y-m-d H:i:s");
           $data["save_time"] = date("Y-m-d H:i:s");
            if(D("Log")->add($data)){
                $this->success("成功成功",U("index"));
            }else{
                $this->error("添加失败");
            }
       }else{
           $Builder = new AdminConfigBuilder();
           $Builder
               ->title("添加日志")
               ->keySelect("status","是否显示","",array("1"=>"显示","2"=>"隐藏"))
               ->keySelect("privacy","是否个人可见","",array("2"=>"全部人可见","1"=>"仅个人可见",))
               ->keySmallEditor("content","日志内容","",array('style'=>"width:700px;height:250px"))
               ->buttonSubmit()
               ->display();
       }
    }

    public  function  edit(){
        if($_POST){
            $data["content"] = I("post.content");
            $data["status"] = I("post.status");
            $data["privacy"] = I("post.privacy");
            $data["save_time"] = date("Y-m-d H:i:s");
            $ret = D("Log")->where(array("id"=>I("post.id")))->save($data);
            if($ret){
                $this->success("成功成功",U("index"));
            }else{
                $this->error("添加失败");
            }
        }else{
            $data = D("Log")->getInfo(I("get.id"));
            $Builder = new AdminConfigBuilder();
            $Builder
                ->title("添加日志")
                ->keyHidden("id")
                ->keySmallEditor("content","日志内容","",array('style'=>"width:700px;height:250px"))
                ->keySelect("status","是否显示",array("value"=>$data["status"]),array("1"=>"显示","2"=>"隐藏"))
                ->keySelect("privacy","是否个人可见",array("value"=>$data["privacy"]),array("2"=>"全部人可见","1"=>"仅个人可见"))
                ->data($data)
                ->buttonSubmit()
                ->display();
        }
    }

    public  function  delete($ids){
        $map['id'] = array("in",$ids);
        $ret =  M('Log')->where($map)->delete();
        if($ret){
            $this->success("删除成功",U('index'));
        }else{
            $this->error(M('Log')->getError());
        }
    }
}