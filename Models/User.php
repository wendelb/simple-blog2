<?php

namespace Blog\Models;

class User {
	/**
	 * Is the current request from a logged in user?
	 * @return boolean
	 */
	public function isLoggedIn() {
		// The userid is only set when logged in!
		return isset($_SESSION['userid']);
	}
	
	/**
	 * 
	 * @param String $username
	 * @param String $password
	 * @return String The error message
	 */
	public function checkPassword(String $username, String $password) {
		
		// Fetch the user with the correct username
		$sth = \Blog\Database::getInstance()->prepare('SELECT id, username, password FROM author WHERE `username` = :username LIMIT 1');
		$sth->bindValue(':username', $username);
		$sth->execute();
		
		// Is the username correct?
		if ($sth->rowCount() === 1) {
			$row = $sth->fetch(\PDO::FETCH_ASSOC);
			if (password_verify($password, $row['password'])) {
				// Login successfull
				$_SESSION['username'] = $row['username'];
				$_SESSION['userid'] = $row['id'];
		
				return null;
			}
			else {
				// Password wrong
				return 'Benutzername/Passwort falsch!';
			}
		}
		else {
			// There was no user with that username
			return 'Benutzername/Passwort falsch!';
		}
		
		return 'You should never see this!';
	}
	
	/**
	 * Get the current user id
	 * @return int
	 */
	public function getUserId() {
		return $_SESSION['userid'];
	}
	
	/**
	 * Do the logout
	 */
	public function logout() {
		session_unset();
		session_destroy();
	}
}