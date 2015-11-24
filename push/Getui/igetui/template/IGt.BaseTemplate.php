<?php

require_once(dirname(__FILE__) . '/' . '../utils/ApnsUtils.php');
require_once(dirname(__FILE__) . '/' . '../IGt.APNPayload.php');

class IGtBaseTemplate
{
    var $appId;
    var $appkey;
    var $pushInfo;
    var $duration;

    function get_transparent()
    {
        $transparent = new Transparent();
        $transparent->set_id('');
        $transparent->set_messageId('');
        $transparent->set_taskId('');
        $transparent->set_action('pushmessage');
        $transparent->set_pushInfo($this->get_pushInfo());
        $transparent->set_appId($this->appId);
        $transparent->set_appKey($this->appkey);

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

    function set_pushInfo($actionLocKey, $badge, $message, $sound, $payload, $locKey, $locArgs, $launchImage, $contentAvailable = 0)
    {
        $this->pushInfo = new PushInfo();
        $this->pushInfo->set_invalidAPN(true);
        $this->pushInfo->set_invalidMPN(true);
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
        $this->pushInfo = new PushInfo();
        $this->pushInfo->set_apnJson($payload);
        $this->pushInfo->set_invalidAPN(false);
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


}