<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "mm_db";

function getPDB() {	
	global $dbhost, $dbuser, $dbpass, $dbname;
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}

function getIDB() {
	global $dbhost, $dbuser, $dbpass, $dbname;
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if (!$conn || $conn->connect_error) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}

