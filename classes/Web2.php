<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 30.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Web2 Class
 */


include "classes/Parser1.php";

class Web2 extends Parser1
{
    private array $gas_types;
    private Date $date;

    function __construct()
    {
        parent::__construct();
        $this->setSourceId(2);
        $this->setUrl('https://www.verbrauchsrechner.de/spritpreise/');
    }
}