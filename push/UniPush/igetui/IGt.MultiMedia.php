<?php
/**
 * 个推IOS多媒体消息，支持图片、音频、视频
 * Created by PhpStorm.
 * User: zqzhao5
 * Date: 17-7-27
 * Time: 下午3:21
 */
class IGtMultiMedia {
    /**
     * @var资源ID
     */
    var $rid;
    /**
     * @var资源url
     */
    var $url;
    /**
     * @var资源类型
     */
    var $type;
    /**
     * @var是否只支持wifi下发
     */
    var $onlywifi = 0;

    public function __construct(){}

    function get_rid() {
        return $this->rid;
    }

    function  set_rid($rid) {
        $this->rid = $rid;
        return $this;
    }

    function get_url() {
        return $this->url;
    }

    function set_url($url) {
        $this->url = $url;
        return$this;
    }

    function get_type() {
        return $this -> type;
    }

    function set_type($type) {
        $this -> type = $type;
        return $this;
    }

    function set_onlywifi($onlywifi) {
        $this -> onlywifi = $onlywifi ? 1:0;
        return $this;
    }

    function get_onlywifi() {
        return $this -> onlywifi;
    }
}

class MediaType {
    const __default = self::pic;

    const pic = 1;
    const audio = 2;
    const video = 3;
}
