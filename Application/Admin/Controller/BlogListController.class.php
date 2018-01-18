<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/18 0018
 * Time: 上午 10:53
 */

namespace Admin\Controller;
use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
class BlogListController extends AdminController{
       public  function  index($r = 50)
       {
           $page = I("get.page",1,"intval");
           list($data,$total) = D("Blogger")->datalist($page,20);
           $Builder = new AdminListBuilder();
           $Builder
               ->powerAdd("add")
               ->powerRemove("delete")
               ->title("博客列表")
               ->keyText("title","标题")
               ->keyText("subtitle","副标题")
               ->keyText("introduction","导读")
               ->keyImg("cover_img","图片")
               ->keyText("sort","排序")
               ->keyText("add_time","添加时间")
               ->keyText("save_time","修改时间")
               ->powerEdit("edit?id=###")
               ->keyDoAction("preview?id=###","查看")
               ->data($data)
               ->pagination($total,20)
               ->display();
       }
       public  function  add(){
           if(IS_POST){
                $data = array(
                    "hide" => I("post.hide"),
                    "title" => I("post.title"),
                    "subtitle" => I("post.subtitle"),
                    "introduction" => I("post.introduction"),
                    "cover_img" => I("post.cover_img"),
                    "blog" => I("post.blog"),
                    "add_time" => date("Y-m-d H:i:s"),
                    "save_time" =>date("Y-m-d H:i:s"),
                    "author"    => I("post.author","lfq3300"),
                    "sort"      =>I("post.sort")
                );
                if (D("Blogger")->addlog($data)){
                    $this->success("成功",U("index"));
                }else{
                    $this->error("失败");
                }
           }else{
               $Builder = new AdminConfigBuilder();
               $Builder
                   ->keySelect("hide","是否显示博客",array("value"=>1),array("1"=>"显示","2"=>"隐藏"))
                   ->title("新增博客")
                   ->keyText("title","标题")
                   ->keyText("subtitle","副标题")
                   ->keyText("introduction","导读")
                   ->keyText("author","作者")
                   ->keyText("sort","排序")
                   ->keyUploadImg("cover_img","封面图")
                   ->keyEditor("blog","内容")
                   ->buttonSubmit()
                   ->display();
           }
       }
       public  function  edit(){
        if(IS_POST){
            $id = I("post.id");
            $data = array(
                "hide" => I("post.hide"),
                "title" => I("post.title"),
                "subtitle" => I("post.subtitle"),
                "introduction" => I("post.introduction"),
                "cover_img" => I("post.cover_img"),
                "blog" => I("post.blog"),
                "save_time" =>date("Y-m-d H:i:s"),
                "author"    => I("post.author","lfq3300"),
                "sort"      =>I("post.sort")
            );
            if (D("Blogger")->savelog($id,$data)){
                $this->success("成功",U("index"));
            }else{
                $this->error("失败");
            }
        }else{
            $data = D("Blogger")->getInfo(I("get.id"));
            $Builder = new AdminConfigBuilder();
            $Builder
                ->keySelect("hide","是否显示博客",array("value"=>1),array("1"=>"显示","2"=>"隐藏"))
                ->title("新增博客")
                ->keyHidden("id")
                ->keyText("title","标题")
                ->keyText("subtitle","副标题")
                ->keyText("introduction","导读")
                ->keyText("author","作者")
                ->keyText("sort","排序")
                ->keyUploadImg("cover_img","封面图")
                ->keyEditor("blog","内容")
                ->buttonSubmit()
                ->data($data)
                ->display();
        }
    }

    public  function  delete($ids){
         $map['id'] = array("in",$ids);
         $ret =  M('Blogger')->where($map)->delete();
         if($ret){
             $this->success("删除成功",U('index'));
         }else{
             $this->error(M('Blogger')->getError());
         }
    }

    public  function  preview(){
        $id =  I("get.id");
        $url = "http://www.luofq.com/Blog?id={$id}";
        Header("Location: $url");
    }


}
