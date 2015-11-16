<?php
$con=mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_query("set names 'utf8'",$con);
mysql_select_db("openlab",$con);
?>