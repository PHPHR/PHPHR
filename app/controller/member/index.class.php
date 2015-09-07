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

    /**
     * 企业信息
     */
    public function company_action()
    {
        $this->seo("");
        $this->yun_tpl(['company']);
    }

    /**
     *  企业收藏
     */
    public function favorite_action()
    {
        $this->seo('');
        $this->yun_tpl(['favorite']);
    }

    /**
     * 发布信息
     */
    public function publish_action()
    {
        $this->seo('');
        $this->yun_tpl(['publish']);
    }

    /**
     *  企业资料
     */
    public function citem_action()
    {
        $this->seo('');
        $this->yun_tpl(["citem"]);
    }

    /**
     *  推荐
     */
    public function recomm_action()
    {
        $this->seo('');
        $this->yun_tpl(["recomm"]);
    }

    /**
     * 已下载的简历
     */
    public function dlod_action()
    {
        $this->seo('');
        $this->yun_tpl(["dlod"]);
    }

    /**
     * 在招职位
     */
    public function recruit_action()
    {
        $this->seo('');
        $this->yun_tpl(["recruit"]);
    }


}