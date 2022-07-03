<?
    include_once("bd.php");$id=$_GET['id'];include_once("vars.php");include_once("exp.php");include_once("devices.php");
    include_once("getlang.php");
?>
<head>
    <?
        if($_COOKIE['language']=='english'){
            include("translater.php");
            $namevalue = strtr($name, $trans);
            $surnamevalue = strtr($surname, $trans);}
    ?>
    <title>OLD PAGE <?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;}else{echo $name;echo" ";echo $surname;}?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/account.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/acc_menu.js"></script>
    <script type="text/javascript" src="/js/menu.js"></script>
    <script type="text/javascript" src="/js/fixed_header.js"></script>
    <script type="text/javascript" src="/js/amenu.js"></script>
    <script type="text/javascript" src="/js/friends_menu.js"></script>
    <script type="text/javascript" src="/js/modal.js"></script>
    <script type="text/javascript" src="/js/modal_followers.js"></script>
    <script type="text/javascript" src="/js/autoresize.jquery.js"></script>
    <link rel="ICON" href="/img/1.png" type="image/gif">
</head>
            <?
            $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
            while($row = mysql_fetch_array($result)) {
                $support=$row['support'];
                $user_id=$row['id'];
                $user_ip=$row['user_ip'];
                $ULANG=$row['site_lang'];
                $user_ava=$row['avatar'];
                $user_email_status=$row['email_status'];
            }
            ?>
