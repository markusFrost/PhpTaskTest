<?php
include ('../models/Item.php');
include ('../models/Result.php');
include ('../db/DbHelper.php');

if ( $_SERVER["REQUEST_METHOD"] == "POST" )
{
    $item = new Item();
    $item->name =    iconv( 'UTF-8', 'windows-1251',    $_POST['calc-name'] );
    $item->calc_content =    iconv( 'UTF-8', 'windows-1251',  $_POST['textContent']  );

    /*$dbHelper = new DbHelper();
    $dbHelper->add($item->getCodes());*/


    DbHelper::getInstance();
    DbHelper::add($item->getCodes());



    //var_dump( $item->getCodes()->calc_result );
}




?>