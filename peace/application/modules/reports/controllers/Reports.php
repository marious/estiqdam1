<?php

class Reports extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->middleware->only(['check_permission:show_reports'], ['index']);
        $this->middleware->only(['check_permission:show_transactions_report'], ['transaction']);
        $this->middleware->only(['check_permission:show_summary_account_report'], ['summaryAccount']);
        $this->middleware->only(['check_permission:show_summary_transactions_report'], ['summaryTransaction']);
        $this->middleware->only(['check_permission:show_account_balance_report'], ['BalanceCheck']);
        $this->middleware->only(['check_permission:show_sales_report'], ['salesReport']);
        $this->middleware->only(['check_permission:show_payment_received_report'], ['paymentReceived']);
        $this->middleware->only(['check_permission:show_customer_sales_report'], ['customerSales']);
        $this->middleware->only(['check_permission:show_customer_summary_report'], ['customerSummaryReport']);
        $this->middleware->only(['check_permission:show_customer_lifetime_sales_report'], ['customerLifetimeSales']);
        $this->middleware->only(['check_permission:show_customer_due_payment_report'], ['customerDue']);
        $this->middleware->only(['check_permission:show_customer_over_due_payment_report'], ['customerOverDue']);
        $this->load->model('Report_model');
        $this->lang->load('reports');
        $this->lang->load('transactions');
    }

    public function index()
    {
        $this->admin_template('index', $this->data);
    }


//======================================================================================================================
//****************************************** Transaction Reports *******************************************************
//======================================================================================================================

    public function transaction()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $this->data['transactions'] = [];
        $flag = $this->input->post('flag', true);
        if ($flag)
        {
            $start_date = trim($this->input->post('start_date'));
            $end_date = trim($this->input->post('end_date'));
            $account_id = trim($this->input->post('account'));
            $transaction_type = trim($this->input->post('transaction_type'));

            $this->data['search'] = [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'account_id' => $account_id,
                'transaction_type' => $transaction_type,
            ];

            $this->data['transactions'] = $this->_search_transactions($start_date, $end_date, $account_id, $transaction_type);
        }

        $this->data['accounts'] = $this->db->get('account_head')->result();
        $this->admin_template('transaction_report', $this->data);
    }


    public function summaryAccount()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $flag = $this->input->post('flag', true);
        if ($flag)
        {
            $start_date = trim(date('Y-m-d', strtotime($this->input->post('start_date', true))));
            $end_date = trim(date('Y-m-d', strtotime($this->input->post('end_date', true))));
            $account_id    = $this->input->post('account_id', true);

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['dr'] = $this->db->select('SUM(amount) AS total_dr')
                            ->from('transactions')
                            ->group_by('account_id')
                            ->where('account_id', $account_id)
                            ->where_in('transaction_type_id', [1, 4])
                            ->where('date_time >=', $start_date)
                            ->where('date_time <=', $end_date.' '.'23:59:59')
                            ->get()
                            ->row();

            $this->data['cr'] = $this->db->select('SUM(amount) AS total_cr')
                        ->from('transactions')
                        ->group_by('account_id')
                        ->where('account_id', $account_id)
                        ->where_in('transaction_type_id', [2, 3, 5])
                        ->where('date_time >=', $start_date)
                        ->where('date_time <=', $end_date.' '.'23:59:59')
                        ->get()
                        ->row();


            $this->data['account'] =  $this->db->get_where('account_head', ['id' => $account_id])->row()->account_title;
            $this->data['account_name'] = $this->data['account']->account_title;
        }

        $this->data['accounts'] = $this->db->get('account_head')->result();
        $this->admin_template('summary_account_report', $this->data);
    }




    public function summaryTransaction()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = trim(date('Y-m-d', strtotime($this->input->post('start_date', true))));
            $end_date = trim(date('Y-m-d', strtotime($this->input->post('end_date', true))));
            $transaction_type_id = trim($this->input->post('transaction_type_id', true));

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['transaction'] = $this->db->select('COUNT(id) AS total_transaction, SUM(amount) AS total_amount, transaction_type')
                                                ->from('transactions')
                                                ->group_by('transaction_type_id')
                                                ->where('transaction_type_id', $transaction_type_id)
                                                ->where('date_time >=', $start_date)
                                                ->where('date_time <=', $end_date . ' ' . '23:59:59')
                                                ->get()
                                                ->row();
        }

        $this->admin_template('summary_transaction_report', $this->data);
    }



    public function BalanceCheck()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $flag = $this->input->post('flag');
        $this->data['transactions'] = [];
        if ($flag)
        {
            $start_date = trim($this->input->post('start_date'));
            $end_date = trim($this->input->post('end_date'));
            $account_id = trim($this->input->post('account_id'));

            $this->data['search'] = [
                'start_date' => $start_date,
                'end_date' => $end_date,
                'account_id' => $account_id,
            ];

            $this->data['transactions'] = $this->_search_transactions($start_date, $end_date, $account_id, '');
        }

        $this->data['accounts'] = $this->db->get('account_head')->result();
        $this->admin_template('account_balance', $this->data);
    }



    private function _search_transactions($start_date = null, $end_date = null, $account_id = null, $transaction_type = null)
    {
        $this->db->select('transactions.*, account_head.account_title, transaction_category.name, account_head.account_currency', false);
        $this->db->from('transactions');
        $this->db->join('account_head', 'account_head.id  =  transactions.account_id', 'left');
        $this->db->join('transaction_category', 'transaction_category.id  =  transactions.category_id', 'left');


        if (!empty($start_date) && !empty($end_date))
        {
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));

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
            $start_date = date('Y-m-d', strtotime($start_date));
            $this->db->like('transactions.date_time', $start_date);
        }
        elseif (!empty($end_date))
        {
            $end_date = date('Y-m-d', strtotime($end_date));
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
        return $query_result->result();
    }



