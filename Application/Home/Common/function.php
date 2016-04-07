<?php
require('init_database.php');
include_once('simple_html_dom.php');
function write_admin_ip_log($ip){
	$admin=array(
            'time'=>time(),
			'admin_login_ip'=>$ip,
            );
        D('admin')->add($admin);
        //dump(M('admin')->where("admin_login_ip<>'0'")->select());
}

function query_pass_by_uid($uid){
	return D('user')->field('password')->where(array('uid'=>$uid))->find()['password'];
}

function query_user_exist($uid){
	$username=D('user')->field('username')->where(array('uid'=>$uid))->find()['username'];
	 if($username){
	 	return $username;
	 }
	 return 0;
}

function cas_login($uid,$password){
	return get_student_info($uid,$password);
	
}

function search($query,$start_number){
	return D('user')->field('uid,username,major_class,vote_number,img_url')->where("uid like '%".$query."%' or username like '%".$query."%'")
	->order('vote_number desc')->limit($start_number,10)->select();
}


function check_admin_role(){
	if($_SESSION['admin']==1){
		return 1;
	}else{
		header("Location: ".U('Home/Admin/login'));
		exit();
	}
}

function check_user_role(){
	if(isset($_SESSION['uid'])){
		if(!D('user')->field('is_ban')->where(array('uid'=>$_SESSION['uid']))->find()['is_ban']){
			return 1;
		}else{
			echo("<script>alert('user ".$_SESSION['uid']." have been banned!')</script>");
			exit();
		}
	}else{
		header("Location: ".U('Home/User/login'));
		//echo $_SESSION['uid'];
		exit();
	}
}

function user_info($uid,$pri){
	$uid=array('uid'=>$uid);
	if(D('user')->field('is_public')->where($uid)->find()['is_public']||$pri||$uid['uid']==$_SESSION['uid']){
		return D('user')->where($uid)->find();
	}
	return 0;
}

function user_message($uid){
	$to_uid="to_uid=".$uid." or to_uid=2";
	if($message=D('message')->where($to_uid)->select()){
		return array('message'=>$message,'number'=>count($message));
	}else{
		return array('message'=>NULL,'number'=>0);
	}

}

function get_user_img_number($uid){
	return D('user')->field('img_number')->where(array('uid'=>$uid))->find()['img_number'];
}


function user_upload(){
$error=$_FILES['pic']['error'];
$tmpName=$_FILES['pic']['tmp_name'];
$name=$_FILES['pic']['name'];
$size=$_FILES['pic']['size'];
$type=$_FILES['pic']['type'];
try{
	if($name!=='')
	{
		$name1=substr($name,-4);
		if(($name1!==".gif") and ($name1!==".jpg") and ($name1!==".png"))
		{
			echo "<script language=javascript>alert('wrong file type!');history.go(-1)</script>";
			exit;
		}
		if(is_uploaded_file($tmpName)){
			$img_number=get_user_img_number($uid);
			$img_name=md5($_SESSION['uid'].$img_number);
			$rootpath='./upload/'.$img_name.$name1;
			echo $rootpath;
			if(!move_uploaded_file($tmpName,$rootpath)){
			echo "<script language='JavaScript'>alert('文件移动失败!');</script>";
			exit;
		}
	}
	echo "图片ID：".$time;
	D('user')->where(array('uid'=>$uid))->save(array('img_number'=>$img_number+1));
	}
}
catch(Exception $e)
{
	echo "ERROR";
}
}

