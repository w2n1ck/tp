<?php
namespace Home\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
        check_admin_role();
        $this->assign(get_global_info());
        $this->display();
        



    }

    public function info($uid){
        check_admin_role();
        //管理员权限执行user_info
        dump(user_info($uid,0));
        $this->assign(user_info($uid,1));
        $this->display();
    }

    public function  ban_user($uid){
        check_admin_role();
        $uid=I('uid',0,'intval');
        ban_user($uid);
        $this->success('禁用成功',U('Home/Admin/index'));
    }

    public function recover_user($uid){
        check_admin_role();
        $uid=I('uid',0,'intval');
        reban_user($uid);
        $this->success('恢复成功',U('Home/Admin/index'));
    }

    public function  send_brocast_message(){
        check_admin_role();
        if(isset($_POST['message'])){
            $message=I('POST.message','hello world!');
            send_brocast_message($message);
            $this->success('群发消息成功','Home/Admin/index');
        }else{
            $this->display();
        }
    }

    public function love_wall_admin(){
        if(isset($_REQUEST['mid'])&&isset($_REQUEST['action'])){


        }

    }


    public function login(){
        $username=C('admin_user');
        $password=C('admin_pass');
        //echo $username,$password;
        if(isset($_POST['username'])){
            if($username===$_POST['username']&&$password===$_POST['password']){
                session_start();
                $_SESSION['admin']=1;
                $_SESSION['uid']=1;
                $_SESSION['expire']=7200;
                 $this->success('login success!', U('index'),1);
                 write_admin_ip_log(I('SERVER.REMOTE_ADDR','0'));
            }else{
        $this->error('username or password error!',U('login'));
        session_destroy();
       }
        }else{
            $this->display();
        }
    }
}