<?php

/*
*
 */

class index_controller extends job_controller
{
    function index_action()
    {
        if ($this->config['sy_default_comclass'] == '1') {
        $CacheM = $this->MODEL('cache');
        $CacheList = $CacheM->GetCache(array('job', 'city', 'hy'));
        $this->yunset($CacheList);

        $joburl = $this->config['sy_jobdir'] != "" ? $this->config['sy_weburl'] . "/job/?c=search&" : $joburl = $this->config['sy_weburl'] . "/index.php?m=job&c=search&";
        $this->yunset('jobclassurl',$joburl);

        $this->seo("com");
            $this->yun_tpl(array('index'));
//        $this->yun_tpl(array('index_job'));
        } else {
            $this->comsearch();
        }
    }

    function comsearch()
    {
        if ($this->config['cityid']) {
            $_GET['cityid'] = $this->config['cityid'];
        }
        if ($this->config['three_cityid']) {
            $_GET['three_cityid'] = $this->config['three_cityid'];
        }
        $uptime = array(1 => '今天', 3 => '最近3天', 7 => '最近7天', 30 => '最近一个月', 90 => '最近三个月');
        $this->yunset("uptime", $uptime);
        $sdate = array('1' => '一天内', "3" => '三天内', '7' => '七天内', "15" => '十五天内', '30' => '一个月内', "60" => '两个月内');
        $this->yunset("sdate", $sdate);
        $CacheM = $this->MODEL('cache');
        $CacheList = $CacheM->GetCache(array('job', 'city', 'com', 'hy'));
        $this->yunset($CacheList);
        if ($this->uid && $_COOKIE['usertype'] == 1) {
            $FinderParams = array('keyword', 'hy', 'job1', 'job1_son', 'job_post', 'provinceid', 'cityid', 'three_cityid', 'salary', 'edu', 'exp', 'sex', 'type', 'report', 'sdate', 'uptime');
            foreach ($_GET as $k => $v) {
                if (in_array($k, $FinderParams) && $v != "") {
                    $finder[$k] = $v;
                }
            }
            if ($this->config['cityid']) {
                unset($finder['cityid']);
            }
            if ($finder && is_array($finder)) {
                foreach ($finder as $key => $val) {
                    $para[] = $key . "=" . $val;
                }
                $paras = @implode('##', $para);
                $this->yunset("paras", $paras);
            }
            if ($_COOKIE['lookjob'] || $_COOKIE['favjob'] || $_COOKIE['useridjob']) {
                $this->yunset(array('lookjob' => @explode(',', $_COOKIE['lookjob']), 'favjob' => @explode(',', $_COOKIE['favjob']), 'useridjob' => @explode(',', $_COOKIE['useridjob'])));
            } else {
                $historyM = $this->MODEL('history');
                $lookjob = $historyM->lookJobHistory($this->uid);
                $favjob = $historyM->favjobHistory($this->uid);
                $useridjob = $historyM->useridjobHistory($this->uid);
                if ($this->config['sy_web_site'] == "1") {
                    if ($this->config['sy_onedomain'] != "") {
                        $weburl = get_domain($this->config['sy_onedomain']);
                    } elseif ($this->config['sy_indexdomain'] != "") {
                        $weburl = get_domain($this->config['sy_indexdomain']);
                    } else {
                        $weburl = get_domain($this->config['sy_weburl']);
                    }
                    SetCookie("lookjob", $lookjob, time() + 86400, "/", $weburl);
                    SetCookie("favjob", $favjob, time() + 86400, "/", $weburl);
                    SetCookie("useridjob", $useridjob, time() + 86400, "/", $weburl);
                } else {
                    SetCookie("lookjob", $lookjob, time() + 86400, "/");
                    SetCookie("favjob", $favjob, time() + 86400, "/");
                    SetCookie("useridjob", $useridjob, time() + 86400, "/");
                }
                $this->yunset(array('lookjob' => @explode(',', $lookjob), 'favjob' => @explode(',', $favjob), 'useridjob' => @explode(',', $useridjob)));
            }
        }
        if ($_GET['three_cityid']) {
            foreach ($CacheList['city_type'] as $k => $v) {
                if (in_array($_GET['three_cityid'], $v)) {
                    $zpthreecityid = $k;
                }
            }
            $this->yunset("zpthreecityid", $zpthreecityid);
        } elseif ($_GET['cityid']) {
            foreach ($CacheList['city_type'] as $k => $v) {
                if (in_array($_GET['cityid'], $v)) {
                    $zpcityid = $k;
                }
            }
            $this->yunset("zpcityid", $zpcityid);
        }
        if ($_GET['job_post']) {
            foreach ($CacheList['job_type'] as $k => $v) {
                if (in_array($_GET['job_post'], $v)) {
                    $zpjobpost = $k;
                }
            }
            $this->yunset("zpjobpost", $zpjobpost);
        } elseif ($_GET['job1_son']) {
            foreach ($CacheList['job_type'] as $k => $v) {
                if (in_array($_GET['job1_son'], $v)) {
                    $zpjob1son = $k;
                }
            }
            $this->yunset("zpjob1son", $zpjob1son);
        }
        $this->seo("com_search");
        $this->yun_tpl(array('search'));
//        $this->yun_tpl(array('search_job'));
    }

