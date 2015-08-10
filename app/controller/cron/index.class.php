<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
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