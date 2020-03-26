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