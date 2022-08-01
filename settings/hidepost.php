<?
    require('bd.php');
    $id=$_GET['id'];
    $w_id=$_GET['w_id'];
    $w_hidden=$_GET['w_hidden'];
    include_once('vars.php');
    if($login==$_COOKIE['account']){
        if($w_hidden==0){$query = "UPDATE `wall` SET w_hidden=1 WHERE id = '$w_id'";}
        else{$query = "UPDATE `wall` SET w_hidden=0 WHERE id = '$w_id'";}
        $result = $mysqli->query($query) or die(mysqli_error());;
        echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";
    }
    else{echo'error1';}
?>