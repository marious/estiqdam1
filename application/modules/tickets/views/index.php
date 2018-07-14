<section>
    <div class="container-fluid">
        <div class="row">
            <div class="content">
                <div class="page-header">
                    <h3 class="page-title"><?= lang('tickets'); ?> </h3>
                </div>
                <!-- page header -->
                <div class="page-content-wrapper m-t">
                    <div class="block-content">
                        <div class="panel panel-default m-t">
                            <div class="panel-heading"><span class=""></span> <?= lang('tickets'); ?></div>
                            <div class="panel-body">
                                <div class="tab-content m-t">

                                    <table id="tickets-contracts" class="table table-bordered table-striped services-table">
                                        <thead>
                                        <tr>
                                            <th><?= lang('contract_number'); ?></th>
                                            <th><?= lang('worker_name'); ?></th>
                                            <th><?= lang('sur_name'); ?></th>
                                            <th><?= lang('passport_number'); ?></th>
                                            <th><?= lang('date_of_birth'); ?></th>
                                            <th><?= lang('date_of_expiry'); ?></th>
                                            <th><?= lang('customer_name'); ?></th>
                                            <th><?= lang('representative'); ?></th>
                                            <th><?= lang('agent'); ?></th>
                                            <th><?= lang('departure_airport'); ?></th>
                                            <th><?= lang('arrival_airport'); ?></th>
                                            <th><?= lang('ticket'); ?></th>
                                        </tr>
                                        </thead>
                                        <?php if ($tickets && count($tickets)): ?>
                                        <tbody>
                                        <?php foreach ($tickets as $ticket): ?>
                                        <form method="post" action="<?= site_url('tickets/save_ticket'); ?>" enctype="multipart/form-data"
                                        id="form-<?= $ticket->contract_number; ?>">
                                            <tr>
                                                <td><?= $ticket->contract_number; ?></td>
                                                <td><?= $ticket->first_name ?></td>
                                                <td><?= $ticket->sur_name ?></td>
                                                <td><?= $ticket->passport_number ?></td>
                                                <td><?= $ticket->date_of_birth; ?></td>
                                                <td><?= $ticket->date_of_expiry; ?></td>
                                                <td><?= $ticket->customer_name_in_arabic ?></td>
                                                <td><?= $ticket->representative_name ?></td>
                                                <td><?= $ticket->agent_name ?></td>
                                                <td><?= $ticket->departure_airport ?></td>
                                                <td><?= $ticket->arrival_airport ?></td>
                                                <td>
                                                    <a target="_blank" href="<?= site_url('assets/contracts/' . $ticket->contract_number .'/' . $ticket->ticket_image); ?>" class="btn btn-success btn-xs"><?= lang('view_ticket'); ?></a>
                                                </td>
                                            </tr>
                                            <input type="hidden" name="contract_number" value="<?= $ticket->contract_number; ?>">
                                        </form>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <?php endif; ?>

                                    </table>
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