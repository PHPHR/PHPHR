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
	function index_action(){
		if($this->config['cityid']){
			$_GET['cityid'] = $this->config['cityid'];
		}
        $CompanyM=$this->MODEL('company');
        $UserinfoM=$this->MODEL('userinfo');
        $AskM=$this->MODEL('ask');
        $ArticleM=$this->MODEL('article');
		$M=$this->MODEL('job');
        $CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('city','com','hy','job'));
		$this->yunset($CacheList);
		$this->seo("firm");
		$this->yunset(array("gettype"=>$_SERVER["QUERY_STRING"],"getinfo"=>$_GET));
		$this->yun_tpl(array('index'));
	}
	function public_action(){
		$M=$this->MODEL("job");
		$UserinfoM=$this->MODEL('userinfo');
		$CompanyM=$this->MODEL('company'); 
        $sq_num=$M->GetUserJobNum(array('com_id'=>(int)$_GET['id']));
        $this->yunset("sq_num",$sq_num);
        $pl_num=$M->GetComMsgNum(array('cuid'=>(int)$_GET['id']));
        $this->yunset("pl_num",$pl_num);
        $userinfo=$UserinfoM->GetUserinfoOne(array("uid"=>(int)$_GET['id']),array('usertype'=>2));
        $userstatis=$UserinfoM->GetUserstatisOne(array("uid"=>(int)$_GET['id']),array('usertype'=>2));
        $row=array_merge($userinfo,$userstatis);
        if(!is_array($row)){
            $this->ACT_msg($this->config['sy_weburl'],"没有找到该企业！");
        }elseif($row[r_status]==2){
            $this->ACT_msg($this->config['sy_weburl'],"该企业暂被锁定，请稍后查看！");
        }
        $CacheM=$this->MODEL('cache');
        $CacheList=$CacheM->GetCache(array('city','com','hy'));
        $city_name=$CacheList['city_name'];
        $comclass_name=$CacheList['comclass_name'];
        $industry_name=$CacheList['industry_name'];
        $row['provinceid']=$city_name[$row['provinceid']];
        $row['mun_info']=$comclass_name[$row['mun']];
        $row['pr_info']=$comclass_name[$row['pr']];
        $row['hy_info']=$industry_name[$row['hy']];
        $row['logo']=str_replace("./",$this->config['sy_weburl']."/",$row['logo']);
		$this->yunset("com",$row);
        $banner=$CompanyM->GetBannerOnes(array('uid'=>(int)$_GET['id']));
        if($banner['pic']){
        	$banner['pic']=str_replace("..",$this->config['sy_weburl'],$banner['pic']);
        }else{
        	$banner['pic']=$this->config['sy_weburl']."/".$this->config['sy_banner'];
        }
        $this->yunset("banner",$banner);
        $NewsList=$CompanyM->GetNewsAll(array('status'=>1,'uid'=>$_GET['id']));
        $this->yunset('NewsList',$NewsList);
        $ProductList=$CompanyM->GetProductAll(array('status'=>1,'uid'=>$_GET['id']));
        $this->yunset('ProductList',$ProductList);
		$data['company_name']=$row['name'];
		$data['company_name_desc']=$row['content'];
		return $data;
	}
    function show_action(){
    	$UserinfoM=$this->MODEL('userinfo');
    	$AskM=$this->MODEL('ask');
    	$CompanyM=$this->MODEL('company');
		$M=$this->MODEL('job');
		$CompanyM->UpdateCompany(array("`hits`=`hits`+1"),array("uid"=>(int)$_GET['id']));
        $msglist=$CompanyM->GetMsgList(array('cuid'=>(int)$_GET['id']),array("limit"=>2,"orderby"=>"id","desc"=>"desc"));
        if($msglist&&is_array($msglist)){
            foreach($msglist as $v){
                $UIDList[]=$v['uid'];
            }
            $userlist=$UserinfoM->GetUserinfoList(array("`uid` in (".implode(',',$UIDList).")"),array('usertype'=>1,'field'=>"`uid`,`name`,`photo`,`def_job`"));
            foreach($msglist as $k=>$v){
                foreach($userlist as $kk=>$vv){
                    if($v['uid']==$vv['uid']){
                        $msglist[$k]=array_merge($v,$vv);
                    }
                }
            }
        }
        $this->yunset("msglist",$msglist);
        $msg_num=$CompanyM->GetMsgNum(array('cuid'=>(int)$_GET['id'],'status'=>1));
        if($msg_num>2){
            $this->yunset("msg_num",$msg_num);
        }
        if($this->config['com_login_link']=="1"||$this->config['com_resume_link']=='1'){
            if($this->uid=="" && $this->username==""){
                $look_msg="您还没有登录，登录后才可以查看联系方式！";
                $looktype="2";
            }else if($_GET['id']!=$_COOKIE['uid']){
                if($_COOKIE["usertype"]!="1"){
                    $look_msg="您不是个人用户，不能查看联系方式！";
                }else{
                    if($this->config['com_resume_link']=="1"){
                        $rows=$this->obj->DB_select_num("resume_expect","`uid`='".$this->uid."'");
                        if($rows<1){
                            $look_msg="您缺少一份正式的个人简历，暂时无法查看该企业联系方式！";
                            $looktype="1";
                        }
                    }
                }
            }
        }
		$num=$M->GetComjobNum(array('uid'=>(int)$_GET['id'],'`r_status`<>2','`status`<>1','state'=>1));
		if($this->uid&&$_COOKIE['usertype']=='1'){
			$isatn=$AskM->GetAtnOne(array("uid"=>$this->uid,"sc_uid"=>(int)$_GET['id']));
			$this->yunset("isatn",$isatn);
		}

        $this->yunset("num",$num);
        $this->yunset("look_msg",$look_msg);
        $this->yunset("looktype",$looktype);
        $this->yunset("id",$_GET['id']);
		$data=$this->public_action();
		$this->data=$data;
		$this->seo("company_index");
    	$this->comtpl("index");
    }
	function compl_action(){
		$M=$this->MODEL('job');
		$CompanyM=$this->MODEL('company');
		$UserinfoM=$this->MODEL('userinfo');
		 if($_POST['submit']){
			$black=$M->GetBlackOne(array('p_uid'=>$this->uid,'c_uid'=>(int)$_POST['id']));
			if(!empty($black)){
				$this->ACT_layer_msg("您已被该企业列入黑名单，不能评论该企业！",8,$_SERVER['HTTP_REFERER']);
			}
			$qiye=$UserinfoM->GetUserinfoOne(array("uid"=>(int)$_POST['id']),array('field'=>"`pl_status`",'usertype'=>1));
			$data=array('uid'=>$this->uid,'content'=>$_POST['content'],'cuid'=>(int)$_POST['id'],'ctime'=>time());
			if ($qiye['pl_status']=='2'){
				$data['status']=0;
				$nid=$CompanyM->insert_into("company_msg",$data);
				isset($nid)?$this->ACT_layer_msg("评论成功，请等待企业审核！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("评论失败，请稍后再试！",8,$_SERVER['HTTP_REFERER']);
			}else{
				$data['status']=1;
				$nid=$CompanyM->insert_into("company_msg",$data);
				isset($nid)?$this->ACT_layer_msg("评论成功！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("评论失败，请稍后再试！",8,$_SERVER['HTTP_REFERER']);
			}
		}else if($_POST['submit2']){
			$data=array('reply'=>$_POST['content'],'reply_time'=>time());
			$where['id']=(int)$_POST['id'];
			$where['cuid']=$this->uid;
			$nid=$CompanyM->update_once('company_msg',$data,$where);
			isset($nid)?$this->ACT_layer_msg("回复成功！",9,$_SERVER['HTTP_REFERER']):$this->ACT_layer_msg("回复失败，请稍后再试！",8,$_SERVER['HTTP_REFERER']);
		}
	}
	function comtpl($tpl){
        if ($_GET['style'] && !preg_match('/^[a-zA-Z]+$/',$_GET['style'])){
            exit();
        }
        if ($_GET['tp'] && !preg_match('/^[a-zA-Z]+$/',$_GET['tp'])){
            exit();
        }
        $UserinfoM=$this->MODEL('userinfo');
        $statis=$UserinfoM->GetUserstatisOne(array("uid"=>(int)$_GET['id']),array('usertype'=>2));
        if($statis['comtpl'] && $statis['comtpl']!="default" && !$_GET['style']){
            $tplurl=$statis[comtpl];
        }else{
            $tplurl="default";
        }
        if($_GET['style']){
            $tplurl=$_GET['style'];
        }
		$this->yunset(array("com_style"=>$this->config['sy_weburl']."/app/template/company/".$tplurl."/","comstyle"=>TPL_PATH."company/".$tplurl."/"));

		$this->yuntpl(array('company/'.$tplurl."/".$tpl));
	}
	function productshow_action(){
		$CompanyM=$this->MODEL("company");
		$AskM=$this->MODEL('ask');
        $Where['id']=$_GET['pid'];
		session_start();
        if(!is_numeric($_SESSION['auid']) && $_GET['id']!=$this->uid){
            $Where['status']=1;
        }
		
        $ProductInfo=$CompanyM->GetProductOne($Where);
        $this->yunset('ProductInfo',$ProductInfo);
		$data=$this->public_action();
		$data['company_product']=$ProductInfo['name'];
		$this->data=$data;
		if($this->uid&&$_COOKIE['usertype']=='1'){
			$isatn=$AskM->GetAtnOne(array("uid"=>$this->uid,"sc_uid"=>(int)$_GET['id']));
			$this->yunset("isatn",$isatn);
		}
	    $this->seo("company_productshow");
		$this->comtpl("productshow");
	}
	function newsshow_action(){
		
		$CompanyM=$this->MODEL('company');
		$AskM=$this->MODEL('ask');
        $Where['id']=$_GET['nid'];
		session_start();
        if(!is_numeric($_SESSION['auid']) && $_GET['id']!=$this->uid){
            $Where['status']=1;
        }
        $NewsInfo=$CompanyM->GetNewsOne($Where);
        $this->yunset('NewsInfo',$NewsInfo);
		$data=$this->public_action();
		$data['company_news']=$NewsInfo['name'];
		$this->data=$data;
		if($this->uid&&$_COOKIE['usertype']=='1'){
			$isatn=$AskM->GetAtnOne(array("uid"=>$this->uid,"sc_uid"=>(int)$_GET['id']));
			$this->yunset("isatn",$isatn);
		}
	    $this->seo("company_newsshow");
		$this->comtpl("newsshow");
	}
	function msg_action(){
        $UserinfoM=$this->MODEL('userinfo');
        $AskM=$this->MODEL('ask');
        $M=$this->MODEL('job');
        $ResumeM=$this->MODEL('resume');
		$pageurl=Url('company',array('id'=>$_GET['id'],'c'=>'msg','page'=>'{{page}}'));
		$msglist=$this->get_page("company_msg","`cuid`='".(int)$_GET['id']."' and`status`='1' order by id desc",$pageurl,"10");
		if(is_array($msglist)&&$msglist){
			foreach($msglist as $v){
				$uid[]=$v['uid'];
			}
			$uid=pylode(",",$uid);
			$user=$UserinfoM->GetUserinfoList(array("`uid` in (".$uid.")"),array('usertype'=>1,'field'=>"`uid`,`name`,`photo`,`def_job`"));
			foreach($msglist as $k=>$v){
				foreach($user as $val){
					if($v['uid']==$val['uid']){
                        $msglist[$k]=array_merge($v,$val);
					}
				}
			}
		}
		if($this->uid&&$_COOKIE['usertype']=='1'){
			$isatn=$AskM->GetAtnOne(array("uid"=>$this->uid,"sc_uid"=>(int)$_GET['id']));
			$this->yunset("isatn",$isatn);
		}
		$this->yunset("msglist",$msglist);
		$data=$this->public_action();
		$this->data=$data;
		$this->seo("company_msg");
		$this->comtpl("msg");
	}
}
?>