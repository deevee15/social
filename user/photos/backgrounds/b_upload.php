<?
    $id=$_GET['id'];
    include_once("bd.php");
    if($id!='' and $_FILES['uploadfile']['name']!=''){
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
            $full_path = "bg_".$id.".jpg";
            $query = "UPDATE users SET background='/user/photos/backgrounds/".$full_path."' WHERE email = '".$_COOKIE['account']."'";
            $result = mysql_query($query) or die(mysql_error());;
            move_uploaded_file($_FILES['uploadfile']['tmp_name'], $full_path);
            echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id."'>";
        }
        else{echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id."'>";}
    }
?>
</body>
</html><?}?>