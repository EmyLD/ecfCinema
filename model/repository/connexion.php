<?php

$username = getenv('DB_USER_USERNAME');
$password = getenv('DB_USER_PASSWORD');


define('BDD', new PDO("mysql:host=localhost;dbname=ecf_cinema;charset=utf8", 'root', '')) ;

