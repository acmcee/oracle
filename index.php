<?php   
$password = "admin"; // 这里是密码  
$p = "";  
$isview=false;
if(isset($_COOKIE["isview"]) and $_COOKIE["isview"] == $password){  
	$isview = true;  
}else{  
	if(isset($_POST["pwd"])){  
		if($_POST["pwd"] == $password){  
			setcookie("isview",$_POST["pwd"],time()+3600*3);  
			$isview = true;  
		}else{  
			$p = (empty($_POST["pwd"])) ? "需要密码才能查看，请输入密码。" : "密码不正确，请重新输入。";  
		}  
	}else{  
		$isview = false;  
		$p = "请输入密码查看，获取密码可联系我。";  
	}  
}  

if($isview){ 
	require("main.php");
}
else{ ?>  
<!DOCTYPE html>
<html lang="zh-CN">
    <head> 
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="pragma" content="no-cache" />  
	<meta http-equiv="cache-control" content="no-cache" />  
	<meta http-equiv="expires" content="0" />  	
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./css/style.css"/> 
	<title>访问密码验证</title>  
	
<style type="text/css">  
  
#foot {
	position: absolute;
	left: 49.9%;
	top: 49.9%;
	margin-left: -160px;
	margin-top: 200px;
}
.passport {
	margin: 0 auto;
    text-align: center;
    margin-top: 200px;
}
</style>  
	</head>
<body>
<div class="passport">  
	<div style="padding-top:20px;">  
		<form action="" method="post" style="margin:0px;" class="form-inline">
		<div class="form-group">
				<input type="password" name="pwd" class="form-control" id="InputPass" placeholder="Password"/> 
			<input type="submit" value="查看" class="btn btn-primary"/>  
		  </div>
		</form>  
		<div style="margin-top:10px;">
			<p class="small"><?php echo $p; ?>  </p>
		</div>
	</div>  
</div>  
<?php  
require("./body/footer.php");
} 
?>  

<!-- 如果要使用Bootstrap的js插件，必须先调入jQuery -->
        <script src="./js/jquery-2.2.0.min.js"></script>
        <!-- 包括所有bootstrap的js插件或者可以根据需要使用的js插件调用　-->
        <script src="./js/bootstrap.min.js"></script> 

</body>  
</html> 