<?php
/*
 * Author       : Abdulrahman Othman
 * Created at   : 30.10.2022
 * Email        : abdulrahman.othman@web.de
 * Brief        : Web1 Class
 */



class Web1 extends Parser1
{
    private array $gas_types;
    private Date $date;

    function __construct()
    {
        parent::__construct();
        $this->setSourceId(1);
        $this->setUrl('https://www.benzinpreis-blitz.de/');
    }
}