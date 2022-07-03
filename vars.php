<?
        $result = mysql_query("SELECT * FROM `users` WHERE (`id` = '".$id."' OR `changed_id` = '".$id."')");
        while($row = mysql_fetch_array($result)) {
            $login=$row['email'];
            $name=$row['name'];
            $exp=$row['experience'];
            $surname=$row['surname'];
            $avatar=$row['avatar'];
            if($avatar==''){
                $avka = "/img/avatar.png";
                $query = "UPDATE users SET avatar='".$avka."' WHERE id = '".$id."'";
                $result = mysql_query($query) or die(mysql_error());;
            }
            $b_day=$row['b_day'];
            $b_month=$row['b_month'];
            $b_year=$row['b_year'];
            $online=$row['online'];
            $llogin=$row['last_login'];
            $e_status=$row['email_status'];
            $u_ip=$row['user_ip'];
            $slg=$row['site_lang'];
            $pass=$row['password'];
            $city=$row['city'];
            $site=$row['web-site'];
            $acode=$row['code_activation'];
            $gnd=$row['gender'];
            $of=$row['offical'];
            $sz=$row['says'];
            $edu=$row['education'];
            $edu_city=$row['edu_city'];
            $about=$row['about'];
            $dreg=$row['regdate'];
            $bg=$row['background'];
            $adm_lvl=$row['support'];
            $e_functions=$row['e_functions'];
            $user_offline=$row['offline'];
        }
?>
