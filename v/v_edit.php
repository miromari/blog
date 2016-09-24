<p class = "error"><?=$db_error?></p>
<form method="post">
    Заголовок статьи<br>
    <input type="text" name="title" size="100" value = "<?=$title?>"><br>
     <span class = "error"><?=$error['title']?></span><br>
    Текст статьи<br>
    <textarea  id="editor1" name="content"  cols="100" rows="10" > <?=$content?></textarea><br>
     <span class = "error"><?=$error['content']?></span><br>
	<input type="submit" name = "save" value="Сохранить">
    <input type="submit" name = "delete"  value="Удалить"><br>
    <script>
	  // Replace the <textarea id="editor1"> with a CKEditor
	  // instance, using default configuration.
	  CKEDITOR.replace( 'editor1' );
	 </script>
</form><hr>
<a href = "index.php">К списку новостей</a><br>
<a href="login.php">Выйти</a>