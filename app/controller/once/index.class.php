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
		if($this->config['sy_wzp_web']=="2"){
			header("location:".Url('error'));
		}
		if($_GET['keyword']=='请输入要搜索的关键字'){
			$_GET['keyword']='';
		}
		$M=$this->MODEL('once');
		$ip=fun_ip_get();
		$start_time=strtotime(date('Y-m-d 00:00:00'));
		$mess=$M->GetOncejobNum(array('login_ip'=>$ip,'`ctime`>\''.$start_time.'\''));
		$num=$this->config['sy_once']-$mess;
		$this->yunset("num",$num);
		if($_POST['submit']){
            session_start();
			$authcode=md5($_POST['authcode']);
			$password=md5($_POST['password']);
			$id=(int)$_POST['id'];
			$submit=$_POST['submit'];
			unset($_POST['authcode']);
			unset($_POST['password']);
			unset($_POST['submit']);
			unset($_POST['id']);
			$_POST['status']=$this->config['com_fast_status'];
			$_POST['login_ip']=$ip;
			$_POST['ctime']=time();
			$_POST['edate']=strtotime("+".(int)$_POST['edate']." days");
			if($id!=""){
				$arr=$M->GetOncejobOne(array('id'=>$id,'password'=>$password));
				if(empty($arr)){
					$this->ACT_layer_msg("密码不正确",8,$_SERVER['HTTP_REFERER']);
				}
                $M->UpdateOncejob($_POST,array('id'=>$id));
				if($this->config['com_fast_status']=="0"){$msg="修改成功，等待审核！";}else{$msg="修改成功!";}
			}else{
				if(strstr($this->config['code_web'],'一句话招聘')){
					if($authcode!=$_SESSION['authcode']){
						unset($_SESSION['authcode']);
						$this->ACT_layer_msg("验证码错误！",8);
					}
				}
				$_POST['password']=$password;

				if($this->config['sy_once']=="0"){
                    $M->AddOncejob($_POST);
				    if($this->config['com_fast_status']=="0"){$msg="发布成功，等待审核！";}else{$msg="发布成功!";}
				}else{
					if($num){
                        $M->AddOncejob($_POST);
					    if($this->config['com_fast_status']=="0"){$msg="发布成功，等待审核！";}else{$msg="发布成功!";}
					}else{
                        $this->ACT_layer_msg("一天内只能发布".$this->config['sy_once']."次！",8,$_SERVER['HTTP_REFERER']);
					}
				}
			}
			$this->ACT_layer_msg($msg,9,$_SERVER['HTTP_REFERER']);
		}
		if($_GET['id']){
			$onceinfo=$M->GetOncejobOne(array('id'=>(int)$_GET['id']));
			if(!empty($onceinfo)){
                $onceinfo=array_merge($onceinfo,array('title'=>yun_iconv("gbk","utf-8",$onceinfo["title"]),'companyname'=>yun_iconv("gbk","utf-8",$onceinfo["companyname"]),'linkman'=>yun_iconv("gbk","utf-8",$onceinfo["linkman"]),'address'=>yun_iconv("gbk","utf-8",$onceinfo["address"]),'require'=>yun_iconv("gbk","utf-8",$onceinfo["require"]),'edate'=>ceil(($onceinfo['edate']-mktime())/86400)));
				echo json_encode($onceinfo);die;
			}
			$this->yunset('once_id',$_GET['id']);
		}
		$this->seo("once");
		$this->yunset("ip",$ip);
		$this->yun_tpl(array('index'));
	}
	function ajax_action(){
        session_start();
		if(md5($_POST['code'])!=$_SESSION['authcode']){
			unset($_SESSION['authcode']);
			echo 1;die;
		}
		$M=$this->MODEL('once');
		$jobinfo=$M->GetOncejobOne(array('id'=>(int)$_POST['tid'],'password'=>md5($_POST['pw'])));
		if(!is_array($jobinfo) || empty($jobinfo)){
			echo 2;die;
		}
		if($_POST['type']==1){
            $M->UpdateOncejob(array('ctime'=>time()),array('id'=>(int)$jobinfo['id']));
			echo 3;die;
		}elseif($_POST['type']==3){
			$M->DeleteOncejob(array('id'=>(int)$jobinfo['id']));
			echo 4;die;
		}else{
			if($jobinfo['edate']>mktime()){
				$jobinfo['edate']=ceil(($jobinfo['edate']-mktime())/86400);
			}else{
				$jobinfo['edate']=yun_iconv("gbk","utf-8","已过期");
			}
            $jobinfo=array_merge($jobinfo,array('title'=>yun_iconv('gbk','utf-8',$jobinfo['title']),'companyname'=>yun_iconv('gbk','utf-8',$jobinfo['companyname']),'linkman'=>yun_iconv('gbk','utf-8',$jobinfo['linkman']),'address'=>yun_iconv('gbk','utf-8',$jobinfo['address']),'require'=>yun_iconv('gbk','utf-8',$jobinfo['require'])));
			echo json_encode($jobinfo);die;
		}
	}
	function show_action(){
		if(isset($_GET['id'])){
		   $id=(int)$_GET['id'];
		   $M=$this->MODEL('once');
		   $M->UpdateOncejob(array("`hits`=`hits`+1"),array('id'=>$id));
           $o_info=$M->GetOncejobOne(array('id'=>$id));
		}
		$ip=fun_ip_get();
		$this->yunset("ip",$ip);
		$this->yunset('o_info',$o_info);
		$data['once_job']=$o_info['title'];
		$data['once_name']=$o_info['companyname'];
		$description=$o_info['require'];
		$data['once_desc']=$this->GET_content_desc($description);
		$this->data=$data;
		$this->seo('once_show');
		$this->yun_tpl(array('show'));
	}
}
?>