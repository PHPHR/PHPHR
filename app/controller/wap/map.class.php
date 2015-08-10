<?php
/*
* $Author ：Pari开发团队, 联系: QQ 280913284
*
*
 */
class map_controller extends common{
	function index_action(){
		$this->get_moblie();
        $this->yunset("title","附近职位");
        $this->yunset('JobList',$JobList);
		$this->yuntpl(array('wap/map'));
	}
    function joblist_action(){
		$this->get_moblie();
        $CompanyM=$this->MODEL('company');
        $JobM=$this->MODEL('job');
        $page=$_POST['page'];
        $pagesize=10;
        if($_POST['keyword']){
            $Where[]='`name` like \'%'.$_POST['keyword'].'%\'';
        }
        $xy=getAround($_POST[x],$_POST[y],$_POST[r]);
		if($xy[0]){
			$Where[]="`x`>='".$xy[0]."' AND `x`<='".$xy[1]."' AND `y`>='".$xy[3]."' AND `y`<='".$xy[2]."'";
		}
        $CompanyNum=$CompanyM->GetComNum($Where);
        if(!$page || $page<=1){
            $pagelimit=10;
        }else if($page<=($CompanyNum/$pagesize)){
            $pagelimit=$pagesize*$page.','.$pagesize;
        }else{
            $pagelimit=($CompanyNum/$pagesize)*$page.','.$pagesize;
        }
        $CompanyList=$CompanyM->GetComList($Where,array('limit'=>$pagelimit));
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
            $json_list[$k1]['name']=yun_iconv('gbk','utf-8',$v1['name']);
            $json_list[$k1]['x']=yun_iconv('gbk','utf-8',$v1['x']);
            $json_list[$k1]['y']=yun_iconv('gbk','utf-8',$v1['y']);
            $json_list[$k1]['address']=yun_iconv('gbk','utf-8',$v1['address']);
            $json_list[$k1]['com_url']=Url('wap',array('c'=>'company','a'=>'show','id'=>$v1['uid']));
            foreach($CompanyList[$k1]['joblist'] as $k2=>$v2){
                $json_list[$k1]['joblist'][]=array('name'=>yun_iconv('gbk','utf-8',$v2['name']),'job_url'=>Url('wap',array('c'=>'job','a'=>'view','id'=>$v2['id'])));
            }
        }
        echo json_encode(array('list'=>$json_list,'pagecount'=>($CompanyNum/$pagesize+1)));die;
	}
}
?>