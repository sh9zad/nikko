<?php


require_once 'model.class.php';

class Members extends Model{

	private $dbErrorHandler;
	private $rand_key = '0iJhdisQx85YhgfgIUGV66oVZep';

    private $member_roles;


	function Members(){
        parent::Model('members');

		$this->cols = array("id", "name", "familyname" ,
                            "username", "password", "type",
                            "manager_id", "email", "active", "picture");
        $this->schema = array("0", "txt", "txt" ,
            "txt", "0", "txt",
            "txt", "txt", "num", "img");
        $this->ids = array("0", "txt-user-name", "txt-user-familyname" ,
            "txt-user-username", "0", "txt-user-type",
            "txt-user-manager", "txt-user-email", "num-user-active", "img-user-image");

        $this->labels = array("0", "Name", "Family" ,
            "Username", "0", "Type",
            "Manager", "Email", "Active", "Image");

        $this->member_roles = new MembersRolesModel();
	}

	function connectDB(){
		$this->connection = new mysqli(HOST, USER, PASSWORD, DATABASE);

		if(mysqli_connect_error()){
			$this->dbErrorHandler = "Database Login Failed...";
			return false;
		}
		$this->connection->query("SET CHARACTER SET utf8;");
		return true;
	}

	function login($username, $password){
		if (!isset($_SESSION)) { session_start(); }
		if($this->connectDB()){
			$username = trim($username);
			$password = trim($password);

			$passMD5 = md5($password);

			$query = "
					SELECT * FROM `$this->tablename`
					WHERE
					username = '$username'
					AND
					password = '$passMD5'
					";

			$result = $this->executeQuery($query);

			if (!$result || mysqli_num_rows($result) <= 0){
				$this->dbErrorHandler = "Worng username and/or password.";
				return false;
			}

			$row = mysqli_fetch_assoc($result);

			$_SESSION['name_of_user']  = $row['name'] ." " . $row['familyname'];
			$_SESSION['type_of_user'] = $row['type'];
			$_SESSION['manager_of_user'] = $row['manager_id'];
			$_SESSION['CID'] = $row['id'];

			$_SESSION[$this->GetLoginSessionVar()] = $username;
			return true;
		}
		else {
			return true;
		}
	}

	function GetLoginSessionVar()
	{
		$retvar = md5($this->rand_key);
		$retvar = 'usr_'.substr($retvar,0,10);
		return $retvar;
	}

	function executeQuery($query){
		if($this->connectDB()){
			$result = $this->connection->query($query);
			if (!$result){
				$this->dbErrorHandler = "Could not execute query: ".$query."\r\n";
				return false;
			}
			return $result;
			}
		return false;
	}

	function CheckLogin()
	{
		if(!isset($_SESSION)){ session_start(); }

		$sessionvar = $this->GetLoginSessionVar();

		//echo $sessionvar . "<br>";

		if(empty($_SESSION[$sessionvar]))
		{
			return false;
		}
		return true;
	}

	function LogOut()
	{
		if (!isset($_SESSION)){session_start();}

		$sessionvar = $this->GetLoginSessionVar();

		$_SESSION[$sessionvar]=NULL;

		unset($_SESSION[$sessionvar]);
        unset($_SESSION['member']);
        if(isset($_SESSION['ACL'])){
            unset($_SESSION['ACL']);
        }
	}

	function getError(){
		return $this->dbErrorHandler;
	}

	function checkPassword($id, $md5_pass){
		$query = "
				SELECT * FROM `$this->tablename`
				WHERE id = $id AND password = '$md5_pass'
				";
		$res = $this->executeQuery($query);

		if (!$res || mysqli_num_rows($res) <= 0){
			return false;
		}
		return true;
	}

	function resetPassword($id, $new){
        //return $this->connectDB();
		if ($this->connectDB() == true){
            $new = md5($new);
            $query = "
                    UPDATE `$this->tablename`
                    SET
                        password = '$new'
                    WHERE
                        id = $id
                    ";

            return $this->executeQuery($query);
		}
        else{
            return false;
        }
	}

	function changePassword($id, $current, $new){
		$current = md5($current);

		if ($this->connectDB()){
			if ($this->checkPassword($id, $current)){
				$new = md5($new);
				$query = "
						UPDATE `$this->tablename`
						SET
							password = '$new'
						WHERE
							id = $id
						";

				return $this->executeQuery($query);
			}
			else{
				return 0;
			}
		}
	}

	function getUsers($id){
		$query = "
				SELECT * FROM `$this->tablename`
				WHERE manager_id = $id
				 ";

		$res = $this->executeQuery($query);

		$arr = array();
		while($row = $res->fetch_row()){
			$arr[] = $row;
		}

		return $arr;
	}

	function getAllUsers(){
		$query = "
				SELECT * FROM `$this->tablename`
				WHERE `$this->tablename`.id > 1
				";

		return $this->makeArrayDB($this->getResultArray($query));
	}

    function getUnAssignedUsers(){
        if (isset($_SESSION['CID']) && isset($_SESSION['ACL']) && $_SESSION['ACL']->isAdministrator($_SESSION['CID'])){
            $query = "SELECT * from `$this->tablename` where `$this->tablename`.id not in ( select distinct(member_id) from `tbl_members_roles` )";

            return $this->search($query);
        }
        else
            return null;
    }

    function checkUsername($username){
        $query = "SELECT COUNT(*) FROM `$this->tablename` WHERE `$this->tablename`.username = '$username'";

        return $query;
        return $this->search($query, array('count'));
    }

	function getUsersForSettings($active = 1){
		$query = "
				SELECT `$this->tablename`.*, `e`.fullname, `e`.familyname FROM `$this->tablename`
				JOIN `$this->tablename` e on e.`id` = `$this->tablename`.`manager_id`
				WHERE `$this->tablename`.id > 1 AND `$this->tablename`.active = $active
		";

		$col = $this->cols;
		$col[] = "manager_name";
        $col[] = "manager_family";
		return $this->makeArray($this->getResultArray($query), $col);

	}

    function getUserByRoles($role){
        $query = "SELECT `$this->tablename`.* FROM `tbl_members_roles`
                JOIN `members` ON `tbl_members_roles`.member_id = `members`.id
                JOIN `tbl_roles` ON `tbl_members_roles`.role_id = `tbl_roles`.id
                where `tbl_roles`.title = '$role'  ";

        return $this->search($query);
    }

	private function makeArray($array , $cols = null){
		$cols = ($cols == null) ? $this->cols : $cols;

		if (count($cols) < 0 || !isset($cols) || !$cols){
			return null;
		}


		if ($array != false && $array!=null && sizeof($array) > 0 && sizeof($array[0]) > 0)
		{
			$result = array();
			foreach ($array as $r){
				$tmp = array();
				for ($i = 0; $i < count($cols); $i++){
					$tmp[$cols[$i]] = $r[$i];
				}
				$result[] = $tmp;
			}

			return $result;
		}

		return null;
	}
}