//======================================================================================================================
//****************************************** Sale & Purchase Reports ***************************************************
//======================================================================================================================

    public function salesReport()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['invoice'] = $this->Report_model->get_sales_invoice_by_date($start_date, $end_date);
        }

        $this->admin_template('sales_report', $this->data);
    }

    public function purchaseReport()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['invoice'] = $this->Report_model->get_purchase_invoice_by_date($start_date, $end_date);
        }

        $this->admin_template('purchase_report', $this->data);
    }


    public function paymentReceived()
    {
        $this->load_datepicker();
        $this->load_datatable();

        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['invoice'] = $this->Report_model->get_payment_received_by_date($start_date, $end_date);
        }

        $this->admin_template('payment_received', $this->data);


    }

//======================================================================================================================
//****************************************** Customer Reports **********************************************************
//======================================================================================================================

    public function customerSales()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));
            $customer_id    = $this->input->post('customer_id', true);

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;
            $this->data['invoice'] = $this->Report_model->get_sales_invoice_by_date_customer_id($start_date, $end_date, $customer_id);
            $this->data['customer'] = $this->db->get_where('customers', ['id' => $customer_id])->row();
        }

        $this->data['customers'] = $this->db->get('customers')->result();

        $this->admin_template('customer_sales', $this->data);
    }


    public function customerSummaryReport()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));
            $customer_id    = $this->input->post('customer_id', true);

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['sales'] = $this->db->select('customer_id, customer_name, count(id) AS total_sales, SUM(grand_total) AS grand_total, 
                        SUM(amount_received) AS received_amount, SUM(discount) AS discount_total, SUM(due_payment) AS due_payment')
                ->from('invoices')
                ->group_by('customer_id')
                ->where('customer_id', $customer_id)
                ->where('type', 'Invoice')
                ->where('status != ', 'Cancel')
                ->where('date >=', $start_date)
                ->where('date <=', $end_date.' '.'23:59:59')
                ->get()
                ->row();

            $this->data['customer'] = $this->db->get_where('customers', ['id' => $customer_id])->row();
        }

        $this->data['customers'] = $this->db->get('customers')->result();

        $this->admin_template('customer_summary_report', $this->data);
    }


    public function customerLifetimeSales()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');

        if ($flag)
        {
            $customer_id  = $this->input->post('customer_id', true);

            $this->data['sales'] = $this->db->select('customer_id, customer_name, count(id) AS total_sales, SUM(grand_total) AS grand_total, 
                        SUM(amount_received) AS received_amount, SUM(discount) AS discount_total, SUM(due_payment) AS due_payment')
                ->from('invoices')
                ->group_by('customer_id')
                ->where('customer_id', $customer_id)
                ->where('type', 'Invoice')
                ->where('status != ', 'Cancel')
                ->get()
                ->row();
            $this->data['customer'] = $this->db->get_where('customers', ['id' => $customer_id])->row();
        }

        $this->data['customers'] = $this->db->get('customers')->result();
        $this->admin_template('customer_lifetime_sales', $this->data);
    }


    public function customerDue()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');

        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));
            $customer_id    = $this->input->post('customer_id', true);

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;

            $this->data['invoice'] = $this->Report_model->get_sales_due_by_date_customer_id($start_date, $end_date, $customer_id);
            $this->data['customer'] = $this->db->get_where('customers', ['id' => $customer_id])->row();
        }

        $this->data['customers'] = $this->db->get('customers')->result();

        $this->admin_template('customer_due', $this->data);
    }


    public function customerOverDue()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');

        if ($flag)
        {
            $customer_id    = $this->input->post('customer_id', true);
            $this->data['invoice'] = $this->Report_model->get_sales_over_due_customer_id($customer_id);
            $this->data['customer'] = $this->db->get_where('customers', ['id' => $customer_id])->row();
        }

        $this->data['customers'] = $this->db->get('customers')->result();
        $this->admin_template('customer_over_due', $this->data);
    }

