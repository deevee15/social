<?
    require('bd.php');
    $d_id=$_GET['d_id'];
    $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($result)) {$id=$row['id'];}
    $result = mysqli_query($mysqli,"SELECT * FROM `dialogues` WHERE d_id = '$d_id' AND (`initiator` = '$id' OR `recipient` = '$id')");
    while($row = mysqli_fetch_array($result)) {
        $rec=$row['recipient'];
        $init=$row['initiator'];
    }
    if($rec!=$id) $ava = mysqli_query($mysqli,"SELECT path FROM avatars WHERE u_id='$rec' AND main=1");
    else $ava = mysqli_query($mysqli,"SELECT path FROM avatars WHERE u_id='$init' AND main=1");
    $avatar = mysqli_fetch_array($ava);$userAvatar=$avatar['path'];

    if($rec!=$id) $check_name = mysqli_query($mysqli,"SELECT name FROM users WHERE id='$rec'");
    else $check_name = mysqli_query($mysqli,"SELECT name FROM users WHERE id='$init'");
    $name = mysqli_fetch_array($check_name);
    //surname
    if($rec!=$id) $check_name = mysqli_query($mysqli,"SELECT surname FROM users WHERE id='$rec'");
    else $check_name = mysqli_query($mysqli,"SELECT surname FROM users WHERE id='$init'");
    $sname = mysqli_fetch_array($check_name);
    if($_COOKIE['language']=='english'){
        include("translater.php");
        $fr_namevalue = strtr($name['name'], $trans);
        $fr_surnamevalue = strtr($sname['surname'], $trans);
    }
    else{$fr_namevalue=$name['name'];  $fr_surnamevalue=$sname['surname'];}
    //offical
    if($rec!=$id) $check_of = mysqli_query($mysqli,"SELECT offical FROM users WHERE id='$rec'");
    else $check_of = mysqli_query($mysqli,"SELECT offical FROM users WHERE id='$init'");
    $offical = mysqli_fetch_array($check_of);$userOffical=$offical['offical'];
    //online
    if($rec!=$id){ $check_onl = mysqli_query($mysqli,"SELECT online FROM users WHERE id='$rec'");}
    else{ $check_onl = mysqli_query($mysqli,"SELECT online FROM users WHERE id='$init'");}
    $onlineStatus = mysqli_fetch_array($check_onl);
    if($onlineStatus['online']==1){ $userOnline=$onlineStatus['online'];}
    else {
        if($rec!=$id) $last_login = mysqli_query($mysqli,"SELECT last_login FROM users WHERE id='$rec'");
        else $last_login = mysqli_query($mysqli,"SELECT last_login FROM users WHERE id='$init'");
        $userLastLogin = mysqli_fetch_array($last_login);
        $userOnline=$userLastLogin['last_login'];
    }
    if($rec!=$id) $userId=$rec;
    else $userId=$init;
    $dialogueInfo = array(
        "user_id"=>"$userId",
        "avatar"=>"$userAvatar",
        "name"=>"$fr_namevalue",
        "surname"=>"$fr_surnamevalue",
        "offical"=>"$userOffical",
        "online"=>"$userOnline",
    );
    echo json_encode($dialogueInfo);
?>