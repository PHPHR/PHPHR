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
class index_controller extends common{
	function public_action()
	{
		if($this->config['sy_redeem_web']=="2")
		{
			header("location:".Url('error'));
		}
	}
	function index_action(){
		$this->public_action();
		$M=$this->MODEL("redeem");
		$row=$M->GetRewardClass(array('1'),array("orderby"=>"id asc","field"=>"id,name"));
		$this->yunset("row",$row);
		$rows=$M->GetReward(array('status'=>1),array("field"=>"id,nid,pic,name,integral,stock"));
		$this->yunset("rows",$rows);
		$lipin=$M->GetChange(array('1'),array("orderby"=>"id desc","field"=>"uid,username,name,ctime,integral,gid","limit"=>"10"));
		if(is_array($lipin)){
        	foreach($lipin as $k=>$v)
        	{
        		foreach($rows as $val)
        		{
        			if($v['gid']==$val['id'])
        			{
        				$lipin[$k]['pic'] = $val['pic'];
        			}
        		}
				$time=time()-$v['ctime'];
				if($time>86400 && $time<604800){
					$lipin[$k]['time'] = ceil($time/86400)."天前";
				}elseif($time>3600 && $time<86400){
					$lipin[$k]['time'] = ceil($time/3600)."小时前";
				}elseif($time>60 && $time<3600){
					$lipin[$k]['time'] = ceil($time/60)."分钟前";
				}elseif($time<60){
					$lipin[$k]['time'] = "刚刚";
				}else{
					$lipin[$k]['time'] = date("Y-m-d",$v['ctime']);
				}
        		$uid[]=$v['uid'];
        	}
		    include PLUS_PATH."/city.cache.php";
		    $uid=pylode(",",$uid);
		    $Resume=$this->MODEL('resume');
		    $Member=$this->MODEL('userinfo');
			$city1=$Resume->GetResumeExpectOne(array("`uid` in (".$uid.")"),array("field"=>"uid,provinceid,cityid"));
			$city2=$Member->GetUserinfoOne(array("`uid` in (".$uid.")"),array("usertype"=>"2","field"=>"uid,provinceid,cityid"));
			$city = array_merge($city1,$city2);
        	foreach($lipin as $k=>$v)
        	{
        		foreach($city as $val)
        		{
        			 if($v['uid']==$val['uid'])
                     {
        				$lipin[$k]['provinceid']=$city_name[$val['provinceid']];
						$lipin[$k]['cityid']=$city_name[$val['cityid']];
        		     }
        		}
        	}
        	$this->yunset("lipin",$lipin);
        }

		$paihang=$M->GetReward(array("status"=>"1"),array("orderby"=>"`num` desc","limit"=>"3","field"=>"name,id,pic"));
		$this->yunset("paihang",$paihang);
		$this->seo("redeem");
		$this->yun_tpl(array('index'));
	}
	function list_action(){
		$this->public_action();
		$M=$this->MODEL("redeem");
		$where="`nid`='".(int)$_GET['id']."'";
		$where.=" order by `id` desc";
		$urlarr['c']="list";
		$urlarr["id"]=$_GET['id'];
		$urlarr['page']="{{page}}";
		$pageurl=Url($_GET['m'],$urlarr);
		$rows=$M->get_page("reward",$where,$pageurl,"13",'*','list');
		$this->yunset($rows);
		$row=$M->GetRewardClass(array("1"));
		$this->yunset("row",$row);
		$this->seo("redeem");
		$this->yun_tpl(array('list'));
	}
	function show_action(){
		$this->public_action();
		$M=$this->MODEL("redeem");
	    $where="`gid`='".(int)$_GET['id']."' and `status`='1' order by `id` desc";
		$urlarr['c']="show";
		$urlarr["id"]=$_GET['id'];
		$urlarr['page']="{{page}}";
		$pageurl=Url($_GET['m'],$urlarr);
		$rows=$M->get_page("change",$where,$pageurl,"13",'*','jilu');
		$this->yunset($rows);
		$row=$M->GetRewardOne(array("id"=>(int)$_GET['id']));
		$this->yunset("row",$row);
		$remen=$M->GetReward(array("rec"=>"1"),array("orderby"=>"id desc","limit"=>"5"));
		$this->yunset("remen",$remen);
		$this->seo("redeem");
		$this->yun_tpl(array('show'));
	}
	function dh_action(){
		$this->public_action();
		if(!$this->uid && !$this->username){
		     $this->ACT_layer_msg("您还没有登录，请先登录！",8,$_SERVER['HTTP_REFERER']);
		}
		$M=$this->MODEL("redeem"); 
		$jilu=$M->GetChange(array("gid"=>(int)$_GET['id'],'status'=>1),array("orderby"=>"`id` desc","limit"=>"10"));
		$this->yunset("jilu",$jilu);
		$row=$M->GetRewardOne(array("id"=>(int)$_GET['id']));
		$this->yunset("row",$row);
		$this->yunset("title","兑换确认 - ".$this->config['sy_webname']);
		$this->yun_tpl(array('dh_show'));
	}
	function savedh_action(){
		if($_POST['submit']){
			$Member=$this->MODEL("userinfo");
			$M=$this->MODEL("redeem");
			$_POST['num']=(int)$_POST['num'];
			$_POST['id']=(int)$_POST['id'];
			if(!$_POST['password']){
				$this->ACT_layer_msg("密码不能为空！",8);
			}
			if(!$_POST['linkman'] || !$_POST['linktel'] ){
				$this->ACT_layer_msg("联系人或联系电话不能为空！",8);
			}
			$info=$Member->GetMemberOne(array("uid"=>$this->uid),array("field"=>"`password`,`salt`"));
			$passwrod=md5(md5($_POST['password']).$info['salt']);
			if($info['password']!=$passwrod){
				$this->ACT_layer_msg("密码不正确！",8,$_SERVER['HTTP_REFERER']);
			}
			if(!$this->uid && !$this->username){
				 $this->ACT_layer_msg("您还没有登录，请先登录！",8,$_SERVER['HTTP_REFERER']);
			}else{
				$_POST['num'] = (int)$_POST['num'];
				if($_POST['num']<1){
					$this->ACT_layer_msg("请填写正确的数量！",8,$_SERVER['HTTP_REFERER']);
				}else{ 
					$info=$Member->GetUserstatisOne(array("uid"=>$this->uid),array("usertype"=>$_COOKIE['usertype'],"field"=>"`integral`"));
					$gift=$M->GetRewardOne(array("id"=>(int)$_POST['id'])); 
					if($_POST['num']>$gift['stock']){
						$this->ACT_layer_msg("已超出库存数量！",8,$_SERVER['HTTP_REFERER']);
					}else{
						if($gift['restriction']!="0"&&$_POST['num']>$gift['restriction']){
							$this->ACT_layer_msg("已超出限购数量！",8,$_SERVER['HTTP_REFERER']);
						}else{
							$integral=$gift['integral']*$_POST['num'];
							if($info['integral']<$integral){
								$this->ACT_layer_msg("您的积分不足！",8,$_SERVER['HTTP_REFERER']);
							}else{
								$Member->company_invtal($this->uid,$integral,false,"积分兑换",true,2,'integral',24);
								$data['uid']=$this->uid;
								$data['username']=$this->username;
								$data['usertype']=$_COOKIE['usertype'];
								$data['name']=$gift['name'];
								$data['gid']=$gift['id'];
								$data['linkman']=$_POST['linkman'];
								$data['linktel']=$_POST['linktel'];
								$data['body']=$_POST['body'];
								$data['integral']=$integral;
								$data['num']=$_POST['num'];
								$data['ctime']=time();
								$M->AddChange($data); 
								$this->ACT_layer_msg("兑换成功，请等待管理员审核！",9,$_SERVER['HTTP_REFERER']);
							}
						}
					}
				}
			}
		}
	}
}
?>