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
class resume_controller extends common
{
	function index_action(){
		$this->rightinfo();
		$this->get_moblie();
		$CacheM=$this->MODEL('cache');
        $CacheArr=$CacheM->GetCache(array('user','job','city','hy'));
        $uptime=array(1=>'今天',3=>'最近3天',7=>'最近7天',30=>'最近一个月',90=>'最近三个月');
        $this->yunset("uptime",$uptime);
		if($_GET['jobin']){
			$job_classid=@explode(',',$_GET['jobin']);
			$jobname=$CacheArr['job_name'][$job_classid[0]];
			$this->yunset("jobname",mb_substr($jobname,0,6,'gbk'));
		}
		foreach($_GET as $k=>$v){
			if($k!=""){
				$searchurl[]=$k."=".$v;
			}
		}
		$searchurl=@implode("&",$searchurl);
		$this->yunset("searchurl",$searchurl);
		$this->yunset($CacheArr);
		$this->yunset("headertitle","找人才");
		$this->seo("user_search");
		$this->yuntpl(array('wap/resume'));
	}
	function show_action(){
		$this->rightinfo();
		$this->get_moblie();
		$ResumeM=$this->MODEL('resume');
		if($_GET['uid']){
			if($_GET['type']=="2"){
				$user=$ResumeM->GetResumeExpectOne(array("uid"=>(int)$_GET['uid'],"height_status"=>'2'));
				$id=$user['id'];
			}else{
				$def_job=$ResumeM->SelectResumeOne(array("uid"=>(int)$_GET['uid'],"`r_status`<>'2'"));
				$id=$def_job['def_job'];
			}
		}else{
			$id=(int)$_GET['id'];
		}
		$user=$ResumeM->resume_select($_GET['id']);
        $ResumeM->AddExpectHits($id);
        if($_COOKIE['usertype']=="2" || $_COOKIE['usertype']=="3"){
			$this->yunset("uid",$_COOKIE['uid']);
			$ResumeM->RemindDeal("userid_job",array("is_browse"=>"2"),array("com_id"=>$this->uid,"eid"=>(int)$_GET['id']));
			if($_COOKIE['usertype']=="2"){
				$this->unset_remind("userid_job",'2');
			}else{
				$this->unset_remind("userid_job3",'3');
			}
			$look_resume=$ResumeM->SelectLookResumeOne(array("com_id"=>$this->uid,"resume_id"=>$id));
			if(!empty($look_resume)){
				$ResumeM->SaveLookResume(array("datetime"=>time()),array("resume_id"=>$id,"com_id"=>$this->uid));
			}else{
				$data['uid']=$user['uid'];
				$data['resume_id']=$id;
				$data['com_id']=$this->uid;
				$data['datetime']=time();
				$ResumeM->SaveLookResume($data);
			}
        }
		$data['resume_username']=$user['username_n'];
		$data['resume_city']=$user['city_one'].",".$user['city_two'];
		$data['resume_job']=$user['hy'];
		$this->data=$data;
		$this->seo("resume");
		$this->yunset("Info",$user);
		$this->yunset("headertitle","找人才");
		$this->yuntpl(array('wap/resume_show'));
	}
}
?>