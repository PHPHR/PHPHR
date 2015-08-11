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
class index_controller extends ask_controller{
	function index_action(){
		$M=$this->MODEL('ask');
 		$hotuser=$M->GetHotUser(array("`add_time`>'".strtotime("-30 day")."'"),array('groupby'=>"uid","orderby"=>'num',"desc"=>'desc',"limit"=>10,"field"=>"uid,count(id) as num,sum(support) as support"));
		$this->atnask($M);
		$this->hotclass();
		$this->seo('ask_index');
		$this->yunset("hotuser",$hotuser);
		$this->ask_tpl('index');
	}

	function getcomment_action(){
		$M=$this->MODEL('ask');
		$aid=(int)$_POST['aid'];
		$comment=$M->GetCommentList(array('aid'=>$aid));
		if(is_array($comment)){
			foreach($comment as $k=>$v){
				if($v['pic']!=""){
					$comment[$k]['pic']=str_replace("..",$this->config['sy_weburl'],$v['pic']);
				}
				$comment[$k]['errorpic']=$this->config['sy_weburl']."/".$this->config['sy_friend_icon'];
				$comment[$k]['url']=Url('ask',array("c"=>"friend","uid"=>$v['uid']));
				$comment[$k]['nickname']=urlencode($v['nickname']);
				$comment[$k]['content']=urlencode($v['content']);
				$comment[$k]['date']=date("Y-m-d H:i",$v['add_time']);
				if($v['uid']==$this->uid){
					$comment[$k]['myself']='1';
				}
			}
			$comment_json = json_encode($comment);
			echo urldecode($comment_json);die;
		}
	}
	function qrepost_action(){
		$M=$this->MODEL('ask');
		$this->is_login();
		$eid=(int)$_POST['eid'];
		$reason=$_POST['reason'];
		$is_set=$M->GetReportOne(array('type'=>1,'r_type'=>1,'eid'=>$eid),array('field'=>'`p_uid`'));
		if(empty($is_set)){
            $question=$M->GetQuestionOne(array('id'=>$eid,'type'=>1),array('field'=>'`uid`'));
            $UserInfoM=$this->MODEL('userinfo');
            $FriendM=$this->MODEL('friend');
            $Userinfo=$FriendM->GetFriendInfo(array('uid'=>$question['uid']),array('field'=>'`nickname`,`uid`'));
			$my_nickname=$FriendM->GetFriendInfo(array('uid'=>$this->uid),array('field'=>'`nickname`'));
			$data['p_uid']=$this->uid;
			$data['c_uid']=$Userinfo['uid'];
			$data['eid']=(int)$_POST['eid'];
			$data['usertype']=$_COOKIE['usertype'];
			$data['inputtime']=time();
			$data['username']=$my_nickname['nickname'];
			$data['r_name']=$Userinfo['nickname'];
			$data['r_reason']=$_POST['reason'];
			$data['type']=1;
			$data['r_type']=1;
			$new_id=$M->AddReport($data);
			if($new_id){
				$M->member_log('举报问答问题');
				echo '1';
			}else{
				echo '0';
			}
		}else{
			if($is_set['p_uid']==$this->uid){
				echo '2';
			}else{
				echo '3';
			}
		}
	}
	function forcomment_action(){
		$M=$this->MODEL('ask');
		$this->is_login();
		$MemberM=$this->MODEL("userinfo");
		if($this->config['integral_answerpl_type']=="1"){
			$auto=true;
		}else{
			$statis=$MemberM->GetUserstatisOne(array("uid"=>$this->uid),array("field"=>"`integral`","usertype"=>$_COOKIE['usertype']));
			if($statis['integral']<$this->config['integral_answerpl']){
				echo "您的！".$this->config['integral_pricename']."不足，请先充值后再评论问答！";die;
			}
			$auto=false;
		}
		$MemberM->company_invtal($this->uid,$this->config['integral_answerpl'],$auto,"评论问答",true,2,'integral');
		$data['aid']=(int)$_POST['aid'];
		$data['qid']=(int)$_POST['qid'];
		$data['content']=str_replace(array("&amp;","background-color:#ffffff","background-color:#fff","white-space:nowrap;"),array("&",'background-color:','background-color:','white-space:'),html_entity_decode($_POST['content'],ENT_QUOTES,"GB2312"));
		$data['content']=iconv("utf-8","gbk",$data['content']);
		$data['uid']=$this->uid;
		$data['add_time']=time();
		$new_id=$M->AddAnswerReview($data);
		if($new_id){
			$M->member_log("评论问答");
			$num=$M->GetCommentNum(array('aid'=>(int)$_POST['aid']));
			$M->UpdateAnswer(array('comment'=>$num),array('id'=>(int)$_POST['aid']));
			echo '1';
		}else{
			echo '0';
		}
	}
	function forsupport_action(){
		$M=$this->MODEL('ask');
		if($_COOKIE['support_'.$_POST['aid']]=='1'){
			echo '2';
		}else{
			$id=$M->UpdateAnswer(array("`support`=`support`+1"),array('id'=>$_POST['aid']));
			if($id){
				$M->member_log("给问题回答点赞");
				SetCookie('support_'.$_POST['aid'],"1",time()+3600,"/");
				echo '1';
			}else{
				echo '0';
			}
		}
	}
	function answer_action(){
		$M=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		if($this->uid==''||$this->username==''){$this->ACT_layer_msg( "请先登录！",8,$_SERVER['HTTP_REFERER']);}
		$id=(int)$_POST['id'];
		if($_POST['content']&&$id){
			$MemberM=$this->MODEL("userinfo");
			if($this->config['integral_answer_type']=="1"){
				$auto=true;
			}else{
				$statis=$MemberM->GetUserstatisOne(array("uid"=>$this->uid),array("field"=>"`integral`","usertype"=>$_COOKIE['usertype']));
				if($statis['integral']<$this->config['integral_question']){
					$this->ACT_layer_msg("您的！".$this->config['integral_answer']."不足，请先充值后再回答问题！",8,$_SERVER['HTTP_REFERER']);
				}
				$auto=false;
			}
			$MemberM->company_invtal($this->uid,$this->config['integral_answer'],$auto,"回答问题",true,2,'integral');
			$info=$M->GetQuestionOne(array('id'=>$id),array('field'=>'`id`,`uid`,`title`,`content`'));
			$content = str_replace(array("&amp;","background-color:#ffffff","background-color:#fff","white-space:nowrap;"),array("&",'','',''),html_entity_decode($_POST["content"],ENT_QUOTES,"GB2312"));
			$data=array();
			$data['qid']=$id;
			$data['content']=trim($content);
			$data['uid']=$this->uid;
			$data['comment']=0;
			$data['support']=0;
			$data['oppose']=0;
			$data['add_time']=time();
			$id=$M->insert_into("answer",$data);
			if($id){
				$FriendM->SaveFriendInfo(array("`answer`=`answer`+'1'"),array("uid"=>$this->uid));
				$M->UpdateQuestion(array("`answer_num`=`answer_num`+1","lastupdate"=>time()),array('id'=>$info['id']));
				$state_content = "回答了问答《<a href=\"".Url('ask',array("c"=>"content","id"=>$id))."\" target=\"_blank\">".$info['title']."</a>》。";
				$this->addstate($state_content,2);
				$M->member_log("回答了问答《".$info['title']."》");
				$this->ACT_layer_msg( "回答成功！", 9,$_SERVER['HTTP_REFERER']);
			}else{
				$this->ACT_layer_msg( "回答失败！", 8);
			}
		}else{
			$this->ACT_layer_msg("非法操作！", 2);
		}
	}
	function addquestion_action(){
		if($this->uid==''||$this->username==''){header('Location:'.Url("login"));}
		$this->seo('ask_add_question');
		$this->ask_tpl('addquestion');
	}
	function qclass_action(){
		$CacheM=$this->MODEL('cache');
        $info=$CacheM->GetCache(array('ask'));
		$rows=array();
		$id=(int)$_POST['id'];
		foreach($info['ask_type'][$id] as $v){
			$rows[$v]=urlencode($info['ask_name'][$v]);
		}
		$rows = json_encode($rows);
		echo urldecode($rows);die;
	}
	function save_action(){
		$cid=(int)$_POST['cid'];
		if($_POST['submit']&&$cid){
			$M=$this->MODEL('ask');
			$MemberM=$this->MODEL("userinfo");
			if($this->uid==''){
				$this->ACT_layer_msg( "请先登录！", 8);
			}
			if(trim($_POST['title'])==""){
				$this->ACT_layer_msg( "标题不能为空！", 8);
			}
			if($this->config['integral_question_type']=="1"){
				$auto=true;
			}else{
				$statis=$MemberM->GetUserstatisOne(array("uid"=>$this->uid),array("field"=>"`integral`","usertype"=>$_COOKIE['usertype']));
				if($statis['integral']<$this->config['integral_question']){
					$this->ACT_layer_msg("您的！".$this->config['integral_pricename']."不足，请先充值后再发布问题！",8,$_SERVER['HTTP_REFERER']);
				}
				$auto=false;
			}
			$MemberM->company_invtal($this->uid,$this->config['integral_question'],$auto,"发布问题",true,2,'integral');
			$data['title']=$_POST['title'];
			$data['cid']=$cid;
			$data['content'] = str_replace(array("&amp;","background-color:#ffffff","background-color:#fff","white-space:nowrap;"),array("&",'','',''),html_entity_decode($_POST["content"],ENT_QUOTES,"GB2312"));
			$data['content']=strip_tags(trim($data['content']),"<p> <br> <b>");
			$data['uid']=$this->uid;
			$data['add_time']=time();
			$nid=$M->SaveQuestion($data);
		}
 		if($nid){
			$FriendM=$this->MODEL('friend');
			$sql['uid']=$this->uid;
			$sql['content']="发布了问答《<a href=\"".url("ask",array("c"=>"content","id"=>$nid))."\" target=\"_blank\">".$_POST['title']."</a>》。";
			$sql['ctime']=time();
			$sql['type']='2';
			$FriendM->SaveFriendInfo(array("`ask`=`ask`+'1'"),array("uid"=>$this->uid));
			$FriendM->InsertFriendState($sql);
			$M->member_log("发布了问答《".$_POST['title']."》");
 			$this->ACT_layer_msg( "提问成功！",9,url("ask",array("c"=>"index")));
		}else{
			$this->ACT_layer_msg( "提问失败！", 8);
		}
	}

	function hotweek_action(){
		$M=$this->MODEL('ask');
		$recom=$M->RecomFriend(array('iscert'=>'1',"`pic`<>''","uid"=>$this->uid),array('orderby'=>'rand()','limit'=>12,"field"=>"`uid`,`nickname`,`pic`"));
		$this->atnask($M);
		$this->yunset("recom",$recom);
		$this->yunset("navtype",'hotweek');
		$this->seo('ask_hot_week');
		$this->ask_tpl('hotweek');
	}
	function getclass_action(){
		$M=$this->MODEL('ask');
		$this->yunset("cid",$_GET['cid']);
		$this->yunset("recom",$_GET['recom']);
		$this->yunset("c","topic");
		$this->seo('ask_topic');
		$this->ask_tpl('get_class');
	}

}
?>