<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/8/12
 * Time: 18:06
 */

class index_controller extends common
{

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

    /**
     * ��ҵ��Ϣ
     */
    public function company_action()
    {
        $this->seo("");
        $this->yun_tpl(['company']);
    }

    /**
     *  ��ҵ�ղ�
     */
    public function favorite_action()
    {
        $this->seo('');
        $this->yun_tpl(['favorite']);
    }
}