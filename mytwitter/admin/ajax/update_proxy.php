<?php
include __DIR__ . '/../../includes/setup.php';
$user_id = $_POST['user_id'];
$proxy = trim($_POST['proxy']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$phone = trim($_POST['phone']);

$db = DB::connect();

$query = "UPDATE users set proxy = :proxy, phone=:phone, email=:email, `password`=:password where id = :id";
$stmt = $db->prepare($query);
$stmt->bindValue(':proxy', $proxy);
$stmt->bindValue(':phone', $phone);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->bindValue(':id', $user_id);
return $stmt->execute();