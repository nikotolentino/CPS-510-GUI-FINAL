<?php

$dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
$conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => 0,
    PDO::ATTR_AUTOCOMMIT, true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

$conn->exec("ALTER SESSION SET NLS_TIMESTAMP_FORMAT = 'YYYY-MM-DD HH24:MI:SS.FF9'");

$conn->exec("INSERT INTO branches (branch_id, branch_phoneNo, branch_name, branch_street, branch_postalCode, branch_city, bm_name) VALUES (1, '416-001-002', 'Midland and Lawrence', '17 Romulus Drive', 'M1K 4C1', 'Scarborough', 'John Tolentino')");
$conn->exec("INSERT INTO branches (branch_id, branch_phoneNo, branch_name, branch_street, branch_postalCode, branch_city, bm_name) VALUES (2, '647-999-9999', 'Kennedy and Eglinton', '123 Sesame Street', 'A1B 2C3', 'Brampton', 'Lea Park')");
$conn->exec("INSERT INTO branches (branch_id, branch_phoneNo, branch_name, branch_street, branch_postalCode, branch_city, bm_name) VALUES (3, '647-931-9959', 'James and Jameson', '1 JL Rd', 'B2A 5C5', 'Brampton', 'Ivana Poota')");
$conn->exec("INSERT INTO branches (branch_id, branch_phoneNo, branch_name, branch_street, branch_postalCode, branch_city, bm_name) VALUES (4, '647-945-7891', 'A and B', '13 Cent Street', 'Z9U 2U3', 'Brampton', 'Candace Shaffte')");
$conn->exec("INSERT INTO branches (branch_id, branch_phoneNo, branch_name, branch_street, branch_postalCode, branch_city, bm_name) VALUES (5, '416-745-7713', 'Yonge and Dundas', '8 George St', 'I4U 2J8', 'Toronto', 'Ben Downsoh')");
$conn->exec("INSERT INTO clients (client_id, client_name, client_phoneNo, branch_id, branch_name, branch_phoneNo, client_street, client_postalCode, client_city, dob, join_date) VALUES (1, 'LeBron James', '416-286-0197', 2, 'Kennedy and Eglinton', '647-999-9999', '1 Mentmore Crescent', 'Z9Z 9Z9', 'Brampton', '1984-12-30', TO_TIMESTAMP('2021-11-26 05:18:24.574225000', 'YYYY-MM-DD HH24:MI:SS.FF9'))");
$conn->exec("INSERT INTO clients (client_id, client_name, client_phoneNo, branch_id, branch_name, branch_phoneNo, client_street, client_postalCode, client_city, dob, join_date) VALUES (2,'Kobe Bryant', '416-824-1512', 1, 'Midland and Lawrence', '416-001-002','1 Brimmond Rd', 'K8B 2B4', 'Scarborough', '1978-08-23', TO_TIMESTAMP('2021-11-26 05:20:25.225403000', 'YYYY-MM-DD HH24:MI:SS.FF9'))");
$conn->exec("INSERT INTO clients (client_id, client_name, client_phoneNo, branch_id, branch_name, branch_phoneNo, client_street, client_postalCode, client_city, dob, join_date) VALUES (3, 'Fred VanVleet', '416-821-1512', 3, 'James and Jameson', '647-931-9959', '1 Brim Rd', 'K8E 2B4', 'Scarborough', '1993-10-16', TO_TIMESTAMP('2021-11-26 05:20:30.262402000', 'YYYY-MM-DD HH24:MI:SS.FF9'))");
$conn->exec("INSERT INTO clients (client_id, client_name, client_phoneNo, branch_id, branch_name, branch_phoneNo, client_street, client_postalCode, client_city, dob, join_date) VALUES (4, 'Pascal Siakam', '123-123-1234', 5, 'Yonge and Dundas', '416-745-7713', '1 Dude Rd', 'K8C 2C2', 'Brampton','1999-08-02', TO_TIMESTAMP('2021-11-26 05:20:35.729610000', 'YYYY-MM-DD HH24:MI:SS.FF9'))");
$conn->exec("INSERT INTO clients (client_id, client_name, client_phoneNo, branch_id, branch_name, branch_phoneNo, client_street, client_postalCode, client_city, dob, join_date) VALUES (5, 'Kanye West', '416-111-1111', 4, 'A and B', '647-945-7891', '1 Ye Rd', 'Y3Y 3Y3', 'Scarborough', '1901-01-01', TO_TIMESTAMP('2021-11-26 05:20:44.315049000', 'YYYY-MM-DD HH24:MI:SS.FF9'))");
$conn->exec("INSERT INTO date_joined (join_date,member_status) VALUES (TO_TIMESTAMP('2021-11-26 05:18:24.574225000', 'YYYY-MM-DD HH24:MI:SS.FF9'), 0)");
$conn->exec("INSERT INTO date_joined (join_date,member_status) VALUES (TO_TIMESTAMP('2021-11-26 05:20:25.225403000', 'YYYY-MM-DD HH24:MI:SS.FF9'), 0)");
$conn->exec("INSERT INTO date_joined (join_date,member_status) VALUES (TO_TIMESTAMP('2021-11-26 05:20:30.262402000', 'YYYY-MM-DD HH24:MI:SS.FF9'), 0)");
$conn->exec("INSERT INTO date_joined (join_date,member_status) VALUES (TO_TIMESTAMP('2021-11-26 05:20:35.729610000', 'YYYY-MM-DD HH24:MI:SS.FF9'), 0)");
$conn->exec("INSERT INTO date_joined (join_date,member_status) VALUES (TO_TIMESTAMP('2021-11-26 05:20:44.315049000', 'YYYY-MM-DD HH24:MI:SS.FF9'), 0)");
$conn->exec("INSERT INTO client_id_to_client_email (client_id, client_email) VALUES (1,'lebronjames@gmail.com')");
$conn->exec("INSERT INTO client_id_to_client_email (client_id, client_email) VALUES (2,'kobe24@gmail.com')");
$conn->exec("INSERT INTO client_id_to_client_email (client_id, client_email) VALUES (3,'fvv@gmail.com')");
$conn->exec("INSERT INTO client_id_to_client_email (client_id, client_email) VALUES (4,'spicyp@gmail.com')");
$conn->exec("INSERT INTO client_id_to_client_email (client_id, client_email) VALUES (5,'yeezus@gmail.com')");
$conn->exec("INSERT INTO newsletter (client_email, newsletter_subscription) VALUES ('lebronjames@gmail.com', 1)");
$conn->exec("INSERT INTO newsletter (client_email, newsletter_subscription) VALUES ('kobe24@gmail.com', 1)");
$conn->exec("INSERT INTO newsletter (client_email, newsletter_subscription) VALUES ('fvv@gmail.com', 0)");
$conn->exec("INSERT INTO newsletter (client_email, newsletter_subscription) VALUES ('spicyp@gmail.com', 1)");
$conn->exec("INSERT INTO newsletter (client_email, newsletter_subscription) VALUES ('yeezus@gmail.com', 0)");
$conn->exec("INSERT INTO accounts (account_number, client_id, card_number) VALUES (84541236, 1, 1242532442341234)");
$conn->exec("INSERT INTO accounts (account_number, client_id, card_number) VALUES (32141234, 2, 9865359865891567)");
$conn->exec("INSERT INTO accounts (account_number, client_id, card_number) VALUES (58954852, 3, 9865396586891567)");
$conn->exec("INSERT INTO accounts (account_number, client_id, card_number) VALUES (48535478, 4, 9698459865891567)");
$conn->exec("INSERT INTO accounts (account_number, client_id, card_number) VALUES (12498762, 5, 9255359954791567)");
$conn->exec("INSERT INTO card (card_number, balance) VALUES (1242532442341234, 20000)");
$conn->exec("INSERT INTO card (card_number, balance) VALUES (9865359865891567, 50000)");
$conn->exec("INSERT INTO card (card_number, balance) VALUES (9865396586891567, 1010)");
$conn->exec("INSERT INTO card (card_number, balance) VALUES (9698459865891567, 70545)");
$conn->exec("INSERT INTO card (card_number, balance) VALUES (9255359954791567, 2109)");
$conn->exec("INSERT INTO creditAcc (card_number, credit_limit) VALUES (1242532442341234, 40000)");
$conn->exec("INSERT INTO creditAcc (card_number, credit_limit) VALUES (9865359865891567, 50000)");
$conn->exec("INSERT INTO debitAcc (card_number, debit_limit) VALUES (9865396586891567, 5000)");
$conn->exec("INSERT INTO debitAcc (card_number, debit_limit) VALUES (9698459865891567, 100000)");
$conn->exec("INSERT INTO debitAcc (card_number, debit_limit) VALUES (9255359954791567, 7500)");
$conn->exec("INSERT INTO transactions (transaction_id, amount, fromAcc, toAcc, transaction_type, description, transfer_date) VALUES (765435345, 75.99,84541236,6672345120467230,'R','Received 75.99', LOCALTIMESTAMP)");
$conn->exec("INSERT INTO transactions (transaction_ID, amount, fromAcc, toAcc, transaction_type, description, transfer_date) VALUES (324234534, 1.99, 32141234,2345435334543340,'S','Spent 1.99 on McDonald''s', LOCALTIMESTAMP)");
$conn->exec("INSERT INTO transactions (transaction_ID, amount, fromAcc, toAcc, transaction_type, description, transfer_date) VALUES (123432342, 544.32,32141234,1454353532342342,'S','Spent 544.32 on Amazon', LOCALTIMESTAMP)");
$conn->exec("INSERT INTO transactions (transaction_ID, amount, fromAcc, toAcc, transaction_type, description, transfer_date) VALUES (143732365, 1700.32,84541236,1454353532342342,'S','Spent 1700.32 on LCBO', LOCALTIMESTAMP)");
$conn->exec("INSERT INTO transactions (transaction_ID, amount, fromAcc, toAcc, transaction_type, description, transfer_date) VALUES (143932965, 850.5,12498762,1454353992342342,'S','Spent 850.5 on Amazon', LOCALTIMESTAMP)");
$conn->exec("INSERT INTO employee (employee_id, employee_name, employee_phoneNo, work_email, position, salary, manager_name, branch_id, branch_phoneNo, branch_name) VALUES (1, 'Steph Curry', '333-333-3333', 'sc30@bankdomain.com', 'receptionist',  20000, 'Steve Kerr', 2, '647-999-9999', 'Kennedy and Eglinton')");
$conn->exec("INSERT INTO employee (employee_id, employee_name, employee_phoneNo, work_email, position, salary, manager_name, branch_id, branch_phoneNo, branch_name) VALUES (2, 'Kevin Durant', '325-333-3333', 'kd35@bankdomain.com', 'receptionist', 30000, 'Steve Nash', 1, '416-001-002', 'Midland and Lawrence')");
$conn->exec("INSERT INTO employee (employee_id, employee_name, employee_phoneNo, work_email, position, salary, manager_name, branch_id, branch_phoneNo, branch_name) VALUES (3, 'Jayson Tatum', '222-222-222', 'jt0@bankdomain.com', 'teller', 40000, 'Ime Udoka', 3, '647-931-9959', 'James and Jameson')");
$conn->exec("INSERT INTO employee (employee_id, employee_name, employee_phoneNo, work_email, position, salary, manager_name, branch_id, branch_phoneNo, branch_name) VALUES (4, 'Anthony Davis', '444-444-4444', 'ad23@bankdomain.com', 'security', 50000, 'Frank Vogel', 5, '416-745-7713', 'Yonge and Dundas')");
$conn->exec("INSERT INTO employee (employee_id, employee_name, employee_phoneNo, work_email, position, salary, manager_name, branch_id, branch_phoneNo, branch_name) VALUES (5, 'Luka Doncic', '555-555-5555', 'ld77@bankdomain.com', 'fiancial advisor', 75000, 'Jason Kidd', 4, '647-945-7891', 'A and B')");



header('Location: /');



?>
