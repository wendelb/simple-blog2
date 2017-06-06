<?php

namespace Blog\Models;

class Comment {
	/**
	 * Database Connection
	 *
	 * @var \Blog\Database
	 */
	private $db;

	function __construct() {
		// Fetch the database connection
		$this->db = \Blog\Database::getInstance();
	}

	/**
	 * Get all Comments for the specified article
	 *
	 * @param int $article        	
	 * @return array
	 */
	public function getCommentsForArticle(int $article) {
		$sql = <<<'EOT'
 			SELECT name, url, DATE_FORMAT(`date`, '%d.%m.%Y um %H:%i') as `date`, comment
 			FROM comment
 			WHERE article = :article
 			ORDER BY `date` DESC
EOT;
		
		$sth = $this->db->prepare($sql);
		$sth->bindValue(':article', $article);
		$sth->execute();
		
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Insert a comment into the database
	 *
	 * @param int $article
	 *        	The article
	 * @param String $name
	 *        	Name (required)
	 * @param String $url
	 *        	URL
	 * @param String $mail
	 *        	Mail
	 * @param String $comment
	 *        	Comment (required)
	 * @param String $ip
	 *        	IP (required)
	 */
	public function addComment(int $article, String $name, String $url, String $mail, String $comment, String $ip) {
		$sql = <<<'EOT'
		INSERT INTO `comment`(`article`, `date`, `name`, `url`, `mail`, `ip`, `comment`) 
		VALUES (:article, now(), :name, :url, :mail, :ip, :comment);
EOT;
		
		if (empty($name) || empty($comment) || empty($ip)) {
			throw new \Exception('Missing parameters');
		}
		
		$sth = \Blog\Database::getInstance()->prepare($sql);
		$sth->bindValue(':article', $article);
		$sth->bindValue(':name', $name);
		$sth->bindValue(':url', $url);
		$sth->bindValue(':mail', $mail);
		$sth->bindValue(':comment', $comment);
		$sth->bindValue(':ip', $ip);
		
		return $sth->execute();
	}
}
