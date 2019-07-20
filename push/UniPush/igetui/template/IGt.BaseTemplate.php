<?php

require_once(dirname(__FILE__) . '/' . '../utils/ApnsUtils.php');
require_once(dirname(__FILE__) . '/' . '../IGt.APNPayload.php');
require_once(dirname(__FILE__) . '/' . './notify/SmsMessage.php');
require_once(dirname(__FILE__) . '/' . './notify/SmsMessage.php');

class IGtBaseTemplate
{
    var $appId;
    var $appkey;
    var $pushInfo;
    var $duration;
    var $smsInfo;

    function get_transparent()
    {
        $transparent = new Transparent();
        $transparent->set_templateId($this->getTemplateId());
        $transparent->set_id('');
        $transparent->set_messageId('');
        $transparent->set_taskId('');
        $transparent->set_action('pushmessage');
        $transparent->set_pushInfo($this->get_pushInfo());
        $transparent->set_appId($this->appId);
        $transparent->set_appKey($this->appkey);
        if($this->smsInfo != null){
            $transparent->set_smsInfo($this->smsInfo);
        }

        $actionChainList = $this->getActionChain();

        foreach ($actionChainList as $index => $actionChain) {
            $transparent->add_actionChain();
            $transparent->set_actionChain($index, $actionChain);
        }

        $transparent->append_condition($this->get_durcondition());

        return $transparent->SerializeToString();

        //return $transparent->condition(0);
    }

    function getActionChain()
    {
        return $list = array();
    }

    function get_durcondition()
    {
		if ($this->duration == null || $this->duration == '')
		{
			return "";
		}
        return "duration=" . $this->duration;
    }

    function get_duration()
    {
        return $this->duration;
    }

    function set_duration($begin, $end)

    {
        date_default_timezone_set('asia/shanghai');
        /*  //for test
            var_dump(date("Y-m-d H:i:s",strtotime($begin)));
            var_dump(date("Y-m-d H:i:s",strtotime($end)));
        */
        $ss = (string)strtotime($begin) * 1000;
        $e = (string)strtotime($end) * 1000;
        if ($ss <= 0 || $e <= 0)
            throw new Exception("DateFormat: yyyy-MM-dd HH:mm:ss");
        if ($ss > $e)
            throw new Exception("startTime should be smaller than endTime");

        $this->duration = $ss . "-" . $e;

    }

    function  get_transmissionContent()
    {
        return null;
    }

    function  get_pushType()
    {
        return null;
    }

    function get_actionChain()
    {
        return null;
    }

    function get_pushInfo()
    {
        if ($this->pushInfo == null) {
            $this->pushInfo = new PushInfo();
            $this->pushInfo->set_invalidAPN(true);
            $this->pushInfo->set_invalidMPN(true);
        }

        return $this->pushInfo;
    }

