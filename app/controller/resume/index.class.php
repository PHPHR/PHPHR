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
class index_controller extends resume_controller{
	function usersearch(){
        $uptime=array(1=>'今天',3=>'最近3天',7=>'最近7天',30=>'最近一个月',90=>'最近三个月');
        $this->yunset("uptime",$uptime);
        $FinderParams=array('keyword','hy','job1','job1_son','job_post','provinceid','cityid','three_cityid','salary','edu','exp','sex','type','report','adtime','uptime');
		$adtime=array('1'=>'一天内',"3"=>'三天内','7'=>'七天内',"15"=>'十五天内','30'=>'一个月内',"60"=>'两个月内');
		$this->yunset("adtime",$adtime);
		if($this->config['cityid']){
			$_GET['cityid'] = $this->config['cityid'];
		}
		if($this->config['three_cityid']){
			$_GET['three_cityid'] = $this->config['three_cityid'];
		}
		$CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('job','city','user','hy'));
        $this->yunset($CacheList);
		if($this->uid && $_COOKIE['usertype']==2){
	        foreach($_GET as $k=>$v){
	            if(in_array($k,$FinderParams)){
	            	if($v!=""){
	               		$finder[$k]=$v;
	            	}
	            }
	        }
	        if($this->config['cityid']){
				unset($finder['cityid']);
			} 
			if($finder&&is_array($finder)){
				foreach($finder as $key=>$val){
					$para[]=$key."=".$val;
				}
				$paras=@implode('##',$para);
				$this->yunset("paras",$paras);
			}
			if($_COOKIE['lookresume'] || $_COOKIE['talentpool'] || $_COOKIE['useridmsg'])
			{
				$this->yunset(array('lookresume'=>@explode(',',$_COOKIE['lookresume']),'talentpool'=>@explode(',',$_COOKIE['talentpool']),'useridmsg'=>@explode(',',$_COOKIE['useridmsg'])));

			}else{

				$historyM = $this->MODEL('history');

				$lookResume = $historyM->lookResumeHistory($this->uid);

				$talentpool  = $historyM->talentpoolHistory($this->uid);

				$useridmsg  = $historyM->useridmsgHistory($this->uid);

				if($this->config['sy_web_site']=="1"){
					if($this->config['sy_onedomain']!=""){
						$weburl=get_domain($this->config['sy_onedomain']);
					}elseif($this->config['sy_indexdomain']!=""){
						$weburl=get_domain($this->config['sy_indexdomain']);
					}else{
						$weburl=get_domain($this->config['sy_weburl']);
					}
					SetCookie("lookresume",$lookResume,time() + 86400,"/",$weburl);
					SetCookie("talentpool",$talentpool,time() + 86400,"/",$weburl);
					SetCookie("useridmsg",$useridmsg,time() + 86400,"/",$weburl);

				}else{

					SetCookie("lookresume",$lookResume,time() + 86400,"/");
					SetCookie("talentpool",$talentpool,time() + 86400,"/");
					SetCookie("useridmsg",$useridmsg,time() + 86400,"/");
				}

				$this->yunset(array('lookresume'=>@explode(',',$lookResume),'talentpool'=>@explode(',',$talentpool),'useridmsg'=>@explode(',',$useridmsg)));
			}
		}
		if($_GET['order']==''){
			$_GET['order']='topdate';
		}
		if($_GET['three_cityid']){
			foreach($CacheList['city_type'] as $k=>$v)
			{
				if(in_array($_GET['three_cityid'],$v)){
					$zpthreecityid=$k;
				}
			}
			$this->yunset("zpthreecityid",$zpthreecityid);
		}elseif($_GET['cityid']){
			foreach($CacheList['city_type'] as $k=>$v)
			{
				if(in_array($_GET['cityid'],$v)){
					$zpcityid=$k;
				}
			}
			$this->yunset("zpcityid",$zpcityid);
		}
		if($_GET['job_post']){
			foreach($CacheList['job_type'] as $k=>$v)
			{
				if(in_array($_GET['job_post'],$v)){
					$zpjobpost=$k;
				}
			}
			$this->yunset("zpjobpost",$zpjobpost);
		}elseif($_GET['job1_son']){
			foreach($CacheList['job_type'] as $k=>$v)
			{
				if(in_array($_GET['job1_son'],$v)){
					$zpjob1son=$k;
				}
			}
			$this->yunset("zpjob1son",$zpjob1son);
		}
		$this->seo("user_search");
		$this->yun_tpl(array('search'));
	}
	function search_action(){
		$this->usersearch();
	}
	function index_action(){
		if($this->config['sy_default_userclass']=='1'){
	        if($this->config['sy_resumedir']!=""){
				$resumeclassurl=$this->config['sy_weburl']."/resume/?c=search&";
			}else{
				$resumeclassurl=$this->config['sy_weburl']."/index.php?m=resume&c=search&";
			}
			$this->yunset("resumeclassurl",$resumeclassurl);
			$CacheM=$this->MODEL('cache');
            $CacheList=$CacheM->GetCache(array('job','city','hy'));
            $this->yunset($CacheList);
			$this->yunset(array('gettype'=>$_SERVER["QUERY_STRING"],'getinfo'=>$_GET));
			$this->seo("user");
			$this->yun_tpl(array('index'));
		}else{
			$this->usersearch();
		}
	}
}
?>