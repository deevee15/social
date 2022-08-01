<?
    require("bd.php");
    $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($result)) {$email_status=$row['email_status'];$uid=$row['id'];$acode=$row['code_activation'];}
    $id=$_GET['code'];
    if($id=$acode){
        if($_COOKIE['account'] and $email_status==0){
            $query = "UPDATE users SET email_status=1 WHERE email = '".$_COOKIE['account']."'";
            $result = $mysqli->query($query) or die(mysqli_error());;
            echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$uid."'>";
        }
    }
?>