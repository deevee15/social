<?
    include_once("bd.php");
    $id=$_GET['user_id'];
    $d_id=$_POST['d_id'];
    /*$result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {$sender=$row['id'];}*/
    //if(mysql_num_rows($result)==0){echo'error';}
    //else{
        $result = mysql_query("SELECT * FROM `messages` WHERE dialogue_id = '$d_id' ORDER BY `id` ASC");
                        while($row = mysql_fetch_array($result)) {
                            $sender=$row['sender'];
                            $recipient=$row['recipient'];
                            $msg_text=$row['text'];
                            $msg_id=$row['id'];
                            $unread=$row['unread'];
                    if($sender!=$id){
                    echo'<div class="m_show_dialogue_chat_left">
                        <div class="m_show_dialogue_chat_left_avatar">';
                                $check_online = mysql_query("SELECT path FROM avatars WHERE u_id='$sender' AND main=1");
                                $avatar = mysql_fetch_array($check_online);
                            if(!empty($avatar['path'])){echo'<img src="/user/avatars/'.$avatar['path'].'">';}else{echo'<img src="/img/avatar.png">';}
                        echo'</div>
                        <div class="m_show_dialogue_chat_left_name">';
                                $check_name = mysql_query("SELECT name FROM users WHERE id='$sender'");
                                $name = mysql_fetch_array($check_name);
                                //surname
                                $check_name = mysql_query("SELECT surname FROM users WHERE id='$sender'");
                                $sname = mysql_fetch_array($check_name);
                                if($_COOKIE['language']=='english'){
                                include("translater.php");
                                $fr_namevalue = strtr($name['name'], $trans);
                                $fr_surnamevalue = strtr($sname['surname'], $trans);}
                                //offical
                                $check_of = mysql_query("SELECT offical FROM users WHERE id='$sender'");
                                $offical = mysql_fetch_array($check_of);
                            if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
                            else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}
                            if($offical['offical']==1){echo"<img src='/img/verif.png' width='18px' height='18px' class'verified' style='margin-left:5px;'>";}
                        echo'</div><div class="m_show_dialogue_chat_left_text"><span>'.$msg_text.'</span></div></div>';}else{
                    echo'<div class="m_show_dialogue_chat_right">
                        <div class="m_show_dialogue_chat_right_avatar">';
                                $check_online = mysql_query("SELECT path FROM avatars WHERE u_id='$sender' AND main=1");
                                $avatar = mysql_fetch_array($check_online);
                            if(!empty($avatar['path'])){echo'<img src="/user/avatars/'.$avatar['path'].'">';}else{echo'<img src="/img/avatar.png">';}
                        echo'</div>
                        <div class="m_show_dialogue_chat_right_name">
                            You
                        </div>
                        <div class="m_show_dialogue_chat_right_text"><span>'.$msg_text.'</span></div>
                    </div>';}}
                echo'</div>';
    //}
?>