<?php
/* *
* $Author ��PHPYUN�����Ŷ�
*
* ����: http://www.phpyun.com
*
* ��Ȩ���� 2009-2015 ��Ǩ�γ���Ϣ�������޹�˾������������Ȩ����
*
* ����������δ����Ȩǰ���£�����������ҵ��Ӫ�����ο����Լ��κ���ʽ���ٴη�����
*/
class job_controller extends user{
	
	function index_action(){
        $this->yunset($this->MODEL('cache')->GetCache(array('city','com')));
		$this->public_action();
		$this->member_satic();
		$urlarr=array("c"=>"job","page"=>"{{page}}");
		$pageurl=Url('member',$urlarr);
		$rows=$this->get_page("userid_job","`uid`='".$this->uid."' order by id desc",$pageurl,"10");
		if($rows&&is_array($rows)){
			foreach($rows as $val){
				$jobids[]=$val['job_id'];
                $EidList[]=$val['eid'];
			}
			$company_job=$this->obj->DB_select_all("company_job","`id` in(".pylode(',',$jobids).")","`id`,`salary`,`provinceid`,`cityid`");
            $ResumeList=$this->obj->DB_select_all("resume_expect","`id` in(".pylode(',',$EidList).")","`id`,`name`");
			foreach($rows as $key=>$val){
				foreach($company_job as $v){
					if($val['job_id']==$v['id']){
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
        
        $StateList=array('','δ�鿴','�Ѳ鿴','�ȴ�֪ͨ','��������','�޷���ϵ');
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
				$this->obj->member_log("ɾ�������ְλ��Ϣ",6,3);
				$this->layer_msg('ɾ���ɹ���',9,0,"index.php?c=job");
			}else{
				$this->layer_msg('ɾ��ʧ�ܣ�',8,0,"index.php?c=job");
			}
		}
	}
	function qs_action(){
		if($_POST['id']){
			$del=(int)$_POST['id'];
			$nid=$this->obj->DB_update_all("userid_job","`body`='".$_POST['body']."'","`id`='".$del."'");
			if($nid){
				$this->obj->member_log("ȡ�������ְλ��Ϣ",6,3);
				$this->ACT_layer_msg('ȡ���ɹ���',9,$_SERVER['HTTP_REFERER']);
			}else{
				$this->ACT_layer_msg('ȡ��ʧ�ܣ�',8,$_SERVER['HTTP_REFERER']);
			}
		}
	}
}
?>