<?php 
include __DIR__ . '/../../includes/setup.php';
$db = DB::connect();
$stmt = $db->prepare('DELETE FROM groups WHERE id = :id');
$stmt->bindValue(':id', trim($_GET['id']));
$stmt->execute();
header('Location: ' . URL_ROOT . 'admin/groups/index.php');
exit;