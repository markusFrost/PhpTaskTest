<?php
  

class DbHelper 
{
    public $sdb_name = "localhost";
		public $user_name = "admin";
		public $user_password = "123456";
		public $db_name = "blalvbalDBBB";
		
		// table names
		public $tableCalculations = "table_calculations";
		public $tableCodes = "table_codes";
		
		// table fields
		public $id = "_id";
		public $calc_id = "calc_id";
		public $name = "name";
		public $content = "content";
		public $code = "code";
		
		public function __construct()
		{
			// connection and initialization
			$link = mysql_connect($this->sdb_name,$this->user_name,$this->user_password);
			if (!$link)
			{
				echo "<br/>I can not connnect to the server.<br/>";
				exit();
			}


            if (!mysql_select_db( $this->db_name ))
            {
                mysql_query( 'CREATE DATABASE IF NOT EXISTS '.$this->db_name );
            }
            else
            {
                //echo $this->db_name.'  ';
            }
			
			if (!mysql_select_db($this->db_name,$link))
				{
					echo "<br/>I can not choose dateBase.<br/>";
					exit();
				}
				
			$query = "create table if not exists ".$this->tableCalculations." (".$this->id." INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ".$this->name." varchar(80), ".$this->content." text);";
			if (!mysql_query($query,$link))
				{
					echo "<br/>I can not connect table ".$this->tableCalculations."<br/>";
					echo $query."<br/>";
					exit();
				}
				
			$query = "create table if not exists ".$this->tableCodes." (".$this->id." INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ".$this->calc_id." integer, ".$this->code." integer);";			
			if (!mysql_query($query,$link))
				{
					echo "<br/>I can not connect table .$this->tableCodes.<br/>";
					echo $query."<br/>";
					exit();
				}

		}
		
		 public function __destruct()
		{
			mysql_close();
		}
		
		public function add ( $item)
		{           
                    mysql_query("set names cp1251");
			$query = "Insert into "."$this->tableCalculations"." ( "."$this->name".", "."$this->content".") values ( "."'$item->name'".", "."'$item->calc_content'".")";
			
                       // echo $query;
			$result = mysql_query($query);
			$res_id = mysql_insert_id();
                        
                        if ( $result )
                        {
                           // echo "Information was successfully added"."</br>"."List of codes :";
                        }
			
			//echo "</br>";
			foreach ($item->calc_result as &$value) 
			{
				$query = "Insert into "."$this->tableCodes"." ( "."$this->calc_id"." , "."$this->code".") values ( "."$res_id"." , "."$value".")";
				
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
                
                public function selectDate($numb, $type)
                {
                     mysql_query("set names cp1251");

   
                    //select distinct calc_id from table_codes where code = 26
                     $query1 = " select distinct ".$this->calc_id." from ".$this->tableCodes." where ".$this->code;
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

                        echo '<table id="show-all-calc-table" style="margin-top: 10px;" class="table table-bordered">';
                        echo '<tr class="info">';
                        echo '<th>ID</th>';
                        echo '<th>Project name</th>';
                        echo '<th>Calculations</th>';
                        echo '<th>Codes</th>';
                        echo '</tr>';
                        while ($r = mysql_fetch_assoc($res1)) {
                            $query = " select * from " . $this->tableCalculations . " where " . $this->id . " = " . $r[$this->calc_id];
                            //echo $query."</br>";
                            $result = mysql_query($query);
                            // echo "<table><tr><th>ID</th><th>Name</th><th>Text</th></tr>";
                            while ($row = mysql_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td>" . $row[$this->id] . "</td>";
                                echo "<td>" . $row[$this->name] . "</td>";
                                echo "<td>" . $row[$this->content] . "</td>";

                                $q = " select * from " . $this->tableCodes . " where " . $this->calc_id . " = " . $row[$this->id];
                                $res = mysql_query($q);
                                $value = "";
                                $index = 0;
                                while ($r = mysql_fetch_assoc($res)) {
                                    $value = $value . $r[$this->code] . " , ";
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
                        echo '<div id="empty-msg" class="col-sm-3 alert alert-info"><p>Search result is empty!</p></div>';
                    }
                }

            public function getAllInformation()
                {
                     mysql_query("set names cp1251");

                    $query = "select * from ".$this->tableCalculations."";
                    $result = mysql_query($query);
                    // echo "<table><tr><th>ID</th><th>Name</th><th>Text</th></tr>";

                    if ( mysql_num_rows( $result )  )
                    {
                        echo '<table id="show-all-calc-table" class="table table-bordered">';
                        echo '<tr class="info">';
                        echo '<th>ID</th>';
                        echo '<th>Project name</th>';
                        echo '<th>Calculations</th>';
                        echo '<th>Codes</th>';
                        echo '</tr>';

                        while ($row = mysql_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row[$this->id] . "</td>";
                            echo "<td>" . $row[$this->name] . "</td>";
                            echo "<td>" . $row[$this->content] . "</td><td>";

                            $q = " select * from " . $this->tableCodes . " where " . $this->calc_id . " = " . $row[$this->id];
                            $res = mysql_query($q);
                            $value = "";
                            $index = 0;
                            while ($r = mysql_fetch_assoc($res)) {
                                $value = $value . $r[$this->code] . " , ";
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
                        echo '<div id="empty-msg" class="col-sm-3 alert alert-info"><p>Calculations not found!</p></div>';
                    }
                }
                
}
