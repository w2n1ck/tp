<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $info=D('user a,(select @rownum:=0) b')->field('a.*,(@rownum:=@rownum+1) as rank')->where('is_ban=0 and is_public=1')->order('vote_number desc')->limit(0,10)->select();
        $info=array('info'=>$info);
        $this->assign($info);
        $this->display();

    }

    public function search(){
        check_user_role();
        $start_number=isset($_GET['start_number'])?$_GET['start_number']:0;
        if(isset($_REQUEST['query'])){
            $query=I('POST.query',0,'strip_tags');
            $start_number=I('start_number',0,'intval');
            $info=search($query,$start_number);
            if(!$info){
                $this->error('无结果！',U('index'));
            }
            $previous_number=$start_number==0?0:$start_number-10;
            $next_number=$start_number+10;
            $info2=array('query_previous'=>'query='.$query.'&start_number='.$previous_number,'query_next'=>'query='.$query.'&start_number='.$next_number);
            $info=array('info'=>$info,'info2'=>$info2);
            $this->assign($info);
            $this->display();
            dump($info);
        }


    }


    public function info(){
        $this->display();

    }

    public function vote($uid){
        check_user_role();
        $uid2=I('uid',0,'intval');
        if(vote_user($_SESSION['uid'],$uid2)){
            $this->success('投票成功！',U('index'));
        }else{
           $this->error('您今天已经投过票了，明天再来吧！',U('index'));
        }
    }

    public function donate(){
        header("Location: /tp/pay");
    }


    public function upload(){
            check_user_role();
            user_upload();
    }

    public function love_wall($start_number){
        $start_number=isset($start_number)?$start_number:10;
        $start_number=I('start_number',0,'intval');
        $this->assign(D('message')->where('$is_biaobaiqiang=1')->limit($start_number,10)->select());
        $this->display;

    }

}