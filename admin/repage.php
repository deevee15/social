<?
    $showuser=$_POST['user_id'];
    $ban_user=$_POST['ban_user'];
    $ban_reason=$_POST['ban_reason'];
    $ban_time=$_POST['ban_time'];
    //
    $add_admin_id=$_POST['user_adadm_id'];
    $add_admin_lvl=$_POST['user_adadm_lvl'];
    if($showuser!='' and ($ban_user=='' and $ban_reason=='' and $ban_time=='' and $add_admin_id=='')){
        echo "<meta http-equiv='Refresh' content='0; URL=/admin/showuser.php?id=".$showuser."'>"; 
    }
    else if($showuser=='' and $add_admin_id=='' and ($ban_user!='' and $ban_reason!='' and $ban_time!='')){
        echo "<meta http-equiv='Refresh' content='0; URL=/admin/banuser.php?id=".$ban_user."&reason=".$ban_reason."&time=".$ban_time."'>"; 
    }
    else if($add_admin_id!='' and ($showuser=='' and $ban_user=='' and $ban_reason=='' and $ban_time=='')){
        echo "<meta http-equiv='Refresh' content='0; URL=/admin/setadmin.php?id=".$add_admin_id."&lvl=".$add_admin_lvl."'>"; 
    }
?>