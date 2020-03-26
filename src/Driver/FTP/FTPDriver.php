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
        // Timeout 5 segundos
        $dir = "ssh2.sftp://sftpcofisem:vZAKEAe#!NtZ@sftp.webfg.com:22/./"; 
        $handle = opendir($dir);

        $this->connection = \ftp_ssl_connect($host, $port, 3);

        if ($this->connection) {
            \ftp_pasv($this->connection, true);
            \ftp_login($this->connection, $user, $password);
        } else {
            // @todo control this error better
            die("Error connection FTP");
        }
        
    }

    /**
     * 
     */
    public function getFiles($source, $target)
    {
        var_dump($this->connection);
        var_dump(\ftp_rawlist($this->connection, $source));
        die;
    }
}