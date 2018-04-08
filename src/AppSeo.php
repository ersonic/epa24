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
     * @var string
     */
    private $_seoTitle = 'Application Skeleton';

    /**
     *
     * @var string
     */
    private $_seoKeywords = '';

    /**
     *
     * @var string
     */
    private $_seoDescription = 'Application Skeleton';

    /**
     */
    public function prepare()
    {
        $params = [];
        return sha1(implode('/', $params));
    }

    /**
     *
     * @name setSeoTitle
     * @access public
     * @param string $value            
     */
    public function setSeoTitle($value)
    {
        $this->_seoTitle = $value;
    }

    /**
     *
     * @name getSeoTitle
     * @access public
     * @return string
     */
    public function getSeoTitle()
    {
        return $this->_seoTitle;
    }

    /**
     *
     * @name setSeoKeywords
     * @access public
     * @param string $value            
     */
    public function setSeoKeywords($value)
    {
        $this->_seoKeywords = $value;
    }

    /**
     *
     * @name getSeoKeywords
     * @access public
     * @return string
     */
    public function getSeoKeywords()
    {
        $this->_seoKeywords;
    }

    /**
     *
     * @name setSeoDescription
     * @access public
     * @return string
     */
    public function setSeoDescription($value)
    {
        $this->_seoDescription = $value;
    }

    /**
     *
     * @name getSeoDescription
     * @access public
     * @return string
     */
    public function getSeoDescription()
    {
        return $this->_seoDescription;
    }
}