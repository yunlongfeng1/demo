<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _initialize(){
		
		if(!$_SESSION['uid'] && (ACTION_NAME != 'login' && ACTION_NAME != 'logining' && ACTION_NAME != 'Verify')){
			$this->Error("您还没有登录或者登录过期",U('login'));
		}
	}
	//首页
    public function index(){
    	
        $this->display();
    }

    public function logining(){
    	//print_r($_POST);
    	if(empty($_POST['username'])){
    		$this->Error("用户名不对",U("login",array("rand"=>rand(10000,99999))));
    	}
    	if(empty($_POST['passwordhash'])){
    		$this->Error("密码不对");
    	}
    	if(empty($_POST['j_captcha'])){
    		$this->Error("验证码不对",U("login",array("rand"=>rand(10000,99999))));
    	}

         $verify = new \Think\Verify();
         if(!$verify->check($_POST['j_captcha'])){
            $this->Error("验证码不对",U("login",array("rand"=>rand(10000,99999))));
         }
    	$username = $_POST['username'];
    	$password = $_POST['passwordhash'];
    	$user = D("user")->where(array("username"=>$username))->find();
    	$_SESSION['nickname'] = $user['nickname'];
    	$_SESSION['uid'] = $user['id'];
    	//print_r($_SESSION);
    	if(empty($user)){
    		$this->Error("用户名或者密码不对",U("login",array("rand"=>rand(10000,99999))));
    	}
    	if($user['password'] != pwd($password)){
    		$this->Error("用户名或者密码不对",U("login",array("rand"=>rand(10000,99999))));
    	}
    	header("Location:".U("index"));
    }
     
     //登陆
     public function login(){
     	// $ss = D("message")->select();
     	// foreach ($ss as $key => $value) {

     	// 	unset($value['id']);
     	// 	$value['name'] = rand(1000,9999).$value['name'];
     	// 	$data[] = $value;
     		
     	// }
     	// D("message")->addAll($data);
     	// exit;

     	// $ss = D("user")->select();
     	// foreach ($ss as $key => $value) {

     	// 	unset($value['id']);
     	// 	$value['nickname'] = $value['username'] = rand(1000,9999).$value['username'];
     	// 	$data[] = $value;
     		
     	// }
     	// D("user")->addAll($data);
     	// exit;
        $this->display();
    }

    public function table(){
    	//关注商品
    	if($_POST['zhongdian']){
    		$where['zhongdian'] = (int)$_POST['zhongdian'];
    	}
    	//面积
    	if($_POST['mianji']){
    		$where['mianji'] = (int)$_POST['mianji'];
    	}
    	//职业顾问
    	if($_POST['zhiye']){
    		$where['zhiye'] = (int)$_POST['zhiye'];
    	}

    	//职业
    	if($_POST['zhiye1']){
    		$where['zhiye1'] = I("post.zhiye1");
    	}
    	
    	if($_POST['danwei']){
    		$where['danwei'] = (int)$_POST['danwei'];
    	}
    	
    	if($_POST['juzhu']){
    		$where['juzhu'] = (int)$_POST['juzhu'];
    	}

        $selectT = array("1"=>"tel",'2'=>"name","3"=>"shenfenzheng");
        if($_POST['selsecType'] && $_POST['selsecTypeValue'] && $selectT[$_POST['selsecType']]){
            $where[$selectT[$_POST['selsecType']]] = I("post.selsecTypeValue",'');
        }
   
    	$pageSize = (int)$_POST['pageSize']?(int)$_POST['pageSize']:30;
    	$pageid = (int)$_POST['pageCurrent'];
    	$where['status'] = 1;
    	$count = D("message")->where($where)->count();
    	$list = D("message")->where($where)->page("$pageid,$pageSize")->order("id desc")->select();
    	if($_SESSION['uid'] != 1){
    		foreach($list as &$v){
    			$v['name'] = "*";
    			$v['tel'] = "*";
    			$v['shenfenzheng'] = "*";
    		}
    	}
    	//print_r($list);
    	$this->assign("list",$list);
    	$this->assign("count",$count);
    	$this->display();
    }

    //添加信息
    public function ajaxDone1(){
        $_POST['createtime'] = date("Y-m-d H:i:s");
    	if(D("message")->add($_POST)){
    		$arr = array(
	    		'statusCode'=>200,
	    		'message'=>"操作成功",
	    	);
    	}else{
    		$arr = array(
	    		'statusCode'=>300,
	    		'message'=>"操作失败",
	    	);
    	}
    	
    	echo json_encode($arr);
    }

    //
    public function updatepwd(){
    	
    	$oldpassword = I("post.oldpassword");
    	if($_POST['password'] !== $_POST['password2']){
    		echo json_encode(array("statusCode"=>300,"message"=>"两次新密码不正确"));exit;
    	}

    	$user = D("user")->where(array("id"=>$_SESSION['uid'],"password"=>pwd($oldpassword)))->find();
    	if(!$user){
    		echo json_encode(array("statusCode"=>300,"message"=>"密码不正确"));exit;
    	}
    	$data = array(
    		
    		'password'=>pwd(I("post.password")),
    	);
    	if(D("user")->where(array("id"=>$user['id']))->save($data)){
    		echo json_encode(array("statusCode"=>200,"message"=>"操作成功"));exit;
    	}else{
    		echo json_encode(array("statusCode"=>300,"message"=>"操作失败"));exit;
    	}
    }

    public function del(){
    	$id = I("get.id","0","intval");
    	if($_SESSION['uid'] != 1){
    		echo json_encode(array("statusCode"=>300,"message"=>"用户权限不够"));exit;
    	}

    	if(D("message")->where(array("id"=>$id))->save(array("status"=>0))){
    		echo json_encode(array("statusCode"=>200,"message"=>"删除成功"));exit;
    	}else{
    		echo json_encode(array("statusCode"=>300,"message"=>"删除失败"));exit;
    	}

    }


    public function user(){
    	$username = I("post.username");
    	$where[] = "1 = 1";
    	if($username){
    		$where['username'] = $username;
    	}
    	$pageid = (int)$_POST['pageCurrent'];
    	$pageSize = (int)$_POST['pageSize']?(int)$_POST['pageSize']:30;
    	$count = D("user")->where($where)->count();
    	$list = D("user")->where($where)->page("$pageid,$pageSize")->order("id desc")->select();
    	$this->assign("list",$list);
    	$this->assign("count",$count);
    	$this->display();
    }

    public function userdel(){
    	$id = I("get.id","0","intval");
    	if($_SESSION['uid'] != 1){
    		echo json_encode(array("statusCode"=>300,"message"=>"用户权限不够"));exit;
    	}

    	if($id ==1){
    		echo json_encode(array("statusCode"=>300,"message"=>"当前用户为管理员不能删除"));exit;
    	}

    	if(D("user")->where(array("id"=>$id))->delete()){
    		echo json_encode(array("statusCode"=>200,"message"=>"删除成功"));exit;
    	}else{
    		echo json_encode(array("statusCode"=>300,"message"=>"删除失败"));exit;
    	}
    }

    public function adduser(){
    	if($_SESSION['uid'] != 1){
    		echo json_encode(array("statusCode"=>300,"message"=>"用户权限不够"));exit;
    	}

    	$username = I("post.username",'');
    	$nickname = I("post.nickname",'');
    	if(empty($username) && empty($nickname)){
    		echo json_encode(array("statusCode"=>300,"message"=>"添加信息不全"));exit;
    	}
    	$data = array(
    		'username'=>$username,
    		'nickname'=>$nickname,
    		'password'=>pwd('123456')
    	);
    	if(D("user")->add($data)){
    		echo json_encode(array("statusCode"=>200,"message"=>"添加成功"));exit;
    	}else{
    		echo json_encode(array("statusCode"=>300,"message"=>"添加失败"));exit;
    	}
    }

    public function  Verify(){
        $Verify = new \Think\Verify();
        $Verify->length   = 4;
        $Verify->entry();
    }
}