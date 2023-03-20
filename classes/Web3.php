<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 30.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Web3 Class
 */


include "classes/Parser2.php";

class Web3 extends Parser2
{
    private Date $date;

    function __construct()
    {
        parent::__construct();
        $this->setUrl('https://www.tanke-guenstig.de/Benzinpreise/');
    }

}