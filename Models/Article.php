<?php

namespace Blog\Models;

class Article {
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
	 * Fetches a list of all articles
	 *
	 * @param int $page        	
	 * @return array
	 */
	public function listArticles(int $page) {
		// Calculate Limit and Offset
		$limit = \Blog\Config::getInstance()->maxEntries;
		$offset = ($page - 1) * $limit;
		
		$sql = <<<EOT
		SELECT 
			`article`.`id`,
			`article`.`title`,
			CASE 
				WHEN `created` = curdate()
				THEN 'Heute'
				ELSE DATE_FORMAT(`created`, '%d.%m.%Y')
			END as `created`,
			CASE 
				WHEN LENGTH(`content`) > 1000
				THEN CONCAT(SUBSTRING(`content`, 1, 1000), '...')
				ELSE `content`
			END as `content`,
			(LENGTH(`content`) > 1000) as there_is_more,
			`author`.`fullName` as author_name,
			`author`.`id` as author_id,
			COALESCE(ac.`count`, 0) as comment_count
		FROM `article`
		INNER JOIN `author` ON `author`.`id` = `article`.`author`
		LEFT OUTER JOIN `article_comments` ac on ac.`article` = `article`.`id`
		ORDER BY `created` DESC
		LIMIT $limit OFFSET $offset
EOT;
		
		$sth = $this->db->query($sql);
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Fetches a list of all articles by the specified author
	 *
	 * @param int $author        	
	 * @param int $page        	
	 * @return array
	 */
	public function listAuthorArticles(int $author, int $page) {
		// Calculate Limit and Offset
		$limit = \Blog\Config::getInstance()->maxEntries;
		$offset = ($page - 1) * $limit;
		
		$sql = <<<EOT
		SELECT 
			`article`.`id`,
			`article`.`title`,
			CASE 
				WHEN `created` = curdate()
				THEN 'Heute'
				ELSE DATE_FORMAT(`created`, '%d.%m.%Y')
			END as `created`,
			CASE 
				WHEN LENGTH(`content`) > 1000
				THEN CONCAT(SUBSTRING(`content`, 1, 1000), '...')
				ELSE `content`
			END as `content`,
			(LENGTH(`content`) > 1000) as there_is_more,
			`author`.`fullName` as author_name,
			`author`.`id` as author_id,
			COALESCE(ac.`count`, 0) as comment_count
		FROM `article`
		INNER JOIN `author` ON `author`.`id` = `article`.`author`
		LEFT OUTER JOIN `article_comments` ac on ac.`article` = `article`.`id`
		WHERE
			`article`.`author` = :author
		ORDER BY `created` DESC
		LIMIT $limit OFFSET $offset
EOT;
		
		$sth = $this->db->prepare($sql);
		$sth->bindValue(':author', $author);
		$sth->execute();
		
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *
	 * @param int $author        	
	 * @return int
	 */
	public function getArticleCount(int $author = NULL) {
		$sql = 'SELECT COUNT(*) as `count` FROM `article`';
		if ($author !== null) {
			$sql .= ' WHERE `author` = :author';
		}
		
		$sth = $this->db->prepare($sql);
		
		if ($author !== null) {
			$sth->bindValue(':author', $author);
		}
		
		$sth->execute();
		
		$row = $sth->fetch(\PDO::FETCH_ASSOC);
		return $row['count'];
	}

	/**
	 * Fetches the specified article
	 *
	 * @param int $id        	
	 * @return array
	 */
	public function getArticle(int $id) {
		$sql = <<<'EOT'
			SELECT `article`.`id`, `article`.`title`, DATE_FORMAT(`created`, '%d.%m.%Y') as `created`, `content`, `ip`, `author`.`fullName`, `article`.`author`
			FROM `article`
			INNER JOIN `author` ON `author`.`id` = `article`.`author`
			WHERE `article`.`id` = :id
EOT;
		
		$sth = $this->db->prepare($sql);
		$sth->bindValue(":id", $id);
		$sth->execute();
		
		$row = $sth->fetch(\PDO::FETCH_ASSOC);
		return $row;
	}

	/**
	 * Checks whether an article exists and returns some details like Title or Authers Mail Address
	 *
	 * @param int $id        	
	 * @return boolean|array
	 */
	public function checkArticle(int $article) {
		$sql = <<<EOT
			SELECT article.author, article.title, author.email 
			FROM article 
			INNER JOIN author ON author.id = article.author
			WHERE 
				article.id = :article
EOT;
		
		$sth = $this->db->prepare($sql);
		$sth->bindValue(':article', $article);
		$sth->execute();
		
		if ($sth->rowCount() === 0) {
			return false;
		}
		
		return $sth->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * Delete an article
	 * 
	 * @param int $id        	
	 */
	public function deleteArticle(int $id) {
		$sql = 'DELETE FROM `article` WHERE id = :id';
		
		$sth = $this->db->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();
	}

	/**
	 * Creates a new article
	 *
	 * @param String $title        	
	 * @param String $content        	
	 * @param int $userId        	
	 * @param String $IP        	
	 * @return int The new article id
	 */
	public function newArticle(String $title, String $content, int $userId, String $IP) {
		$sql = <<<'EOT'
				INSERT INTO `article`(`author`, `title`, `created`, `content`, `ip`)
				VALUES (:userid, :title, CURDATE(), :content, :ip)
EOT;
		
		$sth = \Blog\Database::getInstance()->prepare($sql);
		$sth->bindValue(':userid', $userId);
		$sth->bindValue(':title', $title);
		$sth->bindValue(':content', $content);
		$sth->bindValue(':ip', $IP);
		
		$sth->execute();
		
		return \Blog\Database::getInstance()->lastInsertId();
	}

	/**
	 * Update an existing article
	 *
	 * @param int $id
	 *        	The Article ID
	 * @param String $title
	 *        	The new title
	 * @param String $content
	 *        	The new content
	 */
	public function updateArticle(int $id, String $title, String $content) {
		$sql = <<<'EOT'
			UPDATE `article` SET `title` = :title, `content` = :content
			WHERE `id` = :id			
EOT;
		
		$sth = $this->db->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->bindValue(':title', $title);
		$sth->bindValue(':content', $content);
		
		$sth->execute();
	}
}