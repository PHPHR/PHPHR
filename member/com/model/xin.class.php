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
class xin_controller extends company{
	
	function index_action()
	{
		$where.= "`uid`='".$this->uid."' or (`fid`='".$this->uid."' and `status`<>'1') order by ctime desc";
		$urlarr['c'] = $_GET['c'];
		$urlarr["page"] = "{{page}}";
		$pageurl=Url('member',$urlarr);
		$rows=$this->get_page("friend_message",$where,$pageurl,"12");
		if(is_array($rows))
		{
			foreach($rows as $v)
			{
				$uid[]=$v['uid'];
				$uid[]=$v['fid'];
			}
			$statis =$this->obj->DB_select_all("friend_info","`uid` in (".pylode(",",$uid).")","`uid`,`nickname`");
			foreach($rows as $key=>$value)
			{
				foreach($statis as $k=>$v)
				{
					if($value['uid']==$v['uid'])
					{
						  $rows[$key]['nickname'] = $v['nickname'];
					}
					if($value['fid']==$v['uid'])
					{
						  $rows[$key]['name'] = $v['nickname'];
					}
				}
			}
		}
		$this->yunset("ownuid",$this->uid);
		$this->yunset("rows",$rows);
		$this->obj->DB_update_all("friend_message","`remind_status`='1'","`fid`='".$this->uid."' and `remind_status`='0'");
		$this->unset_remind("friend_message2",'2');
		$this->public_action();
		$this->yunset("js_def",7);
		$this->com_tpl('xin');
	}
	function save_action()
	{
		if($_POST['submit']){
			if($this->config['integral_friend_reply_type']=="1"){
				$auto=true;
			}else{
				$statis=$this->obj->DB_select_once("company_statis","`uid`='".$this->uid."'","`integral`");
				if($statis['integral']<$this->config['integral_friend_reply']){
					$this->ACT_layer_msg("您的！".$this->config['integral_pricename']."不足，请先充值后再回复！",8,$_SERVER['HTTP_REFERER']);
				}
				$auto=false;
			}
			$this->company_invtal($this->uid,$this->config['integral_friend_reply'],$auto,"朋友圈回复",true,2,'integral');
			$data['content']=trim($_POST['content']);
			$data['ctime']=time();
			$data['pid']=intval($_POST['pid']);
			$data['fid']=intval($_POST['fid']); 
			$data['uid']=$this->uid;
			$nid=$this->obj->insert_into("friend_message",$data);
			if($nid){
				$this->obj->member_log("回复站内信");
				$this->ACT_layer_msg("回复成功！",9,$_SERVER['HTTP_REFERER']);
			}else{
				$this->ACT_layer_msg("添加失败！",8,$_SERVER['HTTP_REFERER']);
			}
		}
	}
	function del_action(){
		if($_GET['id']){
			$nid = $this->obj->DB_delete_all("friend_message","`id`='".(int)$_GET['id']."' and `uid`='".$this->uid."'");
		}else{
			$where['id']=(int)$_GET['did'];
			$where['fid']=$this->uid;
			$nid = $this->obj->update_once("friend_message",array("status"=>"1"),$where);
		}
		if($nid){
			$this->unset_remind("friend_message2",'2');
			$this->obj->member_log("删除站内信");
			$this->layer_msg('删除成功！',9,0,$_SERVER['HTTP_REFERER']);
		}else{
			$this->layer_msg('删除失败！',8,0,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>