<?php
$con = mysqli_connect( "192.168.56.102","root","root","oracle_list");
$page=isset($_GET['page'])?intval($_GET['page']):1; 
//这句就是获取page=18中的page的值，假如不存在page，那么页数就是1。
$num=10;         //每页显示10条数据
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
else 
{
    echo "success";
    
}    

$total=mysqli_num_rows(mysqli_query($con,"select 1 from `table`"));
echo "total num is ".$total."<br />";

$pagenum=ceil($total/$num);      //获得总页数 pagenum

If($page>$pagenum || $page == 0){
       Echo "Error : Can Not Found The page .";
       Exit;
}

$offset=($page-1)*$num; 
//获取limit的第一个参数的值 offset ，
//假如第一页则为(1-1)*10=0,第二页为(2-1)*10=10。(传入的页数-1) * 每页的数据 得到limit第一个参数的值

$info=mysqli_query($con,"select * from `table` limit $offset,$num ");   //获取相应页数所需要显示的数据
While($it=mysqli_fetch_array($info,MYSQLI_ASSOC)){
       echo $it['id']." ".$it['name']."<br />";
}  


For($i=1;$i<=$pagenum;$i++){

       $show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<b>$i</b>";
       echo $show." ";
}
/*显示分页信息，假如是当页则显示粗体的数字，其余的页数则为超连接，假如当前为第三页则显示如下
1 2 3 4 5 6
*/

mysqli_close($con);
?>