<?php
use MyApp\Libs\Helper;

require __DIR__ . '/../includes/setup.php';
require __DIR__ . '/functions.php';

$userModel = new \MyApp\Models\User();
$users = $userModel->getAll();
$db = DB::connect();

if (isset($_GET['schedule_id']))
{
    $schedule_id = (int) $_GET['schedule_id'];
    $stmt = $db->prepare('DELETE FROM scheduled_tweets WHERE id = :id');
    $stmt->bindValue(':id', $schedule_id);
    $stmt->execute();
    header('Location: ' . URL_ROOT . '/admin/schedule_tweets.php');
}