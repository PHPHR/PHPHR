<?php
/* *
* $Author ��PHPYUN�����Ŷ�
*
* ����: http://www.phpyun.com
*
* ��Ȩ���� 2009-2015 ��Ǩ�γ���Ϣ�������޹�˾������������Ȩ����
*
* ���������δ����Ȩǰ���£�����������ҵ��Ӫ�����ο����Լ��κ���ʽ���ٴη�����
*/
class sysnews_controller extends user{
	function index_action(){

        /******��ȡ��������*****/

        $where_num.= " `uid`='".$this->uid."' order by ctime desc";
        $num = $this->obj->DB_select_all("friend_message",$where_num);
        $fanum_count = 0;
        if(is_array($num)) {
            foreach($num as $v) {
                $fanum_count++;
            }
        }
        /**********end****************************/

        /*************��ȡ�ռ�����***********/
        $xin_where_num .= "`fid`='".$this->uid."' and `status`<>'1' order by ctime desc";
        $shou_num = $this->obj->DB_select_all("friend_message",$xin_where_num);
        $shounum_count = 0;
        if(is_array($shou_num)) {
            foreach($shou_num as $v) {
                $shounum_count++;
            }
        }
        /*****************end****************/

        $where = '';
		$where.= "`fa_uid`='".$this->uid."' order by id desc";
		$urlarr["c"] = $_GET["c"];
		$urlarr["page"] = "{{page}}";
		$pageurl = Url('member',$urlarr);
		$rows=$this->get_page("sysmsg",$where,$pageurl,"10");
		$this->obj->DB_update_all("sysmsg","`remind_status`='1'","`fa_uid`='".$this->uid."' and `remind_status`='0'");
		$this->unset_remind("sysmsg1",'1');
		$this->public_action();
        $this->yunset('shounum',$shounum_count);
        $this->yunset('fanum',$fanum_count);
		$this->user_tpl('sysnews');
	}
	function del_action(){
		$nid = $this->obj->DB_delete_all("sysmsg","`id`='".(int)$_GET['id']."' and `fa_uid`='".$this->uid."'");
		if($nid){
			$this->unset_remind("sysmsg1",'1');
			$this->obj->member_log("ɾ��ϵͳ��Ϣ");
			$this->layer_msg('ɾ���ɹ���',9);
		}else{
			$this->layer_msg('ɾ��ʧ�ܣ�',8);
		}
	}
}
?>