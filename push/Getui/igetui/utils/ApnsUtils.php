<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-8-23
 * Time: 下午4:56
 */
Class ApnsUtils
{

    static function validatePayloadLength($locKey, $locArgs, $message, $actionLocKey, $launchImage, $badge, $sound, $payload,$contentAvailable)
    {
        $json = ApnsUtils :: processPayload($locKey, $locArgs, $message, $actionLocKey, $launchImage, $badge, $sound, $payload,$contentAvailable);
        return strlen($json);
    }

    static function processPayload($locKey, $locArgs, $message, $actionLocKey, $launchImage, $badge, $sound, $payload, $contentAvailable)
    {
        $isValid = false;
        $pb = new Payload();
        if ($locKey != null && strlen($locKey) > 0) {
            // loc-key
            $pb->setAlertLocKey(($locKey));
            // loc-args
            if ($locArgs != null && strlen($locArgs) > 0) {
                $pb->setAlertLocArgs(explode(',',($locArgs)));
            }
            $isValid = true;
        }

        // body
        if ($message != null && strlen($message) > 0) {
            $pb->setAlertBody(($message));
            $isValid = true;
        }

        // action-loc-key
        if ($actionLocKey!=null && strlen($actionLocKey) > 0) {
            $pb->setAlertActionLocKey($actionLocKey);
        }

        // launch-image
        if ($launchImage!=null && strlen($launchImage) > 0) {
            $pb->setAlertLaunchImage($launchImage);
        }

        // badge
        $badgeNum = -1;
        if(is_numeric($badge)){
            $badgeNum = (int)$badge;
        }
        if ($badgeNum >= 0) {
            $pb->setBadge($badgeNum);
            $isValid = true;
        }

        // sound
        if ($sound != null && strlen($sound) > 0) {
            $pb->setSound($sound);
        } else {
            $pb->setSound("default");
        }

        //contentAvailable
        if ($contentAvailable == 1) {
            $pb->setContentAvailable(1);
            $isValid = true;
        }

        // payload
        if ($payload != null && strlen($payload) > 0) {
            $pb->addParam("payload", ($payload));
        }

        if($isValid == false){
            throw new Exception("one of the params(locKey,message,badge) must not be null or contentAvailable must be 1");
        }
        $json = $pb->toString();
        if($json == null){
            throw new Exception("payload json is null");
        }
        return $json;
    }
}

