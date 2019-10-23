<?php

/**
 * @property  new_transaction_balance
 */
class Transactions extends MY_Controller
{

    private $new_transaction_balance;

    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->middleware->only(['check_permission:show_transactions'], ['all_transaction']);
        $this->middleware->only(['check_permission:delete_transaction'], ['delete_transaction']);
        $this->middleware->only(['check_permission:edit_transaction'], ['edit_transaction']);

//        $this->middleware->only(['check_permission:show_accounts'], ['chart_of_account']);
//        $this->middleware->only(['check_permission:add_account'], ['add_account']);
//        $this->middleware->only(['check_permission:edit_account'], ['edit_account']);
//        $this->middleware->only(['check_permission:delete_account'], ['delete_account']);


        $this->middleware->only(['check_permission:income_categories'], ['income_category']);
        $this->middleware->only(['check_permission:expense_categories'], ['expense_category']);
        $this->middleware->only(['check_permission:add_income_category'], ['add_income_category']);
        $this->middleware->only(['check_permission:edit_income_category'], ['edit_income_category']);
        $this->middleware->only(['check_permission:delete_income_category'], ['delete_category']);

        $this->middleware->only(['check_permission:add_expense_category'], ['add_expense_category']);
        $this->middleware->only(['check_permission:edit_expense_category'], ['edit_expense_category']);


