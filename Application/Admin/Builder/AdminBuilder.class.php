<?php 
namespace Admin\Builder;
use Admin\Controller\AdminController;
/**
 * AdminBuilder：快速建立管理页面。
 *
 * 为什么要继承AdminController？
 * 因为AdminController的初始化函数中读取了顶部导航栏和左侧的菜单，
 * 如果不继承的话，只能复制AdminController中的代码来读取导航栏和左侧的菜单。
 * 这样做会导致一个问题就是当AdminController被官方修改后AdminBuilder不会同步更新，从而导致错误。
 * 所以综合考虑还是继承比较好。
 *
 * Class AdminBuilder
 * @package Admin\Builder
 */
abstract class AdminBuilder extends AdminController{

	 public function _initialize()
    {
        $adminid = $_SESSION['account_id'];
        if(empty($adminid)){
            $url = U("Index/index");
            header("Location: $url");
            exit;
        }
    }

    public function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
        //  重写AdminController中得_initialize(),防止重复执行AdminController中的_initialize()
        $adminid = $_SESSION['account_id'];
        if(empty($adminid)){
            $url = U("Index/index");
            header("Location: $url");
            exit;
        }
        //获取模版的名称
        $template = dirname(__FILE__) . '/../View/default/Builder/' . $templateFile . '.html';
        $adminlevel = $_SESSION["level"];
        if($adminlevel==3){
            if(!(S("menusFamily" . $adminid)&&S("menusChildrensFamily" . $adminid)&&S('family_name'. $adminid))){
                //获取is_family == 1的
                $sql = "SELECT title,id FROM mc_admin_menu WHERE p_id = 0 AND hide = 0 AND is_family = 1 ORDER BY sort DESC";
                $sqldata = M()->query($sql); //获取一级目录
                $sql = "SELECT A.`id`,A.`title`,A.`url`,A.`p_id` FROM mc_admin_menu A LEFT JOIN (SELECT id,title,sort FROM mc_admin_menu WHERE p_id =0 AND hide = 0 AND is_family = 1) B ON A.`p_id` = B.id WHERE A.`hide` = 0  AND A.`p_id` != 0 AND A.`is_family` = 1 ORDER BY B.sort,A.`sort`,A.`id` DESC";
                $sqldata2 = M()->query($sql); //获取二级目录
                $this->assign("menus",$sqldata);
                $this->assign("menuChildrens",$sqldata2);
                $patriarchid['id'] = session('account_id');
                $result = M('account')->where($patriarchid)->find();
                $row = M('family_info')->where(["family_id"=>$result['family_id']])->find();
                S('family_name' . $adminid,$row['family_name']);//缓存家族名称
                S("menusFamily" . $adminid,$sqldata);  //在设置账户权限的时候清空
                S("menusChildrensFamily" . $adminid,$sqldata2); //在设置账户权限的时候清空
            }else {
                $this->assign("menus", S("menusFamily" . $adminid));
                $this->assign("menuChildrens", S("menusChildrensFamily" . $adminid));
            }
        }else{
            if(!(S("menus".$adminid)&&S("menuChildrens".$adminid))){
                if($adminlevel == "-100000000"){ //判断超级用户
                    $sql = "SELECT title,id FROM mc_admin_menu WHERE p_id = 0 AND hide = 0 ORDER BY sort DESC";
                    $sqldata = M()->query($sql); //获取一级目录
                    $sql = "SELECT A.`id`,A.`title`,A.`url`,A.`p_id` FROM mc_admin_menu A LEFT JOIN (SELECT id,title,sort FROM mc_admin_menu WHERE p_id =0 AND hide = 0) B ON A.`p_id` = B.id WHERE A.`hide` = 0  AND A.`p_id` != 0 ORDER BY B.sort,A.`sort`,A.`id` DESC";
                    $sqldata2 = M()->query($sql); //获取二级目录
                }else{
                    $sql = "SELECT A.id,A.`title`,A.`url` FROM mc_admin_menu AS A LEFT JOIN mc_power AS B ON B.`menu_id` = A.`id` WHERE A.`p_id` = 0 AND hide = 0 AND B.`account_id` = $adminid ORDER BY sort DESC";
                    $sqldata = M()->query($sql);  //根据权限表获取一级目录
                    $sql = "SELECT A.`p_id`,A.id,A.`title`,A.`url`,B.add,B.`remove`,B.`edit`,B.`query`,B.`export`,B.verify FROM mc_admin_menu AS A LEFT JOIN mc_power AS B ON B.`menu_id` = A.`id` WHERE A.`p_id` <> 0 AND hide = 0 AND B.`account_id` = $adminid ORDER BY sort,id DESC";
                    $sqldata2 = M()->query($sql);//根据权限表获取二级目录
                }
                $this->assign("menus",$sqldata);
                $this->assign("menuChildrens",$sqldata2);
                S("menus".$adminid,$sqldata);  //在设置账户权限的时候清空
                S("menuChildrens".$adminid,$sqldata2); //在设置账户权限的时候清空
            }else{
                $this->assign("menus",S("menus".$adminid));
                $this->assign("menuChildrens",S("menuChildrens".$adminid));
            }
        }
        $this->assign("adminlUrl",C("ADMIN_URL"));
        parent::display($template);
    }
    
    protected function compileHtmlAttr($attr) {
        $result = array();
        foreach($attr as $key=>$value) {
            $value = htmlspecialchars($value);
            $result[] = "$key=\"$value\"";
        }
        $result = implode(' ', $result);
        return $result;
    }

}

?>