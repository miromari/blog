<p class = "error"><?=$message?></p>
<form method="post">
    Заголовок статьи<br>
    <input type="text" name="title" size="80" value = "<?=$title?>"><br>
     <?if (isset($errors['title'])) :?>
     	<div class = "error"><?=$errors['title']?></div>
     <?endif?>
    Текст статьи<br>
    <textarea name="content"  cols="80" rows="10" > <?=$content?></textarea><br>
     <?if (isset($errors['content'])) :?>
     	<div class = "error"><?=$errors['content']?></div>
     <?endif?>	
     <input type="submit" value="Сохранить"><br>
</form><hr>