<?if($adm_lvl==3 and $e_functions==1){echo"<body style='background:url(".$bg.") no-repeat #82c4fb;'>";}else{echo"<body style='background:#82c4fb;'>";}?>
    <script type="text/javascript">
        $(window).width(); //Ширина браузера
        $(window).height();
    </script>
    <?if($mobile==1){echo"<meta http-equiv='Refresh' content='0; URL=/mobile/'>";}else{?>
    <?
        if($id==''){echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";}else{
        $ip=$_SERVER['REMOTE_ADDR'];
        //if($ip!=$user_ip){
            //echo "<meta http-equiv='Refresh' content='0; URL=/security.php?id=".$user_id."'>";
        //}
        $result = mysql_query("SELECT * FROM `banned` WHERE `id` = '".$id."'");
        while($row = mysql_fetch_array($result)) {
            $reason=$row['reason'];
            $bannedid=$row['id'];
            $time=$row['time'];
        }
    ?>
    <div id="header">
        <?
            $res = mysql_query('SELECT COUNT(1) FROM `followers` WHERE u_id = '.$user_id.'');
            if($res)
            $row = mysql_fetch_array($res, MYSQL_NUM);
            $subs = !empty($row[0]) ? $row[0] : 0;  
        ?>
        <?if(!empty($_COOKIE['account'])){?><div class="slider_menu_icon"><div class="sm_icon"></div></div><?}?>
        <div class="header_lg"><a href="/" id="header_lg_a"><div class="header_lg_img"></div></a></div>
        <?if($_COOKIE['account']){?><a href="/account/messages.php"><div class="header_nmsg"><div class="header_nmsg_icon"><font class="nmsg_number">+1</font></div></div></a>
        <a href="/account/friends.php?id=<?echo$user_id;?>"><div class="header_nfrd"><div class="header_nfrd_icon"><?if($subs!=0){?><font class="nfrd_number">+<?echo$subs;?></font><?}?></div></div></a><?}?>
        <form id="header_search" method="post" action="/account/searching.php">
            <?if($_COOKIE['language']=="english"){?><input type="text" name="search_input" class="input_search" placeholder="Search" onfocus="if(this.placeholder=='Search') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Search';}" autocomplete="off"><?}else{?>
            <input type="text" name="search_input" class="input_search" placeholder="Поиск" onfocus="if(this.placeholder=='Поиск') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Поиск';}" autocomplete="off"><?}?>
        </form>
        <?if($_COOKIE['account']){?>
        <div class="header_account" onselectstart="return false" onmousedown="return false">
            <?
                $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
                while($row = mysql_fetch_array($result)) {$cook_name=$row['name'];$cook_ava=$row['avatar'];}
                if($_COOKIE['language']=='english'){
                include("translater.php");
                $translatedname = strtr($cook_name, $trans);}
            ?>
            <div class="photo_user">
                <p><b class="cook_name"><?if($_COOKIE['language']=='english'){echo $translatedname;}else{echo$cook_name;}?></b>
                    <script>
                        $(function(){
                            var cooka_name = $('.cook_name').val().length;
                            if(cooka_name>5){
                                $('.cook_name').html("JOPA");
                            }
                        });
                    </script>
                </p>
                <img src="<?if($user_id==$bannedid){echo"/img/banned.png";}else{echo$cook_ava;}?>" width="40px" height="40px">
            </div>
            <ul class="settings">
                <a href="/"><li style="border-bottom:1px solid #afafaf;" class="hd_acc_st_pr">Мой профиль</li></a>
                <a href="/account/edit.php?id=<?echo$user_id;?>"><li style="margin-top:3px;" class="hd_acc_st_ed">Редактирование</li></a>
                <a href="/account/settings.php?id=<?echo$user_id;?>&st=1"><li class="hd_acc_st_st">Настройки</li></a>
                <a href="/help.php"><li class="hd_acc_st_hp">Помощь</li></a>
                <a href="/account/exit.php"><li style="border-top:1px solid #afafaf; margin-top:3px;" class="hd_acc_st_ex">Выйти</li></a>
            </ul>
        </div><?}else{?>
        <div class="header_enter">
            <div class="photo_user"><p>Войти</p> <img src="/img/default_user.png" width="40px" height="40px"></div>
            <ul class="settings">
                <a href="singup.php"><li>Регистрация</li></a>
                <a href="/"><li>Вход</li></a>
                <a href="rules.php"><li>Правила пользования</li></a>
            </ul>
        </div>
        <?}?>
    </div>
    <?if($bannedid==$id){?>
        <div id="profile">
            <div class="profile_avatar" style="margin-left:50px;">
            <div class="profile_avatar_left" onselectstart="return false" onmousedown="return false">
                <div class="profile_ava"><img src="/img/banned.png" width="200px" height="200px" class="profile_ava_img"></div>
            </div>
            </div>
            <div class="blocked_inf">
                <div class="profile_inf_name" style="margin-left:10px;margin-top:10px;"><?echo $name;echo" ";echo $surname;echo" ";if($of==1){echo"<img src='/img/verif.png' width='20px' height='20px' class'verified' title='Проверенный пользователь'>";}?></div>
                 <?if($online==1){?>
                <div class="profile_inf_online" style="color: #939393; font-size:14px;">Online</div><?}else{?>
                <div class="profile_inf_offline" style="color: #939393; font-size:14px;">Заходил(а) <?echo $llogin;?></div>
                <?}?>
                <div class="profile_inf_says"><p class="profile_user_says"><span class="blockedprofile_user_says">Страница заблокирована</span></p></div>
                <div class="blocked_inf_reason">
                    <?
                        if($reason==1){echo"<span class='blocked_inf_reason_1'>Страница заблокирована по причине финансовых махинаций на сайте.Разблокировке не подлежит.</span>";}
                        elseif($reason==2){echo"<span class='blocked_inf_reason_2'>Страница заблокирована по причине подозрения во взломе.Разблокировка через:</span> ".$time." ";}
                        elseif($reason==3){echo"<span class='blocked_inf_reason_3'>Страница заблокирована по причине массового оскорбления пользователей.Разблокировка через:</span> ".$time."";}
                        elseif($reason==4){echo"<span class='blocked_inf_reason_4'>Неприемлемый материал на странице.Разблокировке не подлежит.</span>";}
                        elseif($reason==5){echo"<span class='blocked_inf_reason_5'>Данный пользователь создал страницу под чужим именем.Разблокировке не подлежит.</span>";}
                    ?>
                </div>
            </div>
            <?if($_COOKIE['account']==$login){?>
            <div class="buser_info">
                <?if($time==0){?>Ваш аккаунт заблокирован навсегда.Впредь будьте осторожны.Ваша почта: <?echo$login;}else{?>
                >Ваш аккаунт заблокирован до <?echo$time;?>.Впредь будьте осторожны.Ваша почта: <?echo$login;}?><br>
                <a href="/account/exit.php"><button class="blocked_button">Выйти</button></a>
            </div>
            <?}?>
        </div>
        <?$banneduser=1;}else{
        $result = mysql_query("SELECT * FROM `banned` WHERE `id` = '".$user_id."'");
        while($row = mysql_fetch_array($result)) {
            $ureason=$row['reason'];
            $ubannedid=$row['id'];
            $utime=$row['time'];
        }
    if(!empty($_COOKIE['account']) and $ubannedid!=$user_id){?>
    <?
        if($user_ava==''){
        $query = "UPDATE users SET avatar='/img/avatar.png' WHERE email = '".$_COOKIE['account']."'";
        $result = mysql_query($query) or die(mysql_error());;}                                              
    ?>
    <div id="slider_menu">
        <div class="slider_menu_points">
            <a href="/acc.php?id=<?echo$user_id;?>"><div class="point_profile"><img src="/img/menu/profile.png" width="25px" height="20px" style="margin-left:2px;"></div></a>
            <a href="/account/friends.php?id=<?echo$user_id;?>"><div class="point_friends"><img src="/img/menu/friends.png" width="30px" height="30px"></div></a>
            <a href=""><div class="point_messages"><img src="/img/menu/messages.png" width="25px" height="25px" style="margin-left:2px;"></div></a>
            <a href="/account/photos.php?id=<?echo$user_id;?>"><div class="point_photos"><img src="/img/menu/photos.png" width="30px" height="30px"></div></a>
            <a href="/account/audios.php?id=<?echo$user_id;?>"><div class="point_audios"><img src="/img/menu/audios.png" width="25px" height="25px"></div></a>
            <a href="/account/videos.php?id=<?echo$user_id;?>"><div class="point_videos"><img src="/img/menu/videos.png" width="30px" height="25px"></div></a>
            <?if($support>=1){?><a href="/admin/"><div class="point_admin"><img src="/img/menu/admin.png" width="25px" height="25px"></div></a><?}?>
        </div>
    </div>
    <div id="slider_menu_second" hidden="hidden">
        <div class="slider_menu_second_points">
            <ul>
                <li class="pnt_pr">profile</li>
                <li class="pnt_fr">friends</li>
                <li class="pnt_msg">messages</li>
            </ul>
        </div>
    </div>
    <?}else{?>
    <div id="user_login">
        <form method="post" action="settings/singin.php" name="user_login_form">
            <p>E-mail:</p> <input type="text" name="auth_login"><br>
            <p class="user_login_form_pass_p">Пароль:</p> <input type="password" name="auth_password"><br>
            <input type="submit" value="Войти" name="auth_submit" class="auth_submit" style="cursor:pointer;"><br>
        </form>
        <a href="/singup.php"><button class="user_registration" style="cursor:pointer;">Регистрация</button></a><br>
        <a href="/settings/forgotten.php" class="user_forgotten">Забыли пароль?</a>
    </div><?}?>
    <div id="profile">
        <div class="profile_avatar">
            <div class="profile_avatar_left">
                <div class="profile_ava" onselectstart="return false" onmousedown="return false" style="cursor:pointer;"><figure class="fig"><img src="<?echo $avatar;?>" class="profile_ava_img"></figure></div>
            <div class="experience">
                <?
                    if($exp<2500){?>
                        <?echo '<div id="percent1" style="width: '.$exp.'; max-width:250px;"></div><div class="experience_line" style="background:#3c9dec;"><span class="exp_text_st"><font style="position:relavite;">'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                    }
                    elseif($exp>=2500 and $exp<25000){
                        echo '<div id="percent" style="width: calc('.$exp.'px/100); max-width:250px;"></div><div class="experience_line" style="background:#ff0000;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                    }
                    elseif($exp>=25000 and $exp<250000){
                        echo '<div id="percent3" style="width: calc('.$exp.'px/1000); max-width:250px;"></div><div class="experience_line" style="background:#b0b7c6;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                    }
                    elseif($exp>=250000 and $exp<25000000){
                        echo '<div id="percent2" style="width: calc('.$exp.'px/10000); max-width:250px;"></div><div class="experience_line" style="background:#ffc014;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                    }
                    elseif($exp>=25000000){
                        echo '<div id="percent_special" style="width: calc('.$exp.'px/10000000); max-width:250px;"></div><div class="experience_line" style="background: #B5EB9A;box-shadow: 1px 1px 20px #4EAA4D;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                    }
                ?>
            </div>
                <?
                    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
                    while($row = mysql_fetch_array($result)) {$acc_id=$row['id'];}
                ?>
            <?if($_COOKIE['account']==$login){?>
            <link rel="stylesheet" type="text/css" href="/css/acc_dop.css">
            <?if($e_status!=0){echo'<link rel="stylesheet" type="text/css" href="/css/acc_dop2.css">';}?>
            <div class="profile_b_edit">
                <a href="/account/edit.php?id=<?echo$id;?>" id="edit_a"><button class="button_edit">Редактировать</button></a>
            </div><?}else{?>
            <link rel="stylesheet" type="text/css" href="/css/acc_dop1.css">
            <?if($_COOKIE['account']){?>
            <a class="a_write_message"><button class="write_message">Написать сообщение</button></a>
            <?
                    $result = mysql_query("SELECT * FROM `followers`");
                    while($row = mysql_fetch_array($result)) {
                        $s_id=$row['s_id'];
                        $su_id=$row['u_id'];
                        if($s_id==$user_id and $su_id==$id){
                                echo '<button class="add_frienddd subscribed"><div class="friends_moves">
                                <ul class="subscriber_moves_list" style="z-index:2;">
                                    <a href="/account/unsub.php?id=<??>"><li>Отменить заявку</li></a>
                                    <a href="/account/frmsg.php?id=<??>"><li>Написать</li></a>
                                </ul>
                                </div> Заявка отправлена</button>';
                                $friend=1;
                        }
                        else if($su_id==$user_id and $s_id==$id){
                            echo '<button class="add_friendd subscribed"><div class="friends_moves">
                            <ul class="subscriber_moves_list" style="z-index:2;">
                                <a href="/account/unsub.php?id='.$id.'"><li>Подтвердить</li></a>
                                <a href="/account/frmsg.php?id='.$id.'"><li>Заблокировать</li></a>
                            </ul>
                            </div> '.$name.' <span class="followed_text">подписан(a) на вас</span></button><button class="other_moves">...</button>';
                            $friend=4;
                        }
                    }
                    $result = mysql_query("SELECT * FROM `friends`");
                    while($row = mysql_fetch_array($result)) {
                        $f_id=$row['f_id'];
                        $fu_id=$row['u_id'];
                        if(($f_id==$user_id and $fu_id==$id) or ($fu_id==$user_id and $f_id==$id)){
                            echo '<button class="add_friendd friended"><div class="friends_moves">
                            <ul class="friends_moves_list" style="z-index:2;>
                                <a href="/account/mutualfr.php?id='.$id.'"><li>Общие друзья</li></a>
                                <a href="/account/delfr.php?id='.$id.'"><li>Удалить из друзей</li></a>
                            </ul>
                            </div> <font class="friended_text">У вас в друзьях</font></button><button class="other_moves">...</button>';
                            $friend=2;
                        }
                    }
                if($friend==0){echo '<a href="/settings/addfriend.php?id='.$id.'"><button class="add_friend">Добавить в друзья</button></a>';}
            ?>
            <?}else{echo"<div class='user_notauthed'><span>Зарегистрируйтесь,чтобы добавить или написать</span> ".$name. " ".$surname." </div>";}}?>
        </div></div>
        <?
            $res = mysql_query('SELECT COUNT(1) FROM `friends` WHERE f_id = '.$id.' OR u_id = '.$id.'');
            if($res)
            $row = mysql_fetch_array($res, MYSQL_NUM);
            $hisfriends = !empty($row[0]) ? $row[0] : 0;  
        ?>
        <div class="profile_friends">
            <a href="/account/friends.php?id=<?echo$id;?>" style="color:#000;">
                <p>
                    <?
                        if($_COOKIE['language']=='english'){
                            if($id==$user_id){echo"My friends";}else{echo"Friends ".$namevalue;}
                            echo"<span style='color:#42aaff;margin-left:5px;'>".$hisfriends."</span>";
                        }else{
                            if($id==$user_id){echo"Мои друзья";}else{echo"Друзья ".$name;}
                            echo"<span style='color:#42aaff;margin-left:5px;'>".$hisfriends."</span>";
                        }
                    ?>     
                </p>
            </a>
            <?
                $result = mysql_query("SELECT * FROM `friends` WHERE (`u_id` = '".$id."') OR (`f_id` = '".$id."') LIMIT 6");
                while($row = mysql_fetch_array($result)) {
                    $u_id=$row['u_id'];
                    $ff_id=$row['f_id'];
            ?>
            <div class="profile_friends_list">
                <div class="profile_friends_avatar">
                    <?
                        if($u_id!=$id){$check_friend_avatar = mysql_query("SELECT avatar FROM users WHERE id='$u_id'");
                           $friend_avatar = mysql_fetch_array($check_friend_avatar);}
                        else{$check_friend_avatar = mysql_query("SELECT avatar FROM users WHERE id='$ff_id'");
                            $friend_avatar = mysql_fetch_array($check_friend_avatar);}
                    ?>
                    <a href="/acc.php?id=<?if($u_id!=$id){echo$u_id;}else{echo$ff_id;}?>"><img src="<?echo$friend_avatar['avatar'];?>" width="70px" height="70px"></a>
                </div>
                <div class="profile_friends_names">
                    <?
                        if($u_id!=$id){
                            $check_friend_name = mysql_query("SELECT name FROM users WHERE id='$u_id'");
                            $friend_name = mysql_fetch_array($check_friend_name);}
                            else{
                            $check_friend_name = mysql_query("SELECT name FROM users WHERE id='$ff_id'");
                            $friend_name = mysql_fetch_array($check_friend_name);}


                        //фамилия
                        if($u_id!=$id){
                            $check_friend_sname = mysql_query("SELECT surname FROM users WHERE id='$u_id'");
                            $friend_sname = mysql_fetch_array($check_friend_sname);}
                            else{
                            $check_friend_sname = mysql_query("SELECT surname FROM users WHERE id='$ff_id'");
                            $friend_sname = mysql_fetch_array($check_friend_sname);}
                        //
                        if($_COOKIE['language']=='english'){
                            include("translater.php");
                            $fr_namevalue = strtr($friend_name['name'], $trans);
                            $fr_surnamevalue = strtr($friend_sname['surname'], $trans);}
                    ?>
                    <a href="/acc.php?id=<?if($u_id!=$id){echo$u_id;}else{echo$ff_id;}?>">
                        <?
                            if($_COOKIE['language']=='english'){echo$fr_namevalue;echo' ';echo$fr_surnamevalue;}
                            else{echo$friend_name['name'];echo" "; echo$friend_sname['surname'];}
                        ?>
                    </a>
                </div>
            </div><?}?>
        </div>
        <div class="profile_inf">
            <div class="profile_inf_name" style="margin-left:10px;margin-top:10px;"><?
            if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;echo" ";}
            else{echo $name;echo" ";echo $surname;echo" ";}
            if($of==1){echo"<img src='/img/verif.png' width='20px' height='20px' class'verified' title='Проверенный пользователь'>";}?>
            </div>
             <?if($online==1){?>
            <div class="profile_inf_online" style="color: #939393; font-size:14px;">Online</div><?}else{?>
            <div class="profile_inf_offline" style="color: #939393; font-size:14px;"><font class="user_status_off">Заходил(а)</font> <?echo $llogin;?></div>
            <?}?>
            <?if($sz!=''){?><div class="profile_inf_says"><?if($login==$_COOKIE['account']){?><script type="text/javascript" src="/js/says.js"></script><form action="settings/changesz.php" method="post"><input type="text" name="sz_input" class="sz_input" value="<?echo$sz;?>"></form><?}?><p class="profile_user_says"><?echo$sz;?></p></div><?}else if($sz=='' and $login==$_COOKIE['account']){?><div class="profile_inf_says"><form action="settings/changesz.php" method="post"><input type="text" name="sz_input" class="sz_input" placeholder="Установить статус"></form></div><?}
            if($login==$_COOKIE['account']){
            ?>
            <div class="sz_decline"></div><?}else{?>
            <div class="sz_decline" style="display:none;"></div>
            <?}?>
            <div class="profile_inf_other">
                <ul>
                    <?
                        if($_COOKIE['language']=='english'){
                            if($b_month=='января'){$ebirth_month='January';}
                            elseif($b_month=='февраля'){$ebirth_month='February';}
                            elseif($b_month=='марта'){$ebirth_month='March';}
                            elseif($b_month=='апреля'){$ebirth_month='April';}
                            elseif($b_month=='мая'){$ebirth_month='May';}
                            elseif($b_month=='июня'){$ebirth_month='June';}
                            elseif($b_month=='июля'){$ebirth_month='July';}
                            elseif($b_month=='августа'){$ebirth_month='August';}
                            elseif($b_month=='сентября'){$ebirth_month='September';}
                            elseif($b_month=='октября'){$ebirth_month='October';}
                            elseif($b_month=='ноября'){$ebirth_month='November';}
                            elseif($b_month=='декабря'){$ebirth_month='December';}
                            else{$ebirth_month=$b_month;}
                        }
                    ?>
                    <li style="margin-top:10px;"><font class="inf_birth">День рождения</font>: <a style="margin-top:-10px;"><?echo $b_day;echo" ";if($_COOKIE['language']=='english'){echo$ebirth_month;}else{echo$b_month;}echo", ";echo $b_year;?></a></li>
                    <li><font class="inf_city">Город</font>: <a style="margin-top:-10px;"><?if($city==''){echo"Неизвестно";}else{echo$city;}?></a></li>
                    <li><font class="inf_site">Веб-сайт</font>: <a style="margin-top:-10px;" href="<?if($site!=''){?>http://<?echo$site;}?>"><?if($site==''){echo"none";}else{echo"http://";echo$site;}?></a></li>
                    <?
                        if($_COOKIE['account']!=$login){echo'<script type="text/javascript" src="/js/info.js"></script>';}
                        else{echo'<script type="text/javascript" src="/js/info1.js"></script>';}
                    ?>
                    <li class="inf_show" onselectstart="return false" onmousedown="return false"><p>Показать остальное</p></li>
                    <li style="margin-top:10px;" class="inf_edu"><font class="inf_edu_ttl">Образование</font>: <a style="margin-top:-10px;"><?if($edu==''){echo"Неизвестно";}else{echo$edu;}?></a></li>
                    <li style="margin-top:10px;" class="inf_about"><font class="inf_ab_ttl">О себе</font>: <p style="margin-top:-10px;width:200px;max-height:100px;"><?if($about==''){echo"Пусто";}else{echo$about;}?></p></li>
                </ul>
            </div>
            <div class="profile_stats">
            <ul>
                <a href="/account/friends.php?id=<?echo$id;?>"><li><?echo$hisfriends;?> <br><font class="value_offr">друзья</font></li></a>
                <?
                    $res = mysql_query('SELECT COUNT(1) FROM `followers` WHERE u_id = '.$id.'');
                    if($res)
                    $row = mysql_fetch_array($res, MYSQL_NUM);
                    $hisfollowers = !empty($row[0]) ? $row[0] : 0;  
                ?>
                <li><a class="followers"><?echo$hisfollowers;?> <br><font>подписчики</font></a></li>
                <?
                    $res = mysql_query('SELECT COUNT(1) FROM `photos` WHERE `u_id` = '.$id.' AND `hidden` = 0');
                    if($res)
                    $row = mysql_fetch_array($res, MYSQL_NUM);
                    $hisphotos = !empty($row[0]) ? $row[0] : 0;  
                ?>
                <a href="/account/photos.php?id=<?echo$id;?>"><li><?$u_photos = $hisphotos + 1;echo$u_photos;?> <br><font class="value_ofph">фото</font></li></a>
            </ul>
            </div>
            <a href="/account/photos.php?id=<?echo$id;?>"><div class="profile_photos">
                <p style="padding-left:8px;padding-top:5px;color:#000;">
                    <?
                        if($_COOKIE['language']=='english'){
                            if($id==$user_id){echo"My photos";}else{echo$namevalue."'s photos";}
                            echo"<span style='color:#42aaff;margin-left:5px;'>".$u_photos."</span>";
                        }else{
                            if($id==$user_id){echo"Мои фотографии";}else{echo"Фотографии ".$name;}
                            echo"<span style='color:#42aaff;margin-left:5px;'>".$u_photos."</span>";
                        }
                    ?>  
                </p>
                <div class="profile_photos_show">
                    <?
                        $result = mysql_query("SELECT * FROM `photos` WHERE `u_id` = '".$id."' AND `hidden` = 0 ORDER BY id DESC LIMIT 5");
                        if(mysql_num_rows($result)==0){if($id==$user_id){echo"<span style='padding-left:8px;'>Добавить фото</span>";}}
                        while($row = mysql_fetch_array($result)) {
                            $ph_id=$row['id'];
                            $ph_name=$row['p_name'];
                            $ph_date=$row['p_date'];
                    ?>
                    <a href="/user/photos/<?echo$ph_name;?>"><img src="/user/photos/<?echo$ph_name;?>" width="90px" height="90px"></a>
                    <?}?>
                </div>
            </div></a>
            <div class="profile_wall">
                <?if($_COOKIE['account']==$login){?><div class="profile_wall_write">
                    <a href="/acc.php?id=<?echo$user_id;?>"><img src="<?echo$avatar;?>" height="28px" width="28px" style="border-radius:14px;"></a>
                    <form method="post" action="settings/writing.php?id=<?echo$user_id;?>">
                        <textarea name="post_name" class="profile_wall_write_input" onfocus="this.style='border-bottom:1px solid #42aaff;'" onblur="this.style='border-bottom:1px solid #d1d1d1;'" placeholder="Есть ли что-то интересное?"></textarea>
                        <input type="file" class="input_file file_img" name="profile_wall_img" accept=".png,.ico,.jpg,.jpeg,.bmp,.gif">
                        <input type="file" class="input_file file_video" name="profile_wall_video" style="margin-left:-10px;margin-top:10px;position:absolute;" accept=".mp4,.avi,.mov,.wmv">
                        <input type="file" class="input_file file_audio" name="profile_wall_audio" style="margin-left:18px;margin-top:9px;position:absolute;" accept=".mp3,.ogg,.wav,.3gp">
                        <input type="submit" class="msg_button" value="Написать" style="margin-top:10px;margin-left:150px;">
                    </form>
                </div><?}?>
            </div>
        </div>
        <?if($_COOKIE['account']==$login){echo'<link rel="stylesheet" type="text/css" href="/css/wall.css">';}else{echo'<link rel="stylesheet" type="text/css" href="/css/wall1.css">';}?>
        <div class="profile_wall_show">
                <?
                    $result = mysql_query("SELECT * FROM `wall` WHERE `user` = '".$id."' ORDER BY id DESC");
                    if(mysql_num_rows($result)==0){echo"Нет записей";}
                    while($row = mysql_fetch_array($result)) {
                        $w_text=$row['text'];
                        $w_date=$row['w_date'];
                ?>
            <div class="wall_show_avatar"><a href="/acc.php?id=<?echo$id;?>"><img src="<?echo$avatar;?>" height="50px" width="50px" style="border-radius:25px;"></a></div>
            <div class="wall_show">
                <div class="wall_show_user"><a href="/acc.php?id=<?echo$id;?>"><?echo$name;echo" ";echo$surname;?></a></div>
                <div class="wall_show_date"><?echo$w_date;?></div>
                <div class="wall_show_text"><?echo$w_text;?></div>
                <p class="wall_param" onselectstart="return false" onmousedown="return false">...</p>
            </div>
            <?if($_COOKIE['account']){?><ul class="wall_buttons">
                <li class="w_b_like"><div class="w_b_like_img"></div><p>Мне нравится</p></li>
                <li class="w_b_comment"><div class="w_b_comment_img"></div><p>Комментировать</p></li>
                <li class="w_b_repost"><div class="w_b_repost_img"></div></li>
            </ul><?}?>
            <?}?>
        </div>
    </div>
    <div id="modal">
            <form method="post" action="/settings/messageto.php?id=<?echo$id;?>" class="modal_form">
                <div class="modal_title">Новое сообщение</div>
                <div class="modal_user">
                    <div class="user_information">
                        <div class="modal_user_avatar"><a href="/acc.php?id=<?echo$id;?>"><img src="<?echo$avatar;?>" width="50px" height="50px" class="modal_user_avatar"></a></div>
                        <div class="modal_user_name" style="color:#42aaff;"><a href="/acc.php?id=<?echo$id;?>"><?echo$name;echo" ";echo$surname;?></a></div>
                        <div class="modal_user_online">
                            <?if($online==1){?>
                            <p>Online</p><?}else{?>
                            <p><font class="user_status_off">Заходил(а)</font> <?echo $llogin;?></p><?}?>
                        </div>
                        <div class="modal_user_dialogs"><a href="/account/messages.php?id=<?echo$user_id;?>">Перейти ко всем сообщениям</a></div>
                    </div>
                </div>
                <textarea cols="60" rows="5" name="text" class="msg_text" required></textarea>
                <input type="submit" value="Отправить" class="msg_button">
                <a style="cursor:pointer;"><div class="modal_close"></div></a>
            </form>
    </div>
    <div id="modal_fl">
        <div id="followers">
            <div class="followers_buttons">
                <ul>
                    <li style="position:absolute;"><span style="border-bottom:2px solid #008cff;padding-bottom:7px;">Подписчики  <font style="color:#0169be;"><?echo$hisfollowers;?></font></span></li>
                    <li class="followers_buttons_friend"><span style="padding-bottom:7px;">Друзья  <font style="color:#0169be;"><?echo$hisfriends;?></font></span></li>
                    <a style="cursor:pointer;"><div class="followers_close"></div></a>
                </ul>
            </div>
            <?
                    $result = mysql_query("SELECT * FROM followers WHERE u_id = '".$id."'");  
                    while($row = mysql_fetch_array($result)) {
                    $followers_sid=$row['s_id'];
                    $followers_uid=$row['u_id'];
            ?>
            <div class="followers_list">
               <div>
                    <p class="followers_list_names">
                        <?
                                $check_online = mysql_query("SELECT name FROM users WHERE id='$followers_sid'");
                                $fl_name = mysql_fetch_array($check_online);
                                $check_name = mysql_query("SELECT surname FROM users WHERE id='$followers_sid'");
                                $fl_sname = mysql_fetch_array($check_name);

                        ?>
                        <a href="/acc.php?id=<?echo$followers_sid;?>"><?echo$fl_name['name'];echo' ';echo$fl_sname['surname'];?></a>
                    </p>
                    <p>
                        <?
                                $check_online = mysql_query("SELECT avatar FROM users WHERE id='$followers_sid'");
                                $fl_avatar = mysql_fetch_array($check_online);
                        ?>
                        <a href="/acc.php?id=<?echo$followers_sid;?>"><img src="<?echo$fl_avatar['avatar'];?>" width="100px" height="100px" class="follower_avatar"></a>
                    </p>
               </div>
            </div><?}?>
        </div>
    </div>
    <div id="modal_avatar">
        <div id="avatar">
            <div class="avatar_show">
                <div class="avatar_show_close"></div>
                <div class="avatar_show_title" style="text-align:center;">Просмотр главной фотографии пользователя <font color="#42aaff"><?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;}else{echo $name;echo" ";echo $surname;}?></font></div>
                <figure class="fig"><img src="<?echo$avatar;?>" class="avatar_show_img"></figure>
            </div><!--лайк поставить путём одного клика на верхнюю часть изображения,репост - на нижнюю!-->
            <div class="avatar_comments"><!--Макс.отображение = 3,далее оверфлоу!-->
                <?
                    $result = mysql_query("SELECT * FROM `comments` WHERE `file_type` = 1 AND `commented_id` = '".$id."' ORDER BY date ASC");
                    if(mysql_num_rows($result)==0){echo"<span class='avatar_comments_urfirst'>Написав комментарий,вы будете первым!</span>";}
                    while($row = mysql_fetch_array($result)) {
                        $commentator_id=$row['commentator_id'];
                        $comment=$row['text'];
                        $comment_date=$row['date'];
                ?>
                <div class="avatar_comments_show">
                    <div class="avatar_comments_show_avatar">
                        <?
                            $check_online = mysql_query("SELECT avatar FROM users WHERE id='$commentator_id'");
                            $comm_avatar = mysql_fetch_array($check_online);
                        ?>
                        <img src="<?echo$comm_avatar['avatar'];?>" width="50px" height="50px">
                    </div>
                    <div class="avatar_comments_show_other">
                        <p style="color:#42aaff;">
                            <?
                                $check_online = mysql_query("SELECT name FROM users WHERE id='$commentator_id'");
                                $comm_name = mysql_fetch_array($check_online);
                                $check_online = mysql_query("SELECT surname FROM users WHERE id='$commentator_id'");
                                $comm_sname = mysql_fetch_array($check_online);
                            ?>
                            <a href="/acc.php?id=<?echo$commentator_id?>"><?echo$comm_name['name'];echo" ";echo$comm_sname['surname'];?></a>
                        </p>
                        <p><?echo$comment;?></p>
                        <p style="font-size:10px;color:#afafaf;"><?echo$comment_date;?></p>
                    </div>
                </div><?}?>
            </div>
            <?if(!empty($_COOKIE['account'])){?><div class="avatar_post_comment">
                <form method="post" action="/settings/post_comment.php?id=<?echo$id;?>&file=1" name="form_comment">
                    <img src="<?echo$user_ava;?>" width="50px" height="50px" class="avatar_post_comment_avatar">
                    <textarea class="avatar_post_comment_textarea" placeholder="Напишите комментарий" name="comment_text"></textarea>
                    <input type="submit" value="Отправить">
                </form>
            </div><?}?>
        </div>
    </div>
    <?if($user_email_status!=1 and $_COOKIE['account']!=''){?>
    <div class="set_email">
        <span>У вас не подтверждён e-mail!</span><br>
        <a href="/settings/activate.php?code=<?echo$acode;?>"><button class="set_email_accept">Подтвердить</button></a>
    </div>
    <?}}}}?>
</body>
<script type="text/javascript">
    $(function(){
        $('.avatar_post_comment_textarea').autoResize();
    });
</script>

<?if($_COOKIE['language']=="english"){?><script src="/js/eng_translater.js"></script><?}
elseif($_COOKIE['language']=="japanese"){?><script src="/js/jp_translater.js"></script><?}?>