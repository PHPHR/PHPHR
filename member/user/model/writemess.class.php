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
class writemess_controller extends user{
	function index_action(){

        /******获取发送总数*****/

        $where_num.= " `uid`='".$this->uid."' order by ctime desc";
        $num = $this->obj->DB_select_all("friend_message",$where_num);
        $fanum_count = 0;
        if(is_array($num)) {
            foreach($num as $v) {
                $fanum_count++;
            }
        }
        /**********end****************************/

        /*************获取收件总数***********/
        $xin_where_num .= "`fid`='".$this->uid."' and `status`<>'1' order by ctime desc";
        $shou_num = $this->obj->DB_select_all("friend_message",$xin_where_num);
        $shounum_count = 0;
        if(is_array($shou_num)) {
            foreach($shou_num as $v) {
                $shounum_count++;
            }
        }
        /*****************end****************/

		//$where.= "`uid`='".$this->uid."' or (`fid`='".$this->uid."' and `status`<>'1') order by ctime desc";
		$where.= " `uid`='".$this->uid."' order by ctime desc";//收件
		$urlarr["c"] = $_GET["c"];
		$urlarr["page"] = "{{page}}";
		$pageurl = Url('member',$urlarr);
		$rows=$this->get_page("friend_message",$where,$pageurl,"10");
		if(is_array($rows)){
			foreach($rows as $v){
				$uids[]=$v['uid'];
                $uids[]=$v['fid'];
			}
			$statis =$this->obj->DB_select_all("friend_info","`uid` in (".pylode(",",$uids).")","uid,nickname");
			foreach($rows as $key=>$value){
				$rows[$key]['ctime'] = date("Y-m-d H:i",$value['ctime']);
				foreach($statis as $k=>$v){
					if($value['uid']==$v['uid']){
						  $rows[$key]['nickname'] = $v['nickname'];
					}
					if($value['fid']==$v['uid']){
						  $rows[$key]['name'] = $v['nickname'];
					}
				}
			}
		}

		$this->yunset("rows",$rows);
        $this->yunset('shounum',$shounum_count);
        $this->yunset('fanum',$fanum_count);
		$this->public_action();		
		$this->obj->DB_update_all("friend_message","`remind_status`='1'","`fid`='".$this->uid."' and `remind_status`='0'");
		$this->unset_remind("friend_message1","1");
		$this->user_tpl('writemess');
	}
    function save_action(){

        if($_POST['sub']){
            if($this->uid==''){
                echo "<script>alert('请先登录');window.history.back(-1);</script>";
                die;
            }
            $MemberM=$this->MODEL("userinfo");
            if($this->config['integral_friend_msg_type']=="1"){
                $auto=true;
            }else{
                $statis=$MemberM->GetUserstatisOne(array("uid"=>$this->uid),array("field"=>"`integral`","usertype"=>$_COOKIE['usertype']));
                if($statis['integral']<$this->config['integral_friend_msg']){
                    $this->ACT_layer_msg("您的！".$this->config['integral_pricename']."不足，请先充值后再留言！",8,$_SERVER['HTTP_REFERER']);
                }
                $auto=false;
            }
            $MemberM->company_invtal($this->uid,$this->config['integral_friend_msg'],$auto,"朋友圈留言",true,2,'integral');
            if(trim($_POST['content'])==''){
                echo "<script>alert('内容不能为空');window.history.back(-1); </script>";
                die;
            }
            /*******************find the user from the username ***********/

            $user = $this->findUser($_POST['username']);

            if(empty($user)) {
                echo "<script>alert('收件人不存在');window.history.back(-1);</script>";
                die;
            }


            /**********************************************/


            $data['content']=trim($_POST['content']);
            $data['uid']=$this->uid;
            $data['fid']=(int)$user['uid'];
            $data['ctime']=time();
            $data['title'] = $_POST['title'];
            $M=$this->MODEL("friend");
            $nid=$M->InsertFriendMessage($data);
            //$nid?$this->ACT_layer_msg("回复成功！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("回复失败！",8,$_SERVER['HTTP_REFERER']);
            $nid?$this->wriscript('回复成功',$this->config['sy_weburl'].'/member/index.php?c=writemess') : $this->wriscript('回复失败');
        }
    }
	function del_action(){
		if($_GET['id']){
			$id=(int)$_GET['id'];
			$nid = $this->obj->DB_delete_all("friend_message","`id`='".$id."' and `uid`='".$this->uid."'");
		}else{
			$did=(int)$_GET['did'];
			$nid = $this->obj->update_once('friend_message',array('status'=>1),array('id'=>$did,'fid'=>$this->uid));
		}
		if($nid){
			$this->obj->member_log("删除站内信");
			$this->layer_msg('删除成功！',9);
		}else{
			$this->layer_msg('删除失败！',8);
		}
	}

    /**
     * @author  angry
     * @param varchar $username
     * @return array || boolen
     */
    public function findUser($username)
    {
        $Member      = $this->MODEL('userinfo');
        $memberinfo  = $Member->GetMemberOne(['username'=>$username],array('field'=>'*'));
        return empty($memberinfo)? false : $memberinfo;
    }

    public function wriscript($char,$url="")
    {

        if($url == "") {

            echo "<script>alert('".$char."');window.history.back(-1); </script>";
            die;
        }else{

            echo "<script>alert('".$char."');window.location.href= '".$url."' </script>";
            die;
        }

    }
}
?>