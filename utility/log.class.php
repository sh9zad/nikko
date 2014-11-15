<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 4/13/14
 * Time: 11:36 AM
 */

include_once ($_SERVER['DOCUMENT_ROOT'] . '/localkeeper3g/' . 'include/constants.inc');
include_once ('datecalc.class.php');

class Log {

    var $utility;

    function Log(){
        $this->utility = new DateCalc();
    }

    function writeLog($class_name, $log){
        $log_file = fopen(_LOG_PATH."log.txt", 'a') or die('Cannot open log file');

        $entry = '['.date("l jS F Y h:i:s A").'] - '.$class_name.' - '.$log."\n";

        fwrite($log_file, $entry);
    }

}