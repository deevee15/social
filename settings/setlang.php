<?
    include_once("bd.php");$id=$_GET['id'];include_once("vars.php");$lg=$_GET['lg'];
    if($id!='' and $lg!=''){
        if($lg=='1'){$lg1="russian";}
        elseif($lg=='2'){$lg1="english";}
        elseif($lg=='3'){$lg1="japanese";}
        elseif($lg=='4'){$lg1="deutsch";}
        elseif($lg=='5'){$lg1="french";}
        $query = "UPDATE users SET site_lang='".$lg1."' WHERE id = '".$id."'";
        $result = mysql_query($query) or die(mysql_error());;
        if($lg1=='english'){setcookie("language","english",time()+300600,"/");}
        elseif($lg1=='russian'){setcookie("language","russian",time()+300600,"/");}
        elseif($lg1=='japanese'){setcookie("language","japanese",time()+300600,"/");}
        echo "<meta http-equiv='Refresh' content='0; URL=/acc.php?id=".$id."'>";
    }
?>