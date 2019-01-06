<!--Statt Main Content-->
<section>
    <div class="main-content <?= get_content_main_area_class(); ?>">
        <div class="row">


            <div class="col-md-12 col-lg-12 col-sm-12 content-title"><h4><?= lang('dashboard'); ?></h4></div>
            <div class="clo-md-3 col-lg-3 col-sm-6">
                <div class="card-box">
                    <div class="box-callout-green">
                        <div class="rightside-cart">
                            <p class="card-head"><?= lang('current_day_income'); ?><br>
                                <canvas id="current-day-income" height="100" width="160"></canvas>
                            <div class="cart-caption">
                                <div class="cart-symbol"><b><?php echo get_current_setting('currency_code') ?></b></div>
                                <div id="current-income-preview" class="cart-preview"></div></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clo-md-3 col-lg-3 col-sm-6">
                <div class="card-box">
                    <div class="box-callout-orange">

                        <div class="rightside-cart">
                            <p class="card-head"><?= lang('current_day_expense'); ?><br>
                                <canvas id="current-day-expense" height="100" width="160"></canvas>
                            <div class="cart-caption">
                                <div class="cart-symbol"><b><?php echo get_current_setting('currency_code') ?></b></div>
                                <div id="current-expense-preview" class="cart-preview"></div></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clo-md-3 col-lg-3 col-sm-6">
                <div class="card-box">
                    <div class="box-callout-green">
                        <div class="rightside-cart">
                            <p class="card-head"><?= lang('current_month_income'); ?><br>
                                <canvas id="current-month-income" height="100" width="160"></canvas>
                            <div class="cart-caption">
                                <div class="cart-symbol"><b><?php echo get_current_setting('currency_code') ?></b></div>
                                <div id="month-income-preview" class="cart-preview"></div></div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="clo-md-3 col-lg-3 col-sm-6">
                <div class="card-box">
                    <div class="box-callout-orange">
                        <div class="rightside-cart">
                            <p class="card-head"><?= lang('current_month_expense'); ?><br>
                                <canvas id="current-month-expense" height="100" width="160"></canvas>
                            <div class="cart-caption">
                                <div class="cart-symbol"><b><?php echo get_current_setting('currency_code') ?></b></div>
                                <div id="month-expense-preview" class="cart-preview"></div></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--End Card box-->

        <div class="row">
            <!--Start Income Vs Expense Line Chart-->
            <div class="col-md-12 col-sm-12 col-lg-12">
                <!--Start Panel-->
                <div class="panel panel-default custom-box">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><?= lang('income_vs_expense') ?> -  <?= date('Y'); ?></div>
                    <div class="panel-body">
                        <!--<canvas id="inc_vs_exp2"></canvas>-->
                        <div id="inc_vs_exp2"></div>
                    </div>
                    <!--End Panel Body-->

                </div>
                <!--End Panel-->
            </div>
            <!--End Income Col-->

            <div class="col-md-12">
                <div class="panel panel-default custom-box">
                    <div class="panel-heading"><?= lang('all_expenses_and_income'); ?></div>
                    <div class="panel-body">

                            <div class="form-inline">
                                <label for="">السنة</label>
                                <select name="" id="income-expense-year">
                                    <option value="2018">2018</option>
                                    <option value="2019" selected>2019</option>
                                </select>
                            </div>
                        <br>

                        <?php
                        $current_year = date('Y');
                        $num_feb_days = cal_days_in_month(CAL_GREGORIAN, 2, $current_year);

                        ?>

                        <table class="table table-bordered" style="table-layout: fixed;" id="income_expense_table">
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
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="panel panel-default custom-box" style="min-height: 490px;">
                    <div class="panel-heading"><?= lang('expenses_details'); ?></div>
                    <div class="panel-body">


                        <div class="form-inline">
                            <label for="">السنة</label>
                            <select name="" id="expense-details-year">
                                <option value="2018">2018</option>
                                <option value="2019" selected>2019</option>
                            </select>
                        </div>
                        <br>

                        <table class="table table-bordered" style="table-layout: fixed;" id="expense_details_table">
                            <tr style="text-align: center;">
                                <th>الشهر</th>
                                <th>يناير</th>
                                <th>فبراير</th>
                                <th>مارس</th>
                                <th>ابريل</th>
                                <th>مايو</th>
                                <th>يونيو</th>
                                <th>يوليو</th>
                                <th>اغسطس</th>
                                <th>سبتمبر</th>
                                <th>اكتوبر</th>
                                <th>نوفمبر</th>
                                <th>ديسمبر</th>

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
                        </table>
                    </div>
                </div>
            </div>



            <!--Start Income-->
            <div class="col-md-6 col-sm-6 col-lg-6">
                <!--Start Panel-->
                <div class="panel panel-default custom-box">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><?= lang('last_5_income'); ?></div>
                    <div class="panel-body">
                        <!--Income Table-->
                        <table class="table table-bordered">
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('description'); ?></th>
                            <th class="text-right"><?= lang('amount'); ?></th>
                            <?php foreach($latest_income as $income){ ?>
                                <tr>
                                    <td><?php echo $income->trans_date ?></td>
                                    <td><?php echo $income->note ?></td>
                                    <td class="text-right"><?php echo get_current_setting('currency_code')." ".decimalPlace($income->amount) ?></td>
                                </tr>

                            <?php } ?>

                        </table>
                    </div>
                    <!--End Panel Body-->

                </div>
                <!--End Panel-->
            </div>
            <!--End Income Col-->

            <!--Start Expense-->
            <div class="col-md-6 col-sm-6 col-lg-6">
                <!--Start Panel-->
                <div class="panel panel-default custom-box">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><?= lang('last_5_expense') ?></div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('description'); ?></th>
                            <th class="text-right"><?= lang('amount'); ?></th>
                            <?php foreach($latest_expense as $expense){ ?>
                                <tr>
                                    <td><?php echo $expense->trans_date ?></td>
                                    <td><?php echo $expense->note ?></td>
                                    <td class="text-right"><?php echo get_current_setting('currency_code')." ".decimalPlace($expense->amount) ?></td>
                                </tr>

                            <?php } ?>
                        </table>
                    </div>
                    <!--End Panel Body-->
                </div>
                <!--End Panel-->
            </div>
            <!--End Expense Col-->

            <!--Start Income Vs Expense Chart-->
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="panel panel-default medium-box">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><?= lang('income_vs_expense');  ?> -  <?= get_arabic_month(date('F')); ?> - <?= date('Y') ?></div>
                    <div class="panel-body">
                        <div id="inc_vs_exp"></div>

                    </div>
                    <!--End Panel Body-->
                </div>
                <!--End Panel-->
            </div>
            <!--End Income Vs Expense Chart-->

            <!--Start Account Status-->
            <div class="col-md-6 col-sm-6 col-lg-6">
                <!--Start Panel-->
                <div class="panel panel-default medium-box">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><?= lang('financial_balance_status'); ?></div>
                    <div class="panel-body financial-bal">
                        <table class="table table-bordered ">
                            <th>Account</th>
                            <th class="text-right">Balance</th>
                            <?php foreach($financialBalance as $balance) {?>
                                <tr>
                                    <td><?php echo $balance->account ?></td>
                                    <td class="text-right"><?php echo get_current_setting('currency_code')." ".decimalPlace($balance->balance) ?></td>
                                </tr>

                            <?php } ?>

                        </table>
                    </div>
                    <!--End Panel Body-->
                </div>
                <!--End Panel-->
            </div>
            <!--End Account Status Col-->

        </div>
        <!--End Row-->
    </div>
