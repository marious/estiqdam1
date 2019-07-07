<?php 
use Abraham\TwitterOAuth\TwitterOAuth;
require 'includes/setup.php';
$db = DB::connect();

$stmt = $db->prepare('SELECT * FROM users LIMIT 20,5');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


$settings = new \MyApp\Models\Setting();
$twitterKeys = $settings->get('my_twitter_app');

$connection = new TwitterOAuth($twitterKeys['consumer_key'], $twitterKeys['consumer_secret']);

foreach ($users as $user) {
  $user_info = $connection->get('users/show', ['user_id' => $user['id']]);
  $stmt = $db->prepare('UPDATE users SET name = :name WHERE id = :id');
  $stmt->bindValue(':name', $user_info->name);
  $stmt->bindValue(':id', $user['id']);
  $stmt->execute();
}