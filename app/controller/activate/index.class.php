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
	function index_action()
	{
		$this->seo("activate");
		$this->yun_tpl(array('index'));
	}
	function sendstr_action()
	{
		if($this->config['user_status']=="1"){
			$username=$this->stringfilter($_POST['username']);

			if(!$this->CheckRegUser($username))
			{
				die;
			}
			$info=$this->obj->DB_select_once("member","`username`='".$username."'","`uid`,`email`,`usertype`");
			if(!empty($info)){
				$fdata=$this->forsend($info);
				$randstr=rand(10000000,99999999);
				$base=base64_encode($info['uid']."|".$randstr."|".$this->config['coding']);
				$data['uid']=$info['uid'];
				$data['name']=$fdata['name'];
				$data['type']="cert";
				$data['email']=$info['email'];
				$data['url']="<a href='".$this->config['sy_weburl']."/index.php?m=qqconnect&c=mcert&id=".$base."'>点击认证</a>";
				$data['date']=date("Y-m-d");
				if($this->config['sy_smtpserver']!="" && $this->config['sy_smtpemail']!="" && $this->config['sy_smtpuser']!=""){
					$this->send_msg_email($data);
					echo 1;die;
				}else{
					echo 3;die;
				}
			}else{
				echo 2;die;
			}
		}else{
			echo 0;die;
		}
	}
}
?>
