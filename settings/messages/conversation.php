<?
    include_once("bd.php");
    $d_id=$_GET['d_id'];
    $result = mysql_query("SELECT * FROM `users` WHERE `email` = '".$_COOKIE['account']."'");
    while($row = mysql_fetch_array($result)) {$id=$row['id'];}

    $result = mysql_query("SELECT * FROM `dialogues` WHERE d_id = '$d_id' AND (`initiator` = '$id' OR `recipient` = '$id')");
    while($row = mysql_fetch_array($result)) {
        $rec=$row['recipient'];
        $init=$row['initiator'];
        if($rec!=$id) $ava = mysql_query("SELECT path FROM avatars WHERE u_id='$rec' AND main=1");
        else $ava = mysql_query("SELECT path FROM avatars WHERE u_id='$init' AND main=1");
        $avatar = mysql_fetch_array($ava);
        if($rec!=$id) echo'<div class="m_show_dialogue_info_avatar"><a href="/acc.php?id='.$rec.'"><img src="/user/avatars/'.$avatar['path'].'"></a></div>';
        else echo'<div class="m_show_dialogue_info_avatar"><a href="/acc.php?id='.$init.'"><img src="/user/avatars/'.$avatar['path'].'"></a></div>';

        if($rec!=$id) $check_name = mysql_query("SELECT name FROM users WHERE id='$rec'");
        else $check_name = mysql_query("SELECT name FROM users WHERE id='$init'");
        $name = mysql_fetch_array($check_name);
        //surname
        if($rec!=$id) $check_name = mysql_query("SELECT surname FROM users WHERE id='$rec'");
        else $check_name = mysql_query("SELECT surname FROM users WHERE id='$init'");
        $sname = mysql_fetch_array($check_name);
        if($_COOKIE['language']=='english'){
        include("translater.php");
        $fr_namevalue = strtr($name['name'], $trans);
        $fr_surnamevalue = strtr($sname['surname'], $trans);}
        //offical
        if($rec!=$id) $check_of = mysql_query("SELECT offical FROM users WHERE id='$rec'");
        else $check_of = mysql_query("SELECT offical FROM users WHERE id='$init'");
        $offical = mysql_fetch_array($check_of);
        echo'<div class="m_show_dialogue_info_name">';if($_COOKIE['language']!='english'){echo $name['name'];echo' ';echo $sname['surname'];}
        else{echo $fr_namevalue;echo' ';echo $fr_surnamevalue;}
        if($offical['offical']==1){echo'<object data="/img/verif.svg" style="fill:#9042ff;width: 25px;margin-left: 5px;margin-top: 5px;position: absolute;"><img src="/img/verif.png"></object>';} echo'</div>
        <div class="m_show_dialogue_info_status">online</div>
        <div class="m_show_dialogue_info_buttons">
            <ul>
                <li class="m_show_dialogue_info_buttons_backb"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 8.75H4.7875L11.775 1.7625L10 0L0 10L10 20L11.7625 18.2375L4.7875 11.25H20V8.75Z"/>
                </svg>
                </li>
                                <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.42857 0C9.39875 0 11.2882 0.782651 12.6814 2.17578C14.0745 3.56891 14.8571 5.45839 14.8571 7.42857C14.8571 9.26857 14.1829 10.96 13.0743 12.2629L13.3829 12.5714H14.2857L20 18.2857L18.2857 20L12.5714 14.2857V13.3829L12.2629 13.0743C10.96 14.1829 9.26857 14.8571 7.42857 14.8571C5.45839 14.8571 3.56891 14.0745 2.17578 12.6814C0.782651 11.2882 0 9.39875 0 7.42857C0 5.45839 0.782651 3.56891 2.17578 2.17578C3.56891 0.782651 5.45839 0 7.42857 0ZM7.42857 2.28571C4.57143 2.28571 2.28571 4.57143 2.28571 7.42857C2.28571 10.2857 4.57143 12.5714 7.42857 12.5714C10.2857 12.5714 12.5714 10.2857 12.5714 7.42857C12.5714 4.57143 10.2857 2.28571 7.42857 2.28571Z"/>
                </svg>
                </li>
                                <li><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM2 10C2 5.58 5.58 2 10 2C11.85 2 13.55 2.63 14.9 3.69L3.69 14.9C2.63 13.55 2 11.85 2 10ZM10 18C8.15 18 6.45 17.37 5.1 16.31L16.31 5.1C17.37 6.45 18 8.15 18 10C18 14.42 14.42 18 10 18Z"/>
                </svg>
                </li>
            </ul>
        </div>
        <div class="m_show_dialogue_info_search">
            <input type="text" placeholder="What do you want to search?" name="m_show_dialogue_info_search" autocomplete="off">
            <input type="button" value="Search">
            <button>Cancel</button>
        </div>';
    }
?>