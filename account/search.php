<?
    include_once("bd.php");
    $user=$_POST['search_input'];
    $result = mysql_query("SELECT * FROM `users` WHERE `name` = '".$user."'");
    while($row = mysql_fetch_array($result)) {
        $id=$row['id'];
    }?>
   <meta http-equiv='Refresh' content='0; URL=/acc.php?id=<?echo $id;?>'>