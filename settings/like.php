
<?
/*
type= 1 - avatar
2 - photo
3 - post
4 - comment
*/
    require("bd.php");
    $liker=$_GET['liker'];
    $owner=$_POST['owner'];
    $object_id=$_POST['object_id'];
    $type=$_POST['type'];
    $date=date('d.m.y/H:i:s');
    $existing = mysqli_query($mysqli,"SELECT `log_id` FROM `likes` WHERE `who_liked` = '$liker' AND `owner` = '$owner' AND `object_id` = '$object_id' AND `type` = '$type'");
    if(mysqli_num_rows($existing)==0){
        $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
        while($row = mysqli_fetch_array($result)) {$id=$row['id'];}
        if($id==$liker){
            $query = "INSERT INTO likes (who_liked, owner, object_id, type, date) VALUES ('$liker','$owner','$object_id','$type','$date')";
            $result = $mysqli->query($query) or die(mysqli_error());;
            $res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `likes` WHERE `owner` = '.$owner.' AND type = '.$type.' AND object_id = '.$object_id.'');
            if($res)
            $row = mysqli_fetch_array($res, MYSQLI_NUM);
            $his_likes = !empty($row[0]) ? $row[0] : 0;
        }
    }
    else{
        $query = "DELETE FROM `likes` WHERE `who_liked` = '$liker' AND `owner` = '$owner' AND `object_id` = '$object_id' AND `type` = '$type'";
        $result = $mysqli->query($query) or die(mysqli_error());;
        $res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `likes` WHERE `owner` = '.$owner.' AND type = '.$type.' AND object_id = '.$object_id.'');
        if($res)
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $his_likes = !empty($row[0]) ? $row[0] : 0;
    }
    echo'
            <li>
                        <svg width="20" height="19" viewBox="0 0 20 19" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.1 15.55L10 15.65L9.89 15.55C5.14 11.24 2 8.39 2 5.5C2 3.5 3.5 2 5.5 2C7.04 2 8.54 3 9.07 4.36H10.93C11.46 3 12.96 2 14.5 2C16.5 2 18 3.5 18 5.5C18 8.39 14.86 11.24 10.1 15.55ZM14.5 0C12.76 0 11.09 0.81 10 2.08C8.91 0.81 7.24 0 5.5 0C2.42 0 0 2.41 0 5.5C0 9.27 3.4 12.36 8.55 17.03L10 18.35L11.45 17.03C16.6 12.36 20 9.27 20 5.5C20 2.41 17.58 0 14.5 0Z"/>
                        </svg>
                        <span>';$get_likeinfo = mysqli_query($mysqli,"SELECT `log_id` FROM `likes` WHERE `who_liked` = '$liker' AND `owner` = '$owner' AND `object_id` = '$object_id' AND `type` = '$type'");if(mysqli_num_rows($get_likeinfo)!=0){echo'Liked';}else{echo'Like';}echo' ('.$his_likes.')</span>
            </li>
            ';
?>