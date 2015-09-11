<?php

//error_reporting('E_ALL ^E_NOTICE ^E_WARNING');

/*
* $Author ：PHPYUN开发团队
*
* 官网: http://www.phpyun.com
*
* 版权所有 2009-2015 宿迁鑫潮信息技术有限公司，并保留所有权利。
*
* 软件声明：未经授权前提下，不得用于商业运营、二次开发以及任何形式的再次发布。
 */

class common
{
    public $tpl = '';
    public $db = '';
    public $obj = '';
    public $config = '';
    public $uid = "";
    public $data = "";
    public $username = "";
    public $usertype = "";
    public $dirname = "";

    function common($tpl, $db, $def = "", $model = "index", $m = "")
    {
        global $config;
        $this->config = $config;
        $this->tpl = $tpl;
        $this->db = $db;
        $this->username = $_COOKIE['username'];
        $this->usertype = $_COOKIE['usertype'];
        $this->def = $def;
        $this->m = $m;
        require(APP_PATH . 'app/public/action.class.php');
        $this->obj = new model($this->db, $def);
        if ($_COOKIE['uid']) {
            $shell = $this->GET_user_shell($_COOKIE['uid'], $_COOKIE['shell']);

            if (!is_array($shell) || empty($shell)) {
                $this->unset_cookie();
                $this->uid = '';
            } else {
                $this->uid = intval($_COOKIE['uid']);
                $this->yunset("uid", intval($_COOKIE['uid']));
                $this->yunset("usertype", intval($_COOKIE['usertype']));
            }
        } else {
            $this->uid = '';
        }

        $path['style'] = $this->config['sy_weburl'] . "/app/template/" . $this->config['style'];
        $path['client'] = $this->config['sy_weburl'] . "/about";
        $path['tplstyle'] = TPL_PATH . $this->config['style'];
        $path['tpldir'] = $this->tpl->template_dir;
        $path['ask_style'] = $this->config['sy_weburl'] . "/app/template/ask";
        $path['askstyle'] = TPL_PATH . "ask";
        $path['friendstyle'] = TPL_PATH . "friend";
        $path['friend_style'] = $this->config['sy_weburl'] . "/app/template/friend";
        $path['adminstyle'] = TPL_PATH . "admin";
        $path['wap_style'] = $this->config['sy_weburl'] . "/app/template/wap";
        $path['userstyle'] = TPL_PATH . "member/user";
        $path['user_style'] = $this->config['sy_weburl'] . "/app/template/member/user";
        $path['comstyle'] = TPL_PATH . "member/com";
        $path['com_style'] = $this->config['sy_weburl'] . "/app/template/member/com";
        $path['wapstyle'] = TPL_PATH . "wap";
        $path['plusstyle'] = $this->config['sy_weburl'] . "/data/plus";
        $path['cookie'] = $_COOKIE;
        $this->yunset($path);

        if (!($this->config['sy_wapdomain'])) {
            $this->yunset("config_wapdomain", $this->config['sy_weburl'] . '/' . $this->config['sy_wapdir']);
        } else {
            if (strpos($this->config['sy_wapdomain'], "http://") === false) {
                $this->config['sy_wapdomain'] = "http://" . $this->config['sy_wapdomain'];

            }

            $this->yunset("config_wapdomain", $this->config['sy_wapdomain']);
        }

        $this->yunset("config", $this->config);

        $this->$model();

        if (!file_exists(PLUS_PATH . "config.php")) {
            $this->web_config();
        }

        $this->job_auto();
        $this->subscribe();
        if ($this->uid) {
            $this->im();
        }

    }

    function DoException()
    {
        $this->ACT_msg("index.php", "您请求的页面不存在！");
    }

    function yuntpl($tplarr = array())
    {
        if (is_array($tplarr) && $tplarr != '') {
            foreach ($tplarr as $v) {
                $this->tpl->display($v . ".htm");
            }
        } else {
            echo "模版不能为空！";
            die;
        }
    }

    function yun_tpl($tplarr = array())
    {
        if (is_array($tplarr) && $tplarr != '') {
            foreach ($tplarr as $v) {
                $rand = mktime();
                $this->tpl->display($this->config['style'] . "/" . $this->m . "/" . $v . ".htm");
            }
        } else {
            echo "模版不能为空！";
            die;
        }
    }

    function add_cookie($uid, $username, $salt, $email, $pass, $type, $expire = "1")
    {
        if ($this->config['sy_onedomain'] != "") {
            $weburl = get_domain($this->config['sy_onedomain']);
        } else {
            $weburl = get_domain($this->config['sy_weburl']);
        }
        if ($expire == '7') {
            $expire_date = 7 * 86400;
        } else {
            $expire_date = 86400;
        }
        if ($this->config['sy_web_site'] == "1") {
            SetCookie("uid", $uid, time() + $expire_date, "/", $weburl);
            SetCookie("username", $username, time() + $expire_date, "/", $weburl);
            SetCookie("salt", $salt, time() + $expire_date, "/", $weburl);
            SetCookie("email", $email, time() + $expire_date, "/", $weburl);
            SetCookie("shell", md5($username . $pass . $salt), time() + $expire_date, "/", $weburl);
            SetCookie("usertype", $type, time() + $expire_date, "/", $weburl);
        } else {
            SetCookie("uid", $uid, time() + $expire_date, "/");
            SetCookie("username", $username, time() + $expire_date, "/");
            SetCookie("salt", $salt, time() + $expire_date, "/");
            SetCookie("email", $email, time() + $expire_date, "/");
            SetCookie("shell", md5($username . $pass . $salt), time() + $expire_date, "/");
            SetCookie("usertype", $type, time() + $expire_date, "/");
        }
        $this->remind_msg($uid, $type, $weburl, "1");
    }

    function addcookie($name, $value, $time)
    {
        if ($this->config['sy_onedomain'] != "") {
            $weburl = get_domain($this->config['sy_onedomain']);
        } else {
            $weburl = get_domain($this->config['sy_weburl']);
        }
        if ($this->config['sy_web_site'] == "1") {

            SetCookie($name, $value, $time, "/", $weburl);
        } else {
            SetCookie($name, $value, $time, "/", $weburl);
        }
    }

    function remind_msg($uid, $usertype, $weburl = '', $login = '', $cookietype = '')
    {
        $num = 0;
        if ($_COOKIE['friend_message' . $usertype] == "" || $login == 1 || $cookietype == 'friend_message' . $usertype) {
            $friend_message = $this->obj->DB_select_num("friend_message", "`fid`='" . $uid . "' and `remind_status`='0'");
            if ($this->config['sy_web_site'] == "1") {
                $this->msgcookie("friend_message" . $usertype, $friend_message, time() + 3600, "/", $weburl);
            } else {
                $this->msgcookie("friend_message" . $usertype, $friend_message, time() + 3600, "/");
            }
        }
        if ($_COOKIE['sysmsg' . $usertype] == "" || $login == 1 || $cookietype == 'sysmsg' . $usertype) {
            $message = $this->obj->DB_select_num("sysmsg", "`fa_uid`='" . $uid . "' and `remind_status`='0'");
            if ($this->config['sy_web_site'] == "1") {
                $this->msgcookie("sysmsg" . $usertype, $message, time() + 3600, "/", $weburl);
            } else {
                $this->msgcookie("sysmsg" . $usertype, $message, time() + 3600, "/");
            }
        }
        if ($usertype == "1") {
            if ($_COOKIE['userid_msg'] == "" || $login == 1 || $cookietype == 'userid_msg') {
                $userid_msg = $this->obj->DB_select_num("userid_msg", "`uid`='" . $uid . "' and `is_browse`='1'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("userid_msg", $userid_msg, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("userid_msg", $userid_msg, time() + 3600, "/");
                }
            }
            if ($_COOKIE['usermsg'] == "" || $login == 1 || $cookietype == 'usermsg') {
                $msg = $this->obj->DB_select_num("msg", "`uid`='" . $uid . "' and `user_remind_status`='0'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("usermsg", $msg, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("usermsg", $msg, time() + 3600, "/");
                }
            }
        } elseif ($usertype == "2") {
            if ($_COOKIE['userid_job'] == "" || $login == 1 || $cookietype == 'userid_job') {
                $userid_job = $this->obj->DB_select_num("userid_job", "`com_id`='" . $uid . "' and `is_browse`='1'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("userid_job", $userid_job, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("userid_job", $userid_job, time() + 3600, "/");
                }
            }
            if ($_COOKIE['commsg'] == "" || $login == 1 || $cookietype == 'commsg') {
                $msg = $this->obj->DB_select_num("msg", "`job_uid`='" . $uid . "' and `com_remind_status`='0'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("commsg", $msg, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("commsg", $msg, time() + 3600, "/");
                }
            }
        } elseif ($usertype == "3") {
            if ($_COOKIE['userid_job3'] == "" || $login == 1 || $cookietype == 'userid_job3') {
                $userid_job = $this->obj->DB_select_num("userid_job", "`com_id`='" . $uid . "' and `is_browse`='1'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("userid_job3", $userid_job, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("userid_job3", $userid_job, time() + 3600, "/");
                }
            }
            if ($_COOKIE['entrust'] == "" || $login == 1 || $cookietype == 'entrust') {
                $entrust = $this->obj->DB_select_num("entrust", "`lt_uid`='" . $uid . "' and `remind_status`='0'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("entrust", $entrust, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("entrust", $entrust, time() + 3600, "/");
                }
            }
            if ($_COOKIE['commsg3'] == "" || $login == 1 || $cookietype == 'commsg3') {
                $msg = $this->obj->DB_select_num("msg", "`job_uid`='" . $uid . "' and `com_remind_status`='0'");
                if ($this->config['sy_web_site'] == "1") {
                    $this->msgcookie("commsg3", $msg, time() + 3600, "/", $weburl);
                } else {
                    $this->msgcookie("commsg3", $msg, time() + 3600, "/");
                }
            }
        }
        $num = $num + $_COOKIE['friend_message' . $usertype];
        $num = $num + $_COOKIE['sysmsg' . $usertype];
        if ($usertype == 1) {
            $num = $num + $_COOKIE['userid_msg'];
            $num = $num + $_COOKIE['usermsg'];
        } elseif ($usertype == 2) {
            $num = $num + $_COOKIE['commsg'];
            $num = $num + $_COOKIE['userid_job'];
        }
        if ($this->config['sy_web_site'] == "1") {
            $this->msgcookie("remind_num", $num, time() + 3600, "/", $weburl);
        } else {
            $this->msgcookie("remind_num", $num, time() + 3600, "/");
        }
        $time = (time() - strtotime(date("Y-m-d"))) % 1800;
        if ($time == "0") {
            if ($this->config['sy_web_site'] == "1") {
                SetCookie("friend_message" . $usertype, "", time() - 3600, "/", $weburl);
                SetCookie("sysmsg" . $usertype, "", time() - 3600, "/", $weburl);
                SetCookie("userid_msg", "", time() - 3600, "/", $weburl);
                SetCookie("usermsg", "", time() - 3600, "/", $weburl);
                SetCookie("userid_job", "", time() - 3600, "/", $weburl);
                SetCookie("commsg", "", time() - 3600, "/");
                SetCookie("userid_job3", "", time() - 3600, "/", $weburl);
                SetCookie("entrust", "", time() - 3600, "/", $weburl);
                SetCookie("commsg3", "", time() - 3600, "/", $weburl);
                SetCookie("remind_num", "", time() - 3600, "/", $weburl);
                SetCookie("message", "", time() - 3600, "/", $weburl);
                SetCookie("sign_up", "", time() - 3600, "/", $weburl);
            } else {
                SetCookie("friend_message" . $usertype, "", time() - 3600, "/");
                SetCookie("sysmsg" . $usertype, "", time() - 3600, "/");
                SetCookie("userid_msg", "", time() - 3600, "/");
                SetCookie("usermsg", "", time() - 3600, "/");
                SetCookie("userid_job", "", time() - 3600, "/");
                SetCookie("commsg", "", time() - 3600, "/");
                SetCookie("userid_job3", "", time() - 3600, "/");
                SetCookie("entrust", "", time() - 3600, "/");
                SetCookie("commsg3", "", time() - 3600, "/");
                SetCookie("remind_num", "", time() - 3600, "/");
                SetCookie("message", "", time() - 3600, "/");
                SetCookie("sign_up", "", time() - 3600, "/");
            }
        }
    }

