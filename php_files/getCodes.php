<?php
if ( $_SERVER["REQUEST_METHOD"] == "GET" )
{
    $numb = $_GET['numb'];
    $type = $_GET['type'];

    include ('../db/DbHelper.php');

    DbHelper::getInstance();
    DbHelper::selectDate($numb, $type);
}
?>