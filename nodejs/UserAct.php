<html>
<head>
<meta charset="utf-8"/>
<title>UserAct</title>
</head>
<body>
<h1>欢迎来到用户活动界面</h1>
<form  method="post">
	<table>
	<tr>
	<td>用户名：</td>
	<td><input name="username" type="text" class="inputtxt" size="50" "/></td>
	</tr>
	<tr>
	<td>用户ID：</td> 
	<td><input name="userid" type="text" class="inputtxt" size="50" onblur="validate()"/><div id="demo" ></div></td>
	</tr>
	<tr>
	<td>活动内容：</td> 
	<td><textarea name="actDetail" type="text" maxlength="1200"></textarea></td>
	</tr>
	<tr>
	<td>结果：</td>
	<td><textarea name="result" type="text" maxlength="1200" ></textarea></td>
	</tr>
	<tr>
	<td>反馈：</td>
	<td><textarea name="resp" type="text" maxlength="1200" ></textarea></td>
	</tr>
	</table>
	<button id="st" type="button" onClick="settime();">活动开始</button>
	<input id="time"  name="time" value="time" ></input>

	<br>
	<br>
	<button type="button" value="活动结束" style="width:70px;height:20px" onClick="gettime();">活动结束</button>
	<input id="time2"  name="time2" value="time2" disabled="none"></input>
</form>
<footer><p><a href="/Index.html">首页</a>Index</p></footer>
</body>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.js"></script>
  <script type = 'text/javascript'>
	   var time1;
   function settime()
   {
	   //time1=microtime(true);
	   var mydate=new Date();
	   var getmonth=mydate.getMonth()+1;
	   time1=mydate.getFullYear()+"-"+getmonth+"-"+mydate.getDate()+" "+mydate.getHours()+"-"+mydate.getMinutes()+"-"+mydate.getSeconds();
	   document.getElementsByName('time')[0].value=time1;
	   //var mytime=new date();
		//time1=mydate.getTime();
	   //document.getElementsByName('time')[0].value=time1;
   }
   function gettime()
   {
	   //alert("123");
	   var userid=document.getElementsByName('userid')[0].value;
	   //alert(userid);
	   var actDetail=document.getElementsByName('actDetail')[0].value;
	   //alert(actDetail);
	   var result=document.getElementsByName('result')[0].value;
	   //alert(result);
	   var resp=document.getElementsByName('resp')[0].value;
	   //alert(resp);
	   if(!time1)
	   {
		   alert("未获得开始时间");
		   return ;
	   }
	   var mydate2=new Date();
	   var getmonth2=mydate2.getMonth()+1;
	   var time2=mydate2.getFullYear()+"-"+getmonth2+"-"+mydate2.getDate()+" "+mydate2.getHours()+"-"+mydate2.getMinutes()+"-"+mydate2.getSeconds();
	   document.getElementsByName('time2')[0].value=time2;
	   
	   $.ajax({
				type : "POST",  
		        url : "information.php",  
		        dataType : 'json',  
		        data : {"starttime":time1,
						"endtime":time2,
						"userid":userid,
						"actDetail":actDetail,
						"result":result,
						"resp":resp
						},        
					async: true,
					cache: false,
		            success: function(data) {
				            alert("记录成功");
		            },  
			        error:function(){  
			            alert("错误，请检查你的学号");
			        }
	   });
	   
   }
   function validate()
   {
		var userid=document.getElementsByName('userid')[0].value;
		//alert(document.getElementById('demo').innerHTML);
		$.ajax({
				type : "POST",  
		        url : "ajax.php",
		        dataType : 'json',  
		        data : {
						"userid":userid
						},        
					async: true,
					cache: false,
		            success: function(data) {
						//alert(data.tf);
						if(data.tf=='t')
				            document.getElementById('demo').innerHTML="真确";
						else
							document.getElementById('demo').innerHTML="错误";
		            },
			        error:function(){
						alert("connect fail");
			        }
	   });
		
   }
  </script>
</html>