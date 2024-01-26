<? 
require_once "dbconfig.in.php";
session_start(); 
function generateUniqueIDcus()
{
    $min = 1000000000; 
    $max = 2000000000; 

    return mt_rand($min, $max);
}
$customersid = generateUniqueIDcus();

try{
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$stmtCustomer = $pdo->prepare("INSERT INTO customers (id, name, address, dob, national_id ,email, tel, c_c_number, c_c_ex_date,c_c_name, c_c_bank, username,password) 
            VALUES (:id, :name, :address, :dob, :national_id ,:email, :tel, :c_c_number,
             :c_ce_date,:c_c_name, :c_c_bank, :username, :pasword)");
            $stmtCustomer->bindValue(':id', $customersid);
            $stmtCustomer->bindValue(':name',$name );
            $stmtCustomer->bindValue(':address', $flat+$street+$city+$country);
            $stmtCustomer->bindValue(':dob', $dob);
            $stmtCustomer->bindValue(':national_id', $idNumber);
            $stmtCustomer->bindValue(':email', $email);
            $stmtCustomer->bindValue(':tel', $tel);
            $stmtCustomer->bindValue(':c_c_number', $cc_number);
            $stmtCustomer->bindValue(':c_c_e_date', $CC_E);
            $stmtCustomer->bindValue(':cr_c_name', $cc_name);
            $stmtCustomer->bindValue(':c_c_bank', $cc_bank);
            $stmtCustomer->bindValue(':username', $username);
            $stmtCustomer->bindValue(':pasword', $password);

            $stmtCustomer->execute();
} 
catch (PDOException $e) {
    die($e->getMessage());
}
