<?
    require("bd.php");
    $id=$_GET['user_id'];
    $d_id=$_POST['d_id'];
    $search=$_POST['search'];
    if($search=='undefined') $result = mysqli_query($mysqli,"SELECT * FROM `messages` WHERE dialogue_id = '$d_id' ORDER BY `id` ASC");
    else $result = mysqli_query($mysqli,"SELECT * FROM `messages` WHERE dialogue_id = '$d_id' AND text LIKE '%{$search}%' ORDER BY `id` ASC");
    $arr=array();
    while($row = mysqli_fetch_array($result)) {
        $sender=$row['sender'];
        $recipient=$row['recipient'];
        $msg_text=$row['text'];
        $msg_id=$row['id'];
        $unread=$row['unread'];
        $msg_date=$row['date'];
        $checkAvatar = mysqli_query($mysqli,"SELECT path FROM avatars WHERE u_id='$sender' AND main=1");
        $avatar = mysqli_fetch_array($checkAvatar);$userAvatar=$avatar['path'];
        $check_name = mysqli_query($mysqli,"SELECT name FROM users WHERE id='$sender'");
        $name = mysqli_fetch_array($check_name);
        $check_name = mysqli_query($mysqli,"SELECT surname FROM users WHERE id='$sender'");
        $sname = mysqli_fetch_array($check_name);
        if($_COOKIE['language']=='english'){
            require("translater.php");
            $fr_namevalue = strtr($name['name'], $trans);
            $fr_surnamevalue = strtr($sname['surname'], $trans);
        }
        else{$fr_namevalue=$name['name'];  $fr_surnamevalue=$sname['surname'];}
        $check_of = mysqli_query($mysqli,"SELECT offical FROM users WHERE id='$sender'");
        $offical = mysqli_fetch_array($check_of); $userOffical=$offical['offical'];
        $messageInfo = array(
            "sender"=>"$sender",
            "recipient"=>"$recipient",
            "msg_text"=>"$msg_text",
            "msg_id"=>"$msg_id",
            "unread"=>"$unread",
            "msg_date"=>"$msg_date",
            "avatar"=>"$userAvatar",
            "name"=>"$fr_namevalue",
            "surname"=>"$fr_surnamevalue",
            "official"=>"$userOffical",
        );
        $arr[]=array_merge($messageInfo);
    }
    echo json_encode($arr);
?>