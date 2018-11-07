
<?php
date_default_timezone_set("Asia/Calcutta");
error_reporting(~E_NOTICE && E_WARNING);

class dbConnect
{
	private $mysqli;
	private $autoIncrementId;
	private $lastQueryNoOfRecords;
	function __construct($databasename = 'mini_car_inventory_system')
	{
		$this -> mysqli = new mysqli("localhost","root","", $databasename);
		
		$this -> mysqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		
		$this->autoIncrementId = 0;
		$this->lastQueryNoOfRecords = 0;
	}

	function __destruct()
	{
		$this -> mysqli -> close();
	}

	function FetchRecords($sqlQuery)
	{
		$result = $this -> mysqli->query($sqlQuery);
		$this->lastQueryNoOfRecords = $this -> mysqli -> affected_rows;
		if($this->lastQueryNoOfRecords <= 0)
		{
			if($this->lastQueryNoOfRecords == 0) $result -> free();
			return false;
		}
		else
		{
			$ArrReturn = array();
			while($row = $result->fetch_assoc())
			{
				$ArrReturn[] = $row;
			}
			$result -> free();
			return $ArrReturn;
		}
	}

	function InsertRecord($sqlQuery)
	{
		$result = $this -> mysqli->query($sqlQuery);

		$this->autoIncrementId = $this -> mysqli -> insert_id;

		return $this->autoIncrementId;
		
		//return $retVal;

	}


function UpdateRecord($sqlQuery)
	{
		//$this->theResult = $this -> mysqli->query($sqlQuery);
			$result = $this->mysqli->query($sqlQuery);

		// echo $this->theResult;
		// die();

		// return $this->theResult;
			if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return true;
        }        

}

	function FetchRecordsLarge($sqlQuery)
	{
		$this->theResult = $this -> mysqli->query($sqlQuery);
		$this->lastQueryNoOfRecords = $this -> mysqli -> affected_rows;
		if($this->lastQueryNoOfRecords <= 0)
		{
			if($this->lastQueryNoOfRecords == 0) $this->theResult -> free();
			return false;
		}
		else
		{
			return $this->theResult;
			//return $this->lastQueryNoOfRecords;
		}
	}

	function NoOfRecords($sqlQuery)
	{
		$result = $this -> mysqli->query($sqlQuery);
		$retVal = $this -> mysqli -> affected_rows;
		$this->lastQueryNoOfRecords = $retVal;
		$result -> free();
		return $retVal;
	}

function CountRows($sqlQuery)
	{
	$this->theResult = $this -> mysqli->query($sqlQuery);

		return $result;
}

	function getProperId($field, $table, $maxallowed=0)
	{
		$sql="SELECT max($field) AS maxfield FROM $table";
		if($maxallowed>0)
		{
			$sql .= " WHERE $field<=$maxallowed";
		}
		
		$Arr = $this -> FetchRecords($sql);
		return $Arr[0]['maxfield'] + 1;
	}
	
	function getCurrentDateTime()
	{
		$ArrDateTime = $this -> FetchRecords("SELECT NOW() AS currenttime");
		$srinidatetime = $ArrDateTime[0]['currenttime'];
		return $srinidatetime;
	}
	
	function runOtherQueries($sqlQuery, $withAutoIncrement=false)
	{
		$result = $this -> mysqli->query($sqlQuery);
		$this->lastQueryNoOfRecords = $this -> mysqli -> affected_rows;
		if($result === TRUE)
		{
			if($withAutoIncrement) $this->autoIncrementId = $this->mysqli->insert_id;
			return true;
		}
		else return false;
	//	if(mysql_error())
	}
	
	function returnAutoIncrementId()
	{
		return $this->autoIncrementId;
	}
	
	function affectedRows()
	{
		return $this->lastQueryNoOfRecords;
	}
}

?>
