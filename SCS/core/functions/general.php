<?php
function array_sanatize(&$item)
{
	$item=mysql_real_escape_string($item);
}
function sanatize($data)
{
	return mysql_real_escape_string($data);
}
function output_errors($error)
{
	return '<ul style=" list-style-type: none;"><li>'.implode('</li><li>', $error).'</li></ul>';
}
?>