<?php
include __DIR__ . '/../../includes/setup.php';
include __DIR__ . '/../tpl/header.php';

$db = DB::connect();
$stmt = $db->prepare('SELECT * FROM groups');
$stmt->execute();
$groups = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $group_name = trim($_POST['group_name']);
    $stmt = $db->prepare('INSERT INTO groups SET group_name = :group_name');
    $stmt->bindValue(':group_name', $group_name);
    $stmt->execute();
    header('Location: ' . URL_ROOT . 'admin/groups/index.php');
    exit;
}
?>

<h1 class="page-header">Create New Group</h1>

<form method="post" action="">
    <div class="form-group">
        <label for="group_name">Group Name</label>
        <input type="text" name="group_name" class="form-control">
        <br>
        <input type="submit" class="btn btn-primary" value="Save">
    </div>
</form>

<br> <br>

<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Group Name</th>
        <th>Action</th>
    </tr>
    <?php if ($groups && !empty($groups)): ?>
        <?php $i = 1; foreach ($groups as $group): ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $group['group_name']; ?></td>
                <td>
                    <a href="" class="btn btn-warning btn-sm update" id="<?= $group['id'] ?>">Edit</a>
                    <a href="<?php echo URL_ROOT . 'admin/groups/delete.php?id=' . $group['id'] ?>" class="btn btn-danger delete-btn">Delete</a>
                </td>
            </tr>
            <?php $i++; endforeach; ?>
    <?php endif;   ?>
</table>


<div id="groupModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="group_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Group Name</label>
                        <input type="text" name="group_name" id="group_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Color</label>
                        <input type="color" name="group_color" id="group_color">
                    </div>



                </div>
                <div class="modal-footer">
                    <input type="hidden" name="group_id" id="group_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
$edit_script = true;
include __DIR__ . '/../tpl/footer.php';
?>

<script>

    $(document).on('submit', '#group_form', function(e) {
        e.preventDefault();
        var proxy = $('#proxy_user').val();
        var user_id = $('#user_id').val();
        // if (proxy != '') {
        $.ajax({
            url: "<?php echo URL_ROOT . 'admin/groups/update_group.php' ?>",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                $('#group_form')[0].reset();
                $('#groupModal').hide();
                location.reload(true);
            }
        });
        // }
    });



    $(document).on('click', '.update', function(e) {
        e.preventDefault();
        var group_id = $(this).attr('id');
        $.ajax({
            url: "<?php echo URL_ROOT . 'admin/groups/fetch_group.php' ?>",
            method: "POST",
            data: {group_id: group_id},
            dataType: "json",
            success: function(data) {
                $('#groupModal').modal('show');
                $('#group_id').val(data.id);
                $('#group_name').val(data.group_name);
                $('#group_color').val(data.group_color);
            }
        });
    });
</script>


</body>
</html>
