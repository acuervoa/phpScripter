<?php

namespace Scripter\Driver;

/**
 * 
 */
class Logger
{
    /**
     * Output types
     * 
     * @var string
     */
    public const OUTPUT_TERMINAL = 1;

    /**
     * Log level types
     * 
     * @var string
     */
    public const LOG_LEVEL_INFO = 1;

    /**
     * 
     */
    public function __construct()
    {

    }

    /**
     * 
     */
    public function setOutputType($type)
    {
        $this->type = $type;
    }

    /**
     * 
     */
    public function log($message, $level = null)
    {
        if ($this->type == self::OUTPUT_TERMINAL) {
            echo $message . PHP_EOL;
        }
    }
}