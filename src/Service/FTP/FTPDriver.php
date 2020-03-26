<?php

namespace Scripter\Driver\FTP;

/**
 * 
 */
class FTPDriver
{   
    /**
     * 
     */
    private $connection;

    /**
     * 
     */
    public function __construct($host, $port, $user, $password)
    {
        // Init connection
        $this->connection = new \phpseclib\Net\SFTP($host);
        
        // Login
        $status = $this->connection->login($user, $password);
        if (!$status) {
            // @todo control this error better
            die ("LOgin failed");
        }
        
    }

    /**
     * Download multiple files by pattern
     * 
     * @param string $path -> Path in the FTP
     * @param string $pattern -> Pattern of the files to be donwloaded
     * @param string $target -> Local path to download the files
     * @return bool true if success
     */ 
    public function getFiles($path, $pattern, $target): bool
    {
        // Get all files of the path
        $files = \array_keys($this->connection->rawlist($path));

        // Get files by pattern
        $filtered = \array_filter($files, function(&$element) use ($pattern) {
            \preg_match($pattern, $element, $matches);
            return !empty($matches);
        });

        \array_walk($filtered, function(&$element) use ($path, $target) {
            $this->connection->get("$path/$element", "$target/$element");
        });

        return true;
    }
}