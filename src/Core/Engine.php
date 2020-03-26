<?php 

namespace Scripter\Core;

/**
 * 
 */
class Engine 
{
    /**
     * 
     */
    public static function fire($process)
    {        
        // Keep start timestamp
        $startTime = \microtime(true);

        // Prepare di
        $di = new \Scripter\Core\Di();

        /**
         * Prepare main script
         */
        $_ = new $process();
        $_->setDi($di);
        $_->run();

        /**
         * Show end message and process duration
         */
        $endTime = \microtime(true);
        echo "\n\n Process end! Duration: " . ($endTime - $startTime) . PHP_EOL;
    }
}