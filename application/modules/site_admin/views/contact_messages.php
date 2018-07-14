<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title">Contact Messages</h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> Contact Messages</div>
                            <div class="panel-body">
                                <div class="tab-content m-t">
                                    <?php $this->load->view('includes/flash_messages'); ?>
                                    <?php if ($messages && count($messages)): ?>
                                        <table id="" class="table table-bordered table-striped services-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>رقم الجوال</th>
                                                <th>الرسالة</th>
                                                <th>وقت الرسالة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($messages as $message): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= htmlentities($message->name); ?></td>
                                                    <td style="text-align: left;"><?= htmlentities($message->mobile_number); ?></td>
                                                    <td><?= htmlentities($message->message); ?></td>
                                                    <td><?= date('Y-m-d H:is', strtotime($message->created_at)); ?></td>

                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <h2>Not Contact messages</h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ./page-header -->
            </div>
        </div>
    </div>
</section>