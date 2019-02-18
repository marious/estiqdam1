<?php
use Abraham\TwitterOAuth\TwitterOAuth;
include __DIR__ . '/../../includes/setup.php';

$tweet_id = $_GET['tweet_id'];
$user_id = $_GET['user_id'];


$db = DB::connect();
$query = "SELECT oauth_token, oauth_token_secret,proxy, screen_name FROM users WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindValue(":id", $user_id);
$stmt->execute();
$user_cred = $stmt->fetch(PDO::FETCH_ASSOC);

$settingsModel = new \MyApp\Models\Setting();
$settings = $settingsModel->get('my_twitter_app');

$twitter  = new TwitterOAuth($settings['consumer_key'], $settings['consumer_secret'], $user_cred['oauth_token'], $user_cred['oauth_token_secret']);

if (isset($user_cred['proxy']) && $user_cred['proxy'] != '') {
    $twitter->setProxy([
        'CURLOPT_PROXY' => $user_cred['proxy'],
        'CURLOPT_PROXYUSERPWD' => 'anazas0b:epsJyhTr',
        'CURLOPT_PROXYPORT' => 4444,
    ]);
}

$delete = $twitter->post('statuses/destroy/' . $tweet_id);
header('Location: ' . URL_ROOT . '/admin/handy/index.php?account=' . $user_id);