</section>
<!--End Main-content-->
<script src="<?php echo base_url() ?>/theme/js/gauge.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var chart;
        chart = c3.generate({
            bindto: '#inc_vs_exp2',
            data: {
                x: 'x',
//        xFormat: '%Y%m%d', // 'xFormat' can be used as custom format of 'x'
                columns: [
                    ['x'
                        <?php for($i=1;$i<=count($line_chart[0]);$i++){
                        echo ",";
                        echo "'".$line_chart[0][$i]['date']."'";
                    } ?>
                    ],

                    ['Income',
                        <?php for($i=1;$i<=count($line_chart[0]);$i++){
                        echo  $line_chart[0][$i]['amount'].",";
                    } ?>
                    ],


                    ['Expense',
                        <?php for($i=1;$i<=count($line_chart[1]);$i++){
                        echo  $line_chart[1][$i]['amount'].",";
                    } ?>
                    ]
                ]
            },
            axis: {
                x: {
                    type: 'timeseries',
                    tick: {
                        format: '%Y-%m-%d'
                    }
                }
            }
        });




        chart = c3.generate({
            bindto: '#inc_vs_exp',
            data: {
                columns: [
                    ['Income', <?php echo $pie_data['income'] ?>],
                    ['Expense', <?php echo $pie_data['expense'] ?>],
                ],
                type: 'donut',
                onclick: function(d, i) {
                    console.log("onclick", d, i);
                },
                onmouseover: function(d, i) {
                    console.log("onmouseover", d, i);
                },
                onmouseout: function(d, i) {
                    console.log("onmouseout", d, i);
                }
            },
            color: {
                pattern: ['#23c6c8', '#f39c12']
            },
            donut: {
                title: "Income VS Expense"
            }
        });

    });

    //Current Day Income Gauge init
    var opts = {
        lines: 12, // The number of lines to draw
        angle: 0, // The length of each line
        lineWidth: 0.40, // The line thickness
        pointer: {
            length: 0.8, // The radius of the inner circle
            strokeWidth: 0.035, // The rotation offset
            color: '#34495e' // Fill color
        },
        limitMax: 'false',   // If true, the pointer will not go past the end of the gauge
        colorStart: '#23c6c8',   // Colors
        colorStop: '#23c6c8',    // just experiment with them
        strokeColor: '#E0E0E0',   // to see which ones work best for you
        generateGradient: true
    };
    var target = document.getElementById('current-day-income'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = <?php echo $cart_summery['current_day_income']*1.4 ?>; // set max gauge value
    gauge.animationSpeed = 100; // set animation speed (32 is default value)
    gauge.set(<?php echo $cart_summery['current_day_income'] ?>); // set actual value
    gauge.setTextField(document.getElementById("current-income-preview"));

    //Current Day Expense Gauge init
    var opts = {
        lines: 12, // The number of lines to draw
        angle: 0, // The length of each line
        lineWidth: 0.40, // The line thickness
        pointer: {
            length: 0.8, // The radius of the inner circle
            strokeWidth: 0.035, // The rotation offset
            color: '#34495e' // Fill color
        },
        limitMax: 'false',   // If true, the pointer will not go past the end of the gauge
        colorStart: '#f39c12',   // Colors
        colorStop: '#f39c12',    // just experiment with them
        strokeColor: '#E0E0E0',   // to see which ones work best for you
        generateGradient: true
    };
    var target = document.getElementById('current-day-expense'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = <?php echo $cart_summery['current_day_expense']*1.3 ?>; // set max gauge value
    gauge.animationSpeed = 100; // set animation speed (32 is default value)
    gauge.set(<?php echo $cart_summery['current_day_expense'] ?>); // set actual value
    gauge.setTextField(document.getElementById("current-expense-preview"));

    //Current Month Income Gauge init
    var opts = {
        lines: 12, // The number of lines to draw
        angle: 0, // The length of each line
        lineWidth: 0.40, // The line thickness
        pointer: {
            length: 0.8, // The radius of the inner circle
            strokeWidth: 0.035, // The rotation offset
            color: '#34495e' // Fill color
        },
        limitMax: 'false',   // If true, the pointer will not go past the end of the gauge
        colorStart: '#23c6c8',   // Colors
        colorStop: '#23c6c8',    // just experiment with them
        strokeColor: '#E0E0E0',   // to see which ones work best for you
        generateGradient: true
    };
    var target = document.getElementById('current-month-income'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue = <?php echo $cart_summery['current_month_income']*1.4 ?>; // set max gauge value
    gauge.animationSpeed = 100; // set animation speed (32 is default value)
    gauge.set(<?php echo $cart_summery['current_month_income'] ?>); // set actual value
    gauge.setTextField(document.getElementById("month-income-preview"));

    //Current Month Expense Gauge init
    var opts = {
        lines: 12, // The number of lines to draw
        angle: 0, // The length of each line
        lineWidth: 0.40, // The line thickness
        pointer: {
            length: 0.8, // The radius of the inner circle
            strokeWidth: 0.035, // The rotation offset
            color: '#34495e' // Fill color
        },
        limitMax: 'false',   // If true, the pointer will not go past the end of the gauge
        colorStart: '#f39c12',   // Colors
        colorStop: '#f39c12',    // just experiment with them
        strokeColor: '#E0E0E0',   // to see which ones work best for you
        generateGradient: true
    };
    var target = document.getElementById('current-month-expense'); // your canvas element
    var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
    gauge.maxValue =<?php echo $cart_summery['current_month_expense']*1.6 ?>  // set max gauge value
        gauge.animationSpeed = 100; // set animation speed (32 is default value)
    gauge.set(<?php echo $cart_summery['current_month_expense'] ?>); // set actual value
    gauge.setTextField(document.getElementById("month-expense-preview"));


</script>
