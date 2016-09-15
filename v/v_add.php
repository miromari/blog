<!doctype html>
<html>
<head>
    <title>Добавление новости</title>
</head>
<body>
    <p><?=$error?></p>
	<form method="post">
        Заголовок статьи<br>
        <input type="text" name="title" size="100" value = "<?=$title?>"><br>
        Текст статьи<br>
        <textarea name="content"  cols="100" rows="10" > <?=$content?></textarea><br>
		<input type="submit" value="Сохранить"><br>
	</form><hr>
    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php">Выйти</a>
</body>
</html>
