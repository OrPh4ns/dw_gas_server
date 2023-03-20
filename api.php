<?php

spl_autoload_register(function ($className)
{
    include 'classes/' . $className . '.php';
});


if(isset($_GET['graf']))
{
    if($_GET['graf']==1)
    {
        $e5 = substr(Statistics::getAVGE5()[0], 0,4);
        $e10 = substr(Statistics::getAVGE10()[0], 0,4);
        $diesel = substr(Statistics::getAVGDiesel()[0], 0,4);
        $list = array("e5"=>$e5,"e10"=>$e10, "diesel"=>$diesel);
        print_r(json_encode($list));
    }
    else if($_GET['graf']==2)
    {

        $list = array();
        //var_dump(Statistics::getStationAVGPrice());
        $obj = Statistics::getStationAVGPrice();
        for ($i = 0; $i < count($obj); $i++)
        {
            $list += array($i=>substr($obj[$i]['price'], 0,4));
        }
        print_r(json_encode($list));
    }
}

?>