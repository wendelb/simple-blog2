<?php

namespace Blog;

class Framework {
	/**
	 * The Database Connection
	 * 
	 * @var \Blog\Database
	 */
	private $db;

	function __construct() {
		// Start the session
		session_start();
		
		$this->db = \Blog\Database::getInstance();
	}

	public function render() {
		
		// Get the needed page
		if (isset($_REQUEST['page'])) {
			$page = ucfirst($_REQUEST['page']);
		}
		else {
			$page = 'Overview';
		}
		
		$class = 'Blog\\Pages\\' . $page;
		$object = new $class();
		
		//$article = new \Blog\Models\Article();
		//var_dump($article->listArticles(1));
//		$page = new \Blog\Pages\Overview();
		$object->render();
	}
}