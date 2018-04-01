<?php
/**
 * @name CronHelper
 * @category Epa
 * @package Library
 * @subpackage CronHelper
 * @version 4.3.0
 * @author Miroslaw Kukuryka
 * @copyright (c) 2018 E R S O N I C (http://www.ersonic.com)
 * @license http://www.epa24.pl/license
 * @link http://www.epa24.pl/wiki
 */
namespace Epa\Tools;

class CronHelper
{

    /**
     *
     * @var string
     */
    private static $pid;

    /**
     *
     * @name construcor
     * @access public
     */
    public function __construct()
    {}

    /**
     *
     * @name __clone
     * @access public
     */
    public function __clone()
    {}

    /**
     *
     * @name isrunning
     * @access private
     * @return bool
     */
    private static function isrunning()
    {
        $pids = explode(PHP_EOL, `ps -e | awk '{print $1}'`);
        if (in_array(self::$pid, $pids)) {
            return true;
        }
        return false;
    }

    /**
     *
     * @name lock
     * @access public
     * @return bool|string
     */
    public static function lock()
    {
        $lockFile = LOCK_DIR . PROGRAM_NAME . FILE_NAME . LOCK_SUFFIX;
        
        if (file_exists($lockFile)) {
            // Is running
            self::$pid = file_get_contents($lockFile);
            if (self::isrunning()) {
                error_log("==" . self::$pid . "== Already in progress...");
                return false;
            } else {
                error_log("==" . self::$pid . "== Previous job died abruptly...");
            }
        }
        
        self::$pid = getmypid();
        file_put_contents($lockFile, self::$pid);
        error_log("==" . self::$pid . "== Lock acquired, processing the job...");
        return self::$pid;
    }

    /**
     *
     * @name unlock
     * @access public
     * @return bool
     */
    public static function unlock()
    {
        $lockFile = LOCK_DIR . PROGRAM_NAME . FILE_NAME . LOCK_SUFFIX;
        
        if (file_exists($lockFile)) {
            unlink($lockFile);
        }
        error_log("==" . self::$pid . "== Releasing lock...");
        return true;
    }
}
