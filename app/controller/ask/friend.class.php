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
class friend_controller extends ask_controller{
	function index_action(){
		$uid=(int)$_GET['uid'];
		if($uid==''){
			$uid=$this->uid;
		}
		$AskM=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		$page_url['c'] = $_GET['c'];
		$page_url['uid'] = $_GET['uid'];
		$page_url['page'] = "{{page}}";
		$pageurl=Url('ask',$page_url);
		$rows = $this->get_page("friend_state","`uid`='".$uid."' and `type`='1' order by ctime desc",$pageurl,'10');
		if(is_array($rows)&&$rows){
			$fsids=$fuid=array();
			foreach($rows as $val){
				$fsids[]=$val['id'];
			} 
			$replylist=$FriendM->GetFriendReplyAll(array("`nid` in (".pylode(',',$fsids).")"),array("orderby"=>"id asc","field"=>"`nid`,`uid`,`ctime`,`reply`"));

			if(is_array($replylist)){
				foreach($replylist as $v){
					if(in_array($v['uid'],$fuid)==false){$fuid[]=$v['uid'];}
				}
				if(count($fuid)){
					$friendinfo=$FriendM->GetFriendAll(array("uid in (".pylode(',',$fuid).")"),array("field"=>"`uid`,`pic`,`nickname`")); 
				}
				foreach($replylist as $k=>$v){
					foreach($friendinfo as $val){
						if($v['uid']==$val['uid']){
							$replylist[$k]['url']=Url('ask',array("c"=>"friend","uid"=>$val['uid']));
							$replylist[$k]['replyctime']=date("Y-m-d H:i:s",$v['ctime']);
							$replylist[$k]['replyname']=$val['nickname'];
							if($val['pic']){
								$replylist[$k]['replypic']= str_replace("..",$this->config['sy_weburl'],$val['pic']);
							}else{
								$replylist[$k]['replypic']=$this->config['sy_friend_icon'];
							}
						}
					}
				}
			} 
			foreach($rows as $key=>$val){
				$rows[$key]['commentnum'] = "0";
				$rows[$key]['ctime'] = date("Y-m-d H:i:s",$val['ctime']);
				foreach($replylist as $v){
					if($val['id']==$v['nid']){
						$rows[$key]['commentnum']+=1;
						$rows[$key]['reply'][$rows[$key]['commentnum']]= $v;
					}
				}

			}
			$this->yunset("rows",$rows);
			$this->yunset("msgnum",count($rows));
		}
		if($this->uid){
			$member=$FriendM->GetFriendInfo(array("uid"=>$this->uid),array("field"=>'pic,uid'));
			$this->yunset("member",$member);
		}
		$this->friendfoot($uid,$AskM);
		$this->myfoot($uid,$FriendM);
		$this->myfans($AskM,$uid);
		$this->isatn($AskM,$uid);
		$this->myinfo($FriendM,$uid);
		$this->seo('message');
		$this->yunset("navtype",'myquestion');
		$this->yunset("uid",$uid);
		$this->ask_tpl('message');
	}
	function delm_action(){
		if($_GET['id']){
			$M=$this->MODEL('friend');
			$did=$M->DeleteFriendInfo(array("id"=>(int)$_GET['id'],"uid"=>$this->uid),array("table"=>"state"));
			if($did){
				$M->DeleteFriendInfo(array("nid"=>(int)$_GET['id']),array("table"=>"reply"));
				$M->member_log("删除朋友圈动态");
				$this->layer_msg('删除成功！',9,0);
			}else{
				$this->layer_msg('删除失败！',8,0);
			}
		}
	}
	function friendreply_action(){
		if($_COOKIE['uid']>0){
			if($_POST['nid']){
				$M=$this->MODEL('friend');
				$_POST['reply'] = $this->stringfilter($_POST['reply']);
				$M->InsertFriendReply(array('nid'=>(int)$_POST['nid'],'reply'=>$_POST['reply'],'fid'=>(int)$_POST['fid'],'uid'=>$this->uid,'ctime'=>time()));
				if($_POST['fid']!=$this->uid){
					$msg_content = "您的动态有了新的回复！";
					$this->automsg($msg_content,(int)$_POST['fid']);
					$M->member_log("回复动态");
				}
				$reply=$M->GetFriendReplyOne(array("nid"=>(int)$_POST['nid']),array("orderby"=>"id desc"));
				$info=$M->GetFriendInfo(array("uid"=>$reply['uid']));
				$comment['ctime']=date("Y-m-d H:i:s",$reply['ctime']);
				if($info['pic']==""){
					$comment['pic'] = $this->config['sy_weburl']."/".$this->config['sy_friend_icon'];
				}else{
					$comment['pic'] = str_replace("..",$this->config['sy_weburl'],$info['pic']);
				}
				$comment['url'] = Url('ask',array('c'=>'friend','uid'=>$reply["uid"]));
				$comment['nickname'] = yun_iconv("gbk", "utf-8",$info['nickname']);
				$comment['reply'] = yun_iconv("gbk", "utf-8",$reply['reply']);
				echo urldecode(json_encode($comment));die;
			}
		}else{
			echo 1;die;
		}
	}
	function myquestion_action(){
		$uid=(int)$_GET['uid'];
		if($uid==''){
			$uid=$this->uid;
		}
		$AskM=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		$this->friendfoot($uid,$AskM);
		$this->myfans($AskM,$uid);
		$this->isatn($AskM,$uid);
		$this->myinfo($FriendM,$uid);
		$this->myfoot($uid,$FriendM);
		$this->yunset("navtype",'myquestion');
		$this->yunset("uid",$uid);
		$this->seo("myquestio");
		$this->ask_tpl('myquestion');
	}
	function myanswer_action(){
		$M=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		$uid=(int)$_GET['uid'];
		if($uid==''){
			$uid=$this->uid;
		}
		$pageurl=Url('ask',array("c"=>$_GET['c'],'a'=>$_GET['a'],'uid'=>$uid,"page"=>"{{page}}"));
		$rows=$M->get_page("answer","`uid`='".$uid."' order by `add_time` desc",$pageurl,"10");
		if($rows['total']){
			foreach($rows['rows'] as $v){
				$qid[]=$v['qid'];
			}
			$question=$M->GetQuestionList(array("`id` in (".pylode(',',$qid).")"),array('field'=>'`id` as `qid`,`title`'));
			foreach($rows['rows'] as $key=>$val){
				foreach($question as $k=>$v){
					if($val['qid']==$v['qid']){
						$rows['rows'][$key]['title']=$v['title'];
						$rows['rows'][$key]['qid']=$v['qid'];
					}
				}
			}
		}
		$this->isatn($M,$uid);
		$this->myfans($M,$uid);
		$this->myinfo($FriendM,$uid);
		$this->friendfoot($uid,$M);
		$this->myfoot($uid,$FriendM);
 		$this->yunset($rows);
		$this->yunset("navtype","myquestion");
		$this->seo("myanswer");
		$this->ask_tpl('myanswer');
 	}
	function attenquestion_action(){
		$M=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		$uid=(int)$_GET['uid'];
		if($uid==''){
			$uid=$this->uid;
		}
        $atnlist=$M->GetAttentionList(array('uid'=>$uid,'type'=>1),array('field'=>'ids'));
		$ids=array_filter(@explode(',',$atnlist['ids']));
		if(count($ids)){
			$pageurl=Url('ask',array("c"=>$_GET['c'],'a'=>$_GET['a'],'uid'=>$uid,"page"=>"{{page}}"));
			$rows=$M->get_page("question","`id` in (".pylode(',',$ids).") order by `add_time` desc",$pageurl,"10");
		}
		$this->myinfo($FriendM,$uid);
		$this->myfans($M,$uid);
		$this->isatn($M,$uid);
		$this->friendfoot($uid,$M);
		$this->myfoot($uid,$FriendM);
		$this->yunset($rows);
		$this->yunset("navtype",'myquestion');
		$this->seo('attenquestion');
		$this->ask_tpl('attenquestion');
	}

