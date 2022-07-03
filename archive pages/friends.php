<?
    include_once("bd.php");
    $id=$_GET['id'];
    $section = $_GET['section'];
    $act = $_GET['act'];
    include_once("vars.php");
?>
<head>
    <?
      $result = mysql_query("SELECT * FROM `users` WHERE `id` = '".$id."'");
        while($row = mysql_fetch_array($result)) {
        $name=$row['name'];
        $surname=$row['surname'];}  
        
        $res = mysql_query('SELECT COUNT(1) FROM `friends` WHERE f_id = '.$id.' OR u_id = '.$id.'');
        if($res)
        $row = mysql_fetch_array($res, MYSQL_NUM);
        $kolvo_userov = !empty($row[0]) ? $row[0] : 0;
        //check online friends
         
        //check followers
        $res = mysql_query('SELECT COUNT(1) FROM `followers` WHERE u_id = '.$id.'');
        if($res)
        $row = mysql_fetch_array($res, MYSQL_NUM);
        $followers = !empty($row[0]) ? $row[0] : 0;

        if($_COOKIE['language']=='english'){
            include("translater.php");
            $namevalue = strtr($name, $trans);
            $surnamevalue = strtr($surname, $trans);}
    ?>
    <title>
        <?
            if($section!='followers' and $act!='find'){
                if($_COOKIE['language']=='russian'){echo"Друзья ".$name." ".$surname." (".$kolvo_userov.")";}
                else{echo"Friends of ".$namevalue." ".$surnamevalue." (".$kolvo_userov.")";}
            }
            elseif($section=='followers'){
                if($_COOKIE['language']=='russian'){echo"Подписчики ".$name." ".$surname." (".$followers.")";}
                else{echo"Followers of ".$namevalue." ".$surnamevalue." (".$followers.")";} 
            }
            elseif($act=='find'){
                if($_COOKIE['language']=='russian'){echo"Поиск друзей";}
                else{echo"Friends search";}
            }
        ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/account.css">
    <link rel="stylesheet" type="text/css" href="/css/newfriends.css">
    <link rel="stylesheet" type="text/css" href="/css/optimization/account.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/acc_menu.js"></script>
    <script type="text/javascript" src="/js/menu.js"></script>
    <script type="text/javascript" src="/js/slider_menu.js"></script>
    <script type="text/javascript" src="/js/exp.js"></script>
    <script type="text/javascript" src="/js/amenu.js"></script>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <script src="https://kit.fontawesome.com/db1017c910.js" crossorigin="anonymous"></script>
    <link rel="ICON" href="/img/1.png" type="image/gif">
