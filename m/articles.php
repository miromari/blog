<?php


//Получение всех статей
function articles_all($db)
{
    $sql = "SELECT id_article, title, content FROM articles ORDER BY date_edit DESC";
    $query = $db->prepare($sql);
    $res = $query->execute();

    if (!$res){
        db_error_log($query);
        return false;  
    }
    else{
        $articles = $query->fetchAll();
        return $articles;
    }
}

// Получение одной статьи
function article_get($id_article, $db)
{

     $sql = "SELECT * FROM articles WHERE id_article = '$id_article'";
    $query = $db->prepare($sql);
    $res = $query->execute();
    
    if (!$res){
        db_error_log($query);
        return false;  
    }
    else{
        $article = $query->fetch();
        return $article;
    }

}

//Валидация полей, поиск ошибок
function validation_error($title, $content)

{
    $error = false;

     if ($title == '' ||  $content == '' ){
        $error = 'Все поля должны быть заполнены!';
    }

    elseif (mb_strlen($title) > 150){
        $error = 'Название не должно превышать 150 символов!';
    }
    
    return $error;

}
//Добавление статьи
function article_add($title, $content, $db)
{
    $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";
    $params = ['title' => $title, 'content' => $content];
    $query = $db->prepare($sql);
    $res = $query->execute($params);

    if (!$res){
        db_error_log($query);
        return false;  
    }
    else{
        return $db->lastInsertId();
    }

}

//Редактирование статьи
function article_edit($id_article, $title, $content, $db)
{
    $sql = "UPDATE articles SET title =:title, content =:content WHERE id_article =:id_article";
    $params = ['title' => $title,'content' => $content,'id_article' => $id_article];
    $query = $db->prepare($sql);
    $res = $query->execute($params);

    if (!$res) {
        db_error_log($query);
        return false;
    }else{
        return true;
    }
}

//Удаление статьи
function article_delete($id_article, $db)
{
    $sql = "DELETE FROM articles WHERE id_article =:id_article";
    $params = ['id_article' => $id_article];
    $query = $db->prepare($sql);
    $res = $query->execute($params);

    if (!$res) {
        db_error_log($query);
        return false;
    }else{
        return true;
    }

}