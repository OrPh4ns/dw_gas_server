<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Fact Table Class
 */
class FactClass
{
    public static function createFast($address_id, $date_id, $gas_id, $station_id, $source_id, $price): bool
    {
        try
        {
            $insert_id = DB::prepared('INSERT INTO fact_table(gas_id, date_id,station_id, address_id, source_id,  price) VALUES (:gas_id,:date_id,:station_id,:address_id,:source_id,:price)');
            $insert_id->execute(array(
                ":gas_id"=>$gas_id,
                ":date_id"=>$date_id,
                ":station_id"=>$station_id,
                ":address_id"=>$address_id,
                ":source_id"=>$source_id,
                ":price"=>$price,
            ));
            return true;
        }catch (PDOException $e)
        {
            DB::doDebug($e->getMessage());
            return false;
        }
    }
}