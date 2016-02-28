$(document).ready(function(){
        $("#searchNumber").click(function(){
            $.ajax({
                type:"GET",
                url:"service.php?keyword="+$("#keyword").val(),
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
                url:"update.php",
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
