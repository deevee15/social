<?
    require("bd.php");
    $text=$_POST['text'];
    $dialogue_id=$_POST['dialogue_id'];
    $sendto=$_GET['sendto'];
    //
    $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysqli_fetch_array($result)) {$sender=$row['id'];}
    if(mysqli_num_rows($result)==0){echo'error';}
    else{
        if($dialogue_id=='no'){
            $checkexist = mysqli_query($mysqli,"SELECT * FROM dialogues WHERE (initiator='$sender' AND recipient='$sendto') OR (initiator='$sendto' AND recipient='$sender')");
            if(mysqli_num_rows($checkexist)==0){
                $res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `dialogues`');
                if($res)
                $row = mysqli_fetch_array($res, MYSQLL_NUM);
                $getdialoguescount = !empty($row[0]) ? $row[0] : 0;
                $getdialoguescount=$getdialoguescount+1;
                //
                $date=date('d.m.y/H:i:s');
                $query = "INSERT INTO `messages`(`sender`, `recipient`, `text`, `date`, `unread`, `dialogue_id`) VALUES ('$sender','$sendto','$text','$date','1','$getdialoguescount')";
                $result = $mysqli->query($query) or die(mysqli_error());; 

                $query = "INSERT INTO `dialogues`(`initiator`, `recipient`, `sender`, `date`, `unread`) VALUES ('$sender','$sendto','$text','$date','1')";
                $result = $mysqli->query($query) or die(mysqli_error());; 

                $resultss = mysqli_query($mysqli,"SELECT `id` FROM `messages` WHERE `date`='".$date."' AND `dialogue_id`='".$getdialoguescount."'");
                while($row = mysqli_fetch_array($resultss)) {$m_id=$row['id'];}
                $queryqq = "UPDATE dialogues SET last_msg='".$m_id."', date = '".$date."', sender='".$sender."', unread=1 WHERE d_id = '".$getdialoguescount."'";
                $resultaaa = $mysqli->query($queryqq) or die(mysqli_error());; 
                //echo 'error2';
            }
            else{
                while($row = mysqli_fetch_array($checkexist)){$dialogue_id = $row['d_id'];}
                $date=date('d.m.y/H:i:s');
                $query = "INSERT INTO `messages`(`sender`, `recipient`, `text`, `date`, `unread`, `dialogue_id`) VALUES ('$sender','$sendto','$text','$date','1','$dialogue_id')";
                $result = $mysqli->query($query) or die(mysqli_error());;
                $resultss = mysqli_query($mysqli,"SELECT `id` FROM `messages` WHERE `date`='".$date."' AND `dialogue_id`='".$dialogue_id."'");
                while($row = mysqli_fetch_array($resultss)) {$m_id=$row['id'];}
                $queryqq = "UPDATE dialogues SET last_msg='".$m_id."', date = '".$date."', sender='".$sender."', unread=1 WHERE d_id = '".$dialogue_id."'";
                $resultaaa = $mysqli->query($queryqq) or die(mysqli_error());; 
            }
        }
        else{
            $getrec = mysqli_query($mysqli,"SELECT * FROM `dialogues` WHERE `d_id` = '".$dialogue_id."'");
            while($roww = mysqli_fetch_array($getrec)){ 
                $ggrecipient=$roww['recipient'];
                $initiator=$roww['initiator'];
                if($ggrecipient == $sender){$recipient = $initiator;}
                else{$recipient = $ggrecipient;}
            }
            $date=date('d.m.y/H:i:s');
            $query = "INSERT INTO `messages`(`sender`, `recipient`, `text`, `date`, `unread`, `dialogue_id`) VALUES ('$sender','$recipient','$text','$date','1','$dialogue_id')";
            $result = $mysqli->query($query) or die(mysqli_error());; 
            $resultss = mysqli_query($mysqli,"SELECT `id` FROM `messages` WHERE `date`='".$date."' AND `dialogue_id`='".$dialogue_id."'");
            while($row = mysqli_fetch_array($resultss)) {$m_id=$row['id'];}
            $queryqq = "UPDATE dialogues SET last_msg='".$m_id."', date = '".$date."', sender='".$sender."', unread=1 WHERE d_id = '".$dialogue_id."'";
            $resultaaa = $mysqli->query($queryqq) or die(mysqli_error());;
            $id=$sender;
            $result = mysqli_query($mysqli,"SELECT * FROM `messages` WHERE dialogue_id = '$dialogue_id' ORDER BY `id` ASC");
            while($row = mysqli_fetch_array($result)) {
                $sender=$row['sender'];
                $recipient=$row['recipient'];
                $msg_text=$row['text'];
                $msg_id=$row['id'];
                $unread=$row['unread'];
                if($sender!=$id){
                echo'<div class="m_show_dialogue_chat_left">
                    <div class="m_show_dialogue_chat_left_avatar">';
                            $check_online = mysqli_query($mysqli,"SELECT path FROM avatars WHERE u_id='$sender' AND main=1");
                            $avatar = mysqli_fetch_array($check_online);
                if(!empty($avatar['path'])){echo'<img src="/user/avatars/'.$avatar['path'].'">';}else{echo'<img src="/img/avatar.png">';}
                    echo'</div>
                    <div class="m_show_dialogue_chat_left_name">';
                            $check_name = mysqli_query($mysqli,"SELECT name FROM users WHERE id='$sender'");
                            $name = mysqli_fetch_array($check_name);
                            //surname
                            $check_name = mysqli_query($mysqli,"SELECT surname FROM users WHERE id='$sender'");
                            $sname = mysqli_fetch_array($check_name);
                            if($_COOKIE['language']=='english'){
                            include("translater.php");
                            $fr_namevalue = strtr($name['name'], $trans);
                            $fr_surnamevalue = strtr($sname['surname'], $trans);}
                            //offical
                            $check_of = mysqli_query($mysqli,"SELECT offical FROM users WHERE id='$sender'");
                            $offical = mysqli_fetch_array($check_of);
                        if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
                        else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}
                        if($offical['offical']==1){echo"<img src='/img/verif.png' width='18px' height='18px' class'verified' style='margin-left:5px;'>";}
                    echo'</div><div class="m_show_dialogue_chat_left_text"><span>'.$msg_text.'</span></div></div>';}else{
                echo'<div class="m_show_dialogue_chat_right">
                    <div class="m_show_dialogue_chat_right_avatar">';
                            $check_online = mysqli_query($mysqli,"SELECT path FROM avatars WHERE u_id='$sender' AND main=1");
                            $avatar = mysqli_fetch_array($check_online);
                        if(!empty($avatar['path'])){echo'<img src="/user/avatars/'.$avatar['path'].'">';}else{echo'<img src="/img/avatar.png">';}
                    echo'</div>
                    <div class="m_show_dialogue_chat_right_name">
                        You
                    </div>
                    <div class="m_show_dialogue_chat_right_text show"><span>'.$msg_text.'</span></div>
                </div>';}}
            echo'</div>
            <div class="m_show_dialogue_send">
                <input type="text" placeholder="Type some text..." class="m_show_dialogue_send_input">
                <input type="button" value="Send" class="m_show_dialogue_send_button">
            </div>';
        }
    }
?>