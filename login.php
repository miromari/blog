<?php
	session_start(); 

    $login = '';
    $password = '';

	if(count($_POST) > 0){
        
       $login = $_POST['login'];
       $password = $_POST['password'];

        if($login == 'admin' && $password == 'qwerty'){

            $_SESSION['auth'] = true;

            // если стоит галочка                       
            if (isset( $_POST['remember'])){
                setcookie('login', $login, time() + 3600 * 24 * 7);
                setcookie('password', md5($password), time() + 3600 * 24 * 7);
            } 

// Проверяем, что есть отметка, откуда мы пришли и перенаправляем туда
            if (isset($_SESSION['back'])){
                $back = $_SESSION['back'];
                header("Location: $back");  
            }
            // если отметки нет, отправляем на главную страницу
            else{
                header('Location: index.php');   
            }
            exit();
            }
    }
    else{

        unset($_SESSION['auth']);
        setcookie('login', '', time()-1);
        setcookie('password', '', time()-1);

        // Если мы пришли на логин с нуля - удаляем старую отметку back
         if (!isset($_SERVER[HTTP_REFERER])){
            unset($_SESSION['back']);
        }

    }
?>
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