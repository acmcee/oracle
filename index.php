[php]
<?php
/*
Author:ĬĬ
Date :2006-12-03
*/
$page=isset($_GET['page'])?intval($_GET['page']):1;        //�����ǻ�ȡpage=18�е�page��ֵ�����粻����page����ôҳ������1��
$num=10;         //ÿҳ��ʾ10������
$db=mysql_connect("host","name","pass");           //�������ݿ�����
$select=mysql_select_db("db",$db);                 //ѡ��Ҫ���������ݿ�
/*
��������Ҫ��ȡ���ݿ��е����ж������ݣ������жϾ���Ҫ�ֶ���ҳ����ҳ�� ����Ĺ�ʽ����
�������� ���� ÿҳ��ʾ�������������һ ��
Ҳ����˵10/3=3.3333=4 ��������Ҫ��һ��
*/
$total=mysql_num_rows(mysql_query("select * from table")); //��ѯ���ݵ�����total
$pagenum=ceil($total/$num);      //�����ҳ�� pagenum
//���紫���ҳ������apge ������ҳ�� pagenum������ʾ������Ϣ
If($page>$pagenum || $page == 0){
       Echo "Error : Can Not Found The page .";
       Exit;
}
$offset=($page-1)*$num;         //��ȡlimit�ĵ�һ��������ֵ offset �������һҳ��Ϊ(1-1)*10=0,�ڶ�ҳΪ(2-1)*10=10��             (�����ҳ��-1) * ÿҳ������ �õ�limit��һ��������ֵ
$info=mysql_query("select * from table limit $offset,$num ");   //��ȡ��Ӧҳ������Ҫ��ʾ������
While($it=mysql_fetch_array($info)){
       Echo $it['name']."<br />";
}                                                              //��ʾ����

For($i=1;$i<=$pagenum;$i++){

       $show=($i!=$page)?"<a href='index.php?page=".$i."'>$i</a>":"<b>$i</b>";
       Echo $show." ";
}
/*��ʾ��ҳ��Ϣ�������ǵ�ҳ����ʾ��������֣������ҳ����Ϊ�����ӣ����統ǰΪ����ҳ����ʾ����
1 2 3 4 5 6
*/
?>
   [/php]
