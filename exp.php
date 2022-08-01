<?
    $exp=$openedUser['experience'];
    if($exp<30){
        if($openedUser['email_status']==1 and $exp==0){$query = "UPDATE users SET experience=experience+10 WHERE email = '".$_COOKIE['account']."'";
        $result = $mysqli->query($query) or die(mysqli_error());}
        else if(!empty($openedUser['city'] and $exp==0)){$query = "UPDATE users SET experience=experience+10 WHERE email = '".$_COOKIE['account']."'";
        $result =$mysqli->query($query) or die(mysqli_error());}
        else if(!empty($openedUser['education'] and $exp==0)){$query = "UPDATE users SET experience=experience+10 WHERE email = '".$_COOKIE['account']."'";
        $result = $mysqli->query($query) or die(mysqli_error());}
        else if($e_status==1 and !empty($openedUser['education']) and !empty($openedUser['city'])){$query = "UPDATE users SET experience=experience+30 WHERE email = '".$_COOKIE['account']."'";
        $result = $mysqli->query($query) or die(mysqli_error());}
    }
    else if($llogin!=$date and $exp<5000){
        if($of==1){$query = "UPDATE users SET experience=experience+500 WHERE email = '".$_COOKIE['account']."'";
        $result = $mysqli->query($query) or die(mysqli_error());}
    }
?>