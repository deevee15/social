<?php
    include_once("bd.php");
    $type=$_GET['type'];
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
                $l_ip=$row['user_ip'];
            }
            ?>
<body>
    <?
    if($support<=0){echo"<meta http-equiv='Refresh' content='0; URL=/index.php'>";}else{
        if($l_ip!=$_SERVER['REMOTE_ADDR'] and $_COOKIE['admined']!='positive'){?>
            <form action="/admin/check/pcheck.php?id=<?echo$user_id;?>" method="post">
                <p>Введите свой секретный код:</p>
                <input type="text" name="adm_pass"> 
                <input type="submit" value="Проверить"> 
            </form>
        <?}else{
    ?>
    <div id="header_1"></div>
    <div id="center">
    <div id="header">
        <div class="header_lg"><a id="header_dlg_a"><div class="aheader_lg_img"></div><div class="dop_logo">Admin</div></a></div>
        <form id="header_search" method="post" action="search.php">
            <input type="text" name="search_input" class="input_search" placeholder="Поиск" onfocus="if(this.placeholder=='Поиск') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Поиск';}">
        </form>
        <div class="points">
        <?if($support>=1){?>
            <a href="/admin/"><div class="header_users"  style="background:#218fe9;">Пользователи</div></a>
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
    <div id="menu">
        <ul>
            <?if($type==1 or $type==0){?>
            <a href="/admin/index.php?type=1"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Информация</li></a>
            <a href="/admin/index.php?type=2"><li>Блокировка</li></a>
            <?if($support>=3){?><a href="/admin/index.php?type=3"><li>Назначить администратором</li></a><?}?>
            <?}elseif($type==2){?>
            <a href="/admin/index.php?type=1"><li>Информация</li></a>
            <a href="/admin/index.php?type=2"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Блокировка</li></a>
            <?if($support>=3){?><a href="/admin/index.php?type=3"><li>Назначить администратором</li></a><?}?>
            <?}elseif($type==3){?>
            <a href="/admin/index.php?type=1"><li>Информация</li></a>
            <a href="/admin/index.php?type=2"><li>Блокировка</li></a>
            <?if($support>=3){?><a href="/admin/index.php?type=3"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Назначить администратором</li></a><?}?>
            <?}?>
        </ul>
    </div>
    <div id="moves">
        <?if($type==0 or $type==1){?>
        <form action="repage.php" method="post">
            <p>ID пользователя:</p>
            <input type="text" name="user_id" required autocomplete="off"><br>
            <input type="submit" value="Поиск" class="user_submit">
        </form>
        <?}elseif($type==2){?>
        <form action="repage.php" method="post" class="form_blockuser">
            <p>ID пользователя:</p>
            <input type="text" name="ban_user" class="ban_user">
            <p>Причина блокировки(см ниже):</p>
            <input type="text" name="ban_reason" class="ban_reason"><br>
            <p>Время блокировки(0 - навсегда, 111 - разбан):</p>
            <input type="text" name="ban_time" required><br>
            <input type="submit" value="Блокировка" class="user_submit">
        </form>
        <div class="warning" style="color:#ff0000;"></div>
        <script>
            $('.user_submit').click(function(){
                var user_id = $('.ban_user').val();
                var ban_reason = $('.ban_reason').val();
                function lightbanid(){
                    $('.ban_user').css({'border-color':'#e93939'});
                    setTimeout(function(){
                    $('.ban_user').removeAttr('style');
                    },700);
                    var tryblock_id1;
                }
                if(user_id=='1'){
                    $('.warning').text("В случае повторной попытки бана Создателя SOCIAL вы будете заблокированы.");
                    return false;
                }
                else if(user_id==''){
                    lightbanid();
                    return false;
                }
                if(ban_reason<1 || ban_reason>5){
                    $('.warning').text("Нужно ввести корректную причину в виде цифры(см.ниже)");
                    return false;
                }
            });
        </script>
        <div style="margin-top:10px;">
            Вы хотите заблокировать пользователя.Учтите: разблокировку осуществляет только высшая администрация.
            Причины блокировки есть:<br>
            <p class="reasons_list">
                <b>1</b> - <i>продажа аккаунта/валюты сайта</i><br>
                <b>2</b> - <i>аккаунт украден</i><br>
                <b>3</b> - <i>массовые оскорбления пользователей и администрации</i><br>
                <b>4</b> - <i>неприемлемый материал на странице пользователя</i><br>
                <b>5</b> - <i>фейк-аккаунт</i><br>
            </p>
        </div>
        <?}elseif($type==3){?>
        <form action="repage.php" method="post" class="">
            <p>ID пользователя:</p>
            <input type="text" name="user_adadm_id" class="user_adadm_id">
            <p>Уровень(1-3):</p>
            <input type="text" name="user_adadm_lvl" class="user_adadm_lvl"><br>
            <input type="submit" value="Назначить" class="user_submit">
        </form>    
        <?}?>
    </div>
    <?}}?>
</div>
</body>