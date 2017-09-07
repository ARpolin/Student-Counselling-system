<?php
$connect_error='There is a problem to connect in Database';
mysql_connect('localhost','root','')or die($connect_error);
mysql_select_db('sytem')or die($connect_error);
?>