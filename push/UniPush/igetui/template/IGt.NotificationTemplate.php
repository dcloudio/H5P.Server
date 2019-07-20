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
	var $notifyStyle = 0;


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
		$actionChain2->set_type(ActionChain_Type::mmsinbox2);
		$actionChain2->set_stype("notification");
		
		$f_text = new InnerFiled();
		$f_text->set_key("text");
		$f_text->set_val($this->text);
		$f_text->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(0,$f_text);
		
		$f_title = new InnerFiled();
		$f_title->set_key("title");
		$f_title->set_val($this->title);
		$f_title->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(1,$f_title);
		
		$f_logo = new InnerFiled();
		$f_logo->set_key("logo");
		$f_logo->set_val($this->logo);
		$f_logo->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(2,$f_logo);
		
		$f_logoURL = new InnerFiled();
		$f_logoURL->set_key("logo_url");
		$f_logoURL->set_val($this->logoURL);
		$f_logoURL->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(3,$f_logoURL);
		
		$f_notifyStyle = new InnerFiled();
		$f_notifyStyle->set_key("notifyStyle");
		$f_notifyStyle->set_val(strval($this->notifyStyle));
		$f_notifyStyle->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(4,$f_notifyStyle);
		
		$f_isRing = new InnerFiled();
		$f_isRing->set_key("is_noring");
		$f_isRing->set_val(!$this->isRing ? "true" : "false");
		$f_isRing->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(5,$f_isRing);
		
		$f_isVibrate = new InnerFiled();
		$f_isVibrate->set_key("is_novibrate");
		$f_isVibrate->set_val(!$this->isVibrate ? "true" : "false");
		$f_isVibrate->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(6,$f_isVibrate);
		
		$f_isClearable = new InnerFiled();
		$f_isClearable->set_key("is_noclear");
		$f_isClearable->set_val(!$this->isClearable ? "true" : "false");
		$f_isClearable->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(7,$f_isClearable);
		
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
	
	function  set_notifyStyle($notifyStyle) {
		if($notifyStyle != 1){
			$this->notifyStyle = 0;
		} else {
			$this->notifyStyle = 1;
		}
	}
}