<?php 

class IGtNotificationTemplate extends IGtBaseTemplate {

	var $text;
	var $title;
	var $logo;
	var $logoURL;
	var $transmissionType;
	var $transmissionContent;
	var $isRing;
	var $isVibrate;
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
	

		//appStartUp
		$appStartUp = new AppStartUp();
 		$appStartUp->set_android("");
		$appStartUp->set_symbia("");
		$appStartUp->set_ios("");

		//启动app
		$actionChain4 = new ActionChain();
		$actionChain4->set_actionId(10030);
		$actionChain4->set_type(ActionChain_Type::startapp);
		$actionChain4->set_appid("");
		$actionChain4->set_autostart($this->transmissionType == '1'? true : false);
		$actionChain4->set_appstartupid($appStartUp);
		$actionChain4->set_failedAction(100);
		$actionChain4->set_next(100);


		//结束
		$actionChain5 = new ActionChain();
		$actionChain5->set_actionId(100);
		$actionChain5->set_type(ActionChain_Type::eoa);
 
		array_push($actionChains, $actionChain1,$actionChain2,$actionChain3,$actionChain4,$actionChain5);

		return $actionChains;
	}

	function  get_transmissionContent() {
		return $this->transmissionContent;
	}
	
	function  get_pushType() {
		return 'NotifyMsg';
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
	
	function  set_transmissionType($transmissionType) {
		$this->transmissionType = $transmissionType;
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

	function  set_transmissionContent($transmissionContent) {
		$this->transmissionContent = $transmissionContent;
	}
}