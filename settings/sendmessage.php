<?
    include_once("bd.php");
    $id=$_GET['id'];
    $text=$_POST['textmsg'];
    $resultt = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($resultt)) {
        $from=$row['id'];}
    $query = "INSERT INTO messages (from_who, to_who, text, date, readed)
    VALUES ('$from','$id','$text','228','0')";
    $result = mysql_query($query) or die(mysql_error());;

?>