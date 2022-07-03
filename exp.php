<?
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
    $data = date_ru();
    if($exp<30){
        if($e_status==1){$query = "UPDATE users SET experience=experience+10 WHERE email = '".$login."'";
        $result = mysql_query($query) or die(mysql_error());;}
        else if(!empty($city)){$query = "UPDATE users SET experience=experience+10 WHERE email = '".$login."'";
        $result = mysql_query($query) or die(mysql_error());;}
        else if(!empty($site)){$query = "UPDATE users SET experience=experience+10 WHERE email = '".$login."'";
        $result = mysql_query($query) or die(mysql_error());;}
        else if($e_status==1 and !empty($site) and !empty($city)){$query = "UPDATE users SET experience=experience+30 WHERE email = '".$_COOKIE['account']."'";
        $result = mysql_query($query) or die(mysql_error());;}
    }
    else if($llogin!=$date and $exp<5000){
        if($of==1){$query = "UPDATE users SET experience=experience+500 WHERE email = '".$_COOKIE['account']."'";
        $result = mysql_query($query) or die(mysql_error());;}
    }
?>