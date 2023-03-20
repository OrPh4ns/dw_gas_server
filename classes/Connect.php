<?php
/**
 * Helping Function
 */
include "helper/simple_html_dom.php";
/**
 * Author       : Abdulrahman Othman
 * Created at   : 29.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Connect Class
 */
abstract class Connect
{
    public static string $url;

    public static function setURL($url)
    {
        self::$url =  $url;
    }

    public static function getContent()
    {
        try
        {
            return @file_get_html(self::$url);
        }
        catch (Exception $e)
        {
            DB::doDebug($e->getMessage());
        }
    }

    public static function findAll($str)
    {
        return self::getContent()->find($str, 0);
    }


}