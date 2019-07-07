<?php
include __DIR__ . '/includes/setup.php';

$consumer_key = 'at0Hd570r40d3bJieHGX2nUXj';
$consumer_secret = 'RWJK46WlLURyq2V4TwIxbMyYhWrR8DshmJomCt2xUCg74jh8Qf';
$access_token = '914409145842970624-wIrM5sO1lVhudny1Rardc8Cd7S6WYUH';
$access_token_secret = 'JPGJiQ6uezM0Erpp6pYvgMTljYsQCC0aOAcOef6SilvnI';

$twitter = new \Abraham\TwitterOAuth\TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

$trends = $twitter->get('trends/place', array('id' => 23424938,));
$db = DB::connect();
foreach ($trends[0]->trends as $trend) {
    $query = "INSERT INTO hashtags (hashtag) VALUES(:hashtag)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':hashtag', $trend->name);
    $stmt->execute();
}