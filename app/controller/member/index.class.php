<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 18:06
 */

class index_controller extends common{

    /**
     * 个人信息引导
     */
    public function index_action(){
        $this->seo("member");
        $this->yun_tpl(["person"]);
    }

    /*
     * 个人信息
     */
    public function person_action(){
        $this->seo("member");
        $this->yun_tpl(['person']);
    }
}