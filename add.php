<?php

include_once ('function.php');

// Проверка авторизации
is_loggedIn();

if(count($_POST) > 0){

    //Проверки, что поля заполнены, название  - уникальное и состоит из цифр
    //!!!Добавить проверку/обработку на запрещенные символы

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $error = '';

    if ($title == '' ||  $content == '' ){
        $error = 'Все поля должны быть заполнены!';
    }

    elseif (!ctype_digit($title)){
        $error = 'Название должно содержать только цифры!';
    }

    elseif (file_exists("data/$title") ){
        $error = 'Такое название уже есть!';
    }

    else {
        file_put_contents("data/$title", $content);
        header ("Location: index.php");
        exit();
    }
    echo "<p>$error</p>";
}

else{
    $title = '';
    $content = '';
    $error = '';
}

  
?>
<!doctype html>
<html>
<head>
    <title>Добавление новости</title>

</head>
<body>
	<form method="post">
		Название файла<br>
		<input type="text" name="title" value = "<? echo $title ?>"><br>
		Содержимое файла<br>
		<textarea name="content"> <? echo $content ?></textarea><br>
		<input type="submit" value="Сохранить"><br>
	</form><hr>

    <a href="login.php">Выйти</a>
</body>
</html>
