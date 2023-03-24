<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
if(empty($attractie))
{
    $errors[] = "vul de attractie naam in";
}
$type = $_POST['type'];
if(empty($type))
{
    $errors[] = "Kies de type";
}
$capaciteit = $_POST['capaciteit'];
if(is_numeric($capaciteit))
{
    $errors[] = "vul de getal in";
} 
if(isset($_POST['prioriteit']))
{
    $prioriteit = 1;
}
else{
    $prioriteit = 0;
}
$melder = $_POST['melder']; 
if(empty($melder))
{
    $errors[] = "vul de melder in";
}

if(isset($errors))
{
    var_dump($errors); 
    die();
}
$overige_info = ($_POST['overige_info']);

if (isset($errors))
{
    var_dump($errors);
    die();
}
//1. Verbinding
require_once 'conn.php';

//2. Query
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
          VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
//3. Prepare
$statement = $conn->prepare($query);  
//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info => $overige_info"
]);


$msg = "Melding verstuurd!"; 
header("location: ../meldingen/index.php?msg=$msg");
?>