    function msgcookie($var, $value = '', $time = 0, $path = '', $domain = '', $s = false)
    {
        $_COOKIE[$var] = $value;
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                setcookie($var . '[' . $k . ']', $v, $time, $path, $domain, $s);
            }
        } else {
            setcookie($var, $value, $time, $path, $domain, $s);
        }
        $this->yunset("cookie", $_COOKIE);
    }

    function unset_remind($cooke, $usertype)
    {
        if ($this->config['sy_onedomain'] != "") {
            $weburl = get_domain($this->config['sy_onedomain']);
        } else {
            $weburl = get_domain($this->config['sy_weburl']);
        }
        $this->remind_msg($this->uid, $usertype, $weburl, "", $cooke);
    }

    function uc_edit_pw($post, $old = "1", $url)
    {
        $old_info = $this->obj->DB_select_once("member", "`uid`='" . $post['uid'] . "'", "`name_repeat`,`username`");
        if ($post['password'] != "") {
            if ($this->config['sy_uc_type'] == "uc_center" && $old_info['name_repeat'] != "1") {
                $this->uc_open();
                $ucresult = uc_user_edit($old_info['username'], $post['oldpw'], $post['password'], $post['email'], $old);
                if ($ucresult == -1) {
                    $msg = '旧密码不正确';
                } elseif ($ucresult == -4) {
                    $msg = 'Email 格式有误';
                } elseif ($ucresult == -5) {
                    $msg = 'Email 不允许注册';
                } elseif ($ucresult == -6) {
                    $msg = '该 Email 已经被注册';
                }
                if ($msg != "") {
                    $this->ACT_msg($url, $msg = $msg);
                }
            } else {
                $salt = substr(uniqid(rand()), -6);
                $pass = md5(md5($post['password']) . $salt);
                $where = "`password`='$pass',`salt`='$salt',";
            }
        }
        if (is_array($post)) {
            foreach ($post as $k => $v) {
                if ($k != "password" && $k != "oldpw") {
                    $where .= "`$k`='$v',";
                }
            }
            $where .= "`username`='" . $old_info['username'] . "'";
        }
        $nid = $this->obj->DB_update_all("member", $where, "`uid`='" . $post['uid'] . "'");
        return $nid;
    }

    function unset_cookie()
    {
        if ($this->config['sy_onedomain'] != "") {
            $weburl = get_domain($this->config['sy_onedomain']);
        } else {
            $weburl = get_domain($this->config['sy_weburl']);
        }
        if ($this->config['sy_web_site'] == "1") {
            SetCookie("uid", "", time() - 604800, "/", $weburl);
            SetCookie("username", "", time() - 604800, "/", $weburl);
            SetCookie("salt", "", time() - 604800, "/", $weburl);
            SetCookie("email", "", time() - 604800, "/", $weburl);
            SetCookie("shell", "", time() - 604800, "/", $weburl);
            SetCookie("usertype", "", time() - 604800, "/", $weburl);
            SetCookie("friend_message1", "", time() - 3600, "/", $weburl);
            SetCookie("friend_message2", "", time() - 3600, "/", $weburl);
            SetCookie("friend_message3", "", time() - 3600, "/", $weburl);
            SetCookie("friend_message4", "", time() - 3600, "/", $weburl);
            SetCookie("sysmsg1", "", time() - 3600, "/", $weburl);
            SetCookie("sysmsg2", "", time() - 3600, "/", $weburl);
            SetCookie("sysmsg3", "", time() - 3600, "/", $weburl);
            SetCookie("sysmsg4", "", time() - 3600, "/", $weburl);
            SetCookie("userid_msg", "", time() - 3600, "/", $weburl);
            SetCookie("usermsg", "", time() - 3600, "/", $weburl);
            SetCookie("userid_job", "", time() - 3600, "/", $weburl);
            SetCookie("commsg", "", time() - 3600, "/");
            SetCookie("userid_job3", "", time() - 3600, "/", $weburl);
            SetCookie("entrust", "", time() - 3600, "/", $weburl);
            SetCookie("commsg3", "", time() - 3600, "/", $weburl);
            SetCookie("remind_num", "", time() - 3600, "/", $weburl);
            SetCookie("message", "", time() - 3600, "/", $weburl);
            SetCookie("sign_up", "", time() - 3600, "/", $weburl);
            SetCookie("lookjob", "", time() - 3600, "/", $weburl);
            SetCookie("lookresume", "", time() - 3600, "/", $weburl);
            SetCookie("favjob", "", time() - 3600, "/", $weburl);
            SetCookie("talentpool", "", time() - 3600, "/", $weburl);
            SetCookie("useridjob", "", time() - 3600, "/", $weburl);
            SetCookie("useridmsg", "", time() - 3600, "/", $weburl);
        } else {
            SetCookie("uid", "", time() - 604800, "/");
            SetCookie("username", "", time() - 604800, "/");
            SetCookie("salt", "", time() - 604800, "/");
            SetCookie("email", "", time() - 604800, "/");
            SetCookie("shell", "", time() - 604800, "/");
            SetCookie("usertype", "", time() - 604800, "/");
            SetCookie("friend_message1", "", time() - 3600, "/");
            SetCookie("friend_message2", "", time() - 3600, "/");
            SetCookie("friend_message3", "", time() - 3600, "/");
            SetCookie("friend_message4", "", time() - 3600, "/");
            SetCookie("sysmsg1", "", time() - 3600, "/");
            SetCookie("sysmsg2", "", time() - 3600, "/");
            SetCookie("sysmsg3", "", time() - 3600, "/");
            SetCookie("sysmsg4", "", time() - 3600, "/");
            SetCookie("userid_msg", "", time() - 3600, "/");
            SetCookie("usermsg", "", time() - 3600, "/");
            SetCookie("userid_job", "", time() - 3600, "/");
            SetCookie("commsg", "", time() - 3600, "/");
            SetCookie("userid_job3", "", time() - 3600, "/");
            SetCookie("entrust", "", time() - 3600, "/");
            SetCookie("commsg3", "", time() - 3600, "/");
            SetCookie("remind_num", "", time() - 3600, "/");
            SetCookie("message", "", time() - 3600, "/");
            SetCookie("sign_up", "", time() - 3600, "/");
            SetCookie("lookjob", "", time() - 3600, "/");
            SetCookie("lookresume", "", time() - 3600, "/");
            SetCookie("favjob", "", time() - 3600, "/");
            SetCookie("talentpool", "", time() - 3600, "/");
            SetCookie("useridjob", "", time() - 3600, "/");
            SetCookie("useridmsg", "", time() - 3600, "/");
        }
    }

    function yunset($name, $value = null)
    {
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->tpl->assign($k, $v);
            }
        } else {
            $this->tpl->assign($name, $value);
        }
    }

    function city_info($city, $city_name)
    {
        if (is_array($city)) {
            foreach ($city as $key => $value) {
                $city_area[] = array("id" => $value, "name" => $city_name[$value]);
            }
            return $city_area;
        }
    }

    function integrated()
    {
        $city_area = $this->obj->DB_select_all("city_class", "`keyid`='0'");
        return $city_area;
    }

    function admin()
    {
        $r = $this->get_admin_user_shell();
        if (!$_SESSION['pytoken']) {
            $_SESSION['pytoken'] = substr(md5(uniqid() . $_SESSION['auid'] . $_SESSION['ausername'] . $_SESSION['ashell']), 8, 12);
        }
        if ($_POST) {
            if ($_POST['pytoken'] != $_SESSION['pytoken']) {
                $this->ACT_layer_msg("来源地址非法！", 3, $this->config['sy_weburl']);
            }
            unset($_POST['pytoken']);
        }
        $this->yunset('pytoken', $_SESSION['pytoken']);
    }

    function company()
    {
        $this->tpl->is_fun();
        $company = $this->obj->DB_select_once("company", "`uid`='" . (int)$_GET['id'] . "'", "`name`,`content`");
        $data['company_name'] = $company['name'];
        $data['company_name_desc'] = $company['content'];
        if ($_GET['nid']) {
            $news = $this->obj->DB_select_once("company_news", "`id`='" . (int)$_GET['nid'] . "'", "`title`");
            $data['company_news'] = $news['title'];
        }
        if ($_GET['pid']) {
            $product = $this->obj->DB_select_once("company_product", "`id`='" . (int)$_GET['pid'] . "'", "`title`");
            $data['company_product'] = $product['title'];
        }
        $this->data = $data;
    }

    function friend()
    {
        if ($this->config['sy_friend_web'] == "2") {
            header("location:" . $this->config['sy_weburl'] . "/" . Url('error'));
        }
        $shell = $this->GET_user_shell($this->uid, $_COOKIE['shell']);
        if (!is_array($shell)) {
            $this->ACT_msg("../index.php", "请先登录!");
        }
    }

    function appadmin()
    {
        $this->get_appadmin_source();
    }

    function im()
    {
        $uiddir = DATA_PATH . "cache/im/";
        if (file_exists($uiddir . "/status.php")) {
            include($uiddir . "/status.php");
        }
        $liststatus = unserialize(base64_decode($statusdata));
        if (empty($liststatus[$this->uid])) {
            $liststatus[$this->uid] = "1";
            $liststatus[$this->uid . "time"] = time();
        } else {
            $liststatus[$this->uid . "time"] = time();
        }
        foreach ($liststatus as $key => $val) {
            if (strstr($key, "time")) {
                if ((time() - intval($val)) > 10 * 60) {
                    unset($liststatus[str_replace("time", "", $key)]);
                    unset($liststatus[$key]);
                }
            }
        }
        $content = base64_encode(serialize($liststatus));
        $cont = "<?php";
        $cont .= "\r\n";
        $cont .= "\$statusdata='" . $content . "';";
        $cont .= "?>";
        $fp = @fopen($uiddir . "/status.php", "w+");
        $filetouid = @fwrite($fp, $cont);
        @fclose($fp);

        $this->yunset("liststatus", $liststatus);
        $this->yunset("thisstatus", $liststatus[$this->uid]);
        return $liststatus;
    }

    function index()
    {

        $this->tpl->is_fun();
        if ($this->config['sy_web_site'] == "1") {
            include(PLUS_PATH . "city.cache.php");
            include(PLUS_PATH . "domain_cache.php");
            if (is_array($site_domain)) {
                foreach ($site_domain as $d) {
                    if ($d['type'] == 1) {
                        $indexsite[] = $d;
                    }
                }
            }
            $this->yunset("citycache", $city_name);
            $this->yunset("indexsite", $indexsite);

            $this->yunset('config', $this->config);
        }

        $qq = @explode(",", $this->config['sy_qq']);
        $this->yunset("qq", $qq);
        $site_url = $this->config['sy_weburl'] . "/" . Url('index', array("c" => "site"), "1");
        $this->yunset("site_url", $site_url);
    }

    function wap_member()
    {

        if ($this->config['sy_wap_web'] == "2") {
            header("location:" . $this->config['sy_weburl']);
        }
        $UA = strtoupper($_SERVER['HTTP_USER_AGENT']);
        if (strpos($UA, 'WINDOWS NT') !== false) {
            header("location:" . Url('index', array('c' => 'wap')));
        }
        if (!$this->uid || !$this->username) {
            $this->unset_cookie();
            $this->wapheaderLayer('index.php?m=login&', '请先登录！');
            $data['msg'] = '请先登录！';
            $data['url'] = Url('wap', array('c' => 'login'));
            $this->yunset("layer", $data);
        } else {

            $shell = $this->GET_user_shell($this->uid, $_COOKIE['shell']);

            if (!is_array($shell)) {

                $this->unset_cookie();
                $data['msg'] = '你无权操作，请重新登录！';
                $data['url'] = Url('wap', array('c' => 'login'));
                $this->yunset("layer", $data);
            } else {

                $this->yunset("uid", $this->uid);
                $this->yunset("username", $this->username);
            }
        }
    }

    function member()
    {
        $this->tpl->is_fun();
        if (!$this->uid && !$this->username) {
            $login = Url("login", array("usertype" => "1"), "1");
            $this->ACT_msg($login, "请先登录");
        } else {
            $shell = $this->GET_user_shell($this->uid, $_COOKIE['shell']);
            if (!is_array($shell)) {
                $this->ACT_msg("../index.php", "你无权操作，请重新登录");
            } else {
                if ($_COOKIE['usertype'] == 2 || $_COOKIE['usertype'] == 3) {
                    if ($_COOKIE['usertype'] == 2) {
                        $this->obj->DB_update_all("company_job", "`state`='2'", "`edate`<'" . time() . "' and `uid`='" . $this->uid . "' and `state`<>'2'");
                    }
                }
            }
        }
        $this->yunset("uid", $this->uid);
        $this->yunset("username", $this->username);
        $this->yunset("useremail", $_COOKIE['email']);
    }

    function upload_pic($dir = "../data/upload/news/", $water = "", $size = "")
    {
        include(PLUS_PATH . "/config.php");
        include_once(LIB_PATH . "upload.class.php");
        $config["watermark_online"] ? $addwatermark = true : $addwatermark = false;
        if ($watermark_site == "10") {
            $watermark_site = rand(1, 9);
        }
        $paras["upfiledir"] = $dir;
        if ($size) {
            $paras["maxsize"] = $size;
        }
        $paras["addpreview"] = false;
        $upload = new Upload($paras);
        return $upload;
    }

    function web_config()
    {
        $config = $this->obj->DB_select_all('admin_config');
        if (is_array($config)) {
            foreach ($config as $v) {
                $configarr[$v['name']] = $v['config'];
            }
        }
        $configarr['autodate'] = $this->config['autodate'];
        made_web(PLUS_PATH . 'config.php', ArrayToString($configarr), 'config');
        if (!file_exists(PLUS_PATH . 'pimg_cache.php')) {
            $this->advertise_cache();
        }
    }

    function advertise_cache()
    {
        include_once(APP_PATH . 'admin/model/model/advertise_class.php');
        $adver = new advertise($this->obj);
        $adver->model_ad_arr_action();
    }

    function send_email($email = array(), $emailtitle = "", $emailcoment = "", $emailalert = false, $userinfo = array())
    {
        if ($this->config["sy_smtpserver"] == "" || $this->config["sy_smtpemail"] == "" || $this->config["sy_smtpuser"] == "") {
            $this->obj->get_admin_msg($_SERVER['HTTP_REFERER'], "还没有配置邮箱，请联系管理员！");
        }
        $smtp = $this->email_set();
        $smtpusermail = $this->config["sy_smtpemail"];
        $sendok = 0;
        $sendno = 0;
        if (is_array($email)) {
            foreach ($email as $key => $v) {
                $sendid = $smtp->sendmail($v, $smtpusermail, $emailtitle, $emailcoment);
                if ($sendid) {
                    $state = 1;
                    $sendok++;
                } else {
                    $state = 0;
                    $sendno++;
                }
                $content = str_replace(array("&amp;", "background-color:#ffffff", "background-color:#fff", "white-space:nowrap;"), array("&", 'background-color:', 'background-color:', 'white-space:'), html_entity_decode($emailcoment, ENT_QUOTES, "GB2312"));
                $this->MODEL()->insert_into("email_msg", array('uid' => $key, 'name' => $userinfo[$key], 'cuid' => $userinfo['cuid'], 'cname' => $userinfo[$userinfo['cuid']], 'email' => $v, 'title' => $emailtitle, 'content' => $content, 'state' => $state, 'ctime' => time()));
            }
        }
        if ($emailalert) {
            $this->ACT_layer_msg($sendok . "位发送成功，" . $sendno . "位发送失败！", 1, $_SERVER['HTTP_REFERER']);
        } else {
            return $sendok;
        }
    }

    function send_ceshi_email($email, $emailtitle = "", $emailcoment = "", $emailalert = false)
    {
        if ($this->config["sy_smtpserver"] == "" || $this->config["sy_smtpemail"] == "" || $this->config["sy_smtpuser"] == "") {
            $data['msg'] = yun_iconv('gbk', 'utf-8', '还没有配置邮箱，请联系管理员！');
            $data['type'] = '8';
        }
        $smtp = $this->email_set();
        $smtpusermail = $this->config["sy_smtpemail"];
        $sendid = $smtp->sendmail($email, $smtpusermail, $emailtitle, $emailcoment);
        if ($sendid) {
            $data['msg'] = yun_iconv('gbk', 'utf-8', '测试发送成功！');
            $data['type'] = '9';
        } else {
            $data['msg'] = yun_iconv('gbk', 'utf-8', '测试发送失败！');
            $data['type'] = '8';
        }
        echo json_encode($data);
    }

    function send_message($uidarr = array(), $title = "", $content = "", $messagealert = false, $user = "admin")
    {
        if (is_array($uidarr)) {
            foreach ($uidarr as $v) {
                $data = array('uid' => $v, 'title' => $title, 'content' => $content, 'status' => 0, 'user' => $user, 'ctime' => time());
                $insert_id = $this->MODEL()->insert_into('message', $data);
            }
            if ($messagealert) {
                $this->ACT_layer_msg("发送成功！", 9, $_SERVER['HTTP_REFERER']);
            } else {
                return $insert_id;
            }
        } else {
            $this->ACT_layer_msg("参数有误，请检查参数！", 8, $_SERVER['HTTP_REFERER']);
        }
    }

    function sqjobmsg($jobid, $comid)
    {
        $comarr = $this->obj->DB_select_once("company_job", "`id`='" . $jobid . "' and `r_status`<>'2' and `status`<>'1'");
        $uid = $this->obj->DB_select_once("company", "`uid`='$comid'", "linkmail,linktel,`name`");
        $data = array('uid' => $comid, 'name' => $uid['name'], 'cuid' => $this->uid, 'cname' => $this->username, 'type' => 'sqzw', 'jobname' => $comarr['name'], 'date' => date("Y-m-d"));
        if ($this->config['sy_msg_sqzw'] == '1' && $uid["linktel"] && $this->config["sy_msguser"] && $this->config["sy_msgpw"] && $this->config["sy_msgkey"]) {
            $data["moblie"] = $uid["linktel"];
        }
        if ($this->config['sy_email_sqzw'] == '1' && $uid["linkmail"] && $this->config["sy_smtpserver"] && $this->config["sy_smtpemail"] && $this->config["sy_smtpuser"]) {
            $data["email"] = $uid["linkmail"];
        }
        if ($data["email"] || $data["moblie"]) {
            $this->send_msg_email($data);
        }
    }

    function header_desc($title = "", $keyword = "", $description = "")
    {
        $this->yunset("title", $title);
        $this->yunset("keywords", $keyword);
        $this->yunset("description", $description);
    }

    function get_page($table, $where = "", $pageurl = "", $limit = 20, $field = "*", $rowsname = "rows", $pagenavname = "pagenav")
    {
        $rows = array();
        $page = $_GET['page'] < 1 ? 1 : $_GET['page'];
        $ststrsql = ($page - 1) * $limit;
        $num = $this->obj->DB_select_num($table, $where);
        $this->yunset("total", $num);
        if ($num > $limit) {
            $pages = ceil($num / $limit);
            $pagenav = Page($page, $num, $limit, $pageurl, $notpl = false, $this->tpl, $pagenavname);
            $this->yunset("pages", $pages);
        }
        $rows = $this->obj->DB_select_all($table, "$where limit $ststrsql,$limit", $field);
        $this->yunset($rowsname, $rows);
        return $rows;
    }

    function array_action($job_info, $array = array())
    {
        if (!empty($array)) {
            $comclass_name = $array["comclass_name"];
            $city_name = $array["city_name"];
            $job_name = $array["job_name"];
            $industry_name = $array["industry_name"];
        } else {
            include PLUS_PATH . "/city.cache.php";
            include PLUS_PATH . "/com.cache.php";
            include PLUS_PATH . "/job.cache.php";
            include PLUS_PATH . "/industry.cache.php";
        }
        $job_info['exp_info'] = $comclass_name[$job_info['exp']];
        $job_info['edu_info'] = $comclass_name[$job_info['edu']];
        $job_info['age_info'] = $comclass_name[$job_info['age']];
        $job_info['salary_info'] = $comclass_name[$job_info['salary']];
        $job_info['number_info'] = $comclass_name[$job_info['number']];
        $job_info['mun_info'] = $comclass_name[$job_info['mun']];
        $job_info['sex_info'] = $comclass_name[$job_info['sex']];
        $job_info['type_info'] = $comclass_name[$job_info['type']];
        $job_info['marriage_info'] = $comclass_name[$job_info['marriage']];
        $job_info['report_info'] = $comclass_name[$job_info['report']];
        $job_info['prv_info'] = $city_name[$job_info['provinceid']];
        $job_info['comprv_info'] = $city_name[$job_info['com_provinceid']];
        $job_info['prov_info'] = $city_name[$job_info['prov']];
        $job_info['cty_info'] = $city_name[$job_info['city']];
        $job_info['pr_info'] = $comclass_name[$job_info['pr']];
        $job_info['city_info'] = $city_name[$job_info['cityid']];
        $job_info['city2_info'] = $city_name[$job_info['three_cityid']];
        $job_info['three_info'] = $city_name[$job_info['three_city']];
        $job_info['hy_info'] = $industry_name[$job_info['hy']];
        $job_info['pr_info'] = $comclass_name[$job_info['pr']];
        $job_info['mun_info'] = $comclass_name[$job_info['mun']];
        $job_info['edate'] = date("Y年m月d日", $job_info['edate']);
        if ($job_info['lang'] != "") {
            $lang = @explode(",", $job_info['lang']);
            foreach ($lang as $key => $value) {
                $langinfo[] = $comclass_name[$value];
            }
            $job_info['lang_info'] = @implode(",", $langinfo);
        } else {
            $job_info['lang_info'] = "";
        }
        if ($job_info['welfare'] != "") {
            $welfare = @explode(",", $job_info['welfare']);
            foreach ($welfare as $key => $value) {
                $welfareinfo[] = $comclass_name[$value];
            }
            $job_info['welfare_info'] = @implode(",", $welfareinfo);
        } else {
            $job_info['welfare_info'] = "";
        }
        return $job_info;
    }

    function user_cache()
    {
        include PLUS_PATH . "/user.cache.php";
        $this->yunset("userdata", $userdata);
        $this->yunset("userclass_name", $userclass_name);
    }

    function com_cache()
    {
        include PLUS_PATH . "/com.cache.php";
        $this->yunset("comdata", $comdata);
        $this->yunset("comclass_name", $comclass_name);
    }

    function city_cache()
    {
        include(PLUS_PATH . "city.cache.php");
        $this->yunset("city_type", $city_type);
        $this->yunset("city_index", $city_index);
        $this->yunset("city_name", $city_name);
    }

    function job_cache()
    {
        include(PLUS_PATH . "job.cache.php");
        $this->yunset("job_type", $job_type);
        $this->yunset("job_index", $job_index);
        $this->yunset("job_name", $job_name);
    }

    function industry_cache()
    {
        include(PLUS_PATH . "industry.cache.php");
        $this->yunset("industry_index", $industry_index);
        $this->yunset("industry_name", $industry_name);
    }

    function send_msg_email($data = array(), $smtp = "", $type = '0')
    {
        $tpl = $this->get_email_tpl();
        if ($this->config["sy_email_" . $data["type"]] == 1 && $data["email"]) {
            if ($this->config['sy_smtpserver'] != "" && $this->config['sy_smtpemail'] != "" && $this->config['sy_smtpuser'] != "") {
                $title_tpl = $tpl["email" . $data["type"]]["title"];
                $content_tpl = $tpl["email" . $data["type"]]["content"];
                $to = $data["email"];
                $title = $this->msgemail_tpl($title_tpl, $data);
                $content = $this->msgemail_tpl($content_tpl, $data);
                if ($this->config["sy_email_online"] == 1) {
                    if ($smtp == "") {
                        $smtp = $this->email_set();
                    }
                    if ($this->CheckRegEmail($data['email'])) {
                        $sendid = $smtp->sendmail($to, $this->config["sy_smtpemail"], $title, html_entity_decode($content, ENT_QUOTES, "GB2312"));
                    }
                } else if ($this->config["sy_email_online"] == 2) {
                    if ($this->CheckRegEmail($data['email'])) {
                        $sendid = sendmail($to, $title, $content);
                    }
                }
                $sendid ? $state = 1 : $state = 0;
                if ($this->CheckRegEmail($data['email'])) {
                    $this->MODEL()->insert_into("email_msg", array('uid' => $data['uid'], 'name' => $data['name'], 'cuid' => $data['cuid'], 'cname' => $data['cname'], 'email' => $data['email'], 'title' => $title, 'content' => $content, 'state' => $state));
                }
            } else {
                $this->ACT_layer_msg("还没有配置邮箱，请联系管理员！", 8, $_SERVER['HTTP_REFERER'], 2, $type);
            }
        }
        if ($data["moblie"] && $this->config["sy_msg_" . $data["type"]] == 1) {
            if (!$this->config["sy_msguser"] || !$this->config["sy_msgpw"] || !$this->config["sy_msgkey"]) {
                $this->ACT_layer_msg("还没有配置短信，请联系管理员！", 8, $_SERVER['HTTP_REFERER'], 2, $type);
            } else {
                $msguser = $this->config["sy_msguser"];
                $msgpw = $this->config["sy_msgpw"];
                $msgkey = $this->config["sy_msgkey"];
                $moblie = $data["moblie"];
                $content_tpl = $tpl["msg" . $data["type"]]["content"];
                $content = $this->msgemail_tpl($content_tpl, $data);
                if ($moblie != "") {
                    $status = $this->sendSMS($msguser, $msgpw, $msgkey, $moblie, $content, '', '', $data);
                }
                return $status;
            }
        }
    }

    function sendSMS($uid, $pwd, $key, $mobile, $content, $time = '', $mid = '', $info = array())
    {
        $data_msg["uid"] = $info['uid'];
        $data_msg["name"] = $info['name'];
        $data_msg["cuid"] = $info['cuid'];
        if ($info['cname']) {
            $data_msg["cname"] = $info['cname'];
        } else {
            $data_msg["cname"] = "系统";
        }
        $data_msg["moblie"] = $mobile;
        $data_msg["ctime"] = time();
        $data_msg["content"] = $content;
        $data = array(
            'uid' => $uid,
            'pwd' => strtolower($pwd),
            'key' => $key,
            'mobile' => $mobile,
            'content' => $content,
            'time' => $time,
            'mid' => $mid
        );

        $re = $this->postSMS("msgsend", $data);
        if (trim($re) == '1') {
            $data_msg["state"] = "1";
            $this->MODEL()->insert_into("moblie_msg", $data_msg);
            return "发送成功!";
        } else {
            $result = array("1" => "短信发送成功", "-2" => '用户名密码错误', "-3" => '短信不足', "-4" => '没有可用的手机号码', "-5" => '没有短信内容', "-6" => '没有签名内容', "17" => '发送信息失败', "18" => '发送定时信息失败', "303" => '客户端网络故障', "305" => '服务器端返回错误，错误的返回值（返回值不是数字字符串）', '307' => '目标电话号码不符合规则，电话号码必须是以0、1开头', "997" => '平台返回找不到超时的短信，该信息是否成功无法确定', "998" => '由于客户端网络问题导致信息发送超时，该信息是否成功下发无法确定');
            $data_msg["state"] = "0";
            $this->MODEL()->insert_into("moblie_msg", $data_msg);
            if ($result[$re]) {
                return "发送失败！状态：" . $result[$re];
            } else {
                return "发送失败！状态：" . $re;
            }
        }
    }

    function postSMS($type = "msgsend", $data = '')
    {
        $url = 'http://msg.phpyun.com/send.php';
        $url .= '?user=' . $data['uid'] . '&pass=' . $data['pwd'] . '&code=' . $data['key'] . '&moblie=' . $data['mobile'] . '&content=' . $data['content'] . '&time=' . $data['time'] . '';
        if (function_exists('file_get_contents')) {
            $file_contents = file_get_contents($url);
        } else {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $file_contents = curl_exec($ch);
            curl_close($ch);
        }
        return $file_contents;
    }

    function msgemail_tpl($tpl, $data = array())
    {
        unset($data["type"]);
        unset($data["moblie"]);
        unset($data["emile"]);
        $re = array("{webname}", "{weburl}", "{webtel}");
        $re2[] = $this->config["sy_webname"];
        $re2[] = $this->config["sy_weburl"];
        $re2[] = $this->config["sy_webtel"];
        $tpl = str_replace($re, $re2, $tpl);
        foreach ($data as $k => $v) {
            $tpl = str_replace("{" . $k . "}", $v, $tpl);
        }
        return $tpl;
    }

    function email_set()
    {
        include_once(LIB_PATH . "email.class.php");
        if ($this->config["sy_smtpserverport"] == '25') {
            $smtpserver = $this->config["sy_smtpserver"];
        } else {
            $smtpserver = "ssl://" . $this->config["sy_smtpserver"];
        }

        $smtpserverport = $this->config["sy_smtpserverport"];
        $smtpusermail = $this->config["sy_smtpemail"];
        $smtpuser = $this->config["sy_smtpuser"];
        $smtppass = $this->config["sy_smtppass"];
        $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
        return $smtp;
    }

    function logout($result = true)
    {
        $liststatus = '';
        if (file_exists(DATA_PATH . "cache/im/")) {
            $uiddir = DATA_PATH . "cache/im/";
            include($uiddir . "/status.php");
            $liststatus = unserialize(base64_decode($statusdata));
        }

        if (!empty($liststatus[$this->uid])) {
            unset($liststatus[$this->uid]);
            unset($liststatus[$this->uid . "time"]);
        }
        $content = base64_encode(serialize($liststatus));
        $cont = "<?php";
        $cont .= "\r\n";
        $cont .= "\$statusdata='" . $content . "';";
        $cont .= "?>";
        if (file_exists($uiddir . "/status.php"))
            $fp = @fopen($uiddir . "/status.php", "w+");
        $filetouid = @fwrite($fp, $cont);
        @fclose($fp);
        if ($this->config['sy_uc_type'] == "uc_center") {
            $this->uc_open();
            $logout = uc_user_synlogout();
            echo $logout;
        } elseif ($this->config["sy_pw_type"]) {
            include(APP_PATH . "/api/pw_api/pw_client_class_phpapp.php");
            $username = $_SESSION["username"];
            $pw = new PwClientAPI($username, "", "");
            $logout = $pw->logout();
            $this->unset_cookie();
        } else {
            $this->unset_cookie();
        }
        if ($result) {
            echo 1;
            die;
        }
    }

    function del_dir($dir_adds = '', $del_def = 0)
    {
        $result = false;
        if (!is_dir($dir_adds)) {
            return false;
        }
        $handle = opendir($dir_adds);
        while (($file = readdir($handle)) !== false) {
            if ($file != '.' && $file != '..') {
                $dir = $dir_adds . DIRECTORY_SEPARATOR . $file;
                is_dir($dir) ? $this->del_dir($dir) : @unlink($dir);
            }
        }
        closedir($handle);
        if ($del_def == 0) {
            $result = @rmdir($dir_adds) ? true : false;
        } else {
            $result = true;
        }
        return $result;
    }

    function seo($ident, $title = '', $keyword = '', $description = '')
    {
        include PLUS_PATH . "/seo.cache.php";
        $seo = $seo[$ident];
        if (is_array($seo)) {
            foreach ($seo as $k => $v) {
                if ($this->config['did'] != "" && $this->config['did'] == $v['did']) {
                    $fzseo = $v;
                } else {
                    $seo = $v;
                }
            }
            if ($fzseo) {
                $seo = $fzseo;
            }
        }
        $data = $this->data;
        if (is_array($seo)) {
            $cityname = $this->config['cityname'] ? $this->config['cityname'] : $this->config["sy_indexcity"];
            if ($title) {
                $this->config['sy_webname'] = $title;
                $seo['title'] = $title;
            }
            if ($keyword) {
                $this->config['sy_webkeyword'] = $keyword;
                $seo['keywords'] = $keyword;
            }
            if ($description) {
                $this->config['sy_webmeta'] = $description;
                $seo['description'] = $description;
            }
            foreach ($seo as $key => $value) {
                $seo[$key] = str_replace("{webname}", $this->config['sy_webname'], $seo[$key]);
                $seo[$key] = str_replace("{webkeyword}", $this->config['sy_webkeyword'], $seo[$key]);
                $seo[$key] = str_replace("{webdesc}", $this->config['sy_webmeta'], $seo[$key]);
                $seo[$key] = str_replace("{weburl}", $this->config['sy_weburl'], $seo[$key]);
                $seo[$key] = str_replace("{city}", $cityname, $seo[$key]);

                if (is_array($data)) {
                    foreach ($data as $k => $v) {
                        $seo[$key] = str_replace("{" . $k . "}", $v, $seo[$key]);
                    }
                }
                if (!@strpos('{seacrh_class}', $seo[$key])) {
                    $rdata = $this->get_search_class($ident, $key);
                    $seo[$key] = str_replace("{seacrh_class}", $rdata, $seo[$key]);
                }
                $seo[$key] = str_replace('  ', ' ', $seo[$key]);
                $seo[$key] = str_replace(array("-  -", "- -"), '-', $seo[$key]);
                $seo[$key] = str_replace(array("-  -", "- -"), '-', $seo[$key]);
            }
        }
        $this->yunset("title", $seo['title']);
        $this->yunset("keywords", $seo['keywords']);
        $this->yunset("description", mb_substr(str_replace("	", "", str_replace("\r", "", str_replace("\n", "", strip_tags($seo['description'])))), 0, 200, 'gbk'));
    }

    function get_search_class($ident, $type = "title")
    {
        include PLUS_PATH . "/city.cache.php";
        if ($ident == "com_search" || $ident == "part") {
            include PLUS_PATH . "/job.cache.php";
            include PLUS_PATH . "/com.cache.php";
            include PLUS_PATH . "/industry.cache.php";
        }
        if ($ident == "user_search") {
            include PLUS_PATH . "/job.cache.php";
            include PLUS_PATH . "/user.cache.php";
            include PLUS_PATH . "/industry.cache.php";
        }
        foreach ($_GET as $key => $v) {
            switch ($key) {
                case "hy":
                    $data[] = $industry_name[$v];
                    break;
                case "job1":
                case "job1_son":
                case "job_post":
                    $data[] = $job_name[$v];
                    break;
                case "provinceid":
                case "cityid":
                case "three_cityid":
                    $data[] = $city_name[$v];
                    break;
                default:
                    $data[] = is_array($comdata["job_" . $key]) ? $comclass_name[$v] : $userclass_name[$v];
                    break;
            }
        }
        foreach ($data as $key => $val) {
            if ($val) {
                $alldata[] = $val;
            }
        }
        if ($type == "title") {
            $data = @implode('-', $alldata);
        } else {
            $data = @implode(',', $alldata);
        }

        return $data;
    }

    function assignhtm($contents, $id)
    {
        $job_info = $this->obj->DB_select_alls("company_job", "company", "a.`state`='1' and a.`r_status`!=2 and a.`id`='$id' and b.`uid`=a.`uid`", "a.*,b.*,a.name as comname,a.cityid as cityid,a.three_cityid as three_cityid");
        $job_info = $this->array_action($job_info[0]);
        if (is_array($job_info)) {
            foreach ($job_info as $key => $value) {
                $contents = str_replace("{yun:}" . $key . "{/yun}", $value, $contents);
            }
            $contents = str_replace("{yun:}now{/yun}", date("Y-m-d H:i:s"), $contents);
            $contents = str_replace("{yun:}sy_weburl{/yun}", $this->config['sy_weburl'], $contents);
            $contents = str_replace("{yun:}sy_webname{/yun}", $this->config['sy_webname'], $contents);
            $contents = str_replace("{yun:}comurljob{/yun}", Url("job", array("c" => "comapply", "id" => $id), "1"), $contents);
            $contents = str_replace("{yun:}comurl{/yun}", Url('company', array("id" => $job_info[uid])), $contents);
        } else {
            $contents = "";
        }
        return $contents;
    }

    function addkeywords($type, $keyword)
    {
        $M = $this->MODEL();
        $info = $M->DB_select_once('hot_key', "`key_name`='$keyword' AND `type`='$type'");
        if (is_array($info)) {
            $M->DB_update_all('hot_key', "`num`=`num`+1", "`key_name`='" . $keyword . "' and `type`='" . $type . "'");
        } else {
            $M->insert_into('hot_key', array('key_name' => $keyword, 'num' => 1, 'type' => $type, 'check' => 0));
        }
    }

    function addstate($content, $type = 1, $uid = '')
    {
        $uid = $this->uid ? $this->uid : $uid;
        $this->MODEL()->insert_into('friend_state', array('uid' => $uid, 'content' => $content, 'type' => $type, 'ctime' => time()));
    }

    function automsg($content, $uid)
    {
        $M = $this->MODEL();
        $member = $M->DB_select_once('member', "`uid`='" . $uid . "'", '`username`');
        $M->insert_into('sysmsg', array('fa_uid' => $uid, 'content' => $content, 'username' => $member['username'], 'ctime' => time()));
    }

    function picmsg($pic, $url, $type = "")
    {
        $error = array("1" => "文件太大", "2" => "文件类型不符", "3" => "同名文件已经存在", "4" => "移动文件出错,请检查upload目录权限");
        if ($error[$pic] != "") {
            if ($type == "ajax") {
                echo "{";
                echo "url: '" . $pic . "',\n";
                echo "s_thumb: '" . $error[$pic] . "'\n";
                echo "}";
                die;
            } else {
                $this->ACT_layer_msg($msg = $error[$pic], 8, $url);
            }
        } else {
            return true;
        }
    }

    function post_trim($data)
    {
        foreach ($data as $d_k => $d_v) {
            if (is_array($d_v)) {
                $data[$d_k] = $this->post_trim($d_v);
            } else {
                $data[$d_k] = trim($data[$d_k]);
            }
        }
        return $data;
    }

    function get_moblie()
    {
        if ($this->config['sy_wap_web'] == "2") {
            header("location:" . $this->config['sy_weburl']);
        }
        $UA = strtoupper($_SERVER['HTTP_USER_AGENT']);
        if (strpos($UA, 'WINDOWS NT') !== false) {
            header("location:" . Url('index', array('c' => 'wap')));
        }
        $now_url = @explode("/", $_SERVER['REQUEST_URI']);
        $now_url = $now_url[count($now_url) - 1];

        $this->yunset("now_url", $now_url);
    }

    function rightinfo()
    {
        if ($this->uid) {
            if ($_COOKIE['usertype'] == '1') {
                $rightinfo = $this->obj->DB_select_once("resume", "`uid`='" . $this->uid . "'", "`photo`");
                if ($rightinfo['photo'] == '') {
                    $rightinfo['photo'] = $this->config['sy_member_icon'];
                }
                $rightinfo['msgnum'] = $this->obj->DB_select_num("userid_msg", "`uid`='" . $this->uid . "'");
                $rightinfo['expectnum'] = $this->obj->DB_select_num("resume_expect", "`uid`='" . $this->uid . "'");
            } else if ($_COOKIE['usertype'] == '2') {
                $rightinfo = $this->obj->DB_select_once("company", "`uid`='" . $this->uid . "'", "`logo`");
                if ($rightinfo['logo'] == '') {
                    $rightinfo['logo'] = $this->config['sy_unit_icon'];
                }
                $rightinfo['jobnum'] = $this->obj->DB_select_num("company_job", "`uid`='" . $this->uid . "'");
                $rightinfo['sqnum'] = $this->obj->DB_select_num("userid_job", "`com_id`='" . $this->uid . "'");

            }
            $this->yunset("rightinfo", $rightinfo);
        }
    }

    function send_dingyue($id, $type)
    {
        if ($type == "2") {
            $job = $this->obj->DB_select_once("company_job", "`id`='" . $id . "'", "`name`,`hy`,`uid`");
            if ($job['hy'] > 0) {
                $user = $this->obj->DB_select_all("resume", "FIND_IN_SET('" . $job['hy'] . "',hy_dy)", "`email_dy`,`msg_dy`,`email`,`telphone`,`uid`,`name`");
                if (is_array($user) && $user) {
                    foreach ($user as $v) {
                        $data['uid'] = $v['uid'];
                        $data['name'] = $v['name'];
                        $data['type'] = "userdy";
                        $data['jobname'] = $job['name'];
                        if ($v['email_dy'] == "1") {
                            $data['email'] = $v['email'];
                            $this->send_msg_email($data);
                        }
                        if ($v['msg_dy'] == "1") {
                            $data['moblie'] = $v['telphone'];
                            $this->send_msg_email($data);
                        }
                    }
                }
            }
        } else {
            $expect = $this->obj->DB_select_once("resume_expect", "`id`='" . $id . "'", "`hy`,`name`");
            $user = $this->obj->DB_select_all("company", "FIND_IN_SET('" . $expect['hy'] . "',hy_dy)", "`email_dy`,`msg_dy`,`uid`,`email`,`linktel`,`name`");
            if (is_array($user) && $user) {
                foreach ($user as $v) {
                    $data['uid'] = $v['uid'];
                    $data['name'] = $v['name'];
                    $data['type'] = "comdy";
                    $data['resumename'] = $expect['name'];
                    if ($v['email_dy'] == "1") {
                        $data['email'] = $v['email'];
                        $this->send_msg_email($data);
                    }
                    if ($v['msg_dy'] == "1") {
                        $data['moblie'] = $v['linktel'];
                        $this->send_msg_email($data);
                    }
                }
            }
        }
    }

    function layer_msg($msg, $st = '9', $type = '0', $url = '1', $tm = '2')
    {
        if ($type == '1') {
            $this->ACT_layer_msg($msg, $st, $url);
        } else {
            if ($st == 9) {
                $this->admin_log($msg);
            }
            $msg = preg_replace('/\([^\)]+?\)/x', "", str_replace(array("（", "）"), array("(", ")"), $msg));
            $layer_msg['msg'] = yun_iconv("gbk", "utf-8", $msg);
            $layer_msg['tm'] = $tm;
            $layer_msg['st'] = $st;
            $layer_msg['url'] = $url;
            $msg = json_encode($layer_msg);
            echo $msg;
            die;
        }
    }

    function nextexe($value)
    {
        if ($value["type"] == '1' && $value["week"] > 0) {
            $W = date("w", time());
            if ($value["week"] >= $W) {
                $Day = date("Ymd", strtotime("+" . ($value["week"] - $W) . " days", time()));
            } else {
                $Day = date("Ymd", strtotime("+" . ($value["week"] - $W + 7) . " days", time()));
            }
        } elseif ($value['type'] == '2' && $value["month"] > 0) {
            if ($value["month"] < 10) {
                $Day = date('Ym') . "0" . $value["month"];
            } else {
                $Day = date('Ym') . "" . $value["month"];
            }
        } else {
            $Day = date('Ymd');
        }

        $Date = $Day;
        if ($value["hour"] > 0) {
            if ($value["hour"] < 10) {
                $Date .= "0" . $value["hour"];
            } else {
                $Date .= $value["hour"];
            }
        } else {
            $Date .= '00';
        }
        if ($value["minute"] > 0) {
            if ($value["minute"] < 10) {
                $Date .= "0" . $value["minute"];
            } else {
                $Date .= $value["minute"];
            }
        } else {
            $Date .= '00';
        }
        if ($Date <= date('YmdHi')) {
            if ($value["type"] == '1' && $value["week"] > 0) {
                $Dates = date('Ymd', strtotime("+1 week", $Date));

            } elseif ($value['type'] == '2' && $value["month"] > 0) {
                $nextmonth = $this->GetMonth();
                if ($value["month"] < 10) {
                    $Dates = $nextmonth . '0' . $value["month"];
                } else {
                    $Dates = $nextmonth . $value["month"];
                }
            } else {
                $Dates = date('Ymd', strtotime("+1 days", strtotime($Day)));
            }
            if ($value["hour"] > 0) {
                if ($value["hour"] < 10) {
                    $Dates .= '0' . $value["hour"];
                } else {
                    $Dates .= $value["hour"];
                }
            } else {
                $Dates .= "00";
            }

            if ($value["minute"] > 0) {
                if ($value["minute"] < 10) {
                    $Dates .= '0' . $value["minute"];
                } else {
                    $Dates .= $value["minute"];
                }
            } else {
                $Dates .= "00";
            }
            return $Dates;
        } else {
            return $Date;
        }
    }

    function GetMonth()
    {
        $tmp_date = date("Ym");

        $tmp_year = substr($tmp_date, 0, 4);
        $tmp_mon = substr($tmp_date, 4, 2);
        $tmp_nextmonth = mktime(0, 0, 0, $tmp_mon + 1, 1, $tmp_year);
        $tmp_forwardmonth = mktime(0, 0, 0, $tmp_mon - 1, 1, $tmp_year);
        return $fm_next_month = date("Ym", $tmp_nextmonth);
    }

    function CheckAppUser()
    {
        if (isset($_POST["username"]) && isset($_POST["desname"]) && isset($_POST["desword"])) {
            $desname = trim($_POST["desname"]);
            $desword = trim($_POST["desword"]);
            unset($_POST["desname"]);
            unset($_POST["desword"]);
            $User = $this->obj->DB_select_once('member', "`username`='" . $desname . "'", "`salt`,`password`");
        }
        if ($User['password'] && $User['salt'] && (md5(md5($desword) . $User['salt']) == $User['password'])) {
            return $_POST;
        } else {
            $data['error'] = 1008;
            echo json_encode($data);
            exit();
        }
    }

    function app()
    {
        $key = 'a1b2c#4*';
        if ($_POST['safekey']) {
            $String = $_POST['safekey'];

            include_once(LIB_PATH . "des.class.php");
            include_once(LIB_PATH . "desjava.class.php");
            $DesNetKey = new DES_NET($key);

            $DesJavaKey = new DES_JAVA($key, '12345678');

            $SafeNetkey = $DesNetKey->decrypt($String);

            $SafeJavakey = $DesJavaKey->decrypt($String);
            if ($SafeNetkey == $key) {
                $DesKey = $DesNetKey;
                $Safekey = $SafeNetkey;
            } elseif ($SafeJavakey == $key) {
                $Safekey = $SafeJavakey;
                $DesKey = $DesJavaKey;
            }
        }
        if ($Safekey == $key) {
            if ($_POST['desname']) {
                $desname = $DesKey->decrypt($_POST['desname']);
            }
            if ($_POST['desword']) {
                $desword = $DesKey->decrypt($_POST['desword']);
            }
            if ($desname) {
                $_POST['desname'] = $this->stringfilter($desname);
            } else {
                $_POST['desname'] = '';
            }
            if ($desword) {
                $_POST['desword'] = $desword;
            } else {
                $_POST['desword'] = '';
            }
            return true;
        } else {
            echo json_encode(array('error' => '1009' . $Safekey . $_POST['safekey']));
            exit();
        }
    }

    function wapheader($url, $point = '')
    {
        if (!($this->config['sy_wapdomain'])) {
            $sy_wapdomain = $this->config['sy_weburl'] . '/' . $this->config['sy_wapdir'];
        } else {
            if (strpos($this->config['sy_wapdomain'], "http://") === false) {
                $sy_wapdomain = "http://" . $this->config['sy_wapdomain'];
            } else {
                $sy_wapdomain = $this->config['sy_wapdomain'];
            }
        }
        $url = $sy_wapdomain . "/" . $url;
        if ($point != '') {
            $point = 'point=' . $point;
        }
        header('Location: ' . $url . $point);
        exit();
    }

    function wapheaderLayer($url, $point = '')
    {
        if (!($this->config['sy_wapdomain'])) {
            $sy_wapdomain = $this->config['sy_weburl'] . '/' . $this->config['sy_wapdir'];
        } else {
            if (strpos($this->config['sy_wapdomain'], "http://") === false) {
                $sy_wapdomain = "http://" . $this->config['sy_wapdomain'];
            } else {
                $sy_wapdomain = $this->config['sy_wapdomain'];
            }
        }
        $url = $sy_wapdomain . "/" . $url;
        if ($point != '') {
            $point = 'layer=' . $point;
        }
        header('Location: ' . $url . $point);
        exit();
    }

    function check_token()
    {
        if ($_SESSION['pytoken'] != $_GET['pytoken'] || !$_SESSION['pytoken']) {
            unset($_SESSION['pytoken']);
            $this->ACT_layer_msg("来源地址非法！", 8, 'index.php');
            exit();
        }
    }

    function job_auto()
    {
        if ($this->config['autodate'] != date('Ymd')) {
            $sqlCase = "lastupdate = case when autotype = 1  then '" . time() . "' ";
            $sqlCase .= "when autotype = 5 AND lastupdate<=" . (time() - 5 * 86400) . " then  '" . time() . "'  ";
            $sqlCase .= "when autotype = 10 AND lastupdate<=" . (time() - 10 * 86400) . " then  '" . time() . "'  ";
            $sqlCase .= "else lastupdate end";
            $this->obj->DB_update_all('company_job', $sqlCase, "`autotime`>='" . time() . "'");
            $config = $this->obj->DB_select_all("admin_config");
            if (is_array($config)) {
                foreach ($config as $v) {
                    $configarr[$v['name']] = $v['config'];
                }
            }
            if ($config['autodate']) {
                $this->obj->DB_update_all("admin_config", "`config`='" . date('Ymd') . "'", "`name`='autodate'");
            } else {
                $this->obj->DB_insert_once("admin_config", "`config`='" . date('Ymd') . "',`name`='autodate'");
            }
            $configarr['autodate'] = date('Ymd');
            made_web(PLUS_PATH . "config.php", ArrayToString($configarr), "config");
        }
    }

    function insert_company_pay($integral, $pay_state, $uid, $msg, $type, $pay_type = '', $ptype = false)
    {
        if ($integral != '0') {
            $pay['order_id'] = time() . rand(10000, 99999);
            if ($ptype) {
                $pay['order_price'] = $integral;
            } else {
                $pay['order_price'] = '-' . $integral;
            }
            $pay['pay_time'] = time();
            $pay['pay_state'] = $pay_state;
            $pay['com_id'] = $uid;
            $pay['pay_remark'] = $msg;
            $pay['type'] = $type;
            $pay['pay_type'] = $pay_type;
            return $this->obj->insert_into("company_pay", $pay);
        } else {
            return false;
        }
    }

    function insertfinder($para, $id = '', $name = '')
    {
        $data['name'] = $name;
        $data['uid'] = $this->uid;
        $data['para'] = $para;
        $M = $this->MODEL();
        if ($id) {
            $M->member_log("修改搜索器");
            return $M->update_once("finder", $data, "`id`='" . $id . "'");
        } else {
            $data['usertype'] = $_COOKIE['usertype'];
            $data['addtime'] = time();
            $M->member_log("添加搜索器");
            return $M->insert_into("finder", $data);
        }
    }

    function stringfilter($string)
    {
        $str = yun_iconv("utf-8", "gbk", trim($string));

        $regex = "/\\$|\'|\\\|/";
        $str = preg_replace($regex, "", $str);
        return $str;
    }

    function CheckRegUser($str)
    {
        if (!preg_match("/^[" . chr(0xa1) . "-" . chr(0xff) . "a-zA-Z0-9_]+$/", $str)) {
            return false;
        } else {
            return true;
        }
    }

    function CheckRegEmail($email)
    {
        if (!preg_match('/^([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9\-]+@([a-zA-Z0-9\-]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/', $email)) {
            return false;
        } else {
            return true;
        }
    }

    function forsend($data)
    {
        if ($data['usertype'] == '1') {
            $info = $this->obj->DB_select_once("resume", "`uid`='" . $data['uid'] . "'", "`name`,`uid`");
        }
        if ($data['usertype'] == '2') {
            $info = $this->obj->DB_select_once("company", "`uid`='" . $data['uid'] . "'", "`name`,`uid`");
        }
        return $info;
    }

    function get_integral_action($uid, $type, $msg)
    {
        if ($this->config[$type . '_type'] == "1") {
            $auto = true;
        } else {
            $auto = false;
        }
        $this->company_invtal($uid, $this->config[$type], $auto, $msg, true, 2, 'integral');
    }

    function subscribe()
    {
        $time = strtotime(date("Y-m-d"));
        if ($this->config['subscribe_time'] < $time) {
            $subscribe = $this->obj->DB_select_all("subscribe", "status='1'");
            if (is_array($subscribe)) {
                foreach ($subscribe as $v) {
                    $time = 86400 * $v['time'] + $v['ctime'];
                    if ($time < time()) {
                        if ($v['type'] == "1") {
                            $this->select_job($v);
                        } else {
                            $this->select_resume($v);
                        }
                    }
                }
            }
            $config = $this->obj->DB_select_all("admin_config");
            if (is_array($config)) {
                foreach ($config as $v) {
                    $configarr[$v['name']] = $v['config'];
                }
            }
            if ($config['subscribe_time']) {
                $this->obj->DB_update_all("admin_config", "`config`='" . time() . "'", "`name`='subscribe_time'");
            } else {
                $this->obj->DB_insert_once("admin_config", "`config`='" . time() . "',`name`='subscribe_time'");
            }
            $configarr['autodate'] = $this->config['autodate'];
            $configarr['subscribe_time'] = time();
            made_web(PLUS_PATH . "config.php", ArrayToString($configarr), "config");
        }
    }

    function select_job($v)
    {
        $where .= "`state`='1' and `edate`>'" . time() . "' and `job1`='" . $v['job1'] . "' and `job1_son`='" . $v['job1_son'] . "' and `job_post`='" . $v['job_post'] . "' and `provinceid`='" . $v['provinceid'] . "'";
        if ($v['salary'] > "0") {
            $where .= " and `salary`='" . $v['salary'] . "'";
        }
        if ($v['cityid'] > "0") {
            $where .= " and `cityid`='" . $v['cityid'] . "'";
        }
        if ($v['three_cityid'] > "0") {
            $where .= " and `three_cityid`='" . $v['three_cityid'] . "'";
        }
        $job = $this->obj->DB_select_all("company_job", $where . " order by sdate desc limit 5", "name");
        if (!empty($job)) {
            foreach ($job as $val) {
                $name[] = $val['name'];
            }
            $data['jobname'] = @implode(",", $name);
            $data['email'] = $v['email'];
            $data['type'] = "userdy";
            $this->send_msg_email($data);
        }
        $this->obj->DB_update_all("subscribe", "`ctime`='" . time() . "'", "`id`='" . $v['id'] . "'");
    }

    function select_resume($v)
    {
        $where = "a.status<>'2' and a.`r_status`<>'2' and b.`open`='1' and a.`uid`=b.`uid`";
        $where .= " and b.provinceid='" . $v['provinceid'] . "' and FIND_IN_SET('" . $v['job_post'] . "',b.job_classid)";
        if ($v['salary'] > "0") {
            $where .= " and b.`salary`='" . $v['salary'] . "'";
        }
        if ($v['cityid'] > "0") {
            $where .= " and b.`cityid`='" . $v['cityid'] . "'";
        }
        if ($v['three_cityid'] > "0") {
            $where .= " and b.`three_cityid`='" . $v['three_cityid'] . "'";
        }
        $userlist = $this->obj->DB_select_alls("resume", "resume_expect", $where . " order by b.ctime desc limit 5", "b.name");
        if (is_array($userlist)) {
            foreach ($userlist as $val) {
                $name[] = $val['name'];
            }
            $data['resumename'] = @implode(",", $name);
            $data['email'] = $v['email'];
            $data['type'] = "comrdy";
            $this->send_msg_email($data);
        }
        $this->obj->DB_update_all("subscribe", "`ctime`='" . time() . "'", "`id`='" . $v['id'] . "'");
    }

    function warning($type)
    {
        $time = strtotime(date("Y-m-d"));
        if ($type == 1) {
            $num = $this->obj->DB_select_num("company_job", "`uid`='" . $this->uid . "' and `sdate`>'" . $time . "'");
            if ($num >= $this->config['warning_addjob']) {
                $this->send_warning($type);
            }
        } elseif ($type == 2) {
            $num = $this->obj->DB_select_num("down_reume", "`comid`='" . $this->uid . "' and `downtime`>'" . $time . "'");
            if ($num >= $this->config['warning_downresume']) {
                $this->send_warning($type);
            }
        } elseif ($type == 3) {
            $num = $this->obj->DB_select_num("resume_expect", "`uid`='" . $this->uid . "' and `ctime`>'" . $time . "'");
            if ($num >= $this->config['warning_addresume']) {
                $this->send_warning($type);
            }
        } elseif ($type == 4) {
            $this->send_warning($type);
        }
    }

    function send_warning($type)
    {
        $time = strtotime(date("Y-m-d"));
        $row = $this->obj->DB_select_once("warning", "`type`='" . $type . "' and `uid`='" . $this->uid . "' and `ctime`>='" . $time . "'");
        if (empty($row)) {
            $this->obj->DB_insert_once("warning", "`type`='" . $type . "',`uid`='" . $this->uid . "',`ctime`='" . time() . "'");
            $member = $this->obj->DB_select_once("member", "`uid`='" . $this->uid . "'", "email");
            if ($type == "1") {
                $emailcoment = "用户：【" . $this->username . "】发布职位超出规定数目，请检查是否有问题";
                if ($this->config['warning_addjob_type'] == "1") {
                    $this->obj->DB_update_all("company_job", "`r_status`='2'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("company", "`r_status`='2'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("member", "`status`='2',`lock_info`='发布职位超出规定数目'", "`uid`='" . $this->uid . "'");
                    $this->send_msg_email(array("email" => $member['email'], "uid" => $this->uid, "name" => $this->username, "lock_info" => '发布职位超出规定数目', "type" => "lock"));
                    $this->unset_cookie();
                }
            } elseif ($type == "2") {
                $emailcoment = "用户：【" . $this->username . "】下载简历超出规定数目，请检查是否有问题";
                if ($this->config['warning_downresume_type'] == "1") {
                    $this->obj->DB_update_all("company_job", "`r_status`='2'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("company", "`r_status`='2'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("member", "`status`='2',`lock_info`='下载简历超出规定数目'", "`uid`='" . $this->uid . "'");
                    $this->send_msg_email(array("email" => $member['email'], "uid" => $this->uid, "name" => $this->username, "lock_info" => '下载简历超出规定数目', "type" => "lock"));
                    $this->unset_cookie();
                }
            } elseif ($type == "3") {
                $emailcoment = "用户：【" . $this->username . "】简历发布超出规定数目，请检查是否有问题";
                if ($this->config['warning_addresume_type'] == "1") {
                    $this->obj->DB_update_all("member", "`status`='2',`lock_info`='简历发布超出规定数目'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("resume", "`r_status`='2'", "`uid`='" . $this->uid . "' ");
                    $this->obj->DB_update_all("resume_expect", "`r_status`='2'", "`uid`='" . $this->uid . "' ");
                    $this->send_msg_email(array("email" => $member['email'], 'uid' => $this->uid, 'name' => $this->username, "lock_info" => '简历发布超出规定数目', "type" => "lock"));
                    $this->unset_cookie();
                }
            } elseif ($type == "4") {
                $emailcoment = "用户：【" . $this->username . "】充值超出规定金额，请检查是否有问题";
                if ($this->config['warning_recharge_type'] == "1") {
                    $this->obj->DB_update_all("company_job", "`r_status`='2'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("company", "`r_status`='2'", "`uid`='" . $this->uid . "'");
                    $this->obj->DB_update_all("member", "`status`='2',`lock_info`='充值超出规定金额'", "`uid`='" . $this->uid . "'");
                    $this->send_msg_email(array("email" => $member['email'], "uid" => $this->uid, "name" => $this->username, "lock_info" => '充值超出规定金额', "type" => "lock"));
                    $this->unset_cookie();
                }
            }
            if ($this->config['sy_smtpserver'] != "" && $this->config['sy_smtpemail'] != "" && $this->config['sy_smtpuser'] != "" && $this->config['sy_webemail'] != "") {
                $smtp = $this->email_set();
                $smtpusermail = $this->config['sy_smtpemail'];
                $sendid = $smtp->sendmail($this->config['sy_webemail'], $smtpusermail, "预警提醒", $emailcoment);
            }
        }
    }

    public function MODEL($ModelName = null, $ModelPath = null)
    {
        require_once(APP_PATH . 'app/public/action.class.php');
        if ($ModelName) {
            if ($ModelPath) {
                if (file_exists($ModelPath . '/' . $ModelName . '.class.php')) {
                    require_once($ModelPath . '/' . $ModelName . '.class.php');
                } else {
                    return null;
                }
            } else {
                $ModelPath = APP_PATH . 'app/model/';
                $ModelFileName = $ModelName . '.model.php';
                if (file_exists($ModelPath . $ModelFileName)) {
                    require_once($ModelPath . $ModelFileName);
                } else {
                    return null;
                }
            }
            $ModelName = $ModelName . '_model';
            $Model = new $ModelName($this->db, $this->def);
        } else {
            $ModelName = 'model';
            $Model = new $ModelName($this->db, $this->def);
        }
        return $Model;
    }

    public function get_admin_msg($url, $show = '操作已成功！')
    {
        $msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml"><head>
				<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
				<meta http-equiv="refresh" content="2; URL=' . $url . '" />
				<title>消息提示 Powered by PHPYUN_JOB!</title>
				<style>
				a,a:visited{
				color:#0066FF; text-decoration:none;
				}
				a:hover{
				color:blue; text-decoration:underline;
				}
				</style>
				</head>
				<body style="font-size:12px;">
				<div id="man_zone">
				  <table width="30%" border="0" align="center"  cellpadding="0" cellspacing="1" class="table" bgcolor="#dfdfdf" style="margin-top:100px;">
				    <tr>
				      <th height="25" align="center"><font style="font-size:12px;" color="#000">信息提示</font></th>
				    </tr>
				    <tr>
				      <td bgcolor="#FFFFFF"><p style="line-height:20px;">&nbsp;<font color=red>' . $show . '</font><br />
				      &nbsp;2秒后返回指定页面！<br />
				      &nbsp;如果浏览器无法跳转，<a href="' . $url . '">请点击此处</a>。</p></td>
				    </tr>
				  </table>
				</div>
				</body>
				</html>';
        echo $msg;
        exit ();
    }

    function GET_content_desc($cont)
    {
        return substr(strip_tags($cont), 0, 200);
    }

    function ACT_layer_msg($msg = "操作已成功！", $st = 9, $url = '', $tm = 2, $type = '0')
    {
        if (is_array($msg)) {
            foreach ($msg as $k => $v) {
                $Html .= '<div id="' . $k . '">' . $v . '</div>';
            }
            echo $Html;
            die;
        }

        if ($st == 9 && $type == '1') {
            $this->admin_log($msg);
        }
        $msg = preg_replace('/\([^\)]+?\)/x', "", str_replace(array("（", "）"), array("(", ")"), $msg));
        echo '<input id="layer_url" type="hidden" value="' . $url . '"><input id="layer_msg" type="hidden" value="' . $msg . '"><input id="layer_time" type="hidden" value="' . $tm . '"><input id="layer_st" type="hidden" value="' . $st . '">';
        exit();
    }

    function admin_log($data)
    {
        $value = "`uid`='" . $_SESSION['auid'] . "',";
        $value .= "`username`='" . $_SESSION['ausername'] . "',";
        $value .= "`content`='" . $data . "',";
        $value .= "`ctime`='" . time() . "'";
        if ($_SESSION['auid'] && $_SESSION['ausername']) {
            $this->MODEL()->DB_insert_once("admin_log", $value);
        }
    }

    function admin_get_user_shell($uid, $shell)
    {
        if (!preg_match("/^\d*$/", $uid)) {
            return false;
        }

        $query = $this->db->query("SELECT * FROM `" . $this->def . "admin_user` WHERE `uid`='$uid' limit 1");
        $us = is_array($row = $this->db->fetch_array($query));
        $shell = $us ? $shell == md5($row['username'] . $row['password'] . $this->md) : FALSE;
        return $shell ? $row : NULL;
    }

    function ACT_msg($url = 1, $msg = "操作已成功！", $st = 8, $tm = 3)
    {
        global $config;
        $this->yunset(array('config' => $config, 'job_arr_msg' => $msg, 'job_arr_url' => $url, 'job_arr_st' => $st, 'job_arr_tm' => $tm));
        $this->yuntpl(array('member/msg'));
        exit();
    }

    function GET_web_default($id, $power)
    {
        $web = $this->obj->DB_select_all("admin_navigation", "`keyid` in (" . implode(",", $id) . ") order by `sort` asc");
        if (is_array($web)) {
            foreach ($web as $v) {
                if (@in_array($v['id'], $power)) {
                    $arr[] = $v['id'];
                    $arr2[$v['id']] = $v['keyid'];
                }
            }
            $webaa = $this->obj->DB_select_all("admin_navigation", "`keyid` in (" . implode(",", $arr) . ") order by `sort` asc");
            if (is_array($webaa)) {
                foreach ($webaa as $va) {
                    if (@in_array($va['id'], $power)) {
                        $value[$arr2[$va['keyid']]] = $va['url'];
                    }
                }
            }
        }
        return $value;
    }

    function get_admin_user_shell()
    {
        if ($_SESSION['auid'] && $_SESSION['ashell']) {
            $row = $this->admin_get_user_shell($_SESSION['auid'], $_SESSION['ashell']);

            if (!$row) {
                $this->logout(false);
                echo "无权操作！";
                die;
            }
            if ($_GET['m'] == "" || $_GET['m'] == "index" || $_GET['m'] == "ajax" || $_GET['m'] == "admin_nav") {
                $_GET['m'] = "admin_right";
            }
            $c = $_GET['c'];
            $m = $_GET['m'];
            if ($_GET['m'] != "admin_right") {
                $url = "index.php?m=" . $m;
                $c_array = array("cache", "markcom", "markuser", "advertise", "zhaopinhui", "admin_user");
                if ($c && $c != 'savagroup' && in_array($m, $c_array)) {
                    $url .= "&c=" . $c;
                    $info = $this->obj->DB_select_once("admin_navigation", "`url`='" . $url . "'");
                    if (empty($info)) {
                        $url = "index.php?m=" . $m;
                    }
                }

                $nav = $this->get_shell($row["m_id"], $url);

                if (!$nav) {
                    $this->logout();
                    echo "无权操作！";
                    die;
                }

                $info = $this->obj->DB_select_once("admin_navigation", "`url`='" . $url . "'");

                if (!$info) {
                    echo "无权操作！";
                    die;
                }
            }
        } else {
            if ($_GET['m'] != "") {
                $this->logout(false);
                echo "无权操作！";
                die;
            }
        }
    }

    function get_shell($mid, $web, $type = "")
    {
        if ($this->get_nav()) {
            return false;
        } else {
            $row = $this->obj->DB_select_alls("admin_user", "admin_user_group", "a.`m_id`=b.`id` and b.`id`='$mid'");
            $power = unserialize($row[0]['group_power']);
            $row = $this->obj->DB_select_once("admin_navigation", "`url`='$web'");
            return @in_array($row['id'], $power) ? true : false;
        }
    }

    function get_nav()
    {
        $query = $this->db->query("select AUTO_INCREMENT from information_schema.TABLES where TABLE_NAME = '" . $this->def . "admin_navigation'");
        $arr = mysql_fetch_array($query);
        return $arr['AUTO_INCREMENT'] > 1447 ? true : false;
    }

    function admin_get_user_login($username, $password, $url = 'index.php')
    {
        global $config;
        $username = str_replace(" ", "", $username);
        $query = $this->db->query("SELECT * FROM `" . $this->def . "admin_user` WHERE `username`='$username' limit 1");
        $us = is_array($row = $this->db->fetch_array($query));

        $ps = $us ? md5($password) == $row['password'] : FALSE;
        if ($ps) {
            $_SESSION['auid'] = $row['uid'];
            $_SESSION['ausername'] = $row['username'];
            $_SESSION['xsstooken'] = sha1($config['sy_safekey']);
            $_SESSION['ashell'] = md5($row['username'] . $row['password'] . $this->md);
            setCookie("ashell", md5($row['username'] . $row['password'] . $this->md), time() + 80000, "/");
            $this->obj->DB_update_all("admin_user", "`lasttime`='" . time() . "'", "`uid`='" . $row['uid'] . "'");
            $this->ACT_layer_msg("登陆成功！", 9, $url);
        } else {
            $this->ACT_layer_msg("密码或用户错误！", 8, $url);
        }
    }

    function GET_user_shell($uid, $shell)
    {
        if (!preg_match("/^\d*$/", $uid)) {
            return false;
        }
        if (!preg_match("/^\d*$/", $_COOKIE['usertype'])) {
            return false;
        }
        $SQL = "SELECT * FROM `" . $this->def . "member` WHERE `uid`='$uid' AND `usertype`='" . $_COOKIE['usertype'] . "' limit 1";
        $query = $this->db->query($SQL);
        $us = is_array($row = $this->db->fetch_array($query));
        if ($row['username'] == $_COOKIE['username'] && $row['usertype'] == $_COOKIE['usertype']) {
            $shell = $us ? $shell == md5($row['username'] . $row['password'] . $row['salt']) : FALSE;
        } else {
            $shell = FALSE;
        }
        return $shell ? $row : NULL;
    }

    function company_invtal($uid, $integral, $auto = true, $name = "", $pay = true, $pay_state = 2, $type = "integral", $pay_type = '')
    {
        if ($pay && $integral != '0') {
            $integral = abs(intval($integral));
            $member = $this->obj->DB_select_once("member", "`uid`='" . $uid . "'", "usertype");
            if ($member['usertype'] == "1") {
                $table = "member_statis";
            } elseif ($member['usertype'] == "2") {
                $table = "company_statis";
            }
            if ($auto) {
                $nid = $this->obj->DB_update_all($table, "`$type`=`$type`+'" . $integral . "'", "`uid`='" . $uid . "'");
            } else {
                $nid = $this->obj->DB_update_all($table, "`$type`=`$type`-'" . $integral . "'", "`uid`='" . $uid . "'");
                $integral = "-" . $integral;
            }
            $dingdan = mktime() . rand(10000, 99999);
            $data['order_id'] = $dingdan;
            $data['com_id'] = $uid;
            $data['pay_remark'] = $name;
            $data['pay_state'] = $pay_state;
            $data['pay_time'] = time();
            $data['order_price'] = $integral;
            $data['pay_type'] = $pay_type;
            $data['did'] = $this->config['did'];
            if ($type == "integral") {
                $data['type'] = 1;
            } else {
                $data['type'] = 2;
            }
            $this->obj->insert_into("company_pay", $data);

            return $nid;
        } else {
            return true;
        }
    }

    function complete($user_resume = array())
    {
        $numresume = 20;
        if ($user_resume[expect] != "0") {
            $numresume = $numresume + 35;
        }
        if ($user_resume[skill] != "0") {
            $numresume = $numresume + 10;
        }
        if ($user_resume[work] != "0") {
            $numresume = $numresume + 7;
        }
        if ($user_resume[project] != "0") {
            $numresume = $numresume + 7;
        }
        if ($user_resume[edu] != "0") {
            $numresume = $numresume + 7;
        }
        if ($user_resume[training] != "0") {
            $numresume = $numresume + 7;
        }
        if ($user_resume[cert] != "0") {
            $numresume = $numresume + 7;
        }
        $this->obj->update_once('resume_expect', array('integrity' => $numresume), array('id' => $user_resume['eid']));
        return $numresume;
    }

    function GET_web_check($id)
    {
        $nav = $this->obj->DB_select_once("admin_navigation", "`id`='$id'");
        if (is_array($nav)) {
            $value .= $this->GET_web_check($nav['keyid']);
            $value .= $nav['name'] . " > ";
        }
        return $value;
    }

    function get_email_tpl()
    {
        $tpl = $this->obj->DB_select_all("templates", "1");
        if (is_array($tpl)) {
            foreach ($tpl as $v) {
                $rows[$v["name"]]["title"] = $v["title"];
                $rows[$v["name"]]["content"] = $v["content"];
            }
        }
        return $rows;
    }

    function uc_open()
    {
        include APP_PATH . '/api/uc/config.inc.php';
        include APP_PATH . '/api/uc/include/db_mysql.class.php';
        include APP_PATH . '/api/uc/uc_client/client.php';
    }

    function upuser_statis($order)
    {
        if ($order['order_state'] != '2') {
            $usertype = $this->obj->DB_select_once("member", "`uid`='" . $order["uid"] . "'", "usertype");
            if ($usertype['usertype'] == '1') {
                $table = 'member_statis';
            } else if ($usertype['usertype'] == '2') {
                $table = 'company_statis';
                $tvalue = ",`all_pay`=`all_pay`+'" . $order["order_price"] . "'";
            }
            if ($order['type'] == '1' && $order['rating'] && $usertype['usertype'] != '1') {
                $row = $this->obj->DB_select_once("company_rating", "`id`='" . $order['rating'] . "'");
                $value = "`rating`='" . $row['id'] . "',";
                $value .= "`rating_name`='" . $row['name'] . "',";
                $value .= "`rating_type`='" . $row['type'] . "',";
                if ($row['service_time'] > 0) {
                    $viptime = time() + $row['service_time'] * 86400;
                } else {
                    $viptime = 0;
                }
                $value .= "`all_pay`=`all_pay`+'" . $order["order_price"] . "',";
                $value .= "`vip_etime`='" . $viptime . "',";
                $value .= "`job_num`='" . $row['job_num'] . "',";
                $value .= "`down_resume`='" . $row['resume'] . "',";
                $value .= "`invite_resume`='" . $row['interview'] . "',";
                $value .= "`editjob_num`='" . $row['editjob_num'] . "',";
                $value .= "`breakjob_num`='" . $row['breakjob_num'] . "'";
                $status = $this->obj->DB_update_all($table, $value, "`uid`='" . $order["uid"] . "'");

            } else if ($order['type'] == '2' && $order['integral']) {
                $status = $this->obj->DB_update_all($table, "`integral`=`integral`+'" . $order['integral'] . "'" . $tvalue, "`uid`='" . $order["uid"] . "'");
            } else if ($order['type'] == '3' || $order['type'] == '4') {
                $status = $this->obj->DB_update_all($table, "`pay`=`pay`+'" . $order["order_price"] . "'" . $tvalue, "`uid`='" . $order["uid"] . "'");
            }

            if ($status) {
                if ($this->config['sy_msg_fkcg'] == '1' || $this->config['sy_email_fkcg'] == '1') {
                    $member = $this->obj->DB_select_once("member", "`uid`='" . $order['uid'] . "'", "`email`,`moblie`,`uid`,`usertype`");
                    $fdata = $this->forsend($member);
                    $data = array();
                    $data["uid"] = $order['uid'];
                    $data["name"] = $fdata['name'];
                    $data["type"] = "fkcg";
                    $data["order_id"] = $order['order_id'];
                    $data["price"] = $order['order_price'];
                    $data['webtel'] = $this->config['sy_freewebtel'];
                    $data['webname'] = $this->config['sy_webname'];
                    if ($this->config['sy_msg_fkcg'] == '1' && $member['moblie'] && $this->config["sy_msguser"] && $this->config["sy_msgpw"] && $this->config["sy_msgkey"]) {
                        $data["moblie"] = $member["moblie"];
                    }
                    if ($this->config['sy_email_fkcg'] == '1' && $member['email'] && $this->config["sy_smtpserver"] && $this->config["sy_smtpemail"] && $this->config["sy_smtpuser"]) {
                        $data["email"] = $member["email"];
                    }
                    if ($data['email'] || $data['moblie']) {
                        $this->send_msg_email($data);
                    }
                }
                $this->obj->DB_update_all("company_order", "`order_state`='2'", "`id`='" . $order['id'] . "'");
                if ($order['type'] == '2') {
                    $this->insert_company_pay($order['integral'], 2, $order['uid'], "购买" . $this->config['integral_pricename'], 1, 2, true);
                }
            }
            return $status;
        }
    }
}

?>