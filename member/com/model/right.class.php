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
class right_controller extends company{
	function index_action(){
		$this->public_action();
		$this->company_satic();
		$rows=$this->obj->DB_select_all("company_rating","`category`='1' and `display`='1' order by `sort` desc");
		if(is_array($rows)){
			foreach($rows as $k=>$v){
				$list=array();
				if($v['job_num']>0){
					$list[]='发布职位:<b>'.$v[job_num].'</b>份';
				}
				if($v['resume']>0){
					$list[]='下载简历:<b>'.$v[resume].'</b>份';
				}
				if($v['interview']>0){
					$list[]='邀请面试:<b>'.$v[interview].'</b>份';
				}
				if($v['editjob_num']>0){
					$list[]='修改职位:<b>'.$v[editjob_num].'</b>份';
				}
				if($v['breakjob_num']>0){
					$list[]='刷新职位:<b>'.$v[breakjob_num].'</b>份';
				}
				$list=@implode("+",$list);
				$rows[$k]['content']=$list;
			}
		}
		$this->yunset("rows",$rows);
		$this->yunset("js_def",4);
		$this->com_tpl('member_right');
	}
}
?>