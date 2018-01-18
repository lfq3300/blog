<?php 
define("WWWROOT",str_ireplace(str_replace("/","\\",$_SERVER['PHP_SELF']),'',__FILE__)."\\");
echo  WWWROOT;

?>