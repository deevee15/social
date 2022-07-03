<?
    include_once("bd.php");$id=$_GET['id'];include_once("vars.php");$page=$_GET['pg'];
?>
<html>
<head>
<title>Редактировать</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/account.css">
    <link rel="stylesheet" type="text/css" href="/css/edit.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/js/acc_menu.js"></script>
    <script type="text/javascript" src="/js/amenu.js"></script>
    <script type="text/javascript" src="/js/avatar.js"></script>
    <link rel="ICON" href="/img/1.png" type="image/gif">
</head>
    <?
        $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
        while($row = mysql_fetch_array($result)) {
            $support=$row['support'];$ULANG=$row['site_lang'];
            $user_id=$row['id'];
        }
        $res = mysql_query('SELECT COUNT(1) FROM `followers` WHERE u_id = '.$id.'');
        if($res)
        $row = mysql_fetch_array($res, MYSQL_NUM);
        $subs = !empty($row[0]) ? $row[0] : 0;  
    ?>
<?if($adm_lvl==3){echo"<body style='background:url(".$bg.") no-repeat #82c4fb;'>";}else{echo"<body style='background:#82c4fb;'>";}?>
<?
        $result = mysql_query("SELECT * FROM `banned` WHERE `id` = '".$id."'");
        while($row = mysql_fetch_array($result)) {
            $reason=$row['reason'];
            $bannedid=$row['id'];
            $time=$row['time'];
        }