function get_global_info(){
	$public=D('public')->find();
	//显示10条普通信息
	$message1=D('message')->order('send_time desc')->where('is_biaobaiqiang=0')->limit(0,10)->select();
	//显示10条表白墙信息
	for ($i=0; $i < count($message1); $i++) { 
		$message1[$i]['send_time']=date('Y/m/d-h:m:s',$message1[$i]['send_time']);
	}
	
	$message2=D('message')->order('send_time desc')->where('is_biaobaiqiang=1')->limit(0,10)->select();
	for ($i=0; $i < count($message2); $i++) { 
		$message2[$i]['send_time']=date('Y/m/d-h:m:s',$message2[$i]['send_time']);
	}
	
	//只获取donate的数量
	$donate_number=D('donate')->field('count(*)')->find();
	return array('public'=>$public,'message1'=>$message1,'message2'=>$message2,'donate'=>$donate_number);
	//return array($public,$message1,$message2,$donate_number);	
}

function write_ip_position(){
	//
	$position_json=json_decode(file_get_contents('./ip.json'));
	$iptable=D('iptable');
	foreach ($position_json as $key => $values) {
		$tmp=array();
		$tmp['up_ip']=$values[0];
		$tmp['down_ip']=$values[1];
		$tmp['position']=$values[2];
		$iptable->add($tmp);
	}
	echo 'done';
}

function get_ip_position(){
	$ip=$_SERVER['REMOTE_ADDR'];
	$ip=implode('',explode('.', $ip));
	$position=D('iptable')->where("up_ip<=".$ip." and down_ip>=".$ip."")->find()['position'];
	if($position){
		return base64_decode($position);
	}else{
		return "secret place";
	}
}


function vote_user($uid1,$uid2){
	$user=D('user');
	$vote_number=$user->field('vote_number')->where(array('uid'=>$uid2))->find()['vote_number'];
	if($user->field('last_vote_time')->where(array('uid'=>$uid1))->find()['last_vote_time']<time()-86400){
		//普通用户一天一票,参与用户一票权重为2
		if($user->field('is_public')->where(array('uid'=>$uid1))->find()['is_public']){
			$vote_number++;	
		}   
		$user->where(array('uid'=>$uid2))->save(array('vote_number'=>$vote_number+1));
		$user->where(array('uid'=>$uid1))->save(array('last_vote_time'=>time()));
		D('public')->save(array('total_vote_number'=>D('public')->field('total_vote_number')->find()['total_vote_number']+1));
		return 1;		
	}elseif($user->field('is_donate')->where(array('uid'=>$uid1))->find()['is_donate']&&$user->field('last_donate_vote_time')->where(array('uid'=>$uid1))->find()['last_donate_vote_time']<time()-86400){
		//donate一次获得一次投票机会,一天限一次
		$user->where(array('uid'=>$uid2))->save(array('vote_number'=>$vote_number+1));   
		$user->where(array('uid'=>$uid1))->save(array('last_donate_vote_time'=>time()));
		$user->where(array('uid'=>$uid1))->save(array('is_donate'=>0));
		D('public')->save(array('total_vote_number'=>D('public')->field('total_vote_number')->find()['total_vote_number']+1));
		return 1;
	}
	return 0;

}

function update_user_info($uid,$field,$value){
	$uid=array('uid'=>$uid);
	D('user')->where($uid)->save(array($filed=>$value));
}

function ban_user($uid){
	$uid=array('uid'=>$uid);
	D('user')->where($uid)->save(array('is_ban'=>1));
}

function reban_user($uid){
	$uid=array('uid'=>$uid);
	D('user')->where($uid)->save(array('is_ban'=>0));
}

