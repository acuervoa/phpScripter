<?php

namespace Scripter\Service\FTP;

/**
 * 
 */
class FTPDriver
{ 
    /**
     * 
     */
    private $host;

    /**
     * 
     */
    private $port;

    /**
     * 
     */
    private $user;

    /**
     * 
     */
    private $password;

    /**
     * 
     */
    private $connection;

    /**
     * 
     */
    public function __construct($host, $port, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;

        //
        $this->connection = null;
    }

    /**
     * 
     */
    public function __destruct()
    {
        $this->_disconnect();
    }

    /**
     * 
     */
    private function _connect()
    {
        // Init connection
        $this->connection = new \phpseclib\Net\SFTP($this->host);
        
        // Login
        $status = $this->connection->login($this->user, $this->password);
        if (!$status) {
            // @todo control this error better
            die ("Login failed");
        }
    }

    /**
     * 
     */
    private function _disconnect()
    {
        if ($this->connection) {
            $this->connection->disconnect();
            $this->connection = null;
        }
    }

    /**
     * Download multiple files by pattern
     * 
     * @TODO By the moment connection is opened before start and closed when finished
     * in the future we can add a parameter for persistent connections
     * 
     * @param string $path -> Path in the FTP
     * @param string $pattern -> Pattern of the files to be donwloaded
     * @param string $target -> Local path to download the files
     * @return bool true if success
     */ 
    public function getFiles($path, $pattern, $target): bool
    {
        // Connect
        $this->_connect();

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

        // Disconnect
        $this->_disconnect();

        return true;
    }
}