if($bannedid==$id){echo"<meta http-equiv='Refresh' content='0; URL=/index.php'>";}?>
<?if($_COOKIE['account']==$login){?>
    <div id="header">
        <div class="slider_menu_icon"><div class="sm_icon"></div></div>
        <div class="header_lg"><a href="/" id="header_lg_a"><div class="header_lg_img"></div></a></div>
        <?if($_COOKIE['account']){?><a href="/account/messages.php"><div class="header_nmsg"><div class="header_nmsg_icon"><font class="nmsg_number">+1</font></div></div></a>
        <a href="/account/friends.php?id=<?echo$user_id;?>"><div class="header_nfrd"><div class="header_nfrd_icon"><?if($subs!=0){?><font class="nfrd_number">+<?echo$subs;?></font><?}?></div></div></a><?}?>
        <form id="header_search" method="post" action="search.php">
            <?if($_COOKIE['language']=="english"){?><input type="text" name="search_input" class="input_search" placeholder="Search" onfocus="if(this.placeholder=='Search') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Search';}" autocomplete="off"><?}else{?>
            <input type="text" name="search_input" class="input_search" placeholder="Поиск" onfocus="if(this.placeholder=='Поиск') {this.placeholder='';}" onblur="if(this.value=='') {this.placeholder='Поиск';}" autocomplete="off"><?}?>
        </form>
        <div class="header_account">
            <?
               $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
            while($row = mysql_fetch_array($result)) {$cook_name=$row['name'];$cook_ava=$row['avatar'];}
            ?>
            <div class="photo_user"><p style="font-size:15px;"><b><?echo $cook_name;?></b></p><img src="<?echo $cook_ava;?>" width="40px" height="40px"></div>
            <ul class="settings">
                <a href="/"><li style="border-bottom:1px solid #afafaf;">Мой профиль</li></a>
                <a href="/account/edit.php?id=<?echo$id;?>"><li style="margin-top:3px;">Редактирование</li></a>
                <a href="/account/settings.php?id=<?echo$id;?>&st=1"><li>Настройки</li></a>
                <a href="/help.php"><li>Помощь</li></a>
                <a href="/account/exit.php"><li style="border-top:1px solid #afafaf; margin-top:3px;">Выйти</li></a>
            </ul>
        </div>
    </div>
    <div id="slider_menu">
        <div class="slider_menu_points">
            <a href="/acc.php?id=<?echo$user_id;?>"><div class="point_profile"><img src="/img/menu/profile.png" width="25px" height="20px" style="margin-left:2px;"></div></a>
            <a href="/account/friends.php?id=<?echo$user_id;?>"><div class="point_friends"><img src="/img/menu/friends.png" width="30px" height="30px"></div></a>
            <a href=""><div class="point_messages"><img src="/img/menu/messages.png" width="25px" height="25px" style="margin-left:2px;"></div></a>
            <a href="/account/photos.php?id=<?echo$user_id;?>"><div class="point_photos"><img src="/img/menu/photos.png" width="30px" height="30px"></div></a>
            <a href="/account/audios.php?id=<?echo$user_id;?>"><div class="point_audios"><img src="/img/menu/audios.png" width="25px" height="25px"></div></a>
            <a href="/account/videos.php?id=<?echo$user_id;?>"><div class="point_videos"><img src="/img/menu/videos.png" width="30px" height="25px"></div></a>
        </div>
    </div>
    <div id="select_type">
        <ul>
            <?
            if($page==0 or $page==1){
                echo'<a href="/account/edit.php?id='.$id.'&pg=1"><li style="border-left:2px solid #42aaff;">Основные</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=3"><li>Образование</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=4"><li>Дополнительно</li></a>';
                if($support>=1){echo'<a href="/account/edit.php?id='.$id.'&pg=5"><li style="font-size:15px;color:#ff0000;">Экспериментальные ф-ции</li></a>';}
            }
            elseif($page==2){
                echo'<a href="/account/edit.php?id='.$id.'&pg=1"><li>Основные</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=2"><li style="border-left:2px solid #42aaff;">Аватар</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=3"><li>Образование</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=4"><li>Дополнительно</li></a>';
                if($support>=1){echo'<a href="/account/edit.php?id='.$id.'&pg=5"><li style="font-size:15px;color:#ff0000;">Экспериментальные ф-ции</li></a>';}
            }
            elseif($page==3){
                echo'<a href="/account/edit.php?id='.$id.'&pg=1"><li>Основные</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=3"><li style="border-left:2px solid #42aaff;">Образование</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=4"><li>Дополнительно</li></a>';
                if($support>=1){echo'<a href="/account/edit.php?id='.$id.'&pg=5"><li style="font-size:15px;color:#ff0000;">Экспериментальные ф-ции</li></a>';}
            }
            elseif($page==4){
                echo'<a href="/account/edit.php?id='.$id.'&pg=1"><li>Основные</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=3"><li>Образование</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=4"><li style="border-left:2px solid #42aaff;">Дополнительно</li></a>';
                if($support>=1){echo'<a href="/account/edit.php?id='.$id.'&pg=5"><li style="font-size:15px;color:#ff0000;">Экспериментальные ф-ции</li></a>';}
            }
            elseif($page==5){
                echo'<a href="/account/edit.php?id='.$id.'&pg=1"><li>Основные</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=3"><li>Образование</li></a>
                <a href="/account/edit.php?id='.$id.'&pg=4"><li>Дополнительно</li></a>';
                if($support>=1){echo'<a href="/account/edit.php?id='.$id.'&pg=5"><li style="font-size:15px;color:#ff0000;border-left:2px solid #42aaff;">Экспериментальные ф-ции</li></a>';}
            }
            ?>
        </ul>
    </div>
    <div id="edit">
        <div class="edit_list">
            <?if($page==1 or $page==0){?>
            <form name="edit_form" method="post" action="accept_edit.php">
                <div class="edit_title">Основная информация</div>
                Имя: <input type="text" value="<?echo$name;?>" name="e_name" class="e_name"><br>
                Фамилия: <input type="text" value="<?echo$surname;?>" name="e_sname"><br>
                Пол: <?if($gender='Мужской'){?><select name="gender">
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
				</select><br><?}else{?><select name="gender">
                    <option value="female">Женский</option>
                    <option value="male">Мужской</option>
				</select><br><?}?>
                <div class="e_birth"><font style="position:relative;margin-left:-131px;">Дата: </font>
                <input type="text" class="ageDay" value="<?echo$b_day;?>">
                <select name="ageMonth" class="ageMonth">
                    <option value="month"><?echo$b_month;?></option>
                    <option value="January">Январь</option>
                    <option value="February">Февраль</option>
                    <option value="March">Март</option>
                    <option value="April">Апрель</option>
                    <option value="May">Май</option>
                    <option value="June">Июнь</option>
                    <option value="July">Июль</option>
                    <option value="August">Август</option>
                    <option value="September">Сентябрь</option>
                    <option value="October">Октябрь</option>
                    <option value="November">Ноябрь</option>
                    <option value="December">Декабрь</option>
				</select>
                <input type="text" class="ageYear" value="<?echo$b_year;?>"></div><br>
                <font>Город:</font> <input type="text" value="<?echo$city;?>" name="e_city" style="margin-top:-35px;"><br>
                <input type="submit" value="Сохранить" name="e_save">
            </form><?}elseif($page==2){?>
            <form action="/avatars/upload.php?id=<?echo$id;?>" method="post" enctype="multipart/form-data" name="edit_form">
                <div class="edit_title">Загрузка главного фото</div>
                <p style="font-size:12px;">Размер файла может быть не больше 2МБ.Разрешенные расширения файлов:<br>
                PNG,JPG,JPEG</p>
                <input type="file" name="uploadfile" accept=".png,.gif,.jpg,.jpeg">
                <input type="submit" value="Выбрать файл" name="submit_file">
            </form><?}elseif($page==3){?>
            <form name="edit_form" method="post" action="edit_edu.php">
                <div class="edit_title">Образование</div>
                    Город: <input type="text" value="<?echo$edu_city;?>" name="e_educ" class="e_educ"><br>
                    Уч.завед: <input type="text" value="<?echo$edu;?>" name="e_edu"><br>
                    <input type="submit" value="Сохранить" name="e_save" style="margin-left:86px;">
            </form>
            <?}elseif($page==4){?>
            <form name="edit_form" method="post" action="edit_dop.php">
                <div class="edit_title">Дополнительно</div>
                    О себе: <input type="text" value="<?echo$about;?>" name="e_about"><br>
                    <input type="submit" value="Сохранить" name="e_save" style="margin-left:68px;">
            </form>
            <?}elseif($page==5){if($support!=0){?>
            <form name="edit_form" method="post" action="/settings/setfcts.php?id=<?echo$id;?>">
                <div class="edit_title">Экспериментальные функции</div>
                    <input type="checkbox" name="experimental" value="yes" class="checkbox_experim" <?if($e_functions==1){echo"checked";}?> ><font style="margin-left:5px;position:relative;">Хотите ли вы включить экспериментальные ф-ции? </font>
                    <input type="submit" value="OK" name="e_save" style="margin-left:60px;">
            </form>
            <?
                if($e_functions==1){
                    if($support>=3){
            ?>
            <div class="edit_u_bg">
                <p>Сменить заставку профиля:</p>
                <form action="/user/photos/backgrounds/b_upload.php?id=<?echo$id;?>" method="post" enctype="multipart/form-data">
                    <script src="/js/custom-file-input.js"></script>
                    <input type="file" name="uploadfile" accept=".png,.gif,.jpg,.jpeg" class="outtaHere inputfile" id="upload" data-multiple-caption="{count} files selected" multiple>
                    <label for="upload"><span>Выбрать bg</span></label>
                    <input type="submit" value="OK" style="position:absolute; margin-left:170px;margin-top:8px;height:25px; color:#fff; background:#42aaff;border:1px solid #42aaff;cursor:pointer; width:200px;">
            </form>
            </div><?}?>
            <div class="edit_invisble">
                <p>Сделать невидимым:</p>
                <form action="/setting/edit_efcts.php?id=<?echo$id;?>" method="post" enctype="multipart/form-data">
                    <input type="checkbox" name="experimental" value="yes" class="checkbox_experim"><font style="margin-left:5px;position:relative;margin-top:-2px;">Невидимый</font><br>
                    <input type="submit" value="OK" style="position:relative; margin-left:170px;margin-top:8px;height:25px; color:#fff; background:#42aaff;border:1px solid #42aaff;cursor:pointer; width:200px;">
            </form>
            </div>
            <?}}else{echo"<meta http-equiv='Refresh' content='0; URL=/account/edit.php?id=".$id."&pg=1'>";}}?>
        </div>
    </div><?}else{echo "<meta http-equiv='Refresh' content='0; URL=/index.php'>";}?>
</body>
</html>
<?if($_COOKIE['language']=="english"){?><script src="/js/eng_translater.js"></script><?}
elseif($_COOKIE['language']=="japanese"){?><script src="/js/jp_translater.js"></script><?}?>