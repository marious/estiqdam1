<?php
$current_year = $year;
$num_feb_days = cal_days_in_month(CAL_GREGORIAN, 2, $current_year);
echo $num_feb_days;
?>
<tr style="text-align: center;">
    <th>الشهر</th>
    <td>يناير</td>
    <td>فبراير</td>
    <td>مارس</td>
    <td>ابريل</td>
    <td>مايو</td>
    <td>يونيو</td>
    <td>يوليو</td>
    <td>اغسطس</td>
    <td>سبتمبر</td>
    <td>اكتوبر</td>
    <td>نوفمبر</td>
    <td>ديسمبر</td>

</tr>
<?php $expenseAccountsType = $this->Report_model->getAllExpensesAccounts(); ?>
<?php if ($expenseAccountsType && count($expenseAccountsType)): ?>
    <?php foreach ($expenseAccountsType as $expenseAccount): ?>
        <tr>
            <th><?php echo $expenseAccount->accounts_name; ?></th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount( $current_year . '-01-01', $current_year . '-01-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-01-01&date-to='.$current_year.'-01-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount( $current_year . '-02-01', $current_year . '-02-'.$num_feb_days, $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-02-01&date-to='.$current_year.'-02-'.$num_feb_days.'&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount( $current_year . '-03-01', $current_year . '-03-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-03-01&date-to='.$current_year.'-03-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-04-01', $current_year.'-04-30', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-04-01&date-to='.$current_year.'-04-30&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-05-01', $current_year.'-05-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-05-01&date-to='.$current_year.'-05-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-06-01', $current_year.'-06-30', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-06-01&date-to='.$current_year.'-06-30&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year . '-07-01', $current_year . '-07-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-07-01&date-to='.$current_year.'-07-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-08-01', $current_year.'-08-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-08-01&date-to='.$current_year.'-08-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-09-01', $current_year.'-09-30', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-09-01&date-to='.$current_year.'-09-30&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-10-01', $current_year . '-10-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-10-01&date-to='.$current_year.'-10-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year.'-11-01', $current_year.'-11-30', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-11-01&date-to='.$current_year.'-11-30&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>
            <th>
                <?php
                $amount = $this->Report_model->getExpenseAccountAmount($current_year . '-12-01', $current_year . '-12-31', $expenseAccount->accounts_name);
                echo '<a target="_blank" href="'.site_url('acc_reports/categoryReport?date-from='.$current_year.'-12-01&date-to='.$current_year.'-12-31&category=' . $expenseAccount->accounts_name).'">'
                    . number_format($amount, 2) . '</a>';
                ?>
            </th>

        </tr>
    <?php endforeach; ?>


<?php endif; ?>