<?php
/*
 * Created on 2012
 * Link for shyflc@qq.com
 * This System Powered by PHPYUN.com
 */
class special_controller extends common
{
	function index_action(){
		$urlarr['page']="{{page}}";
		$pageurl=Url($_GET['m'],$urlarr,'admin');
		$rows=$this->get_page("special","1",$pageurl,$this->config['sy_listnum']);
		$this->yunset($rows);
		$this->yuntpl(array('admin/admin_special'));
	}

	function add_action(){
		if($_GET['id']){
			$row=$this->obj->DB_select_once("special","`id`='".$_GET['id']."'");
			$row['rating']=@explode(',',$row['rating']);
			$this->yunset("row",$row);
		}
		$qy_rows=$this->obj->DB_select_all("company_rating","`category`=1 order by sort desc");
		$this->yunset("qy_rows",$qy_rows);
		$publicdir = "../app/template/".$this->config['style']."/special/";
		$filesnames = @scandir($publicdir);
		if(is_array($filesnames)){
			foreach($filesnames as $key=>$value){
				if($value!='.' && $value!='..' ){
					 $typearr = explode('.',$hostdir.$value);
					 if(in_array(end($typearr),array('htm'))) {
						 if($value!="index.htm"){
						   	$file[] =$value;
						 }
					 }
				 }

			}
		}
		$this->yunset("file",$file);
		$this->yuntpl(array('admin/admin_special_add'));
	}
	function save_action()
	{
		if($_POST['save'])
		{
			$id=$_POST['id'];
			unset($_POST['save']);
			unset($_POST['id']);
			$_POST['sort']=(int)$_POST['sort'];
			$_POST['etime']=strtotime($_POST['etime']);
			$_POST['ctime']=mktime();
			$_POST['rating']=implode(',',$_POST['rating']);
			foreach($_POST as $key=>$value){
				if($value==''){
					$_POST[$key] = 0;
				}
			}
			if(!$id){

				$nid=$this->obj->insert_into("special",$_POST);
				$name="专题招聘（ID：".$nid."）添加";
			}else{
				if($_POST['pic']!=$_POST['ypic']&&$_POST['ypic']&&$_POST['pic']){
					@unlink('../'.$_POST['ypic']);
				}
				if(!$_POST['pic']){
					unset($_POST['pic']);
				}
				unset($_POST['ypic']);
				$where['id']=$id;

				$nid=$this->obj->update_once("special",$_POST,$where);
				$name="专题招聘（ID：".$id."）更新";
			}
		}
		$nid?$this->ACT_layer_msg($name."成功！",9,"index.php?m=special",2,1):$this->ACT_layer_msg($name."失败！",8,"index.php?m=special");
	}
	function com_action(){
		$_GET['id']=(int)$_GET['id'];
		$urlarr['c']=$_GET['c'];
		$urlarr['id']=$_GET['id'];
		$urlarr['page']="{{page}}";
		$pageurl=Url($_GET['m'],$urlarr,'admin');
		$rows=$this->get_page("special_com","`sid`='".$_GET['id']."'",$pageurl,$this->config['sy_listnum']);
		if($rows&&is_array($rows)){
			$uid=array();
			foreach($rows as $val){
				$uid[]=$val['uid'];
			}
			$company=$this->obj->DB_select_all("company","`uid` in(".pylode(',',$uid).")","uid,name");
			foreach($rows as $key=>$val){
				foreach($company as $v){
					if($val['uid']==$v['uid']){
						$rows[$key]['name']=$v['name'];
					}
				}
			}
		}
		$this->yunset("rows",$rows);
		$this->yuntpl(array('admin/admin_special_com'));
	}
	function statuscom_action(){
		$pid=$_POST['pid'];
		$status=(int)$_POST['status'];
		if($status=='2'){
			$rows=$this->obj->DB_select_all("special_com","`id` IN ($pid) and `status`<>'2'","`uid`,`integral`");
		}
		$id=$this->obj->DB_update_all("special_com","`status`='$status'","`id` IN ($pid) and `status`<>'2'");
		if($id&&count($rows)){
			foreach($rows as $val){
				if($val['integral']>0){
					$this->company_invtal($val['uid'],$val['integral'],true,"专题招聘未通过审核，退还".$this->config['integral_pricename'],true,2,'integral');
				}
			}
		}
		$id?$this->ACT_layer_msg("操作成功！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("操作失败！",8,$_SERVER['HTTP_REFERER']);
	}
	function delcom_action(){
		$this->check_token();
	    if($_GET['del']||$_GET['id']){
    		if(is_array($_GET['del'])){
    			$layer_type=1;
				$del=@implode(',',$_GET['del']);
	    	}else{
	    		$layer_type=0;
	    		$del=$_GET['id'];
	    	}
			$this->obj->DB_delete_all("special_com","`id` in (".$del.")","");
			$this->layer_msg("公司申请(ID:".$del.")删除成功！",9,$layer_type,$_SERVER['HTTP_REFERER']);
    	}else{
			$this->layer_msg("请选择您要删除的信息！",8,1);
    	}
	}
	function del_action(){
		$_GET['id']=(int)$_GET['id'];
		if($_GET['id']){
			$this->check_token();
			$nid=$this->obj->DB_delete_all("special","`id`='".$_GET['id']."'");
			$nid?$this->layer_msg('专题招聘（ID：'.$_GET['id'].'）删除成功！',9):$this->layer_msg('删除失败！',8);
		}
	}
}
?>