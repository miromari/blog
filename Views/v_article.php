<h1><?=$title?></h1><hr>
<p> <?=$content?></p><hr>

<?if($auth):?>
<a href = "edit?id=<?=$id_article?>">Редактировать</a>
<?endif?>

