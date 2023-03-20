<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Station Class
 */
class Station
{
    public static int $stationID;

    /**
     * @return int
     */
    public static function getStationID(): int
    {
        return self::$stationID;
    }

    /**
     * @param int $stationID
     */
    public static function setStationID(int $stationID): void
    {
        self::$stationID = $stationID;
    }

    /**
     * @param $station_name
     * @return void
     */
    public static function insertStation($station_name)
    {
        $station_id_stmt = DB::prepared('select * from station_dim where station_name like :st_name');
        $station_id_stmt->execute(array(":st_name"=>$station_name));
        if($station_id_stmt->rowCount()>0)
        {
            $id =  $station_id_stmt->fetch()['station_id'];
            self::setStationID($id);
        }
        else
        {
            $stmt_id = DB::prepared('select max(station_id) from station_dim');
            $stmt_id->execute();
            $station_id = $stmt_id->fetch()[0];
            $station_id++;
            self::setStationID($station_id);
            $insert_station = DB::prepared('insert into station_dim values(:id, :name)');
            $insert_station->execute(array(":id"=>self::getStationID(), ":name"=>$station_name));
        }
    }
}