	function myatn_action(){
		$M=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		$uid=(int)$_GET['uid'];
		if($uid==''){
			$uid=$this->uid;
		}
		$pageurl=Url('ask',array("c"=>$_GET['c'],'a'=>'myatn','uid'=>$_GET['uid'],"page"=>"{{page}}"));
		$rows=$M->get_page("atn","`uid`='".$uid."' order by `time` desc",$pageurl,"14");
		if($rows['rows']&&is_array($rows['rows'])){
			$uids=array();
			foreach($rows['rows'] as $key=>$val){
				$uids[]=$val['sc_uid'];
			}
			$friend=$FriendM->GetFriendAll(array("`uid` in(".pylode(',',$uids).")"),array("field"=>"`uid`,`nickname`,`pic`,`ask`,`answer`,`fans`,`description`"));
			foreach($rows['rows'] as $key=>$val){
				foreach($friend as $v){
					if($val['sc_uid']==$v['uid']){
						if($v['pic']==''){
							$v['pic']=$this->config['sy_weburl'].'/'.$this->config['sy_friend_icon'];
						}
						$v['url']=Url("ask",array("c"=>"friend","uid"=>$v['uid']));
						$rows['rows'][$key]=array_merge($rows['rows'][$key],$v);
					}
				}
			}
		}
		$this->isatn($M,$uid);
		$this->myinfo($FriendM,$uid);
		$this->myfans($M,$uid);
		$this->friendfoot($uid,$M);
		$this->myfoot($uid,$FriendM);
		$this->yunset($rows);
		$this->yunset("navtype",'myquestion');
		$this->seo('myatn');
		$this->ask_tpl('myatn');
	}
	function myfans_action(){
		$M=$this->MODEL('ask');
		$FriendM=$this->MODEL('friend');
		$uid=(int)$_GET['uid'];
		if($uid==''){
			$uid=$this->uid;
		}
		$pageurl=Url('ask',array("c"=>$_GET['c'],'a'=>"myfans",'uid'=>$uid,"page"=>"{{page}}"));
		$rows=$M->get_page("atn","`sc_uid`='".$uid."' order by `time` desc",$pageurl,"10");
		if($rows['rows']&&is_array($rows['rows'])){
			$uids=array();
			foreach($rows['rows'] as $key=>$val){
				$uids[]=$val['uid'];
			}
			if($_COOKIE['uid']!="")
			{
				$fanlist=$M->GetAtnList(array("`sc_uid` in(".pylode(',',$uids).")","uid"=>$uid),array("field"=>"sc_uid"));
			}
			$friend=$FriendM->GetFriendAll(array("`uid` in(".pylode(',',$uids).")"),array("field"=>"`uid`,`nickname`,`pic`,`ask`,`answer`,`fans`,`description`,`atnnum`"));
			foreach($rows['rows'] as $key=>$val){
				foreach($friend as $v){
					if($val['uid']==$v['uid']){
						if($v['pic']==''){
							$v['pic']=$this->config['sy_weburl'].'/'.$this->config['sy_friend_icon'];
						}
						$v['url']=Url("ask",array("c"=>"friend","uid"=>$v['uid']));
						$rows['rows'][$key]=array_merge($rows['rows'][$key],$v);
					}
				}
				$rows['rows'][$key]['atn']=0;
				foreach($fanlist as $v)
				{
					if($val['uid']==$v['sc_uid']){
						$rows['rows'][$key]['atn']=1;
					}
				}
			}
		}
		$this->myfans($M,$uid);
		$this->friendfoot($uid,$M);
		$this->myinfo($FriendM,$uid);
		$this->myfoot($uid,$FriendM);
		$this->isatn($M,$uid);
 		$this->yunset($rows);
		$this->yunset("navtype",'myquestion');
		$this->seo('myfans');
		$this->ask_tpl('myfans');
	}
	function attention_action(){
		$M=$this->MODEL('ask');
		if($this->uid==''||$this->username==''){
			$this->layer_msg('请先登录！',8,0,$_SERVER['HTTP_REFERER']);
		}
		$this->is_login();
		$id = (int)$_POST['id'];
		$type = (int)$_POST['type'];
		if($id==''&&(int)$_GET['id']){
			$id=(int)$_GET['id'];
			$type=1;
		}
		$isset=$M->GetAttentionList(array('uid'=>$this->uid,'type'=>$type));
		$ids=@explode(',',$isset['ids']);
		if($type=='1'){
			$info=$M->GetQuestionOne(array('id'=>$id),array('field'=>"`id`,`title`,`uid`,`atnnum`"));
			$gourl=url('ask',array("c"=>"content","id"=>$info['id']));
			$content="关注了<a href=\"".$gourl."\" target=\"_blank\">《".$info['title']."》</a>。";
			$n_contemt="取消了对<a href=\"".$gourl."\" target=\"_blank\">《".$info['title']."》</a>的关注。";
			$log="关注了《".$info['title']."》";
			$n_log="取消了对《".$info['title']."》";
		}else{
			$info=$M->GetQclassOnce(array('id'=>$id),array('field'=>"`id`,`name`,`atnnum`"));
			$content="关注了《".$info['name']."》。";
			$n_contemt="取消了《".$info['name']."》。";
			$log="关注了".$info['name'];
			$n_log="取消了对".$info['name']."</a>的关注。";
		}
		if($info['uid']==$this->uid){
			$this->layer_msg('不能关注自己发布的问题！',8,0,$_SERVER['HTTP_REFERER']);
		}else{
			$data['uid']=$this->uid;
			$data['type']=$type;
			$arr['isadd']=1;
			if($ids[0]==''){
				$data['ids']=$id;
				$nid=$M->AddAttention($data);
			} else if(in_array($id,$ids)&&$ids[0]){
				$nids=array();
				foreach($ids as $val){
					if($val!=$id&&$val&&in_array($val,$nids)==false){
						$nids[]=$val;
					}
				}
				$arr['isadd']=0;
				$data['ids']=pylode(',',$nids);
				$nid=$M->UpdateAttention($data,array("id"=>$isset['id']));
			}else if(in_array($id,$ids)==false&&$ids[0]>0){
				$ids[]=$id;
				$data['ids']=pylode(',',$ids);
				$nid=$M->UpdateAttention($data,array("id"=>$isset['id']));
			}else if(in_array($_POST['id'],$ids)==false&&$ids[0]<1){
				$nid=$M->UpdateAttention(array("ids"=>$id),array("id"=>$isset['id']));
			}
			if($nid){
				if($data['type']=='1'){
					if($arr['isadd']){
						$atnnum=$info['atnnum']+1;
						$M->UpdateQuestion(array("atnnum"=>$atnnum),array("id"=>$info['id']));
					}else{
						$atnnum=$info['atnnum']-1;
						$M->UpdateQuestion(array("atnnum"=>$atnnum),array("id"=>$info['id']));
					}
				}
				if($data['type']=='2'){
					include(LIB_PATH."cache.class.php");
					$cacheclass= new cache(PLUS_PATH,$this->obj);
					$makecache=$cacheclass->ask_cache("ask.cache.php");
				}
				$sql['uid']=$this->uid;
				$sql['content']=$content;
				$sql['ctime']=time();
				$sql['type']=2;
				$Friend=$this->MODEL("friend");
				$Friend->InsertFriendState($sql);
				$M->member_log($log);
				if($atnnum<0){$atnnum=0;}
				if($_GET['id']){
					$this->layer_msg('操作成功！',9,0,$_SERVER['HTTP_REFERER']);
				}else{
					$this->layer_msg('操作成功！',9,0,$atnnum,$arr['isadd']);
				}
			}else{
				$this->layer_msg('操作失败！',8,0,$_SERVER['HTTP_REFERER']);
			}
		}
	}
	function delattention_action(){
		$M=$this->MODEL('ask');
		$atnlist=$M->GetAttentionList(array('uid'=>$this->uid,'type'=>(int)$_GET['type']),array('field'=>'id'));
        $nids=@explode(',',$atnlist['ids']);
		foreach($nids as $k=>$v){
			if($_POST['id']!=$v&&$v){
				$upid[]=$v;
			}
		}
		if(count($upid)){
			$nid=$M->UpdateAttention(array("ids"=>pylode(',',$upid)),array("uid"=>$this->uid));
			if($nid){
				$M->member_log("删除关注的问题");
				$this->layer_msg('操作成功！',9,0,$_SERVER['HTTP_REFERER']);
			}else{
				$this->layer_msg('操作失败！',8,0,$_SERVER['HTTP_REFERER']);
			}
		}else{
			$M->DeleteAttention(array("`uid`='".$this->uid."'"));
			$M->member_log("删除关注的问题");
			$this->layer_msg('操作成功！',9,0,$_SERVER['HTTP_REFERER']);
		}
	}
	function delask_action(){
		$id=(int)$_GET['id'];
		if($id){
			$AskM=$this->MODEL('ask');
			$result=$AskM->DeleteQuestion(array("id"=>$id,"uid"=>$this->uid));
			$result?$this->layer_msg('操作成功！',9,0,$_SERVER['HTTP_REFERER']):$this->layer_msg('操作失败！',8,0,$_SERVER['HTTP_REFERER']);
		}
	}
	 function atnuser_action(){
		$id=(int)$_POST['id'];
		if($id>0){
			if($this->uid){
				if($_POST['id']==$this->uid){
					echo 4;die;
				}
                $M=$this->MODEL('ask');
				$FriendM=$this->MODEL('friend');
				$atninfo = $M->GetAtnOne(array('uid'=>$this->uid,'sc_uid'=>$id));
                 $UserInfoM=$this->MODEL('userinfo');
                $user=$UserInfoM->GetMemberOne(array('uid'=>$id),array('field'=>'`usertype`'));
				$comurl = url("ask",array("c"=>"friend","uid"=>$id));
				$row=$FriendM->GetFriendInfo(array('uid'=>$id));
				$name = $row['nickname'];
				if(is_array($atninfo)&&!empty($atninfo)){
					$M->DeleteAtn(array('uid'=>$this->uid,'sc_uid'=>$id));
                    $FriendM->SaveFriendInfo(array('`fans`=`fans`-1'),array('uid'=>$id));
                    $FriendM->SaveFriendInfo(array('`atnnum`=`atnnum`-1'),array('uid'=>$this->uid));
					$this->addstate("取消了对<a href=\"".$comurl."\">".$name."</a>的关注！",2);
					$this->automsg("用户 ".$this->username." 取消了对你的关注！",$id);
					$M->member_log("取消了对".$name."的关注！");
					echo "2";die;
				}else{
					$M->insert_into("atn",array('uid'=>$this->uid,'sc_uid'=>$id,'usertype'=>(int)$_COOKIE['usertype'],'sc_usertype'=>$user['usertype'],'time'=>time()));
					$FriendM->SaveFriendInfo(array('`fans`=`fans`+1'),array('uid'=>$id));
					$FriendM->SaveFriendInfo(array('`atnnum`=`atnnum`+1'),array('uid'=>$this->uid));
					$this->addstate("关注了<a href=\"".$comurl."\">".$name."</a>",2);
					$this->automsg("用户 ".$this->username." 关注了你！",$id);
					$M->member_log("关注了".$name);
					echo "1";die;
				}
			}else{
				echo "3";die;
			}
		}
	}
	function isatn($M,$uid){
		if($this->uid&&$this->uid!=$uid){
			$info=$M->GetAtnOne(array("sc_uid"=>$uid,"uid"=>$this->uid));
			$this->yunset("isatn",$info[id]);
		}
	}
	function save_action(){
		if($_POST['submit']){
			if($this->uid==''){
				$this->ACT_layer_msg("请先登录！",8,$_SERVER['HTTP_REFERER']);
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
				$this->ACT_layer_msg("留言内容不能为空！",8);
			}
			if((int)$_POST['uid']==$this->uid){
				$this->ACT_layer_msg("不能给自己留言！",8,$_SERVER['HTTP_REFERER']);
			}
			$data['content']=trim($_POST['content']);
			$data['uid']=$this->uid;
			$data['fid']=(int)$_POST['uid'];
			$data['ctime']=time();
			$M=$this->MODEL("friend");
			$nid=$M->InsertFriendMessage($data);
			$nid?$this->ACT_layer_msg("回复成功！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("回复失败！",8,$_SERVER['HTTP_REFERER']);
		}
	}
}
?>