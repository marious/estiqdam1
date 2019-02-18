<?php
use Abraham\TwitterOAuth\TwitterOAuth;
include __DIR__  . '/../includes/setup.php';
$db = DB::connect();

$settingsModel = new \MyApp\Models\Setting();
$settings = $settingsModel->get('my_twitter_app');

$q1 = 'SELECT * from periodic_tweets';
$stmt = $db->query($q1);
$tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);



$q2 = 'SELECT * FROM periodic_task';
$stmt = $db->query($q2);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);





if ($tasks && count($tasks))
{
    foreach ($tasks as $task)
    {
        $task_run_time = unserialize($task['task_time']);
        $current_time = strtotime(date("g:i A"));

        if (strtotime($task_run_time['start_time_1']) <= $current_time && strtotime($task_run_time['end_time_1']) > $current_time) {
            $users = unserialize($task['owner_id']);
            make_periodic_tweet($task);

        }
    }
}



function make_periodic_tweet($task)
{
    $tasks_tweets = false;
    if (isset($task['tweet_id']) && $task['tweet_id'] != null)
    {
        $tasks_tweets = unserialize($task['tweet_id']);
    }


    $tweet = get_tweet($tasks_tweets, $task);


    $users = unserialize($task['owner_id']);
    $settingsModel = new \MyApp\Models\Setting();
    $ap_creds = $settingsModel->get('my_twitter_app');
    $db = DB::connect();
    // get the message to send
//    $tweet = get_tweet_message($task);
    $userModel = new \MyApp\Models\User();




    $interval = ((int) $task['periodic_time']) * 60;
    $last_send =  $task['last_send'] ?  strtotime($task['last_send']) : time() - $interval;
//    var_dump($interval, $last_send, $task['periodic_time']);
//    var_dump(date('H:i a', ($interval + $last_send)));

//    var_dump($interval + $last_send);
//    var_dump(time());

//    var_dump(date('H:i', ($interval + $last_send)));exit;
//var_dump($interval + $last_send <= time());
//
//var_dump(date('H:i', time()));
//var_dump(date('H:i', $last_send));
//var_dump(date('H:i', ($interval + $last_send)));
//exit;

    if ($interval + $last_send <= time()) {
//        echo 'hi';exit;
//        $hashtag = get_hashtag($tweet['hashtag_id']);

        foreach ($users as $user) {
        $user_cred = $userModel->getById($user);
        $connection = new TwitterOAuth($ap_creds['consumer_key'], $ap_creds['consumer_secret'], $user_cred['oauth_token'], $user_cred['oauth_token_secret']);
//        $connection->setTimeouts();
////        $tweet_str = "{$hashtag['hashtag']}\n {$tweet['tweet']}";
            $tweet_str = $tweet;
        $content = $connection->post('statuses/update', ['status' => $tweet_str]);
        sleep(5);
//            echo $tweet . '<br>';
        }
//        update_hashtag_id($tweet['id'], $hashtag['id']);
        // update task task_time and last send
        update_task_tweet_last_send($task['id']);
    }

}


function get_hashtag($last_used)
{
    $db = DB::connect();
    $query = 'SELECT * FROM hashtags WHERE id <> :last_used';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':last_used', $last_used);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[array_rand($result)];
}

function get_tweet_message($task)
{
    $db = DB::connect();
    if ($task['tweet_id'] == 0)
    {
        $query = "SELECT tweet, id, hashtag_id  FROM periodic_tweets where status = 1 LIMIT 1";
        $stmt = $db->query($query);
        $tweet = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    else
    {
        $query = "SELECT tweet, id, hashtag_id  FROM periodic_tweets WHERE id <> {$task['tweet_id']} and status = 1 LIMIT 1";
        $stmt = $db->query($query);
        $tweet = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($tweet))
        {
            $query = 'SELECT tweet, id, hashtag_id FROM periodic_tweets where status = 1 LIMIT 1';
            $stmt = $db->query($query);
            $tweet = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    return $tweet;

}

function update_task_tweet_last_send($task_id)
{
    $db = DB::connect();
    $query = "UPDATE periodic_task SET last_send = :last_send WHERE id = :task_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':last_send', date('Y-m-d H:i:s', time()));
    $stmt->bindValue(':task_id', $task_id);
    return $stmt->execute();
}

function update_hashtag_id($tweet_id, $hashtag_id)
{
    $db = DB::connect();
    $query = "UPDATE periodic_tweets SET hashtag_id = {$hashtag_id} WHERE id = {$tweet_id}";
    return $db->query($query);
}

function get_tweet($tweets_arr, $task)
{
    $task_id = $task['id'];
    $db = DB::connect();
    if ($tweets_arr)
    {
        $tweets = implode(',', $tweets_arr);
        $query = "SELECT * FROM periodic_tweets WHERE id NOT IN ({$tweets}) AND status = 1" ;
        $stmt = $db->prepare($query);
        $stmt->execute();
        $tweet = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tweet && count($tweet))
        {
            $tweets_arr[] = $tweet['id'];
            $serialized_tweets = serialize($tweets_arr);
            // update tweet
            $q = "UPDATE periodic_task SET tweet_id = :tweet_id WHERE id = :task_id";
            $stmt = $db->prepare($q);
            $stmt->bindValue(':tweet_id', $serialized_tweets);
            $stmt->bindValue(':task_id', $task_id);
            $stmt->execute();
            return $tweet['tweet'];
        }
        else
        {
            $q = "SELECT * FROM periodic_tweets WHERE status = 1";
            $stmt = $db->prepare($q);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $q2 = "UPDATE periodic_task SET tweet_id = :tweet_id WHERE id = :task_id";
            $stmt = $db->prepare($q2);
            $stmt->bindValue(':tweet_id', serialize([$row['id']]));
            $stmt->bindValue(':task_id', $task_id);
            $stmt->execute();

            return $row['tweet'];
        }
    }
    else
    {
        $q = "SELECT * FROM periodic_tweets WHERE status = 1";
        $stmt = $db->prepare($q);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $q2 = "UPDATE periodic_task SET tweet_id = :tweet_id WHERE id = :task_id";
        $stmt = $db->prepare($q2);
        $stmt->bindValue(':tweet_id', serialize([$row['id']]));
        $stmt->bindValue(':task_id', $task_id);
        $stmt->execute();

        return $row['tweet'];
    }
}