<?php
	session_start();
    
//     echo '<pre>';
// echo print_r($_SESSION);
// echo '</pre>';  

    $login = '';
    $password = '';
var_dump($_SESSION['back']);
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
            
            if (isset($_SESSION['back'])){
               $back = $_SESSION['back'];
                header("Location: $back");  
            }
            else{
               header('Location: index.php');   
            }
            exit();
        }
    }
    else{
        unset($_SESSION['auth']);
        unset($_SESSION['back']);
        setcookie('login', '', time()-1);
        setcookie('password', '', time()-1);

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