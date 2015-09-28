<?php
/**
 * Created by JetBrains PhpStorm.
 * User: a_niyazov
 * Date: 14.11.13
 * Time: 15:26
 * To change this template use File | Settings | File Templates.
 */
namespace common\helpers;

class DebugHelper
{
    public static function printSingleObject($object)
    {
        echo '<pre>'; print_r($object); echo '</pre>';
    }

    public static function printSingleObjectAndDie($object)
    {
        self::printSingleObject($object);
        die;
    }

    public static function printObjectsArray($objectsArray)
    {
        echo '<pre>';
        foreach($objectsArray as $object)
        {
            print_r($object);
        }
        echo '</pre>';
    }

    public static function printObjectsArrayAndDie($objectsArray)
    {
        self::printObjectsArray($objectsArray);
        die;
    }

    public static function printActiveRecordsModel($object)
    {
        echo '<pre>'; print_r($object->getAttributes()); echo '</pre>';
    }

    public static function printActiveRecordsModelAndDie($object)
    {
        self::printActiveRecordsModel($object);
        die;
    }

    public static function printActiveRecordsArray($objectsArray)
    {
        echo '<pre>';
        foreach($objectsArray as $object)
        {
            print_r($object->getAttributes());
        }
        echo '</pre>';
    }

    public static function printActiveRecordsArrayAndDie($objectsArray)
    {
        self::printActiveRecordsArray($objectsArray);
        die;
    }

    public static function printToSandBox($text)
    {
        if(strpos($_SERVER['HTTP_HOST'], 'dev'))
        {
            echo $text;
        }
        else
        {
            echo '';
        }
    }

    public static function printToSandBoxAndDie($text)
    {
        printToSandBox($text);
        die;
    }
}