<?php
include __DIR__ . '/includes/setup.php';
include __DIR__ . '/tpl/header.php';
//session_destroy();exit;
//var_dump($_SESSION);exit;

$settings = new \MyApp\Models\Setting();
$twitterKeys = $settings->get('my_twitter_app');


if (isset($_SESSION['twitter_logged'])) {
    $userModel = new \MyApp\Models\User();
    $user = $userModel->getById($_SESSION['user_id']);
}
//var_dump($_SESSION);exit;
?>

        <div class="col-md-9">

            <?php if (!isset($_SESSION['twitter_logged'])): ?>
            <div class="panel panel-default">
                <div class="panel-heading fs-18"><span class="glyphicon glyphicon-cog"></span>الاعدادات </div>
                <div class="panel-body">
                    <h2>برجاء الدخول بحساب تويتر</h2>
                    <p>
                        <a href="twitter_login.php">
                            <img src="<?php echo URL_ROOT . 'assets/images/twitter_sign_in.jpg'; ?>">
                        </a>
                    </p>
                </div>
            </div><!-- ./ panel panel-default -->

            <?php else: ?>
                <div class="panel panel-default">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <tr>
                                <th>ID</th>
                                <th>Screen Name</th>
                                <th>Profile Image</th>
                                <th>Following</th>
                                <th>Followers</th>
                            </tr>
                            <?php if ($user): ?>
                             <tr>
                                 <td><?= $user['id'] ?></td>
                                 <td><?= $user['screen_name'] ?></td>
                                 <td>
                                     <img src="<?= $user['profile_image_url'] ?>" alt="<?= $user['screen_name'] ?>" class="img-responsive">
                                 </td>
                                 <td>
                                     <?= $user['friends_count'] ?>
                                 </td>
                                 <td>
                                     <?= $user['followers_count'] ?>
                                 </td>
                             </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            <?php endif; ?>


        </div><!-- ./col-md-9 -->

<?php
include __DIR__ . '/tpl/footer.php';
?>
