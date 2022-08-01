<?
    require("bd.php");
    $id=$_GET['id'];
    $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($result)) {$user_id=$row['id'];}
    $query = "INSERT INTO followers (s_id, u_id)
    VALUES ('$id','$user_id')";
    $result = $mysqli->query($query) or die(mysqli_error());;
    
    
    $base = "DELETE FROM friends WHERE (f_id='$id' and u_id='$user_id') OR (f_id='$user_id' and u_id='$id')";
    $res = $mysqli->query($base) or die(mysqli_error());;
    
    echo "<meta http-equiv='Refresh' content='0; URL=/account/friends.php?id=".$user_id."'>";
?>