    function setSmsInfo($smsMessage){

        if($smsMessage == null){
            throw new RuntimeException("smsInfo cannot be empty");
        } else {
            $smsTemplateId = $smsMessage->getSmsTemplateId();
            $smsContent = $smsMessage->getSmsContent();
            $offlineSendtime = $smsMessage->getOfflineSendtime();
            $smsSendDuration = 0;
            if ($smsTemplateId != null || !empty($smsTemplateId)) {
                if ($offlineSendtime == null) {
                    throw new RuntimeException("offlineSendtime cannot be empty");
                } else {
                    $build = new SmsInfo();
                    $build->set_smsChecked(false);
                    $build->set_smsTemplateId($smsTemplateId);
                    $build->set_offlineSendtime($offlineSendtime);
                    if ($smsMessage->getisApplink()) {

                        if ($smsContent['url'] != null) {
                            throw new RuntimeException("SmsContent cann not contains key about url");
                        }
                        $smsContentEntry = new SmsContentEntry();
                        $smsContentEntry->set_key("applinkIdentification");
                        $smsContentEntry->set_value("1");
                        $build->set_smsContent("applinkIdentification",$smsContentEntry);
                        $payload = $smsMessage->getPayload();

                        if ($payload != null && !empty($payload)) {
                            $smsContentEntry = new SmsContentEntry();
                            $smsContentEntry->set_key("url");
                            $smsContentEntry->set_value($smsMessage->getUrl() . "?n=" . $payload . "&p=");
                            $build->set_smsContent("url",$smsContentEntry);
                        } else {
                            $smsContentEntry = new SmsContentEntry();
                            $smsContentEntry->set_key("url");
                            $smsContentEntry->set_value($smsMessage->getUrl() . "?p=");
                            $build->set_smsContent("url",$smsContentEntry);
                        }
                    }
                    if ($smsContent != null) {
                        foreach ($smsContent as $key => $value) {
                            if ($key == null || empty($key) || $value == null) {
                                throw new RuntimeException("smsContent entry cannot be null");
                            } else {
                                $smsContentEntry = new SmsContentEntry();
                                $smsContentEntry->set_key($key);
                                $smsContentEntry->set_value($value);
                                $build->set_smsContent($key,$smsContentEntry);
                            }
                        }
                    }
                    if ($smsSendDuration != null) {
                        $build->smsSendDuration($smsSendDuration);
                    }
                    $this->smsInfo = $build;
                }
            }
            else {
                    throw new RuntimeException("smsTemplateId cannot be empty");
                }

            }


    }
    function set_pushInfo($actionLocKey, $badge, $message, $sound, $payload, $locKey, $locArgs, $launchImage, $contentAvailable = 0)
    {
        $apn = new IGtAPNPayload();

        $alertMsg = new DictionaryAlertMsg();
        if ($actionLocKey != null && $actionLocKey != '')
        {
            $alertMsg->actionLocKey = $actionLocKey;
        }
        if ($message != null && $message != '')
        {
            $alertMsg->body = $message;
        }
        if ($locKey != null && $locKey != '')
        {
            $alertMsg->locKey = $locKey;
        }
        if ($locArgs != null && $locArgs != '')
        {
            array_push($alertMsg->locArgs, $locArgs);
        }

        if ($launchImage != null && $launchImage != '')
        {
            $alertMsg->launchImage = $launchImage;
        }
        $apn->alertMsg = $alertMsg;

        if ($badge != null )
        {
            $apn->badge = $badge;
        }
        if ($sound != null && $sound != '')
        {
            $apn->sound = $sound;
        }
        if ($contentAvailable != null )
        {
            $apn->contentAvailable = $contentAvailable;
        }
        if ($payload != null && $payload != '')
        {
            $apn->add_customMsg("payload", $payload);
        }
        $this->set_apnInfo($apn);
    }

    function set_apnInfo($payload)
    {
        if ($payload == null) {
            return;
        }
        $payload = $payload->get_payload();
        if ($payload == null || $payload == "") {
            return;
        }
        $len = strlen($payload);
        if ($len > IGtAPNPayload::$PAYLOAD_MAX_BYTES) {
            throw new Exception("APN payload length overlength (" . $len . ">" . IGtAPNPayload::$PAYLOAD_MAX_BYTES . ")");
        }
        $pushInfo = $this->get_pushInfo();
        $pushInfo->set_apnJson($payload);
        $pushInfo->set_invalidAPN(false);
    }

    function  set_appId($appId)
    {
        $this->appId = $appId;
    }

    function  set_appkey($appkey)
    {
        $this->appkey = $appkey;
    }

    function abslength($str)
    {
        if (empty($str)) {
            return 0;
        }
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, 'utf-8');
        } else {
            preg_match_all("/./u", $str, $ar);
            return count($ar[0]);
        }
    }

    function getTemplateId() {
        if($this instanceof IGtNotificationTemplate) {
            return 0;
        }
        if($this instanceof IGtLinkTemplate) {
            return 1;
        }
        if($this instanceof IGtNotyPopLoadTemplate) {
            return 2;
        }
        if($this instanceof  IGtTransmissionTemplate) {
            return 4;
        }
        if($this instanceof IGtAPNTemplate) {
            return 5;
        }

        if($this instanceof IGtStartActivityTemplate) {
            return 7;
        }
        return -1;
    }


}