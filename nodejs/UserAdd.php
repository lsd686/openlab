<?php
require_once("sql.php");
$note=$_POST['note'];
$studid=$_POST['studid'];
$studname=$_POST['studname'];
$studcollege=$_POST['studcollege'];
$studmajor=$_POST['studmajor'];
$sql="INSERT INTO user (studId, studName, college,major,note) VALUES ('$studid', '$studname', '$studcollege','$studmajor','$note')";
$result = mysql_query($sql);
?>
<html>
<head>
</head>
<body onload="javascript:history.back()">
</body>
</html>