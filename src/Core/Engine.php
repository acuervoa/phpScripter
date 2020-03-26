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
        // Autoload
        self::bootstrap();
        
        // Prepare di
        $di = new \Scripter\Core\Di();

        /**
         * Prepare main script
         */
        $_ = new $process();
        $_->setDi($di);
        $_->run();
    }
}