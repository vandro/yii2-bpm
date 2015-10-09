<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 21.09.2015
 * Time: 17:29
 */
namespace common\modules\epigu\components;

class Integration
{
    protected static $authParams = array(
        'login' => 'api_info_system',
        'password' => 'qwerty',
        'cache_wsdl' => WSDL_CACHE_NONE,
    );

    protected static function getClient()
    {
        return new \SoapClient('http://api.gov.uz/api/Service', self::$authParams);
    }

    public static function getAllTasks($id, $page = 1)
    {
        return self::getClient()->getTasks($id, $page, 'json');
    }

    public static function getTask($id)
    {
        return self::getClient()->getTask($id, 'json');
    }

    public static function getConfig($id)
    {
        return file_get_contents('http://official2.gov.uz/getConfig/'.$id);
    }
}