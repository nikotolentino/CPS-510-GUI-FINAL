<?php

$dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
$conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => 0,
    PDO::ATTR_AUTOCOMMIT, true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));


$conn->exec("drop table DATE_JOINED cascade constraints purge");
$conn->exec("drop table NEWSLETTER cascade constraints purge");
$conn->exec("drop table CLIENT_ID_TO_CLIENT_EMAIL cascade constraints purge");
$conn->exec("drop table CARD cascade constraints purge");
$conn->exec("drop table CREDITACC cascade constraints purge");
$conn->exec("drop table DEBITACC cascade constraints purge");
$conn->exec("drop table TRANSACTIONS cascade constraints purge");
$conn->exec("drop table ACCOUNTS cascade constraints purge");
$conn->exec("drop table CLIENTS cascade constraints purge");
$conn->exec("drop table EMPLOYEE cascade constraints purge");
$conn->exec("drop table BRANCHES cascade constraints purge");

header('Location: /');

?>