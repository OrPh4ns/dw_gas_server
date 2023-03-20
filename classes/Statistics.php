<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Statistics Class
 */
class Statistics
{
    /**
     * @return bool|array
     */
    public static function getCheapPriceInfoE10(): bool|array
    {
        try
        {
            $cheapPriceE10 = DB::prepared('SELECT MIN(price)FROM fact_table NATURAL JOIN gas_dim gas WHERE gas.gas_type LIKE "e10" limit 1;');
            $cheapPriceE10->execute();
            return $cheapPriceE10->fetchAll();
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            //self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return bool|array
     */
    public static function getCheapPriceInfoE5(): bool|array
    {
        try
        {
            $cheapPriceE5 = DB::prepared('SELECT MIN(price)FROM fact_table NATURAL JOIN gas_dim gas WHERE gas.gas_type LIKE "e5" limit 1;');
            $cheapPriceE5->execute();
            return $cheapPriceE5->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return bool|array
     */
    public static function getCheapPriceInfoDiesel(): bool|array
    {
        try
        {
            $cheapPriceDiesel = DB::prepared('SELECT MIN(price)FROM fact_table NATURAL JOIN gas_dim gas WHERE gas.gas_type LIKE "diesel" limit 1;');
            $cheapPriceDiesel->execute();
            return $cheapPriceDiesel->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getCheapestType()
    {
        try
        {
            $cheapestType = DB::prepared('SELECT DISTINCT gas.gas_type from gas_dim gas NATURAL JOIN fact_table fact WHERE fact.price in (SELECT MIN(price) from fact_table)');
            $cheapestType->execute();
            return $cheapestType->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getExpinsiveType()
    {
        try
        {
            $ExpinsiveType = DB::prepared('SELECT DISTINCT gas.gas_type from gas_dim gas NATURAL JOIN fact_table fact WHERE fact.price in (SELECT MAX(price) from fact_table)');
            $ExpinsiveType->execute();
            return $ExpinsiveType->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getAVGE5()
    {
        try
        {
            $avgE5 = DB::prepared('SELECT AVG(price) FROM fact_table JOIN gas_dim ON fact_table.gas_id=gas_dim.gas_id WHERE gas_type LIKE "E5"');
            $avgE5->execute();
            return $avgE5->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getAVGE10()
    {
        try
        {
            $avgE10 = DB::prepared('SELECT AVG(price) FROM fact_table JOIN gas_dim ON fact_table.gas_id=gas_dim.gas_id WHERE gas_type LIKE "E10"');
            $avgE10->execute();
            return $avgE10->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getAVGDiesel()
    {
        try
        {
            $avgDiesel = DB::prepared('SELECT AVG(price) FROM fact_table JOIN gas_dim ON fact_table.gas_id=gas_dim.gas_id WHERE gas_type LIKE "diesel"');
            $avgDiesel->execute();
            return $avgDiesel->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getMaxTodayE5()
    {
        try
        {
            $maxToday = DB::prepared('SELECT MAX(f.price) FROM fact_table f NATURAL JOIN date_dim d NATURAL JOIN gas_dim g 
WHERE g.gas_type LIKE "e5" AND d.day IN (SELECT DAY(CURRENT_TIMESTAMP))
AND d.year IN (SELECT YEAR(CURRENT_TIMESTAMP))');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getMaxTodayE10(): mixed
    {
        try
        {
            $maxToday = DB::prepared('SELECT MAX(f.price) FROM fact_table f NATURAL JOIN date_dim d NATURAL JOIN gas_dim g 
WHERE g.gas_type LIKE "E10" AND d.day IN (SELECT DAY(CURRENT_TIMESTAMP))
AND d.year IN (SELECT YEAR(CURRENT_TIMESTAMP))');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getMaxTodayDiesel()
    {
        try
        {
            $maxToday = DB::prepared('SELECT MAX(f.price) FROM fact_table f NATURAL JOIN date_dim d NATURAL JOIN gas_dim g 
WHERE g.gas_type LIKE "diesel" AND d.day IN (SELECT DAY(CURRENT_TIMESTAMP))
AND d.year IN (SELECT YEAR(CURRENT_TIMESTAMP))');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getMinTodayE5()
    {
        try
        {
            $maxToday = DB::prepared('SELECT MIN(f.price) FROM fact_table f NATURAL JOIN date_dim d NATURAL JOIN gas_dim g 
WHERE g.gas_type LIKE "E5" AND d.day IN (SELECT DAY(CURRENT_TIMESTAMP))
AND d.year IN (SELECT YEAR(CURRENT_TIMESTAMP))');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getMinTodayE10()
    {
        try
        {
            $maxToday = DB::prepared('SELECT MIN(f.price) FROM fact_table f NATURAL JOIN date_dim d NATURAL JOIN gas_dim g 
WHERE g.gas_type LIKE "E10" AND d.day IN (SELECT DAY(CURRENT_TIMESTAMP))
AND d.year IN (SELECT YEAR(CURRENT_TIMESTAMP))');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getMinTodayDiesel()
    {
        try
        {
            $maxToday = DB::prepared('SELECT MAX(f.price) FROM fact_table f NATURAL JOIN date_dim d NATURAL JOIN gas_dim g 
WHERE g.gas_type LIKE "diesel" AND d.day IN (SELECT DAY(CURRENT_TIMESTAMP))
AND d.year IN (SELECT YEAR(CURRENT_TIMESTAMP))');
            $maxToday->execute();
            return $maxToday->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getFactsCount()
    {
        try
        {
            $factsCount = DB::prepared('SELECT COUNT(*) FROM fact_table;');
            $factsCount->execute();
            return $factsCount->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getCitesCount()
    {
        try
        {
            $citiesCount = DB::prepared('SELECT COUNT(*) FROM city;');
            $citiesCount->execute();
            return $citiesCount->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getAddressesCount()
    {
        try
        {
            $adsCount = DB::prepared('SELECT COUNT(*) FROM address_dim;');
            $adsCount->execute();
            return $adsCount->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getStationsCount(): mixed
    {
        try
        {
            $stCount = DB::prepared('SELECT COUNT(*) FROM station_dim;');
            $stCount->execute();
            return $stCount->fetch();
        }
        catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }


    /**
     * @return false|mixed
     */
    public static function getLastDate(): mixed
    {
        try
        {
            $maxToday = DB::prepared('SELECT YEAR, MONTH, DAY, HOUR, MINUTE, second FROM date_dim ORDER BY date_id desc LIMIT 1;');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getFirstDate(): mixed
    {
        try
        {
            $maxToday = DB::prepared('SELECT YEAR, MONTH, DAY, HOUR, MINUTE, second FROM date_dim ORDER BY date_id asc LIMIT 1;');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return false|mixed
     */
    public static function getLastStation(): mixed
    {
        try
        {
            $maxToday = DB::prepared('SELECT s.station_name FROM station_dim s ORDER BY s.station_id LIMIT 1;');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }


    /**
     * @return false|mixed
     */
    public static function getLastSource(): mixed
    {
        try
        {
            $maxToday = DB::prepared('SELECT s.url FROM source_dim s NATURAL JOIN fact_table f ORDER BY s.source_id LIMIT 1;');
            $maxToday->execute();
            return $maxToday->fetch();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @return mixed
     */
    public static function getStationAVGPrice(): mixed
    {
        try
        {
            $stationAVGPrice = DB::prepared('SELECT AVG(price) as price, station_name FROM fact_table NATURAL JOIN station_dim NATURAL JOIN gas_dim GROUP BY station_id;');
            $stationAVGPrice->execute();
            return $stationAVGPrice->fetchAll();
        }catch (PDOException $e)
        {
            self::doDebug($e->getMessage());
            return false;
        }
    }
}

