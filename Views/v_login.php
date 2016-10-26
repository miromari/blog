<form method="post">
	<? if (!empty($errors)):?>
		<div class="error">
			<?foreach($errors as $field => $text): ?>
				<p><?=$field?>:<?$text?></p>
			<?endforeach?>
		</div>
	<?endif?>
	Логин<br>
	<input type="text" name="login" value = "<?=$login?>"><br>
	Пароль<br>
	<input type="text" name="password" value = "<?=$password?>"><br>
	<input type="checkbox" name="remember">Запомнить меня<br>
	<input type="submit" value="Войти"><br>
</form>
