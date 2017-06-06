<?php

namespace Blog\Models;

class Author {
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
	 * List Authors for imprint
	 *
	 * @return array
	 */
	public function listAuthors(): array {
		
		// Fetch Authors
		$sth = $this->db->query('SELECT fullName, address FROM author');
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}