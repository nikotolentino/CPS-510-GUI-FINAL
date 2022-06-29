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
    <div id="database-table" class="border">
        <!-- Put database in here-->
        <p class="h2"><?php if(isset($_GET['tables']) and strlen($_GET['tables']) != 0){echo strtoupper($_GET['tables']);} ?></>

        <?php
        if(isset($_GET['tables']) and strlen($_GET['tables']) != 0){
            $dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
            $conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => 0,
                PDO::ATTR_AUTOCOMMIT, true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

            $sql = $conn->prepare("Select * from ". $_GET['tables']);
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
            <option value="basic_employee_info">Basic Employee Info</option>
            <option value="credit_c">Credit_C</option>
            <option value="debit_c">Debit_C</option>
        </select>

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

</body>

</html>
