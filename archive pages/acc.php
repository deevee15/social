<?
    include_once("bd.php");$id=$_GET['id'];
    $check_existing=mysql_query("SELECT * FROM `users` WHERE id = '".$id."' OR changed_id = '".$id."'");
    if(mysql_num_rows($check_existing)==0){echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";}
    include_once("vars.php");include_once("exp.php");include_once("devices.php");include_once("getlang.php");
?>
<head>
    <?
        if($_COOKIE['language']=='english'){
            //имена
            include("translater.php");
            $namevalue = strtr($name, $trans);
            $surnamevalue = strtr($surname, $trans);}
    ?>
    <title><?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;}else{echo $name;echo" ";echo $surname;}?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/account.css">
    <link rel="stylesheet" type="text/css" href="/css/newaccount.css">
    <link rel="stylesheet" type="text/css" href="/css/optimization/account.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery-2.2.4.js"></script>
    <script type="text/javascript" src="/js/acc_menu.js"></script>
    <script type="text/javascript" src="/js/menu.js"></script>
    <script type="text/javascript" src="/js/fixed_header.js"></script>
    <script type="text/javascript" src="/js/amenu.js"></script>
    <script type="text/javascript" src="/js/friends_menu.js"></script>
    <script type="text/javascript" src="/js/autoresize.jquery.js"></script>
    <script type="text/javascript" src="/js/showinformation.js"></script>
    <script type="text/javascript" src="/js/select_point_acc.js"></script>
    <script type="text/javascript" src="/js/messages.js"></script>
    <script src="https://kit.fontawesome.com/db1017c910.js" crossorigin="anonymous"></script>
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
        if($id!=$user_id){
            $result = mysql_query("SELECT * FROM `friends` WHERE (`u_id` = '".$id."' OR `f_id` = '".$id."')");
            if(mysql_num_rows($result)!=0){
                 $query = "UPDATE friends SET raiting=raiting+1 WHERE (`u_id` = '".$id."' OR `f_id` = '".$id."')";
                 $resultttt = mysql_query($query) or die(mysql_error());;
            }
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
        <div class="header_lg"><a href="/" id="header_lg_a">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="74px" height="59px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
    <g id="Layer_1">
        <g>
            <path d="M232.27,337.35c-3.03-0.24-6.23-0.36-9.59-0.36c-3.37,0-6.9,0-10.6,0c-16.15,0-34.33,0.36-54.52,1.07l-23.22,50.82
			c3.03-9.3,8.58-26.12,16.66-50.46c-5.39,0.24-10.77,0.48-16.15,0.72c-5.39,0.24-10.94,0.6-16.66,1.07
			c-3.71,9.3-7.24,18.07-10.6,26.3c-3.37,8.23-6.56,15.81-9.59,22.72c2.02-6.92,4.2-14.49,6.56-22.72
			c2.35-8.23,4.87-16.88,7.57-25.94c-41.73,2.63-77.41,5.85-107.02,9.66c15.81-4.05,32.89-8.11,51.24-12.17
			c18.34-4.05,38.11-8.11,59.32-12.17c3.36-11.93,6.48-23.62,9.34-35.07c2.86-11.45,5.63-22.9,8.33-34.35
			c-16.15-6.92-31.3-13.06-45.43-18.43c-14.14-5.37-27.43-10.08-39.88-14.13l34.33-25.77c10.43-1.67,21.03-3.28,31.8-4.83
			c10.77-1.55,21.87-2.92,33.32-4.12c1.34-6.92,2.35-13.42,3.03-19.5c0.67-6.08,1.34-11.51,2.02-16.28l30.79-6.44
			c-1.01,5.49-2.36,11.51-4.04,18.07c-1.69,6.56-3.71,13.66-6.06,21.29c8.41-0.95,16.82-1.67,25.24-2.15
			c2.35-9.06,4.12-17.29,5.3-24.69c1.18-7.39,2.1-13.83,2.78-19.32l31.3-6.44c-1.35,6.21-3.2,13.36-5.55,21.47
			c-2.36,8.11-5.39,17.18-9.09,27.2c13.46-0.72,25.57-1.07,36.35-1.07h0.5l8.58,27.91c-7.41-0.95-15.57-1.73-24.48-2.33
			c-8.92-0.59-18.77-1.01-29.53-1.25c-5.73,14.31-12.29,30.42-19.69,48.31c28.6,15.75,51.82,30.78,69.67,45.09L232.27,337.35z
			 M142.16,215.86c0.84-3.46,1.59-6.86,2.27-10.2c-9.77,0.48-18.68,0.96-26.76,1.43c-8.08,0.48-15.32,1.2-21.71,2.15
			c6.73,2.39,13.8,5.07,21.2,8.05c7.4,2.99,14.97,6.14,22.72,9.48C140.56,222.96,141.31,219.32,142.16,215.86z M160.08,268.46
			c-4.04-1.79-8.08-3.63-12.12-5.55c-3.71,10.26-7.49,20.46-11.36,30.6c-3.87,10.14-7.82,20.34-11.86,30.6
			c5.72-1.19,11.27-2.2,16.66-3.04c5.38-0.83,10.77-1.73,16.15-2.68l14.64-44.37C168.15,272.1,164.12,270.25,160.08,268.46z
			 M192.89,205.3c-1.69-0.23-3.53-0.36-5.55-0.36c-1.69,0-3.37,0-5.05,0c-2.7,0-5.22,0-7.57,0c-2.36,0-4.72,0.12-7.07,0.36
			c-1.69,4.78-3.37,9.61-5.05,14.49c-1.69,4.89-3.37,9.96-5.05,15.21c3.7,1.91,7.57,3.82,11.61,5.73c4.04,1.91,7.9,3.82,11.61,5.73
			L192.89,205.3z M183.3,279.73c-2.36,5.49-4.88,11.33-7.57,17.54c-2.7,6.21-5.55,12.65-8.58,19.32c13.8-2.38,26.42-4.35,37.86-5.9
			c11.44-1.55,21.87-2.92,31.3-4.12C220.15,297.75,202.48,288.8,183.3,279.73z"></path>
        </g>
    </g>
    <g id="Layer_2">
        <g>
            <path d="M279.57,328.65c2.85-37.17,15.69-68.3,38.53-93.39c27.11-29.68,68.92-52.24,125.43-67.69l48.8,12.85
			c0.28,1.99,0.43,3.98,0.43,5.97c0,1.84,0,3.75,0,5.74c0,17.9-2.86,34.34-8.56,49.33c-5.71,14.99-14.98,28.84-27.83,41.53
			c-12.84,12.7-29.69,24.32-50.52,34.88c-20.84,10.56-46.38,20.42-76.63,29.6L279.57,328.65z M436.26,175.37
			c-39.1,13-68.64,29.37-88.62,49.1c-19.98,19.73-29.97,41.84-29.97,66.31c0,16.37,4.56,32.35,13.7,47.96
			c41.38-10.55,73.49-25.62,96.32-45.2c23.12-19.42,34.68-41.45,34.68-66.08C462.37,204.36,453.66,187,436.26,175.37z"></path>
        </g>
    </g>
    <g id="Layer_3">
        <g>
            <path d="M325.9,165.44l45.81-5.84c8.78,32.24,19.67,67.03,32.65,104.36c12.99,37.34,28.26,77.59,45.81,120.76l2.11,5.56
			C396.12,302.46,353.99,227.51,325.9,165.44z"></path>
        </g>
    </g>
    <g id="Layer_4">
        <g>
            <path d="M459.54,168.68l-2.67-1.8c0.56-2.02,1.4-4.38,2.52-7.08c0.56-1.34,1.08-2.51,1.56-3.51c0.48-1,0.93-1.84,1.35-2.52
			l2.52,0.72l-0.33,3.15l-2.67-0.96c-0.42,0.72-1,2.16-1.74,4.32c-0.34,1.02-0.64,1.98-0.9,2.86c-0.26,0.89-0.48,1.74-0.66,2.54
			c2.34-0.48,4.33-1.29,5.97-2.43C462.83,165.87,461.18,167.44,459.54,168.68z"></path>
            <path d="M465.03,167.84l-1.29-2.4c0.3-0.62,0.64-1.44,1.02-2.45c0.38-1.01,0.75-2.07,1.11-3.18c0.36-1.11,0.69-2.19,0.99-3.24
			c0.3-1.05,0.52-1.92,0.66-2.63l2.04,0.93c-0.5,1.78-1.08,3.56-1.74,5.32c-0.66,1.77-1.42,3.56-2.28,5.36
			c1.08-0.44,2.38-1.4,3.9-2.88C468.4,164.5,466.93,166.22,465.03,167.84z M468.93,152.63l0.18-4.14l2.43,0.21L468.93,152.63z"></path>
            <path d="M472.02,168.14l-0.6-1.17c-0.26,0.22-0.72,0.53-1.38,0.93c-0.38,0.22-0.68,0.39-0.91,0.52c-0.23,0.13-0.39,0.23-0.47,0.29
			l-1.17-1.83c0.46-2.24,1.21-4.54,2.25-6.9c1.14-2.64,2.38-4.71,3.72-6.21c0.78,0.04,1.63,0.28,2.55,0.72
			c0,0.46-0.03,0.96-0.08,1.48c-0.05,0.53-0.13,1.09-0.25,1.67c-0.28-0.16-0.58-0.32-0.9-0.48c-0.32-0.16-0.65-0.32-0.99-0.48
			c-1.02,0.7-2.15,2.17-3.39,4.41c-0.62,1.1-1.09,2.09-1.42,2.97s-0.54,1.66-0.62,2.34c2.4-1.3,4.28-3.93,5.64-7.89l1.62,0.84
			c-0.92,2.76-1.74,4.77-2.46,6.03c1.32-0.38,2.55-1.01,3.69-1.89C475.29,165.57,473.68,167.12,472.02,168.14z"></path>
            <path d="M480.9,151.47c-0.66,1.99-1.37,4.33-2.13,7.01c-0.64,2.24-1.24,4.38-1.79,6.4c-0.55,2.03-1.05,3.98-1.51,5.83
			c0.62-5.44,1.31-10.22,2.08-14.34c0.77-4.12,1.62-7.64,2.54-10.56l2.58,0.63C482.15,147.81,481.56,149.48,480.9,151.47z"></path>
        </g>
    </g>
</svg>
        </a></div>
    </div>
    <div id="slider_menu_hidden_stripe"></div>
    <div id="slider_menu">
        <div class="slider_menu_points">
            <a href="/acc.php?id=<?echo$user_id;?>"><i class="fas fa-home"></i></a>
            <a href="/account/friends.php?id=<?echo$user_id;?>"><i class="fas fa-user-friends"></i></a>
            <a href="/account/messages.php?id=<?echo$user_id;?>"><i class="fas fa-comment-dots"></i></a>
            <a href="/account/photos.php?id=<?echo$user_id;?>"><i class="fas fa-image"></i></a>
            <a href="/account/audios.php?id=<?echo$user_id;?>"><i class="fas fa-music"></i></a>
            <a href="/account/videos.php?id=<?echo$user_id;?>"><i class="fas fa-photo-video"></i></a>
            <?if($support>=1){?><a href="/admin/"><i class="fas fa-users-cog"></i></a><?}?>
        </div>
    </div>
    <div id="optimised">
        <div class="optimised_headerpart">
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
                <p><b class="cook_name">
                    <?
                        //if($_COOKIE['language']=='english'){echo $translatedname;}else{echo$cook_name;}
                        if($_COOKIE['language']=='english'){
                            if(strlen($translatedname)>=6){echo"<span style='font-size:12px;'>".$translatedname."</span>";}
                            else{echo$translatedname;}
                        }
                        else{
                            if(strlen($cook_name)>=6){echo"<span style='font-size:12px;'>".$cook_name."</span>";}
                            else{echo$cook_name;}
                        }
                    ?>
                </b></p>
                <?
                    $zapros1 = mysql_query("SELECT * FROM `avatars` WHERE (u_id = '$user_id' AND `main` = 1)");
                    while($row = mysql_fetch_array($zapros1)) {$get_uavatar_path=$row['path'];}
                ?>
                <img src="<?if($user_id==$bannedid){echo"/img/banned.png";}else{echo"/user/avatars/".$get_uavatar_path;}?>" width="40px" height="40px">
            </div>
            <ul class="settings">
                <a href="/"><li style="border-bottom:1px solid #afafaf;" class="hd_acc_st_pr">Мой профиль</li></a>
                <a href="/account/edit.php?id=<?echo$user_id;?>"><li style="margin-top:3px;" class="hd_acc_st_ed">Редактирование</li></a>
                <a href="/account/settings.php?id=<?echo$user_id;?>"><li class="hd_acc_st_st">Настройки</li></a>
                <a href="/help.php"><li class="hd_acc_st_hp">Помощь</li></a>
                <a href="/account/exit.php"><li style="border-top:1px solid #afafaf; margin-top:3px;" class="hd_acc_st_ex">Выйти</li></a>
            </ul>
        </div><?}else{?>
        <div class="header_enter">
            <div class="photo_user"><p class="photo_user_p">Войти</p> <img src="/img/default_user.png" width="40px" height="40px"></div>
            <ul class="settings">
                <a href="singup.php"><li class="settings_reg">Регистрация</li></a>
                <a href="/"><li class="settings_login">Вход</li></a>
                <a href="rules.php"><li class="settings_rules">Правила пользования</li></a>
            </ul>
        </div>
        <?}?></div>
