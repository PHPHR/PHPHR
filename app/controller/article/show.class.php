<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class show_controller extends article_controller{
	function index_action(){   
		$id=(int)$_GET['id'];
		$M=$this->MODEL('article');
		$news=$M->GetNewsBaseOnce(array('id'=>$id));
		$row=$M->GetNewsContentOnce(array('nbid'=>$id)); 
		$news['content']=$row['content'];
		$news_last=$M->GetNewsBaseOnce(array("`id`<'".$id."'"),array('orderby'=>" `id` desc"));
 	 
		if(!empty($news_last)){ 
			if($this->config[sy_news_rewrite]=="2"){
				$news_last["url"]=$this->config['sy_weburl']."/article/".date("Ymd",$news_last["datetime"])."/".$news_last['id'].".html";
			}else{
				$news_last["url"]= Url('article',array('c'=>'show',"id"=>$news_last[id]),"1"); 
			}
		} 
		$news_next=$M->GetNewsBaseOnce(array("`id`>'".$id."'"),array('orderby'=>" `id` desc"));
		if(!empty($news_next)){
			if($this->config[sy_news_rewrite]=="2"){
				$news_next["url"]=$this->config['sy_weburl']."/article/".date("Ymd",$news_next["datetime"])."/".$news_next['id'].".html";
			}else{
				$news_next["url"]= Url('article',array('c'=>'show',"id"=>$news_next[id]),"1"); 
			} 
		}
		$class=$M->GetNewsGroupOnce(array("id"=>$news['nid']));
		if($news["keyword"]!="")
		{
			$keyarr = @explode(",",$news["keyword"]);
			if(is_array($keyarr) && !empty($keyarr))
			{
				foreach($keyarr as $key=>$value){
					$sqlkeyword[]= " `keyword` LIKE '%$value%'";
				}
				$sqlkw = @implode(" OR ",$sqlkeyword); 
				$about=$M->GetNewsBaseList(array("(".$sqlkw.") and `id`<>'".$id."'"),array("orderby"=>'`id` desc ','limit'=>6));
				if(is_array($about)){
					foreach($about as $k=>$v){
						if($this->config[sy_news_rewrite]=="2"){
							$about[$k]["url"]=$this->config['sy_weburl']."/article/".date("Ymd",$v["datetime"])."/".$v['id'].".html";
						}else{
							$about[$k]["url"]= Url('article',array('c'=>'show',"id"=>$v[id]),"1"); 
						}
						
					}
				}
			}
		}
		$info=$news;
		$data['news_title']=$news['title'];
		$data['news_keyword']=$news['keyword']; 
		$data['news_class']=$class['name'];
		$description=$news['description']?$news['description']:$news['content'];
		$data['news_desc']=$this->GET_content_desc($description); 
		$this->data=$data;

		
		$info["news_class"]=$class['name'];
		$info["last"]=$news_last;
		$info["next"]=$news_next;
		$info["like"]=$about;
        $info['content']=htmlspecialchars_decode($info['content']);
		$this->yunset("Info",$info);
		
		$this->seo("news_article");
		$this->news_tpl('show');
	} 
}
?>