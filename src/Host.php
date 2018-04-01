<?php
/**
 * @name Host
 * @category Epa
 * @package Library
 * @subpackage Host
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa;

class Host
{

    /**
     *
     * @name getHostProtocol
     * @access public
     * @return string
     */
    public static function getHostProtocol()
    {
        return isset($_SERVER['HTTPS']) ? 'https' : 'http';
    }

    /**
     *
     * @name getHost
     * @access public
     * @return string
     */
    public static function getHost()
    {
        $server = $_SERVER['HTTP_HOST'];
        $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        return self::getHostProtocol() . '://' . $server . $path;
    }

    /**
     *
     * @name isSsl
     * @access public
     * @return boolean
     */
    public static function isSsl()
    {
        if (isset($_SERVER['HTTPS'])) {
            return true;
        }
        return false;
    }

    /**
     *
     * @name getHostTld
     * @access public
     * @return string
     */
    public static function getHostTld()
    {
        $_host = explode('.', self::getHost());
        if (is_array($_host)) {
            if (sizeof($_host) > 1) {
                return trim(str_replace('/', '', end($_host)));
            }
        }
        return 'localhost';
    }

    /**
     *
     * @name IsOnline
     * @access public
     * @param string $value            
     * @return bool
     */
    public static function IsOnline($value)
    {
        if (! parse_url($value)) {
            return false;
        }
    }
}
