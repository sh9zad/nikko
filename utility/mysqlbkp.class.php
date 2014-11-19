<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 4/15/14
 * Time: 2:41 PM
 */

include_once _PATH."include/constants.inc";
include_once _PATH."models/tablebackup.class.php";
include_once "log.class.php";

class MysqlBKP {
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $filename;
    private $file_handle;

    private $mysqli;
    private $error = false;

    private $return;

    private $logger;
    private $tableBackupLog;

    function MysqlBKP($host, $user, $pass, $db) {
        $this->database = $db;
        $this->hostname = $host;
        $this->password = $pass;
        $this->username = $user;

        $this->logger = new Log();
        $this->tableBackupLog = new TableBackupLog();

        $this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()){
            $this->error = true;
            $this->logger->writeLog("MysqlBKP", "Connect failed: ".mysqli_connect_error());
        }
		$this->mysqli->query("SET NAMES 'utf8'");
    }

    function createBackup($incrimental = false, $backup_id = null){
        if ($this->error){
            $this->logger->writeLog("MysqlBKP", "Previous Error prevents backup to be created.");
            return false;
        }

        $this->filename = "$this->database.BKP-".date('Y-m-d')."@".date('h.i.s').'.sql';

        if (function_exists('max_execution_time'))
            if ( ini_get('max_execution_time') > 0)
                set_time_limit(0);

        $this->checkDirectory();

        // Introduction information

        $this->return .= "--\n";
        $this->return .= "-- A Mysql Backup System \n";
        $this->return .= "--\n";
        $this->return .= '-- Export created: ' . date("Y/m/d") . ' on ' . date("h:i") . "\n\n\n";
        $this->return = "--\n";
        $this->return .= "-- Database : " . $this->database . "\n";
        $this->return .= "--\n";
        $this->return .= "-- --------------------------------------------------\n";
        $this->return .= "-- ---------------------------------------------------\n";
        $this->return .= 'SET AUTOCOMMIT = 0 ;' ."\n" ;
        $this->return .= 'SET FOREIGN_KEY_CHECKS=0 ;' ."\n" ;

        $result = $this->mysqli->query('SHOW TABLES' ) ;
        $tables = array();
        while ($row = $result->fetch_row())
        {
            $tables[] = $row[0] ;
        }



        foreach($tables as $table){

            /* If it's an incremental backup find the last inserted id from the table_backup_log table. */
            if ($incrimental && $backup_id != null){

                $query = "SELECT * FROM `".$this->tableBackupLog->getTablename()."` WHERE `table_name` = '$table' AND `backup_id` = '$backup_id' ORDER BY `id` DESC LIMIT 1";



                $last_id = $this->tableBackupLog->search($query);

                $last_id = (sizeof($last_id) == 1) ? $last_id[0]['last_id'] : 0;
            }

            //$last_id = $this->mysqli->query("SELECT MAX(`id`) FROM ")
            $query = ($last_id != 0) ? 'SELECT * FROM `'.$table."` WHERE `id` > ".$last_id : 'SELECT * FROM `'.$table.'`';
            $this->logger->writeLog("MysqlBKP","Incremental Backup for table: ". $query);

            $result = $this->mysqli->query($query);
            $num_fields = $this->mysqli->field_count;
            $this->return .= "--\n" ;
            $this->return .= '-- Tabel structure for table `' . $table . '`' . "\n" ;
            $this->return .= "--\n" ;
            $this->return.= 'DROP TABLE  IF EXISTS `'.$table.'`;' . "\n" ;

			//echo $table." : ";
            $shema = $this->mysqli->query('SHOW CREATE TABLE `'.$table.'`') ;
			//print_r($shema);
			//echo "<br>";
            $tableshema = $shema->fetch_row() ;
            $this->return.= $tableshema[1].";" . "\n\n" ;
            while($rowdata = $result->fetch_row()){
                $this->return .= 'INSERT INTO `'.$table .'`  VALUES ( '  ;
                for($i=0; $i<$num_fields; $i++){
                    $this->return .= '"'.$rowdata[$i] . "\"," ;
                }
                $this->return = substr("$this->return", 0, -1) ;
                $this->return .= ");" ."\n" ;
            }
            $this->return .= "\n\n" ;

            $query = "SELECT MAX(`id`) FROM `$table`";
            $result = $this->mysqli->query($query)->fetch_row();

            if ($this->tableBackupLog->insert(array($backup_id, $table, $result[0], date('Y-m-d').'@'.date('h-i-s'))) != false){
                $this->logger->writeLog("MysqlBKP","Incremental Backup for table: ". $table);
            }
        }

        $this->mysqli->close() ;

        $this->return .= 'SET FOREIGN_KEY_CHECKS = 1 ; '  . "\n" ;
        $this->return .= 'COMMIT ; '  . "\n" ;
        $this->return .= 'SET AUTOCOMMIT = 1 ; ' . "\n"  ;



        $this->file_handle = fopen(_BKP_DIR.$this->filename, 'w') or die('Cannot open log file');
        if (fwrite($this->file_handle, $this->return) != false){
            $this->logger->writeLog("MysqlBKP", "Backup Created.");
            fclose($this->file_handle);
            return true;
        }
        else {
            $this->logger->writeLog("MysqlBKP", "Backup couldn't be Created.");
            fclose($this->file_handle);
            return false;
        }
    }

    private function checkDirectory(){
//        if (!file_exists(_BKP_DIR)) mkdir(_BKP_DIR , 0700) ;
//        if (!is_writable(_BKP_DIR)) chmod(_BKP_DIR , 0700) ;
//
//        $content = 'deny from all' ;
//        $this->file_handle = new SplFileObject(_BKP_DIR . '/.htaccess', "w") ;
//        $this->file_handle->fwrite($content) ;
    }

    function getFileName(){
        return $this->filename;
    }
}