<div id="show">
    <div class="show_close"></div>
    <div class="show_author" style="text-align:center;padding-top:10px;color:#42aaff;"><?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;echo"'s ";}else{echo $name;echo" ";echo $surname;echo" ";}?><span class="show_author_title"></span></div>
    <div class="show_file">
        <figure class="fig"><img src=""  data-id="" data-type="" data-authorid="<?echo$id;?>" class="show_file_img"></figure>
    </div>
    <div class="file_settings">
        <ul>
            <?
                $res_likesavatar = mysql_query('SELECT COUNT(1) FROM `likes` WHERE `a_id` = '.$id.' AND `file_type`= `avatar`');
                if($res_likesavatar)
                $row_likava = mysql_fetch_array($res_likesavatar, MYSQL_NUM);
                $likes_avatar = !empty($row_likava[0]) ? $row_likava[0] : 0;  
            ?>
            <a class="file_settings_like_a"><li class="file_settings_like"><img src="/img/liked.png" width="50px" height="40px" style="position:absolute;margin-top:-5px;margin-left:-55px;"> <b>Мне нравится</b><span>(<?echo$likes_avatar;?> like)</span></li></a>
            <li><img src="/img/liked.png" width="50px" height="40px" style="position:absolute;margin-top:-5px;margin-left:-55px;"> <b>Поделиться</b></li>
            <li><img src="/img/liked.png" width="50px" height="40px" style="position:absolute;margin-top:-5px;margin-left:-55px;"> <b>Пожаловаться</b></li>
        </ul>
    </div>
    <div class="first_comment">
        <?if(!empty($_COOKIE['account'])){?><p style="text-align:center;" class="first_comment_text">Нажмите <font class="first_comment_button">сюда</font>, чтобы написать комментарий</p><?}?>
        <div class="div_comment">
            <form method="post" action="/settings/post_comment.php?id=<?echo$id;?>&file=1" class="form_comment">
                <img src="<?echo$user_ava;?>" width="50px" height="50px" class="comment_avatar">
                <textarea class="comment_text" placeholder="Напишите комментарий" name="comment_text"></textarea>
                <input type="submit" value="Отправить" class="comment_submit" name="comment_submit">
            </form>
        </div>
    </div>
    <div class="show_maindiv_comments">
    <?
        $result = mysql_query("SELECT * FROM `comments` WHERE `file_type` = 1 AND `commented_id` = '".$id."' ORDER BY date ASC");
        while($row = mysql_fetch_array($result)) {
        $commentator_id=$row['commentator_id'];
        $comment=$row['text'];
        $comment_date=$row['date'];
    ?>
    <div class="show_comments">
        <div class="show_comments_avatar">
            <?
                $check_online = mysql_query("SELECT avatar FROM users WHERE id='$commentator_id'");
                $comm_avatar = mysql_fetch_array($check_online);
            ?>
            <a href="/acc.php?id=<?echo$commentator_id;?>"><img src="<?echo$comm_avatar['avatar'];?>" height="50px" width="50px"></a>
        </div>
        <div class="show_comments_st">
            <div class="show_comments_name">
                <?
                    $check_online = mysql_query("SELECT name FROM users WHERE id='$commentator_id'");
                    $comm_name = mysql_fetch_array($check_online);
                    $check_online = mysql_query("SELECT surname FROM users WHERE id='$commentator_id'");
                    $comm_sname = mysql_fetch_array($check_online);
                ?>
                <a href="/acc.php?id=<?echo$commentator_id?>"><?echo$comm_name['name'];echo" ";echo$comm_sname['surname'];?></a>
            </div>
            <p><?echo$comment;?></p>
            <div class="show_comments_date"><?echo$comment_date;?></div>
        </div>
    </div><?}?>
    </div>
