<?php

$dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
$conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => 0,
    PDO::ATTR_AUTOCOMMIT, true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));



$conn->exec("create table branches
(
    branch_id number NOT NULL,
    branch_phoneNo char(12) NOT NULL,
    branch_name char(64) NOT NULL,
    branch_street char(64) NOT NULL,
    branch_postalCode char(7) NOT NULL,
    branch_city char(16) NOT NULL,
    bm_name char(64) NOT NULL,
    CONSTRAINT PK_branches
        PRIMARY KEY (branch_id, branch_phoneNo, branch_name)
)");

$conn->exec("create table clients
(
    client_id number NOT NULL,
    client_name char(64) NOT NULL,
    client_phoneNo char(12) NOT NULL,
    branch_id number NOT NULL,
    branch_name char(64) NOT NULL,
    branch_phoneNo char(12) NOT NULL,
    client_street char(64) NOT NULL,
    client_postalCode char(7) NOT NULL,
    client_city char(16) NOT NULL,
    dob char(10) NOT NULL,
    join_date timestamp(6) UNIQUE NOT NULL,
    CONSTRAINT PK_clients_client_id
        PRIMARY KEY (client_id),
    CONSTRAINT FK_clients_branch_id
        FOREIGN KEY (branch_id, branch_phoneNo, branch_name)
            REFERENCES branches(branch_id, branch_phoneNo, branch_name)
)");

$conn->exec("create table date_joined
(
    join_date timestamp(6) NOT NULL,
    member_status number(1) NOT NULL,
    CONSTRAINT PK_date_joined_join_date
        PRIMARY KEY (join_date),
    CONSTRAINT FK_date_joined_join_date
        FOREIGN KEY (join_date)
            REFERENCES clients(join_date)
)");

$conn->exec("create table client_id_to_client_email
(
    client_id number NOT NULL,
    client_email char(64) UNIQUE NOT NULL,
    CONSTRAINT PK_clientToEmail
        PRIMARY KEY (client_id),
    CONSTRAINT FK_clientToEmail
        FOREIGN KEY (client_id)
            REFERENCES clients(client_id)
)");

$conn->exec("create table newsletter
(
    client_email char(64) NOT NULL,
    newsletter_subscription number(1) NOT NULL,
    CONSTRAINT PK_newsletter_client_email
        PRIMARY KEY(client_email),
    CONSTRAINT FK_newsletter_client_email
        FOREIGN KEY(client_email)
            REFERENCES client_id_to_client_email(client_email)
)");

$conn->exec("create table accounts
(
    account_number number NOT NULL,
    client_id number NOT NULL,
    card_number number UNIQUE NOT NULL,
    CONSTRAINT PK_accounts_account_number
        PRIMARY KEY(account_number),
    CONSTRAINT FK_accounts_client_id
        FOREIGN KEY(client_id)
            REFERENCES clients(client_id)
)");

$conn->exec("create table card
(
    card_number number NOT NULL,
    balance number (20,2) NOT NULL,
    CONSTRAINT PK_card_card_number
        PRIMARY KEY(card_number),
    CONSTRAINT FK_card_card_number
        FOREIGN KEY(card_number)
            REFERENCES accounts(card_number)
)");

$conn->exec("create table creditAcc
(
    card_number number NOT NULL,
    credit_limit number (20,2) NOT NULL,
    CONSTRAINT PK_creditAcc_card_number
        PRIMARY KEY(card_number),
    CONSTRAINT FK_creditAcc_card_number
        FOREIGN KEY(card_number)
            REFERENCES accounts(card_number)
)");

$conn->exec("create table debitAcc
(
    card_number number NOT NULL,
    debit_limit number (20,2) NOT NULL,
    CONSTRAINT PK_card_number_debitAcc
        PRIMARY KEY(card_number),
    CONSTRAINT FK_card_number_debittAcc
        FOREIGN KEY(card_number)
            REFERENCES accounts(card_number)
)");

$conn->exec("create table transactions
(
    transaction_id number NOT NULL,
    amount number (20,2) NOT NULL,
    fromAcc number NOT NULL,
    toAcc number NOT NULL,
    transaction_type char NOT NULL,
    description varchar2(500),
    transfer_date timestamp(6) NOT NULL,
    CONSTRAINT PK_transactions_transaction_id
        PRIMARY KEY (transaction_id),
    CONSTRAINT FK_transactions_fromAcc
        FOREIGN KEY (fromAcc)
            REFERENCES accounts(account_number)
)");

$conn->exec("create table employee
(
    employee_id number NOT NULL,
    employee_phoneNo char(12) NOT NULL,
    work_email char(64) NOT NULL,
    employee_name char(64) NOT NULL,
    manager_name char(64) NOT NULL,
    position char(64) NOT NULL,
    salary number(20,2) NOT NULL,
    branch_id number NOT NULL,
    branch_phoneNo char(12) NOT NULL,
    branch_name char(64) NOT NULL,
    CONSTRAINT PK_employee_pkc
        PRIMARY KEY (employee_id, employee_phoneNo, work_email),
    CONSTRAINT FK_employee_pkc
        FOREIGN KEY (branch_id, branch_phoneNo, branch_name)
            REFERENCES branches(branch_id, branch_phoneNo, branch_name)
)");





header('Location: /');

?>