<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26 0026
 * Time: 上午 10:47
 */

namespace Admin\Model;
use Admin\Model\CommonModel;
class AlumnusModel extends CommonModel{

    public  function  getAll($page,$size,$key){
        $where["name"] = array("like","%$key%");
        $data =$this->where($where)->page($page,$size)->select();
        $count = $this->where($where)->count();
        return  array($data,$count);
    }
    public  function  getInfo($id){
        return $this->where(array("id"=>$id))->find();
    }
}