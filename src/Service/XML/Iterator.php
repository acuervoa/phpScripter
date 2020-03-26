<?php

namespace Scripter\Service\XML;

/**
 * 
 */
class Iterator
{
    /**
     * 
     */
    public const MEMORY_LESS = 1;

    /**
     * 
     */
    private const NODE_START_PATTERN = "/(\\<%s)((\\s(.*))|(\\>))/";
    private const NODE_END_PATTERN = "/(\\<\\/%s)((\\s(.*))|(\\>))/";

    /**
     * 
     */
    private $type;

    /**
     * 
     */
    private $path;

    /**
     * 
     */
    private $node;

    /**
     * 
     */
    private $fh;

    /**
     * 
     */
    private $nodeStartPattern;
    private $nodeEndPattern;

    /**
     * 
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * 
     */
    public function init()
    {
        if ($this->type === self::MEMORY_LESS) {
            $this->fh = \fopen($this->path, 'r');
            $this->nodeStartPattern = \sprintf(self::NODE_START_PATTERN, $this->node);
            $this->nodeEndPattern = \sprintf(self::NODE_END_PATTERN, $this->node);
        }
    }

    /**
     * 
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * 
     */
    public function setNode($node)
    {
        $this->node = $node;
    }

    /**
     * 
     */
    public function next()
    {
        $buffer = '';
        while(($line = \fgets($this->fh)) != null) {
            \preg_match($this->nodeStartPattern, $line, $startMatches);
            if (!empty($startMatches)) {
                $buffer = $line;   
            } else {
                \preg_match($this->nodeEndPattern, $line, $endMatches);
                $buffer .= $line;
                if (!empty($endMatches)) {
                    return \simplexml_load_string($buffer);
                }
            }
        }

        return null;
    }
}