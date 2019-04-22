<?php
include __DIR__ . '/../../includes/setup.php';

$group_id = trim($_POST['group_id']);
$db = DB::connect();
$stmt =  $db->prepare('select * from groups where id = :group_id');
$stmt->bindValue(':group_id', $group_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);