<?php
class Transactions extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('transactions');
        $this->load->model('Transaction_model');
    }


    public function all()
    {
        $this->data['page_header'] = '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('all_transactions');
        $this->load_datatable();
        $this->data['css_cdn'] = [
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css',
        ];
        $this->data['js_cdn'] = [
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js',
        ];
        array_push($this->data['js_file'], site_url('assets/admin/js/transactions.js'));
        $this->admin_template('all', $this->data);
    }


    public function load_all_transactions()
    {
        $this->Transaction_model->get_all_transactions();
    }




    public function transfer($id = false)
    {
        $this->load_datepicker();
        $this->load->module('banks');
        $this->data['accounts'] = $this->banks->Bank_model->get();

        // Recent Transfers
        $this->data['recent_transfers'] = $this->Transaction_model->get_recent_transaction('Transfer');


        if ($id && is_numeric($id))
        {
            $transaction = $this->Transaction_model->get($id);
            $transaction || redirect('dashboard');
            $this->data['transaction'] = $transaction;
        }
        else
        {
            $this->data['transaction'] = $this->Transaction_model->get_new();
            $this->data['transaction']->date = date('Y-m-d H:i:s');
        }

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Transaction_model->transaction_rules);
        if ($this->form_validation->run($this) === true)
        {

            $from_account = $_POST['from'];
            $to_account = $_POST['to'];
            $date = trans_date_to_timestamp($_POST['date'], 'd/m/Y');
            $amount = $_POST['amount'];
            $description = $_POST['description'];
            $debtor_account = $this->banks->Bank_model->get($from_account);
            if ($amount > $debtor_account->balance)
            {
                $_SESSION['error'] = lang('amount_transfer_bigger_balance');
                $this->session->mark_as_flash('error');
                redirect('transactions/transfer');
            }
            $debtor_account_balance = $debtor_account->balance - $amount;

            $creditor_account = $this->banks->Bank_model->get($to_account);
            $creditor_account_balance = $creditor_account->balance + $amount;

            $this->db->trans_start();
            $this->Transaction_model->save([
                'account_id'        => $from_account,
                'account'           => $debtor_account->account,
                'amount'            => $amount,
                'date'              => $date,
                'description'       => $description,
                'type'              => 'Transfer',
                'dr'                => $amount,
                'balance'           => $debtor_account_balance,
            ]);
            $this->banks->Bank_model->save(['balance' => $debtor_account_balance], $from_account);

            $this->Transaction_model->save([
                'account_id'        => $to_account,
                'account'           => $creditor_account->account,
                'amount'            => $amount,
                'date'              => $date,
                'description'       => $description,
                'type'              => 'Transfer',
                'cr'                => $amount,
                'balance'           => $creditor_account_balance,
            ]);
            $this->banks->Bank_model->save(['balance' => $creditor_account_balance], $to_account);

            $this->db->trans_complete();
            if ($this->db->trans_status === false)
            {
                $_SESSION['error'] = 'Something error happen transaction try again';
                $this->session->mark_as_flash('error');
                redirect('transactions/transfer');
            }

            $_SESSION['success_toastr'] = lang('transaction_added_success');
            $this->session->mark_as_flash('success_toastr');
            redirect('transactions/transfer');


        }

        $this->admin_template('transfer', $this->data);
    }



    public function expense($id = false)
    {
        $this->load_datepicker();
        array_push($this->data['js_file'], site_url('assets/admin/js/transactions.js'));
        $this->load->module('banks');
        $this->data['accounts'] = $this->banks->Bank_model->get();
        // Recent Expenses
        $this->data['recent_expenses'] = $this->Transaction_model->get_recent_transaction('Expense');
        if ($id && is_numeric($id))
        {
            $transaction = $this->Transaction_model->get($id);
            $transaction || redirect('dashboard');
            $this->data['transaction'] = $transaction;
        }
        else
        {
            $this->data['transaction'] = $this->Transaction_model->get_new();
            $this->data['transaction']->date = date('Y-m-d H:i:s');
        }

        $this->load->module('categories');
        $this->data['expense_categories'] = $this->categories->Category_model->get();
        $this->load->module('customers');
        $this->data['customers'] = $this->customers->Customer_model->get();


        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Transaction_model->get_expense_rules());

        if ($this->form_validation->run($this) == true)
        {
            $account = $this->input->post('account');
            $date = trans_date_to_timestamp($_POST['date'], 'd/m/Y');
            $amount = $this->input->post('amount');
            $payee = $this->input->post('payee');
            $cat = $this->input->post('category');
            $description = $this->input->post('description');
            $ref = $this->input->post('ref_number');

            if (!is_numeric($payee))
            {
                $payee = 0;
            }

            // find the current balance of this account
            $current_account = $this->banks->Bank_model->get($account);
            if ($current_account)
            {
                $current_account_balance = $current_account->balance;
                if ($current_account_balance < $amount)
                {
                    $_SESSION['error'] = lang('account_balance_not_valid');
                    $this->session->mark_as_flash('error');
                    redirect(site_url('transactions/expense'));
                }

                $balance_after_expense = abs($current_account_balance - $amount);
                $this->db->trans_start();
                $this->Bank_model->save(array('balance' => $balance_after_expense), $current_account->id);
                $this->Transaction_model->save([
                    'account_id' => $account,
                    'account' => $current_account->account,
                    'type' => 'Expense',
                    'payeeid' => $payee,
                    'amount' => $amount,
                    'category' => $cat,
                    'date'  => $date,
                    'ref' => $ref,
                    'description' => $description,
                    'dr' => $amount,
                    'cr' => '0.00',
                    'tax' => '0.00',
                    'balance' => $balance_after_expense,
                ]);
                $this->db->trans_complete();

                if ($this->db->trans_status === false)
                {
                    $_SESSION['error'] = 'Something error happen transaction try again';
                    $this->session->mark_as_flash('error');
                    redirect('transactions/expense');
                }

                $_SESSION['success_toastr'] = lang('expense_added');
                $this->session->mark_as_flash('success_toastr');
                redirect('transactions/expense');

            }
            else
            {
                $_SESSION['error'] = lang('unkown_account');
                $this->session->mark_as_flash('error');
                redirect(site_url('transactions/expense'));
            }
        }

        $this->admin_template('expense', $this->data);
    }



    public function deposit($id = false)
    {
        $this->load_datepicker();
        array_push($this->data['js_file'], site_url('assets/admin/js/transactions.js'));
        $this->load->module('banks');
        $this->load->module('banks');
        $this->data['accounts'] = $this->banks->Bank_model->get();
        // Recent Deposites
        $this->data['recent_deposits'] = $this->Transaction_model->get_recent_transaction('Income');
        if ($id && is_numeric($id))
        {
            $transaction = $this->Transaction_model->get($id);
            $transaction || redirect('dashboard');
            $this->data['transaction'] = $transaction;
        }
        else
        {
            $this->data['transaction'] = $this->Transaction_model->get_new();
            $this->data['transaction']->date = date('Y-m-d H:i:s');
        }

        $this->load->module('categories');
        $this->data['income_categories'] = $this->categories->Category_model->get_by(array('type' => 'Income'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Transaction_model->get_deposite_rules());
        if ($this->form_validation->run($this) == true)
        {
            $account = $this->input->post('account');
            $date = trans_date_to_timestamp($_POST['date'], 'd/m/Y');
            $amount = $this->input->post('amount');
            $description = $this->input->post('description');
            $ref = $this->input->post('ref_number');
            $payee = $this->input->post('payee');
            $cat = $this->input->post('category');

            if (!is_numeric($payee))
            {
                $payee = 0;
            }

            // find the current balance of this account
            $current_account = $this->banks->Bank_model->get($account);
            $balance_after_deposite = $current_account->balance + $amount;

            $this->db->trans_start();
            $this->Bank_model->save(['balance' => $balance_after_deposite], $current_account->id);
            $this->Transaction_model->save([
                'account_id'    => $account,
                'account'       => $current_account->account,
                'type'          => 'Income',
                'amount'        => $amount,
                'date'          => $date,
                'description'   => $description,
                'ref'           => $ref,
                'dr'            => '0.00',
                'cr'            => $amount,
                'tax'           => '0.00',
                'category'      => $cat,
                'balance'       => $balance_after_deposite,

            ]);
            $this->db->trans_complete();
            if ($this->db->trans_status === false)
            {
                $_SESSION['error'] = 'Something error happen transaction try again';
                $this->session->mark_as_flash('error');
                redirect('transactions/deposit');
            }

            $_SESSION['success_toastr'] = lang('expense_added');
            $this->session->mark_as_flash('success_toastr');
            redirect('transactions/deposit');
        }


        $this->admin_template('deposit', $this->data);
    }





    public function get_account_name($transaction)
    {
        $this->load->module('banks');
        $account = $this->banks->Bank_model->get($transaction->account_id);
        if ($account)
        {
            return $account->account;
        }
        return $transaction->account;
    }




    public function _valid_date()
    {
        $date = $this->input->post('date');
        if (strpos($date, '/') !== false)
        {
            $date_arr = explode('/', $date);
            $day = (int) $date_arr[0];
            $month = (int) $date_arr[1];
            $year = (int) $date_arr[2];
            if (!checkdate($month, $day, $year)) {
                $this->form_validation->set_message('_valid_date', 'Not Valid Date');
                return false;
            }
        }
        else
        {
            $this->form_validation->set_message('_valid_date', 'Not Valid Date');
            return false;
        }
        return true;
    }




    public function _valid_account()
    {
        $this->load->module('banks');
        $account = $this->input->post('account');
        if ($account != '')
        {
            $account_exist = $this->banks->Bank_model->get($account);
            if ($account_exist)
            {
                return true;
            }
            else
            {
                $this->form_validation->set_message('_valid_account', lang('not_valid_account'));
                return false;
            }
        }
        else
        {
            $this->form_validation->set_message('_valid_account', lang('not_valid_account'));
            return false;
        }
    }
}