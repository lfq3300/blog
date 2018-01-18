<?php
namespace Admin\Model;
use Admin\Model\CommonModel;
class BloggerModel extends CommonModel{
    public  function addlog($data){
        $ret = M("mc_blogger")->add($data);
        print_r($this->getLastSql());
       return ;
    }
}