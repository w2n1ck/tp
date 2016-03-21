<?php
namespace admin_log\Controller;
use Think\Controller;
class IndexController extends Controller {
        public function index(){
        $this->display();
        $username=C('admin_user');
    	$password=C('admin_pass');
    	//echo $username,$password;
    	if(isset($_POST['username'])){
    		if($username===$_POST['username']&&$password===$_POST['password']){
    			session_start();
    			$_SESSION['admin']=1;
    			header("Location: admin.php");
    		}
    		echo "username or password error!";
    	}
    }
}