Class Payload
{
    var $APS = "aps";
    var $params;
    var $alert;
    var $badge;
    var $sound = "";

    var $alertBody;
    var $alertActionLocKey;
    var $alertLocKey;
    var $alertLocArgs;
    var $alertLaunchImage;
    var $contentAvailable;

    function getParams()
    {
        return $this->params;
    }

    function  setParams($params)
    {
        $this->params = $params;
    }

    function addParam($key, $obj)
    {
        if ($this->params == null) {
            $this->params = array();
        }
        if ($this->APS == strtolower($key)) {
            throw new Exception("the key can't be aps");
        }
        $this->params[$key] = $obj;
    }

    function getAlert()
    {
        return $this->alert;
    }

    function setAlert($alert)
    {
        $this->alert = $alert;
    }

    function getBadge()
    {
        return $this->badge;
    }

    function setBadge($badge)
    {
        $this->badge = $badge;
    }

    function getSound()
    {
        return $this->sound;
    }

    function setSound($sound)
    {
        $this->sound = $sound;
    }

    function getAlertBody()
    {
        return $this->alertBody;
    }

    function setAlertBody($alertBody)
    {
        $this->alertBody = $alertBody;
    }

    function getAlertActionLocKey()
    {
        return $this->alertActionLocKey;
    }

    function setAlertActionLocKey($alertActionLocKey)
    {
        $this->alertActionLocKey = $alertActionLocKey;
    }

    function getAlertLocKey()
    {
        return $this->alertLocKey;
    }

    function  setAlertLocKey($alertLocKey)
    {
        $this->alertLocKey = $alertLocKey;
    }

    function getAlertLaunchImage()
    {
        return $this->alertLaunchImage;
    }

    function setAlertLaunchImage($alertLaunchImage)
    {
        $this->alertLaunchImage = $alertLaunchImage;
    }

    function getAlertLocArgs()
    {
        return $this->alertLocArgs;
    }

    function setAlertLocArgs($alertLocArgs)
    {
        $this->alertLocArgs = $alertLocArgs;
    }

    function getContentAvailable()
    {
        return $this->contentAvailable;
    }

    function setContentAvailable($contentAvailable)
    {
        $this->contentAvailable = $contentAvailable;
    }

    function putIntoJson($key, $value, $obj)
    {
        if ($value != null) {
            $obj[$key] = $value;
        }
        return $obj;
    }

    function toString()
    {
        $object = array();
        $apsObj = array();
        if ($this->getAlert() != null) {
            $apsObj["alert"] = urlencode($this->getAlert());
        } else {
            if ($this->getAlertBody() != null || $this->getAlertLocKey() != null) {
                $alertObj = array();
                $alertObj = $this->putIntoJson("body", ($this->getAlertBody()), $alertObj);
                $alertObj = $this->putIntoJson("action-loc-key", ($this->getAlertActionLocKey()), $alertObj);
                $alertObj = $this->putIntoJson("loc-key", ($this->getAlertLocKey()), $alertObj);
                $alertObj = $this->putIntoJson("launch-image", ($this->getAlertLaunchImage()), $alertObj);
                if ($this->getAlertLocArgs() != null) {
                    $array = array();
                    foreach ($this->getAlertLocArgs() as $str) {
                        array_push($array, ($str));
                    }
                    $alertObj["loc-args"] = $array;
                }
                $apsObj["alert"] = $alertObj;
            }
        }
        if ($this->getBadge() != null) {
            $apsObj["badge"] = $this->getBadge();
        }
        // 判断是否静音
        if ("com.gexin.ios.silence" != ($this->getSound())) {
            $apsObj = $this->putIntoJson("sound", ($this->getSound()), $apsObj);
        }
        if($this->getContentAvailable() == 1){
            $apsObj["content-available"]=1;
        }
        $object[$this->APS] = $apsObj;
        if ($this->getParams() != null) {
            foreach ($this->getParams() as $key => $value) {
                $object[($key)] = ($value);
            }
        }
		return Util::json_encode($object);
    }
}

class Util
{
    static function json_encode($input){
        // 从 PHP 5.4.0 起, 增加了这个选项.
        if(defined('JSON_UNESCAPED_UNICODE')){
            return json_encode($input, JSON_UNESCAPED_UNICODE);
        }
        if(is_string($input)){
            $text = $input;
			$text = str_replace("\\", "\\\\", $text);
			//$text = str_replace('/', "\\/",   $text);
			$text = str_replace('"', "\\".'"', $text);
			$text = str_replace("\b", "\\b", $text);
			$text = str_replace("\t", "\\t", $text);
			$text = str_replace("\n", "\\n", $text);
			$text = str_replace("\f", "\\f", $text);
			$text = str_replace("\r", "\\r", $text);
			//$text = str_replace("\u", "\\u", $text);
            return '"' . $text . '"';
        } else if(is_array($input) || is_object($input)) {
            $arr = array();
            $is_obj = is_object($input) || (array_keys($input) !== range(0, count($input) - 1));
            foreach($input as $k=>$v){
                if($is_obj){
                    $arr[] = self::json_encode($k) . ':' . self::json_encode($v);
                }else{
                    $arr[] = self::json_encode($v);
                }
            }
            if($is_obj){
                return '{' . join(',', $arr) . '}';
            }else{
                return '[' . join(',', $arr) . ']';
            }
        }else{
            return $input . '';
        }
    }
}