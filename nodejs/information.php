<?php 
$con=mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_query("set names 'utf8'",$con);
mysql_select_db("openlab",$con) or die("connot connect openlab");
if(isset($_POST['starttime']))
{
	
	$starttime=$_POST['starttime'];
   	$endtime=$_POST['endtime'];
   	$userid=$_POST['userid'];
   	$resp=$_POST['resp'];
	$actDetail=$_POST['actDetail'];
	$result=$_POST['result'];
	$sql="select * from user where id=$userid";
	$res = mysql_query($sql);
	//$black[error]="error";
	if(mysql_num_rows($res))
	{
		$sql="INSERT INTO act (userId, resp, actDetail,result,startTime,endTime) VALUES ('$userid', '$resp', '$actDetail','$result','$starttime','$endtime')";
		$res = mysql_query($sql);
		
	}
	else
	{
		echo json_encode($black[error]);
	}
	//$sql="INSERT INTO user (studId, studName, college,major,note) VALUES ('studid', 'studname', 'tudcollege','studmajor','note')";
	//$result = mysql_query($sql);
	//if(mysql_num_rows($res))
	//{
		//var_dump("error");
	//}
	//echo json_encode();
}
?>