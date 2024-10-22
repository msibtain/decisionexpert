<?php
class db
{
	var $con;
	
function __construct()
{
$this->con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die('Error connecting to server');
mysqli_select_db($this->con, DB_DATABASE) or die('Error connecting to database');
}
function query($query)
{
//echo $query . "<br />";
return mysqli_query($this->con, $query);
}
function result_array($result)
{
$row = mysqli_fetch_array($result);
return $row;
}
function result_object($result)
{
$row = mysqli_fetch_object($result);
return $row;
}
function num_rows($result)
{
return mysqli_num_rows($result);
}
function sql_result($rs, $i, $col)
{
return mysqli_result($rs, $i, $col);
}
function error()
{
return mysqli_error($this->con);
}
function insert_id()
{
return mysqli_insert_id($this->con);
}
function insert($table, $set)
{
$query = "INSERT into `$table` SET $set";
if ($this->query($query))
return true;
else
return false;
}
function update($table, $set, $where)
{
$query = "UPDATE `$table` SET $set WHERE $where";
if ($this->query($query))
return true;
else
return false;
}
function select($table, $col = '*', $where = '1', $orderby = '')
{
if ($orderby)
$orderby = " ORDER BY $orderby";
$select = array();
$result = $this->query("SELECT $col FROM `$table` WHERE $where $orderby") or die($this->error());
while ($row = $this->result_object($result))
{
$select[] = $row;
}
return $select;
}
function delete($table, $where)
{
$query = "DELETE  FROM `$table` WHERE $where";
if ($this->query($query))
return true;
else
return false;
}
function DateDb2Web($date)
{
if ($date)
{
#arrange it into mm/dd/yyyy
#0000-00-00
$y = substr($date,0,4);
$m = substr($date,5,2);
$d = substr($date,8,2);
return $m."/".$d."/".$y;
}
else
return;
}
function DateWeb2Db($date)
{
if ($date)
{
#arrange into yyyy-mm-dd
#mm/dd/yyyy
$y = substr($date,6,4);
$m = substr($date,0,2);
$d = substr($date,3,2);
return $y."-".$m."-".$d;
}
else
return;
}

function get_results($query)
{
	$select = array();
	$result = $this->query($query);
	while ($row = $this->result_object($result))
	{
		$select[] = $row;
	}
	return $select;
}

}
?>