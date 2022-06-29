<?php

$dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
$conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => 0,
    PDO::ATTR_AUTOCOMMIT, true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));


$conn->exec("CREATE VIEW debit_c as
select accounts.card_number, card.balance, debitacc.debit_limit
from accounts
INNER JOIN debitacc
ON accounts.card_number = debitacc.card_number
INNER JOIN card
ON card.card_number = accounts.card_number");

$conn->exec("CREATE VIEW credit_c as
select accounts.card_number, card.balance, creditacc.credit_limit
from accounts
INNER JOIN creditacc
ON accounts.card_number = creditacc.card_number
INNER JOIN card
ON card.card_number = accounts.card_number");

$conn->exec("CREATE VIEW basic_employee_info as
select employee_name, Work_email, position, employee_phoneno
from employee");

header('Location: /');
?>