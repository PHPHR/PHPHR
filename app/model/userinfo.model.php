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
class userinfo_model extends model{
    function GetUserinfoOne($Where=array(),$Options=array('usertype'=>null,'field'=>null)){
    	$UserType=$Options['usertype'];
        $TableName='company';
        $TableNameList=array(1=>'resume',2=>'company');
        $Table=$TableNameList[$UserType];
		if($Table==''){$Table=$TableName;}
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once($Table,$WhereStr,$FormatOptions['field']);
    }
	function UpdateUserStatis($Values=array(),$Where=array(),$Options=array('usertype'=>null)){
    	(int)$Options['usertype']?$UserType=(int)$Options['usertype']:1;
		$tables=array(1=>'member_statis',2=>'company_statis');
        $TableName=$tables[$UserType];
		$WhereStr=$this->FormatWhere($Where);
		$ValuesStr=$this->FormatValues($Values);
        $FormatOptions=$this->FormatOptions($Options);
		return $this->DB_update_all($TableName,$ValuesStr,$WhereStr);
    }
    function GetUserstatisOne($Where=array(),$Options=array('usertype'=>null,'field'=>null)){
    	(int)$Options['usertype']?$UserType=(int)$Options['usertype']:1;
        $TableNameList=array(1=>'member_statis',2=>'company_statis');
        $TableName=$TableNameList[$UserType];
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once($TableName,$WhereStr,$FormatOptions['field']);
    }
	function GetUserstatisAll($Where=array(),$Options=array('usertype'=>null,'field'=>null)){
    	(int)$Options['usertype']?$UserType=(int)$Options['usertype']:1;
        $TableNameList=array(1=>'member_statis',2=>'company_statis');
        $TableName=$TableNameList[$UserType];
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all($TableName,$WhereStr,$FormatOptions['field']);
    }
    function GetRatinginfoOne($Where=array(),$Options=array('field'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('company_rating',$WhereStr,$FormatOptions['field']);
    }
	function GetRatinginfoAll($Where=array(),$Options=array('field'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('company_rating',$WhereStr,$FormatOptions['field']);
    }
    function GetPayinfoOne($Where=array(),$Options=array()){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('company_pay',$WhereStr,$FormatOptions['field']);
    }
    function GetCompanyPay($Where=array(),$Options=array()){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('company_pay',$WhereStr,$FormatOptions['field']);
    }
	function DeleteComPay($Where=array()){
		$WhereStr=$this->FormatWhere($Where);
        return $this->DB_delete_all('company_pay',$WhereStr,"");
    }
    function GetUserinfoList($Where=array(),$Options=array('usertype'=>null,'field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        (int)$Options['usertype']?$UserType=(int)$Options['usertype']:1;
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        $TableName='company';
        $TableNameList=array(1=>'resume',2=>'company');
        if(is_numeric($UserType)){
            $Table=$TableNameList[$UserType];
        }
		if($Table==''){$Table=$TableName;}
        return $this->DB_select_all($Table,$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }

    function  UpdateUserinfo($Options=array('usertype'=>null,'values'=>null),$Where=array()){
		(int)$Options['usertype']?$UserType=(int)$Options['usertype']:1;
        $TableName='company';
        $TableNameList=array(1=>'resume',2=>'company');
        $ValuesStr=$this->FormatValues($Options['values']);
        if(is_numeric($UserType)){
            $Table=$TableNameList[$UserType];
        }
		if($Table==''){$Table=$TableName;}
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);

        return $this->DB_update_all($Table,$ValuesStr,$WhereStr);
    }
    function GetMemberOne($Where=array(),$Options=array('field'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('member',$WhereStr,$FormatOptions['field']);
    }
    function GetMemberNum($Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        return $this->DB_select_num('member',$WhereStr);
    }
    function GetMemberList($Where=array(),$Options=array('field'=>null,'orderby'=>null,'groupby'=>null,'limit'=>null)){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('member',$WhereStr.$FormatOptions['order'],$FormatOptions['field']);
    }
    function GetMemberUid($usertype){
    	$list=$this->DB_select_all('member',"`usertype`='".$usertype."' and `status`='1'","`uid`");
    	if(is_array($list))
    	{
    		foreach($list as $v)
    		{
    			$uid[]=$v['uid'];
    		}
    	}
        return @implode(",",$uid);
    }
    function UpdateMember($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('member',$ValuesStr,$WhereStr);
    }
    function AddMember($Values=array()){
        return $this->insert_into('member',$Values);
    }
    function RegisterMember($Values=array(),$Options=array()){
		(int)$Options['usertype']?$UserType=(int)$Options['usertype']:1;
        $userid=(int)$Options['uid'];
        if($UserType=="1"){
            $table = "member_statis";
            $table2 = "resume";
            $udata['uid'] = $userid;
            $udata2['uid'] = $userid;
            $udata2['email'] = $Values['email'];
        }elseif($UserType=="2"){
            $table = "company_statis";
            $table2 = "company";
            $udata['uid'] = $userid;
            $udata2['uid'] = $userid;
            $udata2['linkmail'] = $Values['email'];
            $udata2['linkman'] = trim($Values['linkman']);
            $udata2['linktel'] = trim($Values['moblie']);
			$udata2['name'] = $Values['name'];
			$udata2['address'] = $Values['address'];
			if($this->config['com_status']==0){
				$udata2['r_status']=2;
			}
            $udata=$this->FetchRatingInfo($udata,array("uid"=>$userid,"id"=>$Options['rating']));
        }
        $AddFlag=$this->insert_into($table,$udata);
        $AddFlag=$this->insert_into($table2,$udata2);
        $AddFlag=$this->insert_into('friend_info',array('uid'=>$userid,'nickname'=>$Values['username'],'usertype'=>$UserType));
        return $AddFlag;
    }
    function FetchRatingInfo($data=array(),$Options=array()){
		if((int)$Options[id]<1){
			$id =$this->config['com_rating'];
		}else{
			$id=(int)$Options[id];
		}
		$row = $this->GetRatinginfoOne(array('id'=>$id));
        $data=array_merge($data,array('rating'=>$id,'rating_name'=>$row['name'],'rating_type'=>$row['type']));
		if($row['type']==1){
            $data=array_merge($data,array('job_num'=>$row['job_num'],'down_resume'=>$row['resume'],'editjob_num'=>$row['editjob_num'],'breakjob_num'=>$row['breakjob_num'],"invite_resume"=>$row['interview']));
		}else{
			$time=time()+86400*$row['service_time'];
			$data['vip_etime']=$time;
		}
		return $data;
	}
    function GetMemberstatisOne($Where=array(),$Options=array()){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('member_statis',$WhereStr,$FormatOptions['field']);
    }
    function UpdateMemberstatis($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('member_statis',$ValuesStr,$WhereStr);
    }
    function AddMemberstatis($Values=array(),$Options=array()){
        $ValuesStr=$this->FormatValues($Values);
        return $this->insert_into('member_statis',$ValuesStr);
    }
	function company_invtal($uid,$integral,$auto=true,$name="",$pay=true,$pay_state=2,$type="integral",$pay_type=''){
		if($pay&&$integral!='0'){
			$integral = abs(intval($integral));
			$member=$this->DB_select_once("member","`uid`='".$uid."'","usertype");
			if($member['usertype']=="1"){
				$table="member_statis";
			}elseif($member['usertype']=="2"){
				$table="company_statis";
			}
			if($auto){
				$nid=$this->DB_update_all($table,"`$type`=`$type`+'".$integral."'","`uid`='".$uid."'");
			}else{
				$nid=$this->DB_update_all($table,"`$type`=`$type`-'".$integral."'","`uid`='".$uid."'");
				$integral="-".$integral;
			}
			$dingdan=mktime().rand(10000,99999);
			$data['order_id']=$dingdan;
			$data['com_id']=$uid;
			$data['pay_remark']=$name;
			$data['pay_state']=$pay_state;
			$data['pay_time']=time();
			$data['order_price']=$integral;
			$data['pay_type']=$pay_type;
			if($type=="integral"){
				$data['type']=1;
			}else{
				$data['type']=2;
			}
			$this->insert_into("company_pay",$data);

			return $nid;
		}else{
			return true;
		}
	}
    function GetCompanyCert($Where=array(),$Options=array()){
        $WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_once('company_cert',$WhereStr,$FormatOptions['field']);
    }
    function UpdateCompanyCert($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('company_cert',$ValuesStr,$WhereStr);
    }
    function AddCompanyCert($Values=array()){
        return $this->insert_into('company_cert',$Values);
    }
    function UpdateResume($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('resume',$ValuesStr,$WhereStr);
    }
    function GetResumeList($Where=array(),$Options=array()){
		$WhereStr=$this->FormatWhere($Where);
        $FormatOptions=$this->FormatOptions($Options);
        return $this->DB_select_all('resume',$WhereStr,$FormatOptions['field']);
    }
    function UpdateCompany($Values=array(),$Where=array()){
        $WhereStr=$this->FormatWhere($Where);
        $ValuesStr=$this->FormatValues($Values);
        return $this->DB_update_all('company',$ValuesStr,$WhereStr);
    }
    function InsertReg($table,$Values=array()){
        return $this->insert_into($table,$Values);
    }
    function DeleteMember($UIDS=array(),$Options=array()){
        if(is_array($UIDS)){
            foreach($UIDS as $k=>$v){
                delfiledir("../data/data/upload/tel/".intval($v));
            }
            $uids = @implode(",",$UIDS);
            $resume=$this->DB_select_all("resume","`uid` in ($uids) and `photo`<>''","`photo`,`resume_photo`");
            if(is_array($resume)){
                foreach($resume as $val){
                    unlink_pic(".".$val['photo']);
                    unlink_pic(".".$val['resume_photo']);
                }
            }
            $friend_pic = $this->DB_select_all("friend_info","`uid` in ($uids) and `pic`<>''","`pic`,`pic_big`");
            if(is_array($friend_pic)){
                foreach($friend_pic as $val){
                    unlink_pic($val['pic']);
                    unlink_pic($val['pic_big']);
                }
            }
            $show=$this->DB_select_all("resume_show","`uid` in ($uids) and `picurl`<>''","`picurl`");
            if(is_array($show)){
                foreach($show as $val){
                    unlink_pic(".".$val['picurl']);
                }
            }
            $del_array=array("member","resume","member_statis","look_resume","look_job","resume_show","userid_msg","userid_job","resume_expect","resume_cert","resume_edu","resume_other","resume_project","resume_skill","resume_training","resume_work","resume_doc","user_resume","resume_show","down_resume","userid_job","friend_info","friend_message","friend_state","question","msg","attention","rebates","company_msg","down_reume");
            foreach($del_array as $value){
                $this->DB_delete_all($value,"`uid` in ($uids)","");
            }
            $this->DB_delete_all("atn","`uid` in ($uids) or `scid` in ($uids)","");
            $this->DB_delete_all("message","`fa_uid` in ($uids)","");
            $this->DB_delete_all("friend_reply","`fid` in ($uids)","");
            $this->DB_delete_all("friend_foot","`uid` in ($uids) or `fid` in ($uids)","");
            $this->DB_delete_all("blacklist","`p_uid` in ($uids)","");
            $this->DB_delete_all("friend","`uid` in ($uids) or `nid` in ($uids)","");
            $this->DB_delete_all("report","`p_uid` in ($uids) or `c_uid` in ($uids)","");
            $layer_type=1;
        }else{
            $del = intval($UIDS);
            $uids = intval($UIDS);
            delfiledir("../data/upload/tel/".$del);
            $resume=$this->DB_select_once("resume","`uid`='".$del."' and `photo`<>''");
            if(is_array($resume)){
                unlink_pic('.'.$resume['photo']);
                unlink_pic(".".$resume['resume_photo']);
            }
            $friend_pic = $this->DB_select_once("friend_info","`uid`='$del' and `pic`<>''");
            if(is_array($friend_pic)){
                unlink_pic($friend_pic['pic']);
                unlink_pic($friend_pic['pic_big']);
            }
            $show=$this->DB_select_all("resume_show","`uid`='".$del."' and `picurl`<>''","`picurl`");
            unlink_pic(".".$show['picurl']);
            $del_array=array("member","resume","member_statis","look_resume","look_job","resume_show","userid_msg","userid_job","resume_expect","resume_cert","resume_edu","resume_other","resume_project","resume_skill","resume_training","resume_work","resume_doc","user_resume","resume_show","down_resume","userid_job","friend_info","friend_message","friend_state","question","msg","attention","rebates","company_msg","down_reume");
            foreach($del_array as $value){
                $this->DB_delete_all($value,"`uid`='".$del."'","");
            }
            $this->DB_delete_all("friend_foot","`uid`='$del' or `fid`='$del'","");
            $this->DB_delete_all("atn","`uid`='$del' or `scid`='$del'","");
            $this->DB_delete_all("message","`fa_uid`='".$del."'","");
            $this->DB_delete_all("friend","`uid`='$del' or `nid`='$del'");
            $this->DB_delete_all("friend_reply","`fid`='$del'","");
            $this->DB_delete_all("blacklist","`p_uid`='$del'","");
            $this->DB_delete_all("report","`p_uid`='$del' or `c_uid`='$del'");
            $layer_type=0;
        }
        return true;
    }
}
?>