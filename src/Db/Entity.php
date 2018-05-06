<?php
/**
 * @name Entity
 * @category Epa
 * @package Library
 * @subpackage Db
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa\Db;

class Entity
{

    /**
     *
     * @var array
     */
    private $_errors = [];

    /**
     *
     * @name addError
     * @access protected
     * @param string $action
     * @param string $field
     * @param string $value
     */
    protected function addError($action, $field, $value)
    {
        if (! isset($this->_errors[$action][$field])) {
            $this->_errors[$action][$field] = $value;
        }
    }

    /**
     *
     * @name removeError
     * @access public
     * @param string $action
     * @param string $field
     */
    public function removeError($action, $field)
    {
        if (isset($this->_errors[$action][$field])) {
            unset($this->_errors[$action][$field]);
        }
    }

    /**
     *
     * @name getErrors
     * @access public
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     *
     * @name hasErrorForAction
     * @access public
     * @param string $action
     * @return boolean
     */
    public function hasErrorForAction($action)
    {
        if (isset($this->_errors[$action])) {
            if (sizeof($this->_errors[$action])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
