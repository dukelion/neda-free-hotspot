<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/26/13
 * Time: 6:21 PM
 * To change this template use File | Settings | File Templates.
 */
define("APIKEY", "SECRETPASS");
define("ANTAURL", "http://103.244.144.51:82");

define("DBHOST", "localhost");
define("DBUSER", "freehotspot");
define("DBPASS", "password");
define("DBNAME", "freehotspot");

define("TICKET_VALID_SECONDS", 3600);


include dirname(__FILE__) . "/lib/flourish/fLoader.php";
fLoader::best();


