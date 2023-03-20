<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 28.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Database class for db connection
 */

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "dw_gas";

class DB
{
    public static PDO $conn;
    protected static bool $debug = true;

    public static function connection(): PDO
    {
        if (!isset(self::$conn))
        {
            try
            {
                self::$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e)
            {
                self::doDebug($e->getMessage());
            }
        }
        return self::$conn;
    }


    public static function prepared($sql)
    {
        return self::connection()->prepare($sql);
    }

    public static function doDebug($e)
    {
        if (self::$debug) {
            error_log("$e \n", 3, 'error.log');
        }
    }

    public static function check_connection(): bool
    {
        try {
            if (!isset(self::$conn)) {
                self::$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                return true;
            }
        } catch
        (PDOException $e) {
            self::doDebug($e->getMessage());
            return false;
        }
        return false;
    }

}