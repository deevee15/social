<?
    include_once("bd.php");
    $about=$_POST['e_about'];
    $query = "UPDATE users SET about='".$about."' WHERE email = '".$_COOKIE['account']."'";
    $result = mysql_query($query) or die(mysql_error());;
    echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";
?>