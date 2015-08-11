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
class ask_controller extends common{ 
	function ask_tpl($tpl){ 
		$this->yuntpl(array('ask/'.$tpl));
	}
	function  is_login(){
		if($this->uid==""||$_COOKIE['username']==''){
			echo 'no_login';die;
		}
	}
	function atnask($M){
		if($this->uid){ 
			$my_attention=$M->GetAttentionList(array('uid'=>$this->uid,'type'=>1));
			$my_atten=@explode(',',rtrim($my_attention['ids'],",")); 
			$this->yunset("my_atten",$my_atten);			
		} 
	}
	function hotclass(){
		$CacheM=$this->MODEL('cache');
		$CacheList=$CacheM->GetCache(array('ask'));
		$rows=array();
		$i=0;
		foreach($CacheList['ask_name'] as $key=>$val){
			if($i<'10'){
				$rows[$key]=$val;
			}
			$i++; 
		} 
		$this->yunset("hotclass",$rows); 
	}
	function autosearch_action(){
		$M=$this->MODEL('ask');
		$keyword=yun_iconv("utf-8","gbk",trim($_POST['keyword']));
		$rows=$M->GetQuestionList(array("`title` like '%".$keyword."%'"),array("field"=>"`id`,`title`,`answer_num`","orderby"=>'answer_num',"desc"=>'desc',"limit"=>6)); 
		if($rows&&is_array($rows)){
			foreach($rows as $key=>$val){
				$rows[$key]['url']=Url('ask',array("c"=>"content","id"=>$val['id']));
				$rows[$key]['title']=urlencode(str_replace($keyword,"<b>".$keyword."</b>",$val['title']));
			}
		}
		$rows = json_encode($rows);
		echo urldecode($rows);die;
	}
	function myfans($M,$uid){
		$myfans=$M->MyFansList(array("sc_uid"=>$uid),array('limit'=>12,"orderby"=>'time',"desc"=>'desc',"field"=>'uid'));
		$this->yunset("myfans",$myfans);
	}
	function myinfo($FriendM,$uid){
		$info=$FriendM->GetFriendInfo(array('uid'=>$uid),array("field"=>"`pic`,`nickname`,`uid`,`description`,`fans`,`atnnum`"));
		if($info['pic']==''){
			$info['pic']=$this->config['sy_weburl'].'/'.$this->config['sy_friend_icon'];
		}
		
		$fansNum = 0;
		$atnNum = 0;
		if($this->uid != ""){
			$fansNum = $this->obj->DB_select_num('atn','`sc_uid`='.$uid);
			$atnNum = $this->obj->DB_select_num('atn','`uid`='.$uid);
		}
		$info["fans"] = $fansNum;
		$info["atnnum"] = $atnNum;
		$data['nickname']=$info['nickname'];		
		$this->data=$data;
		$this->yunset("info",$info);
	}
	function myfoot($id="",$M){
		$id = $id?$id:$this->uid; 
		$myfoot = $M->GetFriendFoot(array("uid"=>$id),array("orderby"=>"ctime desc","limit"=>"12"));
        $uids=array();
        
		if(is_array($myfoot)&&$myfoot){
			foreach($myfoot as $val){
				if(in_array($val['fid'],$uids)==false){$uids[]=$val['fid'];}
			}
			$info = $M->GetFriendAll(array("`uid` in (".pylode(',',$uids).")"),array("field"=>"`uid`,`nickname`,`pic`"));
			if(is_array($info)){
				foreach($myfoot as $k=>$v){
					foreach($info as $key=>$val){
						if($v['fid']==$val['uid']){
							$myfoot[$k]['url']=Url("ask",array("c"=>"friend","uid"=>$val['uid'])); 
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
	function friendfoot($uid,$M){
		$this->yunset("getuid",$uid);
		if($this->uid&&$this->uid!=$uid){
			$M->SaveFriendFoot(array("uid"=>$uid,'fid'=>$this->uid));
		}
	}
}
?>