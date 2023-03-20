<?php

spl_autoload_register(function ($className)
{
    include 'classes/' . $className . '.php';
});


echo Address::insertAddress_throw_city('XXX', 'Kiel', '35410');

