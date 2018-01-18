<?php
namespace Admin\Builder;
use Think\View;
class AdminConfigBuilder extends AdminBuilder{
    private $_title;
    private $_data = array();
    private $_keyList = array();
    private $_formtitle = array();
    private $_buttonList = array();
    private $_savePostUrl = "";
    public function title($title)
    {
        $this->_title = $title;
        return $this;
    }
    public function formtitle($title)
    {
        $this->_formtitle = $title;
        return $this;
    }
    /*
     * $name  string  必选
     * $title string  必选
     * $type string   必选
     * $opt array() 选填
     *         subtitle  副标题 可选
     *         placeholder  提示文字 可选
     *         error  ?错误?提醒 可选
     *         btntitle  上传图片按钮文字
     * $other array() 选填
     *         一般于规律数组   作用于select较多
     *         或配合key.html自定义开发
     *
     * */
    public function key($name, $title,$type,$opt = null,$other = null)
    {
        $key = array('name' => $name, 'title' => $title, 'type' => $type, 'opt' => $opt,'other'=>$other);
        $this->_keyList[] = $key;
        return $this;
    }
    public function data($list)
    {
        $this->_data = $list;
        return $this;
    }
    public function button($title, $attr = array())
    {
        $this->_buttonList[] = array('title' => $title, 'attr' => $attr);
        return $this;
    }
    public function savePostUrl($url)
    {
        if ($url) {
            $this->_savePostUrl = $url;
        }
    }
    public function keyText($name,$title,$opt){
        return $this->key($name, $title,'text',$opt);
    }
    public  function keyRadio($name,$title,$opt){
        return $this->key($name, $title,'radio',$opt);
    }
    public function keyNumber($name,$title,$opt){
        return $this->key($name, $title,'textnumber',$opt);
    }
    public function keyDisabled($name,$title,$opt){
        return $this->key($name, $title,'textDisabled',$opt);
    }
    public function keyHidden($name,$title,$opt){
        return $this->key($name, $title,'hidden',$opt);
    }
    public function keyTextarea($name,$title,$opt){
        return $this->key($name, $title,'textarea',$opt);
    }
    public function keySelect($name, $title,$opt,$other)
    {
        return $this->key($name, $title,'select', $opt,$other);
    }
    public function keyOnSelect($name, $title, $opt,$other)
    {
        return $this->key($name, $title, 'noselect', $opt,$other);
    }

    public function keyDisabledStatus($name, $title, $opt){
        return $this->key($name, $title, 'DisabledStatus', $opt);
    }
    public function buttonSubmit($url = '', $title = '确定')
    {
        $this->savePostUrl($url);
        $attr = array();
        $attr['class'] = "am-btn am-btn-primary tpl-btn-bg-color-success ajax-post";
        $attr['id'] = 'submit';
        $attr['type'] = 'submit';
        return $this->button($title, $attr);
    }
    public function keyUploadImg($name,$title ='上传图片',$btntitle = "上传图片"){
        return $this->key($name, $title,'uploadimg',array("btntitle"=>$btntitle));
    }
    public function keyShowImg($name,$title, $subtitle,$btntitle = "上传图片"){
        return $this->key($name, $title, $subtitle,'showimg',array("btntitle"=>$btntitle));
    }
    public function keyEditor($name, $title, $subtitle = null, $opt = array('style'=>"width:1224px;height:800px"))
    {
        $key = array('name' => $name, 'title' => $title, 'subtitle' => $subtitle, 'type' => 'editor', 'opt' => $opt);
        $this->_keyList[] = $key;
        return $this;
    }
    public function keySmallEditor($name, $title, $subtitle = null, $opt = array('style'=>"width:700px;height:50px"))
    {
        $key = array('name' => $name, 'title' => $title, 'subtitle' => $subtitle, 'type' => 'editor', 'opt' => $opt);
        $this->_keyList[] = $key;
        return $this;
    }
    public function display($solist = ''){
        foreach ($this->_buttonList as &$button) {
            $button['attr'] = $this->compileHtmlAttr($button['attr']);
        }
        foreach ($this->_keyList as &$e) {
            $e['value'] = $this->_data[$e['name']];
        }
        $this->assign('title', $this->_title);
        $this->assign('formtitle', $this->_formtitle);
        $this->assign('keyList', $this->_keyList);
        $this->assign('buttonList', $this->_buttonList);
        $this->assign('savePostUrl', $this->_savePostUrl);
        $this->assign('selectData', $this->_selectData);
        if ($solist) {
            parent::display($solist);
        } else {
            parent::display('admin_congif');
        }
    }
}
?>