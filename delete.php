<?php




if (!isset($_GET['tables'],$_GET['id'],$_GET['name'])){
    header('Location: /query.php');
}
$table= strtoupper($_GET['tables']);
$id = strtoupper($_GET['id']);
$name =strtoupper($_GET['name']);

$dbtns = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=localhost)(Port=17521))(CONNECT_DATA=(SID=orcl)))";
$conn = new PDO("oci:dbname=". $dbtns. ";charset=utf8", getenv('orclUser'), getenv('orclPass'), array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => 0,
    PDO::ATTR_AUTOCOMMIT, true,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));

if($table == "CREDITACC" or $table == "DEBITACC"){
    $sql = $conn->prepare("\nDELETE FROM ".$table." WHERE ".$name."=".$id);
    $sql->execute();
    $sql = $conn->prepare("\nDELETE FROM "."card"." WHERE ".$name."=".$id);
    $sql->execute();
}

if ($table == "EMPLOYEE"){
    $sql = $conn->prepare("\nDELETE FROM ".$table." WHERE \"".$name."\"=".$id);
    $sql->execute();
}

header('Location: /query.php');
?>