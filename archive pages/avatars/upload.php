<?
    $id=$_GET['id'];
    include_once("bd.php");
    if($id!=''){
?>
<html>
<head>
    <title>Результат загрузки файла</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
   if($_FILES){
       if($_FILES['userfile']['size']<=2000){
           $name = "$id".".jpg";
           $adress = "/avatars/".$name."";
           $query = "UPDATE users SET avatar='".$adress."' WHERE id = '".$id."'";
           $result = mysql_query($query) or die(mysql_error());;
           $base = "DELETE FROM comments WHERE (file_type=1 AND commented_id='$id')";
           $res = mysql_query($base) or die(mysql_error());;
           move_uploaded_file($_FILES['uploadfile']['tmp_name'], $name);
           echo "<meta http-equiv='Refresh' content='0; URL=/'>";
        }
       else{echo "<meta http-equiv='Refresh' content='0; URL=/'>";}
    }
?>
</body>
</html><?}?>