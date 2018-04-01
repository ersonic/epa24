<?php
/**
 * @name Logger
 * @category Epa
 * @package Library
 * @subpackage Logger
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa;

class Logger
{

    /**
     *
     * @var string
     */
    private static $_emailNotificationException = NULL;

    /**
     *
     * @var string
     */
    private static $_emailNotificationError = NULL;

    /**
     *
     * @name setEmailNotificationException
     * @access public
     * @return string
     */
    public static function setEmailNotificationException($value)
    {
        self::$_emailNotificationException = $value;
    }

    /**
     *
     * @name getEmailNotificationException
     * @access public
     * @return string
     */
    public static function getEmailNotificationException()
    {
        return self::$_emailNotificationException;
    }

    /**
     *
     * @name setEmailNotificationError
     * @access public
     * @return string
     */
    public static function setEmailNotificationError($value)
    {
        self::$_emailNotificationError = $value;
    }

    /**
     *
     * @name getEmailNotificationError
     * @access public
     * @return string
     */
    public static function getEmailNotificationError()
    {
        return self::$_emailNotificationError;
    }

    /**
     *
     * @name LogException
     * @access public
     * @param object $e            
     * @param string $dir            
     * @param string $message            
     */
    public static function LogException($e, $dir = NULL, $message = NULL)
    {}

    /**
     *
     * @name LogVar
     * @access public
     * @param mixed $value            
     * @return string
     */
    public static function LogVar($value)
    {
        ob_start();
        if (is_bool($value)) {
            var_dump($value);
        } else {
            print_r($value);
        }
        $paramsLog = ob_get_contents();
        ob_end_clean();
        return $paramsLog;
    }
}