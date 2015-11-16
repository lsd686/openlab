<?php 
$con=mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_query("set names 'utf8'",$con);
mysql_select_db("openlab",$con) or die("connot connect openlab");
if(isset($_POST['alter']))
{
   	$userid=$_POST['userid'];
	$username=$_POST['username'];
	$actDetail=$_POST['actDetail'];
	$result=$_POST['result'];
	$resp=$_POST['resp'];
	$sql="UPDATE act SET userid='$userid', actDetail='$actDetail', result='$result',resp='$resp' WHERE userid='$userid'";
	$res = mysql_query($sql);
	
}
if(isset($_POST['del']))
{
   	$userid=$_POST['userid'];
	$sql="DELETE FROM act WHERE userid='$userid'";
	$res = mysql_query($sql);
}
?>