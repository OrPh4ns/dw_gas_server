<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 30.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Web4 Class
 */

include "classes/Parser3.php";

class Web4 extends Parser3
{
    private Date $date;

    function __construct()
    {
        parent::__construct();
        $this->setUrl('https://www.tankstellenpreise.de/');
    }

}