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
class ajax_controller extends friend_controller{ 
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
				$comment['ctime']=date("Y-m-d H:i",$reply['ctime']);
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
	function statelist_action(){
		$M=$this->MODEL('friend');
		$AskM=$this->MODEL('ask');
		$myfriend =$AskM->GetAtnList(array("uid"=>$this->uid));
		$fuids=array();
		foreach($myfriend as $val){
			$fuids[]=$val['sc_uid'];
		} 
		if($_POST['page']){
			$fuids[]=$this->uid;
			$where = array("`uid` in (".@implode(',',$fuids).")","type"=>'1'); 
			$limit=11;
			$page=$_POST['page']<1?1:$_POST['page'];
			$ststrsql=$page*$limit; 
			$list = $M->GetStateAll($where,array("orderby"=>"`id` DESC","limit"=>"$ststrsql,$limit"));
			
			if(is_array($list)&&$list){
				$lids=array();
				foreach($list as $val){ 
					$lids[]=$val['id'];
				} 
				$stateids=pylode(',',$lids); 
				$replylist=$M->GetFriendReplyAll(array("nid in (".$stateids.")"),array("orderby"=>"id asc"));
				if(is_array($replylist)){ 
					foreach($replylist as $v){
						if(in_array($v['uid'],$fuids)==false){$fuids[]=$v['uid'];} 
					} 
					$friendinfo=$M->GetFriendAll(array("uid in (".pylode(',',$fuids).")"),array("field"=>"`uid`,`pic`,`nickname`")); 
					$friends=array(); 
					foreach($friendinfo as $val){ 
						if($val['pic']==''){$val['pic']=$this->config['sy_weburl'].$this->config['sy_friend_icon'];}
						$friends[$val['uid']]['uid']=$val['uid'];
						$friends[$val['uid']]['pic']=$val['pic'];
						$friends[$val['uid']]['nickname']=yun_iconv("gbk", "utf-8",$val['nickname']);
					}  
					foreach($replylist as $k=>$v){
						$replylist[$k]['ctime']=date("Y-m-d H:i",$v['ctime']); 
						$replylist[$k]['nickname']=$friends[$v['uid']]['nickname'];
						$replylist[$k]['reply']= yun_iconv("gbk", "utf-8", $v['reply']);
						$replylist[$k]['pic']=$friends[$v['uid']]['pic'];  
						$replylist[$k]['url']= Url('ask',array("c"=>"friend","uid"=>$v['uid'])); 
					}
				} 
				foreach($list as $k=>$v){
					$list[$k]['ctime'] = date("Y-m-d H:i",$v['ctime']);
					$list[$k]['content'] = yun_iconv("gbk", "utf-8", $list[$k]['content']);
					$list[$k]['nickurl'] = Url('ask',array("c"=>"friend","uid"=>$v[uid]));
					$list[$k]['nickname'] = $friends[$v['uid']]['nickname'];
					$list[$k]['pic'] =$friends[$v['uid']]['pic'];  
					$list[$k]['commentnum'] = "0";
					if(is_array($replylist)){
						foreach($replylist as $kk=>$vv){
							if($vv['nid']==$v['id']){
								$list[$k]['commentnum']+=1;
								$list[$k]['reply'][]=$vv;
							}
						}
					}
				}
			} 
			echo urldecode(json_encode($list));die;
		}
	}  
}
?>