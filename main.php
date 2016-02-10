<!DOCTYPE html>
<html lang="zh-CN">
    <head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oracle数据库列表</title>
        
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<!-- 以下两个插件用于在IE8以及以下版本浏览器支持HTML5元素和媒体查询，如果不需要用可以移除 -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
		<link type="text/css" rel="stylesheet" href="./css/style.css"/> 
    </head>
    <body>
    <?php 
        ini_set("error_reporting","E_ALL & ~E_NOTICE");
		
		if(!$isview){
            echo "<div class =\"smile\"> <div class=\"bigsmile\">:) </div>  DON'T OPEN THIS PAGE! <br />
			<div class=\"ssmile\">redirecting...</div></div> <br />";
			header("refresh:2;url=index.php");
			exit;}
        ?>
<!-- 输出系统等级-->

<div class="header">
<?php
	require("./body/navbar.html");
?>
</div>
<br>

<div id="result">
    <?php
    $config=include './body/config.php';
    $con = mysqli_connect( $config['host'],$config['username'],$config['password'],$config['dbname']);
    $page=isset($_GET['page'])?intval($_GET['page']):1; 
    $dir=isset($_GET['dir'])?$_GET['dir']:"all"; 
	$keyword=isset($_GET['keyword'])?$_GET['keyword']:""; 

    
	//这句就是获取page中的值，假如不存在page，那么页数就是1。
	$num=30;         //每页显示30条数据
	if (!$con)
	{
	die('Could not connect to database: ' . mysql_error());
	}
	
	if (!mysqli_query($con,'SET NAMES UTF8')){echo "<div class =\"smile\"> <div class=\"bigsmile\">:( </div> DON'T SUPPORT CHINESE! </div>.<br />";exit;} 


    $offset=($page-1)*$num; 