    function search_action()
    {
        $this->comsearch();
    }


    function addfinder_action()
    {
        if ($_COOKIE['usertype'] == $_POST['usertype'] && $this->uid) {
            $M = $this->MODEL('job');
            if ($this->config['user_finder']) {
                $num = $M->GetFinderNum(array('uid' => $this->uid));
                if ($num >= $this->config['user_finder']) {
                    $this->layer_msg("个人搜索器已达最大数量！", 8, 0);
                }
            }
            $res = $this->insertfinder(trim($_POST['para']));
            $res ? $this->layer_msg("保存成功！", 9, 0) : $this->layer_msg("保存失败！", 8, 0);
        } else {
            if ($_POST['usertype'] == "1") {
                $msg = "只有个人用户才能添加职位搜索器";
            } elseif ($_POST['usertype'] == "2") {
                $msg = "只有企业用户才能添加人才搜索器！";
            } else {
                $msg = "当前会员类型不允许添加搜索器！";
            }
            $this->layer_msg($msg, 8, 0);
        }
    }

    function report_action()
    {
        session_start();
        $M = $this->MODEL('job');
        $AskM = $this->MODEL('ask');
        if ($this->config['user_report'] != '1') {
            echo 5;
            die;
        }
        if (md5($_POST['authcode']) != $_SESSION['authcode']) {
            unset($_SESSION['authcode']);
            echo 1;
            die;
        }
        $row = $AskM->GetReportOne(array('p_uid' => $this->uid, 'c_uid' => (int)$_POST['r_uid'], 'usertype' => $_COOKIE['usertype']));
        if (is_array($row)) {
            echo 2;
            die;
        }
        $data = array('c_uid' => (int)$_POST['r_uid'], 'inputtime' => mktime(), 'p_uid' => $this->uid, 'usertype' => (int)$_COOKIE['usertype'], 'eid' => (int)$_POST['id'], 'r_name' => $this->stringfilter($_POST['r_name']), 'username' => $this->username, 'r_reason' => $this->stringfilter($_POST['r_reason']));
        $nid = $AskM->AddReport($data);
        if ($nid) {
            echo 3;
            die;
        } else {
            echo 4;
            die;
        }
    }

    function recommend_action()
    {
        if ($_POST) {
            if ($_POST['femail'] == "" || $_POST['myemail'] == "" || $_POST['authcode'] == "") {
                echo "请完整填写信息！";
                die;
            }
            session_start();
            if (md5($_POST['authcode']) != $_SESSION[authcode]) {
                echo "验证码不正确！";
                die;
            }
            if ($_COOKIE["sendjob"] == $_POST['id']) {
                echo "请不要频繁发送邮件！同一职位发送间隔为两分钟！";
                die;
            }
            if ($this->config["sy_smtpserver"] == "" || $this->config["sy_smtpemail"] == "" || $this->config["sy_smtpuser"] == "") {
                echo "网站邮件服务器不可用";
                die;
            }
            $filename = TPL_PATH . $this->config['style'] . "/" . $this->m . "/sendjob.htm";
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            $contents = $this->assignhtm($contents, (int)$_POST['id']);
            $smtp = $this->email_set();
            $smtpusermail = $this->config["sy_smtpemail"];
            $myemail = $this->stringfilter(trim($_POST['myemail']));
            $title = "您的好友" . $myemail . "向您推荐了职位！";
            $sendid = $smtp->sendmail($_POST['femail'], $smtpusermail, $title, $contents, "HTML", "", "", "", $myemail);
            if ($sendid) {
                echo 1;
            } else {
                echo "邮件发送错误 原因：1邮箱不可用 2网站关闭邮件服务";
                die;
            }
            SetCookie("sendjob", $_POST['id'], time() + 120, "/");
            die;
        }
        $JobM = $this->MODEL('job');
        $Member = $this->MODEL('userinfo');
        $Info = $JobM->GetComjobOne(array("state" => "1", "id" => (int)$_GET['id'], "`r_status`<>'2'"));
        $com = $Member->GetUserinfoOne(array("uid" => $Info['uid']), array("usertype" => "2", "field" => "hy,sdate,address,zip,linkman,website"));
        $Info['hy'] = $com['hy'];
        $Info['sdate'] = $com['sdate'];
        $Info['address'] = $com['address'];
        $Info['zip'] = $com['zip'];
        $Info['linkman'] = $com['linkman'];
        $Info['website'] = $com['website'];
        if (is_array($Info)) {
            $cache_array = $this->db->cacheget();
            $Job = $this->db->array_action($Info, $cache_array);
        }
        $Job['now'] = date("Y-m-d H:i:s");
        $data['job_name'] = $Job['jobname'];
        $data['industry_class'] = $Job['job_hy'];
        $data['job_class'] = $Job['job_class_one'] . "," . $Job['job_class_two'] . "," . $Job['job_class_three'];
        $data['job_desc'] = $this->GET_content_desc($Job['description']);
        $this->data = $data;
        $this->yunset("Info", $Job);
        $this->seo("recommend");
//		$this->yun_tpl(array('recommend'));
        $this->yun_tpl(array('recommend_job'));
    }

    function send_email_job_action()
    {
        $this->yun_tpl(array('send_email_job'));
    }
}

?>