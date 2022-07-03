<?php
    include_once("bd.php");
    include_once("check.php");
    $type=$_GET['type'];
?>
<head>
    <title>Admin | Администрация</title>
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
            if($support<3 and $type==2){echo"<meta http-equiv='Refresh' content='0; URL=/admin/admins.php'>";}
            ?>
<body>
    <div id="header">
        <div class="header_lg"><a id="header_dlg_a"><div class="aheader_lg_img"></div><div class="dop_logo">Admin</div></a></div>
        <form id="header_search" method="post" action="search.php">
            <input type="text" name="search_input" class="input_search" placeholder="Поиск" onfocus="if(this.placeholder=='Поиск') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Поиск';}">
        </form>
        <div class="points">
        <?if($support>=1){?>
            <a href="/admin/"><div class="header_users">Пользователи</div></a>
            <?if($support>=2){?><a href="/admin/admins.php"><div class="header_admins" style="background:#218fe9;">Администрация</div></a><?}?>
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
            <?if($type==1 or $type==0){?>
            <a href="/admin/admins.php?type=1"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Список администраторации</li></a>
            <?if($support>2){?><a href="/admin/admins.php?type=2"><li>Переназначить</li></a><?}?>
            <a href="/admin/admins.php?type=3"><li>Удалить</li></a>
            <?}elseif($type==2){?>
            <a href="/admin/admins.php?type=1"><li>Список администраторации</li></a>
            <?if($support>2){?><a href="/admin/admins.php?type=2"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Переназначить</li></a><?}?>
            <a href="/admin/admins.php?type=3"><li>Удалить</li></a>
            <?}elseif($type==3){?>
            <a href="/admin/admins.php?type=1"><li>Список администраторации</li></a>
            <?if($support>2){?><a href="/admin/admins.php?type=2"><li>Переназначить</li></a><?}?>
            <a href="/admin/admins.php?type=3"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Удалить</li></a>
            <?}?>
        </ul>
    </div>
    <div id="moves">
        <?if($type==1 or $type==0){
        $result = mysql_query("SELECT * FROM `users` WHERE `support` != 0 ORDER BY support DESC");
        while($row = mysql_fetch_array($result)) {
            $a_name=$row['name'];
            $a_sname=$row['surname'];
            $a_lvl=$row['support'];
            $admin_id=$row['id'];
            $admin_ip=$row['user_ip'];
            $admin_ava=$row['avatar'];
            $dreg=$row['regdate'];
        ?>
        <div class="admin_profile">
            <div class="admin_profile_inicials"><a href="/admin/showuser.php?id=<?echo$admin_id;?>"><?echo$a_name;echo" ";echo$a_sname;?></a></div>
            <div class="admin_profile_avatar"><img src="<?echo$admin_ava;?>"></div>
            <div class="header_admin_info">Информация</div>
            <div class="admin_profile_ip">Active IP: <?echo$admin_ip;?></div>
            <div class="admin_profile_dreg">Date of registation: <?echo$dreg;?></div>
            <?
                if($a_lvl==1){$admin="<span style='color:#08b5c5;'><div class='admin_stars'><img src='/img/star_support.png' width='30px' height='30px'></div>Support</span>";}
                elseif($a_lvl==2){$admin="<span style='color:#ff0000;'><div class='admin_stars'><img src='/img/star.png' width='30px' height='30px'><img src='/img/star.png' width='30px' height='30px'></div>Secretary</span>";}
                elseif($a_lvl==3){$admin="<b style='color:#ff0000;'><div class='admin_stars'><img src='/img/star.png' width='30px' height='30px'><img src='/img/star.png' width='30px' height='30px'><img src='/img/star.png' width='30px' height='30px'></div>General Secretary</b>";}
                elseif($a_lvl>3){$admin="<b style='color:#920202;'>Unsupported rank ($a_lvl)</b>";}
            ?>
            <div class="admin_profile_level"><?echo$admin;?></div>
        </div>   
        <?}}elseif($type==2){?>
            <form action="setlvl.php" method="post">
                <p>ID:</p>
                <input type="text" name="admin_id" required>
                <p>Имя и фамилия:</p>
                <input type="text" name="admin_names" required><br>
                <p>Новая должность:</p>
                <input type="text" name="admin_lvl" required><br>
                <input type="submit" value="ОК" class="user_submit">
            </form>
        <?}?>
    </div>
    <?}?>
</body>