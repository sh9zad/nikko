<?php

include_once 'dbManager.class.php';

/**
 * Class Model
 * Managing access to the tables. Extends the DBManager in order to provide access to the database.
 * The details of the tables like columns, schemas and the rest are defined within this class.
 * @extends DBManager
 */
class Model extends DBManager {
	
	
	protected $schema; /**< Array holding the schema of the table. The associative array contains the name of the column and the details. */
    protected $tablename; /**< String value. Holding the name of the table. Each child will have to fill this value.*/

	var $cols; /**< Array holding the column names of the table. The actual column names should be used.*/
	var $labels; /**< Array relative to the cols variable. Could be used to automatically print the labels. */
    var $ids; /**< Array holding identifier names for the columns of the model. This will be set and used for auto from generation. */
    var $control;
    /**
     * Default constructor of the class. The table name should be provided for the methods to perform properly.
     * @param $tablename String, The name of the table that the child model class is managing.
     */
    function Model($tablename){
        $this->tablename = $tablename;

        parent::DBManager();
    }

    function __destruct(){
        //$this->connection->close();
    }

    /**
     * Returns the name of the table that this class is managing.
     * @return mixed
     */
    function getTablename(){
        return $this->tablename;
    }

    /**
     * insert the data into the table. Based on the $cols variable the $arg should be entered to the function.
     * @param $arg array the array of data to be inserted to the table. Each row should be inserted separately.
     * @return bool|integer false if insert is not successful otherwise the ID number on the inserted row.
     */
    function insert($arg){
		$query = "INSERT INTO `$this->tablename` (";
		foreach ($this->cols as  $key => $value){
			if ($key != 'id')
				$query .= "`".$value."`,";
		}
		$query = substr($query,0,-1);
		$query .= ") VALUES (";
		foreach ($arg as $data){
			$query .= "'$data', ";
		}
		$query = substr($query,0,-2);
		$query .= " )";
		
		//return $query;

		$result = $this->executeQuery($query);


		if (!$result || $result == null){
			return false;
		}
		else {
            //$this->connectDB();
            $result = $this->connection->insert_id;
            //$this->connection->close();
			return $result;
		}

	}

    /**
     * Deletes the row int he table based ont he id number of that row.
     * @param $id The id number of the row that is supposed to be deleted.
     * @return bool|mysqliresult false if delete is not successful else the mysqliresult.
     */
    function delete($id){
		$query = "DELETE FROM `$this->tablename` WHERE `id` = $id";
		//return $query;
		return $this->executeQuery($query);
	}

    /**
     * The update function for the table data.
     * @param $arg array List of new data to be updated in the table. All the table columns should be added.
     * @param $id number The id number of the row to be changed.
     * @return bool|mysqliresult false if update is not successful else the mysqliresult.
     */
    function update($arg, $id){
		$query = "UPDATE `$this->tablename`  SET ";
		$i = 0;
		foreach ($arg as $key => $value){
			if($key == "id") continue;
			
			$query .= "`".$key."`='".$value."', ";
		}
		$query = substr($query,0,-2);
		$query .= " WHERE `id` = $id";
		//return $query;
		return $this->executeQuery($query);
	}

    /**
     * Returns the all rows or specific row of the table.
     * @param null $id If no values is entered for the id, all the data will be returned otherwise only the row with specific id number.
     * @param null $order_by If set to a name of a column, then the query results will be ordered on that column. Must be a valid column name though.
     * @param String $order_type By default the order will be Ascending unless Descending (DESC) has been provided via this parameter.
     * @return array Associative array with column names mentioned in $cols and the results from the select query.
     */
    function getList($id = null, $order_by = null, $order_type = 'ASC'){
		$query = "SELECT * FROM `$this->tablename`";
		$query .= ($id != null) ? " WHERE `id`=$id" : "";
		$query .= ($order_by != null) ? " ORDER BY `$order_by` $order_type" : "";

		
		return $this->makeArrayDB($this->getResultArray($query));
	}

    /**
     * A general function for executing any query required. Usually used for JOIN selects and complex queries.
     * The function will return an associative array as a result. The columns will either be selected from the $cols variable or the user entered data.
     * @param $query string The SQL query that has to be executed.
     * @param null $res_cols If no value is provided the function uses the $cols variable for the associative array of the return value.
     * @return array An associative array containing the result fo the query.
     * @see makeArrayDB
     */
    function search($query, $res_cols = null){

        $res_cols = ($res_cols == null) ? $this->cols : $res_cols;

        //return $query;
        //return $this->getResultArray($query);

		return $this->makeArrayDB($this->getResultArray($query), $res_cols);
	}

    /**
     * Stes the schema of the table.
     * @param $schema Associative array.
     */
    function setSchema($schema){
		$this->schema = $schema;
	}

    /**
     * Get the schema of the table from the variable.
     * @return mixed
     */
    function getSchema(){
		return $this->schema;
	}

    /**
     * Creates an associative array based on the regular array provided and the name of the columns.
     * Best used for preparing the result of queries for the Ajax and JSON return values.
     * @param $array The regular array which we want to change to associative.
     * @param null $cols If provided the result will be based on the names of this variable otherwise the default class $cols variable will be used.
     * @return array An associative array created wi the data provided.
     */
    protected function makeArrayDB($array, $cols = null){
		$c = ($cols == null) ? $this->cols : $cols;
	
		if ($c == null || sizeof($c) < 1) return;
	
		$result = array();
	
		if (is_array($array) && sizeof($array) > 0){
			foreach ($array as $ar){
				$tmp = array();
				for($i = 0; $i <sizeof($c); $i++){
					$tmp[$c[$i]] = $ar[$i];
				}
				$result[] = $tmp;
			}
		}
		return $result;
	}

    function getTableInfo(){
        $result['cols'] = $this->cols;
        $result['labels'] = $this->labels;
        $result['schema'] = $this->schema;
        $result['ids'] = $this->ids;
        $result['control'] = $this->control;
        return $result;
    }
    function getTableInfoShow($schema,$labels,$cols){
        $result['labels'] = $labels;
        $result['schema'] = $schema;
        $result['cols'] = $cols;
        return $result;
    }
}