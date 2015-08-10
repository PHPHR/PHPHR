<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class friend_controller extends common{
	function friend_tpl($tpl){
		$this->yuntpl(array('friend/'.$tpl));
	}
	function  is_login(){
		if($this->uid==""||$_COOKIE['username']==''){
			echo 'no_login';die;
		}
	}
	function public_action($M){
		$now_url=@explode("/",$_SERVER['REQUEST_URI']);
		$now_url=$now_url[count($now_url)-1];
		$this->yunset("now_url",$now_url);
		if($this->uid==""){
			$this->ACT_msg($_SERVER['HTTP_REFERER'],"您还未登录，请先登录！");
		}else{
			$member = $M->GetFriendInfo(array("uid"=>$this->uid));
			if($member['pic']){
				$member['pic']=str_replace("..",$this->config['sy_weburl'],$member['pic']);
			}else{
				$member['pic']=$this->config['sy_weburl'].'/'.$this->config['sy_friend_icon'];
			}
			$this->yunset("member",$member);
		}
	}
	function myfoot($id="",$M){
		$id = $id?$id:$this->uid;
		$myfoot = $M->GetFriendFoot(array("fid"=>$id),array("orderby"=>"ctime desc","limit"=>"4"));
        $uids=array();
		if(is_array($myfoot)&&$myfoot){
			foreach($myfoot as $val){
				$uids[]=$val['uid'];
			}
			$info = $M->GetFriendAll(array("`uid` in (".pylode(',',$uids).")"),array("field"=>"`uid`,`nickname`,`pic`"));
			if(is_array($info)){
				foreach($myfoot as $k=>$v){
					foreach($info as $key=>$val){
						if($v['uid']==$val['uid']){
							$myfoot[$k]['nickname'] = $val['nickname'];
							$myfoot[$k]['pic'] = str_replace("..",$this->config['sy_weburl'],$val['pic']);
							if($myfoot[$k]['pic']==''){$myfoot[$k]['pic']=$this->config['sy_friend_icon'];}
						}
					}
				}
			}
		}
		$this->yunset("myfoot",$myfoot);
		
		return $myfoot;
	}
	function himan($M){ 
		$addlist = $M->RecomFriendAll(array("iscert"=>'1',"uid"=>$this->uid),array("orderby"=>"rand()","limit"=>"5")); 
		
		if(is_array($addlist)){
			foreach($addlist as $k=>$v){
				if($v['pic']){
					$addlist[$k]['pic'] = str_replace("..",$this->config['sy_weburl'],$v['pic']);
				}else{
					$addlist[$k]['pic']=$this->config['sy_friend_icon'];
				}				
			}
		}
		$this->yunset("addlist",$addlist);
	}
	function leftinfo_action($M,$id)
	{
		include PLUS_PATH."/city.cache.php";
		if(!$id)
		{
			$id = $this->uid;
		}else{
			$id=(int)$id;
		}
		$member = $M->DB_select_once("friend_info","`uid`='".$id."'","pic_big,usertype,nickname,birthday,sex");
		if(empty($member))
		{
			$this->ACT_msg($_SERVER['HTTP_REFERER'],"不存在该用户！");
		}
		if($member['usertype']==1)
		{
			include PLUS_PATH."/user.cache.php";
			$leftinfo = $M->DB_select_once("resume","`uid`='".$id."'");
			$leftinfo['typename'] = "个人会员";
			$leftinfo['sexinfo'] = $userclass_name[$leftinfo['sex']];
			$leftinfo['home'] = $city_name[$leftinfo['province']] .$city_name[$leftinfo['city']];
		}elseif($member['usertype']==2){
			include PLUS_PATH."/industry.cache.php";
			include PLUS_PATH."/job.cache.php";
			$leftinfo = $M->DB_select_once("company","`uid`='".$id."'");
			$leftinfo['typename'] = "企业会员";
			$leftinfo['hyinfo'] = $industry_name[$leftinfo['hy']];
			$leftinfo['home'] = $city_name[$leftinfo['provinceid']] .$city_name[$leftinfo['cityid']];
		}
		$user = $M->DB_select_once("member","`uid`='".$id."'","`username`");
		$leftinfo['uid']=$id;
		$leftinfo['username']=$user['username'];
		$leftinfo['birthday'] = $member['birthday'];
		$leftinfo['sex'] = $member['sex'];
		$member["pic_big"]=str_replace("..",$this->config['sy_weburl'],$member['pic_big']);
		$this->yunset("pic",$member['pic_big']);
		$this->yunset("type",$member['usertype']);
		$this->yunset("nickname",$member['nickname']);
		$this->yunset("leftinfo",$leftinfo);
		return $leftinfo;
	}
}
?>