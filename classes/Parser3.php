<?php

abstract class Parser3
{
    private Date $date;
    private string $url;
    /**
     * @var int[]
     */
    private array $gas_types;

    public function __construct()
    {
        $this->gas_types = array(1 => 2, 2 => 1, 3 => 0);
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function parse(): bool
    {
        static $obj_counter = 0;
        try {
            /* Getting Randomed Value between 5 and 8 for sleeping timer*/
            if (!$random_sleep_timer = random_int(5, 8)) throw Exception("\033[32m ERROR");

            foreach (Address::getZips() as $zip_object)
            {
                foreach ($this->gas_types as $type_object)
                {
                    $obj_counter++;
                    //suche.html?sorte=0&o=35396&u=5&lat=0&lon=0&s=1
                    //echo "Type = $type_object and zip = $zip_object[0] \n";
                    Connect::setURL($this->url . "/suche.html?sorte=" . $type_object . "&o=" . $zip_object[0] . "&u=5&lat=0&lon=0&s=1");
                    if (!$html = Connect::findAll('div[class="ts relative"]'))
                    {
                        echo "\033[33m Counter = $obj_counter ][ Type = $zip_object[0] Field Parsed \n";
                        self::write_not_zip("$zip_object[0] \n");
                        sleep($random_sleep_timer);
                        continue;
                    }
                    else
                    {
                        if($html->find('[class="preisformat"]') && $html->find('[div[class="adresse"]')
                        && $html->find('div[class="name"]') && $html->find('span[class="placetohide"]')
                        )
                        {
                            $list_array_price = $html->find('[class="preisformat"]');
                            $list_array_address = $html->find('[div[class="adresse"]');
                            $list_array_name = $html->find('div[class="name"]');
                            $list_array_city = $html->find('span[class="placetohide"]');
                            for ($i = 0; $i < sizeof($list_array_price); $i++)
                            {
                                $price = $list_array_price[$i]->plaintext;
                                $station = $list_array_name[$i]->plaintext;
                                $city = $list_array_city[$i]->plaintext;
                                $street = preg_split('#\r?\n#', $list_array_address[$i]->plaintext, 2)[0];
                                //$address = $list_array_address[$i]->plaintext;
                                if(preg_match_all('/\d+/', $list_array_address[$i]->plaintext, $numbers))
                                {
                                    $zip = end($numbers[0]);
                                }
                                //echo " zip = $zip \n";
                                //echo " Adresse = $address \n";
                                Address::insertAddress_throw_zip($street, $city, $zip, $zip_object[0]);
                                Station::insertStation($station);
                                $gasType_id = array_search($type_object, $this->gas_types);
                                //$this->date->insertCurrentInfos();
                                $this->date = new Date();
                                $this->date->insertCurrentInfos();
                                FactClass::createFast(Address::getId(), $this->date->getDateId(), $gasType_id, Station::getStationID(), 4, $price);
                            }
                            echo "\033[32m Counter = $obj_counter ][ Zip = $zip_object[0] ][ Type = $type_object] Successfully Parsed \n";
                            sleep($random_sleep_timer);
                        }
                        else
                        {
                            echo "\033[33m Counter = $obj_counter ][ Type = $zip_object[0] Field Parsed \n";
                            continue;
                            sleep($random_sleep_timer);
                        }

                    }
                }
            } return true;
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
    public function write_not_zip($zip): void
    {
        $fp = fopen('zip_error.txt', 'a');
        fwrite($fp, $zip);
        fclose($fp);
    }
}