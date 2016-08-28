<?php

if(count($_POST) > 0){

    $fname = $_GET['f'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

// проверка, что поля не пустые
    if ($title == '' ||  $content == '' ){
        $error = 'Все поля должны быть заполнены!';
    }
// проверка, поменялось ли название файла
    elseif($title != $fname){

    //проверки, что название состоит из цифр и уникально
        if (!ctype_digit($title)){
            $error = 'Название должно содержать только цифры!';
        }

        elseif (file_exists("data/$title") ){
            $error = 'Такое название уже есть!';
        }
    // переименовываем файл и сохраняем контент
        else{
            rename("data/$fname","data/$title");
            file_put_contents("data/$title", $content);
            header ("Location: index.php");
            exit();
        }
    }
    // если название не поменялось, сразу сохраняем контент
    else{

        file_put_contents("data/$title", $content);
        header ("Location: index.php");
        exit();
    }

    //Выводии ошибку
    echo "<p>$error</p>";

}

else{
    $fname = $_GET['f'];
    $title = $fname;
    $content = file_get_contents("data/$fname");
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
	</form>
</body>
</html>
