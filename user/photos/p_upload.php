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
            $res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `photos` WHERE `u_id` = '.$id.'');
            if($res)
            $row = mysqli_fetch_array($res, MYSQLI_NUM);
            $user_photos = !empty($row[0]) ? $row[0] : 0;  
           //
           $check_dir = $id."/";
           if(!file_exists($check_dir)) {mkdir($id, 0700);}
               $path = $id;
               $id_photo = $user_photos+1;
               $name = $id_photo.".jpg";
               $full_path = $path."/".$name;
               //
               function date_ru() {
                $day=date("d");
                $month_en=date("F");
                $year=date("Y");
                $days_of_week_en=date("l");
                $month_ru=array(
                    'January'=>'января',
                    'February'=>'февраля',
                    'March'=>'марта',
                    'April'=>'апреля',
                    'May'=>'мая',
                    'June'=>'июня',
                    'July'=>'июля',
                    'August'=>'августа',
                    'September'=>'сентября',
                    'October'=>'октября',
                    'November'=>'ноября',
                    'December'=>'декабря',
                );
                $month=$month_ru[$month_en];
                $days_of_week=$days_of_week_ru[$days_of_week_en];
                $hour=date("H");
                $minute=date("i");
                $date="$day $month $year года в $hour:$minute";
                return $date;
               }
               //
               $data = date_ru();
               $query = "INSERT INTO photos (p_name, u_id, p_date)
               VALUES ('$full_path','$id','$data')";
               $result = mysqli->query($query) or die(mysqli_error());;
               move_uploaded_file($_FILES['uploadfile']['tmp_name'], $full_path);
               echo "<meta http-equiv='Refresh' content='0; URL=/account/photos.php?id=".$id."'>";
        }
       else{echo "<meta http-equiv='Refresh' content='0; URL=/account/photos.php?id=".$id."'>";}
    }
?>
</body>
</html><?}?>