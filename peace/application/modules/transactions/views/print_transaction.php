<section class="invoice">
	<div class="print-invoice print-transaction">
		<div class="row">
			 <div class="col-xs-12">
                <h2 class="page-header" style="padding-bottom: 40px;">
                    <?= setting('company_name')?>
                    <small class="pull-right" style="line-height: 1.8;"><?= lang('date') ?>: <?= date('Y-m-d H:i:s') ?>
                        <br>
                        TranID: <?= $transaction->id + 100 ?>
                    </small>
                </h2>
            </div>
		</div>

  		<div class="row invoice-info">
  			<h2 class="text-center receipt-title"><?php echo $transaction->transaction_type ?> Receipt</h2>
  		</div>


  		<div class="row" style="padding-top: 50px;">
  			<div class="col-xs-12 table-responsive">
  				 <table class="table table-striped transaction-print-table">
  				 	<thead>
  				 		<tr>
  				 			<th width="20%">SL.</th>
  				 			<th width="30%" style="">Amount</th>
  				 			<th width="50%">Description</th>
  				 		</tr>
  				 	</thead>
  				 	<tbody>
  				 		<tr>
  				 			<td>1</td>
							<td style=""><?php echo $transaction->amount . ' ' . $currency ?></td>
							<td class="description"><?= $transaction->description ?></td>
  				 		</tr>
  				 	</tbody>
  				 </table>


				<div class="container">
					<div class="signs" style="margin: 100px 50px;">
						<h4 style="float: left;">Manager</h4>
						<h4 style="float: right;">Receiver</h4>
					</div>
				</div>

  			</div>


			

  		</div>

	</div>
</section>


<script>
	
	   const mode = 'iframe';
             const close = mode == 'popup';
             const options = {mode: mode, popClose: close};
             $('div.print-invoice').printArea(options);

</script>