<?php

namespace Blog\Pages;

class Detail extends Basicpage {

	private function renderArticle(int $id, array $newComment = NULL) {
		
		// Fetch the article
		$article = new \Blog\Models\Article();
		$data = $article->getArticle($id);
		
		if (!$data) {
			// Did not find article
			$this->render404();
			return;
		}
		
		// The creating user may edit or delete the current article
		$edit_or_delete = false;
		if ($this->user->isLoggedIn()) {
			$edit_or_delete = ($data['author'] === $this->user->getUserId());
		}
		$this->smarty->assign('EditOrDelete', $edit_or_delete);
		$this->smarty->assign('article', $data);
		
		// Fetch the comments
		$comment = new \Blog\Models\Comment();
		$comments = $comment->getCommentsForArticle($id);
		$this->smarty->assign('comments', $comments);
		
		// To easily display the number of comments
		$comment_count = sizeof($comments);
		$this->smarty->assign('comment_count', $comment_count);
		
		// Add Comment-Feature
		if ($newComment === NULL) {
			$newComment = array(
					'error' => '',
					'name' => '',
					'mail' => '',
					'url' => '',
					'comment' => '' 
			);
		}
		$this->smarty->assign('newComment', $newComment);
		
		// Captcha
		$captcha = new \Captcha\Captcha();
		$captcha->generateCode();
		
		$this->smarty->assign('cacheBreaker', urlencode(microtime(true)));
		
		$this->smarty->display('detail.tpl');
	}

	private function addComment() {
		if (isset($_POST['article'])) {
			$id = $_POST['article'];
			
			if (!is_numeric($id)) {
				// This is not an article id
				$this->render404();
				die();
			}
			
			$article = new \Blog\Models\Article();
			$data = $article->checkArticle($id);
			
			if (!$data) {
				// The article does not exist!
				$this->render404();
			}
			
			// Now fetch all comment parameters
			if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['url']) && isset($_POST['comment']) && isset($_POST['captcha'])) {
				$name = $_POST['name'];
				$mail = $_POST['mail'];
				$url = $_POST['url'];
				$comment_text = $_POST['comment'];
				$captcha = $_POST['captcha'];
				
				// FormValidation
				// Check the Captcha
				// Name + Comment are required
				$captcha_checker = new \Captcha\Captcha();
				$error = '';
				if (!$captcha_checker->verify($captcha)) {
					$error .= 'Das Captcha war falsch<br />';
				}
				if (empty($name)) {
					$error .= 'Der Name fehlt<br />';
				}
				if (empty($comment_text)) {
					$error .= 'Die Bemerkung fehlt<br />';
				}
				
				if (!empty($error)) {
					// Display Error
					$newComment = array(
							'error' => $error,
							'name' => htmlspecialchars($name, ENT_QUOTES),
							'mail' => htmlspecialchars($mail, ENT_QUOTES),
							'url' => htmlspecialchars($url, ENT_QUOTES),
							'comment' => htmlspecialchars($comment_text, ENT_QUOTES) 
					);
					
					$this->renderArticle($id, $newComment);
				}
				else {
					// No Error -> Insert Comment into Database
					$comment = new \Blog\Models\Comment();
					$comment->addComment($id, $name, $url, $mail, $comment_text, $_SERVER['REMOTE_ADDR']);
					
					// Generate the mail
					$subject = 'Kommentar von ' . $name . ' zu ' . $article_title;
					
					$body = "Es gibt einen neuen Kommentar:\r\n" .
							"Name: " . $name . "\r\n" .
							"Mail: " . $mail . "\r\n" .
							"URL: " . $url . "\r\n" .
							"Bemerkung: " . $comment;
					
					if (!empty($data['email'])) {
						mail($data['email'], $subject, $body);
					}
					
					$this->renderArticle($id);
				}
			}
		}
	}

	public function render() {
		// Adding a comment?
		if (isset($_POST['action']) && ($_POST['action'] === 'addComment')) {
			$this->addComment();
		}
		else {
			// Figure out the correct id
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				
				// Check: Numeric + Greater 0
				if (is_numeric($id) && ((int) $id > 0)) {
					$this->renderArticle($id);
				}
				else {
					$this->render404();
				}
			}
			else {
				$this->render404();
			}
		}
	}
}