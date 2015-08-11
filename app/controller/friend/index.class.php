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
class index_controller extends friend_controller{
	function index_action(){
		$M=$this->MODEL('friend');
		$AskM=$this->MODEL('ask');
		$this->yunset("id",$_GET['id']);
		$this->public_action($M);
		if($this->uid){
			$myfriend =$AskM->GetAtnList(array("uid"=>$this->uid));
			$fuids=array();
			foreach($myfriend as $val){
				$fuids[]=$val['sc_uid'];
			}
			$fuids[] = $this->uid;
		}
		if(count($fuids)){
			$Where=array("`uid` in (".@implode(',',$fuids).")",'type'=>'1');
			$pages=$M->GetStatePage($Where);
			$this->yunset("pages",$pages);
			$list=$M->GetStateAll($Where,array("orderby"=>"`id` desc","limit"=>"11"));
		}

		if(is_array($list)&&$list){
			foreach($list as $val){
				$lids[]=$val['id'];
			}
			$stateids=pylode(',',$lids);
			$replylist=$M->GetFriendReplyAll(array("nid in (".$stateids.")"),array("orderby"=>"id asc"));
			foreach($replylist as $v){
				if(in_array($v['uid'],$fuids)==false){$fuids[]=$v['uid'];}
			}
			$friendinfo=$M->GetFriendAll(array("uid in (".pylode(',',$fuids).")"),"`uid`,`pic`,`nickname`");
			$friends=array();

			foreach($friendinfo as $val){
				if($val['pic']==''){$val['pic']=$this->config['sy_weburl'].$this->config['sy_friend_icon'];}
				$friends[$val['uid']]['uid']=$val['uid'];
				$friends[$val['uid']]['pic']=$val['pic'];
				$friends[$val['uid']]['nickname']=$val['nickname'];
			}
			foreach($replylist as $k=>$v){
				$replylist[$k]['ctime']=date("Y-m-d H:i",$v['ctime']);
				$replylist[$k]['nickname']=$friends[$v['uid']]['nickname'];
				$replylist[$k]['pic']=$friends[$v['uid']]['pic'];
				$replylist[$k]['url']= Url('ask',array("c"=>"friend","uid"=>$v['uid']));
			}
			foreach($list as $k=>$v){
				$list[$k]['pic'] = $friends[$v['uid']]['pic'];
				$list[$k]['ctime'] = date("Y-m-d H:i",$v['ctime']);
				$list[$k]['nickname'] =$friends[$v['uid']]['nickname'];
				$list[$k]['nickurl'] = Url('ask',array("c"=>"friend","uid"=>$v[uid]));
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
		$this->himan($M);
		$this->myfoot((int)$_GET['id'],$M);
		$this->yunset("list",$list);
		$this->seo("fri_index");
		$this->yunset("usertype",$this->usertype);
		$this->yunset("class","1");
		$this->friend_tpl('index');
	}
	function reply_action(){
		$M=$this->MODEL("friend");
		$data['pid']=(int)$_POST['pid'];
		$data['content']=yun_iconv("utf-8","gbk",$_POST['content']);
		$data['fid']=(int)$_POST['fid'];
		$data['status']=0;
		$data['ctime']=time();
		$data['uid']=$this->uid;
		$nid=$M->InsertFriendMessage($data);
		if($nid){
			$M->member_log("回复朋友圈留言");
			$this->get_integral_action($this->uid,"integral_friend_reply","朋友圈回复");
			echo '1||'.date("Y-m-d H:i:s");
		}else{
			echo '0||0';
		}
	}
	function messagelist_action(){
		$M=$this->MODEL('friend');
		$this->public_action($M);
		$this->myfoot($this->uid,$M);
		$this->seo("fri_messagelist");
		$this->leftinfo_action($M,$this->uid);
		$page_url['c'] = $_GET['c'];
		$page_url['page'] = "{{page}}";
		$pageurl=Url('friend',$page_url);
		$rows = $M->get_page("friend_message","(`uid`='".$this->uid."' or `fid`='".$this->uid."') and `pid`='0' order by ctime desc",$pageurl,"10",'*','mlist');
		if($rows['total']){
			if(is_array($rows['mlist'])&&$rows['mlist']){
				$ruid=$userinfo=array();
				foreach($rows['mlist'] as $v){
					$msgid[]=$v['id'];
					if(in_array($v['uid'],$ruid)==false){$ruid[]=$v['uid'];}
					if(in_array($v['fid'],$ruid)==false){$ruid[]=$v['fid'];}
				}
				$msgids=pylode(',',$msgid);
				$reply=$M->GetMessageList(array("`pid` in (".$msgids.")"),array("orderby"=>"`id` asc","field"=>"ctime,uid,fid,`pid`,`content`,`id`"));
				if(is_array($reply)){
					foreach($reply as $val){
						if(in_array($val['uid'],$ruid)==false){$ruid[]=$val['uid'];}
						if(in_array($val['fid'],$ruid)==false){$ruid[]=$val['fid'];}
					}
				}

				$info = $M->GetFriendAll(array("`uid` in (".pylode(',',$ruid).")"),array("field"=>"`uid`,`nickname`,`pic`"));
				if($info&&is_array($info)){
					foreach($info as $val){
						$userinfo[$val['uid']]['nickname']=$val['nickname'];
						$val['pic']?$userinfo[$val['uid']]['pic']=$val['pic']:$userinfo[$val['uid']]['pic']=$this->config['sy_friend_icon'];
					}
				}
				if(is_array($reply)){
					foreach($reply as $k=>$v){
						$reply[$k]['id']=$v['id'];
						$reply[$k]['u_name']=$userinfo[$v['uid']]['nickname'];
						$reply[$k]['f_name']=$userinfo[$v['fid']]['nickname'];
						$reply[$k]['pic']=str_replace("..",$this->config['sy_weburl'],$userinfo[$v['uid']]['pic']);
						$reply[$k]['r_ctime'] = date("Y-m-d H:i:s",$v['ctime']);
						$reply[$k]['r_url']=url("ask",array("c"=>"friend","uid"=>$v['uid']));
					}
				}

				foreach($rows['mlist'] as $k=>$v){
					$rows['mlist'][$k]['fname'] =$userinfo[$v['fid']]['nickname'];
					$rows['mlist'][$k]['fpic'] =str_replace("..",$this->config['sy_weburl'],$userinfo[$v['fid']]['pic']);
					$rows['mlist'][$k]['ctime'] = date("Y-m-d H:i:s",$v['ctime']);
					$rows['mlist'][$k]['nickname'] =$userinfo[$v['uid']]['nickname'];
					$rows['mlist'][$k]['pic'] =str_replace("..",$this->config['sy_weburl'],$userinfo[$v['uid']]['pic']);
					if(is_array($reply)){
						$num='0';
						foreach($reply as $val){
							if($v['id']==$val['pid']){
								$rows['mlist'][$k]['reply'][]=$val;
								$num +=1;
								$rows['mlist'][$k]['num']=$num;
							}
						}
					}
				}
			}
		}
		$row = $M->GetFriendInfo(array('uid'=>$this->uid));
		$this->himan($M);
		$this->yunset('rom',$row);
		$this->yunset($rows);
		$this->friend_tpl('messagelist');
	}
	function info_action(){
		$M=$this->MODEL('friend');
        $UserinfoM=$this->MODEL('userinfo');
		$this->public_action($M);
		$this->himan($M);
		$this->myfoot((int)$_GET['id'],$M);
		$this->seo("fri_info");
		$this->leftinfo_action($M,$this->uid);
		$row = $M->GetFriendInfo(array('uid'=>$this->uid));
		if(!$row['uid']){
			$M->SaveFriendInfo(array('uid'=>$this->uid));
		}
		$this->yunset("rom",$row);
		$this->yunset("class","4");
		$this->friend_tpl('info');
	}
	function saveinfo_action(){
		if($_POST['submitBtn']){
			$M=$this->MODEL('friend');
			unset($_POST['submitBtn']);
			$nid=$M->SaveFriendInfo($_POST,array("uid"=>$this->uid));
			if($nid){
				$state_content = "我刚修改了个性签名<br>[".$_POST['description']."]。";
				$this->addstate($state_content);
				$M->member_log("修改朋友圈基本信息");
				$this->ACT_layer_msg("更新成功！",9,$_SERVER['HTTP_REFERER']);
			}else{
				$this->ACT_layer_msg("更新失败！",8,$_SERVER['HTTP_REFERER']);
			}
		}
	}

	function uppath(){
		$upload_path = "../data/upload/friend/";
		return $upload_path;
	}
	function ajaxfileupload_action(){
		if($_FILES['image']['tmp_name']){
			$upload=$this->upload_pic("../data/upload/friend/",false,$this->config['user_pickb']);
			$pictures=$upload->picture($_FILES['image']);
			$picMsg = $this->picmsg($pictures,$_SERVER['HTTP_REFERER'],"ajax");
			if($picMsg){
				$imginfo=$this->getInfo($pictures);
				if($imginfo['width']<$this->config['user_imgwidth'] || $imginfo['height']<$this->config['user_imgheight']){
					unlink_pic($pictures);
					$res['s_thumb'] = iconv('gbk','utf-8','上传头像尺寸太小');
				}else{
					$s_thumb=$upload->makeThumb($pictures,240,300,'_S_');
					unlink_pic($pictures);
					$res["url"] = $s_thumb;
				}
				echo json_encode($res);
			}
		}else{
			$res["s_thumb"] = iconv('gbk','utf-8','请选择上传图片');
			echo json_encode($res);
		}
	}
	function getInfo($file){
		$data=getimagesize($file);
		$imageInfo["width"]	= $data[0];
		$imageInfo["height"]= $data[1];
		$imageInfo["type"]	= $data[2];
		$imageInfo["name"]	= basename($file);
		$imageInfo["size"]  = filesize($file);
		return $imageInfo;
	}
	function savethumb_action(){
		$upload_path = $this->uppath();
		$upload_path=ltrim($upload_path,'.');
		$M=$this->MODEL('friend');
		if(stripos(trim($_POST['img1']),$upload_path)===false || stripos(trim($_POST['img2']),$upload_path)===false){
			$this->ACT_layer_msg("非法操作！",8,$_SERVER['HTTP_REFERER']);
		}
		include(LIB_PATH."sizer.class.php");
		$sizer=new Sizer("../data/upload/friend/".date('Ymd').'/');
		$t_name = $sizer->sizeIt();
		$finfo=$M->GetFriendInfo(array("uid"=>$this->uid),array("field"=>"`pic`,`pic_big`"));
		if($finfo['pic'] != '../'.$this->config['sy_member_icon']){
			unlink_pic($finfo['pic']);
		}
		if($finfo['pic_big'] != '../'.$this->config['sy_member_icon']){
			unlink_pic($finfo['pic_big']);
		}
		$ref=$M->SaveFriendInfo(array('pic_big'=>$t_name[1],'pic'=>$t_name[1]),array('uid'=>$this->uid));
		if($ref){
			$this->addstate("我刚更换了新头像，快来看看吧。");
			$M->member_log("更换了新头像");
			echo 1;
		}else{echo 2;}
	}
	function photo_action(){
		$M=$this->MODEL('friend');
		$this->public_action($M);
		$this->himan($M);
		$this->myfoot($_GET['id'],$M);
		$this->seo("fri_photo");
		$this->leftinfo_action($M,$this->uid);
		$row = $M->GetFriendInfo(array('uid'=>$this->uid));
		$this->yunset("rom",$row);
		$this->yunset("class","4");
		$this->friend_tpl('photo');
	}
	function del_action(){
		$M=$this->MODEL('friend');
		if($_GET['id']){
            $DeleteResult=$M->DeleteMessage(array('id'=>(int)$_GET['id'],"uid"=>$this->uid));
			if($DeleteResult){
				$M->member_log("删除朋友圈留言");
                $this->layer_msg('删除成功！',9,0,$_SERVER['HTTP_REFERER']);
			}else{
				$this->layer_msg('非法操作！',8,0,$_SERVER['HTTP_REFERER']);
			}
		}
	}
	function addstate_action(){
		$M=$this->MODEL('friend');
		$M->member_log("发表朋友圈说说");
		$state_content = trim($_POST["content"]);
		if($state_content != ""){
			$this->addstate($state_content);
            $this->ACT_layer_msg('发表说说成功！',9,$_SERVER['HTTP_REFERER']);
		}
		else $this->ACT_layer_msg('您要发表的说说内容为空！',8,$_SERVER['HTTP_REFERER']);
	}
}
?>