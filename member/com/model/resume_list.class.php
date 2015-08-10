<?php
/* *
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
*/
class resume_list_controller extends company
{
	function index_action(){

	if($_GET['jobid'])
	{
		$resume=$this->obj->DB_select_all("resume","`r_status`<>'2'");
		foreach($resume as $k=>$v)
		{
			$def_job[]=$v['def_job'];
		}
		$urlarr['c']="resume_list";
		$urlarr['jobid']=intval($_GET['jobid']);
		$urlarr["page"]="{{page}}";
		$pageurl=Url('member',$urlarr);
		$rows=$this->get_page("resume_expect","`job_post`='".(int)$_GET['jobid']."' and `id` in (".pylode(",",$def_job).")",$pageurl,"10");
		include PLUS_PATH."/user.cache.php";
		include PLUS_PATH."/city.cache.php";
		if(is_array($rows))
		{
			foreach($rows as $k=>$v)
			{
				$uid[]=$v['uid'];
				$rows[$k]['salary_info']=$userclass_name[$v['salary']];
				$rows[$k]['province']=$city_name[$v['provinceid']];
				$rows[$k]['city']=$city_name[$v['cityid']];
				foreach($resume as $key=>$val)
				{
					if($v['uid']==$val['uid'])
					{
						$rows[$k]['name_info']=$val['name'];
						$rows[$k]['edu_info']=$userclass_name[$val['edu']];
						$rows[$k]['exp_info']=$userclass_name[$val['exp']];
					}
				}
			}
		}
		$look=$this->obj->DB_select_all("look_resume","`uid` in (".pylode(",",$uid).")");
		if(is_array($look))
		{
			foreach($look as $v)
			{
				$looks[$v['uid']]++;
			}
		}
		$this->yunset("looks",$looks);
		$this->yunset("rows",$rows);
		$this->public_action();
		$this->com_tpl('resume_list');
	}
 }
}
?>