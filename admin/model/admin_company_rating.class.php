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
class admin_company_rating_controller extends common
{
	function index_action()
	{
		$list=$this->obj->DB_select_all("company_rating","`category`='1'");
		$this->yunset("list",$list);
		$this->yuntpl(array('admin/admin_company_rating'));
	}
	function rating_action()
	{
		if($_GET['id'])
		{
			$row=$this->obj->DB_select_once("company_rating","`id`='".$_GET['id']."'");
			$this->yunset("row",$row);
		}
		$this->yuntpl(array('admin/admin_comclass_add'));
	}
	function saveclass_action()
	{
		if($_POST['useradd'])
		{
			$id=$_POST['id'];
			unset($_POST['useradd']);
			unset($_POST['id']);
			if(is_uploaded_file($_FILES['com_pic']['tmp_name'])){
				$upload=$this->upload_pic("../data/upload/compic/");
				$pictures=$upload->picture($_FILES['com_pic']);
				$pic = str_replace("../data/upload","/data/upload",$pictures);
			}
			foreach($_POST as $key=>$value)
			{
				if($value=='')
				{
					$_POST[$key] = 0;
				}
			}
			if(!$id){
				$_POST['com_pic']=$pic;
				$nid=$this->obj->insert_into("company_rating",$_POST);
				$name="企业会员等级（ID：".$nid."）添加";
			}else{
				if($pic!=""){$_POST['com_pic']=$pic;};
				$where['id']=$id;
				$nid=$this->obj->update_once("company_rating",$_POST,$where);
				$name="企业会员等级（ID：".$id."）更新";
			}
		}
		$this->cache_rating();
		$nid?$this->ACT_layer_msg($name."成功！",9,"index.php?m=admin_company_rating",2,1):$this->ACT_layer_msg($name."失败！",8,"index.php?m=admin_company_rating");
	}
	function del_action(){
		if($_POST['del']){
			$layer_type='1';
			$id=pylode(',',$_POST['del']);
		}else if($_GET['id']){
			$this->check_token();
			$id=$_GET['id'];
			$layer_type='0';
		}
		$nid=$this->obj->DB_delete_all("company_rating","`id` in(".$id.")","");
		$this->cache_rating();
		$nid?$this->layer_msg('企业会员等级（ID：(ID:'.$id.')成功！',9,$layer_type,$_SERVER['HTTP_REFERER']):$this->layer_msg('删除失败！',8,$layer_type,$_SERVER['HTTP_REFERER']);
	}
	function delpic_action(){
		if($_GET['id']){
			$this->check_token();
			$row=$this->obj->DB_select_once("company_rating","`id`='".$_GET['id']."'","`com_pic`");
			@unlink("..".$row['com_pic']);
			$this->obj->DB_update_all("company_rating","`com_pic`=''","`id`='".$_GET['id']."'");
			$this->cache_rating();
			$this->layer_msg('企业会员等级（ID：(ID:'.$_GET['id'].')图标删除成功！',9,0,$_SERVER['HTTP_REFERER']);
		}
	}
	function cache_rating(){
		include(LIB_PATH."cache.class.php");
		$cacheclass= new cache(PLUS_PATH,$this->obj);
		$makecache=$cacheclass->comrating_cache("comrating.cache.php");
	}
}

?>