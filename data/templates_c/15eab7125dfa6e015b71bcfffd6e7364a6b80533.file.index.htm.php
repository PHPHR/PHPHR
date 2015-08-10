<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-05 15:16:34
         compiled from "/var/www/phphr/app/template/default/index/index.htm" */ ?>
<?php /*%%SmartyHeaderCode:199551285655c1b852bc8348-26866070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15eab7125dfa6e015b71bcfffd6e7364a6b80533' => 
    array (
      0 => '/var/www/phphr/app/template/default/index/index.htm',
      1 => 1435111218,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199551285655c1b852bc8348-26866070',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'keywords' => 0,
    'description' => 0,
    'style' => 0,
    'config' => 0,
    'job_index' => 0,
    'jobclassurl' => 0,
    'jindex' => 0,
    'job_name' => 0,
    'job_type' => 0,
    'key' => 0,
    'jtone' => 0,
    'jttwo' => 0,
    'lunbo' => 0,
    'alist' => 0,
    'gonggao' => 0,
    'adlists' => 0,
    'adlist_13' => 0,
    'adlist_14' => 0,
    'adlist_15' => 0,
    'urgentjoblist' => 0,
    'urgentitem' => 0,
    'hotjoblist' => 0,
    'job_list' => 0,
    'jlist' => 0,
    'hot' => 0,
    'ulist' => 0,
    'arcgroupright' => 0,
    'indexnews' => 0,
    'arcitem' => 0,
    'linklist' => 0,
    'linklist2' => 0,
    'footer_ad' => 0,
    'left_ad' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c1b852deda93_59043136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1b852deda93_59043136')) {function content_55c1b852deda93_59043136($_smarty_tpl) {?><?php if (!is_callable('smarty_function_url')) include '/var/www/phphr/app/include/libs/plugins/function.url.php';
if (!is_callable('smarty_function_formatpicurl')) include '/var/www/phphr/app/include/libs/plugins/function.formatpicurl.php';
?><?php global $db,$db_config,$config;include PLUS_PATH.'/group.cache.php';$alist=array();$rs=null;$nids=null;eval('$paramer=array("item"=>"\'alist\'","t_len"=>"15","limit"=>"8","key"=>"\'key\'","name"=>"\'newlist1\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr['arr'];
		$Purl =  $ParamerArr['purl'];
        if($paramer[cache]){
			$Purl="{{page}}.html";
		}
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }$where=1;
		if($config['did']){
			$where.=" and `did`='".$config['did']."'";
		} 
		include PLUS_PATH."/group.cache.php";
		if(is_array($paramer)){
			if($paramer['nid']!=""){
				$where .=" AND `nid` in ($paramer[nid])";
				$nids = @explode(',',$paramer['nid']);$paramer['nid']=$paramer['nid'];
			}else if($paramer['rec']!=""){
				$nids=array();if(is_array($group_rec)){
					foreach($group_rec as $key=>$value){
						if($key<=2){
							$nids[]=$value;
						}
					}
					$paramer[nid]=@implode(',',$nids);
				}
			}
			if($paramer['nid']){
				$nid_s = @explode(',',$paramer[nid]);				
				foreach($nid_s as $v){
					if($group_type[$v]){
						$paramer[nid] = $paramer[nid].",".@implode(',',$group_type[$v]);
					}
				}
			}			
			if($paramer['type']){
				$type = str_replace("\"","",$paramer[type]);
				$type_arr =	@explode(",",$type);
				if(is_array($type_arr) && !empty($type_arr))
				{
					foreach($type_arr as $key=>$value)
					{
						$where .=" AND FIND_IN_SET('".$value."',`describe`)";
						if(count($nids)>0)
						{
							$picwhere .=" AND FIND_IN_SET('".$value."',`describe`)";
						}
					}
				}
			}
			if($paramer['pic']!=""){
				$where .=" AND `newsphoto`<>''";
			}
			if($paramer['order']!=""){
				$order = str_replace("'","",$paramer['order']);
				$where .=" ORDER BY $order";
			}else{
				$where .=" ORDER BY `datetime`";
			}
			if($paramer['sort']){
				$where.=" ".$paramer[sort];
			}else{
				$where.=" DESC";
			}
			if(intval($paramer['limit'])>0){
				$limit = intval($paramer['limit']);
				$limit = " limit ".$limit;
			}
			if($paramer['ispage']){
				$limit = PageNav($paramer,$_GET,"news_base",$where,$Purl,"","5",$_smarty_tpl);
			}
		}
		if(!intval($paramer['ispage']) && count($nids)>0){
			$where = " and nid IN ($paramer[nid])";
			if($paramer['pic']){
				if(!$paramer['piclimit']){
					$piclimit = 1;
				}else{
					$piclimit = $paramer['piclimit'];
				}
				$db->query("set @f=0,@n=0");
				$query = $db->query("select * from (select id,title,color,datetime,description,newsphoto,@n:=if(@f=nid,@n:=@n+1,1) as aid,@f:=nid as nid from $db_config[def]news_base  WHERE `nid` IN ($paramer[nid]) AND `newsphoto` <>''  order by nid asc,datetime desc) a where aid <=".$piclimit);
				while($rs = $db->fetch_array($query)){
					if(intval($paramer[t_len])>0){
						$len = intval($paramer[t_len]);
						if($rs[color]){
							$rs[title] = "<font color='".$rs[color]."'>".mb_substr($rs[title],0,$len,"GBK")."</font>";
						}else{
							$rs[title] = mb_substr($rs[title],0,$len,"GBK");
						}
					}
					if(intval($paramer[d_len])>0)
					{
						$len = intval($paramer[d_len]);
						$rs[description] = mb_substr($rs[description],0,$len,"GBK");
					}
					$rs['name'] = $group_name[$rs['nid']];
					if($config[sy_news_rewrite]=="2"){
						$rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
					}else{
						$rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
					}
					$rs[time]=date("Y-m-d",$rs[datetime]);
					$rs['datetime']=date("m-d",$rs[datetime]);
					$alist[$rs['nid']]['pic'][] = $rs;
				}
			}
			
            $db->query("set @f=0,@n=0");
            $query = $db->query("select * from (select id,title,datetime,color,description,newsphoto,@n:=if(@f=nid,@n:=@n+1,1) as aid,@f:=nid as nid from $db_config[def]news_base  WHERE `nid` IN ($paramer[nid]) order by nid asc,datetime desc) a where aid <=$paramer[limit]");

            while($rs = $db->fetch_array($query)){
                if(intval($paramer[t_len])>0){
                    $len = intval($paramer[t_len]);
                    if($rs[color]){
                        $rs[title] = "<font color='".$rs[color]."'>".mb_substr($rs[title],0,$len,"GBK")."</font>";
                    }else{
                        $rs[title] = mb_substr($rs[title],0,$len,"GBK");
                    }
                }
                if(intval($paramer[d_len])>0){
                    $len = intval($paramer[d_len]);
                    $rs[description] = mb_substr($rs[description],0,$len,"GBK");
                }
                $rs['name'] = $group_name[$rs['nid']];
                if($config[sy_news_rewrite]=="2"){
                    $rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
                }else{
                    $rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
                }
                $rs[time]=date("Y-m-d",$rs[datetime]);
                $rs[datetime]=date("m-d",$rs[datetime]);
                $alist[$rs['nid']]['arclist'][] = $rs;
            }
		}else{
			$query = $db->query("SELECT * FROM `$db_config[def]news_base` WHERE ".$where.$limit);
			while($rs = $db->fetch_array($query)){
                if(intval($paramer[t_len])>0)
                {
                    $len = intval($paramer[t_len]);
                    $rs[title] = mb_substr($rs[title],0,$len,"GBK");
                }
                if(intval($paramer[d_len])>0)
                {
                    $len = intval($paramer[d_len]);
                    $rs[description] = mb_substr($rs[description],0,$len,"GBK");
                }
                $rs['name'] = $group_name[$rs['nid']];
                if($config[sy_news_rewrite]=="2"){
                    $rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
                }else{
                    $rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
                }
                $rs[time]=date("Y-m-d",$rs[datetime]);
                $rs[datetime]=date("m-d",$rs[datetime]);
                $alist[] = $rs;
            }
		} ?>
<?php $gonggao=array();$time=time();eval('$paramer=array("t_len"=>"20","limit"=>"8","item"=>"\'gonggao\'","name"=>"\'gonggaolist1\'","nocache"=>"")
;');
		global $db,$db_config,$config;
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];
		$Purl =  $ParamerArr[purl];
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
		$where = 1;
		if($config['did']){
			$where.=" and `did`='".$config['did']."'";
		} 
		if($paramer[order]){
			$where.="  ORDER BY `".$paramer[order]."`";
		}else{
			$where.="  ORDER BY `datetime`";
		}
		if($paramer[sort]){
			$where.=" ".$paramer[sort];
		}else{
			$where.=" DESC";
		}
		if($paramer[limit]){
			$limit=" LIMIT ".$paramer[limit];
		}else{
			$limit=" LIMIT 20";
		}
		if($paramer[ispage]){
			$limit = PageNav($paramer,$_GET,"admin_announcement",$where,$Purl,"",0,$_smarty_tpl);
		}
		$gonggao=$db->select_all("admin_announcement",$where.$limit);
		if(is_array($gonggao)){
			foreach($gonggao as $key=>$value){
				if($paramer[t_len]){
					$gonggao[$key][title_n] = mb_substr($value['title'],0,$paramer[t_len],"GBK");
				}
				$gonggao[$key][time]=date("Y-m-d",$value[datetime]);
				$gonggao[$key][url] = Url("announcement",array("id"=>$value[id]),"1");
			}
		} ?>
<?php global $db,$db_config,$config;
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
		$time = time();
		$where = "`time_start`<$time AND `time_end`>$time";$order = " ORDER BY `sort` ";$sort = 'ASC';$limit=" LIMIT 20";$where.=$order.$sort;
        $Query = $db->query("SELECT * FROM $db_config[def]hotjob where ".$where.$limit);
		while($rs = $db->fetch_array($Query)){
			$hotjoblist[] = $rs;
			$ListId[] =  $rs[uid];
		}
		$jobwhere=1;
		if($config[sy_web_site]=="1"){
			if($config[cityid]>0 && $config[cityid]!=""){
				$jobwhere.=" and `cityid`='$config[cityid]'";
			}
			if($config[three_cityid]>0 && $config[three_cityid]!=""){
				$jobwhere.=" and `three_cityid`='$config[three_cityid]'";
			}
			if($config[hyclass]>0 && $config[hyclass]!=""){
				$jobwhere.=" and `hy`='".$config[hyclass]."'";
			}
		}
		$JobId = @implode(",",$ListId);
		$JobList=$db->select_all("company_job","`uid` IN ($JobId) and `edate`>'".mktime()."' and state=1 and r_status<>'2' and status<>'1' and $jobwhere");
		$statis=$db->select_all("company_statis","`uid` IN ($JobId)","`uid`,`comtpl`");
		if(is_array($ListId)){
			$cache_array = $db->cacheget();
			foreach($hotjoblist as $key=>$value){
				$i=0;
				if(is_array($JobList)){
					$hotjoblist[$key]["job"].="<div class=\"area_left\"> ";
					foreach($JobList as $k=>$v){
						if($value[uid]==$v[uid] && $i<5){
							$job_url = Url("job",array("c"=>"comapply","id"=>"$v[id]"),"1");
							$v[name] = mb_substr($v[name],0,10,"GBK");
							$hotjoblist[$key]["job"].="<a href='".$job_url."'>".$v[name]."</a>";
							$i++;
						}
					}
					foreach($statis as $v){
						if($value['uid']==$v['uid']){
							if($v['comtpl'] && $v['comtpl']!="default"){
								$jobs_url = Url("company",array("c"=>"show","id"=>$value[uid]))."#job";
							}else{
								$jobs_url = Url("company",array("c"=>"show","id"=>$value[uid]));
							}
						}
					}
					$com_url = Url("company",array("c"=>"show","id"=>$value[uid]));
					$beizhu=mb_substr($value['beizhu'],0,50,"GBK")."...";
					$hotjoblist[$key]["job"].="</div><div class=\"area_right\"><a href='".$com_url."'>".$value["username"]."</a>".$beizhu."</div><div class=\"area_left_bot\"><a href='".$jobs_url."'>全部职位</a></div><div class='area_right_bot'><a href='".$com_url."'>公司详情</a></div>";
					$hotjoblist[$key]["url"]=$com_url;
				}
			}
		} ?>
<?php $ulist=array();global $db,$db_config,$config;eval('$paramer=array("item"=>"\'ulist\'","post_len"=>"10","limit"=>"20","key"=>"\'key\'","name"=>"\'userlist1\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];extract($paramer);
		$Purl =  $ParamerArr[purl];
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
        include PLUS_PATH."/job.cache.php";
		$where = "status<>'2' and `r_status`<>'2' and `job_classid`<>'' and `open`='1' and `defaults`=1";
		if($config['sy_web_site']=="1"){
			if($config['cityid']>0 && $config['cityid']!=""){
				$paramer['cityid']=$config['cityid'];
			}
			if($config['hyclass']>0 && $config['hyclass']!=""){
				$paramer['hy']=$config['hyclass'];
			}
		}
		if($paramer[where_uid]){
			$where .=" AND `uid` in (".$paramer['where_uid'].")";
		}
		if($paramer[idcard]){
			$where .=" AND `idcard_status`='1'";
		}
		if($paramer[height_status]){
			$where .=" AND height_status=".$paramer[height_status];
		}else{
			$where .=" AND height_status<>'2'";
		}
		if($paramer[rec]){
			$where .=" AND rec=1";
		}
		if($paramer[rec_resume]){
			$where .=" AND `rec_resume`=1";
		}
		if($paramer[work]){
			$show=$db->select_all("resume_show","1 group by eid","`eid`");
			if(is_array($show))
			{
				foreach($show as $v)
				{
					$eid[]=$v['eid'];
				}
			}
			$where .=" AND id in (".@implode(",",$eid).")";
		}
		if($paramer[cid]){
			$where .= " AND (cityid=$paramer[cid] or three_cityid=$paramer[cid])";
		}
		if($paramer[keyword]){
			$where1[]="`uname` LIKE '%$paramer[keyword]%'";
			foreach($job_name as $k=>$v){
				if(strpos($v,$paramer[keyword])!==false){
					$jobid[]=$k;
				}
			}
			if(is_array($jobid))
			{
				foreach($jobid as $value)
				{
					$class[]="FIND_IN_SET('".$value."',job_classid)";
				}
				$where1[]=@implode(" or ",$class);
			}
			include PLUS_PATH."/city.cache.php";
			foreach($city_name as $k=>$v)
			{
				if(strpos($v,$paramer[keyword])!==false)
				{
					$cityid[]=$k;
				}
			}
			if(is_array($cityid))
			{
				foreach($cityid as $value)
				{
					$class[]= "(provinceid = '".$value."' or cityid = '".$value."')";
				}
				$where1[]=@implode(" or ",$class);
			}
			$where.=" AND (".@implode(" or ",$where1).")";
		}
		if($paramer[pic]=="0"||$paramer[pic]){
			$where .=" AND photo<>''";
		}
		if($paramer[name]=="0"){
			$where .=" AND uname<>''";
		}
		if($paramer[hy]=="0"){
			$where .=" AND hy<>''";
		}elseif($paramer[hy]!=""){
			$where .= " AND (`hy` IN (".$paramer['hy']."))";
		}
		$job_classid="";
		if($paramer[jobids]){
			$joball=explode(",",$paramer[jobids]);
			foreach(explode(",",$paramer[jobids]) as $v){
				if($job_type[$v]){
					$joball[]=@implode(",",$job_type[$v]);
				}
			}
			$job_classid=implode(",",$joball);
		}
		if($paramer[job1]){
			$joball=$job_type[$paramer[job1]];
			foreach($job_type[$paramer[job1]] as $v)
			{
				$joball[]=@implode(",",$job_type[$v]);
			}
			$job_classid=@implode(",",$joball);
		}
		if($paramer[job1_son]){
			$joball=$job_type[$paramer[job1_son]];
			foreach($job_type[$paramer[job1_son]] as $v)
			{
				$joball[]=@implode(",",$v);
			}
			$job_classid=@implode(",",$joball);
		}
		if(!empty($job_classid)){
			$classid=@explode(",",$job_classid);
			foreach($classid as $value){
				$class[]="FIND_IN_SET('".$value."',job_classid)";
			}
			$classid=@implode(" or ",$class);
			$where .= " AND ($classid)";
		}
		if($paramer[job_post]){
			$where .=" AND FIND_IN_SET('".$paramer[job_post]."',job_classid)";
		}
		if($paramer[provinceid]){
			$where .= " AND provinceid = $paramer[provinceid]";
		}
		if($paramer[cityid]){
			$where .= " AND (`cityid` IN ($paramer[cityid]))";
		}
		if($paramer[three_cityid]){
			$where .= " AND (`three_cityid` IN ($paramer[three_cityid]))";
		}
		if($paramer[cityin]){
			$where .= " AND( AND provinceid IN ($paramer[cityin]) OR cityid IN ($paramer[cityin]) OR three_cityid IN ($paramer[cityin]))";
		}
		if($paramer[exp]){
			$where .=" AND exp=$paramer[exp]";
		}else{
			$where .=" AND exp>0";
		}
		if($paramer[edu]){
			$where .=" AND edu=$paramer[edu]";
		}else{
			$where .=" AND edu>0";
		}
		if($paramer[sex]){
			$where .=" AND sex=$paramer[sex]";
		}
		if($paramer[report]){
			$where .=" AND report=$paramer[report]";
		}
		if($paramer[salary]){
			$where .=" AND salary=$paramer[salary]";
		}
		if($paramer[type]){
			$where .= " AND type=$paramer[type]";
		}
		if($paramer[uptime]){
			$time=time();
			$uptime = $time-($paramer[uptime]*86400);
			$where.=" AND lastupdate>$uptime";
		}
		if($paramer[adtime]){
			$time=time();
			$adtime = $time-($paramer[adtime]*86400);
			$where.=" AND status_time>$adtime";
		}
		if($paramer[order] && $paramer[order]!="lastdate"){
			if($paramer[order]=='ant_num'){
				$order = " ORDER BY `ant_num`";
			}elseif($paramer[order]=='topdate'){
				$nowtime=time();
				$order = " ORDER BY if(topdate>$nowtime,topdate,lastupdate)";
			}else{
				$order = " ORDER BY `".str_replace("'","",$paramer[order])."`";
			}
		}else{
			$order = " ORDER BY lastupdate ";
		}
		$sort = $paramer[sort]?$paramer[sort]:'DESC';
		if($paramer[limit]){
			$limit=" LIMIT ".$paramer[limit];
		}
		$where.=$order.$sort;
		if($paramer[where]){
			$where = $paramer[where];
		}
		if($paramer[ispage]){
			if($paramer["height_status"]){
				$limit = PageNav($paramer,$_GET,"resume_expect",$where,$Purl,"","3",$_smarty_tpl);
			}else{
				$limit = PageNav($paramer,$_GET,"resume_expect",$where,$Purl,"",'0',$_smarty_tpl);
			}
		}

		$ulist=$db->select_all("resume_expect",$where.$limit,"*,uname as username");

		if(is_array($ulist)){
			$cache_array = $db->cacheget();
			$userclass_name = $cache_array["user_classname"];
			$city_name      = $cache_array["city_name"];
			$job_name		= $cache_array["job_name"];
			$industry_name	= $cache_array["industry_name"];
			$my_down=array();
			if($_COOKIE['usertype']=='2'&&$config['sy_usertype_1']=='1'){
				$my_down=$db->select_all("down_resume","`comid`='".$_COOKIE['uid']."'","uid");
			}
			if($paramer['top']){
				$uids=$m_name=array();
				foreach($ulist as $k=>$v){
					$uids[]=$v[uid];
				}

				$member=$db->select_all($db_config[def]."member","`uid` in(".@implode(',',$uids).")","uid,username");
				foreach($member as $val){
					$m_name[$val[uid]]=$val['username'];
				}
			}
			foreach($ulist as $key=>$value){
				$uid[] = $value['uid'];
				$eid[] = $value['id'];
			}
			$eids = @implode(',',$eid);
			$uids = @implode(',',$uid);

			foreach($ulist as $k=>$v)
			{
				$time=time()-$v['lastupdate'];
				if($time>86400 && $time<259300){
					$ulist[$k]['time'] = ceil($time/86400)."天前";
				}elseif($time>3600 && $time<86400){
					$ulist[$k]['time'] = ceil($time/3600)."小时前";
				}elseif($time>60 && $time<3600){
					$ulist[$k]['time'] = ceil($time/60)."分钟前";
				}elseif($time<60){
					$ulist[$k]['time'] = "刚刚";
				}else{
					$ulist[$k]['time'] = date("Y-m-d",$v['lastupdate']);
				}
				if($v['photo']==''){
					$ulist[$k]['photo']=$v['photo']=$config['sy_member_icon'];
				}else{
					$ulist[$k]['ispic']=1;
				}
				if($config['sy_usertype_1']=='1'&&$v['photo']){
					if(!empty($my_down)){
						foreach($my_down as $m_k=>$m_v){
							$my_down_uid[]=$m_v['uid'];
						}
						if(in_array($v['uid'],$my_down_uid)==false){
							$ulist[$k]['photo']='./'.$config['member_logo'];
						}
					}else{
						$ulist[$k]['photo']='./'.$config['member_logo'];
					}
				}
				if($config["user_name"]==3)
				{
					$ulist[$k]["username_n"] = "NO.".$v["id"];
				}elseif($config["user_name"]==2){
					if($userclass_name[$v['sex']]=='男'){
						$ulist[$k]["username_n"] = mb_substr($v["username"],0,1,'GBK')."先生";
					}else{
						$ulist[$k]["username_n"] = mb_substr($v["username"],0,1,'GBK')."女士";
					}
				}else{
					$ulist[$k]["username_n"] = $v["username"];
				}
				$a=date('Y',strtotime($ulist[$k]['birthday']));
				$ulist[$k]['age']=date("Y")-$a;
				$ulist[$k]['sex_n']=$userclass_name[$v['sex']];
				$ulist[$k]['edu_n']=$userclass_name[$v['edu']];
				$ulist[$k]['exp_n']=$userclass_name[$v['exp']];
				$ulist[$k]['job_city_one']=$city_name[$v['provinceid']];
				$ulist[$k]['job_city_two']=$city_name[$v['cityid']];
				$ulist[$k]['job_city_three']=$city_name[$v['three_cityid']];
				$ulist[$k]['salary_n']=$userclass_name[$v['salary']];
				$ulist[$k]['report_n']=$userclass_name[$v['report']];
				$ulist[$k]['type_n']=$userclass_name[$v['type']];
				$ulist[$k]['lastupdate']=date("Y-m-d",$v['lastupdate']);

				$ulist[$k]['user_url']=Url("resume",array("c"=>"show","id"=>$v['id']),"1");
				$ulist[$k]["hy_info"]=$industry_name[$v['hy']];
				if($paramer['top']){
					$ulist[$k]['m_name']=$m_name[$v['uid']];
					$ulist[$k]['user_url']=Url("ask",array("c"=>"friend","uid"=>$v['uid']));
				}
				$job_classid=@explode(",",$v['job_classid']);
				if(is_array($job_classid))
				{
					foreach($job_classid as $val)
					{
						$jobname[]=$job_name[$val];
					}
				}
				$ulist[$k]['job_post']=@implode(",",$jobname);
				if($paramer['post_len'])
				{
					$postname[$k]=@implode(",",$jobname);
					$ulist[$k]['job_post_n']=mb_substr($postname[$k],0,$paramer[post_len],"GBK");
				}
				if($paramer['keyword'])
				{
					$ulist[$k]['username']=str_replace($paramer['keyword'],"<font color=#FF6600 >".$paramer['keyword']."</font>",$v['username']);
					$ulist[$k]['job_post']=str_replace($paramer['keyword'],"<font color=#FF6600 >".$paramer['keyword']."</font>",$ulist[$k]['job_post']);
					$ulist[$k]['job_post_n']=str_replace($paramer['keyword'],"<font color=#FF6600 >".$paramer['keyword']."</font>",$ulist[$k]['job_post_n']);
					$ulist[$k]['job_city_one']=str_replace($paramer['keyword'],"<font color=#FF6600 >".$paramer['keyword']."</font>",$city_name[$v['provinceid']]);
					$ulist[$k]['job_city_two']=str_replace($paramer['keyword'],"<font color=#FF6600 >".$paramer['keyword']."</font>",$city_name[$v['cityid']]);
				}
				$jobname=array();
			}
			if($paramer['keyword']!=""&&!empty($ulist)){
				addkeywords('5',$paramer['keyword']);
			}
		} ?>
<?php global $db,$db_config,$config;include PLUS_PATH.'/group.cache.php';$indexnews=array();$rs=null;$nids=null;eval('$paramer=array("rec"=>"1","limit"=>"8","pic"=>"1","t_len"=>"18","d_len"=>"24","type"=>"\'t\'","urlstatic"=>"1","item"=>"\'indexnews\'","name"=>"\'newlist2\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr['arr'];
		$Purl =  $ParamerArr['purl'];
        if($paramer[cache]){
			$Purl="{{page}}.html";
		}
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }$where=1;
		if($config['did']){
			$where.=" and `did`='".$config['did']."'";
		} 
		include PLUS_PATH."/group.cache.php";
		if(is_array($paramer)){
			if($paramer['nid']!=""){
				$where .=" AND `nid` in ($paramer[nid])";
				$nids = @explode(',',$paramer['nid']);$paramer['nid']=$paramer['nid'];
			}else if($paramer['rec']!=""){
				$nids=array();if(is_array($group_rec)){
					foreach($group_rec as $key=>$value){
						if($key<=2){
							$nids[]=$value;
						}
					}
					$paramer[nid]=@implode(',',$nids);
				}
			}
			if($paramer['nid']){
				$nid_s = @explode(',',$paramer[nid]);				
				foreach($nid_s as $v){
					if($group_type[$v]){
						$paramer[nid] = $paramer[nid].",".@implode(',',$group_type[$v]);
					}
				}
			}			
			if($paramer['type']){
				$type = str_replace("\"","",$paramer[type]);
				$type_arr =	@explode(",",$type);
				if(is_array($type_arr) && !empty($type_arr))
				{
					foreach($type_arr as $key=>$value)
					{
						$where .=" AND FIND_IN_SET('".$value."',`describe`)";
						if(count($nids)>0)
						{
							$picwhere .=" AND FIND_IN_SET('".$value."',`describe`)";
						}
					}
				}
			}
			if($paramer['pic']!=""){
				$where .=" AND `newsphoto`<>''";
			}
			if($paramer['order']!=""){
				$order = str_replace("'","",$paramer['order']);
				$where .=" ORDER BY $order";
			}else{
				$where .=" ORDER BY `datetime`";
			}
			if($paramer['sort']){
				$where.=" ".$paramer[sort];
			}else{
				$where.=" DESC";
			}
			if(intval($paramer['limit'])>0){
				$limit = intval($paramer['limit']);
				$limit = " limit ".$limit;
			}
			if($paramer['ispage']){
				$limit = PageNav($paramer,$_GET,"news_base",$where,$Purl,"","5",$_smarty_tpl);
			}
		}
		if(!intval($paramer['ispage']) && count($nids)>0){
			$where = " and nid IN ($paramer[nid])";
			if($paramer['pic']){
				if(!$paramer['piclimit']){
					$piclimit = 1;
				}else{
					$piclimit = $paramer['piclimit'];
				}
				$db->query("set @f=0,@n=0");
				$query = $db->query("select * from (select id,title,color,datetime,description,newsphoto,@n:=if(@f=nid,@n:=@n+1,1) as aid,@f:=nid as nid from $db_config[def]news_base  WHERE `nid` IN ($paramer[nid]) AND `newsphoto` <>''  order by nid asc,datetime desc) a where aid <=".$piclimit);
				while($rs = $db->fetch_array($query)){
					if(intval($paramer[t_len])>0){
						$len = intval($paramer[t_len]);
						if($rs[color]){
							$rs[title] = "<font color='".$rs[color]."'>".mb_substr($rs[title],0,$len,"GBK")."</font>";
						}else{
							$rs[title] = mb_substr($rs[title],0,$len,"GBK");
						}
					}
					if(intval($paramer[d_len])>0)
					{
						$len = intval($paramer[d_len]);
						$rs[description] = mb_substr($rs[description],0,$len,"GBK");
					}
					$rs['name'] = $group_name[$rs['nid']];
					if($config[sy_news_rewrite]=="2"){
						$rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
					}else{
						$rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
					}
					$rs[time]=date("Y-m-d",$rs[datetime]);
					$rs['datetime']=date("m-d",$rs[datetime]);
					$indexnews[$rs['nid']]['pic'][] = $rs;
				}
			}
			
            $db->query("set @f=0,@n=0");
            $query = $db->query("select * from (select id,title,datetime,color,description,newsphoto,@n:=if(@f=nid,@n:=@n+1,1) as aid,@f:=nid as nid from $db_config[def]news_base  WHERE `nid` IN ($paramer[nid]) order by nid asc,datetime desc) a where aid <=$paramer[limit]");

            while($rs = $db->fetch_array($query)){
                if(intval($paramer[t_len])>0){
                    $len = intval($paramer[t_len]);
                    if($rs[color]){
                        $rs[title] = "<font color='".$rs[color]."'>".mb_substr($rs[title],0,$len,"GBK")."</font>";
                    }else{
                        $rs[title] = mb_substr($rs[title],0,$len,"GBK");
                    }
                }
                if(intval($paramer[d_len])>0){
                    $len = intval($paramer[d_len]);
                    $rs[description] = mb_substr($rs[description],0,$len,"GBK");
                }
                $rs['name'] = $group_name[$rs['nid']];
                if($config[sy_news_rewrite]=="2"){
                    $rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
                }else{
                    $rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
                }
                $rs[time]=date("Y-m-d",$rs[datetime]);
                $rs[datetime]=date("m-d",$rs[datetime]);
                $indexnews[$rs['nid']]['arclist'][] = $rs;
            }
		}else{
			$query = $db->query("SELECT * FROM `$db_config[def]news_base` WHERE ".$where.$limit);
			while($rs = $db->fetch_array($query)){
                if(intval($paramer[t_len])>0)
                {
                    $len = intval($paramer[t_len]);
                    $rs[title] = mb_substr($rs[title],0,$len,"GBK");
                }
                if(intval($paramer[d_len])>0)
                {
                    $len = intval($paramer[d_len]);
                    $rs[description] = mb_substr($rs[description],0,$len,"GBK");
                }
                $rs['name'] = $group_name[$rs['nid']];
                if($config[sy_news_rewrite]=="2"){
                    $rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
                }else{
                    $rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
                }
                $rs[time]=date("Y-m-d",$rs[datetime]);
                $rs[datetime]=date("m-d",$rs[datetime]);
                $indexnews[] = $rs;
            }
		} ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/css.css" type="text/css" />
<!--[if IE 6]>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/png.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
DD_belatedPNG.fix('.png,.pagination li a');
<?php echo '</script'; ?>
>
<![endif]-->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/jquery-1.8.0.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/layer/layer.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/lazyload.min.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/public.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/reg_ajax.js" type="text/javascript"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/style/yun_index.css" type="text/css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/js/index.js" language="javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/search.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/js/slides.jquery.js" type="text/javascript"><?php echo '</script'; ?>
>
</head>
<body class="index_body_box">
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/index_header.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 
<?php echo '<script'; ?>
>
    $(document).ready(function(){
        $("#slides").slides({preload:true,preloadImage:'<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/loading.gif',play:5000,pause:2500,hoverPause:true});
        $('.index_header_seach_find').delegate('#search_name','click',function(){$(this).next().show();});
		$("img.lazy").lazyload();
    });
<?php echo '</script'; ?>
> 
<!--content  start-->
<div class="index_body">
  <div class="index_w1000">
    <div class="index_nav_left">
      <div class="index_nav">
        <div class="index_nav_tit"><a href="javascript:void(0);" id="navMenu"><span class="index_nav_tit_name">全部职位分类</span><i class="index_nav_tit_icon png"></i></a></div>
        <div class="pos" id="boxNav" style="display:black;">
          <div class="lst" id="navLst">
            <ul>
              <?php  $_smarty_tpl->tpl_vars['jindex'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jindex']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['job_index']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jindex']->key => $_smarty_tpl->tpl_vars['jindex']->value) {
$_smarty_tpl->tpl_vars['jindex']->_loop = true;
?>
              <li> <i></i> <a class="index_nav_l" href="<?php echo $_smarty_tpl->tpl_vars['jobclassurl']->value;?>
job1=<?php echo $_smarty_tpl->tpl_vars['jindex']->value;?>
">
                <p class="lnk"><?php echo $_smarty_tpl->tpl_vars['job_name']->value[$_smarty_tpl->tpl_vars['jindex']->value];?>
</p>
                <i class="index_nav_icon"></i></a>
                <div style="top:-38px;" class="posBox">
                  <div class="posJobSort">
                    <div class="l"> <?php  $_smarty_tpl->tpl_vars['jtone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jtone']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['job_type']->value[$_smarty_tpl->tpl_vars['jindex']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jtone']->key => $_smarty_tpl->tpl_vars['jtone']->value) {
$_smarty_tpl->tpl_vars['jtone']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['jtone']->key;
?>
                      <dl class='<?php if ($_smarty_tpl->tpl_vars['key']->value&&($_smarty_tpl->tpl_vars['key']->value+1)%2==0) {?>m10<?php }?>'>
                        <dt><a href="<?php echo $_smarty_tpl->tpl_vars['jobclassurl']->value;?>
job1=<?php echo $_smarty_tpl->tpl_vars['jindex']->value;?>
&job1_son=<?php echo $_smarty_tpl->tpl_vars['jtone']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['job_name']->value[$_smarty_tpl->tpl_vars['jtone']->value];?>
</a></dt>
                        <dd> <?php  $_smarty_tpl->tpl_vars['jttwo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jttwo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['job_type']->value[$_smarty_tpl->tpl_vars['jtone']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jttwo']->key => $_smarty_tpl->tpl_vars['jttwo']->value) {
$_smarty_tpl->tpl_vars['jttwo']->_loop = true;
?> <a href="<?php echo $_smarty_tpl->tpl_vars['jobclassurl']->value;?>
job1=<?php echo $_smarty_tpl->tpl_vars['jindex']->value;?>
&job1_son=<?php echo $_smarty_tpl->tpl_vars['jtone']->value;?>
&job_post=<?php echo $_smarty_tpl->tpl_vars['jttwo']->value;?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['job_name']->value[$_smarty_tpl->tpl_vars['jttwo']->value];?>
</a> <?php } ?> </dd>
                      </dl>
                      <?php } ?> </div>
                  </div>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="lstMaskWhite1"></div>
          <div class="lstMaskGray1"></div>
        </div>
      </div>
    </div>
    <div class="index_search fl">
      <form action="<?php if (!$_smarty_tpl->tpl_vars['config']->value['sy_jobdir']) {?>index.php<?php } else {
echo smarty_function_url(array('m'=>'job'),$_smarty_tpl);
}?>" method="get" onsubmit="return search_keyword(this);"  id="index_search_form">
        <div class="index_search_box">
          <div class="index_search_t">
            <input type="hidden" <?php if (!$_smarty_tpl->tpl_vars['config']->value['sy_jobdir']) {?>name="m"<?php }?> value="job" id="m" /> 
            <input type="hidden" name="c" value="search" id="search" />
            <input type="text" id="keyword" name="keyword" class="index_serch_text" value='' placeholder='请输入要搜索的关键字' />
          </div>
          <div class="index_header_seach_find"> <span id='search_name'>找工作</span>
            <div class="index_header_seach_find_list" style="display:none"> <a href="javascript:void(0)" onclick="top_search('job', '找工作', '<?php echo smarty_function_url(array('m'=>'job'),$_smarty_tpl);?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_job_web'];?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_jobdir'];?>
'); $('#search').attr('name', 'c');">找工作</a> <a href="javascript:void(0)" onclick="top_search('resume', '找人才', '<?php echo smarty_function_url(array('m'=>'resume'),$_smarty_tpl);?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_resume_web'];?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_resumedir'];?>
'); $('#search').attr('name', 'c');"> 找人才</a> <a href="javascript:void(0)" onclick="top_search('tiny', '微简历', '<?php echo smarty_function_url(array('m'=>'tiny'),$_smarty_tpl);?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_tiny_web'];?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_tinydir'];?>
'); $('#search').attr('name', '');">微简历</a> <a href="javascript:void(0)" onclick="top_search('article', '新闻', '<?php echo smarty_function_url(array('m'=>'article'),$_smarty_tpl);?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_article_web'];?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_articledir'];?>
'); $('#search').attr('name', '');" style="display:none">新闻</a> <a href="javascript:void(0)" onclick="top_search('once', '微招聘', '<?php echo smarty_function_url(array('m'=>'once'),$_smarty_tpl);?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_once_web'];?>
', '<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_oncedir'];?>
'); $('#search').attr('name', '');">微招聘</a> </div>
          </div>
          <div class="index_serch_bth_b">
            <input type="submit" value="搜 索" class="index_serch_bth" />
          </div>
        </div>
      </form>
    </div>
    <div class="index_r_wap">
      <div> <span class="index_r_wap_icon png"></span> <i class="index_r_wap_icon_i png"></i> <span class="index_r_wap_icon_r  png"></span> <i class="index_r_wx_icon_i png"></i> </div>
      <div class="index_r_wap_l"> 手机站<i class="index_r_wap_l_s png"></i>
        <div class="index_r_wap_box" style="display:none">
          <div class="popWeixin"> <a class="close" href="javascript:void(0)">×</a>
            <dl>
              <dt><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_wap_qcode'];?>
" height="100" width="100" /></dt>
              <dd style="background:none;"> 手机扫一扫<br />
                找工作更方便<br />
                随时随地都能找工作 </dd>
            </dl>
            <div class="clear"></div>
            <div class="popWeixin_sm"><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/wap" class="index_r_wap_box_t_s"><?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/wap</a></div>
          </div>
        </div>
      </div>
      <div class="index_r_weixin"> 微信站<i class="index_r_wap_l_s png"></i>
        <div class="index_r_wap_box index_r_wap_box_weixin" style=" display:none;">
          <div class="popWeixin"> <a class="close" href="javascript:void(0)">×</a>
            <dl>
              <dt><img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_wx_qcode'];?>
" height="100" width="100" /></dt>
              <dd> 微信扫一扫<br />
                入职更快速<br />
                <br />
                第一时间收到面试通知 </dd>
            </dl>
            <div class="clear"></div>
            <div class="popWeixin_sm">请用您<font color="red">本人的</font>微信号扫二维码</div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="inbdex_box">
      <div class="index_left_mune"> <a href="<?php echo smarty_function_url(array('m'=>'job'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <div><i class="index_left_mune_icon png"></i></div>
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_1.png" width="28" height="28" class="png" /></dt>
          <dd>找工作</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'resume'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_2.png" width="28" height="28" class="png" /></dt>
          <dd>找人才</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'company'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_3.png" width="28" height="28" class="png" /></dt>
          <dd>找企业</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'once'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_4.png" width="28" height="28" class="png" /></dt>
          <dd>微招聘</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'tiny'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_5.png" width="28" height="28" class="png" /></dt>
          <dd>微简历</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'hr'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_6.png" width="28" height="28" class="png" /></dt>
          <dd>HR工具</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'article'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_7.png" width="28" height="28" class="png" /></dt>
          <dd>职场资讯</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'zph'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_8.png" width="28" height="28" class="png" /></dt>
          <dd>招聘会</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'evaluate'),$_smarty_tpl);?>
" class="index_left_mune_a" target="_blank">
        <dl class="index_left_mune_list">
          <dt><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_9.png" width="28" height="28" class="png" /></dt>
          <dd>人才测评</dd>
        </dl>
        </a> <a href="<?php echo smarty_function_url(array('m'=>'map'),$_smarty_tpl);?>
" class="index_left_mune_bot" target="_blank"><span class="index_left_mune_bot_s"><img src="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
/images/i_m_10.png" width="28" height="28" class="png" /></span><span class="fltL">附近的职位</span></a> </div>
      <div class="cont_Projector">
        <div class="Projector">
          <div class="Projector_img">
            <div id="slides" class="s_lb">
              <div class="slides_container">
               <?php  $_smarty_tpl->tpl_vars["lunbo"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["lunbo"]->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[3];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 0;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars["lunbo"]->key => $_smarty_tpl->tpl_vars["lunbo"]->value) {
$_smarty_tpl->tpl_vars["lunbo"]->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars["lunbo"]->key;
?>
                <div class="slide"><?php echo $_smarty_tpl->tpl_vars['lunbo']->value['html'];?>
</div>
                <?php } ?> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="yuin_index_r">
        <div class="yuin_index_r_bg">
          <div class="yuin_index_r_h1">
            <ul class="yun_index_h1_list">
              <li class="yun_index_h1_cur"><span><a href="<?php echo smarty_function_url(array('m'=>'article'),$_smarty_tpl);?>
">资讯</a></span>&nbsp;</li>
              <li><span><a href="<?php echo smarty_function_url(array('m'=>'announcement'),$_smarty_tpl);?>
">公告</a></span>&nbsp;</li>
            </ul>
          </div>
          <div class="yun_index_cont" style="display:block">
            <ul class="yun_in_news">
              <?php  $_smarty_tpl->tpl_vars['alist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['alist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$alist = $alist; if (!is_array($alist) && !is_object($alist)) { settype($alist, 'array');}
foreach ($alist as $_smarty_tpl->tpl_vars['alist']->key => $_smarty_tpl->tpl_vars['alist']->value) {
$_smarty_tpl->tpl_vars['alist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['alist']->key;
?>
              <li><span class="yun_in_news_span <?php if ($_smarty_tpl->tpl_vars['key']->value<3) {?>yun_in_news_span_cur<?php }?>"><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</span><a href="<?php echo $_smarty_tpl->tpl_vars['alist']->value['url'];?>
" class="yun_in_news_a" target="_blank"><?php echo $_smarty_tpl->tpl_vars['alist']->value['title'];?>
</a></li>
              <?php } ?>
            </ul>
          </div>
          <div class="yun_index_cont" style="display:none">
            <ul class="index_latest_news">
              <?php  $_smarty_tpl->tpl_vars['gonggao'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['gonggao']->_loop = false;
$gonggao = $gonggao; if (!is_array($gonggao) && !is_object($gonggao)) { settype($gonggao, 'array');}
foreach ($gonggao as $_smarty_tpl->tpl_vars['gonggao']->key => $_smarty_tpl->tpl_vars['gonggao']->value) {
$_smarty_tpl->tpl_vars['gonggao']->_loop = true;
?>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['gonggao']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['gonggao']->value['title_n'];?>
</a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="index_banner_top"><?php  $_smarty_tpl->tpl_vars['adlists'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adlists']->_loop = false;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[6];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 5;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['adlists']->key => $_smarty_tpl->tpl_vars['adlists']->value) {
$_smarty_tpl->tpl_vars['adlists']->_loop = true;
echo $_smarty_tpl->tpl_vars['adlists']->value['html'];
} ?></div>
    <div class="clear"></div>
    <div class="index_w1000">
      <div class="index_banner_cont">
        <?php  $_smarty_tpl->tpl_vars['adlist_13'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adlist_13']->_loop = false;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[13];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 2;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['adlist_13']->key => $_smarty_tpl->tpl_vars['adlist_13']->value) {
$_smarty_tpl->tpl_vars['adlist_13']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['adlist_13']->value['html'];?>

        <?php } ?>
        <?php  $_smarty_tpl->tpl_vars['adlist_14'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adlist_14']->_loop = false;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[14];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 6;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['adlist_14']->key => $_smarty_tpl->tpl_vars['adlist_14']->value) {
$_smarty_tpl->tpl_vars['adlist_14']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['adlist_14']->value['html'];?>

        <?php } ?>
        <?php  $_smarty_tpl->tpl_vars['adlist_15'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adlist_15']->_loop = false;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[15];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 10;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['adlist_15']->key => $_smarty_tpl->tpl_vars['adlist_15']->value) {
$_smarty_tpl->tpl_vars['adlist_15']->_loop = true;
?>
        <?php echo $_smarty_tpl->tpl_vars['adlist_15']->value['html'];?>

        <?php } ?> </div>
    </div>
    <div class="clear"></div>
    <div class="index_Emergency_job">
      <div class="Latest_talent_h1 "><b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_jj png"></i>紧急招聘</b><a href="<?php echo smarty_function_url(array('m'=>'job','c'=>'search','urgent'=>1),$_smarty_tpl);?>
" class="index_more" target="_blank">更多>></a></div>
      <div class="Emergency_index_cont">
        <ul>
          <?php  $_smarty_tpl->tpl_vars['urgentjoblist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['urgentjoblist']->_loop = false;
global $db,$db_config,$config;eval('$paramer=array("limit"=>"24","urgent"=>"1","comlen"=>"18","joblen"=>"11","jobnum"=>"4","item"=>"\'urgentjoblist\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];extract($paramer);
		$Purl =  $ParamerArr[purl];
		if($config['sy_web_site']=="1"){
			if($config['cityid']>0 && $config['cityid']!=""){
				$cityid=$config['cityid'];
			}
			if($config['three_cityid']>0 && $config['three_cityid']!=""){
				$three_cityid = $config['three_cityid'];
			}
			if($config['hyclass']>0 && $config['hyclass']!=""){
				$hy=$config['hyclass'];
			}
		}
		$time = time();
		$where = "`sdate`<$time AND `edate`>$time and  `state`='1' and `r_status`<>'2' and `status`<>'1'";
		if($paramer[urgent]){
			$where.=" AND `urgent_time`>$time";
		}
		if($cityid){
			$where.=' AND `cityid`='.$cityid;
		}
		if($three_cityid){
			$where.=" AND `three_cityid`=$cityid";
		}
		if($paramer[rec]){
			$where.=" AND `rec_time`>$time";
		}
		if($paramer['limit']){
			$limit=" limit ".$paramer['limit'];
		}
		include PLUS_PATH."/city.cache.php";
		include PLUS_PATH."/comrating.cache.php";
		$query = $db->query("select count(*) as num,uid,provinceid,cityid,three_cityid,lastupdate from $db_config[def]company_job where  $where GROUP BY uid ORDER BY lastupdate desc $limit");
		$uids=array();$ComList=array();
        while($rs = $db->fetch_array($query)){
			if($citylen){
				$one_city[$rs['uid']]	= mb_substr($city_name[$rs['cityid']],0,$citylen);
				$two_city[$rs['uid']] = mb_substr($city_name[$rs['three_cityid']],0,$citylen);
			}else{
				$one_city[$rs['uid']]	= $city_name[$rs['cityid']];
				$two_city[$rs['uid']] = $city_name[$rs['three_cityid']];
			}
			if($one_city[$rs['uid']]==''){
				$one_city[$rs['uid']]=$city_name[$rs['provinceid']];
			}
			$lasttime[$rs['uid']] = date('Y-m-d',$rs['lastupdate']);
			$uids[] = $rs['uid'];
		}
		if(!empty($uids)){
			$comids = @implode(',',$uids);
			$joblist = $db->select_all("company_job","$where AND `uid` IN ($comids) ORDER BY lastupdate desc");
			$job_list=array();
			foreach($joblist as $value){
				if(!$jobnum || count($job_list[$value['uid']])<$jobnum){
					if($joblen){
						$value['name_n'] = mb_substr($value['name'],0,$joblen,'gbk');
					}
					$value['url'] = Url("job",array("c"=>"comapply","id"=>$value['id']),"1");
					$job_list[$value['uid']][] = $value;
				}
				$comname[$value['uid']] = $value['com_name'];
			}
			$statis = $db->select_all("company_statis","`uid` in (".@implode(",",$uids).")","`uid`,`rating`");
			foreach($uids as $key=>$value){
				foreach($statis as $v){
					foreach($comrat as $val){
						if($value==$v[uid] && $val[id]==$v[rating])
						{
							$ComList[$key][color]=$val[com_color];
							$ComList[$key][ratlogo]=$val[com_pic];
						}
					}
				}
				$ComList[$key]['curl']     =  Url("company",array("c"=>"show","id"=>$value));
				$ComList[$key]['uid']     = $value;
				$ComList[$key]['name']	  = $comname[$value];
				$ComList[$key]['one_city']	  = $one_city[$value];
				$ComList[$key]['two_city']	  = $two_city[$value];
				$ComList[$key]['lasttime']     = $lasttime[$value];
				if($comlen){
					$ComList[$key]['name_n'] = mb_substr($comname[$value],0,$comlen,'gbk');
				}
				$ComList[$key]['joblist'] =$job_list[$value];
			}
		}$ComList = $ComList; if (!is_array($ComList) && !is_object($ComList)) { settype($ComList, 'array');}
foreach ($ComList as $_smarty_tpl->tpl_vars['urgentjoblist']->key => $_smarty_tpl->tpl_vars['urgentjoblist']->value) {
$_smarty_tpl->tpl_vars['urgentjoblist']->_loop = true;
?>
          <li class="Emergency_list">
            <div class="Emergency_list_t"><a href="<?php echo $_smarty_tpl->tpl_vars['urgentjoblist']->value['curl'];?>
" class="index_Emergency_com_name" target="_blank"><?php echo $_smarty_tpl->tpl_vars['urgentjoblist']->value['name_n'];?>
</a> <?php if ($_smarty_tpl->tpl_vars['urgentjoblist']->value['ratlogo']) {?>
            <img data-original="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['urgentjoblist']->value['ratlogo'];?>
" width="16" height="16" class="lazy" src=""/><?php }?></div>
            <div class="Emergency_list_b" id="post_index"> <?php  $_smarty_tpl->tpl_vars['urgentitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['urgentitem']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['urgentjoblist']->value['joblist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['urgentitem']->key => $_smarty_tpl->tpl_vars['urgentitem']->value) {
$_smarty_tpl->tpl_vars['urgentitem']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['urgentitem']->key;
?>
              <?php if ($_smarty_tpl->tpl_vars['key']->value>0) {?><em class="Emergency_list_t_line">|</em><?php }?><a href="<?php echo $_smarty_tpl->tpl_vars['urgentitem']->value['url'];?>
" target="_blank" class="index_Emergency_post_name"><?php echo $_smarty_tpl->tpl_vars['urgentitem']->value['name_n'];?>
</a> <?php } ?> </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="w980">
      <div class="Famous_recruitment">
        <div class="Latest_talent_h1 "><b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_mq png"></i>名企招聘</b><!--<a href="###" target="_blank" class="index_more">我也要出现在这里？</a>--></div>
        <div class="Famous_recruitment_cont_box">
          <div class="Famous_recruitment_cont">
            <div class="index_left15560">
              <div id="mainids"> <?php  $_smarty_tpl->tpl_vars['hotjoblist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hotjoblist']->_loop = false;
$hotjoblist = $hotjoblist; if (!is_array($hotjoblist) && !is_object($hotjoblist)) { settype($hotjoblist, 'array');}
foreach ($hotjoblist as $_smarty_tpl->tpl_vars['hotjoblist']->key => $_smarty_tpl->tpl_vars['hotjoblist']->value) {
$_smarty_tpl->tpl_vars['hotjoblist']->_loop = true;
?>
                <div class="tlogo">
                  <ul>
                    <li onmouseover="showDiv2(this)" onmouseout="showDiv2(this)"> <a href="<?php echo $_smarty_tpl->tpl_vars['hotjoblist']->value['url'];?>
" target="_blank"><img width="185" height="75" border="1" data-original="<?php echo smarty_function_formatpicurl(array('path'=>$_smarty_tpl->tpl_vars['hotjoblist']->value['hot_pic']),$_smarty_tpl);?>
" class="on lazy" src=""/></a>
                      <div class="show">
                        <div class="area"><?php echo $_smarty_tpl->tpl_vars['hotjoblist']->value['job'];?>
</div>
                      </div>
                    </li>
                  </ul>
                </div>
                <?php } ?> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="index_Emergency_job">
      <div class="Latest_talent_h1 "><b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_new png"></i>推荐职位</b><a href="<?php echo smarty_function_url(array('m'=>'job','c'=>'search','rec'=>1),$_smarty_tpl);?>
" class="index_more" target="_blank">更多>></a></div>
      <div class="Recommended_jobs_cont">
        <div class="Famous_recruitment_cont">
          <ul>
            <?php  $_smarty_tpl->tpl_vars['job_list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['job_list']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
global $db,$db_config,$config;eval('$paramer=array("limit"=>"28","rec"=>"1","comlen"=>"20","joblen"=>"5","jobnum"=>"3","item"=>"\'job_list\'","key"=>"\'key\'","name"=>"\'comjoblist1\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];extract($paramer);
		$Purl =  $ParamerArr[purl];
		if($config['sy_web_site']=="1"){
			if($config['cityid']>0 && $config['cityid']!=""){
				$cityid=$config['cityid'];
			}
			if($config['three_cityid']>0 && $config['three_cityid']!=""){
				$three_cityid = $config['three_cityid'];
			}
			if($config['hyclass']>0 && $config['hyclass']!=""){
				$hy=$config['hyclass'];
			}
		}
		$time = time();
		$where = "`sdate`<$time AND `edate`>$time and  `state`='1' and `r_status`<>'2' and `status`<>'1'";
		if($paramer[urgent]){
			$where.=" AND `urgent_time`>$time";
		}
		if($cityid){
			$where.=' AND `cityid`='.$cityid;
		}
		if($three_cityid){
			$where.=" AND `three_cityid`=$cityid";
		}
		if($paramer[rec]){
			$where.=" AND `rec_time`>$time";
		}
		if($paramer['limit']){
			$limit=" limit ".$paramer['limit'];
		}
		include PLUS_PATH."/city.cache.php";
		include PLUS_PATH."/comrating.cache.php";
		$query = $db->query("select count(*) as num,uid,provinceid,cityid,three_cityid,lastupdate from $db_config[def]company_job where  $where GROUP BY uid ORDER BY lastupdate desc $limit");
		$uids=array();$ComList=array();
        while($rs = $db->fetch_array($query)){
			if($citylen){
				$one_city[$rs['uid']]	= mb_substr($city_name[$rs['cityid']],0,$citylen);
				$two_city[$rs['uid']] = mb_substr($city_name[$rs['three_cityid']],0,$citylen);
			}else{
				$one_city[$rs['uid']]	= $city_name[$rs['cityid']];
				$two_city[$rs['uid']] = $city_name[$rs['three_cityid']];
			}
			if($one_city[$rs['uid']]==''){
				$one_city[$rs['uid']]=$city_name[$rs['provinceid']];
			}
			$lasttime[$rs['uid']] = date('Y-m-d',$rs['lastupdate']);
			$uids[] = $rs['uid'];
		}
		if(!empty($uids)){
			$comids = @implode(',',$uids);
			$joblist = $db->select_all("company_job","$where AND `uid` IN ($comids) ORDER BY lastupdate desc");
			$job_list=array();
			foreach($joblist as $value){
				if(!$jobnum || count($job_list[$value['uid']])<$jobnum){
					if($joblen){
						$value['name_n'] = mb_substr($value['name'],0,$joblen,'gbk');
					}
					$value['url'] = Url("job",array("c"=>"comapply","id"=>$value['id']),"1");
					$job_list[$value['uid']][] = $value;
				}
				$comname[$value['uid']] = $value['com_name'];
			}
			$statis = $db->select_all("company_statis","`uid` in (".@implode(",",$uids).")","`uid`,`rating`");
			foreach($uids as $key=>$value){
				foreach($statis as $v){
					foreach($comrat as $val){
						if($value==$v[uid] && $val[id]==$v[rating])
						{
							$ComList[$key][color]=$val[com_color];
							$ComList[$key][ratlogo]=$val[com_pic];
						}
					}
				}
				$ComList[$key]['curl']     =  Url("company",array("c"=>"show","id"=>$value));
				$ComList[$key]['uid']     = $value;
				$ComList[$key]['name']	  = $comname[$value];
				$ComList[$key]['one_city']	  = $one_city[$value];
				$ComList[$key]['two_city']	  = $two_city[$value];
				$ComList[$key]['lasttime']     = $lasttime[$value];
				if($comlen){
					$ComList[$key]['name_n'] = mb_substr($comname[$value],0,$comlen,'gbk');
				}
				$ComList[$key]['joblist'] =$job_list[$value];
			}
		}$ComList = $ComList; if (!is_array($ComList) && !is_object($ComList)) { settype($ComList, 'array');}
foreach ($ComList as $_smarty_tpl->tpl_vars['job_list']->key => $_smarty_tpl->tpl_vars['job_list']->value) {
$_smarty_tpl->tpl_vars['job_list']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['job_list']->key;
?>
            <li> <em class="Recommended_jobs_cont_li"> <span class="Recommended_jobs_pin">聘：</span><?php  $_smarty_tpl->tpl_vars['jlist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jlist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['job_list']->value['joblist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jlist']->key => $_smarty_tpl->tpl_vars['jlist']->value) {
$_smarty_tpl->tpl_vars['jlist']->_loop = true;
?> <a href="<?php echo $_smarty_tpl->tpl_vars['jlist']->value['url'];?>
" class="Recommended_jobs_name_cor" target="_blank"><?php echo $_smarty_tpl->tpl_vars['jlist']->value['name_n'];?>
</a> <?php } ?> </em> <em class="Recommended_jobs_name"> <a href="<?php echo $_smarty_tpl->tpl_vars['job_list']->value['curl'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['job_list']->value['name_n'];?>
</a><?php if ($_smarty_tpl->tpl_vars['job_list']->value['ratlogo']) {?><img data-original="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['job_list']->value['ratlogo'];?>
" width="16" height="16" class="lazy" src=""/><?php }?> </em> </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="index_Emergency_job">
      <div class="Featured_Jobs_bg1">
        <div class="Latest_talent_h1"><b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_new_post png"></i>最新职位</b><a href="<?php echo smarty_function_url(array('m'=>'job','c'=>'search'),$_smarty_tpl);?>
" class="index_more" target="_blank">更多>></a></div>
        <div class="Famous_recruitment_cont_box">
          <div class="Featured_Jobs">
            <div class="Featured_Jobs_list"> <?php  $_smarty_tpl->tpl_vars['hot'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hot']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
global $db,$db_config,$config;eval('$paramer=array("limit"=>"32","comlen"=>"13","joblen"=>"5","jobnum"=>"3","item"=>"\'hot\'","key"=>"\'key\'","name"=>"\'comjoblist2\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];extract($paramer);
		$Purl =  $ParamerArr[purl];
		if($config['sy_web_site']=="1"){
			if($config['cityid']>0 && $config['cityid']!=""){
				$cityid=$config['cityid'];
			}
			if($config['three_cityid']>0 && $config['three_cityid']!=""){
				$three_cityid = $config['three_cityid'];
			}
			if($config['hyclass']>0 && $config['hyclass']!=""){
				$hy=$config['hyclass'];
			}
		}
		$time = time();
		$where = "`sdate`<$time AND `edate`>$time and  `state`='1' and `r_status`<>'2' and `status`<>'1'";
		if($paramer[urgent]){
			$where.=" AND `urgent_time`>$time";
		}
		if($cityid){
			$where.=' AND `cityid`='.$cityid;
		}
		if($three_cityid){
			$where.=" AND `three_cityid`=$cityid";
		}
		if($paramer[rec]){
			$where.=" AND `rec_time`>$time";
		}
		if($paramer['limit']){
			$limit=" limit ".$paramer['limit'];
		}
		include PLUS_PATH."/city.cache.php";
		include PLUS_PATH."/comrating.cache.php";
		$query = $db->query("select count(*) as num,uid,provinceid,cityid,three_cityid,lastupdate from $db_config[def]company_job where  $where GROUP BY uid ORDER BY lastupdate desc $limit");
		$uids=array();$ComList=array();
        while($rs = $db->fetch_array($query)){
			if($citylen){
				$one_city[$rs['uid']]	= mb_substr($city_name[$rs['cityid']],0,$citylen);
				$two_city[$rs['uid']] = mb_substr($city_name[$rs['three_cityid']],0,$citylen);
			}else{
				$one_city[$rs['uid']]	= $city_name[$rs['cityid']];
				$two_city[$rs['uid']] = $city_name[$rs['three_cityid']];
			}
			if($one_city[$rs['uid']]==''){
				$one_city[$rs['uid']]=$city_name[$rs['provinceid']];
			}
			$lasttime[$rs['uid']] = date('Y-m-d',$rs['lastupdate']);
			$uids[] = $rs['uid'];
		}
		if(!empty($uids)){
			$comids = @implode(',',$uids);
			$joblist = $db->select_all("company_job","$where AND `uid` IN ($comids) ORDER BY lastupdate desc");
			$job_list=array();
			foreach($joblist as $value){
				if(!$jobnum || count($job_list[$value['uid']])<$jobnum){
					if($joblen){
						$value['name_n'] = mb_substr($value['name'],0,$joblen,'gbk');
					}
					$value['url'] = Url("job",array("c"=>"comapply","id"=>$value['id']),"1");
					$job_list[$value['uid']][] = $value;
				}
				$comname[$value['uid']] = $value['com_name'];
			}
			$statis = $db->select_all("company_statis","`uid` in (".@implode(",",$uids).")","`uid`,`rating`");
			foreach($uids as $key=>$value){
				foreach($statis as $v){
					foreach($comrat as $val){
						if($value==$v[uid] && $val[id]==$v[rating])
						{
							$ComList[$key][color]=$val[com_color];
							$ComList[$key][ratlogo]=$val[com_pic];
						}
					}
				}
				$ComList[$key]['curl']     =  Url("company",array("c"=>"show","id"=>$value));
				$ComList[$key]['uid']     = $value;
				$ComList[$key]['name']	  = $comname[$value];
				$ComList[$key]['one_city']	  = $one_city[$value];
				$ComList[$key]['two_city']	  = $two_city[$value];
				$ComList[$key]['lasttime']     = $lasttime[$value];
				if($comlen){
					$ComList[$key]['name_n'] = mb_substr($comname[$value],0,$comlen,'gbk');
				}
				$ComList[$key]['joblist'] =$job_list[$value];
			}
		}$ComList = $ComList; if (!is_array($ComList) && !is_object($ComList)) { settype($ComList, 'array');}
foreach ($ComList as $_smarty_tpl->tpl_vars['hot']->key => $_smarty_tpl->tpl_vars['hot']->value) {
$_smarty_tpl->tpl_vars['hot']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['hot']->key;
?>
              <dl>
                <dd>
                  <div class="Featured_Jobs_t1"> <a href="<?php echo $_smarty_tpl->tpl_vars['hot']->value['curl'];?>
" class="Featured_Jobs_name fl" target="_blank"><?php echo $_smarty_tpl->tpl_vars['hot']->value['name_n'];?>
</a><?php if ($_smarty_tpl->tpl_vars['hot']->value['ratlogo']) {?><img data-original="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['hot']->value['ratlogo'];?>
" width="16" height="16" class="lazy" src=""/><?php }?> </div>
                  <div class="Featured_Jobs_t2" id="post_index"> <?php  $_smarty_tpl->tpl_vars['jlist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jlist']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hot']->value['joblist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jlist']->key => $_smarty_tpl->tpl_vars['jlist']->value) {
$_smarty_tpl->tpl_vars['jlist']->_loop = true;
?> <span> <a href="<?php echo $_smarty_tpl->tpl_vars['jlist']->value['url'];?>
" target="_blank" class="Featured_Jobs_name_c"><?php echo $_smarty_tpl->tpl_vars['jlist']->value['name_n'];?>
</a> </span> <?php } ?> </div>
                </dd>
              </dl>
              <?php } ?> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="index_Emergency_job">
      <div class="Latest_talent_h1 "><b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_user png"></i>最新人才</b><a href="<?php echo smarty_function_url(array('m'=>'resume','c'=>'search'),$_smarty_tpl);?>
" class="index_more" target="_blank">更多>></a></div>
      <div class="Latest_talent_cont">
        <div class="Latest_talent_cont_box"> <?php  $_smarty_tpl->tpl_vars['ulist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ulist']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$ulist = $ulist; if (!is_array($ulist) && !is_object($ulist)) { settype($ulist, 'array');}
foreach ($ulist as $_smarty_tpl->tpl_vars['ulist']->key => $_smarty_tpl->tpl_vars['ulist']->value) {
$_smarty_tpl->tpl_vars['ulist']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['ulist']->key;
?>
          <div class="com_index_rue_list fl">
            <dl>
              <dt><img width="24" height="30" data-original="<?php echo $_smarty_tpl->tpl_vars['ulist']->value['photo'];?>
" class="lazy" src="" onerror="showImgDelay(this,'<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_member_icon'];?>
',2);" /></dt>
              <dd>
                <div class="com_index_rue_list_t"> <strong class="fl"><a class="cblue blod" href="<?php echo smarty_function_url(array('m'=>'resume','c'=>'show','id'=>'`$ulist.id`'),$_smarty_tpl);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['ulist']->value['username_n'];?>
</a></strong> <span class="com_index_rue_list_date fr"><?php echo $_smarty_tpl->tpl_vars['ulist']->value['time'];?>
</span> </div>
                <div class="com_index_rue_list_t index_talent"> <span class="com_index_rue_listspan">￥</span> <em class="com_index_rue_list_xz f60"><?php echo $_smarty_tpl->tpl_vars['ulist']->value['salary_n'];?>
</em> </div>
                <div class="com_index_rue_list_t index_exper"> <span class="com_index_rue_listspan">经验：</span> <em class="com_index_rue_list_xz com_index_rue_list_jy f61"><?php echo $_smarty_tpl->tpl_vars['ulist']->value['exp_n'];?>
</em> </div>
              </dd>
            </dl>
            <div class="com_index_rue_list_yx"><span class="com_index_rue_listspan">意向职位：</span><?php echo $_smarty_tpl->tpl_vars['ulist']->value['job_post_n'];?>
</div>
          </div>
          <?php } ?> </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="index_w1000">
      <div class="index_news">
        <div class="Latest_talent_h1 "> <b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_news png"></i>职场资讯</b> <span class="index_h1_right fr"> <?php  $_smarty_tpl->tpl_vars['arcgroupright'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arcgroupright']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
global $db,$db_config,$config;eval('$paramer=array("rec"=>"1","item"=>"\'arcgroupright\'","urlstatic"=>"1","key"=>"\'key\'","len"=>"4","pt_len"=>"12","pd_len"=>"40","t_len"=>"15","name"=>"\'newclasslist1\'","nocache"=>"")
;');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];
		$Purl =  $ParamerArr[purl];
		include PLUS_PATH."/group.cache.php";
		if($paramer['classid']){
			$classid = @explode(',',$paramer['classid']);
			if(is_array($classid)){
				foreach($classid as $key=>$value)
				{
					$Info['id']   = $value;
					$Info['name'] = $group_name[$value];
					$group[] = $Info;
				}
			}
		}else if($paramer['rec']){
			if(is_array($group_rec)){
				foreach($group_rec as $key=>$value)
				{
					$Info['id']   = $value;
					$Info['name'] = $group_name[$value];
					$group[] = $Info;
				}
			}
		}else if($paramer['r_news']){
			if(is_array($group_recnews)){
				foreach($group_recnews as $key=>$value)
				{
					$Info['id']   = $value;
					$Info['name'] = $group_name[$value];
					$group[] = $Info;
				}
			}
		}else{
			if(is_array($group_index)){
				foreach($group_index as $key=>$value)
				{
					$Info['id']   = $value;
					$Info['name'] = $group_name[$value];
					$group[] = $Info;
				}
			}
		}
		if(is_array($group))
		{
			foreach($group as $key=>$value)
			{
				if(intval($paramer[len])>0)
				{
					$len = intval($paramer[len]);
					$group[$key][name] = mb_substr($value[name],0,$len,"GBK");
				}
				if($group_type[$value['id']])
				{
					$nids = $value['id'].",".@implode(',',$group_type[$value['id']]);
				}else{
					$nids = $value['id'];
				}
				if($config[sy_news_rewrite]=="2"){
					$group[$key][url] = $config['sy_weburl']."/news/".$value[id]."/";
				}else{
					 $group[$key][url] = Url('article',array('c'=>'list',"nid"=>$value[id]),"1");
				}
				if($_COOKIE[did]){
					$newswhere=" and `did`=$_COOKIE[did]";
				}
				if($paramer[arcpic])
				{
					$query = $db->query("SELECT * FROM `$db_config[def]news_base` WHERE `nid`='$value[id]' AND `newsphoto`<>'' $newswhere  ORDER BY `sort` DESC,`datetime` DESC limit $paramer[arcpic]");
					while($rs = $db->fetch_array($query)){
						if(intval($paramer[pt_len])>0)
						{
							$len = intval($paramer[pt_len]);
							if($rs[color]){
								$rs[title] = "<font color='".$rs[color]."'>".mb_substr($rs[title],0,$len,"GBK")."</font>";
							}else{
								$rs[title] = mb_substr($rs[title],0,$len,"GBK");
							}
						}
						if(intval($paramer[pd_len])>0)
						{
							$len = intval($paramer[pd_len]);
							$rs[description] = mb_substr($rs[description],0,$len,"GBK");
						}
						foreach($group as $k=>$v)
						{
							if($v[id]==$rs[nid])
							{
								$rs[name] = $v[name];
							}
						}

						if($config[sy_news_rewrite]=="2"){
							$rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
						}else{
							$rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
						}
						$arcpic[] = $rs;
					}
					$group[$key][arcpic] = $arcpic;
					unset($arcpic);

				}
				if($paramer[arclist])
				{
					$query = $db->query("SELECT * FROM `$db_config[def]news_base` WHERE `nid`='$value[id]' $newswhere  ORDER BY `sort` DESC,`datetime` DESC limit $paramer[arclist]");
					while($rs = $db->fetch_array($query))
					{
						if(intval($paramer[t_len])>0)
						{
							$len = intval($paramer[t_len]);
							if($rs[color]){
								$rs[title] = "<font color='".$rs[color]."'>".mb_substr($rs[title],0,$len,"GBK")."</font>";
							}else{
								$rs[title] = mb_substr($rs[title],0,$len,"GBK");
							}
						}
						if(intval($paramer[d_len])>0)
						{
							$len = intval($paramer[d_len]);
							$rs[description] = mb_substr($rs[description],0,$len,"GBK");
						}
						foreach($group as $k=>$v)
						{
							if($v[id]==$rs[nid])
							{
								$rs[name] = $v[name];
							}
						}

						if($config[sy_news_rewrite]=="2"){
							$rs["url"]=$config['sy_weburl']."/news/".date("Ymd",$rs["datetime"])."/".$rs[id].".html";
						}else{
							$rs["url"] = Url("article",array("c"=>"show","id"=>$rs[id]),"1");
						}
						$arclist[] = $rs;
					}
					$group[$key][arclist] = $arclist;
					unset($arclist);
				}
			}
		}$group = $group; if (!is_array($group) && !is_object($group)) { settype($group, 'array');}
foreach ($group as $_smarty_tpl->tpl_vars['arcgroupright']->key => $_smarty_tpl->tpl_vars['arcgroupright']->value) {
$_smarty_tpl->tpl_vars['arcgroupright']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['arcgroupright']->key;
?>
          <?php if ($_smarty_tpl->tpl_vars['key']->value>0) {?>|<?php }?> <a href="<?php echo $_smarty_tpl->tpl_vars['arcgroupright']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['arcgroupright']->value['name'];?>
</a> <?php } ?> <a <?php if ($_smarty_tpl->tpl_vars['config']->value['sy_news_rewrite']=='2') {?>href="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/news.html"<?php } else { ?>href="<?php echo smarty_function_url(array('m'=>'article'),$_smarty_tpl);?>
"<?php }?>target="_blank">更多>></a> </span> </div>
        <div class="Famous_recruitment_cont_box"> <?php  $_smarty_tpl->tpl_vars['indexnews'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['indexnews']->_loop = false;
$indexnews = $indexnews; if (!is_array($indexnews) && !is_object($indexnews)) { settype($indexnews, 'array');}
foreach ($indexnews as $_smarty_tpl->tpl_vars['indexnews']->key => $_smarty_tpl->tpl_vars['indexnews']->value) {
$_smarty_tpl->tpl_vars['indexnews']->_loop = true;
?>
          <div class="index_news_content"> <?php if ($_smarty_tpl->tpl_vars['indexnews']->value['pic']) {?>
            <dl class="index_news_top">
              <dt> <a href="<?php echo $_smarty_tpl->tpl_vars['indexnews']->value['pic'][0]['url'];?>
"> <img width="100" height="80" data-original="<?php echo $_smarty_tpl->tpl_vars['config']->value['sy_weburl'];?>
/<?php echo $_smarty_tpl->tpl_vars['indexnews']->value['pic'][0]['newsphoto'];?>
" class="lazy" src=""/> </a> </dt>
              <dd> <strong><a href="<?php echo $_smarty_tpl->tpl_vars['indexnews']->value['pic'][0]['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['indexnews']->value['pic'][0]['title'];?>
</a></strong> <span><?php echo $_smarty_tpl->tpl_vars['indexnews']->value['pic'][0]['description'];?>
...</span> <a href="<?php echo $_smarty_tpl->tpl_vars['indexnews']->value['pic'][0]['url'];?>
" target="_blank">[详细]</a> </dd>
            </dl>
            <?php }?>
            <div class="index_news_right">
              <ul>
                <?php  $_smarty_tpl->tpl_vars['arcitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arcitem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['indexnews']->value['arclist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arcitem']->key => $_smarty_tpl->tpl_vars['arcitem']->value) {
$_smarty_tpl->tpl_vars['arcitem']->_loop = true;
?>
                <li>[<?php echo $_smarty_tpl->tpl_vars['arcitem']->value['name'];?>
] <a href="<?php echo $_smarty_tpl->tpl_vars['arcitem']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['arcitem']->value['title'];?>
</a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <?php } ?> </div>
      </div>
      <div class="index_news">
        <div class="Latest_talent_h1 "><b><i class="Latest_talent_h1_icon Latest_talent_h1_icon_link png"></i>友情链接</b><?php if ($_smarty_tpl->tpl_vars['config']->value['sy_linksq']==0) {?> <a href="<?php echo smarty_function_url(array('m'=>'link'),$_smarty_tpl);?>
" class="index_more">申请链接</a><?php }?></div>
        <div class="Famous_recruitment_cont_box">
          <div class="index_link_cont">
            <div class="index_link_list">
              <div class="index_link_list_img"> <?php  $_smarty_tpl->tpl_vars['linklist'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['linklist']->_loop = false;
global $config;      
		$domain='';
		if($config["cityid"]!="" || $config["hyclass"]!=""){
			include(PLUS_PATH."/domain_cache.php");
			$host_url=$_SERVER['HTTP_HOST'];
			foreach($site_domain as $v){
				if($v['host']==$host_url){
					$domain=$v['id'];
				}
			}
		}$tem_type = 2;
        include PLUS_PATH."/link.cache.php";
		if(is_array($link)){$linkList=array();
			$i=0;
			foreach($link as $key=>$value)
			{
				if($config["did"]!=0 && $value["did"]!=$config["did"])
				{
					continue;
				}elseif(is_numeric('2') && $value['tem_type']!='2' && $value['tem_type']!='1'){
					continue;

				}elseif((!is_numeric('2') || '2'=='1') && $value['tem_type']!='1'){

					continue;
				}
				if(is_numeric('2') && $value['link_type']!='2')
				{
					continue;
				}
				if(is_numeric('') && intval('')<=$i)
				{
					break;
				}
				$value[picurl] = $config[sy_weburl]."/".$value[pic];
				$linkList[] = $value;
				$i++;
			}
		}$linkList = $linkList; if (!is_array($linkList) && !is_object($linkList)) { settype($linkList, 'array');}
foreach ($linkList as $_smarty_tpl->tpl_vars['linklist']->key => $_smarty_tpl->tpl_vars['linklist']->value) {
$_smarty_tpl->tpl_vars['linklist']->_loop = true;
?> <a href="<?php echo $_smarty_tpl->tpl_vars['linklist']->value['link_url'];?>
" target="_blank"><img class="lazy" src="" data-original="<?php echo $_smarty_tpl->tpl_vars['linklist']->value['pic'];?>
" width="120" height="35" alt="<?php echo $_smarty_tpl->tpl_vars['linklist']->value['link_name'];?>
" /></a> <?php } ?> </div>
              <div class="index_link_list_name"> <?php  $_smarty_tpl->tpl_vars['linklist2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['linklist2']->_loop = false;
global $config;      
		$domain='';
		if($config["cityid"]!="" || $config["hyclass"]!=""){
			include(PLUS_PATH."/domain_cache.php");
			$host_url=$_SERVER['HTTP_HOST'];
			foreach($site_domain as $v){
				if($v['host']==$host_url){
					$domain=$v['id'];
				}
			}
		}$tem_type = 2;
        include PLUS_PATH."/link.cache.php";
		if(is_array($link)){$linkList=array();
			$i=0;
			foreach($link as $key=>$value)
			{
				if($config["did"]!=0 && $value["did"]!=$config["did"])
				{
					continue;
				}elseif(is_numeric('2') && $value['tem_type']!='2' && $value['tem_type']!='1'){
					continue;

				}elseif((!is_numeric('2') || '2'=='1') && $value['tem_type']!='1'){

					continue;
				}
				if(is_numeric('1') && $value['link_type']!='1')
				{
					continue;
				}
				if(is_numeric('') && intval('')<=$i)
				{
					break;
				}
				$value[picurl] = $config[sy_weburl]."/".$value[pic];
				$linkList[] = $value;
				$i++;
			}
		}$linkList = $linkList; if (!is_array($linkList) && !is_object($linkList)) { settype($linkList, 'array');}
foreach ($linkList as $_smarty_tpl->tpl_vars['linklist2']->key => $_smarty_tpl->tpl_vars['linklist2']->value) {
$_smarty_tpl->tpl_vars['linklist2']->_loop = true;
?> <a href="<?php echo $_smarty_tpl->tpl_vars['linklist2']->value['link_url'];?>
" target="_blank"> <?php echo $_smarty_tpl->tpl_vars['linklist2']->value['link_name'];?>
</a> <?php } ?> </div>
            </div>
          </div>
        </div>
      </div>
      <div id="bg"></div>
      <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/backtop.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

      <div id='footer_ad'> <?php  $_smarty_tpl->tpl_vars['footer_ad'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['footer_ad']->_loop = false;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[10];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 0;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['footer_ad']->key => $_smarty_tpl->tpl_vars['footer_ad']->value) {
$_smarty_tpl->tpl_vars['footer_ad']->_loop = true;
?>
        <div class="footer_ban" id="">
          <div class="baner_footer" id='bottom_ad_fl'> <span class="ban_close" onclick="colse_bottom()">关闭</span> <?php echo $_smarty_tpl->tpl_vars['footer_ad']->value['html'];?>
 </div>
          <input type="hidden" value='1' id='bottom_ad_is_show' />
        </div>
        <?php } ?>
        <?php  $_smarty_tpl->tpl_vars['left_ad'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['left_ad']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
$AdArr=array();$paramer=array();
			include(PLUS_PATH.'/pimg_cache.php');$add_arr = $ad_label[11];if(is_array($add_arr) && !empty($add_arr)){
				$i=0;$limit = 0;$length = 0;
				foreach($add_arr as $key=>$value){
					if(($value['did']==$_COOKIE['did'] ||$value['did']=='0')&&$value['start']<time()&&$value['end']>time()){
						if($i>0 && $limit==$i){
							break;
						}
						if($length>0){
							$value['name'] = mb_substr($value['name'],0,$length);
						}
						if($paramer['type']!=""){
							if($paramer['type'] == $value['type']){
								$AdArr[] = $value;
							}
						}else{
							$AdArr[] = $value;
						}
						$i++;
					}
				}
			}$AdArr = $AdArr; if (!is_array($AdArr) && !is_object($AdArr)) { settype($AdArr, 'array');}
foreach ($AdArr as $_smarty_tpl->tpl_vars['left_ad']->key => $_smarty_tpl->tpl_vars['left_ad']->value) {
$_smarty_tpl->tpl_vars['left_ad']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['left_ad']->key;
?>
        <div class="duilian <?php if ($_smarty_tpl->tpl_vars['key']->value=='0') {?>duilian_left<?php } else { ?>duilian_right<?php }?>">
          <div class="duilian_con"><?php echo $_smarty_tpl->tpl_vars['left_ad']->value['html'];?>
</div>
          <div class="close_container">
            <div class="btn_close"></div>
          </div>
        </div>
        <?php } ?> </div>
    </div>
  </div>
</div>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/public_search/index_search.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tplstyle']->value)."/footer.htm", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</body>
</html><?php }} ?>
