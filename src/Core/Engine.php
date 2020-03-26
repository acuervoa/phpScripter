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
    private static function bootstrap()
    {
        \spl_autoload_register(function($path) {
            require_once \sprintf(
                '%s%s', 
                str_replace('\\', '/', $path),
                '.php'
            );
        });
    }

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