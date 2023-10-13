<?php
// session_start();
require_once './vendor/autoload.php';




use App\Web\Database;

$database = new Database();
$email = $_SESSION["email"];

$pdo = $database->run();
$sql = "SELECT receiver_name, receiver_email, amount, type, date FROM transactions WHERE sender_email=:email";
$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':email' => $email
]);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
