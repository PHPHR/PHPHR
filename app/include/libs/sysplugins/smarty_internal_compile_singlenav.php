<?php
class Smarty_Internal_Compile_Singlenav extends Smarty_Internal_CompileBase{
    public $required_attributes = array('from', 'item');
    public $optional_attributes = array('name', 'key');
    public $shorttag_order = array('from', 'item', 'key', 'name');
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);

        $from = $_attr['from'];
        $item = $_attr['item'];
        if (!strncmp("\$_smarty_tpl->tpl_vars[$item]", $from, strlen($item) + 24)) {
            $compiler->trigger_template_error("item variable {$item} may not be the same variable as at 'from'", $compiler->lex->taglineno);
        }
        
        $OutputStr='global $db,$db_config,$config;$List=array();
		$Query = $db->query("SELECT * FROM $db_config[def]description where is_nav=\'1\' order by sort asc");
		while($rs = $db->fetch_array($Query)){
			$rs[\'url\']=$config[\'sy_weburl\']."/".$rs[\'url\'];
			$List[] =  $rs;
		}';

        return SmartyOutputStr($this,$compiler,$_attr,'singlenav','$List',$OutputStr,'$List');
    }
}
class Smarty_Internal_Compile_Singlenavelse extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);

        list($openTag, $nocache, $item, $key) = $this->closeTag($compiler, array('foreach'));
        $this->openTag($compiler, 'foreachelse', array('foreachelse', $nocache, $item, $key));

        return "<?php }\nif (!\$_smarty_tpl->tpl_vars[$item]->_loop) {\n?>";
    }
}
class Smarty_Internal_Compile_Singlenavclose extends Smarty_Internal_CompileBase{
    public function compile($args, $compiler, $parameter){
        $_attr = $this->getAttributes($compiler, $args);
        if ($compiler->nocache) {
            $compiler->tag_nocache = true;
        }

        list($openTag, $compiler->nocache, $item, $key) = $this->closeTag($compiler, array('foreach', 'foreachelse'));

        return "<?php } ?>";
    }
}
