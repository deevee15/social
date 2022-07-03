<?php
    include_once("bd.php");$id=$_GET['id'];include_once("vars.php");
?>
<head>
    <?
        if($_COOKIE['language']=='english'){
            include("translater.php");
            $namevalue = strtr($name, $trans);
            $surnamevalue = strtr($surname, $trans);}
    ?>
    <title><?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;echo"'s photos";}else{echo"Фотографии";echo $name;echo" ";echo $surname;}?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/account.css">
    <link rel="stylesheet" type="text/css" href="/css/photos.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/acc_menu.js"></script>
    <script type="text/javascript" src="/js/menu.js"></script>
    <script type="text/javascript" src="/js/fixed_header.js"></script>
    <script type="text/javascript" src="/js/amenu.js"></script>
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
            $res = mysql_query('SELECT COUNT(1) FROM `followers` WHERE u_id = '.$id.'');
            if($res)
            $row = mysql_fetch_array($res, MYSQL_NUM);
            $subs = !empty($row[0]) ? $row[0] : 0;
?>
<body>
<?if($adm_lvl==3 and $e_functions==1){?>
    <script type="text/javascript">
        $("body").css({"background":"url(<?echo$bg;?>) no-repeat fixed"});
        var h = screen.height;
        var w = screen.width;
        if(w=='1280' && h=='1024'){
            $("body").css({"background-size":"1280px 1024px"});
        }else{
        $("body").css({"background-size":"cover"});}
    </script>
<?}?>
    <script type="text/javascript">
        $(window).width(); //Ширина браузера
        $(window).height();
    </script>
    <?
        if($id==0){echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";}else{
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
        <form id="header_search" method="post" action="search.php">
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
            <div class="photo_user"><p style="font-size:15px;"><b><?if($_COOKIE['language']=='english'){echo $translatedname;}else{echo$cook_name;}?></b></p><img src="<?echo $cook_ava;?>" width="40px" height="40px"></div>
            <ul class="settings">
                <a href="/"><li style="border-bottom:1px solid #afafaf;" class="hd_acc_st_pr">Мой профиль</li></a>
                <a href="/account/edit.php?id=<?echo$id;?>"><li style="margin-top:3px;" class="hd_acc_st_ed">Редактирование</li></a>
                <a href="/account/settings.php?id=<?echo$id;?>&st=1"><li class="hd_acc_st_st">Настройки</li></a>
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
    <?if(!empty($_COOKIE['account'])){?>
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
    <?}else{?>
    <div id="user_login">
        <form method="post" action="/settings/singin.php" name="user_login_form">
            <p>E-mail:</p> <input type="text" name="auth_login"><br>
            <p>Пароль:</p> <input type="password" name="auth_password"><br>
            <input type="submit" value="Войти" name="auth_submit"><br>
        </form>
        <a href="/singup.php"><button class="user_registration">Регистрация</button></a><br>
        <a href="/settings/forgotten.php" class="user_forgotten">Забыли пароль?</a>
    </div><?}?>
    <div id="photos">
        <?if($id==$user_id){
            if($user_email_status!=1){echo"<p align='center'><a href='/settings/activate.php?code=".$acode."' class='activate_link'>Подтвердите свой E-Mail</a> <font class='activate_text'>для загрузки фотографии профиля</font></p>";}else{?>
        <form action="/avatars/upload.php?id=<?echo$id;?>" method="post" enctype="multipart/form-data">
            <script src="/js/custom-file-input.js"></script>
            <input type="file" name="uploadfile" accept=".png,.gif,.jpg,.jpeg" class="outtaHere inputfile" id="upload2" data-multiple-caption="{count} files selected" multiple>
            <label for="upload2"><span class="lbl_ttl2">Загрузить аватар</span></label>
            <input type="submit" value="OK" style="position:absolute; margin-left:810px;margin-top:8px;height:26px; color:#fff; background:#42aaff;border:1px solid #42aaff;cursor:pointer;padding:0px 5px;border-radius:2px;" class="upload_photo_submit">
        </form><?}?>
        <form action="/user/photos/p_upload.php?id=<?echo$id;?>" method="post" enctype="multipart/form-data" name="edit_form">
            <script src="/js/custom-file-input.js"></script>
            <input type="file" name="uploadfile" accept=".png,.gif,.jpg,.jpeg" class="outtaHere inputfile" id="upload" data-multiple-caption="{count} files selected" multiple>
            <label for="upload"><span class="lbl_ttl">Загрузить фото</span></label>
            <input type="submit" value="OK" style="position:absolute; margin-left:810px;margin-top:208px;height:26px; color:#fff; background:#42aaff;border:1px solid #42aaff;cursor:pointer;padding:0px 5px;border-radius:2px;" class="upload_photo_submit">
        </form><?}else{?>
        <div class="back_to_profile">
            <a href="/acc.php?id=<?echo$id;?>"><button><font>Вернуться к</font> <?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;}else{echo$name;echo" ";echo$surname;}?></button></a>
        </div>
        <?}?>
        <div class="photos_avatar">
            <p><font>Фотография профиля</font> <?echo$name;?></p>
            <figure class="fig"><a href="<?echo$avatar?>"><img src="<?echo$avatar?>"></a></figure>
        </div>
        <div class="photos_other">
            <?
                if($_COOKIE['account']==$login){$res = mysql_query('SELECT COUNT(1) FROM `photos` WHERE `u_id` = '.$id.'');}
                else{$res = mysql_query('SELECT COUNT(1) FROM `photos` WHERE `u_id` = '.$id.' AND `hidden` = 0');}
                if($res)
                $row = mysql_fetch_array($res, MYSQL_NUM);
                $hisphotos = !empty($row[0]) ? $row[0] : 0;  
            ?>
            <p><font class="photos_other_ttl">Фотографии со стены</font> <?echo$name;?> (<font style="color:#42aaff;"><?echo$hisphotos;?></font>)</p>
            <?
            if($_COOKIE['account']==$login){$result = mysql_query("SELECT * FROM `photos` WHERE u_id = ".$id." ORDER BY id DESC");}   
            else{$result = mysql_query("SELECT * FROM `photos` WHERE u_id = ".$id." AND hidden = 0 ORDER BY id DESC");}
            while($row = mysql_fetch_array($result)) {
                $p_name = $row['p_name'];
                $p_date = $row['p_date'];
            ?>
            <a href="/user/photos/<?echo$p_name;?>"><img src="/user/photos/<?echo$p_name;?>" height="135px" width="135px"></a><?}?>
        </div>
    </div>
<?}?>
</body>
<?if($_COOKIE['language']=="english"){?><script src="/js/eng_translater.js"></script><?}
elseif($_COOKIE['language']=="japanese"){?><script src="/js/jp_translater.js"></script><?}?>