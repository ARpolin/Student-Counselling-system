<?php

function admin_offer_course()
{
	return mysql_query("SELECT * FROM `coursereg`");
}

//---------------Course Register--------------
function course_register($register_data)
{
	array_walk($register_data, 'array_sanatize');
	$fields='`'.implode('`,`', array_keys($register_data)).'`';
	$data='\''.implode('\',\'',$register_data).'\'';
	mysql_query("INSERT INTO `coursereg`($fields) VALUES($data)");	 
}

//------------course name Exsits-------------
function course_name_exists($coursename)
{
	$coursename=sanatize($coursename);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `allcourses` WHERE `cname`='$coursename'"), 0)==1) ? true: false;
}

//------------course id Exsits-------------
function course_id_exists($courseid)
{
	$courseid=sanatize($courseid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `allcourses` WHERE `cid`='$courseid'"), 0)==1) ? true: false;
}

//-----------get message---------------
function delete_massage($id)
{
	return mysql_query("DELETE FROM `inbox` WHERE `id`='$id'");
}

//-----------get message---------------
function get_massage($id)
{
	return mysql_query("SELECT * FROM `inbox` WHERE `id`= '$id'");
}

//-----------Inbox Update---------------
function update_inbox()
{
	return mysql_query("UPDATE `inbox` SET open='1'");
}

//-----------All Inbox Page---------------
function all_inbox_paging()
{
	return mysql_query("SELECT * FROM `inbox`");
}

//-----------ALL Inbox---------------
function All_inbox($page,$userid)
{
	return mysql_query("SELECT * FROM `inbox` WHERE `from`='$userid' LIMIT $page,7");
	//return mysql_query("SELECT * FROM `inbox` LIMIT $page,10");
}

//---------------Send Message--------------
function send_message($message_data)
{
	array_walk($message_data, 'array_sanatize');
	$fields='`'.implode('`,`', array_keys($message_data)).'`';
	$data='\''.implode('\',\'',$message_data).'\'';
	echo $data;
	echo $fields;
	mysql_query("INSERT INTO `inbox`($fields) VALUES($data)");	 
}

//------------studentRegister-----------
function register_student($register_data)
{
	array_walk($register_data, 'array_sanatize');
	$register_data['password']=md5($register_data['password']);
	//print_r($register_data);
	$fields='`'.implode('`,`', array_keys($register_data)).'`';
	$data='\''.implode('\',\'',$register_data).'\'';
	mysql_query("INSERT INTO `student`($fields) VALUES($data)");	 
}

//---------------Faculty Register--------------
function register_faculty($register_data)
{
	array_walk($register_data, 'array_sanatize');
	$register_data['password']=md5($register_data['password']);
	//print_r($register_data);
	$fields='`'.implode('`,`', array_keys($register_data)).'`';
	$data='\''.implode('\',\'',$register_data).'\'';
	mysql_query("INSERT INTO `faculty`($fields) VALUES($data)");	 
}

//-----------Send Notice By Admin------------
function send_notice($Send_data)
{
	array_walk($Send_data, 'array_sanatize');
	//$Send_data['date']=date('Y-m-d H:m:s');
	//print_r($Send_data);
	$fields='`'.implode('`,`', array_keys($Send_data)).'`';
	//echo $fields;
	$data='\''.implode('\',\'',$Send_data).'\'';
	//echo $data;
	mysql_query("INSERT INTO `notice`($fields) VALUES ($data)");	
}

//----------Show notice to everyone.----------
function Show_notice()
{
	return mysql_query("SELECT `title`,`notice`,`post_time` FROM `notice` ORDER BY `post_time` DESC");
}

//---------All Course Search---------
function All_faculty_search($search)
{
	return mysql_query("SELECT * FROM `faculty` WHERE `userid` LIKE '%$search%' or `username` LIKE '%$search%'");
}

//---------All Course Search---------
function All_course_search($search)
{
	return mysql_query("SELECT * FROM `allcourses` WHERE `cname` LIKE '%$search%' or `cid` LIKE '%$search%'");
}

//-----------All Faculty Page---------------
function all_faculty_paging()
{
	return mysql_query("SELECT * FROM `faculty`");
}

//-----------ALL Faculty---------------
function All_faculty($page)
{
	return mysql_query("SELECT * FROM `faculty` LIMIT $page,10");
}

//-----------ALL course page---------------
function all_course_paging()
{
	return mysql_query("SELECT * FROM `allcourses`");
}

//-----------ALL courses---------------
function All_course($page)
{
	return mysql_query("SELECT * FROM `allcourses` LIMIT $page,10");
}

//--------------changePassword--------------
function admin_change_password($id,$password)
{
	$id=(int)$id;
	$password=md5($password);
	mysql_query("UPDATE `admin` SET `password`='$password' WHERE `id`=$id");
}

//-------------chage profile Images---------------------
function change_profile_image($id,$file_temp,$file_extn)
{
	$file_path='img/profile/'.substr(md5(time()),0,10).'.'.$file_extn;
 	move_uploaded_file($file_temp, $file_path);
 	mysql_query("UPDATE `admin` SET `profile`='".mysql_real_escape_string($file_path)."'WHERE `id`=".(int)$id );
}
//--------admin user data check----------
function adminuser_data($id)
{
	$data=array();
	$id=(int)$id;
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	if ($func_num_args>1) {
		unset($func_get_args[0]);
		$fields='`'.implode('`,`', $func_get_args).'`';
		//echo $fields;
		$data=mysql_fetch_assoc(mysql_query("SELECT $fields FROM `admin` WHERE `id`=$id"));
		return $data;
	}
}
//------------admin login----------------
function adminloggedin()
{
	return(isset($_SESSION['id'])) ? true:false;
}

//------------admin username exists--------------
function admin_username_exists($username)
{
	$username=sanatize($username);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `name`='$username'"), 0)==1) ? true: false;
}
//------------admin userid exists--------------
function admin_userid_exists($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `userid`='$userid'"), 0)==1) ? true: false;
}

// -------------Admin Active---------------
function admin_userid_active($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `userid`='$userid' AND `active`=1"), 0)==1) ? true: false;
}

//--------------if from admin userid ---------------
function id_from_adminuserid($userid)
{
	$userid=sanatize($userid);
	return mysql_result(mysql_query("SELECT `id` FROM `admin` WHERE `userid`='$userid'"),0,'id');
}

//-----------login -------------------
function adminlogin($userid,$password)
{
	$id=id_from_adminuserid($userid);
	$userid=sanatize($userid);
	$password=md5($password);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `admin` WHERE `userid`='$userid' AND `password`='$password'"), 0)==1) ? $id : false;
}
?>