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
           //чекаем сколько фото для названия
            $res = mysql_query('SELECT COUNT(1) FROM `avatars` WHERE `u_id` = '.$id.'');
            if($res)
            $row = mysql_fetch_array($res, MYSQL_NUM);
            $user_photos = !empty($row[0]) ? $row[0] : 0;  
           //
           $check_dir = $id."/";
           if(!file_exists($check_dir)) {mkdir($id, 0700);}
               $path = $id;
               $id_photo = $user_photos+1;
               $name = $id_photo.".jpg";
               $full_path = $path."/".$name;
               //
               $get_date=date("d.m.y/H:m");
               $ava_id=$user_photos+1;
               $zapros2 = "UPDATE avatars SET main=0 WHERE u_id = '$id' AND main = 1";
               $res = mysql_query($zapros2) or die(mysql_error());;
               $query = "INSERT INTO avatars (u_id, avatar_id, path, date, main)
               VALUES ('$id','$ava_id','$full_path','$get_date', '1')";
               $result = mysql_query($query) or die(mysql_error());;
               move_uploaded_file($_FILES['uploadfile']['tmp_name'], $full_path);
               echo "<meta http-equiv='Refresh' content='0; URL=/account/photos.php?id=".$id."'>";
        }
       else{echo "<meta http-equiv='Refresh' content='0; URL=/account/photos.php?id=".$id."'>";}
    }
?>
</body>
</html><?}?>