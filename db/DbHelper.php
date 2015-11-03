<?php

define("SDB_NAME" , "localhost");
define("USER_NAME" , "admin");
define("USER_PASSWORD" , "123456");
define("DB_NAME" , "blalvbalDBBB");

// table NAMEs
define("TABLE_CALCULATIONS" , "table_calculations");
define("TABLE_CODES" , "table_codes");

// table fields
define("ID" , "_id");
define("CALC_ID" , "calc_id");
define("NAME" , "name");
define("CONTENT" , "content");
define("CODE" , "code");

class DbHelper
{
    protected static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null)
        {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    private function __clone(){}

    private function __wakeup(){}

    private function __construct()
    {
        // connection and initialization
        $link = mysql_connect(SDB_NAME,USER_NAME,USER_PASSWORD);
        if (!$link)
        {
            echo "<br/>I can not connnect to the server.<br/>";
            exit();
        }


        if (!mysql_select_db( DB_NAME ))
        {
            mysql_query( 'CREATE DATABASE IF NOT EXISTS '.DB_NAME );
        }
        else
        {
            //echo DB_NAME.'  ';
        }

        if (!mysql_select_db(DB_NAME,$link))
        {
            echo "<br/>I can not choose dateBase.<br/>";
            exit();
        }

        $query = "create table if not exists ".TABLE_CALCULATIONS." (".ID." INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ".NAME." varchar(80), ".CONTENT." text);";
        if (!mysql_query($query,$link))
        {
            echo "<br/>I can not connect table ".TABLE_CALCULATIONS."<br/>";
            echo $query."<br/>";
            exit();
        }

        $query = "create table if not exists ".TABLE_CODES." (".ID." INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ".CALC_ID." integer, ".CODE." integer);";
        if (!mysql_query($query,$link))
        {
            echo "<br/>I can not connect table .TABLE_CODES.<br/>";
            echo $query."<br/>";
            exit();
        }

    }

    public function __destruct()
    {
        mysql_close();
    }

    public static function add ( $item)
    {
        mysql_query("set NAMEs cp1251");
        $query = "Insert into "."TABLE_CALCULATIONS"." ( "."NAME".", "."CONTENT".") values ( "."'$item->name'".", "."'$item->calc_content'".")";

        // echo $query;
        $result = mysql_query($query);
        $res_id = mysql_insert_id();

        if ( $result )
        {
            // echo "Information was successfully added"."</br>"."List of CODEs :";
        }

        //echo "</br>";
        foreach ($item->calc_result as &$value)
        {
            $query = "Insert into "."TABLE_CODES"." ( "."CALC_ID"." , "."CODE".") values ( "."$res_id"." , "."$value".")";

            $result = mysql_query($query);

            if ( $result == true)
            {
                echo $value.", ";
                // echo $query." - ".var_dump($result)."</br>";
            }
        }

        if (sizeof($item->calc_result ) == 0)
        {
            echo 'No codes';
        }
        //echo "</br>";


    }

    public static function selectDate($numb, $type)
    {
        mysql_query("set NAMEs cp1251");


        //select distinct CALC_ID from table_CODEs where CODE = 26
        $query1 = " select distinct ".CALC_ID." from ".TABLE_CODES." where ".CODE;
        if ( strcmp($type, "Less") == 0)
        {
            $query1 = $query1." < ".$numb;
        }
        else if ( strcmp($type, "Large") == 0)
        {
            $query1 = $query1." > ".$numb;
        }
        else if ( strcmp($type, "Equal") == 0)
        {
            $query1 = $query1." = ".$numb;
        }

        // echo $query1."</br>";

        $res1 = mysql_query($query1);

        if ( mysql_num_rows( $res1 ) )
        {

            echo '<table ID="show-all-calc-table" style="margin-top: 10px;" class="table table-bordered">';
            echo '<tr class="info">';
            echo '<th>ID</th>';
            echo '<th>Project name</th>';
            echo '<th>Calculations</th>';
            echo '<th>Codes</th>';
            echo '</tr>';
            while ($r = mysql_fetch_assoc($res1)) {
                $query = " select * from " . TABLE_CALCULATIONS . " where " . ID . " = " . $r[CALC_ID];
                //echo $query."</br>";
                $result = mysql_query($query);
                // echo "<table><tr><th>ID</th><th>Name</th><th>Text</th></tr>";
                while ($row = mysql_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>" . $row[ID] . "</td>";
                    echo "<td>" . $row[NAME] . "</td>";
                    echo "<td>" . $row[CONTENT] . "</td>";

                    $q = " select * from " . TABLE_CODES . " where " . CALC_ID . " = " . $row[ID];
                    $res = mysql_query($q);
                    $value = "";
                    $index = 0;
                    while ($r = mysql_fetch_assoc($res)) {
                        $value = $value . $r[CODE] . " , ";
                        $index++;
                        if ($index % 10 == 0) {
                            $value = $value . "</br>";
                        }
                    }
                    echo "<td>" . $value . "</td>";
                    echo "</tr>";

                }


            }
            echo '</table>';
        }
        else
        {
            echo '<div ID="empty-msg" class="col-sm-3 alert alert-info"><p>Search result is empty!</p></div>';
        }
    }

    public static function getAllInformation()
    {
        mysql_query("set NAMEs cp1251");

        $query = "select * from ".TABLE_CALCULATIONS."";
        $result = mysql_query($query);
        // echo "<table><tr><th>ID</th><th>Name</th><th>Text</th></tr>";

        if ( mysql_num_rows( $result )  )
        {
            echo '<table ID="show-all-calc-table" class="table table-bordered">';
            echo '<tr class="info">';
            echo '<th>ID</th>';
            echo '<th>Project name</th>';
            echo '<th>Calculations</th>';
            echo '<th>Codes</th>';
            echo '</tr>';

            while ($row = mysql_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row[ID] . "</td>";
                echo "<td>" . $row[NAME] . "</td>";
                echo "<td>" . $row[CONTENT] . "</td><td>";

                $q = " select * from " . TABLE_CODES . " where " . CALC_ID . " = " . $row[ID];
                $res = mysql_query($q);
                $value = "";
                $index = 0;
                while ($r = mysql_fetch_assoc($res)) {
                    $value = $value . $r[CODE] . " , ";
                    $index++;
                    if ($index % 10 == 0) {
                        $value = $value . "</br>";
                    }
                }
                echo "" . $value . "</td></tr>";

            }
            echo '</table>';
        }
        else
        {
            echo '<div ID="empty-msg" class="col-sm-3 alert alert-info"><p>Calculations not found!</p></div>';
        }
    }

}
