<?php
    include_once("bd.php");
    include_once("check.php");
    $type=$_GET['type'];
?>
<head>
    <title>Admin | Новости</title>
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
            if($support<3 and ($type==1 or $type==0)){echo"<meta http-equiv='Refresh' content='0; URL=/admin/news.php?type=2'>";}
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
            <?if($support>=2){?><a href="/admin/admins.php"><div class="header_admins">Администрация</div></a><?}?>
            <a href="/admin/news.php"><div class="header_banned" style="background:#218fe9;">Новости</div></a>
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
            <?if($support==3){?><a href="/admin/news.php?type=1"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Создать статью</li></a><?}?>
            <a href="/admin/news.php?type=2"><li>Просмотреть созданные</li></a>
            <a href="/admin/news.php?type=3"><li>Корзина</li></a>
            <?}elseif($type==2){?>
            <?if($support==3){?><a href="/admin/news.php?type=1"><li>Создать статью</li></a><?}?>
            <a href="/admin/news.php?type=2"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Просмотреть созданные</li></a>
            <a href="/admin/news.php?type=3"><li>Корзина</li></a>
            <?}elseif($type==3){?>
            <?if($support==3){?><a href="/admin/news.php?type=1"><li>Создать статью</li></a><?}?>
            <a href="/admin/news.php?type=2"><li>Просмотреть созданные</li></a>
            <a href="/admin/news.php?type=3"><li style="border-left:2px solid #42aaff;margin-left:-1px;">Корзина</li></a>
            <?}?>
        </ul>
    </div>
    <div id="moves">
        <?if(($type==1 or $type==0) and $support==3){?>
        <form action="create_paper.php" method="post">
            <p>Заголовок статьи:</p>
            <input type="text" name="paper_title" required>
            <p>Текст статьи:</p>
            <textarea cols="27" rows="5" name="paper_text"></textarea>
            <p>Скриншот статьи:</p>
            <input type="text" name="paper_screen" required><br>
            <input type="submit" value="Добавить" class="user_submit">
        </form><?}elseif($type==2){?>
        <?
            $result = mysql_query("SELECT * FROM `news` WHERE deleted = 0");
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $title=$row['title'];
                $text=$row['text'];
                $screens=$row['screens'];
                $date=$row['date'];
            
        ?>
        <div class="content_news">
            <h1><?echo$title;?></h1>
            <p><?echo$text;?></p>
            <p><a href="<?echo$screens;?>"><img src="<?echo$screens;?>" width="150px" height="100px"></a></p>
            <h4><?echo$date;?></h4>
        </div><?}?>
        <?}elseif($type==3){?>
            <?
            $result = mysql_query("SELECT * FROM `news` WHERE deleted = 1");
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $title=$row['title'];
                $text=$row['text'];
                $screens=$row['screens'];
                $date=$row['date'];
            
            ?>
        <div class="content_news">
            <h1><?echo$title;?></h1>
            <p><?echo$text;?></p>
            <p><a href="<?echo$screens;?>"><img src="<?echo$screens;?>" width="150px" height="100px"></a></p>
            <h4><?echo$date;?></h4>
        </div><?}?>
        <?}?>
    </div>
    <?}?>
</body>