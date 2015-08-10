<?php
class Smarty_Internal_Compile_Qlist extends Smarty_Internal_CompileBase{
    public $required_attributes = array('item');
    public $optional_attributes = array('name', 'key', 'ispage', 't_len', 'order', 'limit', 'cid', 'recom','hot','uid','keyword','noid','friend');
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
        
        $OutputStr='global $db,$db_config,$config;eval(\'$paramer='.str_replace('\'','\\\'',ArrayToString($_attr,true)).';\');'.$name.'=array();
		$ParamerArr = GetSmarty($paramer,$_GET,$_smarty_tpl);
		$paramer = $ParamerArr[arr];
		$Purl =  $ParamerArr[purl];
        global $ModuleName;
        if(!$Purl["m"]){
            $Purl["m"]=$ModuleName;
        }
		
		$where=1;
		
		if($_COOKIE[\'uid\']&&$paramer[\'friend\']){
			$atn=$db->select_all("atn","`uid`=\'".$_COOKIE[\'uid\']."\'","`sc_uid`");
			$friend=array();
			foreach($atn as $val){
				$friend[]=$val[\'sc_uid\'];
			}
			$where.=" and `id` in(".@implode(\',\',$friend).")";
			unset($friend);
		} 
		if($paramer[hot]){
			$time=strtotime("-".(int)$paramer[hot]." day");
			$where.=" and `add_time`>\'".$time."\'";
		}
		if($paramer[noid]){
			$where.=" and `id`<>\'".$paramer[noid]."\'";
		}
		if($paramer[keyword]){
			$where.=" and `title` like \'%".$paramer[\'keyword\']."%\'";
		}
		//排序字段默认为更新时间
		if($paramer[order]){ 
			if($paramer[order]=="addtime"){
				$paramer[order]="add_time";
			}
			if($paramer[order]=="answernum"){
				$paramer[order]="answer_num";
			}
			$order = " ORDER BY `".$paramer[order]."`  desc";
		}else{
			$order = " ORDER BY `add_time` desc";
		}
		if($paramer[cid]){
			$where .=" and `cid`=\'".$paramer[cid]."\'";
		}
		if($paramer[uid]){
			$where .=" and `uid`=\'".$paramer[uid]."\'";
		}
		if($paramer[recom]){//推荐 字段
			$where .=" and `is_recom`=\'1\'";
		}
		if($paramer[limit]){
			$limit=" limit ".$paramer[limit];
		}
		if($paramer[ispage]){
			$limit = PageNav($paramer,$_GET,"question",$where,$Purl,"","2",$_smarty_tpl);
		}
		'.$name.' = $db->select_all("question",$where.$order.$limit);  
		if(count('.$name.')){
			foreach('.$name.' as $key=>$val){
				if(intval($paramer[t_len])>0){
					$len = intval($paramer[t_len]);
					$val[title] = mb_substr($val[title],0,$len,"GBK");
				}
				'.$name.'[$key][url] = Url("ask",array("c"=>"content","id"=>$val[id]));
				'.$name.'[$key][userurl] = Url("ask",array("c"=>"friend","uid"=>$val[uid]));
				if(in_array($val[uid],$ListId)==false){$ListId[] =  $val[uid];} 
				$Qclass[]=$val[cid];//问题类别
			}
			//获得提问者uid，并根据uid 获得头像、昵称
			$uids=@implode(",",$ListId);
			$friend_info=$db->select_all("friend_info","`uid` in (".$uids.")","`uid`,`nickname`,`pic`,`description`");
			  
			foreach('.$name.' as $r_k=>$r_v){
				foreach($friend_info as $f_v){
					if($r_v[\'uid\']==$f_v[\'uid\']){
						if($f_v[\'pic\']){
							'.$name.'[$r_k][\'pic\']=str_replace("..",$config["sy_weburl"],$f_v[\'pic\']);
						}else{
							'.$name.'[$r_k][\'pic\']=$config["sy_weburl"]."/".$config[\'sy_friend_icon\'];
						}
						'.$name.'[$r_k][\'uid\']=$f_v[\'uid\'];
						'.$name.'[$r_k][\'nickname\']=$f_v[\'nickname\'];
						'.$name.'[$r_k][\'description\']=$f_v[\'description\'];
					}
				}
				if($r_v[\'uid\']==$_COOKIE[\'uid\']){
					'.$name.'[$r_k][\'isatn\']=\'2\';//表示这是本人，不显示关注按钮
				} 
			}	
		}';
        //自定义标签 END
        global $DiyTagOutputStr;
        $DiyTagOutputStr[]=$OutputStr;
        return SmartyOutputStr($this,$compiler,$_attr,'qlist',$name,'',$name);
    }
}
class Smarty_Internal_Compile_Qlistelse extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);

        list($openTag, $nocache, $item, $key) = $this->closeTag($compiler, array('qlist'));
        $this->openTag($compiler, 'qlistelse', array('qlistelse', $nocache, $item, $key));

        return "<?php }\nif (!\$_smarty_tpl->tpl_vars[$item]->_loop) {\n?>";
    }
}
class Smarty_Internal_Compile_Qlistclose extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }

        list($openTag, $compiler->nocache, $item, $key) = $this->closeTag($compiler, array('qlist', 'qlistelse'));

        return "<?php } ?>";
    }
}
