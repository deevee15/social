<?
    include_once("bd.php");
    $blocked_id=$_GET['id'];
    $resulttt = mysql_query("SELECT * FROM `users` WHERE email = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($resulttt)) {$user_id=$row['id'];}

    $query = "INSERT INTO blacklist (user_id, blocked_id) VALUES ('$user_id','$blocked_id')";
	$result = mysql_query($query) or die(mysql_error());;
    $base = "DELETE FROM friends WHERE (f_id='$user_id' and u_id='$blocked_id') OR (f_id='$blocked_id' and u_id='$user_id')";
    $res = mysql_query($base) or die(mysql_error());;
    
    echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$user_id."'>";
?>