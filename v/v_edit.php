<!doctype html>
<html>
<head>
    <title>Редактирование новости</title>
</head>
<body>
    <p><?=$error?></p>
	<form method="post">
		Заголовок статьи<br>
		<input type="text" name="title" size="100" value = "<? echo $title ?>"><br>
		Текст статьи<br>
		<textarea name="content"  cols="100" rows="10" > <? echo $content ?></textarea><br>
		<input type="submit" name = "save" value="Сохранить">
        <input type="submit" name = "delete"  value="Удалить"><br>
	</form><hr>
    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php">Выйти</a>
</body>
</html>
