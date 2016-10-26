<p class = "error"><?=$message?></p>
<form method="post">
    Заголовок статьи<br>
    <input type="text" name="title" size="80" value = "<?=$title?>"><br>
     <span class = "error"><?=$error['title']?></span><br>
    Текст статьи<br>
    <textarea name="content"  cols="80" rows="10" > <?=$content?></textarea><br>
     <span class = "error"><?=$error['content']?></span><br>
	<input type="submit" name = "save" formaction="/article/edit/<?=$id_article?>" value="Сохранить">
    <input type="submit" name = "delete" formaction="/article/delete/<?=$id_article?>" value="Удалить"><br>

</form><hr>
