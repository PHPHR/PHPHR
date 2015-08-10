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
class resume_model extends model{
    function AddExpectHits($id){
        $this->DB_update_all("resume_expect","`hits`=`hits`+1","`id`='".$id."'");
    }
    function SaveLookResume($Values=array(),$Where=array()){
        $ValuesStr=$this->FormatValues($Values);

        if($Where){
            $WhereStr=$this->FormatWhere($Where);
            return $this->DB_update_all('look_resume',$ValuesStr,$WhereStr);
        }else{
            return $this->insert_into('look_resume',$Values);
        }
    }
    function SelectResume($Where=array(),$field='*')
    {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_once('resume',$WhereStr,$field);
    }
    function SelectExpectOne($Where=array(),$field='*')
    {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_once('resume_expect',$WhereStr,$field);
    }
    function SelectLookResumeOne($Where=array(),$field='*')
    {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_once('look_resume',$WhereStr,$field);
    }
    function SelectDownResumeOne($Where=array(),$field="*")
    {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_once('down_resume',$WhereStr,$field='*');
    }
    function SelectDownResumeNum($Where=array())
    {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_num('down_resume',$WhereStr);
    }
    function SelectEntrustNum($Where=array()) {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_num('entrust',$WhereStr);
    }
    function SelectResumeOne($Where=array(),$field='*'){
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_once('resume',$WhereStr,$field);
    }
	function ResumeAll($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
    	$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeExpectNum($Where=array()){
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_num('resume_expect',$WhereStr);
    }
	function resume_select($id,$user_jy=''){
		if($user_jy['uid']==''){
			$user_jy=$this->DB_select_once("resume_expect","`id`='".$id."'");
		}
		if($user_jy['uid']){
			$user=$this->DB_select_once("resume","`r_status`<>'2' and `uid`='".$user_jy['uid']."'");
			$thisember=$this->DB_select_once("member","`uid`='".$user_jy['uid']."'");
			if($user['uid']){
				include PLUS_PATH."/city.cache.php";
				include PLUS_PATH."/job.cache.php";
				include PLUS_PATH."/user.cache.php";
				include PLUS_PATH."/industry.cache.php";
				if($this->config['user_name']==3 && $_COOKIE['uid']!=$user_jy['uid']){
					$user["username_n"] = "NO.".$user_jy['id'];
				}elseif($this->config['user_name']==2 && $_COOKIE['uid']!=$user_jy['uid']){

					if($userclass_name[$user['sex']]=='男'){
						$user['username_n'] = mb_substr($user['name'],0,1,'gbk')."先生";
					}else{
						$user['username_n'] = mb_substr($user['name'],0,1,'gbk')."女士";
					}
				}else{

					$user['username_n'] = $user['name'];
				}

				if($this->config['sy_usertype_1']=='1'&&$_COOKIE['uid']!=$user['uid']){
					if($_COOKIE['usertype']=='2'){
						$thisy_down=$this->DB_select_all("down_resume","`comid`='".$_COOKIE['uid']."'","uid");
					}
					if(!empty($thisy_down)){
						foreach($thisy_down as $k=>$v){
							$thisy_down_uid[]=$v['uid'];
						}
					}
					if(@in_array($user['uid'],$thisy_down_uid)==false ||$user['resume_photo']==""){
						$user['resume_photo']=$this->config['sy_weburl'].'/'.$this->config['sy_member_icon'];
					}
				}else if($user['resume_photo']==""){
					$user['resume_photo']=$this->config['sy_weburl'].'/'.$this->config['sy_member_icon'];
				}else{
					$user['resume_photo']=str_replace("./",$this->config['sy_weburl']."/",$user['resume_photo']);
				}
				$user['username']=$thisember['username'];
				$user['user_sex']=$userclass_name[$user['sex']];
				$user['user_exp']=$userclass_name[$user['exp']];
				$user['user_marriage']=$userclass_name[$user['marriage']];
				$user['useredu']=$userclass_name[$user['edu']];
				$a=date('Y',strtotime($user['birthday']));
				$user['age']=date("Y")-$a;
				$user['jobstatus']=$userclass_name[$user_jy['jobstatus']];
				$user['city_one']=$city_name[$user_jy['provinceid']];
				$user['city_two']=$city_name[$user_jy['cityid']];
				$user['city_three']=$city_name[$user_jy['three_cityid']];
				$user['salary']=$userclass_name[$user_jy['salary']];
				$user['report']=$userclass_name[$user_jy['report']];
				$user['type']=$userclass_name[$user_jy['type']];
				$user['hy']=$industry_name[$user_jy['hy']];
				$user['lastupdate']=date("Y-m-d",$user_jy['lastupdate']);
				$user['r_name'] = $user_jy['name'];
				$user['doc'] = $user_jy['doc'];
				$user['hits']=$user_jy['hits'];
				$user['dnum']=$user_jy['dnum'];
				$resume_diy=split('[|]',$user_jy['resume_diy']);
				$user['resume_diy']=$resume_diy[0];
				$user['dom_sort']=$user_jy['dom_sort'];
				$user['background_image']=$resume_diy[1];
				$user['id']=$id;
				$jy=@explode(",",$user_jy['job_classid']);
				if(@is_array($jy)){
					foreach($jy as $v){
						$jobname[]=$job_name[$v];
					}
					$user['jobname']=@implode(",",$jobname);
				}
				if($user_jy['doc']){
					$user_doc=$this->DB_select_once("resume_doc","`eid`='".$user['id']."'");
				}else{
					$user_edu=$this->DB_select_all("resume_edu","`eid`='$user_jy[id]'");
					$user_training=$this->DB_select_all("resume_training","`eid`='$user_jy[id]'");
					$user_work=$this->DB_select_all("resume_work","`eid`='$user_jy[id]'");
					$user_other=$this->DB_select_all("resume_other","`eid`='$user_jy[id]'");
					
					$user_skill=$this->DB_select_all("resume_skill","`eid`='$user_jy[id]'");
					$user_xm=$this->DB_select_all("resume_project","`eid`='".$user_jy['id']."'");
					$user_show=$this->DB_select_all("resume_show","`eid`='".$user_jy['id']."'");
				}
			}
			if(is_array($user_skill)){
				foreach($user_skill as $k=>$v){
					$user_skill[$k]['skill_n']=$userclass_name[$v['skill']];
					$user_skill[$k]['ing_n']=$userclass_name[$v['ing']];
				}
				$user_cert=$this->DB_select_all("resume_cert","`eid`='".$user_jy['id']."'");
			}
			$userid_job=$this->DB_select_once("userid_job","`com_id`='".$_COOKIE['uid']."' and `eid`='".$user_jy['id']."'");
			if(!empty($userid_job)){
				$user['m_status']=1;
			}
			if($_COOKIE['uid']==$user['uid'] && $_COOKIE['username'] && $_COOKIE['usertype']==1){
				$user['m_status']=1;
			}
			if($_COOKIE['uid'] && $_COOKIE['username'] && ($_COOKIE['usertype']==2)){
				$row=$this->DB_select_once("down_resume","`eid`='".$id."' and comid='".$_COOKIE['uid']."'");
				if(is_array($row)){
					$user['downresume']=1;
					$user['m_status']=1;
					$user['username_n'] = $user['name'];
				}else{
					$user['link_msg']="<a href='javascript:void(0)' onclick=\"for_link('$id','".Url("ajax",array('c'=>'for_link'))."')\">查看联系方式</a>";
				}
			}
			if($_COOKIE['uid'] && $_COOKIE['username'] && $_COOKIE['uid']==$user_jy['uid']){
				$user['diy_status']=1;
			}else{
				$user['diy_status']=2;
			}
			if($_COOKIE['uid'] && $_COOKIE['username']){
				if($user_jy['height_status']!="2" && $_COOKIE['usertype']!=2){
					$user['link_msg']="您不是企业用户！";
				}
			}
			if(!$_COOKIE['uid'] && !$_COOKIE['username']){
				if($user_jy['height_status']==2){
					$usertype=3;
				}else{
					$usertype=2;
				}
				$user['link_msg']="您还没有登录，请点击<a href=\"javascript:void(0);\" onclick=\"showlogin('".$usertype."');\">登录</a>！";
			}
			if($_GET['look']){
				session_start();

				if(!preg_match("/^\d*$/",$_SESSION['auid'])){return false;}

				$row = $this->DB_select_once("admin_user","`uid`='".$_SESSION['auid']."'");

				if(!empty($row) && $_SESSION['ashell'] == md5($row['username'].$row['password'].$this->md))
				{
					$user['m_status']=1;
				}else{
					echo "您无权查看！";die;
				}

			}
			if($userid_job['is_browse']=='1'){
				$this->DB_update_all("userid_job","`is_browse`='2'","`id`='".$userid_job['id']."'");
			}
			$user['per']=sprintf('%.2f%%',($user_jy['dnum']/$user_jy['hits'])*100);
			$user['user_doc']=$user_doc;
			$user['user_jy']=$user_jy;
			$user['user_edu']=$user_edu;
			$user['user_tra']=$user_training;
			$user['user_work']=$user_work;
			$user['user_other']=$user_other;
			$user['user_xm']=$user_xm;
			$user['user_skill']=$user_skill;
			$user['user_cert']=$user_cert;
			$user['user_show']=$user_show;
		}
		return $user;
	}
    function GetFavjobOne($Where=array(),$Options=array('field'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('fav_job',$WhereStr,$FormatOptions['field']);
    }
	function GetResumeExpectOne($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('resume_expect',$WhereStr,$FormatOptions['field']);
    }
    function GetResumeExpectList($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_expect',$WhereStr,$FormatOptions['field']);
    }
    function UpdateResumeExpect($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('resume_expect',$ValuesStr,$WhereStr);
    }
    function DeleteUserEntrust($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('user_entrust',$WhereStr);
    }
    function GetUserEntrustOne($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('user_entrust',$WhereStr,$FormatOptions['field']);
    }
    function GetUserEntrustList($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('user_entrust',$WhereStr,$FormatOptions['field']);
    }
    function UpdateUserEntrust($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('user_entrust',$ValuesStr,$WhereStr);
    }
    function AddResumeExpect($Values=array()){
        return $this->insert_into('resume_expect',$Values);
    }
    function DeleteResumeExpect($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_expect',$WhereStr);
    }
	function GetUserResumeOne($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('user_resume',$WhereStr,$FormatOptions['field']);
    }
    function GetUserResumeList($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('user_resume',$WhereStr,$FormatOptions['field']);
    }
    function UpdateUserResume($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('user_resume',$ValuesStr,$WhereStr);
    }
    function AddUserResume($Values=array()){
        return $this->insert_into('user_resume',$Values);
    }
    function DeleteUserResume($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('user_resume',$WhereStr);
    }
    function GetResumeShowList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_show',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeSkillList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_skill',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeEduList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_edu',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeProjectList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_project',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeCertList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_cert',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeWorkList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_work',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeTrainingList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_training',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetResumeOtherList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume_other',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function DeleteResumeSkill($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_skill',$WhereStr);
    }
    function DeleteResumeEdu($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_edu',$WhereStr);
    }
    function DeleteResumeProject($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_project',$WhereStr);
    }
    function DeleteResumeCert($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_cert',$WhereStr);
    }
    function DeleteResumeWork($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_work',$WhereStr);
    }
    function DeleteResumeTraining($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_training',$WhereStr);
    }
    function DeleteResumeOther($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('resume_other',$WhereStr);
    }
    function DeleteLookResume($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('look_resume',$WhereStr);
    }
    function AddEntrustRecord($Values=array()){
        return $this->insert_into('user_entrust_record',$Values);
    }
    function GetEntrustRecordList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('user_entrust_record',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetEntrustRecordOne($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('user_entrust_record',$WhereStr,$FormatOptions['field']);
    }
    function DeleteEntrustRecord($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('user_entrust_record',$WhereStr);
    }
    function DeleteDownResume($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('down_resume',$WhereStr);
    }
	function AddResume($Table,$Values=array(),$Where=array()){
		if($Where){
			$WhereStr=$this->FormatWhere($Where);
			$ValuesStr=$this->FormatValues($Values);
            return $this->DB_update_all($Table,$ValuesStr,$WhereStr);
		}else{
			return $this->insert_into($Table,$Values);
		}
	}
	function GetResumeAbouts($Table,$Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all($Table,$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
	function GetResumeAbout($Table,$Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once($Table,$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function SelectTalentPool($Where=array(),$field="*")
    {
    	$WhereStr=$this->FormatWhere($Where);
		return $this->DB_select_once('talent_pool',$WhereStr,$field='*');
    }
}
?>