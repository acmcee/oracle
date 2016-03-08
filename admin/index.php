<?php 
ini_set("error_reporting","E_ALL & ~E_NOTICE");
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
        <button  class="btn btn-default" id="insert">Insert</button>
        <button  class="btn btn-default" id="delete">Delete</button>
    </div>
    <div >
        <p id="updateResult"></p>
        
    </div>
</div>

<!-- 包含自己的js脚本-->


