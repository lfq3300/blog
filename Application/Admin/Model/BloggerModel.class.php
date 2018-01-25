<?php
namespace Admin\Model;
use Admin\Model\CommonModel;
class BloggerModel extends CommonModel{
    public  function datalist($page,$size){
        $data = $this
                ->table("mc_blogger AS A")
                ->join("mc_blogger_assortment AS B on A.assortment = B.id")
                ->page($page,$size)
                ->order("A.sort desc,A.save_time")
                ->select();
        $total = M("blogger")->count();
        return array($data,$total);
    }

    public  function addlog($data){
        $ret = M("blogger")->add($data);
       return $ret;
    }

    public  function  savelog($id,$data){
        $ret = M("blogger")->where(array("id"=>$id))->save($data);
        if($ret === false){
            return false;
        }else{
            return true;
        }
    }

    public  function  getInfo($id){
       return  M("blogger")->where(array("id"=>$id))->find();
    }

    public  function  getType(){
        $where["p_id"] = array("neq",0);
        $typeData = M("blogger_assortment")->where($where)->select();
        $arr = [];
        foreach ($typeData as $item){
            $arr[$item["id"]] = $item["assortment_name"];
        }
        return $arr;
    }

    public  function  getFirstType(){
        $where["p_id"] = array("eq",0);
        $typeData = M("blogger_assortment")->where($where)->select();
        $arr = [];
        $arr[0] = "一级目录";
        foreach ($typeData as $item){
            $arr[$item["id"]] = $item["assortment_name"];
        }
        return $arr;
    }

    public  function  getListType(){
        $where["A.p_id"] = array("neq",0);
        $where["B.p_id"] = array("eq",0);
       $data =  $this->table("mc_blogger_assortment AS A")
            ->join("mc_blogger_assortment AS B on A.p_id = B.id")
            ->field("A.id,A.assortment_name,B.assortment_name as p_name")
            ->where($where)
            ->select();
        return $data;
    }


}