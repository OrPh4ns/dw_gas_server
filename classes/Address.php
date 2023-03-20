<?php

class Address
{
    public static int $id;

    /**
     * @return int
     */
    public static function getId(): int
    {
        return self::$id;
    }

    /**
     * @param int $id
     */
    public static function setId(int $id): void
    {
        self::$id = $id;
    }


    /**
     * @param $street
     * @param $zip
     * @return bool|void
     */
    public static function insertAddress_throw_zip($street, $city, $zip, $ex_zip)
    {
        try {
            $check_zip = DB::prepared('select zip from city where zip = :zip');
            $check_zip->execute(array(":zip" => $zip));
            if ($check_zip->rowCount() <= 0) {
                $stmt_zip = DB::prepared('insert into city(city.city, zip, state) values (:city, :zip,  (SELECT c.state from city c where zip=:ex_zip))');
                $stmt_zip->execute(array(":city" => $city, ":zip" => $zip, ":ex_zip" => $ex_zip));
            }

            $check_count = DB::prepared('select count(*) from address_dim');
            $check_count->execute();
            //echo "Counter = ".$check_count->fetch()[0]." \n";
            if ($check_count->fetch()[0] == 0) {
                $new_address = DB::prepared('insert into address_dim(street, zip) values (:street, :zip)');
                $new_address->execute(array(":zip" => $zip, ":street" => $street));
                $stmt_id = DB::prepared('select max(address_id) from address_dim');
                $stmt_id->execute();
                self::setId($stmt_id->fetch()[0]);
                echo "\033[97m ][ New Database Table ][ \n";
            }
            else
            {
                $stmt_id = DB::prepared('select max(address_id) from address_dim');
                $stmt_id->execute();
                $check_street = DB::prepared('select street, zip from address_dim where street like :street and zip = :zip');
                $check_street->execute(array(":street" => $street, ":zip" => $zip));
                if ($check_street->rowCount() > 0) {
                    echo "\033[97m ][ Address Found ][ \n";
                    $address_id = $stmt_id->fetch()[0];
                    //echo "ID is = " . self::$address_id . "\n";
                    self::setId($address_id);
                } else {
                    $address_id = ++$stmt_id->fetch()[0];
                    //echo "ID is = " . self::$address_id . "\n";
                    self::setId($address_id);
                    $insert_address = DB::prepared('INSERT INTO address_dim(street, zip) VALUE(:street,:zip)');
                    $insert_address->execute(array(":street" => $street, ":zip" => $zip));
                }
            }
        }
        catch (PDOException $e)
        {
            echo "Fatal ERROR PDO";
            return false;
        }
        return true;
    }

    // check again
    public static function insertAddress_throw_city($street, $city, $zip): bool
    {
        try {
            $check_zip = DB::prepared('select count(*) from city where zip = :zip');
            $check_zip->execute(array(':zip' => $zip));
            if ($check_zip->fetch()[0] == 0)
            {
                echo "############# New Zip Code ################ \n";
                $get_state = DB::prepared('select state from city where city like :city');
                $get_state->execute(array(":city" => $city));
                $state = $get_state->fetch()[0];
                $insert_city = DB::prepared('INSERT INTO city(zip, city, state) VALUES(:zip, :city, :state)');
                $insert_city->execute(array(":zip" => $zip, ":city" => $city, ":state" => $state));
            }


            if (self::getAdressDimCounter() == 0)
            {
                $new_address = DB::prepared('insert into address_dim(street, zip) values (:street, :zip)');
                $new_address->execute(array(":zip" => $zip, ":street" => $street));
                $stmt_id = DB::prepared('select max(address_id) from address_dim');
                $stmt_id->execute();
                self::setId($stmt_id->fetch()[0]);
                echo "\033[97m ][ New Database Table ][ \n";
            }
            else
            {
                if (self::StreetExistCounter($street,$zip) > 0)
                {
                    echo "\033[97m ][ Address Found ][ \n";
                    //echo "ID is = " . self::$address_id . "\n";
                    //$address_id = self::getAdressDimMax();
                    $stmt_id = DB::prepared('select max(address_id) from address_dim');
                    $stmt_id->execute();
                    self::setId($stmt_id->fetch()[0]);
                }
                else
                {
                    $stmt_id = DB::prepared('select max(address_id) from address_dim');
                    $stmt_id->execute();
                    self::setId(++$stmt_id->fetch()[0]);
                    $insert_address = DB::prepared('INSERT INTO address_dim(street, zip) VALUE(:street,:zip)');
                    $insert_address->execute(array(":street" => $street, ":zip" => $zip));
                }
            }
            return true;
        } catch (PDOException $e) {
            echo "ERROR PDO";
            return false;
        }

        //echo "xxx \n".$check_zip->rowCount()." xxx\n";
    }


    /**
     * @return bool|array
     */
    public static function getZips(): bool|array
    {
        $stmt = DB::prepared('SELECT zip FROM city');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @return bool|array
     */
    public static function getCities(): bool|array
    {
        $stmt = DB::prepared('SELECT city FROM city');
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public static function getAdressDimCounter()
    {
        $check_count = DB::prepared('select count(*) from address_dim');
        $check_count->execute();
        return $check_count->fetch()[0];
    }


    public static function getAdressDimMax()
    {
        $check_count = DB::prepared('select max(address_dim) from address_dim');
        $check_count->execute();
        return $check_count->fetch()[0];
    }

    public static function StreetExistCounter($street, $zip): int
    {
        $check_street = DB::prepared('select street, zip from address_dim where street like :street and zip = :zip');
        $check_street->execute(array(":street" => $street, ":zip" => $zip));
        return $check_street->rowCount();
    }
    public static function checkExistThrowStreet($street, $zip): bool
    {
        $stmt = DB::prepared('SELECT count(*) FROM address_dim where street like :street & zip = :zip');
        $stmt->execute(array(":street" => $street . '%', ":zip" => $zip));
        var_dump($stmt->fetchAll());
        if ($stmt->rowCount() > 0) {
            return false;
        }
        return true;
    }

}