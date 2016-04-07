<?php
function init_database($user_info){
	//user add
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
    		$user3=array(
    		'uid'  =>'1120131205',
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
	   	D('user')->add($user3);
	   	$user4=array(
    		'uid'  =>'1120131206',
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
	   	D('user')->add($user4);
	   	$user5=array(
    		'uid'  =>'1120131207',
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
	   	D('user')->add($user5);
//message add
	   	$message1=array(
	   		'mid'=>'1',
	   		'from_uid'=>'1120131205',
	   		'to_uid'=>'1120131204',
	   		'message'=>'hello world1',
	   		'send_time'=>'144444444',
	   		'is_biaobaiqiang'=>0,
	   		);
	   	D('message')->add($message1);
	   	$message2=array(
	   		'mid'=>'2',
	   		'from_uid'=>'1120131204',
	   		'to_uid'=>'1120131203',
	   		'message'=>'hello world2',
	   		'send_time'=>'144444444',
	   		'is_biaobaiqiang'=>0,
	   		);
	   	D('message')->add($message2);
	   	$message3=array(
	   		'mid'=>'3',
	   		'from_uid'=>'1120131205',
	   		'to_uid'=>'1120131203',
	   		'message'=>'hello world3',
	   		'send_time'=>'144444444',
	   		'is_biaobaiqiang'=>0,
	   		);
	   	D('message')->add($message3);
	   	$message4=array(
	   		'mid'=>'4',
	   		'from_uid'=>'1120131204',
	   		'to_uid'=>'1120131205',
	   		'message'=>'hello world4',
	   		'send_time'=>'144444444',
	   		'is_biaobaiqiang'=>0,
	   		);
	   	D('message')->add($message4);
	   	$message5=array(
	   		'mid'=>'5',
	   		'from_uid'=>'1120131203',
	   		'to_uid'=>'1120131205',
	   		'message'=>'hello world5',
	   		'send_time'=>'144444444',
	   		'is_biaobaiqiang'=>0,
	   		);
	   	D('message')->add($message5);

    }
?>