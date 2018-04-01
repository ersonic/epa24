<?php
/**
 * @name Server
 * @category Epa
 * @package Library
 * @subpackage Server
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa\Tools;

class Server
{

    /**
     *
     * @name isExistExtension
     * @access public
     * @param string $name            
     * @return boolean
     */
    public static function isExistExtension($name)
    {
        if (preg_match('/^[a-zA-z0-9\_\-\.\ ]{2,128}$/i', $name)) {
            if (extension_loaded($name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}