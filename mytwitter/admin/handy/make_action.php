<?php
use Abraham\TwitterOAuth\TwitterOAuth;
include __DIR__ . '/../../includes/setup.php';
// var_dump($_POST);exit;

$tweet_id = isset($_POST['tweet-id']) ? $_POST['tweet-id'] : false;

$accounts = $_POST['accounts'];

// $user_id = $_POST['account'];
$action = $_POST['action'];



if (isset($_POST['replies']))
{
    $replies = [];
    foreach ($_POST['replies'] as $replay) {
        if ($replay != '') {
            $replies[] = trim($replay);
        }
    }

    // $replay = trim($_POST['replay']);
    // $replay = explode("\n", $replay);
    // $replay = array_filter($replay, 'trim');
}


foreach ($accounts as $i => $account) {

    $db = DB::connect();
    $query = "SELECT oauth_token, oauth_token_secret,proxy, screen_name FROM users WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":id", $account);
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

        if ($action == 'retweet') {
            $retweet = $twitter->post('statuses/retweet/' . $tweet_id);
        }
        else if ($action == 'favourite') {
            $favourite = $twitter->post('favorites/create', array(
                'id' => $tweet_id,
            ));
        } else if ($action == 'replay') {
    //        var_dump($_POST);exit;
            
            $screen_name = $_POST['screen_name'];
            $make_replay = $twitter->post('statuses/update', array(
                'in_reply_to_status_id' => $tweet_id,
                'status' => "@{$screen_name} {$replies[$i]}"
            ));
            var_dump($make_replay);
        } else if ($action == 'tweet') {
            $tweet = \MyApp\Libs\Helper::sanitize($_POST['tweet']);
            if (!empty($tweet)) {

                $media_ids = [];

                if (isset($_POST['media_id']) && count($_POST['media_id'])) {
                    for ($i = 0; $i <= (TWITTER_UPLOADS_POST_MAX_IMG - 1); $i++) {
                        if (isset($_POST['media_id'][$i])) {
                            $content_type = mime_content_type(UPLOAD_PATH . $_POST['media_id'][$i]);
                            $size = filesize(UPLOAD_PATH . $_POST['media_id'][$i]);
                            $this_media = [];
                            $this_media =  $twitter->upload('media/upload', [
                                'media' => URL_ROOT .'media/' . $_POST['media_id'][$i],
                            ]);
                            if (isset($this_media->media_id) && $this_media->media_id != '') {
                                $media_ids[] = $this_media->media_id;
                            }
                        }
                    }
                }

                $parameters = [];
                if (count($media_ids) > 0) {
                    $parameters = [
                        'status' => $tweet,
                        'media_ids' => implode(',', $media_ids),
                    ];
                } else {
                    $parameters = ['status' => $tweet];
                }

                $content = $twitter->post('statuses/update', $parameters);
    //            var_dump($content);exit;
                if ($twitter->getLastHttpCode() == 200) {

    //                \MyApp\Libs\Session::flash('success', 'تم ارسال التغريدة بنجاح');
    //            header('Location: ' . URL_ROOT . 'tweets.php');
                } else {
                    echo 'error';
                }


            }
        }
}