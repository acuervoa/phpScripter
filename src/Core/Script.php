<?php

namespace Scripter\Core;

/**
 * 
 */
class Script
{
    /**
     * 
     */
    protected $di;

    /**
     * 
     */
    public function setDi(\Scripter\Core\Di $di)
    {
        $this->di = $di;
    }

    /**
     * 
     */
    protected function setConfiguration(string $path)
    {
        $raw = \file_get_contents($path);
        $json = \json_decode($raw, true);

        // Auto setters
        if (isset($json['databases'])) {
            $this->setDatabases($json['databases']);
        }

        // Auto setters
        if (isset($json['ftps'])) {
            $this->setFTPs($json['ftps']);
        }

        $this->di->set('configuration', $json);
    }   

    /**
     * 
     */
    protected function getConfiguration()
    {
        return $this->di->get('configuration');
    }

    /**
     * Set multiple databases
     */
    protected function setDatabases(array $databases)
    {
        \array_walk($databases, function($database) {
            $this->setDatabase($database);
        });
    }

    /**
     * Set a database
     */
    protected function setDatabase(array $database)
    {
        $this->di->set("db_{$database['name']}", function() use ($database) {
            return new \Scripter\Service\DB\DBDriver(
                $database['host'], 
                $database['port'], 
                $database['user'],
                $database['password'], 
                $database['database']
            );
        });
    }

    /**
     * Set a database
     */
    protected function getDatabase(string $database): \Scripter\Service\DB\DBDriver
    {
        return $this->di->get("db_{$database}");
    }

    /**
     * Set multiple databases
     */
    protected function setFTPs(array $ftps)
    {
        \array_walk($ftps, function($ftp) {
            $this->setFTP($ftp);
        });
    }

    /**
     * Set a database
     */
    protected function setFTP(array $ftp)
    {
        $this->di->set("ftp_{$ftp['name']}", function() use ($ftp) {
            return new \Scripter\Service\FTP\FTPDriver(
                $ftp['host'], 
                $ftp['port'], 
                $ftp['user'],
                $ftp['password']
            );
        });
    }

    /**
     * 
     */
    public function setLogger($logger)
    {
        $this->di->set('logger', $logger);   
    }

    /**
     * 
     */
    public function log($message, $level = null)
    {
        $this->di->get('logger')->log($message, $level);
    }

    /**
     * Shortcut
     */
    protected function getFTP($name)
    {
        return $this->di->get("ftp_$name");
    }
}