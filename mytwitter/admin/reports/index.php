<?php
use Abraham\TwitterOAuth\TwitterOAuth;

include __DIR__ . '/../../includes/setup.php';
include __DIR__ . '/../tpl/header.php';

$userModel = new \MyApp\Models\User();
$users = $userModel->getAll();

$settingsModel = new \MyApp\Models\Setting();
$settings = $settingsModel->get('my_twitter_app');
$twitter  = new TwitterOAuth($settings['consumer_key'], $settings['consumer_secret']);
// var_dump($twitter->get('users/show', ['id' => '914409145842970624'])->followers_count);
// var_dump($users);
// exit;
function handle_followers_count($twitter_id) {
    $db = DB::connect();
    $query = 'SELECT * FROM followers_count where twitter_id = :twitter_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':twitter_id', $twitter_id);
    $stmt->execute();
    $followings = $stmt->fetchAll(PDO::FETCH_OBJ);
    $result = '';
    foreach ($followings as $following) {
        $result .= '<div class="followers_count">This account on ' . date('d/m/Y', strtotime($following->taken_date))  . ' has (<span class="alert-me">' . $following->followers_count . '</span>) followers and (<span class="alert-me-2">' . 
        $following->following_count . '</span>) friends</div><br>';
    }
    return $result;
    
}

?>


<div class="col-md-12">
    <a href="<?php echo URL_ROOT . 'admin/reports/update.php'; ?>" class="btn btn-primary">UPdate</a>
    <h2>Accounts</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissable">
            <button name="button" class="close" data-ddismiss="alert" aria-label="close"><apan aria-hidden="true">x</apan></button>
            <?php echo $_SESSION['error']; ?>
        </div>

        <?php unset($_SESSION['error']);  endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissable">
            <button name="button" class="close" data-ddismiss="alert" aria-label="close"><apan aria-hidden="true">x</apan></button>
            <?php echo $_SESSION['success']; ?>
        </div>

        <?php unset($_SESSION['success']);  endif; ?>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="10%">Screen Name</th>
                <th width="10%">Profile Image</th>
                <th width="7%">Followers</th>
                <th width="7%">friends</th>
                <th>NOTE</th>
            </tr>
        </thead>
        <tbody>
           <?php if ($users && count($users)): ?>
           <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['name']; ?></td>
                    <td>                        
                        <img src="<?= $user['profile_image_url'] ?>" alt="<?= $user['screen_name'] ?>" class="img-responsive">
                    </td>
                    <td>
                        <?= $user['followers_count'] ?>
                    </td>
                    <td>
                        <?= $user['friends_count'] ?>
                    </td>
                   
                    <td>
                    <?php echo handle_followers_count($user['id']);  ?>
                    </td>
                </tr>
          <?php endforeach; ?>
           <?php endif; ?>
        </tbody>
    </table>
</div>