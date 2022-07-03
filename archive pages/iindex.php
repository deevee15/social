<?php
    include_once("bd.php");include_once("devices.php");
?>
<html>
<head>
    <title>Social</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/optimization/main.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/singin.js"></script>
    <script type="text/javascript" src="/js/menu.js"></script>
    <script type="text/javascript" src="/js/loginreg.js"></script>
    <link rel="ICON" href="/img/1.png" type="image/gif">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
</head>
<body>
    <?
    if($mobile==1){echo"<meta http-equiv='Refresh' content='0; URL=/mobile/'>";}else{
    if(empty($_COOKIE['account'])){?>
    <div id="header_fill" style="background:#42aaff;width:100%;height:41px;position:relative;"></div>
    <div id="optimised" style="position:absolute;margin-top:-41px;">
    <div id="header">
        <div class="header_lg"><a href="/" id="header_lg_a"><div class="header_lg_img"></div></a></div>
        <form id="header_search" method="post" action="search.php">
            <?if($_COOKIE['language']=="english"){?><input type="text" name="search_input" class="input_search" placeholder="Search" onfocus="if(this.placeholder=='Search') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Search';}"><?}else{?>
            <input type="text" name="search_input" class="input_search" placeholder="Поиск" onfocus="if(this.placeholder=='Поиск') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Поиск';}"><?}?>
        </form>
        <div class="header_enter">
            <div class="photo_user"><p>Войти</p> <img src="img/default_user.png" width="40px" height="40px"></div>
            <ul class="settings">
                <a href="singup.php"><li class="st_reg">Регистрация</li></a>
                <a href="/"><li class="st_ent">Вход</li></a>
                <a href="rules.php"><li class="st_rl">Правила пользования</li></a>
            </ul>
        </div>
    </div>
    <div id="content">
        <div class="content_screens">
            <ul class="scr_text">
                <li class="scr_text_1">Страница профиля:</li>
                <li class="scr_text_2">Страница друзей:</li>
            </ul><br>
            <ul class="scr_img">
                <li><a href="img/main/1.png"><img src="img/main/1.png" width="300px" height="150px"></a></li>
                <li><a href="img/main/2.png"><img src="img/main/2.png" width="300px" height="150px"></a></li>
            </ul>
        </div>
        <div class="content_info">
            <div class="content_settings">
                <ul>
                    <a href="/mobile/setlang.php?u=<?echo$id;?>&l=1"><li style="background:#fff;margin-bottom:5px;"><img src="/img/flags/2.gif" width="30px" height="25px" style="border:1px solid #afafaf;"> <font>English</font></li></a>
                    <a href="/mobile/setlang.php?u=<?echo$id;?>&l=2"><li style="background:#fff;margin-bottom:5px;"><img src="/img/flags/1.gif" width="30px" height="25px" style="border:1px solid #afafaf;"> <font>Русский</font></li></a>
                    <a href="/mobile/setlang.php?u=<?echo$id;?>&l=3"><li style="background:#fff;margin-bottom:5px;"><img src="/img/flags/3.gif" width="30px" height="25px" style="border:1px solid #afafaf;"> <font>日本語</font></li></a>
                </ul>  
            </div>
            <div class="content_first_info">
                <div class="content_info_mail"><p>vikulovd15@gmail.com</p></div>
                <div class="content_info_vk"><a href="https://vk.com/id128992545" target="_blank">id128992545</a></div>
            </div>
        </div>
        <div class="content_login">
            <div class="select_type">
                <ul><hr width="215px" class="hr_content_login">
                    <li style="border-bottom:2px solid #42aaff;" class="select_enter">Войти</li>
                    <li class="select_reg">Зарегистрироваться</li>
                </ul>
            </div><br>
            <form method="post" action="/singup.php" name="form_reg" class="form_reg">
                <input type="text" placeholder="Ваш e-mail" name="auth_email" class="auth_email"><br>
                <input type="submit" value="Далее" class="reg_submit">
            </form>
            <form method="post" name="form_login" class="form_login">
                <input type="text" placeholder="Login" name="auth_login" class="auth_login"><br>
                <input type="password" placeholder="Password" name="auth_password" class="auth_password"><br>
                <a href="/forgotten.php" class="a_forgotten"><p class="forgotten" style="margin-top:5px;">Забыли пароль?</p></a>
                <input type="submit" value="Войти" class="auth_submit" style="cursor:pointer;">
                <p class="info"></p>
            </form>
        </div>
        <?
            $result = mysql_query("SELECT * FROM `news` WHERE deleted = 0 ORDER BY id DESC");
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
    </div>
    <?}else{
      $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $changed_id=$row['changed_id'];
            }?>
    <meta http-equiv='Refresh' content='0; URL=/acc.php?id=<?echo$id;?>'>
    <?}}?></div>
</body>