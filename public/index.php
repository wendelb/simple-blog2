<?php

// Load the Autoloader. It will take care of the rest
require('../Autoloader.php');


$smarty = new \Smarty();

$framework = new \Blog\Framework();
$framework->render();

//var_dump($smarty);