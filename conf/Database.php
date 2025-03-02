<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=' . DB_NAME . ';port=3306', DB_USER, DB_PASSWORD);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
