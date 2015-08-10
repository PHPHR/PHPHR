<?php
class Smarty_Internal_Compile_specialcom extends Smarty_Internal_CompileBase{
    public $required_attributes = array('item');
    public $optional_attributes = array('title', 'key', 'sid', 'ispage', 'limit','status','namelen','jobnamelen');
    public $shorttag_order = array('from', 'item', 'key', 'name');
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);

        $from = $_attr['from'];
        $item = $_attr['item'];
        $name = $_attr['item'];
        $name=str_replace('\'','',$name);
        $name=$name?$name:'list';$name='$'.$name;
        if (!strncmp("\$_smarty_tpl->tpl_vars[$item]", $from, strlen($item) + 24)) {
            $compiler->trigger_template_error("item variable {$item} may not be the same variable as at 'from'", $compiler->lex->taglineno);
        }        
        //自定义标签 START
        $OutputStr='global $db,$db_config,$config;eval(\'$paramer='.str_replace('\'','\\\'',ArrayToString($_attr,true)).';\');'.$name.'=array();
		//处理传入参数，并且构造分页参数
		$ParamerArr = GetSmarty($paramer,$_GET);
		$paramer = $ParamerArr[arr];
		$Purl =  $ParamerArr[purl];
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
		$paramer[\'sid\']=(int)$paramer[\'sid\'];
		$where = "`status`=\'1\' and `sid`=\'".$paramer[\'sid\']."\'";
		//排序字段默认为更新时间
		if($paramer[\'order\']){
			$order = " ORDER BY `".str_replace("\'","",$paramer[order])."`";
		}else{
			$order = " ORDER BY id ";
		}
		//排序规则 默认为倒序
		if($paramer[\'sort\']){
			$sort = $paramer[\'sort\'];
		}else{
			$sort = " asc";
		}
		//查询条数
		if($paramer[limit]){
			$limit=" LIMIT ".$paramer[limit];
		}
		//自定义查询条件，默认取代上面任何参数直接使用该语句
		if($paramer[where]){
			$where = $paramer[where];
		}
		if($paramer[ispage]){
			$limit = PageNav($paramer,$_GET,"special_com",$where,$Purl,\'\',\'0\',$_smarty_tpl);
		}
		$where.=$order.$sort.$limit;
		'.$name.'=$db->select_all("special_com",$where);
		$time=time();		
		if(is_array('.$name.')&&'.$name.'){
			include(PLUS_PATH."/com.cache.php");
			include(PLUS_PATH."/city.cache.php");
			include(PLUS_PATH."/industry.cache.php");
			$uid=$jobinfo=array();
			foreach('.$name.' as $val){
				$uid[]=$val[\'uid\'];
			}
			$company=$db->select_all("company","`uid` in(".@implode(\',\',$uid).")","`uid`,`name`,`logo`,`provinceid`,`cityid`,`hy`,`pr`,`mun`,`content`");
			$job=$db->select_all("company_job","`uid` in(".@implode(\',\',$uid).") and `edate`>\'$time\' and `sdate`<\'$time\' and `state`=1 order by `lastupdate` desc","`uid`,`name`,`id`,`salary`");
			if($job&&is_array($job)){ 
				foreach($job as $k=>$v){
					$v[salary]=$comclass_name[$v[\'salary\']];
					if($paramer[jobnamelen]){
						$v[name_n] = mb_substr($v[\'name\'],0,$paramer[jobnamelen],"GBK");
					}
					$v[\'joburl\']=Url("job",array("c"=>"comapply","id"=>$v[id]));
					$jobinfo[$v[\'uid\']][]=$v;
				}
			} 
			foreach('.$name.' as $key=>$value){
				foreach($company as $val){
					if($value[\'uid\']==$val[\'uid\']){
						if($val[\'logo\']==\'\'){$val[\'logo\']=$config[\'sy_unit_icon\'];}
						if($paramer[namelen]){
							'.$name.'[$key][name_n] = mb_substr($val[\'name\'],0,$paramer[namelen],"GBK");
						}
						'.$name.'[$key][\'content\']=mb_substr(strip_tags($val[\'content\']),0,50,"GBK");
						'.$name.'[$key][\'provinceid\']=$city_name[$val[\'provinceid\']];
						'.$name.'[$key][\'cityid\']=$city_name[$val[\'cityid\']];
						'.$name.'[$key][\'hy\']=$val[\'hy\'];
						'.$name.'[$key][\'hyname\']=$industry_name[$val[\'hy\']];
						'.$name.'[$key][\'pr\']=$comclass_name[$val[\'pr\']];
						'.$name.'[$key][\'mun\']=$comclass_name[$val[\'mun\']];
						'.$name.'[$key][\'name\']=$val[\'name\'];
						'.$name.'[$key][\'logo\']=$val[\'logo\'];
						'.$name.'[$key][\'comurl\']=Url("company",array("c"=>"show","id"=>$val[uid]));
					}
				}
				'.$name.'[$key][\'jobnum\']=count($jobinfo[$value[\'uid\']]);				
				'.$name.'[$key][\'jobs\']=$jobinfo[$value[\'uid\']];				
			} 
		}';
        //自定义标签 END
        global $DiyTagOutputStr;
        $DiyTagOutputStr[]=$OutputStr;
        return SmartyOutputStr($this,$compiler,$_attr,'specialcom',$name,'',$name);
    }
}
class Smarty_Internal_Compile_specialcomelse extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);

        list($openTag, $nocache, $item, $key) = $this->closeTag($compiler, array('specialcom'));
        $this->openTag($compiler, 'specialcomelse', array('specialcomelse', $nocache, $item, $key));

        return "<?php }\nif (!\$_smarty_tpl->tpl_vars[$item]->_loop) {\n?>";
    }
}
class Smarty_Internal_Compile_specialcomclose extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }

        list($openTag, $compiler->nocache, $item, $key) = $this->closeTag($compiler, array('specialcom', 'specialcomelse'));

        return "<?php } ?>";
    }
}
