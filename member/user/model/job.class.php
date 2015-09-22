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
class job_controller extends user{
	
	function index_action(){
        //var_dump($this->MODEL('cache')->GetCache(array('city','com')));die;
        $this->yunset($this->MODEL('cache')->GetCache(array('city','com')));
		$this->public_action();
		$this->member_satic();
		$urlarr=array("c"=>"job","page"=>"{{page}}");
		$pageurl=Url('member',$urlarr);
        $where_str ="`uid`='".$this->uid."'";
        if(!empty($_GET['is_browse']) && $_GET['is_browse']!=8) {
            $where_str .= "and is_browse = '".$_GET['is_browse']."'";
        }

		$rows=$this->get_page("userid_job",$where_str." order by id desc",$pageurl,"10");
		if($rows&&is_array($rows)){
			foreach($rows as $val){
				$jobids[]=$val['job_id'];
                $EidList[]=$val['eid'];
			}
			$company_job=$this->obj->DB_select_all("company_job","`id` in(".pylode(',',$jobids).")","`uid`,`id`,`type`,`salary`,`provinceid`,`cityid`");
            $ResumeList=$this->obj->DB_select_all("resume_expect","`id` in(".pylode(',',$EidList).")","`id`,`name`");
			foreach($rows as $key=>$val){
				foreach($company_job as $v){
					if($val['job_id']==$v['id']){
                        /*****获取是否被邀请*********/


                        $userid_msg=$this->obj->DB_select_once("userid_msg","`fid`='".$v['uid']."' and `uid` = '" .$this->uid."'","*");

                        if($userid_msg){
                            $rows[$key]['usermes'] = 1;
                            $rows[$key]['user_mes'] = $userid_msg;
                        }else{

                            $rows[$key]['usermes'] = 0;
                        }

                        /**************************/


                        $jobtype = $this->obj->DB_select_once('comclass',"`id` = '".$v['type']."'");
                        $salary = $this->obj->DB_select_once('comclass',"`id` = '".$v['salary']."'");
                        $rows[$key]['money'] = $salary['name'];
                        $rows[$key]['type'] = $jobtype['name'];
						$rows[$key]['salary']=$v['salary'];
						$rows[$key]['provinceid']=$v['provinceid'];
						$rows[$key]['cityid']=$v['cityid'];
					}
				}


                foreach($ResumeList as $v){
					if($val['eid']==$v['id']){
						$rows[$key]['resume_name']=$v['name'];
					}
				}
			}




		}
        //筛选是否邀请$_get['is_browse'] = 8
        if($_GET['is_browse'] == 8) {
            $rows = $this->noInvite($rows);
        }

        $StateList=array('','未查看','已查看','等待通知','条件不符','无法联系');
		$this->yunset("StateList",$StateList);
		$num=$this->obj->DB_select_num("userid_job","`uid`='".$this->uid."'");
		$this->obj->DB_update_all("member_statis","sq_jobnum='".$num."'","`uid`='".$this->uid."'");
		$this->yunset("rows",$rows);
		$this->yunset("js_def",3);
		$this->user_tpl('job');
	}
	function del_action(){
		if($_GET['id']){
			$del=(int)$_GET['id'];
			$userid=$this->obj->DB_select_once("userid_job","`id`='".$del."' and `uid`='".$this->uid."'","com_id");
			$nid=$this->obj->DB_delete_all("userid_job","`id`='".$del."' and `uid`='".$this->uid."'");
			if($nid){
				$fnum=$this->obj->DB_select_num("userid_job","`uid`='".$this->uid."'","`id`");
				$this->obj->DB_update_all("member_statis","sq_jobnum='".$fnum."'","`uid`='".$this->uid."'");
				$this->obj->DB_update_all("company_statis","`sq_job`=`sq_job`-1","`uid`='".$userid['com_id']."'");
				$this->obj->member_log("删除申请的职位信息",6,3);
				$this->layer_msg('删除成功！',9,0,"index.php?c=job");
			}else{
				$this->layer_msg('删除失败！',8,0,"index.php?c=job");
			}
		}
	}
	function qs_action(){
		if($_POST['id']){
			$del=(int)$_POST['id'];
			$nid=$this->obj->DB_update_all("userid_job","`body`='".$_POST['body']."'","`id`='".$del."'");
			if($nid){
				$this->obj->member_log("取消申请的职位信息",6,3);
				$this->ACT_layer_msg('取消成功！',9,$_SERVER['HTTP_REFERER']);
			}else{
				$this->ACT_layer_msg('取消失败！',8,$_SERVER['HTTP_REFERER']);
			}
		}
	}

    public function noInvite($param)
    {
        if(!empty($param) && is_array($param)) {
           foreach($param as $key=>$val){
               if($val['usermes'] == 1) {
                   $newparam[] = $val;
               }
           }
            return $newparam;
        }
    }
}
?>