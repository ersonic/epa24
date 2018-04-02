<?php
/**
 * @filesource index.phtml
 * @category Application
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
use Epa\Tools\Developer;
// Composer autoloading
include  '../vendor/autoload.php';
Developer::arrayToYaml($data, $output);