<?php
/**
 * @name Generator
 * @category Epa
 * @package Library
 * @subpackage Generator
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa\Tools;

class Generator
{
    /**
     * @name Nip
     * @access public
     * @param mixed $code
     * @return string|boolean
     */
    public static function Nip($code = null)
    {
        if (is_null($code)) {
            $n = 9;
            while($n) {
                $_los = str_pad(mt_rand(101, 998), 3, '000', STR_PAD_LEFT);
                if (!in_array($_los, [110,120,130,10,150,160,170,180,190,200,210,220,230,240,250,260,270,280,290,300,310,320,330,340,350,360,370,380,390,400,401,402,403,404,405,406,407,408,409,410])) {
                    break;
                }
            }
        } else {
            $_los = $code;
        }

        $_los .= str_pad(mt_rand(0, 999999), 6, '000000', STR_PAD_LEFT);
        $_value = str_split($_los);

        $weight = [6,5,7,2,3,4,5,6,7];
        $s = 0;
        for ($i = 0; $i < 9; $i ++) {
            $sm = $_value[$i] * $weight[$i];
            $s += $sm;
        }

        $m = $s % 11;
        $value = $_los.$m;
        return $value;
    }

    /**
     * @name Regon
     * @access public
     * @param int $length
     * @return string|boolean
     */
    public static function Regon($length = 9)
    {
        if ($length != 9 && $length != 14) {
            $length = 9;
        }

        switch ($length) {

            case 9:
                $weight = [8,9,2,3,4,5,6,7];
                $_los = str_pad(mt_rand(0, 99999999), 8, '00000000', STR_PAD_LEFT);
                $_value = str_split($_los);
                $s = 0;
                for ($i = 0; $i < 8; $i ++) {
                    $sm = $_value[$i] * $weight[$i];
                    $s += $sm;
                }
                $m = $s % 11;
                $value = $_los.$m;
            break;

            case 14:
                $weight = [2, 4, 8, 5, 0, 9, 7, 3, 6, 1, 2, 4, 8];
                $nums = '0123456789';
                $_los = $nums[mt_rand( 1, strlen($nums)-1 )];
                for ($p = 0; $p < 12; $p++) {
                    $_los .= $nums[mt_rand( 0, strlen($nums)-1 )];
                }
                $_value = str_split($_los);
                $s = 0;
                for ($i = 0; $i < 13; $i ++) {
                    $sm = $_value[$i] * $weight[$i];
                    $s += $sm;
                }
                $m = $s % 11;
                $value = $_los.$m;
            break;
        }

        return $value;
    }

    /**
     * @name Pesel
     * @access public
     * @param int $sex
     * @return string|boolean
     */
    public static function Pesel($sex = 0)
    {
        if (! is_numeric($sex) || strlen($sex) > 1) {
            $sex = 1;
        }

        if ($sex > 1) {
            $sex = 0;
        }

        // 0 - women, 1 - men
        $_year = str_pad(rand(0, 99), 2, '00', STR_PAD_LEFT);
        $_month = str_pad(rand(1, 12), 2, '00', STR_PAD_LEFT);
        $_day = str_pad(rand(1, 31), 2, '00', STR_PAD_LEFT);

        $days = cal_days_in_month(0, $_month, $_year);
        if ($_day > $days) {
            $_day = $days;
        }

        $n = 10;
        while ($n) {
            $_los = str_pad(mt_rand(1, 9999), 4, '0000', STR_PAD_LEFT);
            // liczba parzysta - kobieta, liczba nieparzysta - mezczyzna
            if (($_los[3] % 2) == $sex) {
                break;
            }
        }

        $value = $_year . $_month . $_day . $_los;
        $_value = str_split($value);

        $weight = [1,3,7,9,1,3,7,9,1,3];

        $s = 0;
        for ($i = 0; $i < 10; $i ++) {
            $sm = $_value[$i] * $weight[$i];
            $s += $sm;
        }

        $m = $s % 10;
        $m = 10 - $m;
        $m = $m % 10;
        $value = $value . $m;

        return $value;
    }

    /**
     * @name prefix
     * @access public
     * @param int $max
     * @param int $lenght
     * @return string bool
     */
    public static function prefix($max, $lenght = 8)
    {
        if (preg_match('/^[0-9]{1,2}$/i', $lenght) && $lenght > 0) {
            if (preg_match('/^[0-9]{1,20}$/i', $max) && $max > 0) {

                $tableChars = "0123456789ABCDEF";

                $prefix = '';
                $j = $max;

                for ($i = 1; $i <= $lenght; $i++) {
                    $tmp = $j & 15;
                    $prefix .= substr($tableChars, $tmp, 1);
                    $j = $j / 16;
                }

                return $prefix;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
