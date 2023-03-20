<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Gas Class
 */
class Gas
{
    public static string $type;

    /**
     * @return string
     */
    public static function getType(): string
    {
        return self::$type;
    }

    /**
     * @param string $type
     */
    public static function setType(string $type): void
    {
        self::$type = $type;
    }

    /**
     * @param $name
     * @return void
     */
    public static function insertGas($name): void
    {
        $gas_id_stmt = DB::prepared('select * from gas_dim where gas_type like :type');
        $gas_id_stmt->execute(array(":type"=>$name));
        if($gas_id_stmt->rowCount()>0)
        {
            $id =  $gas_id_stmt->fetch()['gas_id'];
            self::setType($id);
        }
        else
        {
            $stmt_id = DB::prepared('select max(gas_id) from gas_dim');
            $stmt_id->execute();
            $gas_id = $stmt_id->fetch()[0];
            $gas_id++;
            self::setType($gas_id);
            $insert_station = DB::prepared('insert into gas_dim values(:id, :name)');
            $insert_station->execute(array(":id"=>self::getType(), ":name"=>$name));
        }
    }
}