function require_https_url($aim_url, $ispost = 0, $require_header = 1, $returntransfer = 1, $cookie, $add_header = array(), $post_data = "", $encoding = "gzip"){
    /*
    参数说明：
        $aim_url:       请求的目的网址
        $ispost:        留空或值为false时，为get请求当值为true的时候，表示此请求为post请求
        $require_header:是否请求header，**注意，目前全部请求header
        $returntransfer:true表示在请求完网页后是返回请求到的文本数据，false表示直接跳转请求的url
        $cookie:        在header中添加cookie
        $add_header:    当需要特殊的头部格式时可自行添加，eg.浏览器UA，http的安全升级
        $post_data:     当请求为post类型的时候，这里用来添加post内容，格式为string
        $encoding:      请求的编码方式，eg.gzip
    */
    $timeout = 600; 
    $require_header = 1;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $aim_url);
    curl_setopt($curl, CURLOPT_POST, $ispost);
    if($ispost){curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);}
    curl_setopt($curl, CURLOPT_HTTPHEADER, $add_header);
    curl_setopt($curl, CURLOPT_HEADER, $require_header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, $returntransfer);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。https请求 不验证证书和hosts,其实主要是传输层不同，在其他地方处理起来和http请求没什么不同
    //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout); 
    curl_setopt($curl, CURLOPT_ENCODING, $encoding);
    $data = curl_exec($curl);
    //错误控制
    if($data == false){
    	//用户名或者密码错误
        return array(false,false);
    }
    $info = curl_getinfo($curl);
    if (in_array('200', array(200, 302, 301),false)) {
        list($header, $body) = explode("\r\n\r\n", $data, 2);
    }
    curl_close($curl);

    return array($header, $body);
}



function get_student_info($username, $password){
	try{
        $t1 = microtime(true);

        $url="https://login.bit.edu.cn/cas/login?service=http://online.bit.edu.cn/leaving/shiro-cas";
        $return_data = require_https_url($url);
        $body_dom = str_get_html($return_data[1]);
        $cookie = (explode("; ", explode(": ", array_slice(explode("\r\n", $return_data[0]),-2,1)[0], 2)[1], 2)[0]);

        $ticket1 = $body_dom->find('input')[4]->attr['value'];
        $body_dom->clear();//release resouces

        $post_data = "username=".$username."&password=".$password."&lt=".$ticket1."&execution=e1s1&_eventId=submit&rmShown=1";
        $add_header_array = array('User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36');

        $re_data2 = require_https_url($url, 1, 1, 1, $cookie, $add_header_array, $post_data);
        $re_header_array = explode("\r\n", $re_data2[0]);

        $jump_url = substr($re_header_array[7], 10);
        $jump_data = require_https_url($jump_url);

        $jump_header_array = explode("\r\n", $jump_data[0]);
        $final_url = substr($jump_header_array[5], 10);

        $img_start_time = microtime(true);
        $img_page_cookie = substr($jump_header_array[5], 43);
        $img_raw_url = "http://online.bit.edu.cn/leaving/dashboard/student";
        $img_page_data = require_https_url($img_raw_url.$img_page_cookie);
        $img_page_body_dom = str_get_html($img_page_data[1]);
         if(!$img_page_body_dom){return array();};
        $img_source = $img_page_body_dom->find('img')[0]->attr['src'];
        $img_end_time = microtime(true);

        $final_data = require_https_url($final_url);
        $final_body_dom = str_get_html($final_data[1]);
        $name = $final_body_dom->find('.widget-body-inner')[0]->children[0]->children[0]->nodes[0]->_[4];
        $student_id = $final_body_dom->find('.widget-body-inner')[0]->children[0]->children[1]->nodes[0]->_[4];
        $campus = $final_body_dom->find('.widget-body-inner')[0]->children[0]->children[2]->nodes[0]->_[4];
        $final_body_dom->clear();


        /* //output
        dump(array($name, $student_id, $campus, $img_source));
        echo "<img src='".$img_source."' width='150' />";

        $t2 = microtime(true);
        echo "<br/>本网页执行耗时：".round($t2-$t1,3)." 秒。";
        echo "<br/>图片加载耗时：".round($img_end_time-$img_start_time, 3)."秒。";
        */
        return array("uid"=>substr($name, 9), "username"=>substr($student_id,9), "major_class"=>substr($campus,9), "img_url"=>$img_source,"password"=>md5($password));
    }
    catch(Think\Exception $e){
    	return array();
    	//echo $e;
    }

    }





