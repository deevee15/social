<?
    include_once("bd.php");
    $id=$_GET['id'];
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {$user_id=$row['id'];}
    $query = "INSERT INTO friends (f_id, u_id,section)
    VALUES ('$user_id','$id',0)";
    $result = mysql_query($query) or die(mysql_error());;
    
    
    $base = "DELETE FROM followers WHERE s_id='$id' and u_id='$user_id'";
    $res = mysql_query($base) or die(mysql_error());;
    

    echo"<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id."'>";
?>