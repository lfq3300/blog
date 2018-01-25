<?php
namespace Home\Model;
use Home\Model\CommonModel;
class BloggerModel extends CommonModel{
    public  function  getIndex(){
        $data =
            $this
                ->table("mc_blogger as A")
                ->join("mc_blogger_assortment AS B on A.assortment = B.id")
                ->page(1,5)
                ->order("A.sort desc,A.save_time")
                ->field("A.id,A.cover_img,A.author,DATE_FORMAT(A.add_time,'%M %d,%Y') as add_time,A.title,A.introduction,A.blog,B.assortment_name,B.id as assortment_id")
                ->select();
        return $data;
    }

    public  function  getIndexTypeBlog($id,$page,$size){
        $data =
            $this
                ->table("mc_blogger as A")
                ->join("mc_blogger_assortment AS B on A.assortment = B.id")
                ->page($page,$size)
                ->order("A.sort desc,save_time")
                ->where(array("A.assortment"=>$id))
                ->field("A.id,A.cover_img,A.author,DATE_FORMAT(A.add_time,'%M %d,%Y') as add_time,A.title,A.introduction,A.blog,B.assortment_name,B.id as assortment_id")
                ->select();
        $count = M("blogger")->where(array("assortment"=>$id))->count();
        return array($data,$count);
    }

    public  function  getIndexKeyBlog($key,$page,$size){
        $where["A.title"] = array("like","%$key%");
        $where2["title"] = array("like","%$key%");
        $data =
            $this
                ->table("mc_blogger as A")
                ->join("mc_blogger_assortment AS B on A.assortment = B.id")
                ->page($page,$size)
                ->order("A.sort desc,save_time")
                ->where($where)
                ->field("A.id,A.cover_img,A.author,DATE_FORMAT(A.add_time,'%M %d,%Y') as add_time,A.title,A.introduction,A.blog,B.assortment_name,B.id as assortment_id")
                ->select();
        $count = M("blogger")->where($where2)->count();
        return array($data,$count);
    }

    public  function  getInfo($id){
        $data = $this
            ->table("mc_blogger as A")
            ->join("mc_blogger_assortment AS B on A.assortment = B.id")
            ->where(array("A.id"=>$id))
            ->field("A.id,A.cover_img,author,DATE_FORMAT(A.add_time,'%M %d,%Y') as add_time,A.title,A.introduction,A.blog,B.assortment_name,B.id as assortment_id")
            ->find();
       return  $data;
    }



    public  function  getlist($page,$list,$getlist){
        $where = array();
        if($getlist){
            $where["A.title"] = array("like","%$getlist%");
        }
        $data = M("blogger")
            ->where($getlist)
            ->page($page,$list)
            ->order("sort desc,save_time")
            ->field("id,cover_img,author,DATE_FORMAT(add_time,'%M %d,%Y') as add_time,title,introduction")
            ->select();
        return $data;
    }

    public  function  getNav(){
        $where["p_id"] = array("eq",0);
        $firstData = M("blogger_assortment")->where($where)->select();
        $where2["p_id"] = array("neq",0);
        $twoData = M("blogger_assortment")->where($where2)->select();
        foreach ($twoData as $key=>$item){
            $twoData[$key]["blog_num"] =  M("blogger")->where(array("assortment"=>$item["id"]))->count();
        }
        return array($firstData,$twoData);
    }
}