<?php

namespace Wow;

class Pusher
{
    private $_host = "";
    
    private $_key = "";
    
    public function __construct($key, $host = "") {
        $this->_key = $key;
        
        if($host)
            $this->_host = $host;
    }
    
    private function request($route, $fields){
        $url = trim($this->_host,"/").$route;
    
        $fields = json_encode($fields);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $this->_key,
                'Content-Type: application/json'
            )
        );

        $result = curl_exec($ch);
        $result = json_decode($result);
        
        return $result;
    }
    
    public function addToken($token,$user_id,$timezone,$language){
        return $this->request("/api/token",["token"=>$token, "user_id"=>$user_id, "timezone"=>$timezone, "language"=>$language]);
    }
    
    public function sendMessage($code,$user_id,$params){
        return $this->request("/api/push/message",["code"=>$code, "user_id"=>$user_id, "params"=>$params]);
    }
    
    public function sendMessages($code,$users){
        return $this->request("/api/push/messages",["code"=>$code, "users"=>$users]);
    }
}
