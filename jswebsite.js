var http = require("http");
var fs = require("fs");
var qs = require("querystring");

var mysql = require("mysql");
var connection = mysql.createConnection({
	host: "localhost",
	user: "root",
	password: "",
	database: "openlab",
	port: "3306"
});
connection.connect();

var postData = "";
var start = "";
var end = "";
var myDate = new Date();


//***************************************************************************
var app = http.createServer(function(req, res ){
	if(req.method === "GET"){
		switch(req.url){
			case "/Index.html":
			fs.readFile("Index.html",function(err ,data){
				if(err) throw err;
				res.writeHeader(200,{"Content-Type":"text/html"});
				res.end(data.toString());
			});
			
			break;
			
			
			case "/UserAdd.html":
			fs.readFile("UserAdd.html",function(err ,data){
				if(err) throw err;
				res.writeHeader(200,{"Content-Type":"text/html"});
				res.end(data.toString());
			});
			break;
			
			case "/UserAct.html":
			fs.readFile("UserAct.html",function(err ,data){
				if(err) throw err;
				res.writeHeader(200,{"Content-Type":"text/html"});
				res.end(data.toString());
			});
			break;
			
			
			case "/ActDisp.html":
			var selectSQL = "select * from act";
						
			connection.query(selectSQL,function(err2,result,fields){
				if(err2){
					console.log("Getdata Error:" + err2);
				}
				if(result.length > 0){
					var firstresult = "";
					
					var	strHTML ="<html><head><title>ActDisplay</title></head><boby><fieldset>";
						strHTML+="<legend>user-activity display</legend>";
						strHTML+="<table border='1' bordercolor='#009900'>";
						strHTML+= "<tr><td>id</td>";
						strHTML+= "<td>userid</td>";
						strHTML+= "<td>starttime</td>";
						strHTML+= "<td>actDetail</td>";
						strHTML+= "<td>result</td>";
						strHTML+= "<td>resp</td>";
						strHTML+= "<td>endtime</td>";
						strHTML+= "</tr>";
					
					for(var i=0,len=result.length; i<len; i++)
					{
						firstresult = result[i];
						
						strHTML+= "<tr>";
						strHTML+= "<td>"+firstresult["id"]+"</td>";
						strHTML+= "<td>"+firstresult["userid"]+"</td>";
						strHTML+= "<td>"+firstresult["starttime"]+"</td>";
						strHTML+= "<td>"+firstresult["actDetail"]+"</td>";
						strHTML+= "<td>"+firstresult["result"]+"</td>";
						strHTML+= "<td>"+firstresult["resp"]+"</td>";
						strHTML+= "<td>"+firstresult["endtime"]+"</td>";
						strHTML+= "</tr></table>";
					}
					strHTML += "</fieldset></body></html>";
					res.writeHeader(200,{"Content-Type":"text/html"});
					res.end(strHTML.toString());					
				}
			});			
			break;

		}
	}
	else if(req.method === "POST"){		
		
		switch(req.url)
		{
			case '/UserAdd.js':
			
			req.on("data", function(chunck){
				postData += chunck;
			});
			
			req.on("end" ,function(){
				var website1 = qs.parse(postData);
				console.log(website1.studid);
				console.log(website1.studname);
				console.log(website1.studcollege);
				console.log(website1.studmajor);
				
				var insertSQl1 = "insert into user(studid,studname,college,major,note) values('"+website1.studid+"','"+website1.studname+"','"+website1.studcollege+"','"+website1.studmajor+"','"+website1.note+"')";			
				connection.query(insertSQl1,function(err0,res0){
					if(err0) console.log(err0);
					console.log("Insert Return==> ");
					console.log(res0);
				});
				res.end(postData);
			});
			
			break;
			
			
			
			case '/UserAct.js':
			
			postData = "";
			
			req.on("data" ,function(chunck){
				postData += chunck;
			});
			end = myDate.toLocaleString();
			
			req.on("end" ,function(){
				var website2 = qs.parse(postData);
				console.log("开始时间"+start);
				console.log(website2.userid);
				console.log(website2.result);
				console.log(website2.resp);
				console.log(website2.actDetail);
				console.log("结束时间"+end);
				
				var insertSQl2 = "insert into act(userid,starttime,endtime,actDetail,result,resp) value('"+website2.userid+"','"+start+"','"+end+"','"+website2.actDetail+"','"+website2.result+"','"+website2.resp+"')";
				connection.query(insertSQl2,function(err1,res1){
					if(err1) console.log(err1);
					console.log("Insert Return==> ");
					console.log(res1);
				});
				res.end(postData);
			});
			break;
			
			case '/inserttime.js':

			//var month = myDate.getMonth() + 1;
			//console.log(myDate.getFullYear()+"-"+month+"-"+myDate.getDate());
			
			start = myDate.toLocaleString();
			//console.log(myDate.toLocaleString());
			break;
			
		}
	}
});

app.listen(7798);