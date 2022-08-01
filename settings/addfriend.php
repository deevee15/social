<?
    require("bd.php");
    $id=$_GET['id'];
    $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($result)) {
        $from=$row['id'];}
    $query = "INSERT INTO followers (s_id, u_id,message, date)
    VALUES ('$from','$id',0,0)";
    $result = mysqli_query($query) or die(mysqli_error());;
    echo"<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id."'>";

?>