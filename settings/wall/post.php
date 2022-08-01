<?
    require("bd.php");
    $id=$_GET['id'];
    include_once("vars.php");
    $text=$_POST['post_name'];
    if($login==$_COOKIE['account']){
        $name=$openedUser['name'];$surname=$openedUser['surname'];
        $data = date('d.m.y/H:i:s');
        $query = "INSERT INTO wall (user, text, w_date) VALUES ('$id','$text','$data')";
        $result = $mysqli->query($query) or die(mysqli_error());;
        if($_COOKIE['language']=='english'){
            include("translater.php");
            $namevalue = strtr($name, $trans);
            $surnamevalue = strtr($surname, $trans);
        }
        $res =  mysqli_query($mysqli,'SELECT COUNT(1) FROM `wall` WHERE `user` = '.$id.'');        
        if($res)
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $his_posts = !empty($row[0]) ? $row[0] : 0;

        $result = mysqli_query($mysqli,"SELECT * FROM `wall` WHERE `user` = '".$id."'");
        while($row = mysqli_fetch_array($result)) {
            $w_id=$row['id'];
            $w_text=$row['text'];
            $w_date=$row['w_date'];
            $w_hidden=$row['w_hidden'];
        }
        $names=$name.' '.$surname;
        $zapros1 = mysqli_query($mysqli,"SELECT * FROM `avatars` WHERE (u_id = '$id' AND `main` = 1)");
        while($row = mysqli_fetch_array($zapros1)) {$get_uavatar_path=$row['path'];}
        $ava='/user/avatars/'.$get_uavatar_path;
        $wall=array(
            "w_id"=> "$w_id",
            "w_userid"=> "$id",
            "w_text"=> "$w_text",
            "w_date"=> "$w_date",
            "w_hidden"=> "$w_hidden",
            "w_avatar"=> "$ava",
            "w_name"=> "$names",
            "w_counter"=>"$his_posts"
        );
        echo json_encode($wall);
    }
?>