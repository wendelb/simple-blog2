<?php

namespace Blog\Pages;

class Imprint extends Basicpage {

	public function render() {
		$author = new \Blog\Models\Author();
		$list = $author->listAuthors();
		
		// Format address
		foreach($list as &$item) {
			$item['address'] = nl2br(htmlspecialchars($item['address'], ENT_QUOTES));
		}
		
		$this->smarty->assign('authors', $list);
		
		// Render!
		$this->smarty->display('imprint.tpl');
	}
}