</div>
    <?if($bannedid==$id){?>
    <div id="profile">
    <div class="profile_names">
        <p>
            <?
                if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;echo" ";}
                else{echo $name;echo" ";echo $surname;echo" ";}
                if($of==1){echo"<img src='/img/verif.png' width='20px' height='20px' class'verified' title='Проверенный пользователь'>";}
            ?>
        </p>
    </div>
    <div class="profile_status">
        <p class="profile_user_saysblocked">Пользователь заблокирован</p>
    </div>
    <?if($user_offline==0){?>
    <div class="profile_online">
        <?
        if($online==0){?>
        <p>
            <?
                if($_COOKIE['language']=='english'){
                include("dates.php");
                $transed_date = strtr($llogin, $transdate);
                echo"Was online ".$transed_date;}else{echo"Был в сети ".$llogin;}
            ?>
        </p><?}else{?>
        <p>online</p><?}?>
    </div><?}?>
    <div class="profile_avatar">
        <figure class="fig"><img src="/img/banned.png" class="profile_avatar_img" style="cursor:pointer;"></figure>    
    </div>
    <?
        if(!empty($_COOKIE['account'])){    
        if($id==$user_id){
    ?>
    <div class="profile_edit" style="margin-bottom:10px;">
       
    </div><?}else{?>
        <?$result = mysql_query("SELECT * FROM `followers`");
        while($row = mysql_fetch_array($result)) {
        $s_id=$row['s_id'];
        $su_id=$row['u_id'];
        if($s_id==$user_id and $su_id==$id){
        $friend=1;
    ?>
    <div class="profile_friendsubsed">
        <figure class="fig"><button><span class="invite_text">Заявка отправлена</span></button></figure> 
    </div>
    <?}elseif($su_id==$user_id and $s_id==$id){$friend=4;?>
    <div class="profile_hesubscribed">
        <figure class="fig"><button><?if($_COOKIE['language']=='english'){echo$namevalue;}else{echo$name;}?> <span class="followed_text">подписан(а) на Вас</span></button></figure> 
    </div>
    <?}}$result = mysql_query("SELECT * FROM `friends`");
        while($row = mysql_fetch_array($result)) {
        $f_id=$row['f_id'];
        $fu_id=$row['u_id'];
        if(($f_id==$user_id and $fu_id==$id) or ($fu_id==$user_id and $f_id==$id)){
        $friend=2;
    ?>
    <div class="profile_friendadded">
        <figure class="fig">
            <button class="profile_friendadded_button">У вас в друзьях</button>
            <ul class="profile_friendadded_list">
                <li class="profile_friendadded_list_delete">Удалить из друзей</li>
                <li class="profile_friendadded_list_mutual">Общие друзья</li>
                <li class="profile_friendadded_list_block">Заблокировать</li>
            </ul>    
        </figure> 
    </div>
    <?}}if($friend==0){?><?}}}?>
    <div class="blocked_inf_reason" style="text-align:center;">
        <?
            if($reason==1){echo"<span class='blocked_inf_reason_1'>Страница заблокирована по причине финансовых махинаций на сайте. Разблокировке не подлежит.</span>";}
            elseif($reason==2){echo"<span class='blocked_inf_reason_2'>Страница заблокирована по причине подозрения во взломе. Разблокировка через:</span> ".$time." ";}
            elseif($reason==3){echo"<span class='blocked_inf_reason_3'>Страница заблокирована по причине массового оскорбления пользователей. Разблокировка через:</span> ".$time."";}
            elseif($reason==4){echo"<span class='blocked_inf_reason_4'>Неприемлемый материал на странице. Разблокировке не подлежит.</span>";}
            elseif($reason==5){echo"<span class='blocked_inf_reason_5'>Данный пользователь создал страницу под чужим именем. Разблокировке не подлежит.</span>";}
        ?>
    </div>
    <?if($_COOKIE['account']==$login){?>
    <div class="profile_banned_info" style="text-align:center;">
        <?if($time==0){?>Ваш аккаунт заблокирован навсегда. Впредь будьте осторожны. Ваша почта: <?echo$login;}else{?>
        >Ваш аккаунт заблокирован до <?echo$time;?>. Впредь будьте осторожны. Ваша почта: <?echo$login;}?><br>
        <a href="/account/exit.php"><button class="blocked_button">Выйти</button></a>
    </div>
    </div>
    <?}?>
