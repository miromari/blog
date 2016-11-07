<h1>Список новостей</h1><hr>
    
<?foreach($articles as $article):?>
    <a href="/article/<?=$article['id_article']?>"><?=$article['title']?></a><hr>
<?endforeach?>


