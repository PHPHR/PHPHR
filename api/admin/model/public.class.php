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
class public_controller extends appadmin{
	function config_action(){//获取网站配置
		if(is_array($this->config)){
			foreach($this->config as $va=>$k){
				$rows[$va]=iconv("gbk","UTF-8",$k);
				//ios App更新地址
				$rows['sy_iosMemberUpdateUrl']='http://www.phpyun.com/';
				$rows['sy_iosCompanyUpdateUrl']='http://www.phpyun.com/';
				$rows['sy_iosAdminUpdateUrl']='http://www.phpyun.com/';
			}
		}
		$data[data]=$rows;
		echo json_encode($data);die;
	}
	function city_action(){//获取城市
		include(PLUS_PATH."city.cache.php");
		$data[city_index]=$city_index;
		$data[city_type]=$city_type;
		if(is_array($city_name)){
			foreach($city_name as $va=>$k){
				$rows[$va]=iconv("gbk","UTF-8",$k);
			}
		}
		$data[city_name]=$rows;
		echo json_encode($data);die;
	}
	function job_action(){//获取职位类别
		include_once(PLUS_PATH."job.cache.php");
		$data[job_index]=$job_index;
		$data[job_type]=$job_type;
		if(is_array($job_name)){
			foreach($job_name as $va=>$k){
				$rows[$va]=iconv("gbk","UTF-8",$k);
			}
		}
		$data[job_name]=$rows;
		echo json_encode($data);die;
	}
	function industry_action(){//获取行业类别
		include_once(PLUS_PATH."industry.cache.php");
		$data[industry_index]=$industry_index;
		if(is_array($industry_name)){
			foreach($industry_name as $va=>$k){
				$rows[$va]=iconv("gbk","UTF-8",$k);
			}
		}
		$data[industry_name]=$rows;
		echo json_encode($data);die;
	}
	function advert_action(){//获取广告
		if($_GET['type']=='1'){//IOS个人版			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[44];
		}else if($_GET['type']=='2'){//IOS企业版		
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[45];
		}else if($_GET['type']=='3'){//Android			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[44];
		}else if($_GET['type']=='4'){//Android			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[44];
		}else{
			echo json_encode(array('list'=>array()));die;
		}
		$i=0;
		if(is_array($list)){
			foreach($list as $key=>$val){
				$data['list'][$i]['pic']=$val['pic'];
				$i++;
			}
		}
		echo json_encode($data);die;
	}
	function guideImage_action(){//获取广告
		//$_GET['width']、$_GET['height']
		if($_GET['type']=='1'){//IOS个人版引导			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[44];
		}else if($_GET['type']=='2'){//IOS个人版新手帮助			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[45];
		}else if($_GET['type']=='3'){//IOS企业版引导			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[44];
		}else if($_GET['type']=='4'){//IOS企业版新手帮助		
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[45];
		}else{
			echo json_encode(array('list'=>array()));die;
		}
		$i=0;
		if(is_array($list)){
			foreach($list as $key=>$val){
				$data['list'][$i]['pic']=$val['pic'];
				$i++;
			}
		}
		echo json_encode($data);die;
	}	
	function faqlist_action(){//获取广告
		if($_GET['type']=='1'){//IOS个人版		
			$where="1";
			$nid=17;
			$sdate=$_POST['sdate'];
			$edate=$_POST['edate'];
			$keyword=$_POST['keyword'];
			$describe=$_POST['describe'];
			$page=$_POST['page'];
			$limit=$_POST['limit'];
			$order=$_POST['order'];
			$nodata=$_POST['nodata'];
			$limit=!$limit?10:$limit;
			if($nid){//类别ID
				$where.=" and `nid`='".$nid."'";
			}
			if($sdate){//开始时间
				$where.=" and `datetime`>'".strtotime($sdate)."'";
			}
			if($edate){//结束时间
				$where.=" and `datetime`<'".strtotime($edate)."'";
			}
			if($describe){//类型
				$where.=" and `describe`='".$describe."'";
			}
			if($keyword){//关键字
				$where.=" and `title` like '%".$keyword."%'";
			}
			if($nodata){//排除没有值的字段
				$nodataarr=explode(",",$nodata);
				foreach($nodataarr as $v){
					$where.=" and ".$v."<>''";
				}
			}
			if($order){//排序
				$where.=" order by ".$order;
			}else{
				$where.=" order by id desc";
			}
			if($page){//分页
				$pagenav=($page-1)*$limit;
				$where.=" limit $pagenav,$limit";
			}else{
				$where.=" limit $limit";
			}
			$rows=$this->obj->DB_select_all("news_base",$where);
			if(is_array($rows)){
				foreach($rows as $va){$nid_arr[]=$va['nid'];}
				$rows_group=$this->obj->DB_select_all("news_group","id in (".pylode(',',$nid_arr).")");
				foreach($rows_group as $v){$nid_row[$v['id']]=$v['name'];}
				foreach($rows as $key=>$va){
					$list[$key]['id']		=$va['id'];
					$list[$key]['title']	=iconv("gbk","UTF-8",$va['title']);
					$list[$key]['nid']		=$va['nid'];
					$list[$key]['nidname']	=iconv("gbk","UTF-8",$nid_row[$va['nid']]);
					$list[$key]['keyword']	=iconv("gbk","UTF-8",$va['keyword']);
					$list[$key]['author']	=iconv("gbk","UTF-8",$nid_row[$va['author']]);
					$list[$key]['datetime']	=$va['datetime'];
					$list[$key]['hits']		=$va['hits'];
					$list[$key]['describe']	=iconv("gbk","UTF-8",$va['describe']);
					$list[$key]['description']=iconv("gbk","UTF-8",$va['description']);
					$list[$key]['newsphoto']=iconv("gbk","UTF-8",$nid_row[$va['newsphoto']]);
					$list[$key]['s_thumb']	=iconv("gbk","UTF-8",$nid_row[$va['s_thumb']]);
					$list[$key]['source']	=iconv("gbk","UTF-8",$nid_row[$va['source']]);
				}
				foreach($list as $k=>$v){
					if(is_array($v)){
						foreach($v as $key=>$val){
							$list[$k][$key]=isset($val)?$val:'';
						}
					}else{
						$list[$k]=isset($v)?$v:'';
					}
				}
				$data['list']=count($list)?$list:array();
				$data['error']=1;
			}else{
				$data['error']=2;
			}
			echo json_encode($data);die;
		}else if($_GET['type']=='2'){//IOS企业版			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[45];
		}else if($_GET['type']=='3'){//IOS企业版引导			
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[44];
		}else if($_GET['type']=='4'){//IOS企业版新手帮助		
			include_once(PLUS_PATH."pimg_cache.php");
			$list=$ad_label[45];
		}else{
			echo json_encode(array('list'=>array()));die;
		}
		$i=0;
		if(is_array($list)){
			foreach($list as $key=>$val){
				$data['list'][$i]['pic']=$val['pic'];
				$i++;
			}
		}
		echo json_encode($data);die;
	}
	function user_action(){//获取个人类别
		include_once(PLUS_PATH."user.cache.php");
		$data[userdata]=$userdata;
		if(is_array($userclass_name)){
			foreach($userclass_name as $va=>$k){
				$rows[$va]=iconv("gbk","UTF-8",$k);
			}
		}
		$data[userclass_name]=$rows;
		echo json_encode($data);die;
	}
	function com_action(){//获取企业类别
		include_once(PLUS_PATH."com.cache.php");
		$data[comdata]=$comdata;
		if(is_array($comclass_name)){
			foreach($comclass_name as $va=>$k){
				$rows[$va]=iconv("gbk","UTF-8",$k);
			}
		}
		$data[comclass_name]=$rows;
		echo json_encode($data);die;
	}
	
	

}
?>