<?}else{?>
<div id="profile">
    <div class="profile_names">
        <p>
            <?
                if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;echo" ";}
                else{echo $name;echo" ";echo $surname;echo" ";}
                if($of==1){echo"<img src='/img/verif.png' width='20px' height='20px' class'verified' title='Проверенный пользователь'>";}
            ?>
        </p>
    </div>
    <?if($sz!=''){?><div class="profile_status">
        <?if($login==$_COOKIE['account']){?>
            <script type="text/javascript" src="/js/says.js"></script>
            <form action="settings/changesz.php" method="post">
                <input type="text" name="sz_input" class="sz_input" value="<?echo$sz;?>">
            </form>
        <?}?>
        <p class="profile_user_says"><?echo$sz;?></p>
    </div><?if($login==$_COOKIE['account']){?><div class="says_close"><div class="says_close_stripe"></div></div><?}}else if($sz=='' and $login==$_COOKIE['account']){?><div class="profile_status">
        <form action="settings/changesz.php" method="post"><input type="text" name="sz_input" class="sz_input" placeholder="Установить статус"></form>
    </div><?}if($user_offline==0){?>
    <div class="profile_online" style="margin-bottom:10px;">
        <?if($online==0){?>
        <p><?echo"Was online ".$llogin;?></p><?}else{?>
        <p>online</p><?}?>
    </div><?}?>
    <div class="profile_avatar">
        <figure class="fig">
            <?
               $zapros1 = mysql_query("SELECT * FROM `avatars` WHERE (u_id = '$id' AND `main` = 1)");
               while($row = mysql_fetch_array($zapros1)) {
                   $getlog_id=$row['log_id'];
                   $get_avatar_date=$row['date'];
                   $get_avatar_path=$row['path'];
               }
            ?>
            <img src="/user/avatars/<?echo$get_avatar_path;?>" class="profile_avatar_img" style="cursor:pointer;margin-top:10px;">
        </figure>    
    </div>
    <div class="profile_experience">
        <figure class="fig">
            <?
                if($exp=='' or $exp==0){
                    echo '<div id="percent1" style="width: '.$exp.'; max-width:450px;"></div><div class="experience_line" style="background:#3c9dec;"><span class="exp_text_st"><font style="position:relavite;">0</font><font class="e_text"> опыта</font></span></div>';
                }
                elseif($exp<2500){
                    echo '<div id="percent1" style="width: '.$exp.'; max-width:450px;"></div><div class="experience_line" style="background:#3c9dec;"><span class="exp_text_st"><font style="position:relavite;">'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                }
                elseif($exp>=2500 and $exp<25000){
                    echo '<div id="percent" style="width: calc('.$exp.'px/100); max-width:450px;"></div><div class="experience_line" style="background:#ff0000;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                }
                elseif($exp>=25000 and $exp<250000){
                    echo '<div id="percent3" style="width: calc('.$exp.'px/1000); max-width:450px;"></div><div class="experience_line" style="background:#b0b7c6;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                }
                elseif($exp>=250000 and $exp<25000000){
                    echo '<div id="percent2" style="width: calc('.$exp.'px/10000); max-width:450px;"></div><div class="experience_line" style="background:#ffc014;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                }
                elseif($exp>=25000000){
                    echo '<div id="percent_special" style="width: calc('.$exp.'px/10000000); max-width:450px;"></div><div class="experience_line" style="background: #B5EB9A;box-shadow: 1px 1px 20px #4EAA4D;"><span class="exp_text_st"><font>'.$exp.'</font><font class="e_text"> опыта</font></span></div>';
                }
            ?>
        </figure>
    </div>
    <?
        if(!empty($_COOKIE['account'])){    
        if($id==$user_id){
    ?>
    <?if($user_email_status!=1){?><div class="profile_notactivated">
        <figure class="fig"><a href="/settings/activate.php?code=<?echo$acode;?>"><button class="button_activateacc">Подтвердить E-Mail</button></a></figure> 
    </div><?}?>
    <div class="profile_edit">
        <figure class="fig"><a href="/account/edit.php?id=<?echo$id;?>"><button class="button_edit1">Редактировать</button></a></figure>
    </div>
    <?}else{?>
    <div class="profile_sendmes">
        <figure class="fig"><button class="profile_sendmes_button">Отправить сообщение</button></figure>
    </div>
    <div class="profile_sendmes_form">
        <figure class="fig"><form method="post" action="settings/sendmessage.php?id=<?echo$id;?>">
            <textarea placeholder="Напишите сообщение для <?if($_COOKIE['language']=='english'){echo $namevalue;echo" ";echo $surnamevalue;}else{echo $name;echo" ";echo $surname;}?>" name="textmsg"></textarea><br>
            <input type="submit" value="Отправить" class="profile_sendmes_form_submit">
        </form></figure>
    </div>
        <?$result = mysql_query("SELECT * FROM `followers`");
        while($row = mysql_fetch_array($result)) {
        $s_id=$row['s_id'];
        $su_id=$row['u_id'];
        if($s_id==$user_id and $su_id==$id){
        $friend=1;
    ?>
    <div class="profile_friendsubsed">
        <figure class="fig"><button><span class="invite_text">Заявка отправлена</span></button></figure> 
    </div>
    <?}elseif($su_id==$user_id and $s_id==$id){$friend=4;?>
    <div class="profile_hesubscribed">
        <figure class="fig"><button class="profile_hesubscribed_button"><?if($_COOKIE['language']=='english'){echo$namevalue;}else{echo$name;}?> <span class="followed_text">подписан(а) на Вас</span></button></figure>
        <ul class="profile_hesubscribed_list">
            <a href="/account/unsub.php?id=<?echo$id;?>"><li class="user_accept">Принять заявку в друзья</li></a>
            <a href=""><li class="user_mutual">Общие друзья</li></a>
            <a href=""><li class="user_block">Добавить в черный список</li></a>
        </ul>
    </div>
    <?}}$result = mysql_query("SELECT * FROM `friends`");
        while($row = mysql_fetch_array($result)) {
        $f_id=$row['f_id'];
        $fu_id=$row['u_id'];
        if(($f_id==$user_id and $fu_id==$id) or ($fu_id==$user_id and $f_id==$id)){
        $friend=2;
    ?>
    <div class="profile_friendadded">
        <figure class="fig">
            <button class="profile_friendadded_button"><span>У вас в друзьях</span></button>
            <ul class="profile_friendadded_list">
                <a href="/account/delfr.php?id=<?echo$id;?>"><li class="user_delete">Удалить из друзей</li></a>
                <a href=""><li class="user_mutual">Общие друзья</li></a>
                <a href="/settings/block.php?id=<?echo$id;?>"><li class="user_block">Добавить в черный список</li></a>
            </ul>  
        </figure> 
    </div>
    <?}}if($friend==0){?>
     <div class="profile_addfriend">
        <figure class="fig"><a href="/settings/addfriend.php?id=<?echo$id;?>"><button>Добавить в друзья</button></a></figure> 
    </div>   
    <?}}}else{
            if($_COOKIE['language']=='russian'){echo"<div class='notlogined_text'><a href='/'>Войдите</a> или <a href='/singup.php'>зарегистрируйтесь</a>, если вы хотите связаться с ".$name."</div>";}
            else{echo"<div class='notlogined_text'><a href='/'>Sing in</a> or <a href='/singup.php'>sing up</a>, if you want to contact with ".$namevalue."</div>";}
        }?>
    <div class="profile_information">
        <div class="profile_information_button"><div class="profile_information_button_div"></div></div>
        <div class="profile_information_showed">
            <ul>
                <?
                        /*if($_COOKIE['language']=='english'){
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
                        */
                        if($b_month=="January"){$birth_month = "января";$month_number=01;}
                        else if($b_month=="February"){$birth_month = "февраля";$month_number=02;}
                        else if($b_month=="March"){$birth_month = "марта";$month_number=03;}
                        else if($b_month=="April"){$birth_month = "апреля";$month_number=04;}
                        else if($b_month=="May"){$birth_month = "мая";$month_number=05;}
                        else if($b_month=="June"){$birth_month = "июня";$month_number=06;}
                        else if($b_month=="July"){$birth_month = "июля";$month_number=07;}
                        else if($b_month=="August"){$birth_month = "августа";$month_number=08;}
                        else if($b_month=="September"){$birth_month = "сентября";$month_number=09;}
                        else if($b_month=="October"){$birth_month = "октября";$month_number=10;}
                        else if($b_month=="November"){$birth_month = "ноября";$month_number=11;}
                        else if($b_month=="December"){$birth_month = "декабря";$month_number=12;}
                        $today_day=date('d'); $today_month=date('m'); $today_year=date('Y');
                        if($today_month == $month_number){
                            if($today_day >= $b_day){$get_yearsold = $today_year-$b_year;}
                            else{$get_yearsold = $today_year-($b_year+1);}
                        }
                        else if($today_month >> $month_number){$get_yearsold = $today_year-$b_year;}
                        else{$get_yearsold = $today_year-($b_year+1);}

                ?>
                <li><font class="inf_birth">День рождения</font>: <a><?echo $b_day;echo" ";if($_COOKIE['language']=='russian'){echo$birth_month;}else{echo$b_month;}echo", ";echo $b_year;?> (<?echo$get_yearsold.' years old';?>)</a></li>
                <li><font class="inf_city">Город</font>: <a><?if($city==''){echo"Неизвестно";}else{echo$city;}?></a></li>
                <li><font class="inf_site">Веб-сайт</font>: <a href="<?if($site!=''){?>http://<?echo$site;}?>"><?if($site==''){echo"/";}else{echo"http://";echo$site;}?></a></li>
                <li><font class="inf_edu_ttl">Образование</font>: <a class="acc_edu_link" href="<?if($edu!=''){echo'https://google.com/search?q='.$edu.'';}?>"><?if($edu==''){echo"Неизвестно";}else{echo$edu;}?></a></li>
                <li><font class="inf_ab_ttl">О себе</font>: <a><?if($about==''){echo"Пусто";}else{echo$about;}?></a></li>
            </ul>
        </div>
    </div>
</div>
<?
    if($_COOKIE['account']==$login){$res = mysql_query('SELECT COUNT(1) FROM `wall` WHERE `user` = '.$id.'');}
    else{$res = mysql_query('SELECT COUNT(1) FROM `wall` WHERE `user` = '.$id.' and `w_hidden` = 0');}
    if($res)
    $row = mysql_fetch_array($res, MYSQL_NUM);
    $his_posts = !empty($row[0]) ? $row[0] : 0;
    //
    if($_COOKIE['account']==$login){$res = mysql_query('SELECT COUNT(1) FROM `photos` WHERE `u_id` = '.$id.'');}
    else{$res = mysql_query('SELECT COUNT(1) FROM `photos` WHERE `u_id` = '.$id.' AND `hidden` = 0');}
    if($res)
    $row = mysql_fetch_array($res, MYSQL_NUM);
    $hisphotos = !empty($row[0]) ? $row[0] : 0;
    $u_photos = $hisphotos+1;
    //
    $res = mysql_query('SELECT COUNT(1) FROM `friends` WHERE f_id = '.$id.' OR u_id = '.$id.'');
    if($res)
    $row = mysql_fetch_array($res, MYSQL_NUM);
    $hisfriends = !empty($row[0]) ? $row[0] : 0;
    //
    $res = mysql_query('SELECT COUNT(1) FROM `followers` WHERE u_id = '.$id.'');
    if($res)
    $row = mysql_fetch_array($res, MYSQL_NUM);
    $his_followers = !empty($row[0]) ? $row[0] : 0;
?>
<div id="points">
    <ul class="points_list">
        <li class="points_list_wall"><span class="points_list_wall_title">Стена</span> <span class="value wall_vl"><?echo$his_posts;?></span></li>
        <li class="points_list_photos"><span class="points_list_photos_title">Фотографии</span> <span class="value photos_vl"><?echo$u_photos;?></span></li>
        <li class="points_list_friends"><span class="points_list_friends_title">Друзья</span> <span class="value friends_vl"><?echo$hisfriends;?></span></li>
        <li class="points_list_followers"><span class="points_list_followers_title">Подписчики</span> <span class="value followers_vl"><?echo$his_followers;?></span></li>
        <li class="points_list_audios"><span class="points_list_audios_title">Аудио</span> <span class="value audios_vl">6363</span></li>
        <li class="points_list_videos"><span class="points_list_videos_title">Видео</span> <span class="value videos_vl">52</span></li>
    </ul>
</div>
<div id="wall">
    <p class="wall_title">
        <?
            if($_COOKIE['language']=='english'){echo"Wall (".$his_posts." posts)";}
            else{echo"Стена (".$his_posts." записей)";}
        ?>
        <div class="title_close">
            <div class="title_close_stripe"></div>
        </div>
        <?if($support==3){?><div class="wall_title_full">Full</div><?}?>
    </p>
    <div class="wall_show">
        <?
            if($_COOKIE['account']==$login or $support>=2){$result = mysql_query("SELECT * FROM `wall` WHERE `user` = '".$id."' ORDER BY id DESC");}
            else{$result = mysql_query("SELECT * FROM `wall` WHERE `user` = '".$id."' AND `w_hidden` = 0 ORDER BY id DESC");}
            if(mysql_num_rows($result)==0){echo"Нет записей";}
            while($row = mysql_fetch_array($result)) {
                $w_id=$row['id'];
                $w_text=$row['text'];
                $w_date=$row['w_date'];
        ?>
        <div class="wall_show_avatar">
            <img src="<?echo$avatar;?>" height="50px" width="50px" style="border-radius:25px;">
        </div>
        <div class="wall_show_other" style="<?if(!$_COOKIE['account']){echo"margin-bottom:20px;";}?>">
            <?if($id==$user_id){?><div class="wall_show_edit"><i class="fal fa-edit"></i></div><?}?>
            <div class="wall_show_user"><a href="/acc.php?id=<?echo$id;?>"><?echo$name;echo" ";echo$surname;?></a></div>
            <div class="wall_show_date"><?echo$w_date;?></div>
            <div class="wall_show_text"><?echo$w_text;?></div>
            <div class="wall_show_edit_box">
                <form method="post">
                    <textarea name="text" style="width:300px; height:100px;" class="edit_wall_text"><?echo$w_text;?></textarea>
                    <input type="text" name="id" value="<?echo$w_id;?>" style="width:0; height:0;" class="edit_wall_wid">
                    <input class="wall_show_edit_submit" value="OK" type="submit">
                </form>
            </div>
        </div>
        <?if($_COOKIE['account']){?><ul class="wall_buttons">
                <?
                    $res_likeswall = mysql_query("SELECT COUNT(1) FROM `likes` WHERE `a_id` =  '".$id."' AND `file_type`= `wall`" );
                    if($res_likeswall)
                    $rowlik = mysql_fetch_array($res_likeswall, MYSQL_NUM);
                    $likes_wall = !empty($rowlik[0]) ? $rowlik[0] : 0;  
                ?>
                <li class="w_b_like"><div class="w_b_like_img"></div><p>Мне нравится (<?echo$likes_wall;?> likes)</p></li>
                <li class="w_b_comment"><div class="w_b_comment_img"></div><p>Комментировать</p></li>
                <li class="w_b_repost"><div class="w_b_repost_img"></div></li>
        </ul><?}?>
        <?}?>
    </div>
    <?if($_COOKIE['account']==$login){?><div class="wall_write">
        <div class="profile_wall_write" style="margin-left:140px;margin-top:10px;">
            <a href="/acc.php?id=<?echo$user_id;?>"><img src="<?echo$avatar;?>" height="28px" width="28px" style="border-radius:14px;"></a>
            <form method="post" action="settings/writing.php?id=<?echo$user_id;?>">
                <textarea name="post_name" class="profile_wall_write_input" onfocus="this.style='border-bottom:1px solid #42aaff;'" onblur="this.style='border-bottom:1px solid #d1d1d1;'" placeholder="Есть ли что-то интересное?"></textarea>
                <!--<input type="file" class="input_file file_img" name="profile_wall_img" accept=".png,.ico,.jpg,.jpeg,.bmp,.gif">
                <input type="file" class="input_file file_video" name="profile_wall_video" style="margin-left:-10px;margin-top:10px;position:absolute;" accept=".mp4,.avi,.mov,.wmv">
                <input type="file" class="input_file file_audio" name="profile_wall_audio" style="margin-left:18px;margin-top:9px;position:absolute;" accept=".mp3,.ogg,.wav,.3gp">!-->
                <br><input type="submit" class="msg_button" value="Написать" style="margin-top:10px;">
            </form>
        </div>
    </div><?}?>
</div>
<div id="photos">
    <p class="photos_title">
        <a href="/account/photos.php?id=<?echo$id;?>" style="color:#fff;"><?
            if($_COOKIE['language']=='english'){echo"Photos (".$u_photos.")";}
            else{echo"Фотографии (".$u_photos.")";}
        ?></a>
        <div class="title_close">
            <div class="title_close_stripe"></div>
        </div>
    </p>
    <div class="photos_show">
        <?
            if($_COOKIE['account']==$login or $support>=2){$result = mysql_query("SELECT * FROM `photos` WHERE `u_id` = '".$id."' ORDER BY id DESC LIMIT 8");}
            else{$result = mysql_query("SELECT * FROM `photos` WHERE `u_id` = '".$id."' AND `hidden` = 0 ORDER BY id DESC LIMIT 8");}
            if(mysql_num_rows($result)==0){if($id==$user_id){echo"<span style='padding-left:8px;'>Добавить фото</span>";}}
            while($row = mysql_fetch_array($result)) {
                $ph_id=$row['id'];
                $ph_name=$row['p_name'];
                $ph_date=$row['p_date'];
        ?>
        <img src="/user/photos/<?echo$ph_name;?>" width="90px" height="90px" class="photos_show_img" data-photoid="<?echo$ph_id;?>">
        <?}?>
    </div>
</div>
<div id="friends">
    <p class="friends_title">
        <a href="/account/friends.php?id=<?echo$id;?>" style="color:#fff;"><?  
            if($_COOKIE['language']=='english'){echo"Friends (".$hisfriends.")";}
            else{echo"Друзья (".$hisfriends.")";}
        ?></a>
        <div class="title_close">
            <div class="title_close_stripe"></div>
        </div>
    </p>
    <?
        $result = mysql_query("SELECT * FROM `friends` WHERE (`f_id` = '".$id."' OR `u_id` = '".$id."') ORDER BY `raiting` DESC LIMIT 7");
        if(mysql_num_rows($result)==0){if($id==$user_id){echo"<span style='padding-left:8px;'>Друзей не найдено</span>";}}
        while($row = mysql_fetch_array($result)) {
            $to_who=$row['f_id'];
            $from_who=$row['u_id'];
    ?>
    <div class="friends_show">
        <div class="friends_show_names">
            <?
                if($to_who!=$id){
                $check_name = mysql_query("SELECT name FROM users WHERE id='$to_who'");
	            $name = mysql_fetch_array($check_name);}
                else{
                $check_name = mysql_query("SELECT name FROM users WHERE id='$from_who'");
	            $name = mysql_fetch_array($check_name);}
                    
                
                //фамилия
                if($to_who!=$id){
                $check_name = mysql_query("SELECT surname FROM users WHERE id='$to_who'");
	               $sname = mysql_fetch_array($check_name);}
                else{
                $check_name = mysql_query("SELECT surname FROM users WHERE id='$from_who'");
	               $sname = mysql_fetch_array($check_name);}
                //
                if($_COOKIE['language']=='english'){
                include("translater.php");
                $fr_namevalue = strtr($name['name'], $trans);
                $fr_surnamevalue = strtr($sname['surname'], $trans);}
                //offical
                if($to_who!=$id){$check_of = mysql_query("SELECT offical FROM users WHERE id='$to_who'");
	                   $offical = mysql_fetch_array($check_of);}
                else{$check_of = mysql_query("SELECT offical FROM users WHERE id='$from_who'");
	                    $offical = mysql_fetch_array($check_of);
                    }
                ?>
        <a href="/acc.php?id=<?if($to_who!=$id){echo$to_who;}else{echo$from_who;}?>" title="<?if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
            else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}?>"><?
            if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
            else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}
            //if($offical['offical']==1){echo"<img src='/img/verif.png' width='18px' height='18px' class'verified' title='Проверенный пользователь' style='margin-left:5px;'>";}
        ?></a>
        </div>
        <div class="friends_show_photo">
            <?
                if($to_who!=$id){$check_online = mysql_query("SELECT avatar FROM users WHERE id='$to_who'");
	               $avatar = mysql_fetch_array($check_online);}
                else{
                    $check_online = mysql_query("SELECT avatar FROM users WHERE id='$from_who'");
	                $avatar = mysql_fetch_array($check_online);
                }
            ?>
            <a href="/acc.php?id=<?if($to_who!=$id){echo$to_who;}else{echo$from_who;}?>"><img src="<?echo$avatar['avatar'];?>" width="100px" height="100px" class="friends_show_photo_img"></a>
        </div>
    </div><?}?>
</div>
<div id="followers">
    <p class="followers_title">
        <a href="/account/friends.php?id=<?echo$id;?>&section=followers" style="color:#fff;"><?  
            if($_COOKIE['language']=='english'){echo"Followers (".$his_followers.")";}
            else{echo"Подписчики (".$his_followers.")";}
        ?></a>
        <div class="title_close">
            <div class="title_close_stripe"></div>
        </div>
    </p>
    <?
        $result = mysql_query("SELECT * FROM followers WHERE u_id = '".$id."'");  
        while($row = mysql_fetch_array($result)) {
        $followers_sid=$row['s_id'];
        $followers_uid=$row['u_id'];
    ?>
    <div class="followers_show">
        <div class="followers_show_names">
            <?
                //имя
                $check_name = mysql_query("SELECT name FROM users WHERE id='$followers_sid'");
	            $name = mysql_fetch_array($check_name);
                    
                //фамилия
                $check_name = mysql_query("SELECT surname FROM users WHERE id='$followers_sid'");
	           $sname = mysql_fetch_array($check_name);
                //
                if($_COOKIE['language']=='english'){
                include("translater.php");
                $fr_namevalue = strtr($name['name'], $trans);
                $fr_surnamevalue = strtr($sname['surname'], $trans);}
                //offical
                $check_of = mysql_query("SELECT offical FROM users WHERE id='$followers_sid'");
	            $offical = mysql_fetch_array($check_of);
    
                ?>
        <a href="/acc.php?id=<?echo$followers_sid;?>" title="<?if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
            else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}?>"><?
            if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
            else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}
            //if($offical['offical']==1){echo"<img src='/img/verif.png' width='18px' height='18px' class'verified' title='Проверенный пользователь' style='margin-left:5px;'>";}
        ?></a>
        </div>
        <div class="followers_show_photo">
            <?
                    $check_online = mysql_query("SELECT avatar FROM users WHERE id='$followers_sid'");
	                $avatar = mysql_fetch_array($check_online);
            ?>
            <a href="/acc.php?id=<?echo$followers_sid;?>"><img src="<?echo$avatar['avatar'];?>" width="100px" height="100px" class="friends_show_photo_img"></a>
        </div>
    </div><?}?>
</div>
</div>
<?}}}?>
</body>
<script type="text/javascript">
    $(function(){
        $('.avatar_post_comment_textarea').autoResize();
    });
</script>
<?if($_COOKIE['language']=="english"){?><script src="/js/eng_translater.js"></script><?}
elseif($_COOKIE['language']=="japanese"){?><script src="/js/jp_translater.js"></script><?}?>
<script type="text/javascript">
    $('.wall_show_edit_box').hide();
    $('.wall_show_edit i').click(function(){
        $('.wall_show_edit_box').show();
        $('.wall_show_text').hide();
    });
    $('.wall_show_edit_submit').bind("click",function(){
        $.ajax({
            url: "/settings/edit_wall.php",
            type:"POST",
              data:({text: $(".edit_wall_box").val(), id: $(".edit_wall_wid").val()}),
              dataType: "html",
              success: function (data) {
                if(data=='error1'){
                    $('.wall_show_text').html("error");
                }
                else{
                $('.wall_show_text').html($('.edit_wall_text').val());
                $(".edit_wall_box").hide();}
            }
        }); 
    });
</script>