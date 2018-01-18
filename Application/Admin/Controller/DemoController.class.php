<?php
namespace Admin\Controller;
use Admin\Builder\AdminListBuilder;
use Admin\Builder\AdminConfigBuilder;
class DemoController extends AdminController{

	//若需调用导出excel控件 无需继承AdminController 直接继承Think Controller
	
	public function index(){
		$Builder = new AdminListBuilder();
		$thead = array(
			array(
			"函数名",
			"参数",
			"参数解释",
			"是否完成"
			)
		);
		$data = array(
			 array(
			 	array("title()","\$str","页面标题,自己传字符串","已完成"),
				array("keyText()",
					 "\$name,<br>\$title,<br>\$ope = array()",
					 "list页面中配合data函数,<br/>
					 \$name匹配data函数对应的name,<br/>
					 \$title 名称 用作与table表头 ,<br/> 
					 \$ope 是数组,规定额外的参数,<br>
					 \$ope以规定参数: \$ope规定参数请查看 AdminListBuilder 注释处
					 ",
					 "已完成"),
				array("keyTime()",
					"\$name,<br>\$title,<br>\$ope = array()",
					 "配合data函数,将data传递中 键为\$name的值格式化成时间  Y-m-d H:i:s, <br/>
					 建议在sql查询时将时间戳格式化为Y-m-d H:i:s <br/>
					 其他参数与 keyText() 相同
					 ",
					 "已完成"
				),
				array("keyImg()",
					"\$name,<br>\$title",
					 "配合data函数,将data传递中 键为\$name的值 转为img图片, <br/>
					 其他参数与 keyText() 相同
					 ",
					 "已完成"
				),
				array("query()",
					"\$value,<br>\$state = false,<br>\$name='query',<br>\$opt,<br>\$title='查询条件'",
					"\$value 默认值,<br>
					\$state 是否展开搜索框,<br>
					\$name  post或者get所获取的参数名,<br>
					\$opt值: array('placeholder'=>'input框提示文字','prompt'=>'搜索提示关键字'),<br>
					\$title  搜索框名称
					",
					"已完成"
				),
				array(
					"queryselect()",
					"\$arrvalue,<br>\$thisSelect = 0,<br>\$defaultvalue='不筛选',<br>\$title='查询筛选',<br>\$name='queryType',<br>\$opt",
					"配合query函数,<br>
					lg: \$arrvalue = array('0'=>'昵称查询','1'=>'ID查询'),<br>
					\$thisSelect  根据post或者get获取的\$name  显示值 对应 \$arrvalue,<br>
					\$defaultvalue = '不筛选' 在无 \$thisSelec 下 select框默人选中,<br>
					\$title 标题,<br>
					\$name  表单对应name,<br>
					\$opt  array('prompt'=>'提示文字')
					",
					"已完成"
				),
				array(
					"queryStarTime()",
					"\$val,<br>\$name='startime', <br>\$title = '开始时间'",
					"\$value 默认值,<br>
					\$name post或者get所获取的参数名,<br>
					\$title 提示文字",
					"已完成"
				),
				array(
					"queryEndTime()",
					"\$val,<br>\$name='startime', <br>\$title = '开始时间'",
					"\$value 默认值,<br>
					\$name post或者get所获取的参数名,<br>
					\$title 提示文字",
					"已完成"
				),
				array(
					"keyGrossincome()",
					"\$str",	
					"用于统计table表单总和 中负责显示 不负责计算",
					"已完成"
				),
				array(
					"newButton()",
					"\$href,<br>\$title='新增',<br>\$attr = array()",
					"\$href 被U函数所解析 lg :   \$Builder->newButton(U('add')),<br>
					 \$attr  未被开发
					",
					"已完成"
				),
				array(
					"deleteButton()",
					"\$href,<br>\$title='删除',<br>\$attr = array()",
					"\$href 被U函数所解析 lg :   \$Builder->deleteButton(U('remove')),<br>
					 \$attr  未被开发   但是  class = 'delete-ajax-post' 是 删除键的核心  
					",
					"已完成"
				),
				array(
					"keyDoAction()",
					"\$getUrl,<br>\$text='编辑',<br>\$title = '操作'",
					"\$getUrl  lg:  $Builder->keyDoAction('edit?id=###'),<br>
					其中 id 在 createDefaultGetUrlFunction 中 被解析  自行添加  id必须是 data函数中拥有 对应sql中删除条件 
					",
					"已完成"
				),
				array(
					"keyLink()",
					"\$name,<br>\$title,<br>\$getUrl",
					"\$name 用于data() 匹配,<br>
					 \$title thead 标题,<br>
					 \$getUrl  与 keyDoAction() \$getUrl 用法相同
					",
					"已完成"
				),
				array(
					"data()",
					"\$array",
					"被sql语句查询出来的集合,<br>
					 sql 字段 与  keyText, keyLink，keyLink,keyDoAction,keyImg 相匹配
					",
					"已完成"
				),
				array(
					"otherData()",
					"\$array",
					"
					 不是有list界面,<br>
					 被sql语句查询出来的集合,<br>
					 sql 字段 与  keyText, keyLink，keyLink,keyDoAction,keyImg 相匹配
					",
					"已完成"
				),
				array(
					"display()",
					"\$str",
					"\$str  默认指向 admin_list.html",
					"已完成"
				)
				
			 )
		);
		$newdata  = array();
		
		$newdata[] = '关于AdminListBuilder相关函数以及函数参数';
		$newdata[] = array_merge($thead,$data);

		$Builder
			->otherData($newdata)
			->display("list");
	}





