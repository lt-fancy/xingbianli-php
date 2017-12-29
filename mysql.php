<?php
/* 数据库的配置*/
$host="localhost";
$db_user="root";
$db_pass="a8594588";
$db_name="bianli";

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);
$mysqli->query("SET names UTF8");