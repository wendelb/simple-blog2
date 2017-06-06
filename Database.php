<?php

namespace Blog;

class Database {
	/**
	 * Singleton-Instanz
	 * 
	 * @var \Blog\Database
	 */
	protected static $_instance = null;

	/**
	 * Get the Database-Object
	 * 
	 * @return \Blog\Database
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	// Disable Cloning and external Construction
	protected function __clone() {
	}
	
	/**
	 *
	 * @var \PDO
	 */
	private $dbh;

	protected function __construct() {
		$config = Config::getInstance();
		$this->dbh = new \PDO($config->DBConnectionString, $config->DBUsername, $config->DBPassword);
	}

	/**
	 * Prepares an SQL Statement
	 *
	 * @param String $sql
	 *        	The SQL Text to be prepared
	 * @return \PDOStatement
	 */
	public function prepare(String $sql) {
		return $this->dbh->prepare($sql);
	}
	
	/**
	 * Query an SQL Statement
	 * @param String $sql
	 * @return \PDOStatement
	 */
	public function query(String $sql) {
		return $this->dbh->query($sql);	
	}
	
	/**
	 * Returns the ID of the last inserted row or sequence value
	 * @return int
	 */
	public function lastInsertId() {
		return $this->dbh->lastInsertId();
	}
}