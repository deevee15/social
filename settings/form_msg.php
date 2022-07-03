<?$id=$_GET['id'];?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="/css/modal.css">
</head>
<body class="lock">
    <div class="shim"><div class="modal">
    <form method="post" action="/settings/messageto.php?id=<?$id?>">
        <input type="text" placeholder="Text">
        <input type="submit" value="Отправить">
    </form>
    </div></div>
</body>
</html>