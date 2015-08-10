<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class search_controller extends map_controller{
	function index_action(){
        $CompanyM=$this->MODEL('company');
        $JobM=$this->MODEL('job');
        $page=$_POST['page'];
        $pagesize=10;

        if($_POST['keyword']){
            $where=' and `name` like \'%'.iconv("utf8","gbk",$_POST['keyword']).'%\'';
        }
		if($_POST['min_lng'] && $_POST['max_lng']){
			$lng="`x`>='".$_POST['min_lng']."' AND `x`<='".$_POST['max_lng']."' AND `y`>='".$_POST['min_lat']."' AND `y`<='".$_POST['max_lat']."'";
		}
        $CompanyNum=$CompanyM->GetComNum(array($lng,$where));
        if($page==0){
            $pagelimit=10;
        }else if($page<=($CompanyNum/$pagesize)){
            $pagelimit=$pagesize*$page.','.$pagesize;
        }else{
            $pagelimit=($CompanyNum/$pagesize)*$page.','.$pagesize;
        }
        $CompanyList=$CompanyM->GetComList(array($lng,$where),array('limit'=>$pagelimit));
        foreach($CompanyList as $k=>$v){
            $UIDList[]=$v['uid'];
        }
        $JobList=$JobM->GetComjobList(array('`uid` in ('.implode(',',$UIDList).')'));
        foreach($CompanyList as $k1=>$v1){
            foreach($JobList as $k2=>$v2){
                if($v1['uid']==$v2['uid']){
                    $CompanyList[$k1]['joblist'][]=$v2;
                }
            }
        }
        $json_list=array();
        foreach($CompanyList as $k1=>$v1){
            $json_list[$k1]['name']=mb_substr(yun_iconv('gbk','utf-8',$v1['name']),0,12,'utf-8');
            $json_list[$k1]['x']=yun_iconv('gbk','utf-8',$v1['x']);
            $json_list[$k1]['y']=yun_iconv('gbk','utf-8',$v1['y']);
            $json_list[$k1]['address']=yun_iconv('gbk','utf-8',$v1['address']);
            $json_list[$k1]['com_url']=Url('company',array('c'=>'show','id'=>$v1['uid']));
            foreach($CompanyList[$k1]['joblist'] as $k2=>$v2){
                $json_list[$k1]['joblist'][]=array('name'=>mb_substr(yun_iconv('gbk','utf-8',$v2['name']),0,12,'utf-8'),'job_url'=>Url('job',array('c'=>'comapply','id'=>$v2['id'])));
            }
        }
        echo json_encode(array('list'=>$json_list,'count'=>$CompanyNum));die;
	}
}
?>