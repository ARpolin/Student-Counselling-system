<?php
session_start();
//error_reporting(0);
require'database/connect.php ';
require'functions/adminuser.php';
require 'functions/facultyuser.php';
require 'functions/studentuser.php';
require'functions/general.php';
require 'class/includes.php';

if (adminloggedin() === true) {
	$session_user_id=$_SESSION['id'];
	$userdata=adminuser_data($session_user_id,'id','userid','name','password','profile'); 
	 //$userdata['userid'];
}
if (facultyloggedin() === true) {
	$fsession_user_id=$_SESSION['id'];
	$fuserdata=facultyuser_data($fsession_user_id,'id','userid','username','password','profile'); 
	//echo $fuserdata['profile'];
}
if (studentloggedin() === true) {
	$ssession_user_id=$_SESSION['id'];
	$suserdata=studentuser_data($ssession_user_id,'id','userid','username','password','profile','dob','session','phnnum','address'); 
	//echo $fuserdata['password'];
}
$error= array();
?>