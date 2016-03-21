<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	//add_user('');
    	check_user_role();
    	dump(D('user')->field('vote_number')->where('uid=1120131205')->order()->select()[0]);
    	echo "hello world";

    }

    public function test(){
    	//cas_login('1120131205','200214');
        //write_ip_position();
        echo get_ip_position();

    }
    public function info($uid){
    	$uid=I('uid',0,'intval');
    	check_user_role();
    	//普通用户权限执行user_info
    	dump(user_info($uid,0));
    	if($info=user_info($uid,0)){
    		$this->assign($info);
    		$this->display();
    	}else{
    		$this->error('你没有权限访问该用户的信息',U('Home/User/index'));
    	}

    }

    public function login(){
    	if(isset($_POST['uid'])&&isset($_POST['password'])){
        	$uid=I('POST.uid',0,'intval');
        	$password=I('POST.password',0);
        	if(!query_user_exist($uid)){
        		$info=cas_login($uid,$password);
        		insert_user_info($info);
        	}
        	if(md5($password)===query_pass_by_uid($uid)){
                session_start();
                $_SESSION['uid']=$uid;
                $_SESSION['expire']=7200;
                //session(array('uid'=>$uid,'expire'=>7200));？？？为什么这个使用不了？？？
                $this->success('login success!'.session('uid'), U('index'),1);
            }
           $this->error('username or password error!',U('login'));
           session_destroy();
        }else{
            $this->display();
        }

    }

}