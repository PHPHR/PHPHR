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
class comapply_controller extends job_controller{
	function index_action(){
		$id=(int)$_GET['id'];
		$M=$this->MODEL('job');
		$companyM=$this->MODEL('company');
        $UserinfoM=$this->MODEL('userinfo');
        $AskM=$this->MODEL('ask');
        $CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('job','city','com'));
        $this->yunset($CacheList); 
		$JobInfo=$M->GetComjobOne(array('id'=>$id));
		if($JobInfo['id']==''){
			$this->get_admin_msg($this->config['sy_weburl'],"没有该职位！");
		}
		$M->UpdateComjob(array("`jobhits`=`jobhits`+1"),array('id'=>$JobInfo['id']));
		if($_COOKIE['usertype']=="1"){
			$look_job=$M->GetLookJobOne(array('uid'=>$this->uid,'jobid'=>$JobInfo['id']));
			if(!empty($look_job)){
				$M->UpdateLookJob(array('datetime'=>time()),array('uid'=>$this->uid,'jobid'=>$JobInfo['id']));
			}else{
				$M->insert_into('look_job',array('uid'=>$this->uid,'jobid'=>$JobInfo['id'],'com_id'=>$JobInfo['uid'],'datetime'=>time()));
				$historyM = $this->MODEL('history');
				$historyM->addHistory('lookjob',$JobInfo['id']);
			}
		}

		if($this->uid!=$JobInfo['uid']){
			if($this->config['com_login_link']=="1"){
				if($this->uid=="" && $this->username==""){
					$look_msg=1;
				}else{
					if($_COOKIE['usertype']!="1"){
						$look_msg=2;
					}
				}
			}
			if($this->config['com_resume_link']=="1"&&$_COOKIE['usertype']=='1'){
				$row=$M->DB_select_num("resume_expect","`uid`='".$this->uid."'");
				if($row<1){
					$look_msg=3;
				}
			}
			if($_COOKIE['usertype']=='1'){
				$userid_job=$M->GetUseridJobOne(array('uid'=>$this->uid,'job_id'=>$JobInfo['id']),array('field'=>'id'));
				$this->yunset(array('userid_job'=>$userid_job['id'],'usertype'=>1));
			}
		}
       
        if($JobInfo['r_status']<>'2'){ 
			$ComInfo=$UserinfoM->GetUserinfoOne(array('uid'=>$JobInfo['uid']),array('field'=>"`ant_num`,`linkqq`,`logo`,`address`,`linktel`,`linkman`,`linkphone`,`email_status`,`moblie_status`,`yyzz_status`,`content`,`x`,`y`",'usertype'=>2));
			$JobInfo['jobname']=$JobInfo['name'];unset($JobInfo['name']);
			$JobInfo['jobrec']=$JobInfo['rec'];unset($JobInfo['rec']);
		}
        $Info=array_merge_recursive($JobInfo,$ComInfo);
		$this->yunset("look_msg",$look_msg); 
		if($Info['state']=="0"){
			$this->get_admin_msg($_SERVER['HTTP_REFERER'],"职位审核中！");
		}elseif($Info['state']=="2"){
			$this->yunset('entype','1');

		}elseif($Info['state']=="3"){
			$this->get_admin_msg($_SERVER['HTTP_REFERER'],"该职位未通过审核！");

		}elseif($Info['status']=="1"){
			$this->yunset('stop','1');
		} 
		if(is_array($Info)){
            $cache_array = $this->db->cacheget(); 
			$Job = $this->db->array_action($Info,$cache_array);
			if($Job['is_link']=="1"){
				if($Job['link_type']==1){ 
					$Job['linkman']=$Info['linkman'];
					$Job['linktel']=$Info['linktel'];
				}else{
					$link=$M->GetComjoblinkOne(array('jobid'=>$Job['id']),array('field'=>'`link_man`,`link_moblie`'));
					$Job['linkman']=$link['link_man'];
					$Job['linktel']=$link['link_moblie'];
				}
			}
		}
		
		$com=$UserinfoM->GetMemberOne(array('uid'=>$Job['uid']),array('field'=>'`username`'));
		$Job['cert_n'] = @explode(",",$Job['cert']);
		$Job['uid'] = $Job['uid'];
		$Job['com_url'] = Url("company",array("c"=>"show","id"=>$Job[uid]));
		$Job['username'] = $com['username'];
		$data['job_name']=$Job['jobname'];
		$data['company_name']=$Job['com_name'];
		$data['industry_class']=$Job['job_hy'];
		$data['job_class']=$Job['job_class_one'].",".$Job['job_class_two'].",".$Job['job_class_three'];
		$data['job_desc']=$this->GET_content_desc($Job['description']);
		$this->data=$data;
		$this->yunset("Info",$Job); 
		$this->seo("comapply"); 

		$this->yun_tpl(array('comapply'));
	}
	function qrcode_action(){
		$wapUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if( isset($_GET['id']) && $_GET['id'] != '')
			$wapUrl = "http://".$_SERVER['HTTP_HOST']."/wap/?c=job&a=view&id=".$_GET['id'];
		include_once LIB_PATH."yunqrcode.class.php";
		YunQrcode::generatePng2($wapUrl,4);
	}
	
	function msg_action(){
		if($_POST['submit']){
			if($this->uid==''||$this->username==''){
				$this->ACT_layer_msg("请先登录！",8,$_SERVER['HTTP_REFERER']);
			}
			if($_COOKIE['usertype']!="1"){
				$this->ACT_layer_msg("只有个人用户才可以留言！",8,$_SERVER['HTTP_REFERER']);
			}
			$M=$this->MODEL("job");
			$black=$M->GetBlackOne(array('p_uid'=>$this->uid,'c_uid'=>(int)$_POST['job_uid']));
			if(!empty($black)){
				$this->ACT_layer_msg("该企业暂不接受相关咨询！",8,$_SERVER['HTTP_REFERER']);
			}
			if(trim($_POST['content'])==""){
				$this->ACT_layer_msg( "留言内容不能为空！",2,$_SERVER['HTTP_REFERER']);
			}
			$id=$M->AddMsg(array('uid'=>$this->uid,'username'=>$this->username,'jobid'=>trim($_POST['jobid']),'job_uid'=>trim($_POST['job_uid']),'content'=>trim($_POST['content']),'com_name'=>trim($_POST['com_name']),'job_name'=>trim($_POST['job_name']),'type'=>'1','datetime'=>time()));
			isset($id)?$this->ACT_layer_msg( "留言成功，请等待回复！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("留言失败！",8,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>