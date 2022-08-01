<?
    include_once("bd.php");
    $id=$_GET['id'];
    $text=$_POST['textmsg'];
    $resultt = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($resultt)) {
        $from=$row['id'];}
    $query = "INSERT INTO messages (from_who, to_who, text, date, readed)
    VALUES ('$from','$id','$text','228','0')";
    $result = $mysqli->query($query) or die(mysqli_error());;

?>