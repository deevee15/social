<?
    include_once('bd.php');
    $id=$_GET['id'];
    $w_id=$_GET['w_id'];
    include_once('vars.php');
    if($login==$_COOKIE['account']){
        $query = "DELETE FROM `wall` WHERE id = '$w_id'";
        $result = mysql_query($query) or die(mysql_error());;
        echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";
    }
    else{echo'error1';}
?>