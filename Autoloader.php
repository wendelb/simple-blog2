<?php

class Autoloader {

	public function __construct() {
		spl_autoload_register(array(
				$this,
				'load_class' 
		));
	}
	
	/**
	 * Special Cases where the file path doesn't very well corredpond to the Class Name
	 *
	 * @var array
	 */
	private $specialCases = array(
			'Smarty' => 'Dependencies/smarty/Smarty.class.php',
			'Captcha\\Captcha' => 'Dependencies/captcha/Captcha.php'
	);

	/**
	 * The Autoloader
	 *
	 * @param String $class_name        	
	 */
	public function load_class(String $class_name) {
		// Check for special cases
		if (isset($this->specialCases[$class_name])) {
			// We found a special case
			require_once ($this->specialCases[$class_name]);
		}
		else {
			// Regular Case or handled by another autoloader
			if ('Blog\\' === substr($class_name, 0, 5)) {
				// This is our namespace -> remove it
				$file = str_replace('Blog\\', '', $class_name);
				
				// File Name convention: Fist Letter is capital, all following are lowercase
				$file = ucwords(strtolower($file), '\\/');
				
				// Now combine that into a filename
				$file = '../' . str_replace('\\', '/', $file) . '.php';
				
				// If the file exists -> load it
				if (file_exists($file)) {
					require_once ($file);
				}
			}
		}
	}

	public static function register() {
		new Autoloader();
	}
}

// Auto-Self-Register
Autoloader::register();
