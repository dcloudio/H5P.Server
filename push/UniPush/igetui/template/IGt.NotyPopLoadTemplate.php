<?php
class IGtNotyPopLoadTemplate extends IGtBaseTemplate {
	/**
	 * 通知栏图标
	 */
	var $notyIcon;
	/**
	 * 通知栏标题
	 */
	var $logoURL;
	 
	var $notyTitle;
	/**
	 * 通知栏内容
	 */
	var $notyContent;
	/**
	 * 通知是否可清楚
	 */
	var $isCleared = true;
	/**
	 * 是否响铃
	 */
	var $isBelled = true;
	/**
	 * 是否震动
	 */
	var $isVibrationed = true;

	/**
	 * 弹框标题
	 */
	var $popTitle;
	/**
	 * 弹框内容
	 */
	var $popContent;

	/**
	 * 弹框图片
	 */
	var $popImage;
	/**
	 * 左边按钮名称
	 */
	var $popButton1;
	/**
	 * 右边按钮名称
	 */
	var $popButton2;

	/**
	 * 下载图标
	 */
	var $loadIcon;

	/**
	 * 下载标题
	 */
	var $loadTitle;

	/**
	 * 下载地址
	 */
	var $loadUrl;
	/**
	 * 是否自动安装
	 */
	var $isAutoInstall = false;
	/**
	 * 是否激活
	 */
	var $isActived = false;

    var $symbianMark="";
    var $androidMark="";
    var $iosMark="";
	var $notifyStyle = 0;
	
	public function  getActionChain() {
		$actionChains = array();
		//设置actionchain
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
		$f_text->set_val($this->notyContent);
		$f_text->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(0,$f_text);
		
		$f_title = new InnerFiled();
		$f_title->set_key("title");
		$f_title->set_val($this->notyTitle);
		$f_title->set_type(InnerFiled_Type::str);
		$actionChain2->set_field(1,$f_title);
		
		$f_logo = new InnerFiled();
		$f_logo->set_key("logo");
		$f_logo->set_val($this->notyIcon);
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
		$f_isRing->set_val(!$this->isBelled ? "true" : "false");
		$f_isRing->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(5,$f_isRing);
		
		$f_isVibrate = new InnerFiled();
		$f_isVibrate->set_key("is_novibrate");
		$f_isVibrate->set_val(!$this->isVibrationed ? "true" : "false");
		$f_isVibrate->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(6,$f_isVibrate);
		
		$f_isClearable = new InnerFiled();
		$f_isClearable->set_key("is_noclear");
		$f_isClearable->set_val(!$this->isCleared ? "true" : "false");
		$f_isClearable->set_type(InnerFiled_Type::bool);
		$actionChain2->set_field(7,$f_isClearable);
		
		$actionChain2->set_next(10010);
		
		$actionChain3 = new ActionChain();
		$actionChain3->set_actionId(10010);
		$actionChain3->set_type(ActionChain_Type::refer);
		$actionChain3->set_next(10020);
		
		//弹框按钮
		$button1 = new Button();
		$button1->set_text($this->popButton1);
		$button1->set_next(10050);
		$button2 = new Button();
		$button2->set_text($this->popButton2);
		$button2->set_next(100);
		
		//弹框
		$actionChain4 = new ActionChain();
		$actionChain4->set_actionId(10020);
		$actionChain4->set_type(ActionChain_Type::popup);
		$actionChain4->set_title($this->popTitle);
		$actionChain4->set_text($this->popContent);
		$actionChain4->set_img($this->popImage);
		$actionChain4->set_buttons(0,$button1);
		$actionChain4->set_buttons(1,$button2);
		$actionChain4->set_next(6);
		
		//下载
		//appstartupid
		$appStartUp = new AppStartUp();
		$appStartUp->set_android($this->androidMark);
		$appStartUp->set_Ios($this->iosMark);
		$appStartUp->set_symbia($this->symbianMark);
		$actionChain5 = new ActionChain();
		$actionChain5->set_actionId(10050);
		$actionChain5->set_type(ActionChain_Type::appdownload);
		$actionChain5->set_name($this->loadTitle);
		$actionChain5->set_url($this->loadUrl);
		$actionChain5->set_logo($this->loadIcon);
		$actionChain5->set_autoInstall($this->isAutoInstall);
		$actionChain5->set_autostart($this->isActived);
		$actionChain5->set_appstartupid($appStartUp);
		$actionChain5->set_next(6);
		
		$actionChain6 = new ActionChain();
		$actionChain6->set_actionId(100);
		$actionChain6->set_type(ActionChain_Type::eoa);
		
		array_push($actionChains, $actionChain1,$actionChain2,$actionChain3,$actionChain4,$actionChain5,$actionChain6);
		return $actionChains;
	}
	
	function  set_notyIcon($notyIcon) {
		$this->notyIcon = $notyIcon;
	}
	function  set_notyTitle($notyTitle) {
		$this->notyTitle = $notyTitle;
	}
	function  set_logoURL($logoURL) {
		$this->logoURL = $logoURL;
	}
	function  set_notyContent($notyContent) {
		$this->notyContent = $notyContent;
	}
	function  set_isCleared($isCleared) {
		$this->isCleared = $isCleared;
	}
	function  set_isBelled($isBelled) {
		$this->isBelled = $isBelled;
	}
	function  set_isVibrationed($isVibrationed) {
		$this->isVibrationed = $isVibrationed;
	}
	function  set_popTitle($popTitle) {
		$this->popTitle = $popTitle;
	}
	function  set_popContent($popContent) {
		$this->popContent = $popContent;
	}
	function  set_popImage($popImage) {
		$this->popImage = $popImage;
	}
	function  set_popButton1($popButton1) {
		$this->popButton1 = $popButton1;
	}
	function  set_popButton2($popButton2) {
		$this->popButton2 = $popButton2;
	}
	function  set_loadIcon($loadIcon) {
		$this->loadIcon = $loadIcon;
	}
	function  set_loadTitle($loadTitle) {
		$this->loadTitle = $loadTitle;
	}
	function  set_loadUrl($loadUrl) {
		$this->loadUrl = $loadUrl;
	}
	function  set_isAutoInstall($isAutoInstall) {
		$this->isAutoInstall = $isAutoInstall;
	}
	function  set_isActived($isActived) {
		$this->isActived = $isActived;
	}
    function set_symbianMark($symbianMark){
        $this->symbianMark = $symbianMark;
    }
    function set_androidMark($androidMark){
        $this->androidMark = $androidMark;
    }
    function set_iosMark($iosMark){
        $this->iosMark = $iosMark;
    }
	function get_pushType(){
		return "NotyPopLoadTemplate";
	}
	
	function  set_notifyStyle($notifyStyle) {
		if($notifyStyle != 1){
			$this->notifyStyle = 0;
		} else {
			$this->notifyStyle = 1;
		}
	}
}