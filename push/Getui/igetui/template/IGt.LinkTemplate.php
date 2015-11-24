<?php 

class IGtLinkTemplate extends IGtBaseTemplate {

	/**
	*String 
	*/
	var $text;

	/**
	*String 
	*/
	var $title;

	/**
	*String 
	*/
	var $logo;
	
	var $logoURL;

	/**
	*boolean 
	*/
	var $isRing;

	/**
	*boolean 
	*/
	var $isVibrate;

	/**
	*String 
	*/
	var $url;
	
	/**
	*boolean 
	*/
	var $isClearable;

	public function  getActionChain() {

		$actionChains = array();
		
		// 设置actionChain
		$actionChain1 = new ActionChain();
		$actionChain1->set_actionId(1);
  		$actionChain1->set_type(ActionChain_Type::refer);
		$actionChain1->set_next(10000);
		
		//通知
		$actionChain2 = new ActionChain();
		$actionChain2->set_actionId(10000);
		$actionChain2->set_type(ActionChain_Type::notification);
		$actionChain2->set_title($this->title);
		$actionChain2->set_text($this->text);
		$actionChain2->set_logo($this->logo);
		$actionChain2->set_logoURL($this->logoURL);
		$actionChain2->set_ring($this->isRing ? true : false);
		$actionChain2->set_clearable($this->isClearable ? true : false);
		$actionChain2->set_buzz($this->isVibrate ? true : false);
		$actionChain2->set_next(10010);

		
		//goto
		$actionChain3 = new ActionChain();
		$actionChain3->set_actionId(10010);
		$actionChain3->set_type(ActionChain_Type::refer);
		$actionChain3->set_next(10030);
	

		//启动web
		$actionChain4 = new ActionChain();
		$actionChain4->set_actionId(10030);
		$actionChain4->set_type(ActionChain_Type::startweb);
		$actionChain4->set_url($this->url);
		$actionChain4->set_next(100);


		//结束
		$actionChain5 = new ActionChain();
		$actionChain5->set_actionId(100);
		$actionChain5->set_type(ActionChain_Type::eoa);
 
		array_push($actionChains, $actionChain1,$actionChain2,$actionChain3,$actionChain4,$actionChain5);

		return $actionChains;
	}

	function  get_pushType() {
		return 'LinkMsg';
	}

	function  set_text($text) {
		$this->text = $text;
	}

	function  set_title($title) {
		$this->title = $title;
	}

	function  set_logo($logo) {
		$this->logo = $logo;
	}
	
	function  set_logoURL($logoURL) {
		$this->logoURL = $logoURL;
	}

	function  set_url($url) {
		$this->url = $url;
	}

	function  set_isRing($isRing) {
		$this->isRing = $isRing;
	}

	function  set_isVibrate($isVibrate) {
		$this->isVibrate = $isVibrate;
	}

	function  set_isClearable($isClearable) {
		$this->isClearable = $isClearable;
	}
}