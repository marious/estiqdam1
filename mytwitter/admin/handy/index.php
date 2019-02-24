<?php
include __DIR__ . '/../../includes/setup.php';
include __DIR__ . '/../tpl/header.php';
$userModel = new \MyApp\Models\User();
$mediaFiles = \MyApp\Libs\Helper::getMediaDirFiles(__DIR__ . '/../../media');
$users = $userModel->getAll();
$db = DB::connect();
$replays_stmt = $db->query("SELECT * FROM replies");
$replays = $replays_stmt->fetchAll(PDO::FETCH_ASSOC);

$twitter = \MyApp\Libs\Helper::getTwInstance();
if (isset($_GET['account']) && $_GET['account'] != '') {
    $tweets = $twitter->get('statuses/user_timeline', array('user_id' => $_GET['account'], 'count' => 10));
//    $retweets = $twitter->get('statuses/retweets/1046833764381478913');
//   $favorites = $twitter->get('favorites/list', array('user_id' => '1004462273245609985', 'count' => 10));
//   var_dump($favorites);exit;
//    var_dump($tweets[1]);exit;
//    $tweets = $twitter->get('statuses/user_timeline', array('user_id' => '632028463', 'count' => 6));
//    var_dump($tweets);exit;
}


?>
<div class="col-md-12">
    <h1 class="page-header">Select Account To get it's Tweets</h1>
    <div>
        <form class="form-horizontal" method="get">
            <div class="form-group">
                <label  for="" class="control-label col-md-2 col-md-pull-1">Accounts</label>
                <div class="col-md-4">
                    <select name="account" class="form-control" id="accounts-list">
                        <option value="">-- Select Account --</option>
                        <?php if ($users && count($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <?php
                                $selected = '';
                                if (isset($_GET['account']) && $_GET['account'] == $user['id']) {
                                    echo 'hi';
                                    $selected = 'selected';
                                }
                                ?>
                                <option value="<?= $user['id']; ?>" <?= $selected; ?> > <?= $user['name']; ?></option>
                            <?php endforeach; ?>
                            <option value="789861407319810048">مكتب السلام للاستقدام</option>
                            <option value="826455004886212608">رجل السلام</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Get Tweets</button>
                    <button type="button" class="btn btn-primary" id="make-tweet">Make Tweet</button>
                </div>
            </div>
        </form>


        <?php if (isset($_GET['account']) && $_GET['account'] != ''): ?>
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="50%">Tweet</th>
                        <th>Tweet Time</th>
                        <th>Tweet Retweets</th>
                        <th>Tweet Favourites</th>
                        <th width="20%">Action</th>
                    </tr>
                    <?php if ($tweets && count($tweets)): ?>
                        <?php foreach ($tweets as $tweet): ?>
                            <tr>
                                <td><?php echo $tweet->text; ?></td>
                                <td><?php echo date('d M, Y g:i A', strtotime($tweet->created_at)); ?></td>
                                <td>
                                    <?php
                                    if (isset($tweet->retweeted_status)) {
                                        echo $tweet->retweeted_status->retweet_count;
                                    } else {
                                        echo $tweet->retweet_count;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($tweet->retweeted_status)) {
                                        echo $tweet->retweeted_status->favorite_count;
                                    } else {
                                        echo $tweet->favorite_count;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button data-tweet-id="<?= $tweet->id_str; ?>"
                                            data-screen-name="<?= $tweet->user->screen_name; ?>"
                                            type="button"
                                            class="btn btn-success make-action">Perform Action</button>

                                    <a href="<?= URL_ROOT . '/admin/handy/delete_tweet.php?tweet_id=' . $tweet->id_str . '&user_id=' . $tweet->user->id_str;  ?>"
                                       class="btn btn-danger delete-btn">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
        <?php endif; ?>

    </div>
</div>


<div id="tweetModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="tweet-form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update User</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label">Action</label>
                        <select name="action" id="action" class="form-control">
                            <option value="">-- Action --</option>
                            <option value="retweet">Retweet</option>
                            <option value="favourite">Favourite</option>
                            <option value="replay">Replay</option>
                        </select>
                    </div>

                    <div class="form-group" id="replay-container">
                        <label for="" class="control-label">Replay</label>
                        <textarea name="replay" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="" class="control-label">Account</label>
                        <select name="accounts[]" class="form-control" id="" multiple style="height: 300px;">
                            <option value="">-- Select Account --</option>
                            <?php if ($users && count($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id']; ?>"><?= $user['name']; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tweet-id" id="tweet-id">
                    <input type="hidden" name="screen_name" id="screen-name">
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Submit" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="makeTweetModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="make-tweet-form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Make Tweet</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="tweet" class="control-label col-sm-3">التغريدة</label>
                        <div class="col-sm-9">
                            <textarea class="form-control <?php if (isset($errorsMsg['tweet_needed'])): ?>textarea-error <?php endif; ?>" name="tweet" id="tweet"  placeholder="برجاء ادخال التغريدة هنا مع ملاحظة الا تتعدى 250 حرف..." ></textarea>
                        </div>
                    </div>

                    <div class="clearfix"></div>



                    <div class="form-group" style="margin-top: 20px;">
                        <label for="media" class="control-label col-sm-3">ارفاق ملف</label>
                        <div class="col-sm-9">


                            <?php if ($mediaFiles == false): ?>
                                <p class="media-message">لا يوجد ملفات صور او فيديو لعرضها</p>

                            <?php else: ?>
                                <div class="row">
                                    <?php foreach ($mediaFiles as $file): ?>
                                        <div class="col-md-3">
                                            <div class="thumbnail" style="width: 100%; height: 100px;">
                                                <img src="<?php echo URL_ROOT . 'media/' . $file; ?>"  class="img-responsive" style="max-height: 70px;">
                                                <input type="checkbox" value="<?php echo $file ?>" class="form-control mycheckbox" name="media_id[]">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="account" id="account-2">
                    <input type="hidden" value="tweet" name="action">
                    <!--                    <input type="hidden" name="screen_name" id="screen-name">-->
                    <input type="submit" class="btn btn-success" value="Submit" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>




<?php
$edit_script = true;
?>
<?php
include __DIR__ . '/../tpl/footer.php';
?>

<script>

    $('#replay-container').hide();

    $('#action').on('change', function() {
        if ($(this).val() == 'replay') {
            $('#replay-container').show();
        }  else {
            $('#replay-container').hide();
        }
    });

    $(document).on('click', '.make-action', function(e) {
        e.preventDefault();
        var tweet_id = $(this).data('tweet-id');
        var screen_name = $(this).data('screen-name');
        $('#tweetModal #tweet-id').val(tweet_id);
        $('#tweetModal #screen-name').val(screen_name);
        $('#tweetModal').modal('show');
    });

    $(document).on('submit', '#tweet-form', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo URL_ROOT . 'admin/handy/make_action.php'; ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#tweet-form')[0].reset();
                $('#tweetModal').modal('hide');
                location.reload(true);
            }
        });

    });


    $(document).on('click', '#make-tweet', function(e) {
        e.preventDefault();
        var account  = $('#accounts-list').val();
        if (account) {
            $('#makeTweetModal').modal('show');
            $('#makeTweetModal #account-2').val(account);
        } else {
            alert('You must select account');
            return;
        }
    });


    $(document).on('submit', '#make-tweet-form', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?php echo URL_ROOT . 'admin/handy/make_action.php'; ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#make-tweet-form')[0].reset();
                $('#makeTweetModal').modal('hide');
                location.reload(true);
            }
        });

    });

</script>




</body>
</html>
