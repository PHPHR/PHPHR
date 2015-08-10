<?php
/* *
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
*/
class hr_controller extends company{
	function index_action(){
		
		$where='1';
		if(!empty($_GET['keyword'])){
			$resume=$this->obj->DB_select_all("resume","`r_status`<>'2' and `name` like '%".$_GET['keyword']."%'","`name`,`edu`,`uid`");
			if(is_array($resume) && !empty($resume)){
				foreach($resume as $v){
					$uid[]=$v['uid'];
				}
			}
			$urlarr['keyword']=$_GET['keyword'];
			$where.=" and uid in (".pylode(',',$uid).")  ";
		}
		if($_GET['jobid']){
			$where.=" and `job_id`=".intval($_GET['jobid'])."  ";
			$urlarr['jobid']=$_GET['jobid'];
		}
        if($_GET['state']){
			$where.=" and `is_browse`=".intval($_GET['state'])."  ";
			$urlarr['state']=$_GET['state'];
		}
		$this->public_action();
		$urlarr['c']="hr";
		$urlarr['page']="{{page}}";
		$pageurl=Url('member',$urlarr);
		$rows=$this->get_page("userid_job",$where." and `type`='1' and  `com_id`='".$this->uid."' order by id desc",$pageurl,"10");
		$JobList=$this->obj->DB_select_all('company_job','`uid`='.$this->uid,"`id`,`name`");
		if(is_array($rows) && !empty($rows)){
			$uid=$eid=array();
			foreach($rows as $val){
				$eid[]=$val['eid'];
				$uid[]=$val['uid'];
			}
			if(empty($resume)&&empty($_GET['keyword'])){
				$resume=$this->obj->DB_select_all("resume","`r_status`<>'2'  and `uid` in (".pylode(",",$uid).")","`name`,`edu`,`uid`,`exp`");
			}
			$expect=$this->obj->DB_select_all("resume_expect","`id` in (".pylode(",",$eid).")","`id`,`job_classid`,`salary`");
			$userid_msg=$this->obj->DB_select_all("userid_msg","`fid`='".$this->uid."' and `uid` in (".pylode(",",$uid).")","uid");
			if(is_array($resume)){
				include(PLUS_PATH."user.cache.php");
				include(PLUS_PATH."job.cache.php");
				$expectinfo=array();
				foreach($expect as $key=>$val){
					$jobids=@explode(',',$val['job_classid']);
					$jobname=array();
					foreach($jobids as $v){
						$jobname[]=$job_name[$v];
					}
					$expectinfo[$val['id']]['jobname']=@implode('、',$jobname);
					$expectinfo[$val['id']]['salary']=$userclass_name[$val['salary']];
				}
				foreach($rows as $k=>$v){
					$rows[$k]['jobname']=$expectinfo[$v['eid']]['jobname'];
					$rows[$k]['salary']=$expectinfo[$v['eid']]['salary'];
					foreach($resume as $val){
						if($v['uid']==$val['uid']){
							$rows[$k]['name']=$val['name'];
							$rows[$k]['edu']=$userclass_name[$val['edu']];
							$rows[$k]['exp']=$userclass_name[$val['exp']];
						}
					}
					foreach($userid_msg as $val){
						if($v['uid']==$val['uid']){
							$rows[$k]['userid_msg']=1;
						}
					}
				}
			}
		}
		if($JobList&&is_array($JobList)&&$_GET['jobid']){
			foreach($JobList as $val){
				if($_GET['jobid']==$val['id']){
					$current=$val;
				}
			}
		}
       
		$this->yunset(array('current'=>$current,'rows'=>$rows,'JobList'=>$JobList,'StateList'=>array(array('id'=>1,'name'=>'未查看'),array('id'=>2,'name'=>'已查看'),array('id'=>3,'name'=>'等待通知'),array('id'=>4,'name'=>'条件不符'),array('id'=>5,'name'=>'无法联系'))));
		$this->company_satic();
		$this->yunset("js_def",5);
		$this->com_tpl('hr');
	}
	function ltjob_action(){
		$where="`com_id`='".$this->uid."' and ";
		if(!empty($_GET['keyword'])){
			$resume=$this->obj->DB_select_all("resume","`r_status`<>'2' and `name` like '%".$_GET['keyword']."%'","`name`,`edu`,`uid`");
			if(is_array($resume) && !empty($resume)){
				foreach($resume as $v){
					$uid[]=$v['uid'];
				}
			}
			$urlarr['keyword']=$_GET['keyword'];
			$where.=" uid in (".pylode(',',$uid).") and ";
		}
		if($_GET['jobid']){
			$where .="`job_id`=".intval($_GET['jobid'])." and ";
			$urlarr['jobid']=$_GET['jobid'];
		}
        if($_GET['state']){
			$where .="is_browse=".intval($_GET['state'])." and ";
			$urlarr['state']=$_GET['state'];
		}
		$this->public_action();
		$urlarr['c']="hr";
		$urlarr['act']="ltjob";
		$urlarr['page']="{{page}}";
		$pageurl=Url('member',$urlarr);
		$rows=$this->get_page("userid_job",$where." and `type`='2' order by id desc",$pageurl,"10");
		$this->yunset(array('current'=>$current,'rows'=>$rows,'JobList'=>$JobList,'StateList'=>array(array('id'=>2,'name'=>'未查看'),array('id'=>1,'name'=>'已查看'),array('id'=>3,'name'=>'等待通知'),array('id'=>4,'name'=>'条件不符'),array('id'=>5,'name'=>'无法联系'))));
		$this->company_satic();
		$this->yunset("js_def",5);
		$this->com_tpl('hr');
	}
	function hrset_action(){
        
		if($_POST['ajax']==1 && $_POST['ids']){
			$this->obj->DB_update_all("userid_job","`is_browse`='2'","`id` in (".pylode(",",$_POST['ids']).") and `com_id`='".$this->uid."'");
			$this->unset_remind("userid_job",'2');
			$this->obj->member_log("批量阅读申请职位的人才");
			$this->layer_msg('操作成功！',9,0,"index.php?c=hr");
		}else if($_POST['delid']||$_GET['delid']){
			if(is_array($_POST['delid'])){
				$id=pylode(",",$_POST['delid']);
				$layer_type='1';
			}else{
				$id=(int)$_GET['delid'];
				$layer_type='0';
			}
			$sq_num = $this->obj->DB_select_all("userid_job","`id` in (".$id.") and `com_id`='".$this->uid."'","`uid`");
			if(is_array($sq_num)){
				foreach($sq_num as $v){
					$this->obj->DB_update_all("member_statis","`sq_jobnum`=`sq_jobnum`-1","`uid`='".$v['uid']."'");
		    	}
			}
			$num=count($sq_num);
			$this->obj->DB_update_all("company_statis","`sq_job`=`sq_job`-$num","`uid`='".$this->uid."'");
			$nid=$this->obj->DB_delete_all("userid_job","`id` in (".$id.") and `com_id`='".$this->uid."'"," ");
			if($nid){
				$this->unset_remind("userid_job",'2');
				$this->obj->member_log("删除申请职位的人才",6,3);
				$this->layer_msg('删除成功！',9,$layer_type,"index.php?c=hr");
			}else{
				$this->layer_msg('删除失败！',8,$layer_type,"index.php?c=hr");
			}
		}else if($_POST['browse']){
			$browse=(int)$_POST['browse'];
			$id=(int)$_POST['id'];
			$this->obj->DB_update_all("userid_job","`is_browse`='".$browse."'","`id`='".$id."' and `com_id`='".$this->uid."'");
			$this->unset_remind("userid_job",'2');
			echo '1';die;
		}
	}
}
?>