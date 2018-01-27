<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public  function _empty(){
        $url = "http://www.luofq.com/404.html";
        Header("Location: $url");
    }
}