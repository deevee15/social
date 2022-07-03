<?php
    include_once("bd.php");$id=$_GET['id'];include_once("vars.php");
?>
<body>
    <form enctype="multipart/form-data" action="avatar.php?id=<?echo$id;?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
    <?
        $uploaddir = '/img/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile); 
    echo "Файл корректен и был успешно загружен.\n";

print_r($_FILES);

print "</pre>";
    ?>
</body>