<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/26 0026
 * Time: 上午 10:47
 */

namespace Home\Model;
use Home\Model\CommonModel;
class AlumnusModel extends CommonModel{
    public  function  getInfo($class){
        $where["class"] = $class;
        $data = M()->query("select name,shuoming from mc_alumnus where class = $class or class = 0 ORDER  BY  class");
        return  $data;
    }
    public  function  getAll($class){
        $where["class"] = $class;
        $data = M()->query("select name,wx,qq,telephone,address from mc_alumnus where class = $class or class = 0 ORDER  BY  class");
        return  $data;
    }
}