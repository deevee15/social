<?
/*
type= 1 - avatar,
2 - photo,
3 - post,
4 - comment,
*/
    require("bd.php");
    $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($result)) {$id=$row['id'];}
    $owner=$_GET['owner'];
    $object_id=$_POST['object_id'];
    $type=$_POST['type'];
    $existing = mysqli_query($mysqli,"SELECT `log_id` FROM `likes` WHERE `who_liked` = '$id' AND `owner` = '$owner' AND `object_id` = '$object_id' AND `type` = '$type'");
    if(mysqli_num_rows($existing)!=0){echo'is';}
    else{echo'0';}
?>