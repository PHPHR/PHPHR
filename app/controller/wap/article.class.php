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
class article_controller extends common{
	function index_action(){
		$this->rightinfo();
		$this->get_moblie();
		$this->yunset("headertitle","职场资讯");
		$this->seo("news");
		$this->yuntpl(array('wap/article'));
	}
	function show_action(){
		$this->rightinfo();
		$this->get_moblie();
        $NewsM=$this->MODEL('article');
		$id=(int)$_GET[id];
		if($id){
    		$NewsM->AddNewsHits(array('id'=>$id));
    	}
        $NewBaseInfo=$NewsM->GetNewsBaseOnce(array('id'=>$id));
        $NewContentInfo=$NewsM->GetNewsContentOnce(array('nbid'=>$id));
        $NewsInfo=array_merge($NewBaseInfo,$NewContentInfo);
		if($NewsInfo["keyword"]!=""){
			$keyarr = @explode(",",$NewsInfo["keyword"]);
			if(is_array($keyarr) && !empty($keyarr))
			{
				foreach($keyarr as $key=>$value){
					$sqlkeyword[]= " `keyword` LIKE '%$value%'";
				}
				$sqlkw = @implode(" OR ",$sqlkeyword); 
				$about=$NewsM->GetNewsBaseList(array("(".$sqlkw.") and `id`<>'".$id."'"),array("orderby"=>'`id` desc ','limit'=>6));
				if(is_array($about)){
					foreach($about as $k=>$v){
						if($this->config[sy_news_rewrite]=="2"){
							$about[$k]["url"]=$this->config['sy_weburl']."/article/".date("Ymd",$v["datetime"])."/".$v['id'].".html";
						}else{
							$about[$k]["url"]= Url("wap",array('c'=>'article','a'=>'show',"id"=>$v[id]),"1"); 
						} 
					}
				}
			}
		} 
		$this->yunset("about",$about);
		$this->yunset("row",$NewsInfo);
		$data['news_title']=$NewsInfo['title'];
		$data['news_keyword']=$NewsInfo['keyword']; 
		$data['news_class']=$class['name'];
		$description=$NewsInfo['description']?$NewsInfo['description']:$NewsInfo['content'];
		$data['news_desc']=$this->GET_content_desc($description); 
		$this->data=$data;
		
		$info["news_class"]=$class['name'];
		$info["last"]=$news_last;
		$info["next"]=$news_next;
		$info["like"]=$about;
        $info['content']=htmlspecialchars_decode($info['content']);
		$this->yunset("Info",$info);
		
		$this->seo("news_article");
		
		$this->yunset("headertitle","职场资讯");
		$this->yuntpl(array('wap/article_show'));
	}
}
?>