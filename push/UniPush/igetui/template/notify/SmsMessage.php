<?php
/**
 * Created by IntelliJ IDEA.
 * User: mawen6558922
 * Date: 2018/7/19
 * Time: 下午9:58
 */

class SmsMessage {

    var $smsTemplateId;
    /**
     * 短信填充
     */
    var $smsContent;
    /**
     * 离线多久后进行消息补发
     */
    var $offlineSendtime;

    var $url;//Applink路径
    var $isApplink;
    var $payload;

    /**
     * @return mixed
     */
    public function getSmsTemplateId()
    {
        return $this->smsTemplateId;
    }

    /**
     * @param mixed $smsTemplateId
     */
    public function setSmsTemplateId($smsTemplateId)
    {
        $this->smsTemplateId = $smsTemplateId;
    }

    /**
     * @return mixed
     */
    public function getSmsContent()
    {
        return $this->smsContent;
    }

    /**
     * @param mixed $smsContent
     */
    public function setSmsContent($smsContent)
    {
        $this->smsContent = $smsContent;
    }

    /**
     * @return mixed
     */
    public function getOfflineSendtime()
    {
        return $this->offlineSendtime;
    }

    /**
     * @param mixed $offlineSendtime
     */
    public function setOfflineSendtime($offlineSendtime)
    {
        $this->offlineSendtime = $offlineSendtime;
    }


    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getisApplink()
    {
        return $this->isApplink;
    }

    /**
     * @param mixed $isApplink
     */
    public function setIsApplink($isApplink)
    {
        $this->isApplink = $isApplink;
    }
    
    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }//自定义字段

}

?>