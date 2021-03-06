<?php 

namespace Scripter\Core;

/**
 * 
 */
class Di 
{
    /**
     * 
     */
    private $dependencies = [];

    /**
     * 
     */
    public function __construct()
    {
        // Services by default
        $this->set('zipper', function() {
            return new \Scripter\Service\Zipper();
        });

        $this->set('logger', function() {
            $logger = new \Scripter\Service\Logger();
            $logger->setOutputType(\Scripter\Service\Logger::OUTPUT_TERMINAL);
            return $logger;
        });
    }

    /**
     * 
     */
    public function set(string $key, $value) 
    {
        $this->dependencies[$key] = $value;
    }

    /**
     * 
     */
    public function get(string $key)
    {
        if (isset($this->dependencies[$key])) {
            if (\is_callable($this->dependencies[$key])) {
                $this->dependencies[$key] = $this->dependencies[$key]();
                return $this->dependencies[$key];
            } else {
                return $this->dependencies[$key];
            }
        }
    }
}