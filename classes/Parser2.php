<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 11.11.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Parser2 Class
 */
abstract class Parser2
{
    private Date        $date;

    public function __construct()
    {
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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function parse(): bool
    {
        echo "\n Parse on $this->url ][ Start \n";
        static $obj_counter = 0;
        try {
            /* Getting Randomed Value between 5 and 8 for sleeping timer*/
            if (!$random_sleep_timer = random_int(5, 8)) throw Exception("\033[32m ERROR");

            foreach (Address::getCities() as $city)
            {
                //echo "$city[0] \n";
                $obj_counter++;

                if (!@file_get_contents($this->getUrl() . $city[0]))
                {
                    echo "\033[33m $obj_counter ][ [$city[0] Field Parsed \n";
                    sleep($random_sleep_timer);
                    continue;
                }
                try
                {
                    @Connect::setURL($this->getUrl() . $city[0]);
                    if($list = @Connect::findAll('div[class="stations"]'))
                    {
                        if
                        ($list->find('div[class="name"]') and $list->find('div[class="street"]')
                        and
                            $list->find('div[class="city"]') and $list->find('div[class="col2 diesel"]')
                        and
                            $list->find('div[class="col3 e5"]') and $list->find('div[class="col4 e10"]')
                        )
                        {
                            $list_array_names = $list->find('div[class="name"]');
                            $list_array_street = $list->find('div[class="street"]');
                            $list_array_city = $list->find('div[class="city"]');
                            $list_array_diesel = $list->find('div[class="col2 diesel"]');
                            $list_array_e5 = $list->find('div[class="col3 e5"]');
                            $list_array_e10 = $list->find('div[class="col4 e10"]');

                            for ($i = 0; $i < sizeof($list_array_names); $i++)
                            {
                                $name = $list_array_names[$i]->plaintext;
                                $e5 = $list_array_e5[$i]->plaintext;
                                $e10 = $list_array_e10[$i]->plaintext;
                                $diesel = $list_array_diesel[$i]->plaintext;
                                $street = $list_array_street[$i]->plaintext;

                                $zip_city = $list_array_city[$i]->plaintext;
                                if(preg_match_all('/\d+/', $zip_city, $numbers))
                                {
                                    $zip = end($numbers[0]);
                                    $str_pos = strpos($zip_city, $zip);
                                    $city_af = substr($zip_city, $str_pos+6, strlen($zip_city));
                                }
                                Address::insertAddress_throw_city($street, $city_af, $zip);
                                $this->date->insertCurrentInfos();
                                Station::insertStation($name);
                                FactClass::createFast(Address::getId(), $this->date->getDateId(), 1, Station::getStationID(), 3, $this->getPrice($e5));
                                FactClass::createFast(Address::getId(), $this->date->getDateId(), 2, Station::getStationID(), 3, $this->getPrice($e10));
                                FactClass::createFast(Address::getId(), $this->date->getDateId(), 3, Station::getStationID(), 3, $this->getPrice($diesel));
                            }
                            echo "\033[32m $obj_counter ][ [$city[0]] Successfully Parsed\n";
                            sleep($random_sleep_timer);
                        }
                        else
                        {
                            echo "\033[33m $obj_counter ][ [$city[0] Field Parsed \n";
                            sleep($random_sleep_timer);
                            continue;
                        }
                    }
                    else
                    {
                        echo "\033[33m $obj_counter ][ [$city[0] Field Parsed \n";
                        sleep($random_sleep_timer);
                        continue;
                    }
                }
                catch (Exception $e)
                {
                    echo "\033[33m $obj_counter ][ [$city[0] Field Parsed \n";
                    sleep($random_sleep_timer);
                    continue;
                }
            }
            return true;
        } catch
        (Exception $e) {
            DB::doDebug($e->getMessage());
            return false;
        }
    }

    /**
     * @param $city
     * @return void
     */
    public function write_not_city($city): void
    {
        $fp = fopen('city_error.txt', 'a');
        fwrite($fp, $city);
        fclose($fp);
    }

    /**
     * @param $text
     * @return string
     */
    public function getPrice($text): string
    {
        $pos = strpos($text, ' ');
        $str = substr($text, 0, $pos);
        return str_replace(",", ".", $str);
    }

}