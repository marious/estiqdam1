<?php
include __DIR__ . '/includes/setup.php';



$twitter = new \Abraham\TwitterOAuth\TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

$trends = $twitter->get('trends/place', array('id' => 23424938,));
$db = DB::connect();
foreach ($trends[0]->trends as $trend) {
    $query = "INSERT INTO hashtags (hashtag) VALUES(:hashtag)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':hashtag', $trend->name);
    $stmt->execute();
}