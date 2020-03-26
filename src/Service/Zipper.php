<?php

namespace Scripter\Driver;

/**
 * 
 */
class Zipper
{
    /**
     * 
     */
    public function unzip($file, $target = null)
    {
        $dir = \dirname($file);

        $zip = \zip_open($file);
        if ($zip) {
            while ($zip_entry = \zip_read($zip)) {
                $of = $dir . '/' . \zip_entry_name($zip_entry);
                $fp = \fopen($of, "w");
                if (\zip_entry_open($zip, $zip_entry, "r")) {
                    $buf = \zip_entry_read($zip_entry, \zip_entry_filesize($zip_entry));
                    \fwrite($fp,$buf);
                    \zip_entry_close($zip_entry);
                    \fclose($fp);
                }
            }
            \zip_close($zip);
        } else {
            // @todo control this
            die("No zip");
        }
    }
}