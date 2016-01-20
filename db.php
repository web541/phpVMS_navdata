<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

$db = mysql_connect('localhost', 'db username goes here', 'db password goes here');
mysql_select_db('db server name goes here');

define('NAV_NDB', 2);
define('NAV_VOR', 3);
define('NAV_DME', 4);
define('NAV_FIX', 5);