<?php

namespace Controllers;

use Core\Tmp;
use Models\ArticleModel;

class ArticleController extends BaseController
{
	
	public function indexAction()
	{
	    $articles = ArticleModel::Instance()->all();

	    if (!$articles){
	        $content = 'Возникла ошибка!';
	    } else {

	    	$this->content = Tmp::generate('Views/v_index.php',[
	                        'articles' => $articles         
	     ]);
		}
	}

	public function oneAction()
	{

		$id_article = (int)$this->request->getGet()['id'];

		if(!$id_article){
			$this->get404(); 
		}
    
        $article = ArticleModel::Instance()->get($id_article);
        
        //Если такой статьи нет
        if(!$article){
			$this->get404(); 
        }

	    $this->content = Tmp::generate('Views/v_article.php',[
                        'id_article' => $id_article, 
                        'title' => $article['title'], 
                        'content' => $article['content'],
                        'auth' => $this->auth
                ]);
	}

	public function addAction()
	{
		$error = [];
	    $title = '';
	    $content = '';
	   	$message = '';

	    if(count($this->request->getPost()) > 0){

	    //Обработка полей
	        $title = trim (htmlspecialchars ($this->request->getPost()['title']));
	        $content = trim (htmlspecialchars ($this->request->getPost()['content']));


	    //Валидация полей
	        $mArticle = ArticleModel::Instance();
	        $error = $mArticle->validate($title, $content);
	     
	    //если ошибок нет
	        if (empty($error)){
				$id_article = $mArticle->add(['title' => "$title", 'content' => "$content"]);

				if ($id_article){
					header ("Location: article?id=$id_article");
					exit();
				} else {
					$message = 'Произошла ошибка!';
				}
	        }
	    }
	        
	    $this->content = Tmp::generate('Views/v_add.php',[
	                        'title' => $title, 
	                        'content' => $content,
	                        'error' => $error,  
	                        'message' => $message
	                ]);
	}


	public function editAction()
	{
		$id_article = (int)$this->request->getGet()['id'];
	    $error = [];
	    $message = '';
	   	$title = '';
	    $content = '';

	    $mArticle = ArticleModel::Instance();
	 
	        //если нажали кнопку "Сохранить"
        if (isset($this->request->getPost()['save'])) {

            //Обработка полей
            $title = trim (htmlspecialchars ($this->request->getPost()['title']));
            $content = trim (htmlspecialchars ($this->request->getPost()['content']));

        //Валидация полей
            $error = $mArticle->validate($title, $content);

        //если ошибок нет
            if (empty($error)){
                 if($mArticle->edit($id_article,['title' => "$title", 'content' => "$content"])){
                    header ("Location: article?id=$id_article");
                    exit();
                 } else {                  
                    $message = 'Произошла ошибка!';  
                }
            }
        } else { 

            $article = $mArticle->get($id_article);

            //Если статьи не существует
            if(empty($article)){
                $message = 'Такой статьи не существует';
            }          
            $title = $article['title'];
            $content = $article['content'];
        }

    	$this->content = Tmp::generate('Views/v_edit.php',[
                        'id_article' => $id_article, 
                        'title' => $title, 
                        'content' => $content,  
                        'error' => $error,  
                        'message' => $message
                ]);
	}

	public function deleteAction()
	{
		$id_article = (int)$this->request->getGet()['id'];

		$message = '';
		
		if (isset($this->request->getPost()['delete']) && 
            ArticleModel::Instance()->delete($id_article)){

            $message = 'Статья успешно удалена'; 
        } else {
        	$message ='Произошла ошибка';
        }

        $this->content = Tmp::generate('Views/v_delete.php',[
                        'message' => $message
                ]);      
	}

}