<?php
header("Content-Type: text/html; charset=utf-8");
class IGtTagMessage extends IGtMessage{

    //array('','',..)
    var $appIdList;
    var $tag;
    var $speed=0;

    function __construct(){
        parent::__construct();
    }

    function get_appIdList() {
        return $this->appIdList;
    }

    function  set_appIdList($appIdList) {
        $this->appIdList = $appIdList;
    }

    function get_tag() {
        return $this->tag;
    }

    function set_tag($tag) {
        $this->tag = $tag;
    }

    function get_speed()
    {
        return $this->speed;
    }
    function set_speed($speed)
    {
        $this->speed=$speed;
    }
}