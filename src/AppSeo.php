<?php
/**
 * @name AppSeo
 * @category Epa
 * @package Library
 * @subpackage AppSeo
 * @version 4.3.0
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa;

class AppSeo
{

    /**
     *
     * @var array
     */
    private static $_seoParams = [];

    /**
     *
     * @var string
     */
    private static $_seoLocale = 'pl_PL';

    /**
     *
     * @var string
     */
    private static $_seoDirPath;

    /**
     *
     * @var string
     */
    private static $_seoHash;

    /**
     *
     * @var string
     */
    private static $_seoTitle = 'Application Skeleton';

    /**
     *
     * @var string
     */
    private static $_seoKeywords = 'CMS, Application, PHP, CRM, Pages';

    /**
     *
     * @var string
     */
    private static $_seoDescription = 'Application Skeleton';

    /**
     *
     * @name setSeoLocale
     * @access public
     * @param string $value
     * @return string
     */
    public static function setSeoLocale($value)
    {
        return self::$_seoLocale;
    }

    /**
     *
     * @name getSeoLocale
     * @access public
     * @return string
     */
    public static function getSeoLocale()
    {
        return self::$_seoLocale;
    }

    /**
     *
     * @param string $key
     * @param string $value
     * @return array
     */
    public static function addSeoParam($key, $value)
    {
        return self::$_seoParams[$key] = $value;
    }

    /**
     *
     * @name getSeoParam
     * @access public
     * @param string $key
     * @return string
     */
    public static function getSeoParam($key)
    {
        if (self::hasSeoParam($key)) {
            return self::$_seoParams[$key];
        } else {
            return '';
        }
    }

    /**
     *
     * @param unknown $value
     * @return unknown
     */
    public function setSeoDirPath($value)
    {
        return self::$_seoDirPath = $value;
    }

    /**
     *
     * @name getSeoDirPath
     * @access public
     * @return string
     */
    public function getSeoDirPath()
    {
        return self::$_seoDirPath;
    }

    /**
     *
     * @name hasSeoParam
     * @access public
     * @param string $key
     * @return boolean
     */
    public static function hasSeoParam($key)
    {
        if (isset(self::$_seoParams[$key])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @name getSeoParams
     * @access public
     * @return array
     */
    public static function getSeoParams()
    {
        return self::$_seoParams;
    }

    /**
     *
     * @name setSeoTitle
     * @access public
     * @param string $value
     */
    public static function setSeoTitle($value)
    {
        return self::$_seoTitle = $value;
    }

    /**
     *
     * @name getSeoTitle
     * @access public
     * @return string
     */
    public static function getSeoTitle()
    {
        return self::$_seoTitle;
    }

    /**
     *
     * @name setSeoKeywords
     * @access public
     * @param string $value
     */
    public static function setSeoKeywords($value)
    {
        return self::$_seoKeywords = $value;
    }

    /**
     *
     * @name getSeoKeywords
     * @access public
     * @return string
     */
    public static function getSeoKeywords()
    {
        return self::$_seoKeywords;
    }

    /**
     *
     * @name setSeoDescription
     * @access public
     * @return string
     */
    public static function setSeoDescription($value)
    {
        return self::$_seoDescription = $value;
    }

    /**
     *
     * @name getSeoDescription
     * @access public
     * @return string
     */
    public static function getSeoDescription()
    {
        return self::$_seoDescription;
    }

    /**
     *
     * @name setSeoHash
     * @access public
     * @param string $value
     * @return string
     */
    private static function setSeoHash($value)
    {
        return self::$_seoHash = $value;
    }

    /**
     *
     * @name getSeoHash
     * @access public
     * @return string
     */
    public static function getSeoHash()
    {
        return self::$_seoHash;
    }

    /**
     *
     * @name init
     * @access public
     */
    public static function init()
    {
        $params = [];
        $tmp = [
            'module',
            'controller',
            'action'
        ];
        foreach ($tmp as $key) {
            if (self::hasSeoParam($key) !== false) {
                $params[] = self::$_seoParams[$key];
                unset(self::$_seoParams[$key]);
            }
        }
        if (sizeof(self::getSeoParams())) {
            $tmp = self::getSeoParams();
            foreach ($tmp as $key => $value) {
                if (self::hasSeoParam($key) !== false) {
                    $params[] = $key . '/' . self::$_seoParams[$key];
                    unset(self::$_seoParams[$key]);
                }
            }
        }
        
        self::setSeoHash(sha1(implode('/', $params)));
        if (file_exists(self::getSeoDirPath() . self::getSeoLocale() . '.php')) {
            require_once self::getSeoDirPath() . self::getSeoLocale() . '.php';
            $arr = 'seo_' . self::getSeoLocale();
            
            if (isset(${$arr}[self::getSeoHash()][1])) {
                self::setSeoTitle($seo_pl_PL[self::getSeoHash()][1]);
            }
            
            if (isset(${$arr}[self::getSeoHash()][2])) {
                self::setSeoKeywords($seo_pl_PL[self::getSeoHash()][2]);
            }
            
            if (isset(${$arr}[self::getSeoHash()][3])) {
                self::setSeoDescription($seo_pl_PL[self::getSeoHash()][3]);
            }
        }
    }
}