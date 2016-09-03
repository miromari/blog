<?php
include_once ('function.php');

session_start();

//Проверка авторизации
if (!is_auth()){
    // $_SESSION['back'] = $_SERVER[REQUEST_URI];
    header('Location: login.php');
    exit(); 
}

$error = '';

if(count($_POST) > 0){
 
$fname = $_GET['f'];

//если нажали кнопку "Сохранить"
    if (isset($_POST['save'])) {

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        // проверка на то, что поля не пустые
        if ($title == '' ||  $content == '' ){
            $error = 'Все поля должны быть заполнены!';
        }

        //проверка на то, что название состоит из цифр
        elseif (!ctype_digit($title)){
            $error = 'Название должно содержать только цифры!';
        }
        //проверка на то, что название уникально в случае, если оно изменено
        elseif ($title != $fname && file_exists("data/$title") ){
            $error = 'Такое название уже есть!';
        }

        else{
            //если название поменялось, удаляем старый файл
            if($title != $fname){
                unlink("data/$fname");
                }
            // Сохраняем контент и выходим
            file_put_contents("data/$title", $content);
            header ("Location: article.php?f=$title");
            exit();   
        }

        //Выводим ошибку
        echo "<p>$error</p>";

    }
    
//Если нажали кнопку "Удалить"
    elseif (isset($_POST['delete'])) {
        unlink("data/$fname");
        header ("Location: index.php");
        exit(); 
    }
    
}

else{
    $fname = $_GET['f'];
    $title = $fname;
    $content = file_get_contents("data/$fname");

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
		<input type="text" name="title" size="42" value = "<? echo $title ?>"><br>
		Содержимое файла<br>
		<textarea name="content"  cols="40" rows="10" > <? echo $content ?></textarea><br>
		<input type="submit" name = "save" value="Сохранить">
        <input type="submit" name = "delete"  value="Удалить"><br>
	</form><hr>

    <a href="login.php">Выйти</a>
</body>
</html>
