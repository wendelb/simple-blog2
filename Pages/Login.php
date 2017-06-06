<?php

namespace Blog\Pages;

class Login extends Basicpage {
	/**
	 * Do the logout
	 */
	private function logout() {
		$this->user->logout();
		
		// Now redirect to page
		header('HTTP/1.1 302 Found');
		header('Location: /');		
	}
	
	/**
	 * Login Page or do the login
	 */
	private function login() {
		if (isset($_POST['username'])) {
			// The form was submitted
			$username = $_POST['username'];
			$password = $_POST['password'];
		
			// Check the password and to the login
			$login_error = $this->user->checkPassword($username, $password);
		
			if ($login_error === null) {
				// No error -> redirect to start page
				header('HTTP/1.1 302 Found');
				header('Location: /');
			}
			else {
				// Login-Error: Show the form again
				$this->smarty->assign('loginError', $login_error);
				$this->smarty->display('login.tpl');
			}
		}
		else {
			// The form was not submitted. Display it!
			$this->smarty->assign('loginError', '');
			$this->smarty->display('login.tpl');
		}
	}
	
	public function render() {
		// Are we logging in or out?
		if ((isset($_GET['action'])) && ($_GET['action'] === 'logout')) {
			$this->logout();
		}
		else {
			$this->login();
		}
	}
}