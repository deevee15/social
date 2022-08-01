<?
    require("bd.php");
    $id=$_GET['id'];
    require("vars.php");
    $type=$_GET['type'];
    $count=$_POST['count'];
    if($_COOKIE['language']=='english'){include("translater.php");
        $name=$openedUser['name']; $surname=$openedUser['surname'];
            $namevalue = strtr($name, $trans);
            $surnamevalue = strtr($surname, $trans);}
        $result = mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
            while($row = mysqli_fetch_array($result)) {
                $support=$row['support'];
                $user_id=$row['id'];
                $user_ip=$row['user_ip'];
                $ULANG=$row['site_lang'];
                $user_ava=$row['avatar'];
                $user_email_status=$row['email_status'];
                $user_changeid=$row['changed_id'];
                $user_name=$row['name'];
                $user_surname=$row['surname'];
            }
        if($type==0 or $type==3){$res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `wall` WHERE `user` = '.$id.'');}
        elseif($type==1){$res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `wall` WHERE `user` = '.$id.' and `w_hidden` = 0');}
        elseif($type==2){$res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `wall` WHERE `user` = '.$id.' and `w_hidden` = 1');} 
        if($res)
        $row = mysqli_fetch_array($res, MYSQLI_NUM);
        $his_posts = !empty($row[0]) ? $row[0] : 0;
            echo'<div class="wall_title"><p>'; if($_COOKIE['language']=='english'){echo$namevalue;}else{echo$name;}echo"'s wall (".$his_posts.")</p>";
            if($user_id==$id){echo'<ul>
                    <li class="wall_title_button_seeall">see all</li>
                    <li class="wall_title_button_hidden">only hidden</li>
                    <li class="wall_title_button_public">only public</li>
                </ul>';}
            echo"</div>";
                    //if($user_id==$id){$result = mysql_query("SELECT * FROM `wall` WHERE `user` = '".$id."' ORDER BY id DESC");}
                    if($type==0){$result = mysqli_query($mysqli,"SELECT * FROM `wall` WHERE `user` = '".$id."' ORDER BY id DESC");}
                    elseif($type==1){$result = mysqli_query($mysqli,"SELECT * FROM `wall` WHERE `user` = '".$id."' AND w_hidden=0 ORDER BY id DESC");}
                    elseif($type==2){$result = mysqli_query($mysqli,"SELECT * FROM `wall` WHERE `user` = '".$id."' AND w_hidden=1 ORDER BY id DESC");}
                    //elseif($type==3){$result = mysql_query("SELECT * FROM  `wall` WHERE `user` =".$id."  ORDER BY id DESC LIMIT {$count}");}
                    if(mysqli_num_rows($result)==0){echo'<div class="wall_post_noposts">There are no posts yet.</div>';}
                    while($row = mysqli_fetch_array($result)) {
                        $w_id=$row['id'];
                        $w_text=$row['text'];
                        $w_date=$row['w_date'];
                        $w_hidden=$row['w_hidden'];
    echo '
    <div class="wall_post show">
                <div class="wall_post_avatar">';
                    $zapros1 = mysqli_query($mysqli,"SELECT * FROM `avatars` WHERE (u_id = '$id' AND `main` = 1)");
                    while($row = mysqli_fetch_array($zapros1)) {$get_uavatar_path=$row['path'];} echo'
                <img src="'; if($id==$bannedid){echo"/img/banned.png";}else{echo"/user/avatars/".$get_uavatar_path;} echo'">
                </div>
                <div class="wall_post_name">'; if($_COOKIE['language']=='english'){echo $namevalue.' '.$surnamevalue;}else{echo $name.' '.$surname;} echo'</div>
                <div class="wall_post_date">'.$w_date.'</div>
                <div class="wall_post_settings">
                    <ul>
                        <a><li>Report</li></a>';
                        if($user_id==$id){ echo'<a class="wall_post_settings_editb" id="'.$w_id.'"><li>Edit</li></a>
                        <a href="/settings/hidepost.php?id='.$user_id.'&w_id='.$w_id.'&w_hidden='.$w_hidden.'"><li>';if($w_hidden==0){echo'Private';}else{echo'Public';}echo'</li></a>
                        <a href="/settings/deletepost.php?id='.$user_id.'&w_id='.$w_id.'"><li>Delete</li></a>';}echo'
                    </ul>
                </div>
                <div class="wall_post_text">
                    <div class="wall_post_text_show pn'.$w_id.'">'.$w_text.'</div>
                    <div class="wall_post_text_edit">
                        <form method="post" action="/settings/submit_postedit.php?id='.$id.'" class="post_edit_form_all post_edit_formn'.$w_id.'">
                            <textarea class="wall_post_text_edit_textarea textarean'.$w_id.'">'.$w_text.'</textarea>
                            <input type="submit" value="Save">
                            <button type="button" class="post_edit_form_all_cancelb">Cancel</button>
                        </form>
                    </div>
                </div>
                <div class="wall_post_stats">
                    <ul>
                    <a class="wall_post_stats_like'; $get_likeinfo = mysqli_query($mysqli,"SELECT `log_id` FROM `likes` WHERE `who_liked` = '$user_id' AND `owner` = '$id' AND `object_id` = '$w_id' AND `type` = '3'");if(mysqli_num_rows($get_likeinfo)!=0){echo' liked';} echo' wlbid'.$w_id.'" type="3" object_id="'.$w_id.'" owner="'.$id.'">
                    <li>';
                        //check wall likes
                        $res = mysqli_query($mysqli,'SELECT COUNT(1) FROM `likes` WHERE `owner` = '.$id.' AND type = 3 AND object_id = '.$w_id.'');
                        if($res)
                        $row = mysqli_fetch_array($res, MYSQLI_NUM);
                        $his_wall_likes = !empty($row[0]) ? $row[0] : 0;
                            echo'<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.1 15.55L10 15.65L9.89 15.55C5.14 11.24 2 8.39 2 5.5C2 3.5 3.5 2 5.5 2C7.04 2 8.54 3 9.07 4.36H10.93C11.46 3 12.96 2 14.5 2C16.5 2 18 3.5 18 5.5C18 8.39 14.86 11.24 10.1 15.55ZM14.5 0C12.76 0 11.09 0.81 10 2.08C8.91 0.81 7.24 0 5.5 0C2.42 0 0 2.41 0 5.5C0 9.27 3.4 12.36 8.55 17.03L10 18.35L11.45 17.03C16.6 12.36 20 9.27 20 5.5C20 2.41 17.58 0 14.5 0Z"/>
    </svg>
                            <span>';$get_likeinfo = mysqli_query($mysqli,'SELECT `log_id` FROM `likes` WHERE `who_liked` = '.$user_id.' AND `owner` = '.$id.' AND `object_id` = '.$w_id.' AND `type` = 3');if(mysqli_num_rows($get_likeinfo)!=0){echo'Liked';}else{echo'Like';} echo' (';$wallike_count=str_split($his_wall_likes);if($his_wall_likes<1000){echo$his_wall_likes;}elseif($his_wall_likes<10000){echo$wallike_count[0].'K';}elseif($his_wall_likes<100000){echo$wallike_count[0].$wallike_count[1].'K';}elseif($his_wall_likes<1000000){echo$wallike_count[0].$wallike_count[1].$wallike_count[2].'K';}elseif($his_wall_likes<10000000){echo$wallike_count[0].'KK';}else{$his_wall_likes;} echo')</span>
                        </li></a>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 13.4C14.3667 13.4 13.8 13.65 13.3667 14.0417L7.425 10.5833C7.46667 10.3917 7.5 10.2 7.5 10C7.5 9.8 7.46667 9.60833 7.425 9.41667L13.3 5.99167C13.75 6.40833 14.3417 6.66667 15 6.66667C16.3833 6.66667 17.5 5.55 17.5 4.16667C17.5 2.78333 16.3833 1.66667 15 1.66667C13.6167 1.66667 12.5 2.78333 12.5 4.16667C12.5 4.36667 12.5333 4.55833 12.575 4.75L6.7 8.175C6.25 7.75833 5.65833 7.5 5 7.5C3.61667 7.5 2.5 8.61667 2.5 10C2.5 11.3833 3.61667 12.5 5 12.5C5.65833 12.5 6.25 12.2417 6.7 11.825L12.6333 15.2917C12.5917 15.4667 12.5667 15.65 12.5667 15.8333C12.5667 17.175 13.6583 18.2667 15 18.2667C16.3417 18.2667 17.4333 17.175 17.4333 15.8333C17.4333 14.4917 16.3417 13.4 15 13.4ZM15 3.33333C15.4583 3.33333 15.8333 3.70833 15.8333 4.16667C15.8333 4.625 15.4583 5 15 5C14.5417 5 14.1667 4.625 14.1667 4.16667C14.1667 3.70833 14.5417 3.33333 15 3.33333ZM5 10.8333C4.54167 10.8333 4.16667 10.4583 4.16667 10C4.16667 9.54167 4.54167 9.16667 5 9.16667C5.45833 9.16667 5.83333 9.54167 5.83333 10C5.83333 10.4583 5.45833 10.8333 5 10.8333ZM15 16.6833C14.5417 16.6833 14.1667 16.3083 14.1667 15.85C14.1667 15.3917 14.5417 15.0167 15 15.0167C15.4583 15.0167 15.8333 15.3917 15.8333 15.85C15.8333 16.3083 15.4583 16.6833 15 16.6833Z" fill="#9DA9B9"/>
    </svg>
                            <span>Share (122)</span>
                        </li>
                        <li>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1.875 3.125V14.375H5V17.5487L8.97 14.375H18.125V3.125H1.875ZM3.125 4.375H16.875V13.125H8.53L6.25 14.9487V13.125H3.125V4.375Z" fill="#9DA9B9"/>
    </svg>
                            <span>Comment (2222)</span>
                        </li>
                    </ul>
                </div>
            </div>';
                    }
    //else{echo'error1';}
?>