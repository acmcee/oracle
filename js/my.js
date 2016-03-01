var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

$(document).ready(function(){
	//alert($_GET['dir']);
	var value_dir = $_GET['dir'];
	if (typeof(value_dir) != "undefined") {	
		document.getElementById(value_dir).className="active";
	}
});




$(document).ready(function(){
    $("#searchNumber").click(function(){
        $.ajax({
            type:"GET",
            url:"./admin/service.php?keyword="+$("#keyword").val(),
            dataType:"json",
            success:function(data){
                if (data.success) {
                        //alert(data.errormes);
                        $("#searchResult").html(data.errormes);
                        $("#updateResult").html("");
                        
                        $("#DBID").val(data.DBID);
                        $("#sys_domain").val(data.sys_domain);
                        $("#sys_level").val(data.sys_level);
                        $("#desc").val(data.desc);
                        $("#TNS").val(data.TNS);
                        $("#OLDTNS").val(data.OLDTNS);
                        $("#hostname").val(data.hostname);
                        $("#ip").val(data.ip);
                        $("#vip").val(data.vip);
                        $("#domain").val(data.domain);
                    }else {
                        $("#searchResult").html(data.errormes);
                        $("#updateResult").html("");
                        
                    }
                },
                error:function(jqXHR){
                    alert("error occur "+ jqXHR.status);
                }
            });
});
});

$(document).ready(function(){
    $("#update").click(function(){
        $.ajax({
            type:"POST",
            url:"./admin/update.php",
            dataType:"json",
            data:{
                DBID:$("#DBID").val(),
                sys_domain:$("#sys_domain").val(),
                sys_level:$("#sys_level").val(),
                desc:$("#desc").val(),
                TNS:$("#TNS").val(),
                OLDTNS:$("#OLDTNS").val(),
                hostname:$("#hostname").val(),
                ip:$("#ip").val(),
                vip:$("#vip").val(),
                domain:$("#domain").val(),
            },
            success:function(data){
                if (data.success) {
                        //alert(data.errormes);
                        $("#updateResult").html(data.errormes);
                        $("#searchResult").html("");
                       
                    }else {
                        $("#updateResult").html("error occurs:"+data.errormes+"succ:"+data.success);
                        $("#searchResult").html("");
                     
                    }
                },
                error:function(jqXHR){
                    alert("error2 occur "+ jqXHR.status);
                }
            });
});
});


$(document).ready(function(){
    $("#insert").click(function(){
        $.ajax({
            type:"POST",
            url:"./admin/insert.php",
            dataType:"json",
            data:{
                DBID:$("#DBID").val(),
                sys_domain:$("#sys_domain").val(),
                sys_level:$("#sys_level").val(),
                desc:$("#desc").val(),
                TNS:$("#TNS").val(),
                OLDTNS:$("#OLDTNS").val(),
                hostname:$("#hostname").val(),
                ip:$("#ip").val(),
                vip:$("#vip").val(),
                domain:$("#domain").val(),
            },
            success:function(data){
                if (data.success) {
                        //alert(data.errormes);
                        $("#updateResult").html(data.errormes);
                        $("#searchResult").html("");
                        
                    }else {
                        $("#updateResult").html("error occurs:"+data.errormes+"succ:"+data.success);
                        $("#searchResult").html("");
                       
                    }
                },
                error:function(jqXHR){
                    alert("error2 occur "+ jqXHR.status);
                }
            });
});
});

$(document).ready(function(){
    $("#delete").click(function(){
        $.ajax({
            type:"POST",
            url:"./admin/delete.php",
            dataType:"json",
            data:{
                DBID:$("#DBID").val(),
            },
            success:function(data){
                if (data.success) {
                        //alert(data.errormes);
                        $("#updateResult").html(data.errormes);
                        $("#searchResult").html("");
                        
                    }else {
                        $("#updateResult").html("error occurs:"+data.errormes+"succ:"+data.success);
                        $("#searchResult").html("");
                       
                    }
                },
                error:function(jqXHR){
                    alert("error2 occur "+ jqXHR.status);
                }
            });
});
});