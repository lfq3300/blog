<?php 
return array(
    'URL_CASE_INSENSITIVE' =>true, //不区分大小写
    //模板相关配置
	'TMPL_PARSE_STRING' => array(
	   '__CSS__' => __ROOT__ . '/Application/' . MODULE_NAME . '/Static/css',
	   '__IMG__' => __ROOT__ . '/Application/' . MODULE_NAME . '/Static/img',
	   '__JS__' => __ROOT__ . '/Application/' . MODULE_NAME . '/Static/js',
       '__PUBLIC__'=> __ROOT__ . '/Public',
	),
    //关于路径配置
    'ADMIN_URL' =>'http://luo:80/admin.php/',
    'ADMIN_ROOT' =>'http://luo:80',
    'ADMIN_UPLOAD_ROOT' =>'',

     /* 图片上传相关配置 */
    'PICTURE_UPLOAD' => array(
        'mimes' => '', //允许上传的文件MiMe类型
        'maxSize' => 0, //上传的文件大小限制 (0-不做限制)
        'exts' => 'jpg,gif,png,jpeg,swf', //允许上传的文件后缀
        'autoSub' => true, //自动子目录保存文件
        'subName' => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        'rootPath' => './Uploads/Img/', //保存根路径
        'dbPath' =>'/Uploads/Img/',
        'savePath' => '', //保存路径
        'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
        'saveExt' => '', //文件保存后缀，空则使用原后缀
        'replace' => false, //存在同名是否覆盖
        'hash' => true, //是否生成hash编码
        'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
    ),
)
?>