<!doctype html>
<html>
<head>
    <title>Страница новости</title>
</head>
<body>
    <h2><?=$title?></h2>
    <p> <?=$content?></p><hr>
    
    <?if($auth):?>
    <a href = "edit.php?id=<?=$id_article?>">Редактировать</a> | 
    <?endif?>

    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php"><?=($auth?'Выйти':'Войти')?></a>


</body>
</html>
