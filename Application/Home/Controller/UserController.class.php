<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	//add_user('');
    	check_user_role();
        //$this->assign(user_info($_SESSION['uid'],0));
        //$this->assign(user_message($_SESSION['uid']));
    	//dump(D('user')->field('vote_number')->where('uid=1120131205')->order()->select()[0]);
    	//echo "hello world";
        //$this->display();
        dump(user_info($_SESSION['uid'],0));
    }

    public function test(){
    	//cas_login('1120131205','200214');
        //write_ip_position();
        //echo get_ip_position();
        //init_database();
        dump(cas_login('1120131219','212232'));

    }

    public function logout(){
        session_destroy();
        $this->success('注销成功！',U('/home/index'));

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

    public function send_message(){
        check_user_role();
        if(isset($_POST['biaobaiqiang'])&&isset($_POST['to_uid'])&&isset($_POST['message']))
        {
            $is_biaobaiqiang=$_POST['biaobaiqiang']?1:0;
            $to_uid=I('POST.to_uid',0,'intval');
            //普通用户没有广播权限
            if($to_uid==2&&$_SESSION['uid']!=1){
                exit();
            }
            $message=I('POST.message','','strip_tags');
            $message=array('is_biaobaiqiang'=>$is_biaobaiqiang,'to_uid'=>$to_uid,'from_id'=>$_SESSION['uid'],'message'=>$message,
                    'send_time'=>time());
            D('message')->add($message);
            $this->success('发送成功！',U('index'));
        }else{
             $this->success('发送失败！',U('index'));
        }

    }

    //普通用户的contact_us和管理员的broardcast 可以直接复用send_message() 
/*
    public function contact_us(){
        check_user_role();
        if(isset($_POST['message'])){
            $is_biaobaiqiang=0;
            //管理员uid为1，无效时uid为0,广播uid为2
            $to_uid=1;
            $message=I('POST.message','','strip_tags');
            $message=array('is_biaobaiqiang'=>$is_biaobaiqiang,'to_uid'=>$to_uid,'from_id'=>$_SESSION['uid'],'message'=>$message,
                    'send_time'=>time())
            D('message')->add($message);
            $this->success('发送成功！',U('index'));
        }else{
             $this->success('发送失败！',U('index'));
        }
    }

*/



    public function login(){
    	if(isset($_POST['uid'])&&isset($_POST['password'])){
        	$uid=I('POST.uid',0,'intval');
        	$password=I('POST.password',0);
        	if(!query_user_exist($uid)){
        		$info=cas_login($uid,$password);
                if(!$info){
                     $this->error('cas login failed!',U('login'));
                }
        		D('user')->add($info);
        	}
            $info=user_info($uid,1);
        	if(md5($password)===$info['password']){
                session_start();
                $_SESSION['uid']=$uid;
                $_SESSION['username']=$uid;
                $_SESSION['position']=get_ip_position();
                $_SESSION['expire']=7200;
                //session(array('uid'=>$uid,'expire'=>7200));？？？为什么这个使用不了？？？
                $this->success('login success!'.session('uid'), U('index'),1);
            }else{
                $this->error('username or password error!',U('login'));
                session_destroy();
            }
        }else{
            $this->display();
        }

    }

}