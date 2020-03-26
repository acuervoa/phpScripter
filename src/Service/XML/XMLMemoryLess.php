<?php

namespace Scripter\Service\XML;

/**
 * 
 */
class XMLMemoryLess
{
    /**
     * 
     */
    public function __construct($path, $node)
    {
        $this->path = $path;
        $this->node = $node;
    }

    /**
     * 
     */
    public function getIterator()
    {
        $iterator = new \Scripter\Service\XML\Iterator(\Scripter\Service\XML\Iterator::MEMORY_LESS);
        $iterator->setPath($this->path);
        $iterator->setNode($this->node);
        $iterator->init();
        return $iterator;
    }
}