</head>
<?
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {
        $support=$row['support'];
        $user_id=$row['id'];$ULANG=$row['site_lang'];
    }?>
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
<?}
    if($id==0){echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";}
        if($section=='' and $act==''){$section='all';}
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
                <img src="<?if($user_id==$bannedid){echo"/img/banned.png";}else{echo$cook_ava;}?>" width="40px" height="40px">
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
<div id="friends_menu">
    <ul>
        <a href="/account/friends.php?id=<?echo$id;?>&section=all"><li style="<?if($section=='all' or ($section=='' and $act=='')){echo"border-bottom:2px solid #008cff;";}?>"><span class="span_allfr">Все друзья</span> (<?echo$kolvo_userov;?>)</li></a>
        <a href="/account/friends.php?id=<?echo$id;?>&section=online"><li style="<?if($section=='online'){echo"border-bottom:2px solid #008cff;";}?>"><span class="span_onlfr">Друзья онлайн</span> (0)</li></a>
        <a href="/account/friends.php?id=<?echo$id;?>&section=followers"><li style="<?if($section=='followers'){echo"border-bottom:2px solid #008cff;";}?>"><span class="span_folls">Подписчики</span>  (<?echo$followers;?>)</li></a>
        <a href="/account/friends.php?id=<?echo$id;?>&act=find"><li style="<?if($act=='find'){echo"border-bottom:2px solid #008cff;";}?>"><span class="span_findfr">Поиск друзей</span></li></a>
    </ul>
    <a href="/acc.php?id=<?echo$id;?>" style="color:#fff;"><div class="friends_menu_back">
        <div class="friends_menu_back_img"><span>Назад</span></div>
    </div></a>
</div>
<div id="friend_show">
    <?
    if($section=='all' or ($section=='' and $act=='')){  
    $result = mysql_query("SELECT * FROM `friends` WHERE (`f_id` = '".$id."' OR `u_id` = '".$id."') ORDER BY raiting DESC");                 
    while($row = mysql_fetch_array($result)) {
    $to_who=$row['f_id'];
    $from_who=$row['u_id'];
    if($to_who!='' or $from_who!=''){
?>
<div class="friend_show_points">
    <div class="friend_show_avatar">
        <?
            if($to_who!=$id){$check_online = mysql_query("SELECT avatar FROM users WHERE id='$to_who'");
	           $avatar = mysql_fetch_array($check_online);}
            else{$check_online = mysql_query("SELECT avatar FROM users WHERE id='$from_who'");
	           $avatar = mysql_fetch_array($check_online);
            }
        ?>
        <a href="/acc.php?id=<?if($to_who!=$id){echo$to_who;}else{echo$from_who;}?>"><img src="<?echo$avatar['avatar'];?>" height="60px" width="60px" style="border-radius:30px;,margin-left:10px;"></a>
    </div>
    <div class="friend_show_names">
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
        <p><a href="/acc.php?id=<?if($to_who!=$id){echo$to_who;}else{echo$from_who;}?>" style="color:#fff;"><?
                    if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
                    else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}
                    if($offical['offical']==1){echo"<img src='/img/verif.png' width='18px' height='18px' class'verified' title='Проверенный пользователь' style='margin-left:5px;'>";}
        ?></a></p>
    </div>
    <div class="friend_show_edu">
        <p>
            <? 
                if($to_who!=$id){
                $check_name = mysql_query("SELECT education FROM users WHERE id='$to_who'");
                $edu = mysql_fetch_array($check_name);}
                else{
                $check_name = mysql_query("SELECT education FROM users WHERE id='$from_who'");
                $edu = mysql_fetch_array($check_name);}
            ?>
            <a title="<?if($edu['education']!=''){echo$edu['education'];}else{echo"<span class='span_unknown_edu'>Неизвестно</span>";}?>" href="<?if($edu['education']!=''){echo'https://google.com/search?q='.$edu['education'].'';}?>"><?if($edu['education']!=''){echo$edu['education'];}else{echo"<span class='span_unknown_edu'>Неизвестно</span>";}?></a>
        </p>
    </div>
    <?
        if($to_who!=$id){
        $fr_check_oflfcts = mysql_query("SELECT offline FROM users WHERE id='$to_who'");
	    $fr_oflfcts = mysql_fetch_array($fr_check_oflfcts);}
        else{
        $fr_check_oflfcts = mysql_query("SELECT offline FROM users WHERE id='$from_who'");
	    $fr_oflfcts = mysql_fetch_array($fr_check_oflfcts);}
        if($fr_oflfcts['offline']==0){
    ?>
    <div class="friend_show_status">
        <p>
            <? 
                if($to_who!=$id){
                $check_online = mysql_query("SELECT online FROM users WHERE id='$to_who'");
                $friend_show_online = mysql_fetch_array($check_online);}
                else{
                $check_online = mysql_query("SELECT online FROM users WHERE id='$from_who'");
                $friend_show_online = mysql_fetch_array($check_online);}
                if($friend_show_online['online']!='1'){
                    if($to_who!=$id){
                    $check_lastonline = mysql_query("SELECT last_login FROM users WHERE id='$to_who'");
                    $friend_show_lastonline = mysql_fetch_array($check_lastonline);}
                    else{
                    $check_lastonline = mysql_query("SELECT last_login FROM users WHERE id='$from_who'");
                    $friend_show_lastonline = mysql_fetch_array($check_lastonline);}
                }
            ?>
            <a><?if($friend_show_online['online']!='1'){echo"был ";echo$friend_show_lastonline['last_login'];}else{echo"online";}?></a>
        </p>
    </div><?}?>
    <div class="friend_show_group">
        <p>
            <? 

                $check_sc = mysql_query("SELECT section FROM friends WHERE (u_id='$to_who' AND f_id='$from_who') OR 
                (u_id='$from_who' AND f_id='$to_who')");
                $sect = mysql_fetch_array($check_sc);
            ?>
            <a>
                <?
                    if($sect['section']==1){echo"<div><span>Лучшие друзья</span></div>";}
                    elseif($sect['section']==2){echo"<div><span>Семья</span></div>";}
                    elseif($sect['section']==3){echo"<div><span>Коллеги</span></div>";}
                    elseif($sect['section']==4){echo"<div><span>ВУЗ</span></div>";}
                    elseif($sect['section']==5){echo"<div><span>Школьные друзья</span></div>";}
                ?>
            </a>
        </p>
    </div>
    <?if($id==$user_id){?><a href="/account/delfr.php?id=<?if($to_who!=$id){echo$to_who;}else{echo$from_who;}?>"><div class="friend_show_delete"><div class="friend_show_delete_button"></div></div></a><?}?>
    </div>
    <?}}}
            elseif($section=='followers'){
            $result = mysql_query("SELECT * FROM `followers` WHERE `u_id` = '".$id."' ORDER BY date DESC");                    
            while($row = mysql_fetch_array($result)) {
            $su_id=$row['u_id'];
            $s_id=$row['s_id'];
            if($s_id!=''){?>
    <div class="friend_show_points">
    <div class="friend_show_avatar">
        <?
             $sub_check_online = mysql_query("SELECT avatar FROM users WHERE id='$s_id'");
	         $sub_avatar = mysql_fetch_array($sub_check_online);       
        ?>
        <a href="/acc.php?id=<?echo$s_id;?>"><img src="<?echo$sub_avatar['avatar'];?>" height="60px" width="60px" style="border-radius:30px;,margin-left:10px;"></a>
    </div>
    <div class="friend_show_names">
        <?
                    $sub_check_name = mysql_query("SELECT name FROM users WHERE id='$s_id'");
	                $sub_name = mysql_fetch_array($sub_check_name);
                    
                
                //фамилия
                    $sub_check_name = mysql_query("SELECT surname FROM users WHERE id='$s_id'");
	                $sub_sname = mysql_fetch_array($sub_check_name);

                //translater
                    if($_COOKIE['language']=='english'){
                    include("translater.php");
                    $sub_namevalue = strtr($sub_name['name'], $trans);
                    $sub_surnamevalue = strtr($sub_sname['surname'], $trans);}
                
                //offical
                    $sub_check_of = mysql_query("SELECT offical FROM users WHERE id='$s_id'");
	                $sub_offical = mysql_fetch_array($sub_check_of);
                ?>
            <p><a href="/acc.php?id=<?echo$s_id;?>" style="color:#fff;"><?if($_COOKIE['language']=='english'){echo$sub_namevalue;echo' '; echo$sub_surnamevalue;}else{echo$sub_name['name'];echo' '; echo$sub_sname['surname'];}if($sub_offical['offical']==1){echo"<img src='/img/verif.png' width='18px' height='18px' class'verified' title='Проверенный пользователь' style='margin-left:5px;'>";}?></a></p>
    </div>
    <?
        $sub_check_oflfcts = mysql_query("SELECT offline FROM users WHERE id='$s_id'");
	    $sub_oflfcts = mysql_fetch_array($sub_check_oflfcts);
        if($sub_oflfcts['offline']==0){
    ?>
    <div class="friend_show_status">
        <p>
            <? 
                $check_online = mysql_query("SELECT online FROM users WHERE id='$s_id'");
                $followers_show_online = mysql_fetch_array($check_online);
                if($followers_show_online['online']!='1'){
                    $check_flwlastonline = mysql_query("SELECT last_login FROM users WHERE id='$s_id'");
                    $followers_show_lastonline = mysql_fetch_array($check_flwlastonline);
                }
            ?>
            <a><?if($followers_show_online['online']!='1'){echo"был ";echo$followers_show_lastonline['last_login'];}else{echo"online";}?></a>
        </p>
    </div>
    <?}if($id==$user_id){?><a href="/account/unsub.php?id=<?echo$s_id;?>"><div class="follower_show_add"><div class="follower_show_add_button"></div></div></a><?}?>
    </div>
    <?}}}elseif($act=='find'){echo'';}?>
</div>
</body>
<?if($_COOKIE['language']=="english"){?><script src="/js/eng_translater.js"></script><?}
elseif($_COOKIE['language']=="japanese"){?><script src="/js/jp_translater.js"></script><?}?>