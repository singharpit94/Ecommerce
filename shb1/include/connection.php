<?php
//connection to database
require("const.php");
$connection = mysql_connect(HOST,US_NAME,PASS_W);
mysql_set_charset('UTF-8');
if(!$connection)
  die("cannot connect to database".mysql_error());
?>

<?php

 //selection of database
 $db_select= mysql_select_db(DB_NAME,$connection);
 
 if(!$db_select)
   die("cannot select the database".mysql_error());
   ?>