//获取limit的第一个参数的值 offset ，
//假如第一页则为(1-1)*10=0,第二页为(2-1)*10=10。(传入的页数-1) * 每页的数据 得到limit第一个参数的值 
if ($page=="help")  {//判断是不是help页面，是则输出help，否则进行判断数据库的输出。
	require("./body/help.html");
}
else {
	if (($keyword=="") && ($_GET['search_con']=="")) { //首先判断无关键词设置且搜索联系人未设置，如果设置的话直接搜索联系人。
		switch ($dir)
		{
			case "all":
			$category="所有";
			break;
			case "core":
			$category="核心系统";
			break;
			case "import":
			$category="重要系统";
			break;
			case "regular":
			$category="一般系统";
			break;
			case "release":
			$category="准发布";
			break;
			case "disaster":
			$category="容灾";
			break;
			case "BC":
			$category="BC";
			break;
			default:
			$category="";
		}
	
		if($dir == "all"){	//如果dir是all，那么查询所有的。
			$total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle`"));
			echo "<h1>oracle数据库数量为：".$total."</h1>";
			
			$pagenum=ceil($total/$num);      //获得总页数 pagenum
			
			if($page>$pagenum || $page == 0){
				echo "<div class =\"smile\"> <div class=\"bigsmile\">:( </div> no result </div>.<br />";
					require("./body/footer.php");
					exit;
				}
	
			$info=mysqli_query($con,"select * from `oracle` limit $offset,$num ");   //获取相应页数所需要显示的数据
			//echo "<hr>";
			echo "<table  class=\"table\">";
			echo  "<tr><th>ID</th><th>系统域</th><th>系统等级</th><th>数据库名</th><th>TNS(4A)</th><th>TNS(OLD)</th>
			<th>主机名</th><th>IP</th><th>VIP</th><th>域名</th></tr>";
			While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
				echo "<tr><td>".$it["ID"]."</td><td>".$it["sys_domain"]."</td><td>".$it["sys_level"]."</td><td>".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["OLDTNS"]."</td><td>".$it["hostname"]."</td><td>".$it["ip"]."</td><td>".$it["vip"]."</td><td>".$it["domain"]."</td></tr>";
			}  
			echo "</table>";
			echo "<hr>";
			?>
			<div id= "con">
			<nav>
			<ul class="pagination pagination-lg">
			<?php
			//echo "<div id= \"con\">";
			For($i=1;$i<=$pagenum;$i++){
				echo "<li>";
				$show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<a href=##>$i</a>";
				echo $show."</li>";
			}
			//echo "</div>";?>
			</ul>
		</nav>
		</div>
		<?php
		}
		
		else { //如果dir不是all，那么查询相应分类的数据信息。 （dir为设置首页进去进入此逻辑）
			$total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where ifnull(sys_level,\"\") like '%".$category."%'"));
			echo "<h1>oracle".$category."数据库数量为：".$total."</h1>";
			$pagenum=ceil($total/$num);      //获得总页数 pagenum
			
			if($page>$pagenum || $page == 0){
				echo "<div class =\"smile\"> <div class=\"bigsmile\">:( </div> no result </div>.<br />";
					require("./body/footer.php");
					exit;
				}
				//echo "<hr>";
				$info=mysqli_query($con,"select * from `oracle` where ifnull(sys_level,\"\") like '%".$category."%' limit $offset,$num "); 
				echo "<table class=\"table\">";
				echo  "<tr><th>ID</th><th>系统域</th><th>数据库名</th><th>TNS(4A)</th><th>TNS(OLD)</th>
				<th>主机名</th><th>IP</th><th>VIP</th><th>域名</th></tr>";
				While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
					echo "<tr><td>".$it["ID"]."</td><td>".$it["sys_domain"]."</td><td>".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["OLDTNS"]."</td><td>".$it["hostname"]."</td><td>".$it["ip"]."</td><td>".$it["vip"]."</td><td>".$it["domain"]."</td></tr>";
				}  
				echo "</table>";
				echo "<hr>";
				
				?>
				<div id= "con">
				<nav>
				<ul class="pagination pagination-lg">
				<?php
				//echo "<div id= \"con\">";
				For($i=1;$i<=$pagenum;$i++){
					echo "<li>";
					$show=($i!=$page)?"<a href='index.php?page=".$i."&dir=$dir'>$i</a>":"<a href=##>$i</a>";
					echo $show."</li>";
				}
				//echo "</div>";?>
				</ul>
			</nav>
			</div>
			<?php
			
			}
		}  
	else{  //有关键词设置或者搜索联系人已设置，搜索联系人。
			//echo $keyword;
			$total=mysqli_num_rows(mysqli_query($con,"select 1 from `oracle` where (ifnull(`ip`,\"\") like '%".$keyword."%' or ifnull(`vip`,\"\") like '%".$keyword."%') or  ifnull(hostname,\"\") like '%".$keyword."%' or (ifnull(tns,\"\") like '%".$keyword."%' or ifnull(oldtns,\"\") like '%".$keyword."%') or (ifnull(`desc`,\"\") like '%".$keyword."%'  or ifnull(`system`,\"\") like '%".$keyword."%') or ifnull(domain,\"\") like '%".$keyword."%' ;"));
			$info=mysqli_query($con,"select * from `oracle` where (ifnull(`ip`,\"\") like '%".$keyword."%' or ifnull(`vip`,\"\") like '%".$keyword."%') or  ifnull(hostname,\"\") like '%".$keyword."%' or (ifnull(tns,\"\") like '%".$keyword."%' or ifnull(oldtns,\"\") like '%".$keyword."%') or (ifnull(`desc`,\"\") like '%".$keyword."%'   or ifnull(`system`,\"\") like '%".$keyword."%') or ifnull(domain,\"\") like '%".$keyword."%' limit $offset,$num;");
	
			$nout="";
		
		if ($keyword!=""){ // 判断关键字未空
			$nout=$nout."，关键字为".$keyword;
		}
	
		if(isset($_GET['search_db'])) {//如果搜索数据库设置了值，则搜索数据库信息
			echo "<h1> ".substr($nout,3)."的查询结果数为:".$total."</h1>";
		}else {	//否则搜索联系人信息
			if ($keyword=="" ){
				echo "<h1> 数据库联系人的结果数为:".$total."</h1>";        
			}
			else {
				echo "<h1> ".substr($nout,3)."的联系人查询结果数为:".$total."</h1>";    
			}
		}
	
		$pagenum=ceil($total/$num); 
		//获取总页数
		if($page>$pagenum || $page == 0){
			echo "<div class =\"smile\"> <div class=\"bigsmile\">:( </div> no result </div>.<br />";
				require("./body/footer.php");
				exit;
			}
			//echo "<hr>";
			echo "<table class=\"table\" >";
			if(isset($_GET['search_db'])) {//如果搜索数据库设置了值，则搜索数据库信息
				echo  "<tr><th>ID</th><th>系统域</th><th>数据库名</th><th>TNS(4A)</th><th>TNS(OLD)</th>
				<th>主机名</th><th>IP</th><th>VIP</th><th>域名</th></tr>";
				While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
					echo "<tr><td>".$it["ID"]."</td><td>".$it["sys_domain"]."</td><td>".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["OLDTNS"]."</td><td>".$it["hostname"]."</td><td>".$it["ip"]."</td><td>".$it["vip"]."</td><td>".$it["domain"]."</td></tr>";
				}  
			}else {//搜索联系人信息返回
				echo  "<tr><th>ID</th><th>数据库名</th><th>TNS(4A)</th><th>局方</th>
				<th>局方电话</th><th>乙方</th><th>乙方电话</th></tr>";
				While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
					echo "<tr><td>".$it["ID"]."</td><td >".$it["desc"]."</td><td>".$it["TNS"]."</td><td>".$it["jufang"]."</td><td>".$it["jufang_tel"]."</td><td>".$it["yifang"]."</td><td>".$it["yifang_tel"]."</td></tr>";
				}
			}
			echo "</table>";
			echo "<hr>";
			
			?>
				<div id= "con">
				<nav>
				<ul class="pagination pagination-lg">
				<?php
				//echo "<div id= \"con\">";
				For($i=1;$i<=$pagenum;$i++){
					echo "<li>";
					if(isset($_GET['search_db'])) {
						$show=($i!=$page)?"<a href='index.php?page=".$i."&keyword=$keyword&search_db=y'>$i</a>":"<a href=##>$i</a>";
					}
					else{
						$show=($i!=$page)?"<a href='index.php?page=".$i."&keyword=$keyword&search_con=y'>$i</a>":"<a href=##>$i</a>";
					}
					echo $show."</li>";
				}
				//echo "</div>";?>
				</ul>
			</nav>
			</div>
			<?php
	}
}	
    mysqli_close($con);
    unset($dbname);
    unset($tns);
    unset($host);
    unset($ip);
    unset($domain);
    unset($config);
    ?>
    <div>
		<!-- 如果要使用Bootstrap的js插件，必须先调入jQuery -->
        <script src="./js/jquery-2.2.0.min.js"></script>
        <!-- 包括所有bootstrap的js插件或者可以根据需要使用的js插件调用　-->
        <script src="./js/bootstrap.min.js"></script> 
</body>
    <?php include ("./body/footer.php");?>
</html>