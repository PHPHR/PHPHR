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
class favorite_controller extends user{
	
	function index_action(){
		$this->yunset($this->MODEL('cache')->GetCache(array('city','com')));
		$this->public_action();
		$this->member_satic();
		$urlarr=array("c"=>"favorite","page"=>"{{page}}");
        $StateNameList=array('0'=>'等待审核','1'=>'招聘中','2'=>'已结束','3'=>'未通过');
		$pageurl=Url('member',$urlarr);
		$rows=$this->get_page("fav_job","`uid`='".$this->uid."' order by id desc",$pageurl,"10");

		$fnum=$this->obj->DB_select_num("fav_job","`uid`='".$this->uid."'","`id`");
		if($rows&&is_array($rows)){
			foreach($rows as $val){
				$jobids[]=$val['job_id'];
			}
			$company_job=$this->obj->DB_select_all("company_job","`id` in(".pylode(',',$jobids).")","`id`,`salary`,`provinceid`,`cityid`,`state`,`type`,`exp`,`edu`,`sdate`");
			foreach($rows as $key=>$val){
                $onecompany = $this->obj->DB_select_once('company',"`uid` = '".$val['com_id']."'");


                $rows[$key]['companylog'] = $onecompany['logo'];
                $rows[$key]['statename']='已关闭';
				foreach($company_job as $v){
					if($val['job_id']==$v['id']){
                        $rows[$key]['sdate'] = $v['sdate'];
						$rows[$key]['salary']=$v['salary'];
						$rows[$key]['provinceid']=$v['provinceid'];
						$rows[$key]['cityid']=$v['cityid'];
                        $rows[$key]['statename']=$StateNameList[$v['state']];
                        $jobtype = $this->obj->DB_select_once('comclass',"`id` = '".$v['type']."'");
                        $salary = $this->obj->DB_select_once('comclass',"`id` = '".$v['salary']."'");
                        $exp = $this->obj->DB_select_once('comclass',"`id` = '".$v['exp']."'");
                        $edu = $this->obj->DB_select_once('comclass',"`id` = '".$v['edu']."'");
                        $rows[$key]['jobtype'] = $jobtype['name'];
                        $rows[$key]['salary'] = $salary['name'];
                        $rows[$key]['exp'] = $exp['name'];
                        $rows[$key]['edu'] = $edu['name'];

					}
				}
			}
		}
		$num=$this->obj->DB_select_num("fav_job","`uid`='".$this->uid."'");
		$this->obj->DB_update_all("member_statis","fav_jobnum='".$num."'","`uid`='".$this->uid."'");
		$this->yunset(array("rows"=>$rows,"fnum"=>$fnum));
//		$this->yunset();
		$this->user_tpl('favorite');
	}
	function del_action(){
		if($_GET['id']){
			$del=(int)$_GET['id'];
			$nid=$this->obj->DB_delete_all("fav_job","`id`='".$del."' and `uid`='".$this->uid."'");
			if($nid){
				$fnum=$this->obj->DB_select_num("fav_job","`uid`='".$this->uid."'","`id`");
				$this->obj->update_once('member_statis',array('fav_jobnum'=>$fnum),array('uid'=>$this->uid));
				$this->obj->member_log("删除收藏的职位信息",5,3);
				$this->layer_msg('删除成功！',9,0,"index.php?c=favorite");
			}else{
				$this->layer_msg('删除失败！',8,0,"index.php?c=favorite");
			}
		}
	}
}
?>