<!DOCTYPE html>

<html>
<head>
     <meta charset="utf-8">
     <style>
		table {
			border-collapse: collapse;
		}

		table, th, td {
			border: 1px solid black;
		}
     </style>
     <script src="js/jquery-1.11.3.min.js"></script>
     <script type="text/javascript">
     $(document).ready(function(){
     	$("#retrieve").click(function(){
     		var param = $("#f").serialize();
		    $.ajax({
		        url:'getSummonerId.php',
		        dataType:'json',
		        method:'post',
		        data:param,
		        success:function(data){
		        	console.log(data);
		            addList(data);
		        },
		        error:function(e){
		        	alert("정보를 가져오는 데에 실패하였습니다. ");
		        	console.log(e);
		        }
		    });
     		
     	});

     	// function addList(data){
     	// 	var str = $("#resultTable").html() +
     	// 	"<tr><td>" + data.id + "</td>" +
     	// 	"<td>" + data.name + "</td>" +1
     	// 	"<td>" + data.summonerLevel + "</td></tr>";
     	// 	$("#resultTable").html(str);


     	// function addList(data){
     	// 	var str = $("#resultTable").html() +
     	// 	"<tr><td>" + data.champion + "</td>" +
     	// 	"<td>" + data.lane + "</td>" +
     	// 	"<td>" + data.role + "</td></tr>";
     	// 	$("#resultTable").html(str);


     	function addList(data){
     		var str = $("#resultTable").html() +
     		"<tr><td>" + data.full + "</td>" +
     		"<td>" + data.sprite + "</td>" +
     		"<td>" + data.x + "</td></tr>";
     		$("#resultTable").html(str);



     	}


     });
     </script>
</head>
<body>

<?php

	phpinfo();

?>

<div style="display: table; margin-left: auto; margin-right: auto;">

<form id="f" action="" method="post">
<table>
	<tr>
		<td>소환사명</td>
		<td><input type="text" id="username" name="username" class="box"/></td>
	</tr>
	<tr>
		<td>국가</td>
		<td><input type="text" id="nation" name="nation" class="box" value="kr"/></td>
	</tr>
	<tr>
		<td colspan="2" style="align:right">
			<button id="retrieve" type="button">조회</button>
		</td>
	</tr>
</table>
</form>

</div>

<table id="resultTable">
	<tr>
		<th>소환사번호</th>
		<th>소환사명</th>
		<th>소환사레벨</th>
	</tr>
</table>

<div>

</div>
  
</body>
</html>