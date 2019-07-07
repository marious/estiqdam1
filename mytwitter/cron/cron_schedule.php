<?php
use Abraham\TwitterOAuth\TwitterOAuth;
include __DIR__  . '/../includes/setup.php';
$db = DB::connect();
$user_model = new \MyApp\Models\User();
$settingsModel = new \MyApp\Models\Setting();
$ap_creds = $settingsModel->get('my_twitter_app');

$stmt = $db->prepare('SELECT * FROM scheduled_tweets WHERE is_tweeted = ? AND time_to_post < ?');
$stmt->execute(array(0, time()));
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$owner = $user_model->getById($result['owner_id']);


if (is_array($result) && count($result))
{
    $replays = unserialize($result['replays']);


    $retweets = '';
    if ($result['retweets'])
    {
        $retweets = unserialize($result['retweets']);
    }




    if ($owner && is_array($owner))
    {
        $connection = new TwitterOAuth($ap_creds['consumer_key'], $ap_creds['consumer_secret'], $owner['oauth_token'], $owner['oauth_token_secret']);
        $connection->setTimeouts(30, 45);
        if ($result['time_to_post'] < time())
        {
            $parameters = ['status' => $result['tweet_content']];
            $content = $connection->post('statuses/update', $parameters);

            if ($connection->getLastHttpCode() == 200) {

                $q2 = "UPDATE scheduled_tweets SET is_tweeted = 1 WHERE id = :id";
                $stmt2 = $db->prepare($q2);
                $stmt2->bindValue(':id', $result['id']);
                $stmt2->execute();

                $tweet_info = $connection->getLastBody();



               if (is_array($retweets) && count($retweets))
               {
                   sleep(3);
                   foreach ($retweets as $retweet) {
                       $retweet_user = $user_model->getById($retweet);
                       $connection = new TwitterOAuth($ap_creds['consumer_key'], $ap_creds['consumer_secret'], $retweet_user['oauth_token'], $retweet_user['oauth_token_secret']);

                       if (isset($retweet_user['proxy']) && $retweet_user['proxy'] != '') {
                           $connection->setProxy([
                               'CURLOPT_PROXY' => $retweet_user['proxy'],
                               'CURLOPT_PROXYUSERPWD' => 'anazas0b:epsJyhTr',
                               'CURLOPT_PROXYPORT' => 4444,
                           ]);
                       }

                       $connection->post('statuses/retweet/' . $tweet_info->id_str);
                       sleep(3);
                   }
               }


               if (is_array($replays) && count($replays))
               {
                   sleep(5);
                   foreach ($replays as $user => $replay_msg)
                   {
                       $replay_user = $user_model->getById($user);

                       $connection = new TwitterOAuth($ap_creds['consumer_key'], $ap_creds['consumer_secret'], $replay_user['oauth_token'], $replay_user['oauth_token_secret']);

                       if (isset($user_cred['proxy']) && $user_cred['proxy'] != '') {
                           $connection->setProxy([
                               'CURLOPT_PROXY' => $user_cred['proxy'],
                               'CURLOPT_PROXYUSERPWD' => 'anazas0b:epsJyhTr',
                               'CURLOPT_PROXYPORT' => 4444,
                           ]);
                       }

                       $message = trim($replay_msg);

                       $connection->post('statuses/update', array(
                           'in_reply_to_status_id' => $tweet_info->id_str,
                           'status' => "@{$owner['screen_name']} {$message}"
                       ));
                       sleep(5);

                   }
               }



            } else {
                echo 'error';
            }
        }

    }


}