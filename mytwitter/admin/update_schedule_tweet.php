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
    $stmt = $db->prepare('SELECT * FROM scheduled_tweets WHERE id = :id');
    $stmt->bindValue(':id', $schedule_id);
    $stmt->execute();
    $schedule_tweet = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($schedule_tweet) && count($schedule_tweet))
    {
        $schedule_tweet = $schedule_tweet;
    }
    else
    {
        header('Location: ' . URL_ROOT . '/admin/schedule_tweets.php');
    }
}
else
{
    header('Loction: ' . URL_ROOT . '/admin/schedule_tweets.php');
}

///////////////////////////////////////////////////////////////////
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $valid = 1;
    if ($_POST['tweet_content'] == '')
    {
        $valid = 0;
        $errors['tweet_content'] = 'Please Enter Tweet Content';
    }

    if ($_POST['time_to_post'] == '')
    {
        $valid = 0;
        $errors['time_to_post'] = 'Please Enter Time to post';
    }

    if ($_POST['owner_id'] == '')
    {
        $valid = 0;
        $errors['owner_id'] = 'Please Select Who Will Tweet';
    }

    if ($valid == 1)
    {
        $content = $_POST['tweet_content'];
        $time_to_post = strtotime($_POST['time_to_post']);
        $owner_id = $_POST['owner_id'];

        $retweet_accounts = '';
        if (isset($_POST['retweet_accounts']) && is_array($_POST['retweet_accounts']))
        {
            $retweet_accounts = [];
            foreach ($_POST['retweet_accounts'] as $account) {
                $retweet_accounts[] = $account;
            }
            $retweet_accounts = serialize($retweet_accounts);
        }



        $replays = [];
        foreach ($_POST['replays'] as $key => $value) {
            if ($value[0] != '') {
                $replays[$key] = $value[0];
            }
        }


        if ($valid == 1)
        {
            $stmt = $db->prepare("UPDATE scheduled_tweets SET owner_id = ?, tweet_content = ?, time_to_post=?, retweets=?, replays = ?
                                            WHERE id = ? 
                                    ");
            $stmt->execute(array($owner_id, $content, $time_to_post, $retweet_accounts, serialize($replays), $schedule_id));

            $_SESSION['success'] = 'Schedule Tweet Updated Successfully';
            header('Location: ' . URL_ROOT . '/admin/schedule_tweets.php');
        }
    }
}

///////////////////////////////////////////////////////////////////
$assets['css'][] = 'bootstrap-datetimepicker.min.css';
$assets['js'][] = 'moment-with-locales.min.js';
$assets['js'][] = 'bootstrap-datetimepicker.min.js';
$assets['custom_script_date'] = true;
?>
<?php include 'tpl/header.php'; ?>


<div class="panel panel-default">
    <div class="panel-heading fs-18"><span class="fa fa-twitter fa-fw"></span> New Schedule Tweets </div>
    <div class="panel-body">

        <?php if (\MyApp\Libs\Session::exists('success')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo \MyApp\Libs\Session::flash('success'); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="" class="form-horizontal" id="">
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="tweet_content" class="control-label col-sm-3">Tweet Content</label>
                            <div class="col-sm-9">
                                <textarea class="form-control <?php if (isset($errorsMsg['tweet_needed'])): ?>textarea-error <?php endif; ?>" name="tweet_content" id="tweet_content" maxlength="140" placeholder="برجاء ادخال التغريدة هنا مع ملاحظة الا تتعدى 140 حرف..." ><?php echo $schedule_tweet['tweet_content'] ?></textarea>
                                <?php if (isset($errors['tweet_content'])) echo '<span class="errorMessage">'.$errors['tweet_content'].'</span>' ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="time_to_post" class="control-label col-sm-3">Time To Send</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control date-time" id="time_to_post" name="time_to_post"
                                    value="<?= date('d-m-Y H:i a', $schedule_tweet['time_to_post']) ?>">
                                <?php if (isset($errors['time_to_post'])) echo '<span class="errorMessage">'.$errors['time_to_post'].'</span>' ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Account Will Tweet? </label>
                            <div class="col-sm-9">
                                <select name="owner_id" class="form-control">
                                    <option value="">-- Select Account --</option>

                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>" <?php if ($schedule_tweet['owner_id'] == $user['id']) echo 'selected'; ?>><?= $user['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['owner_id'])) echo '<span class="errorMessage">'.$errors['owner_id'].'</span>' ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Account Will Retweet? </label>
                            <div class="col-sm-9">
                                <select name="retweet_accounts[]" class="form-control" multiple style="height: 400px;">
                                    <option value="">-- Select Account --</option>
                                    <?php
                                    $retweets = $schedule_tweet['retweets'] != '' ? unserialize($schedule_tweet['retweets']) : [];
                                    ?>

                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user['id'] ?>" <?php if ( in_array($user['id'], $retweets) ) echo 'selected'; ?>><?= $user['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="" class="control-label col-sm-3">Account Will Replay? </label>
                            <div class="col-sm-9">
                                <table class="table table-bordered">
                                    <?php
                                    $replays_accounts = unserialize($schedule_tweet['replays']);
                                    ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td width="25%"><?= $user['name'] ?></td>
                                            <td><textarea name="replays[<?= $user['id'] ?>][]" id="" cols="50" rows="2"><?php if (in_array($user['id'], array_keys($replays_accounts))) { echo $replays_accounts[$user['id']]; } ?></textarea></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </table>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <hr>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?= URL_ROOT . '/admin/schedule_tweets.php'; ?>" class="btn btn-default">Cancel</a>
        </form>


    </div>
</div><!-- ./ panel panel-default -->
</div><!-- ./col-md-9 -->

<?php include 'tpl/footer.php'; ?>
