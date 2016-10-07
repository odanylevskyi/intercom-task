<?php

/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 09:10
 */
require_once("FileNotFoundException.php");

class FileReader
{
    public $handler;
    public $file;

    /*
     * Constructs a FileReader object
     */
    public function __construct($file)
    {
        if(!file_exists($file)) {
            throw new FileNotFoundException($file);
        }
        $this->file = $file;
        $this->open();
    }

    /*
     * Get filename and path
     * @return string contains filename and path
     */
    public function getFilename() {
        return $this->file;
    }

    /*
     * Open file.
     * Child classes can override this method to declare different opening rules.
     * @throw FileNotFoundException in case of opening error.
     */
    public function open() {
        $this->handler = fopen($this->file, "r");
        if (!$this->handler) {
            throw new FileNotFoundException($this->file);
        }
    }

    /*
     * Tests for end-of-file on a file pointer
     */
    public function eof() {
        return feof($this->handler);
    }

    /*
     * Closes an open file pointer
     */
    public function close() {
        fclose($this->handler);
    }

    /*
     * Read one line from the file
     * @return string that contains data from the file
     */
    public function readLine() {
        return fgets($this->handler);
    }

    /*
     * Destruct a FileHelper object
     */
    public function __destruct() {
        $this->close();
    }
}