<?php

/*
 * Author       : Abdulrahman Othman
 * Created at   : 28.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Addresses Class
 */

class Addresses
{
    /**
     * @return false|void
     */
    public static function insertAddressesFromCsv()
    {
        $row = 1;
        $file = "stadt.csv";
        if (($handle = fopen($file, "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                //$num = count($data);
                $row++;
                try
                {
                    //print_r($data[2]);
                    $check_city = DB::prepared('SELECT COUNT(*) FROM city WHERE city.zip LIKE :zip');
                    $check_city->bindValue(":zip", "%$data[2]%", PDO::PARAM_STR);
                    $check_city->execute();
                    if($check_city->fetch()[0]==0)
                    {
                        $insert_city = DB::prepared('insert into city(zip, city, state) values(:zip, :city, :state)');
                        $insert_city->execute(array(":zip"=>$data[2],":city"=>$data[1], ":state"=>$data[3]));
                    }
                    else
                    {
                        //echo "Found ".$data[2]."<br>";
                    }
                }
                catch (PDOException $e)
                {
                    DB::doDebug($e->getMessage());
                    return false;
                }
            }
            fclose($handle);
            return true;
        }
    }
}