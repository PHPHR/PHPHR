<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 18:06
 */

class index_controller extends common{

    /**
     * ������Ϣ����
     */
    public function index_action(){
        $this->seo("member");
        $this->yun_tpl(["person"]);
    }

    /*
     * ������Ϣ
     */
    public function person_action(){
        $this->seo("member");
        $this->yun_tpl(['person']);
    }
}