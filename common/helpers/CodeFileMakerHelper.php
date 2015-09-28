<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 23.09.2015
 * Time: 11:43
 */
namespace common\helpers;

class CodeFileMakerHelper
{
    public static function make()
    {

    }

    protected function saveFile($path,$code)
    {
        return file_put_contents($path,$code);
    }
}