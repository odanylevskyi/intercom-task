<?php
/**
 * Created by PhpStorm.
 * Author: Oleksii Danylevskyi <aleksey@danilevsky.com>
 * Date: 07/10/2016
 * Time: 09:28
 */


class FileNotFoundException extends \Exception
{
    public function __construct($file, $code = 0, \Exception $previous = null)
    {
        parent::__construct("File '{$file}' not found or you have no access to the file or directory.", $code, $previous);
    }
}