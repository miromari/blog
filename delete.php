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

    $msg = '';

    $id_article = (int)$_GET['id'];

 // если $id_article  - число
if ($id_article){

    

    //Если нажали кнопку "Да"
    if (isset($_POST['yes'])) {

        $msg =   'Нажали кнопку ДА';
        // if ($res){
        //     header ("Location: index.php");
        //     exit();  
        // } 
        // else{
        //     echo 'Не удалось удалить статью, возможно такой статьи не существует!';
        // }

    }
    
    
    elseif (isset($_POST['no'])) {

       $msg =  'Нажали кнопку НЕТ';


    }
}
echo $msg;


//  Проверка, что GET непустой и статья существует 
        
    // if($id_article != '' ){

    //     //Подключение к базе данных
    //     $db = connect_db();

    //     $sql = "DELETE FROM articles WHERE id_article = '$id_article'";
    //     $query = $db->prepare($sql);
    //     $res = $query->execute();
        
    //     if($res){
    //         header ("Location: index.php");
    //         exit();
    //     }
        




    // }else {
    //     header ("Location: index.php");
    //     exit();
    // }

    // }
?>
<!doctype html>
<html>
<head>
    <title>Удаление новости</title>

</head>
<body>
    <?if ($_SERVER[REQUEST_METHOD] == 'GET'):?>
    <form method="post">
		Вы уверены, что хотите удалить эту новость?<br>

		<input type="submit" name = "yes" value="Да">
        <input type="submit" name = "no"  value="Нет"><br>
	</form>
    <?endif?>

</body>
</html>
