<?php
$current_year = $year;
$num_feb_days = cal_days_in_month(CAL_GREGORIAN, 2, $current_year);
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
    <td>الإجمالى السنوى</td>

</tr>
<tr style="text-align: center;">
    <th>الدخل</th>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-01-01', $current_year.'-01-31');
        $sum_income_1 = 0;
        foreach ($income_data as $income) {
            $sum_income_1 = $sum_income_1 + $income->amount;
        }
        echo $sum_income_1;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-02-01', $current_year.'-02-' . $num_feb_days);
        $sum_income_2 = 0;
        foreach ($income_data as $income) {
            $sum_income_2 = $sum_income_2 + $income->amount;
        }
        echo $sum_income_2;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-03-01', $current_year.'-03-31');
        $sum_income_3 = 0;
        foreach ($income_data as $income) {
            $sum_income_3 = $sum_income_3 + $income->amount;
        }
        echo $sum_income_3;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-04-01', $current_year.'-04-30');
        $sum_income_4 = 0;
        foreach ($income_data as $income) {
            $sum_income_4 = $sum_income_4 + $income->amount;
        }
        echo $sum_income_4;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-05-01', $current_year.'-05-31');
        $sum_income_5 = 0;
        foreach ($income_data as $income) {
            $sum_income_5 = $sum_income_5 + $income->amount;
        }
        echo $sum_income_5;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-06-01', $current_year.'-06-30');
        $sum_income_6 = 0;
        foreach ($income_data as $income) {
            $sum_income_6 = $sum_income_6 + $income->amount;
        }
        echo $sum_income_6;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-07-01', $current_year.'-07-31');
        $sum_income_7 = 0;
        foreach ($income_data as $income) {
            $sum_income_7 = $sum_income_7 + $income->amount;
        }
        echo $sum_income_7;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-08-01', $current_year.'-08-31');
        $sum_income_8 = 0;
        foreach ($income_data as $income) {
            $sum_income_8 = $sum_income_8 + $income->amount;
        }
        echo $sum_income_8;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-09-01', $current_year.'-09-30');
        $sum_income_9 = 0;
        foreach ($income_data as $income) {
            $sum_income_9 = $sum_income_9 + $income->amount;
        }
        echo $sum_income_9;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-10-01', $current_year.'-10-31');
        $sum_income_10 = 0;
        foreach ($income_data as $income) {
            $sum_income_10 = $sum_income_10 + $income->amount;
        }
        echo $sum_income_10;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-11-01', $current_year.'-11-30');
        $sum_income_11 = 0;
        foreach ($income_data as $income) {
            $sum_income_11 = $sum_income_11 + $income->amount;
        }
        echo $sum_income_11;
        ?>
    </td>
    <td>
        <?php
        $income_data = $this->Report_model->getIncomeReport($current_year.'-12-01', $current_year.'-12-31');
        $sum_income_12 = 0;
        foreach ($income_data as $income) {
            $sum_income_12 = $sum_income_12 + $income->amount;
        }
        echo $sum_income_12;
        ?>
    </td>
</tr>
<tr style="text-align: center;">
    <th>المصروفات</th>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-01-01', $current_year.'-01-31');
        $sum_expense_1 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_1 = $sum_expense_1 + $expense->amount;
        }
        echo $sum_expense_1;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-02-01', $current_year.'-02-28');
        $sum_expense_2 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_2 = $sum_expense_2 + $expense->amount;
        }
        echo $sum_expense_2;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-03-01', $current_year.'-03-31');
        $sum_expense_3 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_3 = $sum_expense_3 + $expense->amount;
        }
        echo $sum_expense_3;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-04-01', $current_year.'-04-30');
        $sum_expense_4 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_4 = $sum_expense_4 + $expense->amount;
        }
        echo $sum_expense_4;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-05-01', $current_year.'-05-31');
        $sum_expense_5 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_5 = $sum_expense_5 + $expense->amount;
        }
        echo $sum_expense_5;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-06-01', $current_year.'-06-30');
        $sum_expense_6 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_6 = $sum_expense_6 + $expense->amount;
        }
        echo $sum_expense_6;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-07-01', $current_year.'-07-31');
        $sum_expense_7 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_7 = $sum_expense_7 + $expense->amount;
        }
        echo $sum_expense_7;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-08-01', $current_year.'-08-31');
        $sum_expense_8 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_8 = $sum_expense_8 + $expense->amount;
        }
        echo $sum_expense_8;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-09-01', $current_year.'-09-30');
        $sum_expense_9 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_9 = $sum_expense_9 + $expense->amount;
        }
        echo $sum_expense_9;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-10-01', $current_year.'-10-31');
        $sum_expense_10 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_10 = $sum_expense_10 + $expense->amount;
        }
        echo $sum_expense_10;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-11-01', $current_year.'-11-30');
        $sum_expense_11 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_11 = $sum_expense_11 + $expense->amount;
        }
        echo $sum_expense_11;
        ?>
    </td>
    <td>
        <?php
        $expense_data = $this->Report_model->getExpenseReport($current_year.'-12-01', $current_year.'-12-31');
        $sum_expense_12 = 0;
        foreach ($expense_data as $expense) {
            $sum_expense_12 = $sum_expense_12 + $expense->amount;
        }
        echo $sum_expense_12;
        ?>
    </td>
</tr>
<tr style="text-align: center;">
    <th>الصافى</th>
    <td> <?php $sum1 = $sum_income_1 - $sum_expense_1;
        echo round((float) $sum1, 2);
        ?></td>
    <td>
        <?php $sum2 = $sum_income_2 - $sum_expense_2;
        echo round((float) $sum2, 2);
        ?>
    </td>
    <td>
        <?php $sum3 = $sum_income_3 - $sum_expense_3;
        echo round((float) $sum3, 2);
        ?>
    </td>
    <td>
        <?php $sum4 = $sum_income_4 - $sum_expense_4;
        echo round((float) $sum4, 2);
        ?>
    </td>
    <td>
        <?php $sum5 = $sum_income_5 - $sum_expense_5;
        echo round((float) $sum5, 2);
        ?>
    </td>
    <td>
        <?php $sum6 = $sum_income_6 - $sum_expense_6;
        echo round((float) $sum6, 2);
        ?>
    </td>
    <td>
        <?php $sum7 = $sum_income_7 - $sum_expense_7;
        echo round((float) $sum7, 2);
        ?>
    </td>
    <td>
        <?php $sum8 = $sum_income_8 - $sum_expense_8;
        echo round((float) $sum8, 2);
        ?>
    </td>
    <td>
        <?php $sum9 =  $sum_income_9 - $sum_expense_9;
        echo round((float) $sum9, 2);
        ?>
    </td>
    <td>
        <?php $sum10 =  $sum_income_10 - $sum_expense_10;
        echo round((float) $sum10, 2);
        ?>
    </td>
    <td>
        <?php $sum11 =  $sum_income_11 - $sum_expense_11;
        echo round((float) $sum11, 2);
        ?>
    </td>
    <td>
        <?php $sum12 =  $sum_income_12 - $sum_expense_12;
        echo round((float) $sum12, 2);
        ?>
    </td>
    <td>
        <?php
        $balance = $sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6 + $sum7 + $sum8 + $sum9 + $sum10 + $sum11 + $sum12;
        echo number_format($balance, 2);
        ?>
    </td>
</tr>