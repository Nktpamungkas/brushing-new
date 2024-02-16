<?php
$host="10.0.4.7\SQLEXPRESS";
//$host="DIT\MSSQLSERVER08";
$username="sa";
$password="123";
$db_nameLab="LABORAT";

set_time_limit(600);
$connInfo = array( "Database"=>$db_name, "UID"=>$username, "PWD"=>$password);
$conn2     = sqlsrv_connect( $host, $connInfo);