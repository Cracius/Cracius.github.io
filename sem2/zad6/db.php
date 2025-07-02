<?php
$db = new PDO('mysql:host=localhost;dbname=u68786', 'u68786', '3696042', [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);