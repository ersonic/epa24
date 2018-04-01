<?php
/**
 * @name Developer
 * @category Epa
 * @package Library
 * @subpackage Developer
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa\Tools;

class Developer
{

    /**
     *
     * @name moduloPart
     * @access public
     * @param int $days            
     * @param int $modulo            
     * @return array
     */
    public static function moduloPart($days, $modulo = 7)
    {
        $data = [];
        
        // $days = date('j')
        if (! in_array($days, [
            28,
            30,
            31
        ])) {
            $days = date('t');
        }
        
        if (! preg_match('/^[0-9]{1,2}$/i', $modulo) && $modulo < 0) {
            $modulo = 7;
        }
        
        if ($days == $modulo) {
            $modulo = 7;
        }
        
        for ($d = 1; $d <= $days; $d ++) {
            for ($d = 1; $d <= $days; $d ++) {
                $p = (($d % $modulo) - 1);
                if ($p < 0) {
                    $p = 6;
                }
                $data[$d] = $p;
            }
            return $data;
        }
    }

    /**
     *
     * @name convertSize
     * @access public
     * @param int $mSize            
     * @param int $decimals            
     * @return string int
     */
    public static function convertByteFormat($size, $decimals = 2)
    {
        if (! empty($size) && (int) $size) {
            if ((int) $decimals && $decimals > 0 && $decimals < 4) {
                
                $units = [
                    'B' => 0,
                    'KB' => 1,
                    'MB' => 2,
                    'GB' => 3,
                    'TB' => 4,
                    'PB' => 5,
                    'EB' => 6,
                    'ZB' => 7,
                    'YB' => 8
                ];
                
                $powValue = floor(log($size) / log(1024));
                $unit = array_search($powValue, $units);
                $value = ($size / pow(1024, floor($units[$unit])));
                
                $size = sprintf('%.' . $decimals . 'f ' . $unit, $value);
                return $size;
            }
        }
        return $size;
    }

    /**
     *
     * @name arraySortByColumn
     * @access public
     * @param array $arr            
     * @param string $col            
     * @param string $dir            
     */
    public static function arraySortByColumn(&$arr, $col, $dir = SORT_ASC)
    {
        $sort_col = [];
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }

    /**
     *
     * @name checkArray
     * @access public
     * @param array $value            
     * @return bool
     */
    public static function checkArray($value)
    {
        $result = false;
        if (is_array($value)) {
            if (sizeof($value)) {
                $result = true;
            }
        }
        return $result;
    }
}