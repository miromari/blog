<?php

namespace Controllers;

use Core\Tmp;

class PageController extends BaseController
{


	public function PageNotFoundAction()
	{
		header ('HTTP/1.1 404 Page Not Found');
		$this->content = Tmp::generate('Views/v_404.php');
	}
}