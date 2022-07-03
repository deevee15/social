<?
    if($_SESSION['admined']!=1){
        include_once("bd.php");include_once("check.php");
        $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
        while($row = mysql_fetch_array($result)) {$user_id=$row['id'];}
        $id=$_GET['id'];
        $reason=$_GET['reason'];
        $time=$_GET['time'];
        $date = date("d.m.y");
        if($time=='111'){
            $query = "DELETE FROM banned WHERE id = '$id'";
	        $result = mysql_query($query) or die(mysql_error());;
        }
        else{
        $query = "INSERT INTO banned (id, admin, reason, time, date)
	    VALUES ('$id','$user_id','$reason','$time','$date')";
	    $result = mysql_query($query) or die(mysql_error());;}
    
        echo "<meta http-equiv='Refresh' content='0; URL=/admin/'>"; 
    }
?>