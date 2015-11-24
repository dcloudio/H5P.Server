<?php 

class IGtAppMessage extends IGtMessage{
	
	//array('','',..)
	var $appIdList;
	
	//array('','',..)
	var $phoneTypeList;
	
	//array('','',..)
	var $provinceList;

    var $tagList;
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

	function get_phoneTypeList() {
		return $this->phoneTypeList;
	}

	function  set_phoneTypeList($phoneTypeList) {
		$this->phoneTypeList = $phoneTypeList;
	}

	function  get_provinceList() {
		return $this->provinceList;
	}

	function  set_provinceList($provinceList) {
		$this->provinceList = $provinceList;
	}

    function get_tagList() {
        return $this->tagList;
    }
    function set_tagList($tagList) {
        $this->tagList = $tagList;
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