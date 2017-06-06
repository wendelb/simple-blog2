<?php

namespace Blog\Pages;

abstract class Basicpage {
	/**
	 * @var \Smarty;
	 */
	protected $smarty;
	
	/**
	 * The User Model
	 * @var \Blog\Models\User
	 */
	protected $user;
	
	function __construct() {
		// Create the Smarty Instance
		$this->smarty = new \Smarty();
		$this->smarty->setTemplateDir('../Templates');
		$this->smarty->setCompileDir('../Templates/compiled');
		
		// Set the always defined Layout Variables
		$this->smarty->assign('html_title', \Blog\Config::getInstance()->title);
		$this->smarty->assign('subtitle', \Blog\Config::getInstance()->subtitle);
		
		// Now the user
		$this->user = new \Blog\Models\User();
		$this->smarty->assign('loggedin', $this->user->isLoggedIn());
	}
	
	abstract public function render();
	
	/**
	 * Render a HTTP 404 Error 
	 */
	protected function render404() {
		header('HTTP/1.0 404 Not Found', true, 404);
		$this->smarty->display('404.tpl');
	}
}