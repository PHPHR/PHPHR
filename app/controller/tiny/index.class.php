<?php
/*
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
 */
class index_controller extends common{
	function index_action(){
		session_start();
		if($this->config['sy_tiny_web']=="2"){
			header("location:".Url('error'));
		}
		if($_GET['keyword']=='请输入简历关键字，例如：会计'){
			$_GET['keyword']='';
		}
		$M=$this->MODEL('tiny');
		$ip = fun_ip_get();
		$s_time=strtotime(date('Y-m-d 00:00:00')); 
		$m_tiny=$M->GetTinyresumeNum(array('login_ip'=>$ip,'`time`>\''.$s_time.'\''));
		$num=$this->config['sy_tiny']-$m_tiny;

        $CacheM=$this->MODEL('cache');
		$CacheList=$CacheM->GetCache(array('user'));
        $this->yunset($CacheList);
		if($_POST['submit']){
			$id=(int)$_POST['id'];
			$authcode=md5($_POST['authcode']);
			$password=md5($_POST['password']);
			unset($_POST['authcode']);
			unset($_POST['password']);
			unset($_POST['submit']);
			unset($_POST['id']);
			$_POST['status']=$this->config['user_wjl'];
			$_POST['login_ip']=$ip;
			$_POST['time']=time();
			$_POST['qq']=$_POST['qq'];

			if($id!=""){
				$arr=$M->GetTinyresumeOne(array('id'=>$id,'password'=>$password));
				if(empty($arr)){
					$this->ACT_layer_msg("密码不正确",8,$_SERVER['HTTP_REFERER']);
				}
				$M->UpdateTinyresume($_POST,array('id'=>$id));
				if($this->config['user_wjl']=="0"){$msg="修改成功，等待审核！";}else{$msg="修改成功!";}
			}else{
				if($authcode!=$_SESSION['authcode']){
					unset($_SESSION['authcode']);
					$this->ACT_layer_msg($_POST['authcode']."验证码错误！".$_SESSION['authcode'],8,$_SERVER['HTTP_REFERER']);
				}
				$_POST['password']=$password;
				if($this->config['sy_tiny']=="0"){
					$M->AddTinyresume($_POST);
					if($this->config['user_wjl']=="0"){$msg="发布成功，等待审核！";}else{$msg="发布成功!";}
				}else{
					if($num){
						$M->AddTinyresume($_POST);
						if($this->config['user_wjl']=="0"){$msg="发布成功，等待审核！";}else{$msg="发布成功!";}
					}else{
	                    $this->ACT_layer_msg("一天内只能发布".$this->config['sy_tiny']."次！",8,$_SERVER['HTTP_REFERER']);
					}
				}
			}
			$this->ACT_layer_msg($msg,9,$_SERVER['HTTP_REFERER']);
		}
		 
		$this->seo("tiny"); 
		$this->yunset("num",$num);
		$this->yunset("ip",$ip);
		$add_time=array("7"=>"一周以内","15"=>"半个月","30"=>"一个月","60"=>"两个月","180"=>"半年","365"=>"一年","0"=>"不限");
		$this->yunset("add_time",$add_time);
		global $ModuleName;
        $this->m=$ModuleName;
		$this->yun_tpl(array('index'));
	}
	function ajax_action(){
		 session_start();
		if(md5($_POST['code'])!=$_SESSION['authcode']){
			unset($_SESSION['authcode']);
			echo 1;die;
		}
		$M=$this->MODEL('tiny');
		$jobinfo=$M->GetTinyresumeOne(array('id'=>(int)$_POST['tid'],'password'=>md5($_POST['pw'])));
		if(!is_array($jobinfo) || empty($jobinfo)){
			echo 2;die;
		}
		if($_POST['type']==1){
			$M->UpdateTinyresume(array('time'=>time()),array('id'=>(int)$jobinfo['id']));
			echo 3;die;
		}elseif($_POST['type']==3){
			$M->DeleteTinyresume(array('id'=>(int)$jobinfo['id']));
			echo 4;die;
		}else{
            $CacheM=$this->MODEL('cache');
            $UserData=$CacheM->GetCache(array('user'));
            $this->yunset($UserData);
            $jobinfo=array_merge($jobinfo,array('username'=>yun_iconv("gbk","utf-8",$jobinfo['username']),'job'=>yun_iconv("gbk","utf-8",$jobinfo['job']),'production'=>yun_iconv("gbk","utf-8",$jobinfo['production'])));
			echo json_encode($jobinfo);die;
		}
	}
	function show_action(){
        $CacheM=$this->MODEL('cache');
        $UserData=$CacheM->GetCache(array('user'));
        $this->yunset($UserData);
		if(isset($_GET['id'])){
			$id=(int)$_GET['id'];
			$M=$this->MODEL('tiny');
		    $M->UpdateTinyresume(array("`hits`=`hits`+1"),array('id'=>$id));
            $t_info=$M->GetTinyresumeOne(array('id'=>$id));
		}
		$this->data=array('tiny_username'=>$t_info['username'],'tiny_job'=>$t_info['job'],'tiny_desc'=>$t_info['production']);
		$this->seo('tiny_cont');
		$this->yunset('t_info',$t_info);
		$this->yunset('ip',fun_ip_get());
		$this->yun_tpl(array('show'));
	}
}
?>
