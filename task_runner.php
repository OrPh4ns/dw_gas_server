<?php

spl_autoload_register(function ($className)
{
    include 'classes/' . $className . '.php';
});

echo '
#############################################
### Welcome to Petrol Analyzer            ###
### Coded By Abdulrahman Othman ][ THM-DW ###
### WS 2023                               ###
### Enjoy it                              ###
#############################################
';
sleep(4);

$web4 = new Web4();
$web3 = new Web3();
$web2 = new Web2();
$web1 = new Web1();

while (1)
{
    if(!$web4->parse())  if(!$web3->parse()) if(!$web2->parse()) if(!$web1->parse()) continue;
}
