<?php

abstract class Parser1
{
    private array       $gas_types;
    private Date        $date;
    private string      $url;
    private int         $source_id;

    public function __construct()
    {
        $this->gas_types = array(1 => 'super-e5', 2 => 'super-e10', 3 => 'diesel');
        $this->date = new Date();
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getSourceId(): int
    {
        return $this->source_id;
    }

    /**
     * @param int $source_id
     */
    public function setSourceId(int $source_id): void
    {
        $this->source_id = $source_id;
    }

    /**
     * @return bool
     */
    public function parse(): bool
    {
        static $obj_counter = 0;
        try {
            /* Getting Randomed Value between 5 and 8 for sleeping timer*/
            if(! $random_sleep_timer = random_int(5, 8)) throw Exception("\033[32m ERROR");

            foreach (Address::getZips() as $zip)
            {
                foreach ($this->gas_types as $type)
                {
                    $obj_counter++;
                    Connect::setURL($this->url.'?land=de&suchfeld=' . $zip[0] . '&sorte=' . $type);
                    if(!$list = Connect::findAll('table[class="spritpreis_liste"]'))
                    {
                        echo "\033[32m $obj_counter ][ [$zip[0]] Field Parsed \n";
                        self::write_not_zip("$zip[0] \n");
                        sleep($random_sleep_timer);
                    }
                    else
                    {
                        $list_array = $list->find('a');
                        static $counter = 0;
                        for ($i = 2; $i < sizeof($list_array); $i++)
                        {
                            if($counter==0)
                            {
                                $station = $list_array[$i]->plaintext;
                            }
                            else if($counter==1)
                            {
                                $comma_position = strpos($list_array[$i]->plaintext, ',');
                                $sub_price = substr($list_array[$i]->plaintext, $comma_position-1, 4);
                                if(str_contains($sub_price, '-,--') || !preg_match('~[0-9]+~', $list_array[$i]->plaintext))
                                {
                                    $i+=2;
                                    $counter=0;
                                    continue;
                                }
                                else
                                {
                                    $gas_price = str_replace(",", ".", $sub_price);
                                }
                            }
                            else if($counter==2)
                            {
                                $str = $list_array[$i]->plaintext;
                                if(preg_match_all('/\d+/', $str, $numbers))
                                {
                                    $station_zip = end($numbers[0]);
                                    $str_pos = strpos($str, $station_zip);
                                    $station_city = trim(substr($str, $str_pos+5, strlen($str)), ' ');
                                    echo "city=".$station_city."\n";
                                    $station_street = ltrim(substr($str, 0, $str_pos));
                                    $station_street = str_replace('
                                 ','',$station_street);
                                    $station_street = str_replace(' 
                         ', '', $station_street);
                                    echo "street=".$station_street."\n";
                                }
                                echo "\033[97m TankStelle=".$station."\n";
                                echo "\033[97m Price is =[".$gas_price."] \n";
                                echo "\033[97m Zip=".end($numbers[0])."\n";
                                sleep(0.5);

                                # 1
                                Station::insertStation($station);
                                # 2
                                Address::insertAddress_throw_zip($station_street, $station_city, $station_zip, $zip[0]);
                                $gasType_id = array_search($type, $this->gas_types);
                                $this->date->insertCurrentInfos();
                                FactClass::createFast(Address::getId(), $this->date->getDateId(),$gasType_id, Station::getStationID(), $this->getSourceId(),  $gas_price);
                            }
                            $counter=$counter==3?0:++$counter."\n";
                        }
                        echo "\033[32m $obj_counter ][ [$zip[0] - $type] Successfully Parsed \n";
                        sleep($random_sleep_timer);
                    }
                }
            }
            return true;
        }
        catch
        (Exception $e)
        {
            DB::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @param $zip
     * @return void
     */
    public function write_not_zip($zip)
    {
        $fp = fopen('zip_error.txt', 'a');
        fwrite($fp, $zip);
        fclose($fp);
    }



    /*
    public static function parse_2()
    {
        try {
            Connect::setURL('https://www.verbrauchsrechner.de/spritpreise/?land=de&suchfeld=35396&entfernung=4&sorte=super-e5');
            $list = Connect::findAll('table[class="spritpreis_liste"]');
            $list_array = $list->find('a');

            for ($i = 0; $i < sizeof($list_array); $i++) {
                echo $list_array[$i]->plaintext;
                echo "<br>";
            }
            return true;
        } catch (Exception $e) {
            DB::doDebug($e->getMessage());
            return false;
        }
    }
    */

}