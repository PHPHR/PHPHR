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
class company_controller extends common{
	function index_action(){
		$this->rightinfo();
		$this->get_moblie(); 
        $CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('city','hy','com'));
		$this->yunset($CacheList);
		if($_GET['three_cityid']){ 
			$this->yunset("cityname",$CacheList['city_name'][$_GET['three_cityid']]);
		}
        foreach($_GET as $k=>$v){
			if($k!=""){
				$searchurl[]=$k."=".$v;
			}
		}
		$this->seo("firm");
		$searchurl=@implode("&",$searchurl);
		$this->yunset("searchurl",$searchurl);
		$this->yunset("headertitle","公司搜索");
		$this->yuntpl(array('wap/company'));
	}
	function show_action(){
		$this->rightinfo();
		$this->get_moblie(); 
        $UserinfoM=$this->MODEL('userinfo');
        $CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('job','com','city','hy'));
		$this->yunset($CacheList);
		$row=$UserinfoM->GetUserinfoOne(array('uid'=>(int)$_GET['id']),array('usertype'=>2));
		$row['lastupdate']=date("Y-m-d",$row['lastupdate']);
		$this->yunset("row",$row);
		$data['company_name']=$row['name'];
		$data['company_name_desc']=$row['content'];
		$this->data=$data;
		$this->seo("company_index");
		$this->yunset("headertitle","公司详情");
		$this->yuntpl(array('wap/company_show'));
	}
}
?>