<?php

class Smarty_Internal_Compile_Userlist extends Smarty_Internal_CompileBase
{
    public $required_attributes = array('item');
    public $optional_attributes = array('name', 'key', 'post_len', 'limit', 'salary', 'idcard', 'edu', 'order', 'work', 'exp', 'sex', 'keyword', 'hy', 'provinceid', 'report', 'cityid', 'three_cityid', 'adtime', 'jobids', 'pic', 'typeids', 'type', 'job1_son', 'job_post', 'uptime', 'ispage', 'rec_resume', 'where_uid', 'height_status', 'rec', 't_len', 'top', 'job_classid', 'islt', 'job1', 'isshow', 'cityin', 'jobin');
    public $shorttag_order = array('from', 'item', 'key', 'name');

    public function compile($args, $compiler, $parameter)
    {
        $_attr = $this->getAttributes($compiler, $args);

        $from = $_attr['from'];
        $item = $_attr['item'];
        $name = $_attr['item'];
        $name = str_replace('\'', '', $name);
        $name = $name ? $name : 'list';
        $name = '$' . $name;
        if (!strncmp("\$_smarty_tpl->tpl_vars[$item]", $from, strlen($item) + 24)) {
            $compiler->trigger_template_error("item variable {$item} may not be the same variable as at 'from'", $compiler->lex->taglineno);
        }

        $OutputStr = '' . $name . '=array();global $db,$db_config,$config;eval(\'$paramer=' . str_replace('\'', '\\\'', ArrayToString($_attr, true)) . ';\');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[\'arr\'];extract($paramer);
		$Purl =  $ParamerArr[\'purl\'];
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
        include PLUS_PATH."/job.cache.php";
		$where = "status<>\'2\' and `r_status`<>\'2\' and `job_classid`<>\'\' and `open`=\'1\' and `defaults`=1";
		if($config[\'sy_web_site\']=="1"){
			if($config[\'cityid\']>0 && $config[\'cityid\']!=""){
				$paramer[\'cityid\']=$config[\'cityid\'];
			}
			if($config[\'three_cityid\']>0 && $config[\'three_cityid\']!=""){
				$paramer[\'three_cityid\']=$config[\'three_cityid\'];
			}
			if($config[\'hyclass\']>0 && $config[\'hyclass\']!=""){
				$paramer[\'hy\']=$config[\'hyclass\'];
			}
		}
		if($paramer[\'where_uid\']){
			$where .=" AND `uid` in (".$paramer[\'where_uid\'].")";
		}
		if($paramer[\'idcard\']){
			$where .=" AND `idcard_status`=\'1\'";
		}
		if($paramer[\'height_status\']){
			$where .=" AND height_status=".$paramer[height_status];
		}else{
			$where .=" AND height_status<>\'2\'";
		}
		if($paramer[\'rec\']){
			$where .=" AND rec=1";
		}
		if($paramer[\'rec_resume\']){
			$where .=" AND `rec_resume`=1";
		}
		if($paramer[\'work\']){
			$show=$db->select_all("resume_show","1 group by eid","`eid`");
			if(is_array($show))
			{
				foreach($show as $v)
				{
					$eid[]=$v[\'eid\'];
				}
			}
			$where .=" AND id in (".@implode(",",$eid).")";
		}
		if($paramer[\'cid\']){
			$where .= " AND (cityid=$paramer[cid] or three_cityid=$paramer[cid])";
		}
		if($paramer[\'keyword\']){
			$where1[]="`uname` LIKE \'%$paramer[keyword]%\'";
			foreach($job_name as $k=>$v){
				if(strpos($v,$paramer[keyword])!==false){
					$jobid[]=$k;
				}
			}
			if(is_array($jobid))
			{
				foreach($jobid as $value)
				{
					$class[]="FIND_IN_SET(\'".$value."\',job_classid)";
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
					$class[]= "(provinceid = \'".$value."\' or cityid = \'".$value."\')";
				}
				$where1[]=@implode(" or ",$class);
			}
			$where.=" AND (".@implode(" or ",$where1).")";
		}
		if($paramer[\'pic\']=="0"||$paramer[\'pic\']){
			$where .=" AND photo<>\'\'";
		}
		if($paramer[name]=="0"){
			$where .=" AND uname<>\'\'";
		}
		if($paramer[hy]=="0"){
			$where .=" AND hy<>\'\'";
		}elseif($paramer[hy]!=""){
			$where .= " AND (`hy` IN (".$paramer[\'hy\']."))";
		}
		$job_classid="";
		if($paramer[\'jobids\']){
			$joball=explode(",",$paramer[\'jobids\']);
			foreach(explode(",",$paramer[\'jobids\']) as $v){
				if($job_type[$v]){
					$joball[]=@implode(",",$job_type[$v]);
				}
			}
			$job_classid=implode(",",$joball);
		}
		if($paramer[\'job1\']){
			$joball=$job_type[$paramer[\'job1\']];
			foreach($job_type[$paramer[\'job1\']] as $v)
			{
				$joball[]=@implode(",",$job_type[$v]);
			}
			$job_classid=@implode(",",$joball);
		}
		if($paramer[\'job1_son\']){
			$joball=$job_type[$paramer[\'job1_son\']];
			foreach($job_type[$paramer[\'job1_son\']] as $v)
			{
				$joball[]=@implode(",",$v);
			}
			$job_classid=@implode(",",$joball);
		}
		if(!empty($job_classid)){
			$classid=@explode(",",$job_classid);
			foreach($classid as $value){
				$class[]="FIND_IN_SET(\'".$value."\',job_classid)";
			}
			$classid=@implode(" or ",$class);
			$where .= " AND ($classid)";
		}
		if($paramer[job_post]){
			$where .=" AND FIND_IN_SET(\'".$paramer[job_post]."\',job_classid)";
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
		if($paramer[\'cityin\']){
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
			$uptime = $time-($paramer[\'uptime\']*86400);
			$where.=" AND lastupdate > $uptime";
		}
		if($paramer[adtime]){
			$time=time();
			$adtime = $time-($paramer[adtime]*86400);
			$where.=" AND status_time>$adtime";
		}
		if($paramer[order] && $paramer[order]!="lastdate"){
			if($paramer[order]==\'ant_num\'){
				$order = " ORDER BY `ant_num`";
			}elseif($paramer[\'order\']==\'topdate\'){
				$nowtime=time();
				$order = " ORDER BY if(topdate>$nowtime,topdate,lastupdate)";
			}else{
				$order = " ORDER BY `".str_replace("\'","",$paramer[order])."`";
			}
		}else{
			$order = " ORDER BY lastupdate ";
		}
		$sort = $paramer[sort]?$paramer[sort]:\'DESC\';
		if($paramer[limit]){
			$limit=" LIMIT ".$paramer[limit];
		}
		$where.=$order.$sort;
		if($paramer[where]){
			$where = $paramer[where];
		}
		if($paramer[\'ispage\']){
			if($paramer["height_status"]){
				$limit = PageNav($paramer,$_GET,"resume_expect",$where,$Purl,"","3",$_smarty_tpl);
			}else{
				$limit = PageNav($paramer,$_GET,"resume_expect",$where,$Purl,"",\'0\',$_smarty_tpl);
			}
		}
		//用户列表
		' . $name . '=$db->select_all("resume_expect",$where.$limit,"*,uname as username");

		if(is_array(' . $name . ')){
			$cache_array = $db->cacheget();
			$userclass_name = $cache_array["user_classname"];
			$city_name      = $cache_array["city_name"];
			$job_name		= $cache_array["job_name"];
			$industry_name	= $cache_array["industry_name"];
			$my_down=array();
			if($_COOKIE[\'usertype\']==\'2\'&&$config[\'sy_usertype_1\']==\'1\'){
				$my_down=$db->select_all("down_resume","`comid`=\'".$_COOKIE[\'uid\']."\'","uid");
			}
			if($paramer[\'top\']){
				$uids=$m_name=array();
				foreach(' . $name . ' as $k=>$v){
					$uids[]=$v[\'uid\'];
				}

				$member=$db->select_all($db_config[\'def\']."member","`uid` in(".@implode(\',\',$uids).")","uid,username");

				foreach($member as $val){
					$m_name[$val[\'uid\']]=$val[\'username\'];
				}
			}
			foreach(' . $name . ' as $key=>$value){
				$uid[] = $value[\'uid\'];
				$eid[] = $value[\'id\'];
			}
			$eids = @implode(\',\',$eid);
			$uids = @implode(\',\',$uid);

			foreach(' . $name . ' as $k=>$v)
			{
				$time=time()-$v[\'lastupdate\'];
				if($time>86400 && $time<259300){
					' . $name . '[$k][\'time\'] = ceil($time/86400)."天前";
				}elseif($time>3600 && $time<86400){
					' . $name . '[$k][\'time\'] = ceil($time/3600)."小时前";
				}elseif($time>60 && $time<3600){
					' . $name . '[$k][\'time\'] = ceil($time/60)."分钟前";
				}elseif($time<60){
					' . $name . '[$k][\'time\'] = "刚刚";
				}else{
					' . $name . '[$k][\'time\'] = date("Y-m-d",$v[\'lastupdate\']);
				}
				if($v[\'photo\']==\'\'){
					' . $name . '[$k][\'photo\']=$v[\'photo\']=$config[\'sy_member_icon\'];
				}else{
					' . $name . '[$k][\'ispic\']=1;
				}
				if($config[\'sy_usertype_1\']==\'1\'&&$v[\'photo\']){
					if(!empty($my_down)){
						foreach($my_down as $m_k=>$m_v){
							$my_down_uid[]=$m_v[\'uid\'];
						}
						if(in_array($v[\'uid\'],$my_down_uid)==false){
							' . $name . '[$k][\'photo\']=\'./\'.$config[\'sy_member_icon\'];
						}
					}else{
						' . $name . '[$k][\'photo\']=\'./\'.$config[\'sy_member_icon\'];
					}
				}
				if($config["user_name"]==3)
				{
					' . $name . '[$k]["username_n"] = "NO.".$v["id"];
				}elseif($config["user_name"]==2){
					if($userclass_name[$v[\'sex\']]==\'男\'){
						' . $name . '[$k]["username_n"] = mb_substr($v["username"],0,1,\'GBK\')."先生";
					}else{
						' . $name . '[$k]["username_n"] = mb_substr($v["username"],0,1,\'GBK\')."女士";
					}
				}else{
					' . $name . '[$k]["username_n"] = $v["username"];
				}
				if($v[\'birthday\'])
				{
					$a=date(\'Y\',strtotime(' . $name . '[$k][\'birthday\']));
					' . $name . '[$k][\'age\']=date("Y")-$a;
				}else{
					' . $name . '[$k][\'age\']="保密";
				}
				' . $name . '[$k][\'sex_n\']=$userclass_name[$v[\'sex\']];
				' . $name . '[$k][\'edu_n\']=$userclass_name[$v[\'edu\']];
				' . $name . '[$k][\'exp_n\']=$userclass_name[$v[\'exp\']];
				' . $name . '[$k][\'job_city_one\']=$city_name[$v[\'provinceid\']];
				' . $name . '[$k][\'job_city_two\']=$city_name[$v[\'cityid\']];
				' . $name . '[$k][\'job_city_three\']=$city_name[$v[\'three_cityid\']];
				' . $name . '[$k][\'salary_n\']=$userclass_name[$v[\'salary\']];
				' . $name . '[$k][\'report_n\']=$userclass_name[$v[\'report\']];
				' . $name . '[$k][\'type_n\']=$userclass_name[$v[\'type\']];
				' . $name . '[$k][\'lastupdate\']=date("Y-m-d",$v[\'lastupdate\']);

				' . $name . '[$k][\'user_url\']=Url("resume",array("c"=>"show","id"=>$v[\'id\']),"1");
				' . $name . '[$k]["hy_info"]=$industry_name[$v[\'hy\']];
				if($paramer[\'top\']){
					' . $name . '[$k][\'m_name\']=$m_name[$v[\'uid\']];
					' . $name . '[$k][\'user_url\']=Url("ask",array("c"=>"friend","uid"=>$v[\'uid\']));
				}
				$job_classid=@explode(",",$v[\'job_classid\']);
				if(is_array($job_classid))
				{
					foreach($job_classid as $val)
					{
						$jobname[]=$job_name[$val];
					}
				}
				' . $name . '[$k][\'job_post\']=@implode(",",$jobname);
				if($paramer[\'post_len\'])
				{
					$postname[$k]=@implode(",",$jobname);
					' . $name . '[$k][\'job_post_n\']=mb_substr($postname[$k],0,$paramer[\'post_len\'],"GBK");
				}
				if($paramer[\'keyword\'])
				{
					' . $name . '[$k][\'username\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$v[\'username\']);
					' . $name . '[$k][\'job_post\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",' . $name . '[$k][\'job_post\']);
					' . $name . '[$k][\'job_post_n\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",' . $name . '[$k][\'job_post_n\']);
					' . $name . '[$k][\'job_city_one\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$city_name[$v[\'provinceid\']]);
					' . $name . '[$k][\'job_city_two\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$city_name[$v[\'cityid\']]);
				}
				$jobname=array();
			}
			if($paramer[\'keyword\']!=""&&!empty(' . $name . ')){
				addkeywords(\'5\',$paramer[\'keyword\']);
			}
		}';
        global $DiyTagOutputStr;
        $DiyTagOutputStr[] = $OutputStr;
        return SmartyOutputStr($this, $compiler, $_attr, 'userlist', $name, '', $name);
    }
}

class Smarty_Internal_Compile_Userlistelse extends Smarty_Internal_CompileBase
{
    public function compile($args, $compiler, $parameter)
    {
        $_attr = $this->getAttributes($compiler, $args);

        list($openTag, $nocache, $item, $key) = $this->closeTag($compiler, array('userlist'));
        $this->openTag($compiler, 'userlistelse', array('userlistelse', $nocache, $item, $key));

        return "<?php }\nif (!\$_smarty_tpl->tpl_vars[$item]->_loop) {\n?>";
    }
}

class Smarty_Internal_Compile_Userlistclose extends Smarty_Internal_CompileBase
{
    public function compile($args, $compiler, $parameter)
    {
        $_attr = $this->getAttributes($compiler, $args);
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }

        list($openTag, $compiler->nocache, $item, $key) = $this->closeTag($compiler, array('userlist', 'userlistelse'));

        return "<?php } ?>";
    }
}
