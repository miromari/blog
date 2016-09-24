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
function validate($title, $content)

{
    $error = [];

    if ($title == ''){
        $error['title'] = 'Поле не должно быть пустым!';
    }
    elseif (mb_strlen($title) < 5){
        $error['title']  = 'Слишком короткое название!';
    }

    elseif (mb_strlen($title) > 150){
         $error['title'] = 'Название не должно превышать 150 символов!';
    }

    if ($content == '' ){
        $error['content'] = 'Поле не должно быть пустым!';
    }
    elseif (mb_strlen($content) < 10){
        $error['content']  = 'Минимальная длина текста - 100 символов!';
    }

    elseif (mb_strlen($content) > 65535){
         $error['content'] = 'Текст не должен превышать 65535 символов!';
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