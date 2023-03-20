<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Source Class
 */
class Source
{
    public static int $id;

    /**
     * @return int
     */
    public static function getSourceID(): int
    {
        return self::$id;
    }

    /**
     * @param int $id
     */
    public static function setSourceID(int $id): void
    {
        self::$id = $id;
    }
}