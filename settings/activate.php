<?
    include_once("bd.php");
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {$email_status=$row['email_status'];$uid=$row['id'];$acode=$row['code_activation'];}
    $id=$_GET['code'];
    if($id=$acode){
        if($_COOKIE['account'] and $email_status==0){
            $query = "UPDATE users SET email_status=1 WHERE email = '".$_COOKIE['account']."'";
            $result = mysql_query($query) or die(mysql_error());;
            echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$uid."'>";
        }
    }
?>