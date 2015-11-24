<?php 

class IGtTarget{
	var  $appId;
 
	var $clientId;

    var $alias;
 

	 public function __construct()
	 {

	 }

	function get_appId()
	{
		return $this->appId;
	}
	function set_appId($appId)
	{
		return $this->appId = $appId;
	}
	function get_clientId()
	{
		return $this->clientId;
	}
	function set_clientId($clientId)
	{
		return $this->clientId = $clientId;
	}
    function set_alias($alias)
    {
        return $this->alias = $alias;
    }
    function get_alias()
    {
        return $this->alias;
    }
}