//======================================================================================================================
//****************************************** Vendor Reports ************************************************************
//======================================================================================================================

    public function vendorPurchaseReport()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');

        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));
            $vendor_id = $this->input->post('vendor_id', true);

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;
            $this->data['invoice'] = $this->Report_model->get_purchase_invoice_by_date_vendor_id($start_date, $end_date, $vendor_id);
            $this->data['vendor'] = $this->db->get_where('vendors', ['id' => $vendor_id])->row();
        }

        $this->data['vendors'] = $this->db->get('vendors')->result();

        $this->admin_template('vendor_purchase_report', $this->data);

    }


    public function vendorPurchaseDuePayment()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');

        if ($flag)
        {

            $vendor_id = $this->input->post('vendor_id', true);

            $this->data['invoice'] = $this->Report_model->get_purchase_vendor_due_payment($vendor_id);
            $this->data['vendor'] = $this->db->get_where('vendors', ['id' => $vendor_id])->row();
        }

        $this->data['vendors'] = $this->db->get('vendors')->result();
        $this->admin_template('vendor_purchase_due_payment', $this->data);
    }


    public function vendorPaymentByDate()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag');
        if ($flag)
        {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date', true)));
            $end_date = date('Y-m-d', strtotime($this->input->post('end_date', true)));
            $vendor_id = $this->input->post('vendor_id', true);

            $this->data['start_date'] = $start_date;
            $this->data['end_date'] = $end_date;
            $this->data['purchase'] = $this->db->select('vendor_id, vendor_name, COUNT(id) AS total_purchase, SUM(grand_total) AS grand_total, 
                                        SUM(paid_amount) AS paid_amount, SUM(discount) AS discount_total, SUM(tax) AS tax_total, 
                                            SUM(shipping) AS transport_total, SUM(due_payment) AS due_payment')
                                    ->from('purchase_order')
                                    ->group_by('vendor_id')
                                    ->where('vendor_id', $vendor_id)
                                    ->where('type', 'Purchase')
                                    ->where('created_at >= ', $start_date)
                                    ->where('created_at <=', $end_date.' '.'23:59:59')
                                    ->get()
                                    ->row();

            $this->data['vendor'] = $this->db->get_where('vendors', ['id' => $vendor_id])->row();

        }

        $this->data['vendors'] = $this->db->get('vendors')->result();
        $this->admin_template('vendor_payment_report_by_date', $this->data);
    }


    public function lifetimePurchase()
    {
        $this->load_datepicker();
        $this->load_datatable();
        $flag = $this->input->post('flag', true);

        if ($flag)
        {
            $vendor_id = $this->input->post('vendor_id', true);
            $this->data['purchase'] = $this->db->select('vendor_id, vendor_name, COUNT(id) AS total_purchase, SUM(grand_total) AS grand_total, 
                                        SUM(paid_amount) AS paid_amount, SUM(discount) AS discount_total, SUM(tax) AS tax_total, 
                                            SUM(shipping) AS transport_total, SUM(due_payment) AS due_payment')
                            ->from('purchase_order')
                            ->group_by('vendor_id')
                            ->where('vendor_id', $vendor_id)
                            ->where('type', 'Purchase')
                            ->get()
                            ->row();

            $this->data['vendor'] = $this->db->get_where('vendors', ['id' => $vendor_id])->row();
        }

        $this->data['vendors'] = $this->db->get('vendors')->result();
        $this->admin_template('life_time_purchase', $this->data);

    }


//======================================================================================================================
//****************************************** Products and services reports *********************************************
//======================================================================================================================

    public function stockValues()
    {
        $this->load_datatable();
        $this->data['products'] = $this->db->get_where('items', ['is_service' => 0, 'type' => 'Inventory'])->result();
        $this->admin_template('stock_value', $this->data);
    }

    public function stockReport()
    {
        $this->load_datatable();
        $this->data['products'] = $this->db->get_where('items', ['is_service' => 0, 'type' => 'Inventory'])->result();
        $this->admin_template('stock_report', $this->data);
    }

}