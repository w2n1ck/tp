<?php
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
	 if(D('user')->field('password')->where(array('uid'=>$uid))->find()){
	 	return 1;
	 }
	 return 0;
}

function cas_login($uid,$password){
	
	
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
		if(D('user')->field('is_ban')->where(array('uid'=>$uid))->find()['is_ban']){
			return 1;
		}else{
			echo("<script>alert('you have been banned!')</script>");
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

function get_global_info(){
	$public=D('public')->find();
	//显示10条普通信息
	$message1=D('message')->order('send_time desc')->where('is_biaobaiqiang=0')->limit(0,10)->select();
	//显示10条表白墙信息
	$message2=D('message')->order('send_time desc')->where('is_biaobaiqiang=1')->limit(0,10)->select();
	//只获取donate的数量
	$donate_number=D('donate')->field('count(*)')->find();
	return array($public,$message1,$message2,$donate_number);
}

function write_ip_position(){
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

function add_user($user_info){
	   	$user1=array(
    		'uid'  =>'1120131203',
    		'username' =>'haozigege',
    		'password' =>md5('200214'),
			'img_url' =>'http://api.info.bit.edu.cn/pub/registeredPerson/v1/showPhoto?uuid=dd37db10-27b8-4ee7-835b-cb9e9c555144',
			'vote_number' =>'10',
			'phone' =>'13041204042',
			'last_vote_time' => '144444444',
			'last_donate_vote_time'=>'14444444',
			'class'=>'111111',
			'major'=>'111112',
			'qq'=>'aaaaaaa',
			'wetchat'=>'bbbbbb',
			'other_info'=>'',
			'last_biaobaiqiang_time'=>'14444444',
			'is_ban'=>0,
			'is_public'=>1,
			'is_female'=>1
			);
	   	D('user')->add($user1);
	   		 $user2=array(
    		'uid'  =>'1120131204',
    		'username' =>'haozigege',
    		'password' =>md5('200214'),
			'img_url' =>'http://api.info.bit.edu.cn/pub/registeredPerson/v1/showPhoto?uuid=dd37db10-27b8-4ee7-835b-cb9e9c555144',
			'vote_number' =>'100',
			'phone' =>'13041204042',
			'last_vote_time' => '144444444',
			'last_donate_vote_time'=>'14444444',
			'class'=>'111111',
			'major'=>'111112',
			'qq'=>'aaaaaaa',
			'wetchat'=>'bbbbbb',
			'other_info'=>'',
			'last_biaobaiqiang_time'=>'14444444',
			'is_ban'=>0,
			'is_public'=>1,
			'is_female'=>1
			);
    	D('user')->add($user2);
    }


