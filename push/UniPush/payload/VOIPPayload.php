<?php

Class VOIPPayload {
    var $voIPPayload;

    public function get_payload()
    {
        $payload = $this->voIPPayload;
        if($payload == null || empty($payload)){
            throw new RuntimeException("payload cannot be empty");
        }
        $params = array();
        if($payload != null){
            $params["payload"] = $payload;
        }
        $params["isVoIP"] = 1;
        return json_encode($params);
     }

     public function setVoIPPayload($voIPPayload){
        $this->voIPPayload = $voIPPayload;
     }

}