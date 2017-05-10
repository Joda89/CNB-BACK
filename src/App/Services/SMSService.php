<?php

namespace App\Services;

use \Ovh\Sms\SmsApi;

class SMSService extends BaseService
{   
    private $sms;


    public function createService($config)
    {
        $this->sms = new SmsApi($config['applicationKey'], $config['applicationSecret'], $config['endpoint'], $config['consumerKey']);
        $accounts = $this->sms->getAccounts();
        $this->sms->setAccount($accounts[0]);
    }
    
    public function getUserList()
    {
        return $this->sms->getUsers();
    }
    
    public function setUser($userName)
    {
        $this->sms->setUser($userName);
    }
    
    public function sendMessage($sender,$receiver,$deliveryDate,$message,$isMarketing = false)
    {
        $Message = $this->sms->createMessage();
        $Message->setSender($sender);
        $Message->addReceiver($receiver);
        $Message->setIsMarketing($isMarketing);

        // Plan to send it in the future
        $Message->setDeliveryDate($deliveryDate);
        return $Message->send($message);
    }
    
    public function deleteMessage($message)
    {
        $message->delete();
    }
    
    public function getMessagesPlannifies()
    {
        return $this->sms->getPlannedMessages();
    }
    
    public function getHistoriqueMessages()
    {
        return $this->sms->getOutgoingMessages(null,null,"ClubNatBoug",null,null);
    }
    
    public function getSenders()
    {
        return $this->sms->getSenders();
    }
    
    public function getSmsRestant()
    {
        $account = $this->sms->getAccountDetails($this->sms->getAccount());
        return $account[creditsLeft] + $account[creditsHoldByQuota] ;
    }
}