<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CPS-510 A9</title>
  <meta name="description" content="CPS510 GUI Template">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
  <main class="p-5">
    <div id="query-table" class="border">
        <?php
        if(isset($_GET['tables']) and strlen($_GET['tables']) != 0){
            $dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
            $conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => 0,
                PDO::ATTR_AUTOCOMMIT, true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

            $sql = $conn->prepare($_GET["tables".substr($_GET['tables'],0,1)]);
            $sql->execute();

            echo "<table class='table' border='1'>\n";
            echo "<tr>\n";
            for ($i = 0; $i < $sql->columnCount(); $i++){
                echo "<td>".$sql->getColumnMeta($i)["name"]."</td>";
            }
            echo "</tr>\n";
            while ($row = $sql->fetch() ){
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
        }
        ?>
    </div>

    <!-- Put the buttons here Need to add more tables-->
    <form>
      <label for="tables">Choose a Table:</label>
      <select id="tables" name="tables">
        <option hidden disabled selected value> select an option </option>
        <option value="1.clients">Client</option>
        <option value="2.transactions">Transactions</option>
        <option value="3.branches">Branches</option>
        <option value="4.accounts">Accounts</option>
        <option value="5.credit">Credit</option>
        <option value="6.debit">Debit</option>
        <option value="7.employees">Employees</option>
        <option value="8.advanced">Advanced Queries</option>
      </select>



      <div id="group1" class="hide-drop">
        <label for="tables1">Choose a query:</label>
        <select id="tables1" name="tables1">
          <option value="SELECT client_id FROM clients WHERE branch_id = 2 ORDER BY client_id">Lists all the client ids under a certain bank branch id (2)</option>
          <option value="UPDATE clients SET client_street = '959 Midland Ave' WHERE client_id = 1">Change the address of a client (id 1)</option>
        </select>
      </div>

      <div id="group2" class="hide-drop">
        <label for="tables2">Choose a query:</label>
        <select id="tables2" name="tables2">
          <option value="SELECT * FROM TRANSACTIONS WHERE transfer_date >= TO_TIMESTAMP('2021-10-21 5:20:35.729610000', 'YYYY-MM-DD HH24:MI:SS.FF9') ORDER BY transfer_date">Returns the transactions later than 2021-10-21</option>
          <option value="SELECT transaction_id, amount FROM transactions WHERE fromAcc = 84541236 AND transaction_type LIKE '%S'">transaction_id, and amount transferred from the account 84541236</option>
        </select>
      </div>

        <div id="group3" class="hide-drop">
          <label for="tables3">Choose a query:</label>
          <select id="tables3" name="tables3">
            <option value="SELECT * FROM branches WHERE branch_city = 'Brampton' ORDER BY branch_name ASC">Branches located within Brampton</option>
            <option value="SELECT COUNT(e.employee_id), b.branch_name FROM employee e, branches b where b.branch_id = e.branch_id group by e.branch_id, b.branch_name ORDER BY COUNT(e.employee_id) DESC">Returns the amount of employees per branch, ordered by greatest to least</option>
            <option value="SELECT b.branch_id, b.branch_name, sum(d.balance) AS Branch_Balance FROM accounts a, branches b, clients c, card d WHERE b.branch_name = c.branch_name AND c.client_id = a.client_id AND a.card_number = d.card_number GROUP BY b.branch_id, b.branch_name ORDER BY Branch_Balance DESC">Returns the sum of all the balances in each branch, ordered by greatest to least amount</option>
          </select>
        </div>

        <div id="group4" class="hide-drop">
            <label for="tables4">Choose a query:</label>
            <select id="tables4" name="tables4">
                <option value="select clients.client_name, B.balance from clients, (select card.balance, card.card_number, a2.client_id from card left join accounts a2 on card.card_number = a2.card_number ORDER BY card.balance DESC)B where B.client_id = clients.client_id AND ROWNUM = 1">Returns the client with the highest balance in their account</option>
            </select>
        </div>

        <div id="group5" class="hide-drop">
            <label for="tables5">Choose a query:</label>
            <select id="tables5" name="tables5">
                <option value="SELECT * FROM creditAcc WHERE card_number = 1242532442341234">Returns all the information from the card number 1242532442341234 </option>
                <option value="UPDATE creditAcc SET credit_limit = 5000 WHERE card_number = 1242532442341234">Change the credit limit of card number 1242532442341234</option>
            </select>
        </div>

        <div id="group6" class="hide-drop">
            <label for="tables6">Choose a query:</label>
            <select id="tables6" name="tables6">
                <option value="SELECT * FROM debitAcc WHERE card_number = 9865396586891567">Returns all the information from the card number 9865396586891567</option>
                <option value="SELECT * FROM debitAcc WHERE debit_limit < 10000 ORDER BY debit_limit DESC">Returns all the card numbers with a debit limit less than $10000</option>
                <option value="UPDATE debitAcc SET debit_limit = 2000 WHERE card_number = 9865396586891567">Change the debit limit of card number 9865396586891567 to $2000</option>
            </select>
        </div>


        <div id="group7" class="hide-drop">
            <label for="tables7">Choose a query:</label>
            <select id="tables7" name="tables7">
                <option value="SELECT * FROM employee WHERE manager_name = 'Frank Vogel' ORDER by employee_id">Lists all the employees who work under a specific manager</option>
                <option value="UPDATE employee SET salary = 70000 WHERE employee_id = 1">Changes the salary of the selected employee (emp id 1)</option>
            </select>
        </div>

        <div id="group8" class="hide-drop">
            <label for="tables8">Choose a query:</label>
            <select id="tables8" name="tables8">
                <option value="select client_name, account_number, amount, transaction_type from clients c INNER JOIN accounts a ON c.client_id = a.client_id Inner JOIN Transactions t ON a.account_number = t.fromacc Where TRANSFER_DATE >= to_timestamp('2021-10-21', 'YYYY-MM-DD')">Returns all the transactions made by all the accounts during a specific day </option>
                <option value="select transaction_id, c.card_number, amount, transaction_type, transfer_date from ( select * from accounts a INNER JOIN transactions t ON t.fromacc = a.account_number) mix INNER JOIN creditAcc c ON mix.card_number = c.card_number where c.card_number = 9865359865891567">Returns all the transactions made by a specific debit account</option>
                <option value="select transaction_id, c.card_number, amount, transaction_type, transfer_date from ( select * from accounts a INNER JOIN transactions t ON t.fromacc = a.account_number) mix INNER JOIN creditacc c ON mix.card_number = c.card_number where c.card_number = 9865359865891567">Returns all the transactions made by a specific credit account</option>
                <option value="SELECT branch_id, COUNT(client_id) AS Number_of_clients FROM clients GROUP BY branch_id">List for each branch, the amount of clients under a certain branch</option>
                <option value="SELECT MIN(salary), MAX(salary), AVG(salary), b.branch_id FROM employee e, branches b where e.branch_id = b.branch_id Group by b.branch_id">Find the minimum, maximum and average salary of all the employees for each branch</option>
                <option value="select c.client_name, b.BRANCH_NAME, b.branch_city FROM CLIENTS c left JOIN BRANCHES b ON c.BRANCH_ID = b.BRANCH_ID WHERE exists (select c2.balance from ACCOUNTS a left join card c2 on a.card_number = c2.card_number where a.client_id = c.CLIENT_ID and c2.balance > 10000) AND b.branch_city like '%Brampton%' group by c.client_name, b.BRANCH_NAME, b.branch_city">List of all clients who are above a certain balance in the all the branches that are in Brampton and group them by branch number</option>
                <option value="SELECT c.client_id, c.client_name, c2.balance, d.debit_limit FROM clients c left join ACCOUNTS a ON c.CLIENT_ID = a.client_id left join debitAcc d ON a.card_number = d.card_number left join card c2 on a.card_number = c2.card_number WHERE d.DEBIT_LIMIT >= c2.balance GROUP BY c.client_id, c.client_id, c.client_name, c2.balance, d.debit_limit">List of all the clients who have a balance smaller than their debit limit</option>
                <option value="SELECT b.branch_id, b.branch_name, AVG(e.salary) as branch_average, AVG(f.salary) as avg_all_branches FROM branches b, employee e, employee f WHERE e.branch_id = b.branch_id GROUP BY b.branch_id, b.branch_name HAVING AVG(e.salary) <= (SELECT AVG(salary) FROM employee)">Give a list of branches whose employees make below or equal the average salary of all employees from all branches</option>
                <option value="SELECT b.branch_id, b.branch_name, sum(d.balance) AS Branch_Balance FROM accounts a, branches b, clients c, card d WHERE b.branch_name = c.branch_name AND c.client_id = a.client_id AND a.card_number = d.card_number GROUP BY b.branch_id, b.branch_name ORDER BY Branch_Balance DESC">Returns the sum of all the balances in each branch, ordered by greatest to least amount</option>
            </select>
        </div>

      <br>
      <label for="submit-btn">Submit</label>
      <input type="submit" class="btn btn-danger" id="submit-btn" value="Go">
    </form>

    <input type="button" class="btn btn-primary hub" onclick="location.href='index.html';" value="Go Back" />

  </main>

  <footer>

  </footer>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

  <script>
    var choice1 = $('#tables').val();

    $(document).ready(function(){
      $("#tables").on('change', function(){
          $(".hide-drop").hide();
          var number = $(this).val().charAt(0);
          $("#group" + number).fadeIn(100);
      });
    });



  </script>
</body>

</html>
