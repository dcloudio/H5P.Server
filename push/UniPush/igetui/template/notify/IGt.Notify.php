<?php

/**
 * Class IGtNotify
 */
class IGtNotify {

    /**
     * 通知标题
     * @var
     */
    var $title;

    /**
     * 通知内容
     * @var
     */
    var $content;

    /**
     * 通知内容中携带的透传内容
     * @var
     */
    var $payload;

    /**
     * 通知内容带url
     */
    var $url;


    /**
     * 通知内容带intent
     */
    var $intent;

    /**
     * 指定通知中携带的类型
     */
    var $type;

    /**
     * @return mixed
     */
    public function get_title()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function set_title($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function get_content()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function set_content($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function get_payload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function set_payload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function get_url()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function set_url($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function get_intent()
    {
        return $this->intent;
    }

    /**
     * @param mixed $intent
     */
    public function set_intent($intent)
    {
        $this->intent = $intent;
    }

    /**
     * @return mixed
     */
    public function get_type()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function set_type($type)
    {
        $this->type = $type;
    }
}
