<?php
class Smarty_Internal_Compile_Joblist extends Smarty_Internal_CompileBase{
    public $required_attributes = array('item');
    public $optional_attributes = array('name', 'key', 'limit', 'comlen', 'namelen', 'urgent', 'ispage', 'rec', 'hy', 'job1', 'job1_son', 'job_post', 'jobids', 'pr', 'mun', 'provinceid', 'cityid', 'ltype', 'three_cityid', 'type', 'edu', 'exp', 'sex', 'salary', 'keyword', 'sdate', 'cert', 'sdate', 'uptime', 'order', 'orderby', 'uid', 'noid', 'jobwhere', 'bid', 'state','isshow','jobin','cityin','islt');
    public $shorttag_order = array('from', 'item', 'key', 'name');
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);
        $from = $_attr['from'];
        $item = $_attr['item'];
        $name = $_attr['item'];
        $name=str_replace('\'','',$name);
        $name=$name?$name:'List';$name='$'.$name;
        if (!strncmp("\$_smarty_tpl->tpl_vars[$item]", $from, strlen($item) + 24)) {
            $compiler->trigger_template_error("item variable {$item} may not be the same variable as at 'from'", $compiler->lex->taglineno);
        }

        $OutputStr='global $db,$db_config,$config;
		$time = time();
		
        eval(\'$paramer='.str_replace('\'','\\\'',ArrayToString($_attr,true)).';\');
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[\'arr\'];
        $Purl =  $ParamerArr[\'purl\'];
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
        if($config[sy_web_site]=="1"){
			if($config[cityid]>0 && $config[cityid]!=""){
				$paramer[cityid] = $config[cityid];
			}
			if($config[three_cityid]>0 && $config[three_cityid]!=""){
				$paramer[three_cityid] = $config[three_cityid];
			}
			if($config[\'hyclass\']>0 && $config[\'hyclass\']!=""){
				$paramer[hy]=$config[\'hyclass\'];
			}
		}
		if($paramer[\'sdate\']){
			$where = "`sdate`>".strtotime("-".intval($paramer[\'sdate\'])." day",time())." and `edate`>\'$time\' and `state`=1";
		}else{
			$where = "`edate`>\'$time\' and `state`=1";
		}
		if($paramer[\'uid\']){
			$where .= " AND `uid` = \'$paramer[uid]\'";
		}
		if($paramer[\'rec\']){
			$where.=" AND `rec_time`>".time();
		}
		if($paramer[\'cert\']){
			$company=$db->select_all("company","`yyzz_status`=1","`uid`");
			if(is_array($company)){
				foreach($company as $v){
					$job_uid[]=$v[\'uid\'];
				}
			}
			$where.=" and `uid` in (".@implode(",",$job_uid).")";
		}
		if($paramer[\'noid\']){
			$where.= " and `id`<>$paramer[noid]";
		}
		if($paramer[\'r_status\']){
			$where.= " and `r_status`=2";
		}else{
			$where.= " and `r_status`<>2";
		}
		if($paramer[status]){
			$where.= " and `status`=1";
		}else{
			$where.= " and `status`<>1";
		}
		if($paramer[\'pr\']){
			$where .= " AND `pr` =$paramer[pr]";
		}
		if($paramer[\'hy\']){
			$where .= " AND `hy` = $paramer[hy]";
		}
		if($paramer[\'mun\']){
			$where .= " AND `mun` = $paramer[mun]";
		}
		if($paramer[\'job1\']){
			$where .= " AND `job1` = $paramer[job1]";
		}
		if($paramer[\'job1_son\'])
		{
			$where .= " AND `job1_son` = $paramer[job1_son]";
		}
		if($paramer[\'job_post\'])
		{
			$where .= " AND (`job_post` IN ($paramer[job_post]))";
		}
		if($paramer[\'jobwhere\']){
			$where .=" and ".$paramer[\'jobwhere\'];
		}
		if($paramer[\'jobids\'])
		{
			$where.= " AND (`job1` = $paramer[jobids] OR `job1_son`=$paramer[jobids] OR `job_post`=$paramer[jobids])";
		}
		if($paramer[\'jobin\']){
			$where .= " AND (`job1` IN ($paramer[jobin]) OR `job1_son` IN ($paramer[jobin]) OR `job_post` IN ($paramer[jobin]))";
		}
		if($paramer[\'provinceid\']){
			$where .= " AND `provinceid` = $paramer[provinceid]";
		}
		if($paramer[\'cityid\']){
			$where .= " AND (`cityid` IN ($paramer[cityid]))";
		}
		if($paramer[\'three_cityid\']){
			$where .= " AND (`three_cityid` IN ($paramer[three_cityid]))";
		}
		if($paramer[\'cityin\']){
			$where .= " AND `three_cityid` IN ($paramer[cityin])";
		}
		if($paramer[\'edu\']){
			$where .= " AND `edu` = $paramer[edu]";
		}
		if($paramer[\'exp\']){
			$where .= " AND `exp` = $paramer[exp]";
		}
		if($paramer[\'type\']){
			$where .= " AND `type` = $paramer[type]";
		}
		if($paramer[\'sex\']){
			$where .= " AND `sex` = $paramer[sex]";
		}
		if($paramer[\'salary\']){
			$where .= " AND `salary` = $paramer[salary]";
		}
		if($paramer[\'cityin\']){
			$where .= " AND( AND `provinceid` IN ($paramer[cityin]) OR `cityid` IN ($paramer[cityin]) OR `three_cityid` IN ($paramer[cityin]))";
		}
		if($paramer[urgent]){
			$where.=" AND `urgent_time`>".time();
		}
		if($paramer[\'uptime\']){
			$uptime = $time-$paramer[uptime]*86400;
			$where.=" AND `lastupdate`>$uptime";
		}
		if($paramer[\'comname\']){
			$where.=" AND `com_name` LIKE \'%".$paramer[comname]."%\'";
		}
		if($paramer[\'com_pro\']){
			$where.=" AND `com_provinceid` =\'".$paramer[com_pro]."\'";
		}
		if($paramer[\'keyword\']){
			$where1[]="`name` LIKE \'%".$paramer[\'keyword\']."%\'";
			$where1[]="`com_name` LIKE \'%".$paramer[\'keyword\']."%\'";
			include PLUS_PATH."/city.cache.php";
			foreach($city_name as $k=>$v){
				if(strpos($v,$paramer[\'keyword\'])!==false){
					$cityid[]=$k;
				}
			}
			if(is_array($cityid)){
				foreach($cityid as $value){
					$class[]= "(provinceid = \'".$value."\' or cityid = \'".$value."\')";
				}
				$where1[]=@implode(" or ",$class);
			}
			$where.=" AND (".@implode(" or ",$where1).")";
		}
		if($paramer["job"]){
			$where.=" AND `job_post` in ($paramer[job])";
		}
		if($paramer[order] && $paramer[order]!="lastdate"){
			$order = " ORDER BY ".str_replace("\'","",$paramer[order])."  ";
		}else{
			$order = " ORDER BY `lastupdate` ";
		}
		if($paramer[\'sort\']){
			$sort = $paramer[sort];
		}else{
			$sort = " DESC";
		}
		if($paramer[\'orderby\']=="rec"){
			$nowtime=time();
			$where.=" ORDER BY if(rec_time>$nowtime,rec_time,lastupdate)  desc";
		}else{
			$where.=$order.$sort;
		}
		if($paramer[\'where\']){
			$where = $paramer[where];
		}
		if($paramer[\'limit\']){
			$limit = " limit ".$paramer[limit];
		}
		if($paramer[ispage]){
			$limit = PageNav($paramer,$_GET,"company_job",$where,$Purl,"",$paramer[limit]?$paramer[limit]:"6",$_smarty_tpl);
            $_smarty_tpl->tpl_vars["firmurl"]=new Smarty_Variable;
			$_smarty_tpl->tpl_vars["firmurl"]->value = $config[\'sy_weburl\']."/index.php?m=job".$ParamerArr[firmurl];
		}
		'.$name.' = $db->select_all("company_job",$where.$limit);
		if(is_array('.$name.')){
			$cache_array = $db->cacheget();
			$comuid=$jobid=array();
			foreach('.$name.' as $key=>$value){
				if(in_array($value[\'uid\'],$comuid)==false){$comuid[] = $value[\'uid\'];}
				if(in_array($value[\'id\'],$jobid)==false){$jobid[] = $value[\'id\'];} 
			}
			$comuids = @implode(\',\',$comuid);
			$jobids = @implode(\',\',$jobid);
			
			if($comuids){
				$r_uids=$db->select_all("company","`uid` IN (".$comuids.")","`uid`,`yyzz_status`");
				if(is_array($r_uids)){
					foreach($r_uids as $key=>$value){
						$r_uid[$value[\'uid\']] = $value[\'yyzz_status\'];
					}
				}
			}
			if(file_exists(PLUS_PATH."/comrating.cache.php"))
			include PLUS_PATH."/comrating.cache.php";
			foreach('.$name.' as $key=>$value){
				'.$name.'[$key] = $db->array_action($value,$cache_array);
				'.$name.'[$key][\'stime\'] = date("Y-m-d",$value[\'sdate\']);
				'.$name.'[$key][\'etime\'] = date("Y-m-d",$value[\'edate\']);
				'.$name.'[$key][\'lastupdate\'] = date("Y-m-d",$value[\'lastupdate\']);

				'.$name.'[$key][\'yyzz_status\'] = !empty($r_uid[$value[\'uid\']][\'yyzz_status\']) ? $r_uid[$value[\'uid\']][\'yyzz_status\'] : \'\' ;
				$time=time()-$value[\'lastupdate\'];

				if($time>86400 && $time<604800){
					'.$name.'[$key][\'time\'] = ceil($time/86400)."天前";
				}elseif($time>3600 && $time<86400){
					'.$name.'[$key][\'time\'] = ceil($time/3600)."小时前";
				}elseif($time>60 && $time<3600){
					'.$name.'[$key][\'time\'] = ceil($time/60)."分钟前";
				}elseif($time<60){
					'.$name.'[$key][\'time\'] = "刚刚";
				}else{
					'.$name.'[$key][\'time\'] = date("Y-m-d",$value[\'lastupdate\']);
				}
				if(is_array('.$name.'[$key][\'welfare\'])&&'.$name.'[$key][\'welfare\']){
					foreach('.$name.'[$key][\'welfare\'] as $val){
						'.$name.'[$key][\'welfarename\'][]=$cache_array[\'comclass_name\'][$val];
					}

				}
				if($paramer[\'comlen\']){
					'.$name.'[$key][\'com_n\'] = mb_substr($value[\'com_name\'],0,$paramer[\'comlen\'],"GBK");
				}
				if($paramer[\'namelen\']){
					if($value[\'rec_time\']>time()){
						'.$name.'[$key][\'name_n\'] = "<font color=\'red\'>".mb_substr($value[\'name\'],0,$paramer[namelen],"GBK")."</font>";
					}else{
						'.$name.'[$key][\'name_n\'] = mb_substr($value[\'name\'],0,$paramer[namelen],"GBK");
					}
				}else{
					if($value[\'rec_time\']>time()){
						'.$name.'[$key][\'name_n\'] = "<font color=\'red\'>".$value[\'name\']."</font>";
					}
				}
				'.$name.'[$key][\'job_url\'] = Url("job",array("c"=>"comapply","id"=>$value[id]),"1");
				'.$name.'[$key][\'com_url\'] = Url("company",array("c"=>"show","id"=>$value[\'uid\']));
				if(is_array($comrat) && !empty($comrat))
				foreach($comrat as $k=>$v){
					if($value[\'rating\']==$v[id]){
						'.$name.'[$key][\'color\'] = str_replace("#","",$v[com_color]);
						'.$name.'[$key][\'ratlogo\'] = $v[\'com_pic\'];
						'.$name.'[$key][\'ratname\'] = $v[\'name\'];
					}
				}
				if($paramer[\'keyword\']){
					'.$name.'[$key][\'name\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$value[name]);
					'.$name.'[$key][\'com_name\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$value[com_name]);
					'.$name.'[$key][\'name_n\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",'.$name.'[$key][\'name_n\']);
					'.$name.'[$key][\'com_n\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",'.$name.'[$key][com_n]);
					'.$name.'[$key][\'job_city_one\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$city_name[$value[provinceid]]);
					'.$name.'[$key][\'job_city_two\']=str_replace($paramer[\'keyword\'],"<font color=#FF6600 >".$paramer[\'keyword\']."</font>",$city_name[$value[cityid]]);
				}
			}
			if(is_array('.$name.')){
				if($paramer[\'keyword\']!=""&&!empty('.$name.')){
					addkeywords(\'3\',$paramer[\'keyword\']);
				}
			}
		}';
        global $DiyTagOutputStr;
        $DiyTagOutputStr[]=$OutputStr;
        return SmartyOutputStr($this,$compiler,$_attr,'joblist',$name,'',$name);
    }
}
class Smarty_Internal_Compile_Joblistelse extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);

        list($openTag, $nocache, $item, $key) = $this->closeTag($compiler, array('joblist'));
        $this->openTag($compiler, 'joblistelse', array('joblistelse', $nocache, $item, $key));

        return "<?php }\nif (!\$_smarty_tpl->tpl_vars[$item]->_loop) {\n?>";
    }
}
class Smarty_Internal_Compile_Joblistclose extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }

        list($openTag, $compiler->nocache, $item, $key) = $this->closeTag($compiler, array('joblist', 'joblistelse'));

        return "<?php } ?>";
    }
}
