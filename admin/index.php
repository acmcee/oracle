<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Staff</title>

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
        ?>
        <?php
            //require("./../body/navbar.html");
        ?>

        <div class="container">
            <h1>Database Information Change System</h1>
            <div class="form-left">
                <label for="keyword">Database ID</label>
                <input type="text" class="form-control" id="keyword" placeholder="Database ID">
            </div>
            <button class="btn btn-default" id="searchNumber">Search</button>
            <p id="searchResult"></p>
            <div class="form-left">
                <label for="DBID">Database ID</label>
                <input type="text" class="form-control" id="DBID" placeholder="Database ID" disabled>
            </div>
            <div class="form-left">
                <label for="sys_domain">系统域</label>
                <input type="text" class="form-control" id="sys_domain" placeholder="系统域">
            </div>
            <div class="form-left">
                <label for="sys_level">系统等级</label>
                <input type="text" class="form-control" id="sys_level" placeholder="系统等级">
            </div>
            <div class="form-left">
                <label for="desc">数据库名</label>
                <input type="text" class="form-control" id="desc" placeholder="数据库名">
            </div>
            <div class="form-left">
                <label for="TNS">TNS(4A)</label>
                <input type="text" class="form-control" id="TNS" placeholder="TNS(4A)">
            </div>
            <div class="form-left">
                <label for="OLDTNS">TNS(OLD)</label>
                <input type="text" class="form-control" id="OLDTNS" placeholder="TNS(OLD)">
            </div>
            <div class="form-left">
                <label for="hostname">主机名</label>
                <input type="text" class="form-control" id="hostname" placeholder="主机名">
            </div>
            <div class="form-left">
                <label for="ip"> IP</label>
                <input type="text" class="form-control" id="ip" placeholder=" IP">
            </div>
            <div class="form-left">
                <label for="vip">VIP</label>
                <input type="text" class="form-control" id="vip" placeholder="VIP">
            </div>
            <div class="form-left">
                <label for="domain">域名</label>
                <input type="text" class="form-control" id="domain" placeholder="域名">
            </div>
            <div >
                <button  class="btn btn-default" id="update">Update</button>
                <p id="updateResult"></p>
            </div>
            </div>
        


<!-- 如果要使用Bootstrap的js插件，必须先调入jQuery -->
<script src="./js/jquery-2.2.0.min.js"></script>
<!-- 包括所有bootstrap的js插件或者可以根据需要使用的js插件调用　-->
<script src="./js/bootstrap.min.js"></script> 
<!-- 包含自己的js脚本-->
<script src="./js/my.js"></script> 


</body>

</html>