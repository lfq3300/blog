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
               ->keyText("assortment_name","分类")
               ->keyText("title","标题")
               ->keyText("subtitle","副标题")
               ->keyText("introduction","导读")
               ->keyImg("cover_img","图片")
               ->keyText("sort","排序")
               ->keyText("add_time","添加时间")
               ->keyText("save_time","修改时间")
               ->keyStatus("hide","是否显示",array("1"=>"显示","2"=>"不显示"))
               ->keyStatus("privacy","是否个人可见",array("1"=>"仅个人可见","2"=>"全部人可见"))
               ->powerEdit("edit?id=###")
               ->keyDoAction("preview?id=###&p=Zzlicy3300","查看")
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
                    "sort"      =>I("post.sort"),
                    "assortment"=>I("post.assortment"),
                    "privacy"   =>I("post.privacy")
                );
                if (D("Blogger")->addlog($data)){
                    $this->success("成功",U("index"));
                }else{
                    $this->error("失败");
                }
           }else{
               $typeData = D("Blogger")->getType();
               $Builder = new AdminConfigBuilder();
               $Builder
                   ->keySelect("hide","是否显示博客",array("value"=>1),array("1"=>"显示","2"=>"隐藏"))
                   ->keySelect("privacy","是否个人可见",array("value"=>2),array("1"=>"仅个人可见","2"=>"全部人可见"))
                   ->title("新增博客")
                   ->keyText("title","标题")
                   ->keySelect("assortment","选择分类","",$typeData)
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
                "sort"      =>I("post.sort"),
                "assortment"=>I("post.assortment"),
                "privacy"   =>I("post.privacy")
            );
            if (D("Blogger")->savelog($id,$data)){
                $this->success("成功",U("index"));
            }else{
                $this->error("失败");
            }
        }else{
            $data = D("Blogger")->getInfo(I("get.id"));
            $Builder = new AdminConfigBuilder();
            $typeData = D("Blogger")->getType();
            $Builder
                ->keySelect("hide","是否显示博客",array("value"=>$data["hide"]),array("1"=>"显示","2"=>"隐藏"))
                ->keySelect("privacy","是否个人可见",array("value"=>$data["privacy"]),array("1"=>"仅个人可见","2"=>"全部人可见"))
                ->title("修改博客")
                ->keyHidden("id")
                ->keyText("title","标题")
                ->keySelect("assortment","所属分类",array("value"=>$data["assortment"]),$typeData)
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
        $p =  I("get.p");
        $url = "http://luo/index.php/index/blog?id={$id}&p={$p}";
        Header("Location: $url");
    }


    public  function firstType(){
        $data = D("Blogger")->getListFirstType();
        $Builder = new AdminListBuilder();
        $Builder
            ->title("博客一级分类")
            ->powerAdd("addType")
            ->keyLink('assortment_name','分类名称',"nextMenu?id=###")
            ->powerEdit("editType?id=###")
            ->data($data)
            ->display();
    }

    public  function  nextMenu(){
        $id = I("get.id");
        $data = D("Blogger")->getListType($id);
        $Builder = new AdminListBuilder();
        $Builder
            ->title("博客二级分类")
            ->powerAdd("addType")
            ->keyText("assortment_name","分类名称")
            ->powerEdit("editType?id=###")
            ->data($data)
            ->display();
    }


    public  function editType(){
        if($_POST){
            $ret = M("blogger_assortment")->where(array("id"=>I("post.id")))->save(array("assortment_name"=>I("post.assortment_name"),"p_id"=>I("post.p_id")));
            if($ret!=false){
                $this->success("修改成功",U("nextMenu",array("id"=>I("post.p_id"))));
            }else{
                $this->error("修改失败");
            }
        }else{
            $id = I("get.id");
            $data = M("blogger_assortment")->where(array("id"=>$id))->find();
            $typeData = D("Blogger")->getFirstType();
            $Builder = new AdminConfigBuilder();
            $Builder
                ->title("修改博客分类")
                ->keyHidden("id")
                ->keySelect("p_id","所属目录",array("value"=>$data["p_id"]),$typeData)
                ->keyText("assortment_name","分类名称")
                ->data($data)
                ->buttonSubmit()
                ->display();
        }
    }

    public  function  addType(){
        if($_POST){
            $data = array("assortment_name"=>I("post.assortment_name"),"p_id"=>I("post.p_id"));
            if( M("blogger_assortment")->add($data)){
                $this->success("新增成功",U("type"));
            }else{
                $this->error("新增失败");
            }
        }else{
            $Builder = new AdminConfigBuilder();
            $typeData = D("Blogger")->getFirstType();
            $Builder
                ->title("新增博客分类")
                ->keySelect("p_id","所属目录","",$typeData)
                ->keyText("assortment_name","分类名称")
                ->buttonSubmit()
                ->display();
        }
    }

}
