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
class index_controller extends company{
	function index_action(){
		include(CONFIG_PATH."db.data.php");
		$this->yunset("arr_data",$arr_data);
		$statis=$this->company_satic();  
		$invite_resume=$this->obj->DB_select_num("userid_msg","`fid`='".$this->uid."'");
		$down_resume=$this->obj->DB_select_num("down_resume","`comid`='".$this->uid."'");
		$de_resume=$this->obj->DB_select_num("userid_job","`com_id`='".$this->uid."' and `is_browse`='1'");
        $this->yunset("de_resume",$de_resume);
		$des_resume=$this->obj->DB_select_num("userid_job","`com_id`='".$this->uid."'");
        $this->yunset("des_resume",$des_resume);
		$this->yunset("invite_resume",$invite_resume);
		$this->yunset("down_resume",$down_resume);
		$company=$this->obj->DB_select_once("company","`uid`='".$this->uid."'");
		$member=$this->obj->DB_select_once("member","`uid`='".$this->uid."'","`login_date`");

		if($statis['rating']>0){
			$company_rating=$this->obj->DB_select_once("company_rating","`id`='".$statis['rating']."'");
			if($statis['vip_etime']>time()){
				$days=round(($statis['vip_etime']-mktime())/3600/24) ;
				$this->yunset("days",$days);
			}
			$this->yunset("company_rating",$company_rating);
		}
		$_GET['cityid']=$company['cityid'];
		$_GET['hy']=$company['hy'];
		
		$atn=$this->obj->DB_select_all("atn","`sc_uid`='".$this->uid."' and `usertype`='1' order by `id` desc");   
		$this->offerlist();
		$normal_job_num=$this->obj->DB_select_num("company_job","`uid`='".$this->uid."' and `state`='1' and `edate`>'".time()."'");
		$statis['integral']=number_format($statis['integral']);
 		$this->yunset("statis",$statis);
 		$this->yunset("member",$member);
		$this->yunset("uid",$this->uid);
		$this->yunset("normal_job_num",$normal_job_num);
		$this->yunset("company",$company);
		$this->public_action();
		$this->yunset("js_def",1);
		$this->com_tpl('company');
	}

    protected function offerlist()
    {
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
        $this->yunset($this->MODEL('cache')->GetCache(array('hy','job','city','com')));
        $this->yunset(array('current'=>$current,'rows'=>$rows,'JobList'=>$JobList,'StateList'=>array(array('id'=>1,'name'=>'未查看'),array('id'=>2,'name'=>'已查看'),array('id'=>3,'name'=>'等待通知'),array('id'=>4,'name'=>'条件不符'),array('id'=>5,'name'=>'无法联系'))));
        $this->yunset("js_def",5);
    }
}
?>