        $this->logged_in_user_permissions = Modules::run('roles/get_active_user_permissions');
        $this->lang->load('transactions');
        $this->load->model('Transaction_model');
        $this->load->library('form_builder');
        $this->load->library('form_validation');
    }



    public function chart_of_account()
    {
        $account_type = $this->db->get('account_type')->result();

        $result = [];
        foreach ($account_type as $type) {
            $tem_head = $this->db->select('account_head.*, account_type.account_type')
                        ->from('account_head')
                        ->join('account_type', 'account_head.account_type_id = account_type.id', 'left')
                        ->where('account_head.account_type_id', $type->id)
                        ->get()
                        ->result();

            foreach ($tem_head as $item) {
                $result[] = $item;
            }
        }


        $this->data['account_head'] = $result;
        $this->admin_template('chart_of_account', $this->data);

    }



    public function add_account()
    {
        $data['countries'] = $this->db->get('countries')->result();
        $data['modal_subview'] = $this->load->view('_modal/add_account', $data, false);
    }
    
    


    public function save_new_account()
    {
        $id = $this->input->post('id');
        if (!empty($id))
        {
            $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
            if (empty($id))
            {
                $this->message->norecord_found('transactions/chart_of_account');
            }
        }

        $this->form_validation->set_rules('account_title', lang('account_title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_number', lang('account_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('balance', lang('balance'), 'trim|xss_clean|numeric');

        if (MULTI_CURRENCY)
        {
            $this->form_validation->set_rules('account_currency', lang('account_currency'), 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE)
        {
            $data['account_title']              = $this->input->post('account_title');
            $data['description']                = $this->input->post('description');
            $data['account_number']             = $this->input->post('account_number');
            if (empty($id)) {
                $data['balance']                    = $this->input->post('balance') ? $this->input->post('balance') : 0;
            }
            $data['account_type_id']            = 1;
            $data['account_currency']           = MULTI_CURRENCY ? $this->input->post('account_currency') : setting('default_currency');

            if ($id) {
                $this->db->where('id', $id);
                $this->db->update('account_head', $data);
            } else {
                $this->db->insert('account_head', $data);
            }
            $this->message->save_success('transactions/chart_of_account');
        }
        else
        {
            $error = validation_errors();
            $this->message->custom_error_msg('transactions/chart_of_account', $error);
        }
    }


    public function edit_account($id = null)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $result = $this->db->get_where('account_head', [
            'id' => $id,
        ])->row();
        $result == TRUE || $this->message->norecord_found('transactions/chart_of_account');
        $data['account'] = $result;
        $data['countries'] = $this->db->get('countries')->result();

        $data['modal_subview'] = $this->load->view('_modal/add_account', $data, false);
    }


    public function delete_account($id = null)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $id == TRUE || $this->message->norecord_found('transactions/chart_of_account');

        $result = $this->db->get_where('transactions', [
            'account_id' => $id,
        ])->row();

        if ($result)
        {
            $this->message->custom_error_msg('transactions/chart_of_account', lang('record_has_been_used'));
        }
        else
        {
            $this->db->delete('account_head', ['id' => $id]);
            $this->message->delete_success('transactions/chart_of_account');
        }
    }
    


    public function add_transaction()
    {
        $this->data['accounts'] = $this->db->get_where('account_head', [
            'account_type_id' => 1,
        ])->result();

        $this->data['type'] = '';
        if (isset($_GET['type']))
        {
            $this->data['type'] = trim($_GET['type']);
        } else {
            redirect(404);
        }


      if (!in_array('add_' . $this->data['type'], $this->logged_in_user_permissions)) {
        redirect(404);
    }


        $this->admin_template('add_transactions', $this->data);
    }


    public function get_transaction_category()
    {
        $type = trim($this->input->post('type'));
        if ($type == 'Deposit' || $type == 'AR')
        {
            $id = 1;
        } else {
            $id = 2;
        }

        $categories = $this->db->order_by('name', 'asc')->get_where('transaction_category', ['type' => $id])->result();
        $output = '';
        if (is_array($categories) && count($categories))
        {
            foreach ($categories as $category) {
                $output .= '<option value="'.$category->id.'">'.$category->name.'</option>';
            }
        }
        echo $output;
    }


    public function check_account_currency()
    {
        $from_account = $this->input->post('from_account');
        $to_account = $this->input->post('to_account');
        if ($from_account && $to_account)
        {
            $f_account = $this->db->get_where('account_head', ['id' => $from_account])->row();
            $to_account = $this->db->get_where('account_head', ['id' => $to_account])->row();
            if ($from_account && $to_account)
            {
                $from_account_currency = $f_account->account_currency ? $f_account->account_currency : setting('default_currency');
                $to_account_currency = $to_account->account_currency ? $to_account->account_currency : setting('default_currency');

                if ($from_account_currency == $to_account_currency) {
                    echo json_encode(['currency' => 0]);
                    exit;
                }
                else
                {
                    echo json_encode(['from_currency' => $from_account_currency, 'to_currency' => $to_account_currency, 'currency' => 1]);
                    exit;
                }
            }
        }
        else
        {
            echo json_encode(['currency' => 0]);
        }
    }


    public function save_transaction()
    {
        $type = $this->input->post('type');

        $transaction_type = trim($this->input->post('transaction_type'));

        $this->form_validation->set_rules('transaction_type', lang('transaction_type'), 'trim|required|xss_clean');

        if ($transaction_type == 'Deposit' || $transaction_type == 'Expenses')
        {
            $this->form_validation->set_rules('account', lang('account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('category_id', lang('category_id'), 'trim|required|xss_clean');
        }
        else if ($transaction_type == 'TR')
        {
            $this->form_validation->set_rules('from_account', lang('from_account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('to_account', lang('to_account'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('payment_method', lang('payment_method'), 'trim|required|xss_clean');
        }
        else
        {
            $this->form_validation->set_rules('category_id', lang('category_id'), 'trim|required|xss_clean');
        }

        $this->form_validation->set_rules('amount', lang('amount'), 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true)
        {
            if ($transaction_type == 'Deposit' || $transaction_type == 'Expenses')
            {
                $data['account_id']             = $this->input->post('account');
                $data['payment_method']         = $this->input->post('payment_method');
                $data['category_id']            = $this->input->post('category_id');
            }
            elseif ($transaction_type == 'TR')
            {
                $from_account_id                = $this->input->post('from_account');
                $to_account_id                  = $this->input->post('to_account');
                $data['payment_method']         = $this->input->post('payment_method');

                if ($from_account_id == $to_account_id) {
                    $this->message->custom_error_msg('transactions/add_transaction', lang('same_account_transfer_not_allowed'));
                }
            }
            else
            {
                $data['category_id']            = $this->input->post('category_id');
            }

            if ($transaction_type == 'AP')
            {
                $data['account_id'] = 4;
            }
            elseif ($transaction_type == 'AR')
            {
                $data['account_id'] = 2;
            }

            $transaction_type = $this->_transaction_type($transaction_type);
            $data['transaction_type_id'] = $transaction_type[0];
            $data['transaction_type'] = $transaction_type[1];

            $data['amount']         = floatval($this->input->post('amount'));
            $data['ref']            = trim($this->input->post('ref'));
            $data['description']    = trim($this->input->post('description'));

            if ($data['transaction_type_id'] == 3)  // Accounts Payable A/P
            {
                $balance = $this->db->get_where('account_head', ['id' => 4])->row()->balance;
                $data['balance'] = $balance + $data['amount'];
                $account_head['balance'] = $balance + $data['amount'];
                $this->db->where('id', 4);
                $this->db->update('account_head', $account_head);
            }
            elseif ($data['transaction_type_id'] == 4)      // Accounts Receivable A/R
            {
                $balance = $this->db->get_where('account_head', ['id' => 2])->row()->balance;
                $data['balance'] = $balance + $data['amount'];
                $account_head['balance'] = $balance + $data['amount'];
                $this->db->where('id', 2);
                $this->db->update('account_head', $account_head);
            }
            elseif ($data['transaction_type_id'] == 5)      // Transfer Balance
            {
                $from_account = $this->db->get_where('account_head', ['id' => $from_account_id])->row();
                $to_account = $this->db->get_where('account_head', ['id' => $to_account_id])->row();

                $from_account_balance = $from_account->balance;
                $to_account_balance = $to_account->balance;

                $from_account_currency = $from_account->account_currency;
                $to_account_currency = $to_account->account_currency;

                if ($data['amount'] > $from_account_balance)
                {
                    $this->message->custom_error_msg('transactions/add_transaction', lang('amount_transfer_bigger_balance'));
                }


                $amount_2 = $data['amount'];

                if ( MULTI_CURRENCY && ($from_account_currency != $to_account_currency) )
                {
                    $to_amount = trim($this->input->post('amount_2'));
                    if (empty($to_amount))
                    {
                        $this->message->custom_error_msg('transactions/add_transaction', 'amount2 field is required');
                    }
                    $amount_2 = $to_amount;
                }


                $data_from['balance'] = $from_account_balance - $data['amount'];
                $data_to['balance'] = $to_account_balance + $amount_2 ;

                $this->db->where('id', $from_account_id);
                $this->db->update('account_head', $data_from);

                $this->db->where('id', $to_account_id);
                $this->db->update('account_head', $data_to);
            }
            else        // account
            {
                $balance = $this->db->get_where('account_head', ['id' => $data['account_id']])->row()->balance;

                if ($data['transaction_type_id'] == 1)
                {
                    // Deposit
                    $data['balance'] = $balance + $data['amount'];
                    $account_head['balance'] = $balance + $data['amount'];

                    $this->db->where('id', $data['account_id']);
                    $this->db->update('account_head', $account_head);
                }

                if ($data['transaction_type_id'] == 2)
                {
                    // Expenses
                    if ($data['amount'] > $balance)
                    {
                        $this->message->custom_error_msg('transactions/add_transaction', lang('account_balance_not_valid'));
                    }
                    $data['balance'] = $balance - $data['amount'];
                    $account_head['balance'] = $balance - $data['amount'];

                    $this->db->where('id', $data['account_id']);
                    $this->db->update('account_head', $account_head);
                }
            }

            if ($data['transaction_type_id'] != 5)
            {
                $this->db->insert('transactions', $data);

                $id = $this->db->insert_id();
                $transaction_id['transaction_id'] = TRANSACTION_PREFIX + $id;
                $this->db->where('id', $id);
                $this->db->update('transactions', $transaction_id);
            }
            else
            {
                // From account Transfer
                $this->db->insert('transactions', $data);
                $trn_from_id = $this->db->insert_id();
                $data_from['transaction_id']        = TRANSACTION_PREFIX + $trn_from_id;
                $data_from['transaction_type']      = lang('transfer');
                $data_from['transaction_type_id']   = 5;
                $data_from['account_id']            = $from_account_id;
                $data_from['category_id']           = 99;

                $this->db->where('id', $trn_from_id);
                $this->db->update('transactions', $data_from);

                // To Account Transfer
                $this->db->insert('transactions', $data);
                $trn_to_id                          = $this->db->insert_id();
                $data_to['transaction_id']          = TRANSACTION_PREFIX + $trn_from_id;
                $data_to['transaction_type']        = lang('deposit');
                $data_to['transaction_type_id']     = 1 ;
                $data_to['account_id']              = $to_account_id ;
                $data_to['category_id']             = 99;
                $data_to['amount']                  = $amount_2;

                $this->db->where('id', $trn_to_id);
                $this->db->update('transactions', $data_to);

                $ref = [
                    [
                        'id' => $trn_from_id,
                        'transfer_ref' => $data_to['transaction_id']
                    ],
                    [
                        'id' => $trn_to_id,
                        'transfer_ref' => $data_from['transaction_id'],
                    ]
                ];

                $this->db->update_batch('transactions', $ref, 'id');

            }

            $this->message->save_success('transactions/add_transaction?type='.$type);


        }
        else
        {
            $error = validation_errors();
            $this->message->custom_error_msg('transactions/add_transaction?type=' . $type, $error);
        }

    }


    public function _transaction_type($prm)
    {
        /* @transaction_type
         *
         * Deposit
         * Expense
         * Accounts Payable
         * Accounts Receivable
         *
         * @transaction_type_id
         *
         * 1 = Deposit
         * 2 = Expense
         * 3 = Accounts Payable(A/P)
         * 4 = Accounts Receivable(A/R)
         *
         */

        switch ($prm)
        {
            case 'Deposit':
                $transaction[0] = 1;
                $transaction[1] = lang('deposit');
                return $transaction;
                break;
            case 'Expenses':
                $transaction[0] = 2;
                $transaction[1] = lang('expense');
                return $transaction;
                break;
            case 'AP':
                $transaction[0] = 3;
                $transaction[1] = 'A/P';
                return $transaction;
                break;
            case 'AR':
                $transaction[0] = 4;
                $transaction[1] = 'AR';
                return $transaction;
                break;
            case 'TR':
                $transaction[0] = 5;
                $transaction[1] = lang('account_transfer');
                return $transaction;
                break;
        }
    }



    public function all_transaction()
    {
        $this->load_daterange_datepicker();
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/dataTableAjax.js'));
        $this->data['accounts'] = $this->db->get('account_head')->result();
        $this->admin_template('transaction_list', $this->data);
    }


    public function transaction_list()
    {
        $this->load->model('Global_model');
        $this->Global_model->table = 'transactions';
        $this->Global_model->order = ['id' => 'desc'];
        $list = $this->Global_model->get_transactions_dataTables();

        $data = [];
        $no = $_POST['start'];

        foreach ($list as $item) {

                $currency = '';
                if (MULTI_CURRENCY) {
                    $currency = '(' . setting('currency_symbol') . ')';
                    if ($item->account_currency) {
                        $currency = '('. explode('-', $item->account_currency)[0] . ')';
                    }
                }


            $no++;
            $row = [];
            $row[] = '<a href="'.base_url().'transactions/view/'.$this->make_encryption($item->id).'">'.$item->transaction_id.'</a>';
            $row[] = '<a href="'.base_url().'transactions/view_transaction/'.$this->make_encryption('account-'.$item->account_id).'">'.$item->account_name.'</a>';
            $row[] = '<a href="'.base_url().'transactions/view_transaction/'.$this->make_encryption('transaction_type-'.$item->transaction_type_id).'">'.$item->transaction_type.'</a>';
            $row[] = '<a href="'.base_url().'transactions/view_transaction/'.$this->make_encryption('category-'.$item->category_id).'">'.$item->category_name.'</a>';

            if ($item->transaction_type_id == 1 || $item->transaction_type_id == 4)
            {
                $row[] = '<span class="dr">'.$this->localization->currencyFormat($item->amount).'</span>';
            }
            else
            {
                $row[] = '<span class="dr">'.$this->localization->currencyFormat(0).'</span>';
            }

            if ($item->transaction_type_id == 2 || $item->transaction_type_id == 3 || $item->transaction_type_id == 5)
            {
                $row[] = '<span class="cr">'.$this->localization->currencyFormat($item->amount).'</span>';
            } else {
                $row[] = '<span class="cr">'.$this->localization->currencyFormat(0).'</span>';
            }

            $row[] = '<span class="balance">'.$this->localization->currencyFormat($item->balance) . $currency .'</span>';
            $row[] = $this->localization->dateFormat($item->date_time);

            // add html for action
            $output = '';
            if (in_array('edit_transaction', $this->logged_in_user_permissions)) {
                $output = '<div class="btn-group"><a class="btn btn-xs btn-default" href="' . site_url('transactions/edit_transaction/' . $this->make_encryption($item->id)) . '">
                <i class="fa fa-pencil"></i></a>
                
               ';
            }

            if (in_array('delete_transaction', $this->logged_in_user_permissions)) {
                $output .= '<a href="'.site_url('transactions/delete_transaction/'.$this->make_encryption($item->id)).'" class="btn btn-danger btn-xs" 
                        onclick="return confirm(\'Are you sure you want to delete\')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>';
            }

            $output .= ' <a target="_blank" href="'.site_url('transactions/print_transaction/' . $this->make_encryption($item->id)).'" class="btn btn-primary btn-xs">
                <i class="glyphicon glyphicon-print"></i>
                </a>
                </div>';

            $row[] = $output;

            $data[] = $row;
        }

        $output = [
            'draw'              => intval($_POST['draw']),
            'recordTotal'       => $this->Global_model->count_all_transactions(),
            'recordsFiltered'   => $this->Global_model->count_filtered_transactions(),
            'data'              => $data,
        ];

        // output to json format
        echo json_encode($output);
    }


    public function view($id = null)
    {
        if (!empty($id))
        {
            $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
            $result = $this->db->select('transactions.*, account_head.account_title, transaction_category.name as category_name')
                        ->from('transactions')
                        ->join('account_head', 'account_head.id = transactions.account_id', 'left')
                        ->join('transaction_category', 'transaction_category.id = transactions.category_id', 'left')
                        ->where('transactions.id', $id)
                        ->get()
                        ->row();

            $result == true || $this->message->norecord_found('transactions/all_transaction');

            if (!empty($result->transfer_ref))
            {
                $transfer_from = $this->db->select('transactions.*, account_head.account_title, transaction_category.name as category_name')
                                    ->from('transactions')
                                    ->join('account_head', 'account_head.id = transactions.account_id', 'left')
                                    ->join('transaction_category', 'transaction_category.id = transactions.category_id', 'left')
                                    ->where('transactions.id', $result->transfer_ref)
                                    ->get()
                                    ->row();
                $this->data['transaction_from'] = $transfer_from;
            }

            $this->data['transaction'] = $result;
            $this->data['account'] = $this->db->get_where('account_head', ['account_type_id' => 1])->result();
            $this->admin_template('view_transaction', $this->data);

        }
    }


    public function view_transaction($id = null)
    {
        if (!empty($id))
        {
            $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
            $prm = explode('-', $id);
            $this->data['column'] = $prm[0] . '_id';
            $this->data['id'] = $prm[1];

            if ($this->data['column'] == 'account_id')
            {
                $result = $this->db->get_where('account_head', ['id' => $this->data['id']])->row()->account_title;
                if (empty($result)) {
                    $this->message->custom_error_msg('transactions/all_transaction', lang('no_record_found'));
                }
            }
            elseif ($this->data['column'] == 'transaction_type_id')
            {
                $result = $this->db->get_where('transactions', [
                    'transaction_type_id' => $this->data['id']
                ])->row()->transaction_type;
                if (empty($result)) {
                    $this->message->custom_error_msg('transactions/all_transaction', lang('no_record_found'));
                }
            }
            elseif ($this->data['column'] == 'category_id')
            {
                $result = $this->db->get_where('transaction_category', [
                    'id' => $this->data['id']
                ])->row()->name;
                if (empty($result)) {
                    $this->message->custom_error_msg('transactions/all_transaction', lang('no_record_found'));
                }
            }
            else
            {
                $this->message->custom_error_msg('transactions/all_transaction', lang('no_record_found'));
            }
        }
        else
        {
            $this->message->custom_error_msg('transactions/all_transaction', lang('no_record_found'));
        }

        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/dataTableAjax.js'));

        $this->data['title'] = $result;
        $this->admin_template('transaction_view', $this->data);
    }


    public function transaction_view($id)
    {
        $this->load->model('Global_model');

        $prm = explode('-', $id);

        $column = $prm[0];
        $id = $prm[1];
        $this->Global_model->table = 'transactions';
        $this->Global_model->col = $column;
        $this->Global_model->colId = $id;

        $this->Global_model->order = ['id' => 'desc'];
        $list = $this->Global_model->get_transactions_dataTables($column,$id);

        $data = [];
        $num = $_POST['start'];

        foreach ($list as $item) {
            $num++;
            $row = [];



            $row[] = $item->transaction_id;
            if ($column != 'account_id')
            {
                $row[] = '<a href="'.base_url().'transactions/view_transaction/'.$this->make_encryption('account-'.$item->account_id).'">'.$item->account_name.'</a>';
            }

            if ($column != 'transaction_type_id')
            {
                $row[] = '<a href="'.base_url().'transactions/view_transaction/'.$this->make_encryption('transaction_type-'.$item->transaction_type_id).'">'.$item->transaction_type.'</a>';
            }

            if ($column != 'category_id')
            {
                $row[] = '<a href="'.base_url().'transactions/view_transaction/'.$this->make_encryption('category-'.$item->category_id).'">'.$item->category_name.'</a>';
            }

            if($item->transaction_type_id == 1 || $item->transaction_type_id == 4){
                $row[] = '<span class="dr">'.$this->localization->currencyFormat($item->amount).'</span>';
            }else{
                $row[] = '<span class="dr">'.$this->localization->currencyFormat(0).'</span>';
            }

            if($item->transaction_type_id == 2 || $item->transaction_type_id == 3 || $item->transaction_type_id == 5 ){
                $row[] = '<span class="cr">'.$this->localization->currencyFormat($item->amount).'</span>';
            }else{
                $row[] = '<span class="cr">'.$this->localization->currencyFormat(0).'</span>';
            }

            $row[] = '<span class="balance">'.$this->localization->currencyFormat($item->balance).'</span>';
            $row[] = $this->localization->dateFormat($item->date_time);

            //add html for action
            $row[] = '<div class="btn-group"><a class="btn btn-xs btn-default" href="'.site_url('transactions/edit_transaction/'.$this->make_encryption($item->id)).'">
                <i class="fa fa-pencil"></i></a>
                <a href="'.site_url('transactions/delete_transaction/'.$this->make_encryption($item->id)).'" class="btn btn-danger btn-xs" 
                        onclick="return confirm(\'Are you sure you want to delete\')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
                </div>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Global_model->count_all_transactions(),
            "recordsFiltered" => $this->Global_model->count_filtered_transactions(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);


    }




    public function edit_transaction($id)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $result = $this->db->select('transactions.*, account_head.account_title, transaction_category.name as category_name')
                    ->from('transactions')
                    ->join('account_head', 'account_head.id = transactions.account_id', 'left')
                    ->join('transaction_category', 'transaction_category.id = transactions.category_id', 'left')
                    ->where('transactions.id', $id)
                    ->get()
                    ->row();

        $result == TRUE || $this->message->norecord_found('transactions/all_transaction');

        if (!empty($result->transfer_ref))
        {
            $transfer_from = $this->db->select('transactions.*, account_head.account_title, transaction_category.name as category_name')
                                    ->from('transactions')
                                    ->join('account_head', 'account_head.id = transactions.account_id', 'left')
                                    ->join('transaction_category', 'transaction_category.id = transactions.category_id', 'left')
                                    ->where('transactions.transaction_id', $result->transfer_ref)
                                    ->get()
                                    ->row();

            $this->data['transaction_from'] = $transfer_from;
        }


        $this->data['transaction'] = $result;
        $this->data['accounts'] = $this->db->get_where('account_head', ['account_type_id' => 1])->result();

        $this->admin_template('edit_transaction', $this->data);
    }



    public function print_transaction($id)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $result = $this->db->select('transactions.*, account_head.account_title, transaction_category.name as category_name')
                    ->from('transactions')
                    ->join('account_head', 'account_head.id = transactions.account_id', 'left')
                    ->join('transaction_category', 'transaction_category.id = transactions.category_id', 'left')
                    ->where('transactions.id', $id)
                    ->get()
                    ->row();
           
        $result == TRUE || $this->message->norecord_found('transactions/all_transaction');
        $this->data['transaction'] = $result;
        $account = $this->db->get_where('account_head', ['id' => $result->account_id])->row();

        $currency = substr_replace(setting('default_currency'), '', strpos(setting('default_currency'), '-'));

        if ($account->account_currency) {
            $currency = substr_replace($account->account_currency, '', strpos($account->account_currency, '-'));
        }

        $this->data['currency'] = $currency;


        $this->admin_template('print_transaction', $this->data);

    }


    public function delete_transaction($id = null)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));

        // Select all transactions will affected
        $result = $this->db->select('*')
                ->from('transactions')
                ->where('id > ', $id)
                ->order_by('id', 'desc')
                ->get()
                ->result();

        // Select delete transaction row
        $transaction = $this->db->get_where('transactions', ['id' => $id])->row();
        $transaction == true || $this->message->norecord_found('transactions/all_transaction');

        /**
         * @deposit balance adjustment
         * @deposit deduct from accounts head
         * @select delete transaction row amount and balance
         * @new_transaction_balance  = balance - amount
         * @adjustTransactionBalance
         *
         * @deposit     = 1
         * @expense     = 2
         * @AP          = 3
         * @AR          = 4
         * @transfer    = 5
         */

        // Account head select
        $account_balance = $this->db->get_where('account_head', ['id' => $transaction->account_id])->row()->balance;

        if ($transaction->transaction_type_id == 1)     // Deposit
        {
            $accountBalance['balance'] = $account_balance - $transaction->amount;

            $this->db->where('id', $transaction->account_id);
            $this->db->update('account_head', $accountBalance);

            // Batch update
            $this->new_transaction_balance = $transaction->balance - $transaction->amount;
            $this->_adjust_balance($result, $transaction);

            // Delete transactions
            $this->db->delete('transactions', ['id' => $id]);

            // if account transfer has
            if (!empty($transaction->transfer_ref))
            {
                // Batch update
                $this->_transfer_adjustment($transaction->transfer_ref);
            }
        }
        elseif ($transaction->transaction_type_id == 2 || $transaction->transaction_type_id == 5) // expense and transfer
        {
            $accountBalance['balance'] = $account_balance + $transaction->amount;

            $this->db->where('id', $transaction->account_id);
            $this->db->update('account_head', $accountBalance);

            // Batch update
            $this->new_transaction_balance = $transaction->balance + $transaction->amount;
            $this->_adjust_balance($result, $transaction);

            // Delete transactions
            $this->db->delete('transactions', ['id' => $id]);

            // if account transfer has
            if (!empty($transaction->transfer_ref))
            {
                // Batch update
                $this->_transfer_adjustment($transaction->transfer_ref);
            }

        }
        elseif ($transaction->transaction_type_id == 3 || $transaction->transaction_type_id == 4)
        {
            $accountBalance['balance'] = $account_balance - $transaction->amount;

            $this->db->where('id', $transaction->account_id);
            $this->db->update('account_head', $accountBalance);

            // Batch update
            $this->new_transaction_balance = $transaction->balance - $transaction->amount;
            $this->_adjust_balance($result, $transaction);

            // Delete transactions
            $this->db->delete('transactions', ['id' => $id]);
        }

        $this->message->delete_success('transactions/all_transaction');
    }



    public function search_transactions()
    {
        $this->load_datepicker();
        $start_date = trim($this->input->post('start_date'));
        $end_date = trim($this->input->post('end_date'));
        $account_id = trim($this->input->post('account'));
        $transaction_type = trim($this->input->post('transaction_type'));

        $this->data['search'] = [
            'start_date'        => $start_date,
            'end_date'          => $end_date,
            'account_id'        => $account_id,
            'transaction_type'  => $transaction_type
        ];

        $result = $this->_search_transactions($start_date, $end_date, $account_id, $transaction_type);

        $this->data['transactions'] = $result;
        $this->data['accounts'] = $this->db->get('account_head')->result();

        $this->admin_template('search', $this->data);
    }


    private function _search_transactions($start_date = null, $end_date = null, $account_id = null, $transaction_type = null)
    {
        $this->db->select('transactions.*, account_head.account_title, transaction_category.name', false);
        $this->db->from('transactions');
        $this->db->join('account_head', 'account_head.id = transactions.account_id', 'left');
        $this->db->join('transaction_category', 'transaction_category.id = transactions.category_id', 'left');

        if (!empty($start_date) && !empty($end_date))
        {
            $start_date = DateTime::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
            $end_date = DateTime::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

            if ($start_date == $end_date)
            {
                $this->db->like('transactions.date_time', $start_date);
            }
            else
            {
                $this->db->where('transactions.date_time >=', $start_date);
                $this->db->where('transactions.date_time <=', $end_date.' '.'23:59:59');
            }
        }
        elseif (!empty($start_date))
        {
            $start_date = DateTime::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
            $this->db->like('transactions.date_time', $start_date);
        }
        elseif (!empty($end_date))
        {
            $end_date = DateTime::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
            $this->db->like('transactions.date_time', $end_date);
        }

        if (!empty($account_id))
        {
            $this->db->where('transactions.account_id', $account_id);
        }

        if (!empty($transaction_type))
        {
            $this->db->where('transactions.transaction_type_id', $transaction_type);
        }

        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }





    //==================================================================================================================
    //*********************************************** Income Categories ************************************************
    //==================================================================================================================
    public function income_category()
    {
        $this->data['categories'] = $this->db->order_by('name', 'asc')->get_where('transaction_category', ['type' => 1])->result();
        $this->admin_template('income_category', $this->data);
    }


    public function add_income_category($id = null)
    {
        $data['category'] = $this->db->get_where('transaction_category', ['id' => $id])->row();
        $data['modal_subview'] = $this->load->view('_modal/add_income_category', $data, false);
        //$this->load->view('');
    }

    public function edit_income_category($id)
    {
        $this->add_income_category($id);
    }

    public function save_income_category()
    {
        $this->form_validation->set_rules('name', lang('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true)
        {
            $id = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');

            if (empty($id))
            {
                $data['type'] = 1;
                $this->db->insert('transaction_category', $data);
            }
            else
            {
                $this->db->where('id', $id);
                $this->db->update('transaction_category', $data);
            }
            $this->message->save_success('transactions/income_category');
        }
        else
        {
            $errors = validation_errors();
            $this->message->custom_error_msg('transactions/income_category', $errors);
        }
    }


    //==================================================================================================================
    //*********************************************** Expense Categories ************************************************
    //==================================================================================================================

    public function expense_category()
    {
        $this->data['categories'] = $this->db->order_by('name', 'asc')->get_where('transaction_category', ['type' => 2])->result();
        $this->admin_template('expense_category', $this->data);
    }

    public function add_expense_category($id = null)
    {
        $data['category'] = $this->db->get_where('transaction_category', ['id' => $id])->row();
        $data['modal_subview'] = $this->load->view('_modal/add_expense_category', $data, false);
    }

    public function edit_expense_category($id = null)
    {
        $this->add_expense_category($id);
    }


    public function save_expense_category()
    {
        $this->form_validation->set_rules('name', lang('name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');

        if ($this->form_validation->run() == true)
        {
            $id = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');

            if (empty($id))
            {
                $data['type'] = 2;
                $this->db->insert('transaction_category', $data);
            }
            else
            {
                $this->db->where('id', $id);
                $this->db->update('transaction_category', $data);
            }
            $this->message->save_success('transactions/expense_category');
        }
        else
        {
            $errors = validation_errors();
            $this->message->custom_error_msg('transactions/expense_category', $errors);
        }
    }


    public function delete_category($id = null)
    {
        $result = $this->db->get_where('transactions', array('category_id' => $id))->result();
        $category = $this->db->get_where('transaction_category', ['id' => $id])->row();
        $url = $category->type == 1 ? 'transactions/income_category' : 'transactions/expense_category';

        if (is_array($result) && count($result))
        {
            $this->message->custom_error_msg($url, lang('record_has_been_used'));
        }
        else
        {
            $this->db->delete('transaction_category', ['id' => $id]);
            $this->message->delete_success($url);
        }

    }



    private function make_encryption($data)
    {
        return str_replace(array('+', '/', '='), array('-', '_', '~'), $this->encryption->encrypt($data));
    }

    private function _adjust_balance($result, $transaction)
    {
        foreach ($result as $item) {
            if ($transaction->account_id == $item->account_id)
            {
                if ($item->transaction_type_id == 1)
                {
                    $this->new_transaction_balance += $item->amount;
                    $trans_update[] = [
                        'id' => $item->id,
                        'balance' => $this->new_transaction_balance,
                    ];
                }
                elseif ($item->transaction_type_id == 2 || $item->transaction_type_id == 5)
                {
                    $this->new_transaction_balance -= $item->amount;
                    $trans_update[] = [
                        'id' => $item->id,
                        'balance' => $this->new_transaction_balance,
                    ];
                }
            }
        }

        if (isset($trans_update) && !empty($trans_update))
        {
            $this->db->update_batch('transactions', $trans_update, 'id');
        }
    }

    private function _adjust_balance_other($result, $transaction)
    {
        foreach ($result as $item) {
            if ($transaction->account_id == $item->account_id)
            {
                if ($item->transaction_type_id == 1 || $item->transaction_type_id == 3 || $item->transaction_type_id == 4)
                {
                    $this->new_transaction_balance += $item->amount;
                    $trans_update[] = [
                        'id' => $item->id,
                        'balance' => $this->new_transaction_balance,
                    ];
                }
                elseif ($item->transaction_type_id == 2)
                {
                    $this->new_transaction_balance -= $item->amount;
                    $trans_update[] = [
                        'id' => $item->id,
                        'balance' => $this->new_transaction_balance,
                    ];
                }
            }
        }

        if (isset($trans_update) && !empty($trans_update))
        {
            $this->db->update_batch('transactions', $trans_update, 'id');
        }
    }


    private function _transfer_adjustment($transfer_ref)
    {
        $transfer = $this->db->get_where('transactions', array(
            'transaction_id' => $transfer_ref
        ))->row();

        $result = $this->db->select("*")
            ->from('transactions')
            ->where('id >', $transfer->id)
            ->order_by('id', 'asc')
            ->get()
            ->result();


        // account head
        $account_balance = $this->db->get_where('account_head', [
            'id' => $transfer->account_id,
        ])->row()->balance;

        if ($transfer->transaction_type_id == 5)
        {
            $accountBalance['balance'] = $account_balance + $transfer->amount;
            $this->new_transaction_balance = $transfer->balance + $transfer->amount;
        }
        else
        {
            $accountBalance['balance'] = $account_balance - $transfer->amount;
            $this->new_transaction_balance = $transfer->balance - $transfer->amount;
        }

        // update account head
        $this->db->where('id', $transfer->account_id);
        $this->db->update('account_head', $accountBalance);


        foreach ($result as $item)
        {
            if ($transfer->account_id == $item->account_id)
            {
                if ($item->transaction_type_id == 1)
                {
                    $this->new_transaction_balance += $item->amount;
                    $trans_update[] = [
                        'id' => $item->id,
                        'balance' => $this->new_transaction_balance,
                    ];
                }
                elseif ($item->transaction_type_id == 2 || $item->transaction_type_id == 5)
                {
                    $this->new_transaction_balance -= $item->amount;
                    $trans_update[] = [
                        'id' => $item->id,
                        'balance' => $this->new_transaction_balance,
                    ];
                }
            }
        }

        // Delete transaction
        $this->db->delete('transactions', ['id' => $transfer->id]);

        if (!empty($trans_update))
        {
            $this->db->update_patch('transactions', $trans_update, 'id');
        }

    }
}