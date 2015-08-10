<?php
/* *
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
*/
class order_controller extends appadmin
{
	function list_action()//高级人才列表
	{
		$where="1";
		$page=$_POST['page'];
		$limit=$_POST['limit'];
		$order=$_POST['order'];
		$keyword=$this->stringfilter($_POST['keyword']);
		if($keyword)//关键字
		{
			$where.=" and (`order_id` LIKE '%".$keyword."%' or `order_remark` LIKE '%".$keyword."%')";
		}
		if($_POST['status'])
		{
			if($_POST['status']=="4")
			{
				$where.=" and `order_state`='0'";
			}else{
				$where.=" and `order_state` in('".(int)$_POST['status']."')";
			}
	    }
		if($order){//排序
			$where.=" order by ".$order;
		}else{
			$where.=" order by id desc";
		}
		$limit=!$limit?10:$limit;
		if($page){//分页
			$pagenav=($page-1)*$limit;
			$where.=" limit $pagenav,$limit";
		}else{
			$where.=" limit $limit";
		}
		$rows=$this->obj->DB_select_all("company_order",$where);
		if(!empty($rows))
		{
			include (APP_PATH."/config/db.data.php");
			foreach($rows as $k=>$v)
			{
				$uid[]=$v['uid'];
				$company=$this->obj->DB_select_all("company","`uid` in (".pylode(",",$uid).")","`uid`,`name`");
				$member=$this->obj->DB_select_all("member","`uid` in (".pylode(",",$uid).")","`uid`,`username`");
				foreach($rows as $key=>$val)
				{
					foreach($member as $value)
					{
						if($val['uid']==$value['uid'])
						{
							$list[$k]['name']=iconv("gbk","UTF-8",$value['username']);
						}
					}
					foreach($company as $value)
					{
						if($val['uid']==$value['uid'])
						{
							$list[$k]['name']=iconv("gbk","UTF-8",$value['name']);
						}
					}
				}
				$list[$k]['order_state']=$v['order_state'];
				$list[$k]['status']=$v['order_state'];
				$list[$k]['order_type']=iconv("gbk","UTF-8",$arr_data['pay'][$v['order_type']]);
				$list[$k]['id']=$v['id'];
				$list[$k]['order_id']=$v['order_id'];
				$list[$k]['type']=$v['type'];
				$list[$k]['order_time']=$v['order_time'];
				$list[$k]['order_price']=$v['order_price']; 
			}
			$data['error']=1;
			foreach($list as $k=>$v){
				if(is_array($v)){
					foreach($v as $key=>$val){
						$list[$k][$key]=isset($val)?$val:'';
					}
				}else{
					$list[$k]=isset($v)?$v:'';
				}
			}
			$data['list']=$list;
			echo json_encode($data);die;
		}else{
			$this->return_appadmin_msg(2,"没有获得信息");
		}
	}
	function show_action()
	{
		if(!$_POST['id'])
		{
			$this->return_appadmin_msg(2,"参数出错");
		}
		$id=(int)$_POST['id'];
		$row=$this->obj->DB_select_once("company_order","`id`='".$id."'");
		if(!empty($row))
		{
			$member=$this->obj->DB_select_once("member","`uid`='".$row['uid']."'","username");
			include (APP_PATH."/config/db.data.php");
			$list['id']		=$row['id'];
			$list['order_type']	=iconv("gbk","UTF-8",$arr_data['pay'][$row['order_type']]);
			$list['order_id']	=$row['order_id'];
			$list['order_price']=$row['order_price'];
			$list['order_time']	=$row['order_time']; 
			$list['order_remark']=iconv("gbk","UTF-8",$row['order_remark']);
			$list['username']=iconv("gbk","UTF-8",$member['username']);
			$list['uid']=$row['uid'];
			$list['type']=$row['type'];
			$list['order_state']=$row['order_state'];
			$list['status']=$row['order_state'];
			 
			foreach($list as $k=>$v){
				if(is_array($v)){
					foreach($v as $key=>$val){
						$list[$k][$key]=isset($val)?$val:'';
					}
				}else{
					$list[$k]=isset($v)?$v:'';
				}
			}
			$data['list']=$list;
			$data['error']=1;
			echo json_encode($data);die;
		}else{
			$this->return_appadmin_msg(2,"没有获得信息");
		}
	}
	function save_action()//修改订单
	{
		if(!$_POST['order_price']||!$_POST['order_remark']||!$_POST['id'])
		{
			$this->return_appadmin_msg(2,"参数出错");
		}
		$values="`order_price`='".$_POST['order_price']."',";
		$values.="`order_remark`='".$this->stringfilter($_POST['order_remark'])."',";
		$r_id=$this->obj->DB_update_all("company_order",$values,"id='".(int)$_POST['id']."'"); 
		$this->write_appadmin_log("充值记录(ID:".$_POST['id'].")修改成功！");
		$data['error']=1;
		echo json_encode($data);die;
	}
	function setpay_action()//充值订单确认
	{
		if(!$_POST['id'])
		{
			$this->return_appadmin_msg(2,"参数出错");
		}
		$del=(int)$_POST['id'];
		$row=$this->obj->DB_select_once("company_order","`id`='".$del."'");
		if($row['order_state']=='1'||$row['order_state']=='3')
		{
            
			$nid=$this->upuser_statis($row);
			if($nid)
			{
				$this->write_appadmin_log("充值记录(ID:".$del.")确认成功！");
				$data['error']=1;
				echo json_encode($data);die;
			}else{
				$this->return_appadmin_msg(2,"确认失败,请销后再试！");
			}
		}else{
			$this->return_appadmin_msg(2,"订单已确认，请勿重复操作！");
		}
	}
	function del_action()//删除
	{
		if(!$_POST['ids'])
		{
			$this->return_appadmin_msg(2,"参数出错");
		}
		$company_order=$this->obj->DB_select_all("company_order","`id` in (".$_POST['ids'].")","`order_id`");
		if($company_order&&is_array($company_order))
		{
			foreach($company_order as $val)
			{
				$order_ids[]=$val['order_id'];
			} 
			$this->obj->DB_delete_all("company_order","`id` in(".$_POST['ids'].")","");
		}
		$this->write_appadmin_log("充值记录(ID:".$_POST['ids'].")删除成功！");
		$data['error']=1;
		echo json_encode($data);die;
	}
}
?>