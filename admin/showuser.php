<?
    include_once("bd.php");include_once("check.php");
    $id=$_GET['id'];include_once("vars.php");
    
?>
<head>
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/account.css">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/acc_menu.js"></script>
    <script type="text/javascript" src="/js/menu.js"></script>
    <script type="text/javascript" src="/js/exp.js"></script>
    <script type="text/javascript" src="/js/admin_menu.js"></script>
    <link rel="ICON" href="/img/1.png" type="image/gif">
</head>
        <?
            $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
            while($row = mysql_fetch_array($result)) {
                $support=$row['support'];
                $user_id=$row['id'];
            }
        ?>
<body>
    <div id="header">
        <div class="header_lg"><a id="header_dlg_a"><div class="aheader_lg_img"></div><div class="dop_logo">Admin</div></a></div>
        <form id="header_search" method="post" action="search.php">
            <input type="text" name="search_input" class="input_search" placeholder="Поиск" onfocus="if(this.placeholder=='Поиск') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Поиск';}">
        </form>
        <div class="points">
        <?if($support>=1){?>
            <a href="/admin/"><div class="header_users" style="background:#218fe9;">Пользователи</div></a>
            <?if($support>=2){?><a href="/admin/admins.php"><div class="header_admins">Администрация</div></a><?}?>
            <a href="/admin/news.php"><div class="header_banned">Новости</div></a>
        <?}?></div>
        <?if($_COOKIE['account']){?>
        <div class="aheader_account">
            <?
               $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
            while($row = mysql_fetch_array($result)) {$cook_name=$row['name'];$cook_ava=$row['avatar'];}
            ?>
            <a href="/"><div class="photo_user"><img src="<?echo $cook_ava;?>" width="40px" height="40px"></div></a>
            <ul class="settings">
                <a href="/"><li style="border-bottom:1px solid #afafaf;">Мой профиль</li></a>
                <a href="/account/edit.php?id=<?echo$user_id?>"><li style="margin-top:3px;">Редактирование</li></a>
                <a href="/account/settings.php?id=<?echo$user_id;?>&st=1"><li>Настройки</li></a>
                <a href="/account/exit.php"><li style="border-top:1px solid #afafaf; margin-top:3px;">Выйти</li></a>
            </ul>
        </div><?}else{?>
        <div class="header_enter">
            <div class="photo_user"><p>Войти</p> <img src="img/default_user.png" width="40px" height="40px"></div>
            <ul class="settings">
                <a href="singup.php"><li>Регистрация</li></a>
                <a href="/"><li>Вход</li></a>
                <a href="rules.php"><li>Правила пользования</li></a>
            </ul>
        </div>
        <?}?>
    </div>
    <?if($_SESSION['admined']!=1){?>
    <div id="check_admin">
        <form action="/admin/check.php" method="post">
            <p>Подтвердите,что вы администратор:</p>
            <input type="password" placeholder="Введите пароль" name="admin_check">
            <input type="submit" value="Подтвердить">
        </form>
    </div><?}else{?>
    <div id="menu">
        <ul>
            <a href="/admin/index.php?type=1"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Информация</li></a>
            <a href="/admin/index.php?type=2"><li>Блокировка</li></a>
            <a href="/admin/index.php?type=3"><li>Назначить администратором</li></a>
        </ul>
    </div>
    <div id="moves">
        <ul>
        <?
            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            if(strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
            else if(strpos($user_agent, "Opera") !== false) $browser = "Opera";
            else if(strpos($user_agent, "YaBrowser") !== false) $browser = "Yandex";
            else if(strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
            else if(strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
            else if(strpos($user_agent, "Safari") !== false) $browser = "Safari";
            else $browser = "Неизвестный";
        ?>
        </ul>
        <div class="info_profile">
            <style>
                .admin_stars{
                    position: absolute;
                    margin-left: 20px;
                    margin-top: -23px;
                }
            </style>
            <?
                if($adm_lvl==1){$admin="<div class='admin_stars'><img src='/img/star_support.png' width='20px' height='20px'></div>";}
                elseif($adm_lvl==2){$admin="<div class='admin_stars'><img src='/img/star.png' width='20px' height='20px'><img src='/img/star.png' width='20px' height='20px'></div>";}
                elseif($adm_lvl==3){$admin="<div class='admin_stars'><img src='/img/star.png' width='20px' height='20px'><img src='/img/star.png' width='20px' height='20px'><img src='/img/star.png' width='20px' height='20px'></div>";}
            ?>
            <div class="info_profile_inicials"><a href="/acc.php?id=<?echo$id;?>">id:<?echo$id;?>,names: <?echo$name;echo" ";echo$surname;?></a><?echo$admin;?></div>
            <div class="info_profile_avatar">
                <img src="<?echo$avatar;?>">
            </div>
            <div class="header_user_info">Информация</div>
            <div class="info_profile_avatar">Active IP: <?echo$u_ip;?></div>
            <div class="info_profile_dreg">
                <div class="stat_status"><img src="/img/user/user_datereg.png" width="20px" height="20px" style="position:absolute;margin-left:-30px;">Date of registation:</div> 
                <div class="stat_ans"><?echo$dreg;?></div>
            </div>
            <?
                $result = mysql_query("SELECT * FROM `banned` WHERE `id` = '".$id."'");
                if(mysql_num_rows($result)!=0){$banned='<span style="color:#ff0000;">Banned</span>';}else{$banned='Clear account';}
            ?>
            <div class="info_profile_status"> 
                <div class="stat_status"><img src="/img/user/ban_status.png" width="20px" height="20px" style="position:absolute;margin-left:-30px;">Account status:</div>
                <div class="stat_ans"><?echo$banned;?></div>
            </div>
            <div class="info_profile_slang">
                <div class="stat_status"><img src="/img/user/user_lang.png" width="20px" height="20px" style="position:absolute;margin-left:-30px;">Site language:</div>
                <div class="stat_ans"><?echo$slg;?></div>
            </div>
            <div class="info_profile_slang">
                <div class="stat_status"><img src="/img/user/user_browser.png" width="27px" height="27px" style="position:absolute;margin-left:-50px;">Browser: </div>
                <div class="stat_ans"><?echo$browser;?></div>
            </div>
            <div class="info_profile_email">
                <div class="stat_status"><img src="/img/user/user_mail.png" width="27px" height="18px" style="position:absolute;margin-left:-52px;margin-top:3px;">E-mail:</div> 
                <div class="stat_ans"><?echo$login;?></div>
            </div>
            <?if($support>=2 and $adm_lvl==0){?><div class="info_profile_password">
                <div class="stat_status"><img src="/img/user/user_password.png" width="20px" height="20px" style="position:absolute;margin-left:-40px;margin-top:3px;">Password:</div> 
                <div class="stat_ans"><?echo$pass;?></div>
            </div><?}?>
        </div>
    </div>
    <?}?>
</body>