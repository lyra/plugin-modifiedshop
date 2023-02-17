<?php
/**
 * Copyright © Lyra Network.
 * This file is part of PayZen plugin for modified eCommerce Shopsoftware. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

class PayzenLogger
{
    /**
     * File handler
     *
     * @var resource $fp
     */
    public $fp = null;

    /**
     * Path to logfile
     *
     * @var string $_filePath
     */
    protected $_filePath = false;

    /**
     * Constructor
     * Setting the logfilePaths
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->_logfilePath = dirname(__FILE__) . '/logs/'. $path;
    }

    /**
     * Setting a log entry
     *
     * @param string $message
     * @return bool
     */
    public function log($message)
    {
        return $this->_log($message, $log);
    }

    /**
     * Set the path of the logfile
     *
     * @param string $path
     * @return void
     */
    public function setLogfilePath($path)
    {
        $this->_logfilePath = $path;
    }

    /**
     * Logs $msg to a file which path is being set by it's unified resource locator.
     *
     * @param string $message
     * @return bool
     */
    protected function _log($message)
    {
        $file = $this->_logfilePath;

        if (! is_file($file)) {
            $this->fp = fopen($file, 'w');
            fclose($this->fp);
        }

        if (is_writable($file)) {
            $this->fp = fopen($file, 'a');
            fwrite($this->fp, '[' . date('Y-m-d H:i:s') . '] ' . $message . "\n");
            fclose($this->fp);

            return true;
        }

        return false;
    }
}