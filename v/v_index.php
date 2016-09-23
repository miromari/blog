<!doctype html>
<html>
<head>
    <title>Список новостей</title>
</head>
<body>
    <h2>Список новостей</h2>
    
    <?foreach($articles as $article):?>
        <a href="article.php?id=<?=$article['id_article']?>"><?=$article['title']?></a><hr>
    <?endforeach?>

    <a href = "add.php">Добавить новость</a><br>
    <a href="login.php"><?=($auth ? 'Выйти':'Войти')?></a>
</body>
</html>
