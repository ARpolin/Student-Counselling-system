<?php
//----------Show discussion.----------
function Show_discussion()
{
	return mysql_query("SELECT `subject`,`description`,`post_time` FROM `discussion` ORDER BY `post_time` DESC");
}
//-----------Discussion------------
function send_discussion($Send_data)
{
	array_walk($Send_data, 'array_sanatize');
	//$Send_data['date']=date('Y-m-d H:m:s');
	//print_r($Send_data);
	$fields='`'.implode('`,`', array_keys($Send_data)).'`';
	//echo $fields;
	$data='\''.implode('\',\'',$Send_data).'\'';
	//echo $data;
	mysql_query("INSERT INTO `discussion`($fields) VALUES ($data)");	
}

//---------------Fill Student----------
function student_fill($id)
{
	return mysql_query("UPDATE `coursereg` SET `fill` = `fill`+ 1 WHERE `cid` = '$id'");
}

//---------------student userid exits in junction table----------
function student_exists_courses($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `jnct_course_student` WHERE `userid`='$userid'"), 0)==1) ? true: false;
}
//---------------student course exits----------
function student_course_exists($courseid)
{
	$userid=sanatize($courseid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `jnct_course_student` WHERE `cid`='$courseid'"), 0)==1) ? true: false;
}
//------------ student update info----------------
function student_update_info($id,$dob,$session,$number,$address)
{
	$id=(int)$id;
	$password=md5($password);
	mysql_query("UPDATE `student` SET `dob`='$dob', `session`='$session',`phnnum`='$number',`address`='$address' WHERE `id`=$id");
}

//-----------get course---------------
function get_course($id)
{
	return mysql_query("SELECT coursereg.cid,coursereg.cname,coursereg.csec,coursereg.ctime,coursereg.credit,coursereg.session,coursereg.fname FROM `coursereg` INNER JOIN `jnct_course_student` ON coursereg.cid = jnct_course_student.cid WHERE jnct_course_student.userid = '$id' ORDER BY coursereg.cname");
}
//--------------get Course ID-----------
function insert_course_id($cid,$sid)
{
	return mysql_query("INSERT INTO `jnct_course_student`(`cid`,`userid`) VALUES ('$cid','$sid')");
}

//------student offer course---------
function student_offer_course()
{
	return mysql_query("SELECT * FROM `coursereg`");
}

//------------ student change Password----------------
function student_change_password($id,$password)
{
	$id=(int)$id;
	$password=md5($password);
	mysql_query("UPDATE `student` SET `password`='$password' WHERE `id`=$id");
}

//------------- student change profile Images---------------------
function student_profile_image($id,$file_temp,$file_extn)
{
	$file_path='img/profile/'.substr(md5(time()),0,10).'.'.$file_extn;
 	move_uploaded_file($file_temp, $file_path);
 	mysql_query("UPDATE `student` SET `profile`='".mysql_real_escape_string($file_path)."'WHERE `id`=".(int)$id );
}
//--------student user data check----------
function studentuser_data($id)
{
	$data=array();
	$id=(int)$id;
	$func_num_args=func_num_args();
	$func_get_args=func_get_args();
	if ($func_num_args>1) {
		unset($func_get_args[0]);
		$fields='`'.implode('`,`', $func_get_args).'`';
		//echo $fields;
		$data=mysql_fetch_assoc(mysql_query("SELECT $fields FROM `student` WHERE `id`=$id"));
		return $data;
	}
}
//------------student login----------------
function studentloggedin()
{
	return(isset($_SESSION['id'])) ? true:false;
}

//-----------student exists---------------

function studentuserid_exists($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `student` WHERE `userid`='$userid'"), 0)==1) ? true: false;
}
function studentuserid_active($userid)
{
	$userid=sanatize($userid);
	return ( mysql_result(mysql_query("SELECT COUNT(`id`) FROM `student` WHERE `userid`='$userid' AND `active`=1"), 0)==1) ? true: false;
}
//student login
//-------------
function id_from_studentuserid($userid)
{
	$userid=sanatize($userid);
	return mysql_result(mysql_query("SELECT `id` FROM `student` WHERE `userid`='$userid'"),0,'id');
}
function studentlogin($userid,$password)
{
	$id=id_from_studentuserid($userid);
	$userid=sanatize($userid);
	$password=md5($password);
	return (mysql_result(mysql_query("SELECT COUNT(`id`) FROM `student` WHERE `userid`='$userid' AND `password`='$password'"), 0)==1) ? $id : false;
}

?>