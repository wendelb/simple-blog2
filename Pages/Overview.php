<?php

namespace Blog\Pages;

class Overview extends Basicpage {
	
	/**
	 * Render the page
	 */
	public function render() {
		
		$display_page = 1;
		
		// The user has chosen a specific page
		if (isset($_GET['number'])) {
			$user_page = $_GET['number'];
		
			// Gültige Seite?
			// Zahl + größer 0
			if (is_numeric($user_page) and
					((int)$user_page > 0)) {
						$display_page = $user_page;
					}
		}
		
		// Articles
		$article = new \Blog\Models\Article();
		$articles = $article->listArticles($display_page);
		$this->smarty->assign('articles', $articles);
		
		// Pagination
		$count_entries = $article->getArticleCount();
		
		$pagination = array('has_more' => false);
		if ($count_entries > ($display_page * \Blog\Config::getInstance()->maxEntries)) {
			$pagination['has_more'] = true;
			$pagination['next_link'] = '/?page=overview&number=' . ($display_page + 1);
		}
		$this->smarty->assign('pagination', $pagination);
		
		
		$this->smarty->display('overview.tpl');
	}
}