<?php
header("Content-Type: text/html; charset=utf-8");
require_once(dirname(__FILE__) .'/'.'utils/AppConditions.php');
class IGtAppMessage extends IGtMessage{
	
	//array('','',..)
	var $appIdList;
	//array('','',..)
	var $phoneTypeList;
	//array('','',..)
	var $provinceList;
    var $tagList;
	var $conditions;
    var $speed=0;
    var $pushTime;
	function __construct(){
		parent::__construct();
	}

	function get_appIdList() {
		return $this->appIdList;
	}

	function  set_appIdList($appIdList) {
		$this->appIdList = $appIdList;
	}

	/**
	 * @deprecated deprecated since version 4.0.0.3
	 */
	function get_phoneTypeList() {
		return $this->phoneTypeList;
	}

	/**
	 * @deprecated deprecated since version 4.0.0.3
	 */
	function  set_phoneTypeList($phoneTypeList) {
		$this->phoneTypeList = $phoneTypeList;
	}

	/**
	 * @deprecated deprecated since version 4.0.0.3
	 */
	function  get_provinceList() {
		return $this->provinceList;
	}

	/**
	 * @deprecated deprecated since version 4.0.0.3
	 */
	function  set_provinceList($provinceList) {
		$this->provinceList = $provinceList;
	}

	/**
	 * @deprecated deprecated since version 4.0.0.3
	 */
    function get_tagList() {
        return $this->tagList;
    }

	/**
	 * @deprecated deprecated since version 4.0.0.3
	 */
    function set_tagList($tagList) {
        $this->tagList = $tagList;
    }

	public function get_conditions()
	{
		return $this->conditions;
	}

    /**
     * @return mixed
     */
    public function getPushTime()
    {
        return $this->pushTime;
    }

    /**
     * @param mixed $pushTime
     */
    public function setPushTime($pushTime)
    {

        $this->pushTime = $pushTime;
    }


	public function set_conditions($conditions)
	{
		$this->conditions = $conditions;
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