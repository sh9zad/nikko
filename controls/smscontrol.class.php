<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 10/15/2014
 * Time: 9:30 AM
 */
include_once _PATH . 'base/controller.php';


class SMSController extends Controller{

    private $send_service;

    function SMSController(){
        $this->send_service = new SoapClient(_WSDL);
    }

    /**
     * @param $text array string, list of the text to be sent in the SMS.
     * @param $receiver array string, list of recipient phone numbers in international format without 00 or +. e.g. 989121234567
     * @param $send_num array string, list of numbers to be used for sending the SMSs.
     * @param $service_id array string, list of service IDs to be used for sending each SMS.
     */
    function send_sms($text, $receiver, $send_num, $service_id){
        /*
         *  $client = new SoapClient("http://10.20.9.8/websrv/services/SMS?wsdl");
        try {

             $result = $client->ServiceSend('karian',
                        '4aa71a7447f5f8b050441e3019afdf4c',
                        'alladmin',0,
                        array('Text'),
                        array('989124936721'),
                        array('982034'), null,null,
                        array('karian_4_test'));

        echo "result : " . print_r($result);

        }catch(Exception $e){
            die('could not connect to service !');
        }*/
        //echo $this->send_service->ServiceSend(_SRV_USER, _SRV_PASS, _SRV_DOMAIN, array('+98203850'), array('+989124936721', '+989197062557'), array('test from server'),0,null,null,array('karian_4_test'));

        try{
            $result = $this->send_service->ServiceSend(_SRV_USER, _SRV_PASS, _SRV_DOMAIN, 0, $text, $receiver,$send_num,null,null, $service_id);
        }
        catch (Exception $ex) {
            $result = "Could not connect to server. \n\n " . $ex->getMessage();
        }

        if(is_array($result) === true){
            print_r($result);
        }
        else{
            echo($result);
        }
    }
}