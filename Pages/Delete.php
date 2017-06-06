<?php

namespace Blog\Pages;

class Delete extends Basicpage {
	private function deleteArticle(int $id) {
		// Check if the current user is the creator -> allow deletion
		$article = new \Blog\Models\Article();
		$data = $article->checkArticle($id);
		
		if (!$data) {
			// Article does not exist
			$this->render404();
		}
		else {
			// Article does exist
			if ($data['author'] == $this->user->getUserId()) {
				// User is Author -> Delete
				$article->deleteArticle($id);
				
				// Redirect to Index
				header('Location: /');
			}
			else {
				die("Sie haben nicht die Berechtigung, diese Aktion auszuführen!");
			}
		}
	}
	
	public function render() {
		// Is logged in?
		if (!$this->user->isLoggedIn()) {
			header('Location: /?page=login');
			die();
		}
		
		// If a valid id is supplied, then take that and delete the article, if possible
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			
			if (is_numeric($id) && ((int)$id > 0)) {
				$this->deleteArticle($id);
			}
			else {
				// Not a valid article identifier
				header('Location: /');
			}
		}
		else {
			// No id given -> back to start page
			header('Location: /');
		}
		
		
	}
}