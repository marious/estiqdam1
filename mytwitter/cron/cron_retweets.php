<?php
use Abraham\TwitterOAuth\TwitterOAuth;

include __DIR__ . '/../includes/setup.php';
//var_dump($_SESSION);exit;

$db = DB::connect();

$settingsModel = new \MyApp\Models\Setting();
$settings = $settingsModel->get('my_twitter_app');
$tweetApp = new \MyApp\Controllers\Tweets();
$twApi = \MyApp\Libs\Helper::getTwInstance();

//$twitter = \MyApp\Libs\Helper::getTwInstance();
//$tweets = $twitter->get('statuses/user_timeline', [
//    'screen_name' => 'vskarich',
//    'since_id' => '909808281081847808',
//    'count' => 10,
//]);

function get_retweet_users($tid, $last_status_id) {
    global $db;
    $query = "SELECT * FROM retweets_users WHERE tid = :tid AND last_status_id <> :last_status_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':tid', $tid);
    $stmt->bindValue(':last_status_id', $last_status_id);
    $stmt->execute();
    $retweet_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $retweet_users;
}


$query = "SELECT `tid`, last_status_id, task_id FROM retweets_users GROUP BY `tid`, last_status_id, task_id";
$stmt = $db->prepare($query);
$stmt->execute();
// $retweet_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $retweet_users = $retweet_users;
$users_to_retweeted_to = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($users_to_retweeted_to);exit;
// $retweet_users = get_retweet_users($users_to_retweeted_to[0]['tid']);

foreach ($users_to_retweeted_to as $user_to_retweeted_to) {
    $task = $tweetApp->get_task($user_to_retweeted_to['task_id']);
    $user_info = $twApi->get('users/show', array('id' => $user_to_retweeted_to['tid']));
    $last_status_id = $user_info->status->id_str;    
    $retweet_users  = get_retweet_users($user_to_retweeted_to['tid'], $last_status_id);

    // var_dump($retweet_users);
    // var_dump($last_status_id);
    if (! empty($retweet_users)) {
        // if ($last_status_id == $user_to_retweeted_to['last_status_id']) {
        //     $query = "SELECT * FROM retweets_users WHERE last_status_id <> :last_status_id AND task_id = :task_id";
        //     $stmt = $db->prepare($query);
        //     $stmt->bindValue(':last_status_id', $last_status_id);
        //     $stmt->bindValue(':task_id', $user_to_retweeted_to['task_id']);
        //     $stmt->execute();
        //     $retweet_users = $stmt->fetch(PDO::FETCH_ASSOC);
        //     if (empty($retweet_users)) {
        //         exit;
        //     }
        // }


        $task_run_time = unserialize($task['task_time']);
        $current_time = strtotime(date("g:i A"));

        if (strtotime($task_run_time['start_time_1']) <= $current_time && strtotime($task_run_time['end_time_1']) > $current_time) {
            foreach ($retweet_users as $retweet_user) {
                make_retweet($retweet_user);
            }
        }
        
        if ($task_run_time['start_time_2'] != '0')
        {
            if (strtotime($task_run_time['start_time_2']) <= $current_time && strtotime($task_run_time['end_time_2']) > $current_time) {
                foreach ($retweet_users as $retweet_user) {
                    make_retweet($retweet_user);
                }
            }
        }
        
        if ($task_run_time['start_time_3'] != '0') {
            if ( strtotime($task_run_time['start_time_3']) <= $current_time && strtotime($task_run_time['end_time_3']) > $current_time) {
                foreach ($retweet_users as $retweet_user) {
                    make_retweet($retweet_user);
                }
            }
        }    
    }

}
exit;




// $task = $tweetApp->get_task($retweet_users['task_id']);
// $twApi = \MyApp\Libs\Helper::getTwInstance();
// $user_info = $twApi->get('users/show', array('screen_name' => $retweet_users['screen_name']));
// $last_status_id = $user_info->status->id_str;


/*
if ($last_status_id == $retweet_users['last_status_id']) {
    $query = "SELECT * FROM retweets_users WHERE last_status_id <> :last_status_id AND task_id = :task_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':last_status_id', $last_status_id);
    $stmt->bindValue(':task_id', $retweet_users['task_id']);
    $stmt->execute();
    $retweet_users = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($retweet_users)) {
        exit;
    }
}
*/



// $task_run_time = unserialize($task['task_time']);
// $current_time = strtotime(date("g:i A"));

/*
if (strtotime($task_run_time['start_time_1']) <= $current_time && strtotime($task_run_time['end_time_1']) > $current_time) {
    make_retweet($retweet_users);
}

if ($task_run_time['start_time_2'] != '0')
{
    if (strtotime($task_run_time['start_time_2']) <= $current_time && strtotime($task_run_time['end_time_2']) > $current_time) {
        make_retweet($retweet_users);
    }
}

if ($task_run_time['start_time_3'] != '0') {
    if ( strtotime($task_run_time['start_time_3']) <= $current_time && strtotime($task_run_time['end_time_3']) > $current_time) {
        make_retweet($retweet_users);
    }
}
*/


function make_retweet($retweet_users)
{
   

    if ($retweet_users && count($retweet_users)) {

        $owners_id = $retweet_users["owner_id"];
        $tweetApp = new \MyApp\Controllers\Tweets();
        $settingsModel = new \MyApp\Models\Setting();
        $settings = $settingsModel->get('my_twitter_app');
        $db = DB::connect();

//        foreach ($owners_id as $id) {
        $query = "SELECT oauth_token, oauth_token_secret,proxy FROM users WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":id", $owners_id);
        $stmt->execute();
        $user_cred = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_cred && count($user_cred)) {
//                $twitter = \MyApp\Libs\Helper::getTwInstance();
//                var_dump($twitter);exit;

            $twitter  = new TwitterOAuth($settings['consumer_key'], $settings['consumer_secret'], $user_cred['oauth_token'], $user_cred['oauth_token_secret']);

            if (isset($user_cred['proxy']) && $user_cred['proxy'] != '') {
                $twitter->setProxy([
                    'CURLOPT_PROXY' => $user_cred['proxy'],
                    'CURLOPT_PROXYUSERPWD' => 'anazas0b:epsJyhTr',
                    'CURLOPT_PROXYPORT' => 4444,
                ]);
            }




            $get_tweets = $twitter->get('statuses/user_timeline', [
                'screen_name' => $retweet_users['screen_name'],
                'since_id'    => $retweet_users['last_status_id'],
                'count' => 5
            ]);




            // update user last_status_id in retweets_users in database for the next time to count
            if (count($get_tweets))
            {

                $user_info  = $twitter->get('users/show', array('screen_name' => $retweet_users['screen_name'])
                );
//                    $twitter_api  = new TwitterOAuth($settings['consumer_key'], $settings['consumer_secret'], $user_cred['oauth_token'], $user_cred['oauth_token_secret']);

//var_dump($get_tweets);exit;

                foreach ($get_tweets as $tweet_info) {

                    if ( strpos($tweet_info->text, '@') !== false || strpos($tweet_info->text, 'RT') !== false)
                    {
                        continue;
                    }

                    $retweet = $twitter->post('statuses/retweet/' . $tweet_info->id_str);
                    sleep(3);
                    $twitter->post('favorites/create', array(
                        'id' => $tweet_info->id_str,
                    ));
                    sleep(5);
                }

                $tweetApp->makeRetweetReplayUser($user_info, 'retweets_users', 'update', $retweet_users["owner_id"], $retweet_users['task_id']);

            }
        }

//        }

    }
}

