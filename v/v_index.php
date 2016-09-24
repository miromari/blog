<h1>Список новостей</h1><hr>
    
<?foreach($articles as $article):?>
    <a href="article.php?id=<?=$article['id_article']?>"><?=$article['title']?></a><hr>
<?endforeach?>

<a href = "add.php">Добавить новость</a><br>
<a href="login.php"><?=($auth ? 'Выйти':'Войти')?></a>

