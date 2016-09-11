<?php
    include_once ('function.php');

    session_start();
    //запомнить url текущей страницы для потенциального редиректа после авторизации
    $_SESSION['back'] = $_SERVER[REQUEST_URI];
    
 //Проверка авторизации
    $auth = is_auth();
    if (!$auth){
        header('Location: login.php');
        exit(); 
    }

//Подключение к базе данных
    $db = connect_db(); 


    $id_article = (int)$_GET['id'];

    $error = '';

    if(count($_POST) > 0){
 
        //если нажали кнопку "Сохранить"
        if (isset($_POST['save'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            // проверки
            if ($title == '' ||  $content == '' ){
                $error = 'Все поля должны быть заполнены!';
            }

            elseif (mb_strlen($title) > 150){
                $error = 'Название не должно превышать 150 символов!';
            }
            
            // добавить проверку на уникальность названия
            // elseif (){
            // }

            else{


                $content = htmlspecialchars($content);
                $title = htmlspecialchars($title);


                $sql = "UPDATE articles SET title =:title, content =:content WHERE id_article =:id_article";

                $query = $db->prepare($sql);
                $params = ['title' => $title,'content' => $content, 'id_article' => $id_article];
                $res = $query->execute($params);
                
                if ($res){

                    header ("Location: article.php?id=$id_article");
                    exit();
                }
                else{
                    echo 'Произошла ошибка!';
                }
            }
        }
        
    //Если нажали кнопку "Удалить"
        elseif (isset($_POST['delete'])) {

            if ($id_article > 0){
                
                $sql = "DELETE FROM articles WHERE id_article = '$id_article'";
                $query = $db->prepare($sql);
                $res = $query->execute();
                
                if ($res){
                    header ("Location: index.php");
                    exit();
                }
                else{
                    $error =  'Такой статьи не существует!';  
                }

            } 
            else{
                $error =  'Такой статьи не существует!';
            }
        }
       
        //Выводим ошибку в случае ее наличия
        echo "<p>$error</p>";
    
    }
    else{

//  Проверка, что GET число
        if($id_article > 0){


            $sql = "SELECT title, content FROM articles WHERE id_article = '$id_article'";
            $query = $db->prepare($sql);
            $res = $query->execute();
            $article = $query->fetch();

            //Если  статьи не существует
            if(empty($article)){
                header ("Location: index.php");
                exit();
            }          
            $title = $article['title'];
            $content = $article['content'];
        }
        else {
            header ("Location: index.php");
            exit();
        }
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
		<input type="text" name="title" size="100" value = "<? echo $title ?>"><br>
		Текст статьи<br>
		<textarea name="content"  cols="100" rows="10" > <? echo $content ?></textarea><br>
		<input type="submit" name = "save" value="Сохранить">
        <input type="submit" name = "delete"  value="Удалить"><br>
	</form><hr>
    <a href = "index.php">К списку новостей</a><br>
    <a href="login.php">Выйти</a>
</body>
</html>
