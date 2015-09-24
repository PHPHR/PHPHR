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
class index_controller extends user{

    private $jobs = [];
	
	function index_action(){
		$this->public_action();
		$this->member_satic();
        $this->com_cache();
		$newmsg=$this->obj->DB_select_num("userid_msg","`uid`='".$this->uid."' and type<>'1' and `is_browse`='1'");
		$msgnum=$this->obj->DB_select_num("userid_msg","`uid`='".$this->uid."' and type<>'1'");
		$msg_count=$this->obj->DB_select_num("message","`fa_uid`='".$this->uid."' and `username`='管理员'");
		$lookNum=$this->obj->DB_select_num("look_resume","`uid`='".$this->uid."' and `status`<>'1'");
		$downNum=$this->obj->DB_select_num("down_resume","`uid`='".$this->uid."'");

		
		$finder=$this->finder();
		$this->config['user_finder']<count($finder)?$findernum=0:$findernum=$this->config['user_finder']-count($finder);
		$this->yunset("finder", $finder);
		$this->yunset("findernum", $findernum);
		$this->yunset("newmsg", $newmsg);
		$this->yunset("msgnum", $msgnum);
		$this->yunset("msg_count",$msg_count);
		$this->yunset("lookNum",$lookNum);
		$this->yunset("downNum",$downNum);
       
		$resume = $this->obj->DB_select_once("resume","`uid`='".$this->uid."'","`def_job`,`name`,`status`,`email`,`telphone`,`idcard`,`moblie_status`,`email_status`,`idcard_status`,`status`");
		
		$rlist=$this->obj->DB_select_all("resume_expect","`uid`='".$this->uid."' order by `defaults` desc","id,name,job_classid,cityid,hits,integrity,doc,tmpid,topdate");
		if($rlist&&is_array($rlist)){
			foreach($rlist as $k=>$v){
				$rlist[$k]['name']=mb_substr($v['name'],0,10,'gbk');
				$eid[]=$v['id'];
			}
			$user_resume=$this->obj->DB_select_all("user_resume","`eid` in (".@implode(",",$eid).")");
			foreach($rlist as $key=>$val){
				$resumelist="";
				foreach($rlist as $v){
					$resumelist.="<li><a href=\"javascript:check_select_resume('".$v[id]."');\">".$v['name']."</a></li>";
				}
				$html='<span>'.$val[name].'</span><div class="index_resume_my_n_list" id="resume_expect'.$val[id].'" style="display:none;"><ul>'.$resumelist.'</ul></div>';
				$rlist[$key]['resumelist']=$html;
				foreach($user_resume as $v){
					if($val['id']==$v['eid']){
						$rlist[$key]['skill']=$v['skill'];
						$rlist[$key]['work']=$v['work'];
						$rlist[$key]['project']=$v['project'];
						$rlist[$key]['edu']=$v['edu'];
						$rlist[$key]['training']=$v['training'];
						$rlist[$key]['cert']=$v['cert'];
						$rlist[$key]['other']=$v['other'];
					}
				}
				if($val['id']==$resume['def_job']){
					$jobwhere="(`job1` in (".$val['job_classid'].") or `job_post` in (".$val['job_classid'].") or `job1_son` in (".$val['job_classid'].") OR `name` LIKE '%".$info['name']."%') and `cityid` in (".$val['cityid'].") ";
					$this->yunset("expect_name",$val['name']);
				}
				if($val['topdate']>1){
					$rlist[$key]['topdate']=date("Y-m-d",$val['topdate']);
				}else{
					$rlist[$key]['topdate']='- -';
				}
			}
			$_GET['jobwhere']=$jobwhere;
		}else{
			$_GET['jobwhere']="1=2";
		}
        /************************/
        $rows = $this->findJobs();
        $rows = $this->matching($rows);
        $this->yunset('selljob',$rows);
        $this->yunset($this->MODEL('cache')->GetCache('city','com'));
        /***********************/




		$this->yunset("rlist",$rlist);
		$this->yunset("resume",$resume);
		$this->user_tpl('index');
	}
	function getjob_action(){
		if($_POST['id']){
			$info=$this->obj->DB_select_once("resume_expect","`id`='".(int)$_POST['id']."'","job_classid,cityid");
			$jobwhere="`edate`>'".time()."' and `state`=1 and `r_status`<>2 and `status`<>1 and ";
			$jobwhere.="(`job_post` in (".$info['job_classid'].") or `job1_son` in (".$info['job_classid'].") OR `name` LIKE '%".$info['name']."%') and `cityid`='".$info['cityid']."' order by id desc limit 16";
			$list=$this->obj->DB_select_all("company_job",$jobwhere,"`id`,'uid',`name`,`com_name`,`salary`");
			if(is_array($list)){
				include PLUS_PATH."/com.cache.php";
				foreach($list as $v){
					$job_url=Url("job",array("c"=>"comapply","id"=>$v['id']),"1");;
					$name_n=mb_substr($v['name'],0,8,'gbk');
					$com_url=Url("company",array("c"=>"show","id"=>$v['uid']));
					$com_n=mb_substr($v['com_name'],0,13,'gbk');
					$job_salary=$comclass_name[$v['salary']];
					$html.='<li> <a href="'.$job_url.'" class="member_right_job_box_name cblue">'.$name_n.'</a> <span class="member_right_job_xz">'.$job_salary.'</span> <a href="'.$com_url.'">'.$com_n.'</a> </li>';
				}
			}
			echo $html;die;
		}
	}

    public function more_action()
    {
        $this->yunset($this->MODEL('cache')->GetCache(array('job','city','com','user')));

//        //获取用户简历
//        $user_resume = $this->obj->DB_select_once("resume_expect","`uid` ='".$this->uid."'");
//        //获取意向职位id(全部id，三级)
//        $job_class = explode(',',$user_resume['job_classid']);
//
//        if(!empty($job_class) && is_array($job_class)) {
//            foreach($job_class as $val) {
//                $this->findJobIds($val);
//            }
//        }
//        $classes = implode(',',$this->jobs);
//        //用户职位意向获取岗位
//        $time = time();
//        $urlarr=array("act"=>"more","page"=>"{{page}}");
//        $pageurl=Url('member',$urlarr);
//        $rows=$this->get_page("company_job","`job_post`in(".$classes.") and edate >{$time} order by id desc",$pageurl,"10");
//       // $job_class = $this->obj->DB_select_all("company_job","`job_post` in (".$user_resume['job_classid'].") and edate >{$time}");
        $rows = $this->findJobs();
        $rows = $this->matching($rows);
        $this->yunset("myrows",$rows);
        $this->user_tpl("more");
    }


    public function findJobs()
    {
        //获取用户简历
        $user_resume = $this->obj->DB_select_once("resume_expect","`uid` ='".$this->uid."'");
        //获取意向职位id(全部id，三级)
        $job_class = explode(',',$user_resume['job_classid']);

        if(!empty($job_class) && is_array($job_class)) {
            foreach($job_class as $val) {
                $this->findJobIds($val);
            }
        }
        $classes = implode(',',$this->jobs);
        //用户职位意向获取岗位
        $time = time();
        $urlarr=array("act"=>"more","page"=>"{{page}}");
        $pageurl=Url('member',$urlarr);
        return $this->get_page("company_job","`job_post`in(".$classes.") and edate >{$time} order by id desc",$pageurl,"10");

    }


    public function findJobIds($jobid)
    {

        $job = $this->obj->DB_select_once('job_class',"id = '".$jobid."'");
        $this->jobs[] = $jobid;
        if($job['keyid']){
            $this->findJobIds($job['keyid']);
        }

    }


}




?>