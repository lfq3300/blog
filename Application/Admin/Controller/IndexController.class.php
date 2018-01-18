<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller{
	public function index($r = 50){
        session('account',NULL);
        session('account_id',NULL);
        session('level',NULL);
        $this->display();
	}
	public  function  setAdminRoot(){
		$this->display();
	}

	public  function  fountAdminRoot(){
        if(M("account")->where(array("level"=>"-100000000"))->count()>0){
            return returnJson("0","已存在root账户");
        }else{
            $map['account'] = I('post.account');
            $map['password'] = I('post.password');
            $model = D("Account");
            $ret = $model->fountAdminRoot($map);
            if ($ret){
            	$data = M("account")->where($map)->find();
                session('account', $data["account"]);
                session('account_id', $data["id"]);
                session('level', $ret["level"]);
                returnJson(1);
			}else{
                returnJson(1,$model->getError());
			}
		}
	}
	public function login(){
		$map['account'] = I('post.account');
		$map['password'] = I('post.password');
		$ret = M("account")->where($map)->find();
        if(empty($ret)){
            returnJson("0","账号或密码错误");
        }else  if($ret["status"] == 0){
            returnJson("0","该账户存在异常,已禁止登录");
		}else{
            session('account', $ret["account"]);
            session('account_id', $ret["id"]);
            session('level', $ret["level"]);
            returnJson(1);
        }
	}

	public function exitlogin(){
        session('account',NULL);
        session('account_id',NULL);
        session('level',NULL);
        $url = U("Index/index");
        header("Location: $url");
	}

//	public  function  text()
//    {
//        $sql  = fopen("ab.sql", "w");
//        $password = fopen("password.txt", "r");
//        $account = fopen("account.txt", "r");
//        $user= "";
//        $i=0;
//        while(! feof(password))
//        {
//           if($i>264317){
//                break;
//           }else{
//               $account_s = trim(fgets($account));
//               $last = rand(1000,9999);
//               $psd = md5(trim(fgets($password)).$last);
//               fwrite($sql,"INSERT INTO `mc_user` (`login_salt`,`username`,`sex`,`account`,`password`,`unionid`) VALUES ('$last','$account_s','0','$account_s','$psd','464512598');");
//           }
//            $i++;
//        }
//        fclose($password);
//        fclose($sql);
//        fclose($account);
//        print_r($user);
//    }


	public  function  menuIndex(){
        session('pid', I('post.pid'));
        session('cid', I('post.cid'));
        returnJson(1);
	}
}
?>
