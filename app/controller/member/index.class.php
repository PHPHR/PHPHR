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

    /**
     * ������Ϣ
     */
    public function publish_action()
    {
        $this->seo('');
        $this->yun_tpl(['publish']);
    }

    /**
     *  ��ҵ����
     */
    public function citem_action()
    {
        $this->seo('');
        $this->yun_tpl(["citem"]);
    }

    /**
     *  �Ƽ�
     */
    public function recomm_action()
    {
        $this->seo('');
        $this->yun_tpl(["recomm"]);
    }

    /**
     * �����صļ���
     */
    public function dlod_action()
    {
        $this->seo('');
        $this->yun_tpl(["dlod"]);
    }

    /**
     * ����ְλ
     */
    public function recruit_action()
    {
        $this->seo('');
        $this->yun_tpl(["recruit"]);
    }


}