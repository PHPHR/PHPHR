<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class index_controller extends common{
	function index_action(){
        if($this->config['sy_jobdir']!=""){
			$jobclassurl=$this->config['sy_weburl']."/job/?c=search&";
		}else{
			$jobclassurl=$this->config['sy_weburl']."/index.php?m=job&c=search&";
		}
		$this->yunset("jobclassurl",$jobclassurl);
        $CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('job','city','com','user','hy'));
        $this->yunset($CacheList);
		if($this->config["cityid"]){
			$this->seo("index",$this->config['webtitle'],$this->config['webkeyword'],$this->config['webmeta']);
		}else{
			$this->seo("index");
		}
		$this->yun_tpl(array('index'));
	}
	function top_action(){
		$this->seo("top");
		$this->yun_tpl(array('top'));
	}
	function moblie_action(){
		$this->seo("moblie");
		$this->yun_tpl(array('moblie'));
	}
	function wap_action(){
		$this->seo("wap");
		$this->yun_tpl(array('wap'));
	}
	function weixin_action(){
		$this->seo("weixin");
		$this->yun_tpl(array('weixin'));
	}
	function android_action(){
		$this->seo("android");
		$this->yun_tpl(array('android'));
	}
	function ios_action(){
		$this->seo("ios");
		$this->yun_tpl(array('ios'));
	}
	function site_action(){
		if($this->config["sy_web_site"]!="1"){
			$this->ACT_msg($_SERVER['HTTP_REFERER'], $msg = "暂未开启多站点模式！");
		}
		$this->seo("index");
		$this->yun_tpl(array('site'));
	}
	function logout_action(){
		$this->logout();
	}
	function GetHits_action(){
    	if($_GET['id']){
    		$M=$this->MODEL('article');
    		$M->AddNewsHits(array("id"=>(int)$_GET['id']));
    		$news_info=$M->GetNewsBaseOnce(array("id"=>(int)$_GET['id']),array("field"=>"hits"));
    		echo "document.write('".$news_info["hits"]."')";
    	}
    }
	function get_action(){
		$M=$this->MODEL('index');
		$row=$M->GetDescOne(array("id"=>(int)$_GET['id']));
		$top="";$footer="";
		if($row['top_tpl']==1){
            $top=APP_PATH."/app/template/".$this->config['style']."/header";
		}else if($row['top_tpl']==3){
			 $top=$row['top_tpl_dir'];
		}
		if($row['footer_tpl']==1){
            $footer=APP_PATH."/app/template/".$this->config['style']."/footer";
		}else if($row['footer_tpl']==3){
			 $footer=$row['footer_tpl_dir'];
		}
		$seo['title']=$row['title'];
		$seo['keywords']=$row['keyword'];
		$seo['description']=$row['descs'];
		$this->yunset("seo",$seo);
		$this->yunset("name",$row['name']);
		$this->yunset("content",$row['content']);
		$this->header_desc($row['title'],$row['keyword'],$row['descs']);
		$make=APP_PATH."/app/template/".$this->config['style']."/make";
		$make_top=APP_PATH."/app/template/".$this->config['style']."/make_top";
		$this->yuntpl(array($make_top,$top,$make,$footer));
	}
	function clickHits_action(){
		if($_GET['id']){
			$M=$this->MODEL("index");
			$id=(int)$_GET['id'];
			$ad=$M->GetAdOne(array("id"=>$id),array("field"=>"pic_src,id"));
			if(!empty($ad)){
				$ip = fun_ip_get();
				if($this->config['sy_adclick']>"0"){
					$num=$M->GetAdclickNum("`ip`='".$ip."' and `aid`='".$id."' and `addtime`>'".strtotime('-'.$this->config['sy_adclick'].' hour')."'");
					if($num>"0"){
						header('Location: '.$ad['pic_src']);
					}
				}
				$data['aid']=$id;
				$data['uid']=$this->uid;
				$data['ip']=$ip;
				$data['addtime']=time();
				$nid=$M->InsertAdclick($data);
				if($nid){
					$M->AddAdHits($id);
				}
				if(!$ad['pic_src']){
					$ad['pic_src']=$this->config['sy_weburl'];
				}
				header('Location: '.$ad['pic_src']);
			}
		}
	}
	 function savecompic_action(){
		if (!empty($_FILES)){
			$pic=$name='';
			$data=array();
			$tempFile = $_FILES['Filedata'];
			$upload=$this->upload_pic("data/upload/show/");
			$pic=$upload->picture($tempFile);
			$name=@explode('.',$_FILES['Filedata']['name']);
			$picurl=str_replace("data/upload/show","./data/upload/show",$pic);
			$data["picurl"]= $picurl;
			$data['title']=$this->stringfilter($name[0]);
			$data["ctime"]=time();
			$data['uid']=(int)$_POST['uid'];
			$id=$this->obj->insert_into("company_show",$data);
			if($id){
 				echo $name[0]."||".$picurl."||".$id;die;
			}else{
				echo "2";die;
			}
		}
	}
	function saveuserpic_action()
	{
		if (!empty($_FILES))
		{
			$pic=$name='';
			$data=array();
			$tempFile = $_FILES['Filedata'];
			$upload=$this->upload_pic("data/upload/show/");
			$pic=$upload->picture($tempFile);
			$name=@explode('.',$_FILES['Filedata']['name']);
			$picurl=str_replace("data/upload/show","./data/upload/show",$pic);
			$data['picurl']= $picurl;
			$data['title']=$this->stringfilter($name[0]);
			$data['ctime']=time();
			$data['uid']=(int)$_POST['uid'];
			$data['eid']=(int)$_GET['eid'];
			$id=$this->obj->insert_into("resume_show",$data);
			if($id){
 				echo $name[0]."||".$picurl."||".$id;die;
			}else{
				echo "2";die;
			}
		}
	}
}
?>