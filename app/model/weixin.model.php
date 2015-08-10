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
class weixin_model extends model{
   
	function myMsg($wxid='')
	{
		$userBind = $this->isBind($wxid);
		
		if($userBind['bindtype']=='1')
		{
			$Return['centerStr'] = "<Content><![CDATA[".iconv('utf-8','gbk',"您最新没有新的消息！")."]]></Content>";
			
		}else{

			$Return['centerStr'] = $userBind['cenetrTpl'];
		}
		$Return['MsgType']   = 'text';
		return $Return;
	}
	function Audition($wxid='')
	{
		$userBind = $this->isBind($wxid);
		if($userBind['bindtype']=='1')
		{
			$Aud = $this->DB_select_all("userid_msg","`uid`='".$userBind['uid']."' ORDER BY `datetime` DESC limit 5");
			
			if(is_array($Aud) && !empty($Aud))
			{
				foreach($Aud as $key=>$value)
				{
					$Info['title'] = iconv('gbk','utf-8',"【".$value['fname']."】邀您面试\n邀请时间：".date('Y-m-d H:i:s'));
					$Info['pic']   = $this->config['sy_weburl'].'/data/upload/wx/jt.jpg';
					$Info['url']   = $this->config['sy_weburl']."/wap/member/index.php?c=invite";
					$List[]        = $Info;
				}
				$Msg['title'] = iconv('gbk','utf-8','面试邀请');
				$Msg['pic'] = $this->config['sy_weburl'].'/'.$this->config['sy_wx_logo'];
				$Msg['url'] = $this->config['sy_weburl']."/wap/member/index.php?c=invite";
				$Return['centerStr'] = $this->Handle($List,$Msg);
				$Return['MsgType']   = 'news';

			}else{

				$Return['centerStr'] ='<Content><![CDATA['.iconv('gbk','utf-8','最近暂无面试邀请').']]></Content>';
				$Return['MsgType']   = 'text';
			}
			return $Return;
		}else{
			$Return['MsgType']   = 'text';
			$Return['centerStr'] = $userBind['cenetrTpl'];
			return $Return;
		}
	}
	function lookResume($wxid='')
	{
		$userBind = $this->isBind($wxid);
		if($userBind['bindtype']=='1')
		{
			$Aud = $this->DB_select_all("look_resume","`uid`='".$userBind['uid']."'  ORDER BY `datetime`  DESC limit 5");
			if(is_array($Aud) && !empty($Aud))
			{
				
				foreach($Aud as $key=>$value)
				{
					$comid[] = $value['com_id'];
				}
				$comids =pylode(',',$comid);
		
				if($comids){
					$comList = $this->DB_select_all('company','`uid` IN ('.$comids.')','`uid`,`name`');
					if(is_array($comList)){
						foreach($comList as $key=>$value)
						{
							$comname[$value['uid']] = $value['name'];
						}
					}
					foreach($Aud as $key=>$value)
					{
						$Info['title'] = iconv('gbk','utf-8', "查看企业：【".$comname[$value['com_id']]."】\n查看时间：".date('Y-m-d H:i:s',$value['datetime']));
						$Info['pic']   = $this->config['sy_weburl'].'/data/upload/wx/jt.jpg';
						$Info['url']   = $this->config['sy_weburl']."/wap/member/index.php?c=look";
						$List[]        = $Info;
					}
					$Msg['title'] = iconv('gbk','utf-8','最近查看我的简历');
					$Msg['pic'] = $this->config['sy_weburl'].'/'.$this->config['sy_wx_logo'];
					$Msg['url'] = $this->config['sy_weburl']."/wap/member/index.php?c=look";
					$Return['centerStr'] = $this->Handle($List,$Msg);
					$Return['MsgType']   = 'news';
				}else{
					$Return['centerStr']='<Content><![CDATA['.iconv('gbk','utf-8','已经很久没公司查看您的简历了！').']]></Content>';
					$Return['MsgType']   = 'text';
				}
			}else{

				$Return['centerStr']='<Content><![CDATA['.iconv('gbk','utf-8','已经很久没公司查看您的简历了！').']]></Content>';
				$Return['MsgType']   = 'text';
			}
			return $Return;

		}else{

			
			$Return['MsgType']   = 'text';
			$Return['centerStr'] = $userBind['cenetrTpl'];
			return $Return;
		}
	}
	function refResume($wxid='')
	{
		$userBind = $this->isBind($wxid);
		if($userBind['bindtype']=='1')
		{
			$Resume = $this->DB_select_num("resume_expect","`uid`='".$userBind['uid']."'");
			
			if($Resume>0)
			{
				$this->DB_update_all("resume_expect","`lastupdate`='".time()."'","`uid` = '".$userBind['uid']."'");
				$Return['centerStr']="<Content><![CDATA[".iconv('gbk','utf-8','简历刷新成功\n刷新时间').":".date('Y-m-d H:i:s')."]]></Content>";

			}else{

				$Return['centerStr']='<Content><![CDATA['.iconv('gbk','utf-8','请先完善您的简历！').']]></Content>';
				
			}
		}else{

			$Return['centerStr'] = $userBind['cenetrTpl'];
			
		}
		$Return['MsgType']   = 'text';
		return $Return;
	}
	function searchJob($keyword)
	{

		$keyword = trim($keyword);
		
		include(PLUS_PATH."/city.cache.php");
		if($keyword)
		{
			$keywords = @explode(' ',$keyword);
		
			if(is_array($keywords))
			{
				foreach($keywords as $key=>$value)
				{
					$iscity = 0;
					if($value!='')
					{
						foreach($city_name as $k=>$v)
						{
							if(strpos($v,iconv('utf-8','gbk',trim($value)))!==false)
							{
								$CityId[] = $k;
								$iscity = 1;
							}
						}
						if($iscity==0)
						{
							$searchJob[] = "(`name` LIKE '%".iconv('utf-8','gbk',trim($value))."%') OR (`com_name` LIKE '%".iconv('utf-8','gbk',trim($value))."%')";
						}
					}
				}
				
				$searchWhere = "`state`='1' AND `sdate`<='".time()."' AND `edate`>= '".time()."' AND `status`<>'1' AND `r_status`<>'1' AND (".implode(' OR ',$searchJob).")";
				if(!empty($CityId))
				{
					$City_id = pylode(',',$CityId);
					$searchWhere .= " AND (`provinceid` IN (".$City_id.") OR `cityid` IN (".$City_id.") OR `three_cityid` IN (".$City_id."))";
				}
				$jobList = $this->DB_select_all("company_job",$searchWhere." order by `lastupdate` desc limit 5","`id`,`name`,`com_name`");
			}
		}	
	
		if(is_array($jobList) && !empty($jobList))
		{

			foreach($jobList as $key=>$value)
			{
				$Info['title'] = iconv('gbk','utf-8',"【".$value['name']."】\n".$value['com_name']);
				$Info['pic'] = $this->config['sy_weburl'].'/data/wx/gt.jpg';
				$Info['url'] = Url("wap",array('c'=>'job','a'=>'view','id'=>$value['id']));
				$List[]     = $Info;
			}
			$Msg['title'] = iconv('gbk','utf-8','与【').$keyword.iconv('gbk','utf-8','】相关的职位');
			$Msg['pic'] = $this->config['sy_weburl'].'/'.$this->config['sy_wx_logo'];
			$Msg['url'] = Url('wap',array('c'=>'job','keyword'=>$keyword));
			
			$Return['centerStr'] = $this->Handle($List,$Msg);
			$Return['MsgType']   = 'news';
		}else{

			$Return['centerStr'] = '<Content><![CDATA['.iconv('gbk','utf-8','未找到合适的职位！').']]></Content>';
			$Return['MsgType']   = 'text';
		}
		
		return $Return;
		
	}
	function bindUser($wxid='')
	{
	
		$bindType = $this->isBind($wxid);
		$Return['MsgType']   = 'text';
		$Return['centerStr'] = $bindType['cenetrTpl'];
		return $Return;
		
	}
	function isBind($wxid='')
	{
	
		if($wxid)
		{
			 global $config;
			$Token = getToken($config);
		
			$Url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$Token.'&openid='.$wxid.'&lang=zh_CN';
			$CurlReturn  = CurlPost($Url);
			$UserInfo    = json_decode($CurlReturn,true);
			
			$wxid        = $wxid;
			$unionid	 = $UserInfo['unionid'];
			$User = $this->DB_select_once("member","`wxid`='".$wxid."' OR (`unionid`<>'' AND `unionid`='".$unionid."' )","`uid`,`username`,`usertype`,`wxid`,`unionid`");
			if($User['unionid']!='' && $User['wxid']!=$wxid)
			{
				$User = $this->DB_update_all("member","`wxid`='".$wxid."'","`uid`='".$User['uid']."'");
			}
		}
		if($User['uid']>0)
		{
			$urlLogin = Url("wap",array("c"=>"login","bind"=>"1","wxid"=>$wxid,"unionid"=>$unionid));
			if($User['usertype']=='2')
			{
				$User['cenetrTpl'] = "<Content><![CDATA[".iconv('gbk','utf-8',"您的".$this->config['sy_webname']."帐号：".$User['username']."为企业帐号，请登录您的个人帐号进行绑定！ \n\n\n 您也可以<a href=\"".$urlLogin."\">点击这里</a>进行解绑或绑定其他帐号")."]]></Content>";
			}else{
				$User['bindtype'] = '1';
				$User['cenetrTpl'] = "<Content><![CDATA[".iconv('gbk','utf-8',"您的".$this->config['sy_webname']."帐号：".$User['username']."已成功绑定！ \n\n\n 您也可以<a href=\"".$urlLogin."\">点击这里</a>进行解绑或绑定其他帐号")."]]></Content>";
			}
			
		}else{

			$urlLogin = Url("wap",array("c"=>"login","wxid"=>$wxid,"unionid"=>$unionid));
			$User['cenetrTpl'] = '<Content><![CDATA['.iconv('gbk','utf-8','您还没有绑定帐号，<a href="'.$urlLogin.'">点击这里</a>进行绑定!').']]></Content>';
		}

		return $User;
	}
	function recJob()
	{

		$JobList = $this->DB_select_all("company_job","`sdate`<='".time()."' AND `edate`>= '".time()."' AND `status`<>1 AND `r_status`<>1 AND `rec_time`>'".time()."' order by `lastupdate` desc limit 5","`id`,`name`,`com_name`,`lastupdate`");
		
		if(is_array($JobList) && !empty($JobList))
		{
			foreach($JobList as $key=>$value)
			{
				$Info['title'] = iconv('gbk','utf-8',"【".$value['name']."】\n".$value['com_name']);
				$Info['pic'] = $this->config['sy_weburl'].'/data/upload/wx/jt.jpg';
				$Info['url'] = Url("wap",array('c'=>'job','a'=>'view','id'=>$value['id']));
				$List[]        = $Info;
			}
			$Msg['title'] = iconv('gbk','utf-8','推荐职位');
			$Msg['pic'] = $this->config['sy_weburl'].'/'.$this->config['sy_wx_logo'];
			$Msg['url'] = Url("wap",array('c'=>'job'));
			$Return['centerStr'] = $this->Handle($List,$Msg);
			$Return['MsgType']   = 'news';
			
		}else{
			$Return['centerStr'] ='<Content><![CDATA['.iconv('gbk','utf-8','没有合适的职位！').']]></Content>';
			$Return['MsgType']   = 'text';
		}
		
		return $Return;
	}
	function Handle($List,$Msg)
	{

		$articleTpl = '<Content><![CDATA['.$Msg['title'].']]></Content>';

		$articleTpl .= '<ArticleCount>'.(count($List)+1).'</ArticleCount><Articles>';

		$centerTpl = "<item>
		<Title><![CDATA[%s]]></Title>  
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>";

		$articleTpl.=sprintf($centerTpl,$Msg['title'],'',$Msg['pic'],$Msg['url']); 

		foreach($List as $value)
		{	
			$articleTpl.=sprintf($centerTpl,$value['title'],'',$value['pic'],$value['url']);
		}
		$articleTpl .= '</Articles>';
		return $articleTpl;
	}
	function valid($echoStr,$signature,$timestamp,$nonce)
    {
        if($this->checkSignature($signature,$timestamp,$nonce)){
        	echo $echoStr;	
        	exit;
        }
    }
	function checkSignature($signature, $timestamp,$nonce)
	{   		
		$token = $this->config['wx_token'];
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature  && $token!=''){
			return true;
		}else{
			return false;
		}
	}
	function ArrayToString($obj,$withKey=true,$two=false)
	{
		if(empty($obj))	return array();
		$objType=gettype($obj);
		if ($objType=='array') {
			$objstring = "array(";
			foreach ($obj as $objkey=>$objv) {
				if($withKey)$objstring .="\"$objkey\"=>";
				$vtype =gettype($objv) ;
				if ($vtype=='integer') {
				  $objstring .="$objv,";
				}else if ($vtype=='double'){
				  $objstring .="$objv,";
				}else if ($vtype=='string'){
				  $objv= str_replace('"',"\\\"",$objv);
				  $objstring .="\"".$objv."\",";
				}else if ($vtype=='array'){
				  $objstring .="".$this->ArrayToString($objv,false).",";
				}else if ($vtype=='object'){
				  $objstring .="".$this->ArrayToString($objv,false).",";
				}else {
				  $objstring .="\"".$objv."\",";
				}
			}
			$objstring = substr($objstring,0,-1)."";
			return $objstring.")\n";
		}
	}
	function markLog($wxid,$wxuser,$content,$reply){

		$this->DB_insert_once("wxlog","`wxid`='".$wxid."',`wxuser`='".$wxuser."',`content`='".$content."',`reply`='".$reply."',`time`='".time()."'");
	}
	function sendWxTemplate($wxid,$tempid,$url,$data){
       global $config;
		$Token = getToken($config);
		$wxUrl = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$Token;
		$templateDate = array("touser"=>$wxid,
							  "template_id"=>$tempid,
							  "url"=>$url,
							  "topcolor"=>"#FF0000",
							  "data"=>$data
						);
		
		$CurlReturn  = CurlPost($wxUrl,json_encode($templateDate));
		
		$UserInfo    = json_decode($CurlReturn);
		
		
    }
	function sendWxJob($uid,$jobid){
       
		global $config;
		if($config['wx_xxtz']!='1')
		{
			return true;
		}
		if($uid && $jobid)
		{
			$Tempid = 'ar6JBZSAyZ7RqMvzVIH2w0OQsqljKsKd8lCs2D0pAWI';
			if(is_array($jobid))
			{
				$Jids = pylode(",",$jobid);

			}else{
				
				$Jids = pylode(",",@explode(',',$jobid));

			}
			$comList = $this->DB_select_all("company_job","`id` IN (".$Jids.")","`uid`,`com_name`,`name`");
			
			if(is_array($comList) && !empty($comList))
			{

				foreach($comList as $value){
				
					$Mid[]					= $value['uid'];
					$Comname[$value['uid']] = $value['com_name'];
					$Jobname[$value['uid']][] = $value['name'];
				}

				$usertList = $this->DB_select_all("member","`uid` IN (".@implode(',',$Mid).") ","`uid`,`wxid`");
				
				if(is_array($usertList) && !empty($usertList))
				{
					$Expect = $this->DB_select_once("resume_expect","`uid` = '".(int)$uid."' AND `defaults`='1'");
					include PLUS_PATH."/city.cache.php";
					include PLUS_PATH."/user.cache.php";
					foreach($usertList as $value){
						$First		= iconv("gbk","utf-8",$Comname[$value['uid']].'，您好，您发布的职位：'.@implode(',',$Jobname[$value['uid']]).' 收到一份新简历!');
						$Iname		= iconv("gbk","utf-8",$Expect['uname']);
						$Edu		= iconv("gbk","utf-8",$userclass_name[$Expect['edu']]);
						$Exp		= iconv("gbk","utf-8",$userclass_name[$Expect['exp']]);
						$City		= iconv("gbk","utf-8",$city_name[$Expect['provinceid']]." ".$city_name[$Expect['cityid']]." ".$city_name[$Expect['three_cityid']]);
						$Sarlary	= iconv("gbk","utf-8",$userclass_name[$Expect['salary']]);
						$Remark		= iconv("gbk","utf-8",'详情请登录 '.$config['sy_webname'].' 及时查阅!');

						$TempDate['first']	= array('value'=>$First,'color'=>'');
						$TempDate['keyword1']	= array('value'=>$Iname,'color'=>'');
						$TempDate['keyword2']	= array('value'=>$Edu,'color'=>'');
						$TempDate['keyword3']	= array('value'=>$Exp,'color'=>'');
						$TempDate['keyword4']	= array('value'=>$City,'color'=>'');
						$TempDate['keyword5']	= array('value'=>$Sarlary,'color'=>'');
						$TempDate['remark']	= array('value'=>$Remark,'color'=>'');
						$Url = Url('wap',array("c"=>"login"));
					
						
						$this->sendWxTemplate($value['wxid'],$Tempid,$Url,$TempDate);
						
					}
				}
			}
			
		}
	    
    }
	function sendWxresume($data){
       
	   global $config;
		if($config['wx_xxtz']!='1')
		{
			return true;
		}
		if($data['uid'])
		{
			$Tempid = 'F_LbYG7kBRZeQIcpp3oD3a7RsoxVj9PmIS3W-wJ63QM';
			$userInfo = $this->DB_select_once("member","`uid` = '".$data['uid']."'","username,wxid");
			
			if(is_array($userInfo))
			{	
				$First		= iconv("gbk","utf-8",$userInfo['username'].'，恭喜你!您收到公司的面试邀请啦！');
				$Job		= iconv("gbk","utf-8",$data['jobname']);
				$Company	= iconv("gbk","utf-8",$data['fname']);
				$Time		= iconv("gbk","utf-8",$data['intertime']);
				$Address	= iconv("gbk","utf-8",$data['address']);
				$Contact	= iconv("gbk","utf-8",$data['linkman']);
				$Tel		= iconv("gbk","utf-8",$data['linktel']);
				$Remark		= iconv("gbk","utf-8",$data['content'].' 详情请登录 '.$config['sy_webname'].' 及时查阅!');

				$TempDate['first']	= array('value'=>$First,'color'=>'');
				$TempDate['job']	= array('value'=>$Job,'color'=>'');
				$TempDate['company']	= array('value'=>$Company,'color'=>'');
				$TempDate['time']	= array('value'=>$Time,'color'=>'');
				$TempDate['address']	= array('value'=>$Address,'color'=>'');
				$TempDate['contact']	= array('value'=>$Contact,'color'=>'');
				$TempDate['tel']	= array('value'=>$Tel,'color'=>'');
				$TempDate['remark']	= array('value'=>$Remark,'color'=>'');
				$Url = Url('wap',array('c'=>'login'));
				$this->sendWxTemplate($userInfo['wxid'],$Tempid,$Url,$TempDate);
			}
		}
    }
}
?>