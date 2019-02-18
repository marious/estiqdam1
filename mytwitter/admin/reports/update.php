<?php 
use Abraham\TwitterOAuth\TwitterOAuth;

include __DIR__ . '/../../includes/setup.php';
$userModel = new \MyApp\Models\User();
$users = $userModel->getAll();
$settingsModel = new \MyApp\Models\Setting();
$settings = $settingsModel->get('my_twitter_app');
$twitter  = new TwitterOAuth($settings['consumer_key'], $settings['consumer_secret']);

$db = DB::connect();

foreach ($users as $user) {
    $cu_user = $twitter->get('users/show', ['id' => $user['id']]);
    $query = "INSERT INTO followers_count(twitter_id, followers_count, following_count, taken_date) values(:twitter_id, :followers_count, :following_count, :taken_date)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':twitter_id', $cu_user->id_str);
    $stmt->bindValue(':followers_count', $cu_user->followers_count);
    $stmt->bindValue(':following_count', $cu_user->friends_count);
    $stmt->bindValue(':taken_date', date('Y-m-d H:i:s'));
    $stmt->execute();
}

header('Location: ' . URL_ROOT . 'admin/reports');
exit;