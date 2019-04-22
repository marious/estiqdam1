<?php
include __DIR__ . '/../../includes/setup.php';
$group_id = $_POST['group_id'];
$group_name = trim($_POST['group_name']);
$group_color = trim($_POST['group_color']);

$db = DB::connect();

$query = "UPDATE groups set group_name = :group_name, group_color = :group_color where id = :id";
$stmt = $db->prepare($query);
$stmt->bindValue(':group_name', $group_name);
$stmt->bindValue(':group_color', $group_color);
$stmt->bindValue(':id', $group_id);
return $stmt->execute();