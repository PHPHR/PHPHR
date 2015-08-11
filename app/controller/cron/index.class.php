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
class index_controller extends common{    
	function index_action($id=''){		
		@include PLUS_PATH.'cron.cache.php';
		if(is_array($cron) && !empty($cron)){
			foreach($cron as $key=>$value){
				if($id){
					if($value['id']==$id){
						$timestamp[$value['nexttime']] = $value;
						$timestamp[$value['nexttime']]['cronkey'] = $key;
					}
				}else{
					if($value['nexttime']<=time()){
						$timestamp[$value['nexttime']] = $value;
						$timestamp[$value['nexttime']]['cronkey'] = $key;
					}
				}
			}
			if($timestamp){
				krsort($timestamp);
				$croncache = current($timestamp);
				
				ignore_user_abort();
				set_time_limit(600);					
                if(file_exists(LIB_PATH.'cron/'.$croncache['dir'])){
					include(LIB_PATH.'cron/'.$croncache['dir']);
					if($croncache['dir']=="notice.php"){
						$notice = new notice($this->obj);
						$notice->index();
					}
				}
				$nexttime = $this->nextexe($croncache);
				$this->obj->DB_update_all("cron","`nowtime`='".time()."',`nexttime`='".strtotime($nexttime)."'","`id`='".$value['id']."'");
				$cron[$croncache['cronkey']]['nexttime'] = strtotime($nexttime);
				$data['cron'] = ArrayToString($cron);
				made_web_array(PLUS_PATH.'cron.cache.php',$data);
			}
		}

	}
	
}
?>