<?php
//-----------get student---------------
function get_student($id)
{
	return mysql_query("SELECT student.userid,student.username FROM `student` INNER JOIN `jnct_course_student` ON student.userid = jnct_course_student.userid WHERE jnct_course_student.cid = '$id' ORDER BY student.username");
}
//-----------faculty Offer course------------
function faculty_offer_course($id)
{
	return mysql_query("SELECT * FROM `coursereg` WHERE `fid`='$id'");
}

//-----------get notes---------------
function get_notes($id)
{
	return mysql_query("SELECT * FROM `notes` WHERE `usersessoin`= '$id'");
}
//--------------Upload Files-----------
function upload_files($id,$file_temp,$file_extn)
{
	$file_path='downloads/'.substr(md5(time()),0,10).'.'.$file_extn;
 	move_uploaded_file($file_temp, $file_path);
 	mysql_query("UPDATE `notes` SET `path`='".mysql_real_escape_string($file_path)."'WHERE `usersessoin`=".(int)$id );
}
//--------------Insert Files-----------
function Insert_files($upload_data,$file_extn,$file_temp)
{
	array_walk($upload_data, 'array_sanatize');
	//$file_path='downloads/'.substr(md5(time()),0,10).'.'.$file_extn;
 	$fields='`'.implode('`,`', array_keys($upload_data)).'`';
	$data='\''.implode('\',\'',$upload_data).'\'';
	//move_uploaded_file($file_temp, $file_path);
 	mysql_query ("INSERT INTO `notes`($fields) VALUES($data)");

}
//------------ Faculty change Password----------------
function faculty_change_password($id,$password)
{
	$id=(int)$id;
	$password=md5($password);
	mysql_query("UPDATE `faculty` SET `password`='$password' WHERE `id`=$id");
}
//-------------chage profile Images---------------------
function faculty_profile_image($id,$file_temp,$file_extn)
{
	$file_path='img/profile/'.substr(md5(time()),0,10).'.'.$file_extn;
 	move_uploaded_file($file_temp, $file_path);
 	mysql_query("UPDATE `faculty` SET `profile`='".mysql_real_escape_string($file_path)."'WHERE `id`=".(int)$id );
}

//---------faculty Userdata--------------
function facultyuser_data($id)
{
	$data=array();
	$id=(int)$id;
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	if ($func_num_args>1) {
		unset($func_get_args[0]);
		$fields='`'.implode('`,`', $func_get_args).'`';
		//echo $fields;
		$data=mysql_fetch_assoc(mysql_query("SELECT $fields FROM `faculty` WHERE `id`=$id"));
		return $data;
	}
}
//------------admin login----------------
function facultyloggedin()
{
	return(isset($_SESSION['id'])) ? true:false;
}

//faculty exists
function facultyuserid_exists($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `faculty` WHERE `userid`='$userid'"), 0)==1) ? true: false;
}
//faculty check active
function facultyuserid_active($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `faculty` WHERE `userid`='$userid' AND `active`=1"), 0)==1) ? true: false;
}

//faculty login
//-------------
function id_from_facultyuserid($userid)
{
	$userid=sanatize($userid);
	return mysql_result(mysql_query("SELECT `id` FROM `faculty` WHERE `userid`='$userid'"),0,'id');
}
function facultylogin($userid,$password)
{
	$id=id_from_facultyuserid($userid);
	$userid=sanatize($userid);
	$password=md5($password);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `faculty` WHERE `userid`='$userid' AND `password`='$password'"), 0)==1) ? $id : false;
}
?>