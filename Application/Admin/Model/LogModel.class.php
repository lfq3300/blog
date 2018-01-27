<?php
namespace Admin\Model;
use Admin\Model\CommonModel;
class LogModel extends CommonModel{
    public  function  getData($page,$size){
        $data = $this
            ->table("mc_log")
            ->page($page,$size)
            ->select();
        $total = M("mc_log")->count();
        return array($data,$total);
    }

    public  function  getInfo($id){
        return M("log")->where(array("id"=>$id))->find();
    }
}