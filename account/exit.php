<?
    include_once("bd.php");
    $data = date('d.m.y/H:i:s');
    $query = "UPDATE users SET online=0,last_login = '".$data."' WHERE email = '".$_COOKIE['account']."'";
    $result = mysql_query($query) or die(mysql_error());;
	setcookie("account",$_COOKIE['account'],time()-300600,"/");
	echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";
?>