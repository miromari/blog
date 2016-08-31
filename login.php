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
            // можем кунить куку? login pass

            if ( $_POST['remember'] == 'on'  ){
                setcookie('login', $login, time() + 3600 * 24 * 7);
                setcookie('password', $password, time() + 3600 * 24 * 7);
            } 
            
            header('Location: index.php');
            exit();
        }
    }
    else{
        unset($_SESSION['auth']);
        setcookie('login', $login, time()-1);
        setcookie('password', $password, time()-1);
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
        	<input type="submit" value="Войти">
        </form>
    </body>
</html>