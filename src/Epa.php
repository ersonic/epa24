<?php
/**
 * @name Developer
 * @category Epa
 * @package Library
 * @subpackage Epa
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2017 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa;

class Epa
{

    /**
     *
     * @var string
     */
    private static $_version = '4.3.0';

    /**
     *
     * @var string
     */
    private static $_versionInfo = 'Ersonic Platform Application';

    /**
     *
     * @var array
     */
    private static $_registry = [];

    /**
     *
     * @name getVersion
     * @access public
     * @return string
     */
    public static function getVersion()
    {
        return self::$_version;
    }

    /**
     *
     * @name getVersionInfo
     * @access public
     * @return string
     */
    public static function getVersionInfo()
    {
        return self::$_versionInfo . ' ' . self::$_version;
    }

    /**
     *
     * @name register
     * @access public
     * @param string $key            
     * @param mixed $value            
     */
    public static function register($key, $value)
    {
        if (! isset(self::$_registry[$key])) {
            self::$_registry[$key] = serialize($value);
        }
    }

    /**
     *
     * @name unregister
     * @access public
     * @param string $key            
     */
    public static function unregister($key)
    {
        if (isset(self::$_registry[$key])) {
            if (is_object(self::$_registry[$key])) {
                self::$_registry[$key]->__destruct();
            }
            unset(self::$_registry[$key]);
        }
    }

    /**
     *
     * @name registry
     * @access public
     * @param string $key            
     * @return array NULL
     */
    public static function registry($key)
    {
        if (isset(self::$_registry[$key])) {
            return unserialize(self::$_registry[$key]);
        }
        return null;
    }

    /**
     *
     * @name registryAll
     * @access public
     * @return array NULL
     */
    public static function registryAll()
    {
        if (sizeof(self::$_registry)) {
            return self::$_registry;
        }
        return null;
    }
}