<?php


include_once ('function.php');

session_start();
//запомнить url текущей страницы для потенциального редиректа после авторизации
$_SESSION['back'] = $_SERVER['REQUEST_URI'];


//Проверка авторизации
$auth = is_auth();
if (!$auth){
    header('Location: login.php');
    exit(); 
}

$error = '';


if(count($_POST) > 0){

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
  
  //Проверки
    if ($title == '' ||  $content == '' ){
        $error = 'Все поля должны быть заполнены!';
    }

    elseif (mb_strlen($title) > 150){
        $error = 'Название не должно превышать 150 символов!';
    }
    

    else {
        
        //Подключение к базе данных
        $db = connect_db();

        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);

        $sql = "SELECT title FROM articles WHERE title = '$title'";
        $query = $db->prepare($sql);
        $query->execute();
        if ($query->fetch()){
                $error = 'Cтатья с таким заголовком уже существует';
        }
        else{
            $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";
            $query = $db->prepare($sql);
            $params = ['title' => $title,'content' => $content];
            $query->execute($params);

            //Если ошибок не возникло, возвращаем id добавленной статьи и переходим на нее
            if ($query->errorCode() == PDO::ERR_NONE){
                
                $id_article = $db->lastInsertId();

                header ("Location: article.php?id=$id_article");
                exit();
            }
            
            //если возникла ошибка
            else{
                $info = $query->errorInfo();
                $error = 'Произошла ошибка - попробуйте снова!';  
                file_put_contents('error.log', implode(',', $info).'\r', FILE_APPEND);
                    // echo implode('<br>', $info); 
                
            }
        }
    }
    
//Выводим ошибку в случае ее наличия
    echo "<p>$error</p>";
}

else{
    $title = '';
    $content = '';
}

  
?>
<!doctype html>
<html>
<head>
    <title>Добавление новости</title>

</head>
<body>
	<form method="post">
        Заголовок статьи<br>
        <input type="text" name="title" size="100" value = "<?=$title?>"><br>
        Текст статьи<br>
        <textarea name="content"  cols="100" rows="10" > <?=$content?></textarea><br>
		<input type="submit" value="Сохранить"><br>
	</form><hr>
    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php">Выйти</a>
</body>
</html>
