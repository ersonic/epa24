<?php
/**
 * @name AppVisit
 * @category Epa
 * @package Library
 * @subpackage AppVisit
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa;

class AppVisit extends AppConnection
{

    /**
     *
     * @var string
     */
    private static $_dirLogVisit = false;

    /**
     *
     * @var mixed
     */
    private static $_fileLogVisit = false;

    /**
     *
     * @var string
     */
    private static $_separatorLogVisit = '#-#';

    /**
     *
     * @var array
     */
    private static $_separators = [
        '#-#',
        '---',
        '###',
        '-#-'
    ];

    /**
     *
     * @var int
     */
    private static $_schemaVisitType = 1;

    /**
     *
     * @var array
     */
    private static $_schemaVisit = [
        1 => [
            'datetime',
            'address_ip',
            'device_connection',
            'request_method_type',
            'request_uri_protocol',
            'request_uri_module',
            'request_uri_controller',
            'request_uri_action',
            'operation_system_name',
            'operation_system_version',
            'user_agent',
            'browser_type',
            'browser_name',
            'browser_version',
            'is_authorize',
            'account',
            'user',
            'request_uri'
        ]
    ];

    /**
     *
     * @var array
     */
    private static $_paramsVisit = [];

    /**
     *
     * @name setDirLogVisit
     * @access public
     * @param string $value            
     */
    public static function setDirLogVisit($value)
    {
        self::$_dirLogVisit = $value;
    }

    /**
     *
     * @name getDirLogVisit
     * @access public
     * @return string
     */
    public static function getDirLogVisit()
    {
        return self::$_dirLogVisit;
    }

    /**
     *
     * @name setFileLogVisit
     * @access public
     * @param string $value            
     */
    public static function setFileLogVisit($value)
    {
        self::$_fileLogVisit = $value;
    }

    /**
     *
     * @name getFileLogVisit
     * @access public
     * @return mixed
     */
    public static function getFileLogVisit()
    {
        return self::$_fileLogVisit;
    }

    /**
     *
     * @name setSeparatorLogVisit
     * @access public
     * @param string $value            
     */
    public static function setSeparatorLogVisit($value)
    {
        self::$_separatorLogVisit = $value;
    }

    /**
     *
     * @name getSeparatorLogVisit
     * @access public
     * @return string
     */
    public static function getSeparatorLogVisit()
    {
        if (! in_array(self::$_separatorLogVisit, self::$_separators)) {
            self::$_separatorLogVisit = '#-#';
        }
        return self::$_separatorLogVisit;
    }

    /**
     *
     * @name setSchemaVisitType
     * @access public
     * @param int $value            
     */
    public static function setSchemaVisitType($value)
    {
        self::$_schemaVisitType = (int) $value;
    }

    /**
     *
     * @name getSchemaVisitType
     * @access public
     * @return int
     */
    public static function getSchemaVisitType()
    {
        return self::$_schemaVisitType;
    }

    /**
     *
     * @name hasParamVisit
     * @access public
     * @param string $key            
     * @return bool
     */
    private static function hasParamVisit($key)
    {
        if (isset(self::$_paramsVisit[$key])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @name getParamVisit
     * @access public
     * @param string $key            
     * @return mixed|string
     */
    public static function getParamVisit($key)
    {
        if (self::hasParamVisit($key) !== false) {
            return self::$_paramsVisit[$key];
        } else {
            return 'none';
        }
    }

    /**
     *
     * @name getAllParamsVisit
     * @access public
     * @return array
     */
    public static function getAllParamsVisit()
    {
        return self::$_paramsVisit;
    }

    /**
     *
     * @name addParamVisit
     * @access public
     * @param string $key            
     * @param string $value            
     */
    public static function addParamVisit($key, $value)
    {
        if (self::hasParamVisit($key) !== true) {
            self::$_paramsVisit[$key] = $value;
        }
    }

    /**
     *
     * @name removeParamVisit
     * @access public
     * @param string $key            
     */
    public static function removeParamVisit($key)
    {
        if (self::hasParamVisit($key) !== false) {
            unset(self::$_paramsVisit[$key]);
        }
    }

    /**
     *
     * @name check
     * @access private
     * @param string $value            
     * @return boolean
     */
    private static function check($value)
    {
        $isExist = false;
        
        if (! file_exists(self::getDirLogVisit() . self::getFileLogVisit())) {
            $fp = fopen(self::getDirLogVisit() . self::getFileLogVisit(), 'a');
            fclose($fp);
        }
        
        $matches = [];
        $contents = file_get_contents(self::getDirLogVisit() . self::getFileLogVisit());
        $pattern = preg_quote($value, '/');
        $pattern = "/^.*$pattern.*\$/m";
        
        if (preg_match_all($pattern, $contents, $matches)) {
            $isExist = true;
        }
        
        return $isExist;
    }
}