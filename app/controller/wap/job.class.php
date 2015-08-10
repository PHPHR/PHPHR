<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class job_controller extends common{
	function index_action(){
		$this->rightinfo();
		$this->get_moblie();
		$CacheM=$this->MODEL('cache');
        $CacheArr=$CacheM->GetCache(array('job','city','hy','com'));
		if($_GET['jobin']){
			$job_classid=@explode(',',$_GET['jobin']);
			$jobname=$CacheArr['job_name'][$job_classid[0]];
			$this->yunset("jobname",mb_substr($jobname,0,6,'gbk'));
		}
        $uptime=array(1=>'今天',3=>'最近3天',7=>'最近7天',30=>'最近一个月',90=>'最近三个月');
        $this->yunset("uptime",$uptime);
		$this->yunset($CacheArr);
		$this->yunset("headertitle","职位搜索");
		foreach($_GET as $k=>$v){
			if($k!=""){
				$searchurl[]=$k."=".$v;
			}
		}
		$this->seo("com_search");
		$searchurl=@implode("&",$searchurl);
		$this->yunset("searchurl",$searchurl);
		$this->yuntpl(array('wap/job'));
	}
	function view_action(){
		$this->rightinfo();
		$this->get_moblie();
		$JobM=$this->MODEL('job');
		$CacheM=$this->MODEL('cache');
		$ResumeM=$this->MODEL('resume');
		$UserinfoM=$this->MODEL('userinfo');
        $CacheArr=$CacheM->GetCache(array('job','city','hy','com'));
		$job=$JobM->GetComjobOne(array("id"=>(int)$_GET['id']));
		$welfare = @explode(",",$job['welfare']);
        foreach($welfare as $k=>$v){
            if(!$v){
                unset($welfare[$k]);
            }
        }
		$job['welfare']=$welfare;
		$lang = @explode(",",$job['lang']);
		$job['lang']=$lang;
		$company=$UserinfoM->GetUserinfoOne(array("uid"=>$job['uid']),array("usertype"=>'2'));
		$JobM->UpdateComjob(array("`jobhits`=`jobhits`+1"),array("id"=>(int)$_GET['id']));
		if($_COOKIE['usertype']=="1"){
			$look_job=$JobM->GetLookJobOne(array("uid"=>$this->uid,"jobid"=>(int)$_GET['id']));
			if(!empty($look_job)){
				$JobM->UpdateLookJob(array("datetime"=>time()),array("uid"=>$this->uid,"jobid"=>(int)$_GET['id']));
			}else{
				$data['uid']=$this->uid;
				$data['jobid']=(int)$_GET['id'];
				$data['com_id']=$job['uid'];
				$data['datetime']=time();
				$JobM->AddLookJob($data);
			}
		}
		if($_GET['type']){
			if(!$this->uid || !$this->username || $_COOKIE['usertype']!=1){
				$data['msg']='您不是个人用户！';
				$data['url']=$_SERVER['HTTP_REFERER'];
				$data['msg']=iconv("GBK","UTF-8",$data['msg']);
				echo json_encode($data);die;
			}else {
				if($_GET['type']=='sq'){
					$row=$JobM->GetUserJobNum(array("uid"=>$this->uid,"job_id"=>(int)$_GET['id']));
					$resume=$ResumeM->SelectExpectOne(array("uid"=>$this->uid,"defaults"=>1),"id");

					if(!$resume['id']){

						$data['msg']='您还没有简历，请先添加简历！'.$this->uid;
						$data['url']=$_SERVER['HTTP_REFERER'];
							$data['msg']=iconv("GBK","UTF-8",$data['msg']);
						echo json_encode($data);
						die;
					}else if(intval($row)>0){
						$data['msg']='您已经申请过该职位，请不要重复申请！';
						$data['url']=$_SERVER['HTTP_REFERER'];
							$data['msg']=iconv("GBK","UTF-8",$data['msg']);
						echo json_encode($data);
						die;
					}else{
						$info=$JobM->GetComjobOne(array("id"=>(int)$_GET['id']));
						$value['job_id']=$_GET['id'];
						$value['com_name']=$info['com_name'];
						$value['job_name']=$info['name'];
						$value['com_id']=$info['uid'];
						$value['uid']=$this->uid;
						$value['eid']=$resume['id'];
						$value['datetime']=mktime();
						$nid=$JobM->AddUseridJob($value);
						if($nid){
							$UserinfoM->UpdateUserStatis("`sq_job`=`sq_job`+1",array("uid"=>$value['com_id']),array('usertype'=>'2'));
							$UserinfoM->UpdateUserStatis("`sq_jobnum`=`sq_jobnum`+1",array("uid"=>$value['uid']),array('usertype'=>'1'));
							$data['msg']='申请成功！';
							$data['url']=$_SERVER['HTTP_REFERER'];
							$data['msg']=iconv("GBK","UTF-8",$data['msg']);
							echo json_encode($data);
							die;
						}else{
							$data['msg']='申请失败！';
							$data['url']=$_SERVER['HTTP_REFERER'];
							$data['msg']=iconv("GBK","UTF-8",$data['msg']);
							echo json_encode($data);
							die;
						}
					}
				}else if($_GET[type]=='fav'){
					$rows=$ResumeM->GetFavjobOne(array("uid"=>$this->uid,'job_id'=>(int)$_GET['id']));
					if($rows['id']){
						$data['msg']='您已经收藏过该职位，请不要重复收藏！';
						$data['url']=$_SERVER['HTTP_REFERER'];
						$data['msg']=iconv("GBK","UTF-8",$data['msg']);
						echo json_encode($data);die;
					}
					$job=$JobM->GetComjobOne(array("id"=>(int)$_GET['id']));
					$data['job_id'] = $job['id'];
					$data['com_name'] = $job['com_name'];
					$data['job_name'] = $job['name'];
					$data['com_id'] = $job['uid'];
					$data['uid'] = $this->uid;
					$data['datetime'] = time();
					$nid=$JobM->AddFavJob($data);
					if($nid){
						$UserinfoM->UpdateUserStatis("`fav_jobnum`=`fav_jobnum`+1",array("uid"=>$this->uid),array('usertype'=>'1'));
						$data['msg']='收藏成功！';
                        $data['url']=$_SERVER['HTTP_REFERER'];
							$data['msg']=iconv("GBK","UTF-8",$data['msg']);
							echo json_encode($data);
							die;
					}else{
						$data['msg']='收藏失败！';
                        $data['url']=$_SERVER['HTTP_REFERER'];
							$data['msg']=iconv("GBK","UTF-8",$data['msg']);
							echo json_encode($data);
							die;
					}
				}
			}
		}
		$data['job_name']=$job['name'];
		$data['company_name']=$job['com_name'];
		$data['industry_class']=$job['job_hy'];
		$data['job_class']=$job['job_class_one'].",".$job['job_class_two'].",".$job['job_class_three'];
		$data['job_desc']=$this->GET_content_desc($job['description']);
		$this->data=$data;
		$this->seo("comapply");
		$this->yunset("job",$job);
		$this->yunset($CacheArr);
		$this->yunset("company",$company);
		$this->yunset("headertitle","职位详情");
		$this->yuntpl(array('wap/job_show'));
	}
	function ajax_url_action(){
		if($_POST){
			if($_POST['url']!=""){
				$urls=@explode("&",$_POST['url']);
				foreach($urls as $v){
					if(strpos($v,$_POST['type'])===false){
						$gourl[]=yun_iconv('utf-8','gbk',$v);
					}
				}
				$gourl=@implode("&",$gourl)."&".$_POST['type']."=".$_POST['id'];
			}else{
				$gourl=$_POST['type']."=".$_POST['id'];
			}
			echo "?".$gourl;die;
		}
	}
}
?>