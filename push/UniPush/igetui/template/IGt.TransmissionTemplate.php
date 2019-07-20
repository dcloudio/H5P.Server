<?php
class IGtTransmissionTemplate extends IGtBaseTemplate {

	var $transmissionType;
	var $transmissionContent;
    const pattern = '/^intent:#Intent;.*;end$/';

	public function  getActionChain() {

		$actionChains = array();

	
		// 设置actionChain
		$actionChain1 = new ActionChain();
		$actionChain1->set_actionId(1);
		$actionChain1->set_type(ActionChain_Type::refer);
		$actionChain1->set_next(10030);

		//appStartUp
		$appStartUp = new AppStartUp();
 		$appStartUp->set_android("");
		$appStartUp->set_symbia("");
		$appStartUp->set_ios("");

		//启动app
		$actionChain2 = new ActionChain();
		$actionChain2->set_actionId(10030);
		$actionChain2->set_type(ActionChain_Type::startapp);
		$actionChain2->set_appid("");
		$actionChain2->set_autostart($this->transmissionType == '1'? true : false);
		$actionChain2->set_appstartupid($appStartUp);
		$actionChain2->set_failedAction(100);
		$actionChain2->set_next(100);

		//结束
		$actionChain3 = new ActionChain();
		$actionChain3->set_actionId(100);
		$actionChain3->set_type(ActionChain_Type::eoa);

 
		array_push($actionChains, $actionChain1,$actionChain2,$actionChain3);

		return $actionChains;
	}

	function  get_transmissionContent() {
		return $this->transmissionContent;
	}
	
	function  get_pushType() {
		return 'TransmissionMsg';
	}


	function  set_transmissionType($transmissionType) {
		$this->transmissionType = $transmissionType;
	}

	function  set_transmissionContent($transmissionContent) {
		$this->transmissionContent = $transmissionContent;
	}

    function set3rdNotifyInfo($notify) {
        if ($notify->get_title() == null || $notify -> get_content() == null) {
            throw new Exception("notify title or content cannot be null");
        }

        $notifyInfo = new NotifyInfo();
        $notifyInfo -> set_title($notify -> get_title());
        $notifyInfo -> set_content($notify -> get_content());

        //不指定类型，只发简单通知 ,php 中 空串、false、0、null的值都是相等的，type的枚举值都是大于等于0的
        if($notify -> get_type() > -1){
            $notifyInfo ->set_type($notify -> get_type());
            if($notify -> get_payload() != null){
                $notifyInfo -> set_payload($notify -> get_payload());
            }

            if($notify -> get_intent() != null){
                if(strlen($notify -> get_intent()) > GTConfig::getNotifyIntentLimit()){
                    throw new Exception("intent size overlimit " . GTConfig::getNotifyIntentLimit());
                }
                //不符合intent的格式要求
                if(!preg_match(self::pattern,$notify -> get_intent())){
                    throw new Exception("intent format err,should start with \"intent:#Intent;\",end \"with ;end\"  ");
                }

                $notifyInfo -> set_intent($notify -> get_intent());
            }

            if($notify -> get_url() != null){
                $notifyInfo ->set_url($notify -> get_url());
            }
        }

        $pushInfo = $this-> get_pushInfo();
        $pushInfo -> set_notifyInfo($notifyInfo);
        $pushInfo -> set_validNotify(true);
    }
}