	public function power(){
		$Builder = new AdminListBuilder();
		$thead= array(
			array(
			"函数名",
			"说明",
			"参数解释",
			"是否完成"
			)
		);
		$data = array(
			array(
				array("powerAdd()","新增按钮  通过root权限分配显示页面","与 newButton 用法相同","已完成"),
				array("powerRemove()","删除按钮  通过root权限分配显示页面","与 deleteButton 用法相同","已完成"),
				array("powerExport()","导出excel 通过root权限分配显示页面","详细代码流程请看相关demo","已完成"),
				array("powerEdit()","修改连接 通过root权限分配显示页面","与 keyDoAction 用法相同","已完成"),
				array("powerVerify()","审核连接 通过root权限分配显示页面","与 keyDoAction 用法相同","已完成"),
			)
		);
		$newdata  = array();
		
		$newdata[] = "关于AdminListBuilder权限函数以及函数参数<br>
		<br>
		<span style='font-size:14px'>
			网站权限分为 root  admin  <br>
			root 账户只有一个   admin可拥有多个  <br>
			其中 root 权限为网站拥有者  可创建admin用户以及分配admin相关权限  <br>
		</span>";
		$newdata[] = array_merge($thead,$data);

		$Builder
			->otherData($newdata)
			->display("list");
	}



	public function conf(){
		$Builder = new AdminListBuilder();
		$thead = array(
			array(
			"函数名",
			"参数",
			"参数解释",
			"是否完成"
			)
		);

		$data = array(
			array(
				array("title()","\$str","与list相同","已完成"),
				array("formtitle()","\$str","表单标题","已完成"),
				array("data()","\$array","与list相同","已完成"),
				array("keyText()","\$name,<br/>\$title,<br/>\$subtitle,<br/>\$opt",
					"\$name 与data()相匹配 <br>
					\$title 标题<br>
					\$subtitle 副标题<br>
					\$opt : array('placeholder'=>'提示文字','error'=>'警示文字')
					",
					"已完成"),
				array("keyTime()","\$name,<br>\$title,<br>\$subtitle,<br>\$opt","参数与 keyText() 相同 ,<br>作用: 将data中 时间戳转为 Y-m-d H:i:s","已完成"),
				array("keyRadio()","\$name,<br>\$title,<br>\$subtitle,<br>\$opt","参数与 keyText() 相同 ,<br> \$opt参数 checked 为 array  数组从1 开始  1为默认选中","已完成"),
				array("keyNumber()","\$name,<br>\$title,<br>\$subtitle,<br>\$opt","参数与 keyText() 相同 不过为只能输入数字","已完成"),
				array("keyDisabled()","\$name,<br>\$title,<br>\$subtitle,<br>\$opt","参数与 keyText() 相同 不过不能修改","已完成"),
				array("keyHidden()","\$name,<br>\$title,<br>\$subtitle,<br>\$opt","参数与 keyText() 相同  隐藏不可见的表单的元素","已完成"),
				array("keyTextarea()","\$name,<br>\$title,<br>\$subtitle","参数与 keyText() 相同","已完成"),
				array("keySelect()","\$name,<br>\$title,,<br>\$opt,<br>\$value,<br>\$subtitle","参数与 keyText() 相同,<br>\$opt 为数组<br> \$value 为选中的默认值","已完成"),
				array("keyDisabledStatus()","\$name,<br>\$title,<br>\$subtitle,<br>\$opt,<br>\$value","不可选的select,参数与 keyText() 相同,<br>\$opt 为数组<br> \$value 为选中的默认值","已完成"),
				array("keyUploadImg()","\$name,<br>\$title ='上传图片',<br>\$subtitle,<br>\$btntitle = '上传图片'","上传图片插件","已完成"),
				array("keyUploadFalsh()","\$name,<br>\$title ='上传动画',<br>\$subtitle,<br>\$btntitle = '上传动画'","上传falsh插件","已完成"),
				array("keyShowImg()","\$name","显示图片插件","已完成"),
				array("keySmallEditor()","\$name","富文本编辑器 小的","已完成"),
				array("keyEditor()","\$name","富文本编辑器 大的","已完成"),
				array("keyOnSelect()","\$name,<br> \$title,<br> \$subtitle = null, <br>\$opt,<br>\$value","参数与keySelect相同,<br> 配合keyOnSelectData二级联动<br> 这是一级","已完成"),
				array("keyOnSelectData()","\$name,<br> \$title,<br> \$subtitle = null, <br>\$opt,<br>\$value","参数与keySelect相同,<br> 配合keyOnSelect二级联动
					<br>这是二级","已完成"),
				array("buttonSubmit()","","提交form表单  提交到当前页 post","已完成"),
			)
		);
		$newdata  = array();
		
		$newdata[] = '关于AdminConfigBuilder相关函数以及函数参数';
		$newdata[] = array_merge($thead,$data);
		$Builder
			->otherData($newdata)
			->display("list");
	}

}
?>

