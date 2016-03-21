<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $array=D('user')->where('is_ban=0 and is_public=1')->order('vote_number desc')->limit(0,10)->select();
        $info=array(
            'no_1'=>$array[0],
            'no_2'=>$array[1],
            'no_3'=>$array[2],
            'no_4'=>$array[3],
            'no_5'=>$array[4],
            'no_6'=>$array[5],
            'no_7'=>$array[6],
            'no_8'=>$array[7],
            'no_9'=>$array[8],
            'no_10'=>$array[9],
            );
        $this->assign($info);
        $this->display();

    }

    public function search($query){
        $query=I('$query',0,'strip_tags');
        $info=search($query);
        $this->assign($info);
        $this->display();

    }

    public function vote($uid){
        check_user_role();
        $uid2=I('uid',0,'intval');
        if(vote_user($_SESSION['uid'],$uid2)){
            echo "<script>alert('vote success!')</script>";
        }else{
            echo "<script>alert('you have voted today!')</script>";
        }
    }

    public function donate(){

    }

}