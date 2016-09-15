<!doctype html>
<html>
    <head>
        <title>Страница авторизации</title>

    </head>
    <body>
        <form method="post">
        	Логин<br>
        	<input type="text" name="login" value = "<? echo $login ?>"><br>
        	Пароль<br>
        	<input type="text" name="password" value = "<? echo $password ?>"><br>
        	<input type="checkbox" name="remember">Запомнить меня
        	<input type="submit" value="Войти"><br>
            <a href = "index.php">К списку новостей</a>
        </form>
    </body>
</html>