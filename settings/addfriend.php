<?
    include_once("bd.php");
    $id=$_GET['id'];
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {
        $from=$row['id'];}
    $query = "INSERT INTO followers (s_id, u_id,message, date)
    VALUES ('$from','$id',0,0)";
    $result = mysql_query($query) or die(mysql_error());;
    echo"<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id."'>";

?>