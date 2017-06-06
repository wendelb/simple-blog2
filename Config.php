<?php

namespace Blog;

class Config {
	/**
	 * Singleton-Instanz
	 * 
	 * @var Config
	 */
	protected static $_instance = null;

	/**
	 * Get the Config-Object
	 * 
	 * @return Config
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

	protected function __construct() {
	}
	
	/**
	 * An Array with all the options
	 * 
	 * @var Array
	 */
	protected $options = array(
			// DB-Options
			'DBUsername' => 'blog',
			'DBPassword' => 'IiPvbQ1YEWxh3aCl',
			'DBConnectionString' => 'mysql:host=localhost;dbname=blog',
			
			// Blog-Options
			'title' => 'A Simple Blog',
			'subtitle' => 'Some general ideas on special topics',
			'maxEntries' => 3
	);

	/**
	 *
	 * @return String
	 */
	public function __get($key) {
		return $this->options[$key];
	}
}
