<?php

namespace Controllers;

use Core\Validator;
use Models\ArticleModel;

class ArticleController extends BaseController
{
	
	public function indexAction()
	{
	    $articles = ArticleModel::Instance()->all();

	    if (!$articles){
	        $content = 'Возникла ошибка!';
	    } else {

	    	$this->content = $this->tmpGenerate('Views/v_index.php',[
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

	    $this->content = $this->tmpGenerate('Views/v_article.php',[
                        'id_article' => $id_article, 
                        'title' => $article['title'], 
                        'content' => $article['content'],
                        'auth' => $this->auth
                ]);
	}

	public function addAction()
	{

	   	$message = '';

	    $validator = new Validator();
	    $validator->loadRules('article_form');

	    if($this->request->isPost()){
	    //Валидация полей
	        $validator->run($this->request->getPost());

	     
	    //если ошибок нет
	        if ($validator->isValid){

				$id_article = ArticleModel::Instance()->add([
					'title' => $validator->fields['title'],
					'content' => $validator->fields['content']
					]);

				if ($id_article){
					$this->getRedirect("/article/$id_article");
				} else {
					$message = 'Произошла ошибка!';
				}
	        }
	    }
	        
	    $this->content = $this->tmpGenerate('Views/v_add.php',[
	                        'title' => $validator->fields['title'], 
	                        'content' => $validator->fields['content'],
	                        'errors' => $validator->errors,  
	                        'message' => $message
	                ]);
	}


	public function editAction()
	{
		$id_article = (int)$this->request->getGet()['id'];
	    $title = '';
	    $content = '';

	    $mArticle = ArticleModel::Instance();

	    $validator = new Validator();

	    //если нажали кнопку "Сохранить"
        if (isset($this->request->getPost()['save'])) {

	        //Валидация полей
	        $validator->loadRules('article_form')->run($this->request->getPost());

		    // Создание полей
	    	$title = $validator->fields['title'];
	    	$content = $validator->fields['content'];

			//если ошибок нет
	        if ($validator->isValid && $mArticle->edit($id_article,[
								    					'title' => $title,
														'content' => $content
										                 	 ])){
                    $this->getRedirect("/article/$id_article");
        	}
        //если пришли через GET
        } else { 

            $article = $mArticle->get($id_article);

            //Если статьи не существует
            if(empty($article)){
				$this->get404(); 
            } 

			$title = $article['title'];
			$content = $article['content'];        
            
        }

    	$this->content = $this->tmpGenerate('Views/v_edit.php',[
                        'id_article' => $id_article, 
                        'title' => $title, 
                        'content' => $content,  
	                    'errors' => $validator->errors,  
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

        $this->content = $this->tmpGenerate('Views/v_delete.php',[
                        'message' => $message
                ]);      
	}

}