<?php

namespace Blog\Pages;

class Newpage extends Basicpage {

	private function saveArticle() {
		$article = new \Blog\Models\Article();
		
		$id = $_POST['id'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		
		if ($id === 'new') {
			// New -> Insert a new article
			$new_id = $article->newArticle($title, $content, $this->user->getUserId(), $_SERVER['REMOTE_ADDR']);
			header('Location: /?page=detail&id=' . $new_id);
		}
		else {
			// ID -> Update an existing article
			// No need for title + content
			$this->checkEditableArticle($id);
			
			$article->updateArticle($id, $title, $content);
			header('Location: /?page=detail&id=' . $id);
		}
	}

	public function render() {
		// Is logged in?
		if (!$this->user->isLoggedIn()) {
			header('Location: /?page=login');
			die();
		}
		
		// Is save request?
		if (isset($_POST['id'])) {
			$this->saveArticle();
			return;
		}
		
		// Is Edit request?
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			
			list($title, $content) = $this->checkEditableArticle($id);
		}
		else {
			$id = 'new';
			$title = '';
			$content = '';
		}
		
		$this->smarty->assign('id', $id);
		$this->smarty->assign('title', $title);
		$this->smarty->assign('content', $content);
		
		$this->smarty->display('newArticle.tpl');
	}

	/**
	 * Check whether an article is editable by the current user.
	 * Dies on error!
	 *
	 * @param int $id        	
	 */
	private function checkEditableArticle($id) {
		// Check Article-ID
		if (is_numeric($id) && ((int) $id > 0)) {
			// Valid Article-ID
			$article = new \Blog\Models\Article();
			$data = $article->getArticle($id);
			
			if ($data) {
				if ($data['author'] == $this->user->getUserId()) {
					$title = $data['title'];
					$content = $data['content'];
					
					return array(
							$title,
							$content 
					);
				}
				else {
					die("Sie haben keine Berechtigung, diesen Artikel zu bearbeiten!");
				}
			}
			else {
				// Article not found
				die("Der Artikel existiert nicht");
			}
		}
		else {
			// Invalid article id
			die("Der Artikel existiert nicht");
		}
	}
}