<?
	include_once("bd.php");
    $login=$_POST['login'];
    $log=$_GET['log'];$pass=$_GET['pass'];
    $password=$_POST['password'];
	
	if($login == '' and $log=='') echo'error11';
	if ($password =='' and $pass=='') echo'error12';

	$user = mysqli_query($mysqli,"SELECT id FROM users WHERE (email='$login' AND password='$password') OR (email='$log' AND password='$pass')");
	$id_user = mysqli_fetch_array($user);
	if (empty($id_user['id'])){
		//exit ('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> Извините, введённый вами логин или пароль неверный.');
        echo"ERROR3";
	}
	else {
	    if($log=='') setcookie("account",$login,time()+300600,"/");
        else setcookie("account",$log,time()+300600,"/");
        //getlang
        $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '$login'");
        while($row = mysqli_fetch_array($result)) {
            $slg=$row['site_lang'];
            if($slg=='english'){setcookie("language","english",time()+300600,"/");}
            elseif($slg=='russian'){setcookie("language","russian",time()+300600,"/");}
            elseif($slg=='japanese'){setcookie("language","japanese",time()+300600,"/");}
            $avatar=$row['avatar'];
        }
        if($avatar==''){
            $query = "UPDATE users SET avatar = '/img/avatar.png' WHERE email = '".$login."'";
            $result = $mysqli->query($query) or die(mysqli_error());;
        }
        $activation_code = rand() . "\n";
        $data = date('d.m.y/H:i:s');
        $ip=$_SERVER['REMOTE_ADDR'];
        if($log=='') $query = "UPDATE users SET online=1,user_ip = '".$ip."', last_login = '".$data."',code_activation = '".$activation_code."' WHERE email = '".$login."'";
        else $query = "UPDATE users SET online=1,user_ip = '".$ip."', last_login = '".$data."',code_activation = '".$activation_code."' WHERE email = '".$log."'";
        $result = $mysqli->query($query) or die(mysqli_error());;
        echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id_user['id']."'>";
	}
?>