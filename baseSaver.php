<?php
require_once "dbconfig.in.php";
session_start();
function generateUniqueIDcus()
{
    $min = 1000000000;
    $max = 2000000000;

    return mt_rand($min, $max);
}
$customersid = generateUniqueIDcus();
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $stmtcust = $pdo->prepare("INSERT INTO customers (id, namee, flat ,street ,city ,country , dob,email, tel, c_c_number, c_c_e_date,c_c_name, c_c_bank, username,passwordd) 
            VALUES (:id, :namee, :flat,:street,:city,:country, :dob,:email, :tel, :c_c_number,
             :c_c_e_date,:c_c_name, :c_c_bank, :username, :passwordd)");
    $stmtcust->bindValue(':id', $customersid);
    $stmtcust->bindValue(':namee',  $_SESSION['fullname']);
    $stmtcust->bindValue(':flat',$_SESSION['flat']);
    $stmtcust->bindValue(':street', $_SESSION['street']);
    $stmtcust->bindValue(':city', $_SESSION['city']);
    $stmtcust->bindValue(':country', $_SESSION['country']);
    $stmtcust->bindValue(':dob',  $_SESSION['dob']);
    $stmtcust->bindValue(':email',$_SESSION['emailD']);
    $stmtcust->bindValue(':tel', $_SESSION['tel']);
    $stmtcust->bindValue(':c_c_number', $_SESSION['cc_number']);
    $stmtcust->bindValue(':c_c_e_date', $_SESSION['CC_E']);
    $stmtcust->bindValue(':c_c_name',  $_SESSION['cc_name']);
    $stmtcust->bindValue(':c_c_bank', $_SESSION['cc_bank']);
    $stmtcust->bindValue(':username', $_SESSION['username']);
    $stmtcust->bindValue(':passwordd',   $_SESSION['passwordd']);

    $stmtcust->execute();
    header('Location: inter.php');
    exit();
}
} catch (PDOException $e) {
    die($e->getMessage());
}
