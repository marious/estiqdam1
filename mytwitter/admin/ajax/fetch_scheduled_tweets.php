<?php
include __DIR__ . '/../../includes/setup.php';
$db = DB::connect();
$query = "SELECT * FROM scheduled_tweets";
$stmt = $db->prepare($query);
$stmt->execute();
$tweet = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($tweet);