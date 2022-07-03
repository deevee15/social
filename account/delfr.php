<?
    include_once("bd.php");
    $id=$_GET['id'];
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {$user_id=$row['id'];}
    $query = "INSERT INTO followers (s_id, u_id)
    VALUES ('$id','$user_id')";
    $result = mysql_query($query) or die(mysql_error());;
    
    
    $base = "DELETE FROM friends WHERE (f_id='$id' and u_id='$user_id') OR (f_id='$user_id' and u_id='$id')";
    $res = mysql_query($base) or die(mysql_error());;
    
    echo "<meta http-equiv='Refresh' content='0; URL=/account/friends.php?id=".$user_id."'>";
?>