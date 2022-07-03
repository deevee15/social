<?
	include_once("bd.php");
    include_once("user.php");
	if (isset($_POST['auth_login'])) {
	$login = $_POST['auth_login']; 
	if($login == '') {
		unset($login);
		exit ('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">Введите пожалуйста логин!');
		} 
	}
	if (isset($_POST['auth_password'])) {
		$password=$_POST['auth_password']; 
		if ($password =='') {
			unset($password);
			exit ('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">Введите пароль');
		}
	}


	$user = mysql_query("SELECT id FROM users WHERE email='$login' AND password='$password'");
	$id_user = mysql_fetch_array($user);
	if (empty($id_user['id'])){
		//exit ('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> Извините, введённый вами логин или пароль неверный.');
        echo"ERROR3";
	}
	else {
	    setcookie("account",$login,time()+300600,"/");
        //getlang
        $result = mysql_query("SELECT * FROM `users` WHERE `email` = '$login'");
        while($row = mysql_fetch_array($result)) {
            $slg=$row['site_lang'];
            if($slg=='english'){setcookie("language","english",time()+300600,"/");}
            elseif($slg=='russian'){setcookie("language","russian",time()+300600,"/");}
            elseif($slg=='japanese'){setcookie("language","japanese",time()+300600,"/");}
            $avatar=$row['avatar'];
        }
        if($avatar==''){
            $query = "UPDATE users SET avatar = '/img/avatar.png' WHERE email = '".$login."'";
            $result = mysql_query($query) or die(mysql_error());;
        }
        //
        function date_ru() {
        $day=date("d");
        $month_en=date("F");
        $year=date("Y");
        $days_of_week_en=date("l");
        $month_ru=array(
            'January'=>'января',
            'February'=>'февраля',
            'March'=>'марта',
            'April'=>'апреля',
            'May'=>'мая',
            'June'=>'июня',
            'July'=>'июля',
            'August'=>'августа',
            'September'=>'сентября',
            'October'=>'октября',
            'November'=>'ноября',
            'December'=>'декабря',
        );
        $month=$month_ru[$month_en];
        $days_of_week=$days_of_week_ru[$days_of_week_en];
        $hour=date("H");
        $minute=date("i");
        $date="$day $month $year года в $hour:$minute";
        return $date;
        }
        $activation_code = rand() . "\n";
        $data = date('d.m.y/H:i:s');
        $ip=$_SERVER['REMOTE_ADDR'];
        $query = "UPDATE users SET online=1,user_ip = '".$ip."', last_login = '".$data."',code_activation = '".$activation_code."' WHERE email = '".$login."'";
        $result = mysql_query($query) or die(mysql_error());;
	}
    /*$result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {
        $id=$row['id'];
    }*/
    echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id_user['id']."'>";
?>