<!DOCTYPE html>
<html lang="en">
<head>
    <!--        <meta charset="windows-1251">-->

    <meta charset="utf-8">
    <title>PHP Task - List of Calculations</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</head>
<body>

<div id="block-content">
    <div class="row">
        <h1 style="text-align: center;">Table of calculations</h1>
        <div class="col-sm-10 col-sm-offset-1">
        <?php
        include ('db/DbHelper.php');
        DbHelper::getInstance();
        DbHelper::getAllInformation();
            ?>
    </div>
    </div>


</div>



</body>
</html>