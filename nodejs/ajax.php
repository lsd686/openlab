<?php 
$con=mysql_connect("localhost","root","") or die('Could not connect: ' . mysql_error());
mysql_query("set names 'utf8'",$con);
mysql_select_db("openlab",$con) or die("connot connect openlab");
if(isset($_POST['userid']))
{
   	$userid=$_POST['userid'];
	$sql="select * from user where id=$userid";
	$res = mysql_query($sql);
	//$black[error]="error";
	if(mysql_num_rows($res))
	{
		$black=array(
					'tf'=>'t'
		);
	}
	else
	{
		$black=array(
					'tf'=>'f'
		);
	}
	echo json_encode($black);
}
?>