<?php

$username = 'root';
$password = '';
$db = new PDO( 'mysql:host=localhost;dbname=pascovichtfc', $username, $password );

require 'ses.php';
$user = new USER($db);
?>