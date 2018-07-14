<?php

class Finance extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Finance_model');
    }


    public function customers_payment()
    {
        $this->data['datatables'] = true;
        $this->data['js_files'][] =  'assets/admin_panel/js/datetime.min.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/finance.js';
        $this->data['datepicker_range'] = true;
        $this->lang->load('services_entry');
//        $this->load->module('representatives');
//        $representatives = $this->representatives->Representative_model->get();
//        $this->data['representatives'] = $representatives;
        $this->load->module('worker_nationality');
        $countries = $this->worker_nationality->Worker_nationality_model->get_ordered();
        $this->data['countries'] = $countries;

        $this->adminTemplate('customers_payment', $this->data);


//        if (isset($_GET['customer_name']))
//        {
//            $customer_name = urldecode($_GET['customer_name']);
//            $this->db->where('customer_name_in_arabic', $customer_name);
//            $customer = $this->db->get('services_customer');
//            if ($customer && count($customer->row()))
//            {
//                $customer = $customer->row();
//                $this->db->where('contract_number', $customer->contract_number);
//                $service_finance = $this->db->get('services_finance')->row();
//                $this->data['customer'] = $customer;
//                $this->data['service_finance'] = $service_finance;
//            }
//        }

    }

    public function load_not_paid_contracts()
    {
        $this->Finance_model->get_not_paid_customers();
    }


    public function add_new_payment($contract_number)
    {
        $customer_service = $this->db->get_where('services_customer', array('contract_number' => $contract_number));
        $customer = $customer_service->row();

        $contract_finance = $this->db->get_where('services_finance', array('contract_number' => $contract_number));
        $finance = $contract_finance->row();

        if (count($customer) && count($finance))
        {
            $this->data['customer'] = $customer;
            $this->data['finance'] = $finance;
            $this->adminTemplate('add_payment', $this->data);
        }
    }


    public function save_payment()
    {
        $paid_money = $_POST['paid_money'];
        $this->db->where('contract_number', $_POST['contract_number']);
        $service_finance = $this->db->get('services_finance')->row();
        if ($service_finance && count($service_finance))
        {
            if ($service_finance->remains_money == 0)
            {
                $this->session->set_flashdata('error', 'هذا الزبون ليس عليه مبالغ متبقية');
                redirect(site_url('finance/add_new_payment/' . $_POST['contract_number']));
            }

            if ($paid_money > $service_finance->remains_money)
            {
                $this->session->set_flashdata('error', 'المبلغ المدفوع أكبر من المبلغ المطلوب دفعه');
                redirect(site_url('finance/add_new_payment/' . $_POST['contract_number']));
            }

            $this->Finance_model->save([
                'contract_number' => $_POST['contract_number'],
                'payment_amount' => $paid_money,
            ]);
            $new_prepaid_money = $service_finance->prepaid_money + $paid_money;
            $new_remains_money = ($service_finance->recruitment_cost - $new_prepaid_money);

            $this->db->query("UPDATE services_finance SET prepaid_money = ?, remains_money = ? WHERE contract_number = ?", array($new_prepaid_money, $new_remains_money, $_POST['contract_number']));

            $this->load->module('customers_payment');
            $customer = $this->Finance_model->get_customer_by_contract_number($_POST['contract_number']);
            $this->customers_payment->make_payment($customer->customer_id, $customer->visa_number, $customer->contract_number,
                $paid_money, date('Y-m-d'), $_POST['transfer_type']);

            $this->session->set_flashdata('success', 'تم الدفع بنجاح');
            redirect(site_url('finance/add_new_payment/' . $_POST['contract_number']));
        }
    }


    public function print_payment_2($contract_number)
    {
        if ($contract_number)
        {
            $this->db->order_by('created_at', 'desc');
            $finance_operation = $this->db->get_where('finance_operations', array('contract_number' => $contract_number));
            $finance = $finance_operation->row();
            if ($finance && count($finance))
            {
                $customer_service = $this->db->get_where('services_customer', array('contract_number' => $contract_number));
                $customer = $customer_service->row();
                $this->data['amount'] = $finance->payment_amount;
                $this->data['customer_name'] = $customer->customer_name_in_arabic;
                $this->data['payment_date'] = date('d/m/Y', strtotime($finance->created_at));
                $this->load->view('test', $this->data);
            }
        }
    }

    public function print_payment_band($visa_number, $band_number)
    {
        $query = $this->db->query("SELECT * FROM services_customer
                   WHERE visa_number = '$visa_number'  
                  AND services_customer.contract_number NOT IN (select contract_number from cancelled_contracts)");
        $this->db->where('visa_number', $visa_number);
        $customer = $query->row();
//        var_dump($customer);exit;
        $this->db->where('payment_number', $band_number);
        $payment_info = $this->db->get('customers_payment')->row();
        $this->db->where('contract_number', $customer->contract_number);
        $worker = $this->db->get('services_worker')->row();

        $this->db->where('contract_number', $customer->contract_number);
        $this->data['finance'] = $this->db->get('services_finance')->row();


        $this->db->where('id', $worker->job_id);
        $job = $this->db->get(' jobs')->row()->name_in_arabic;

        $this->db->where('id', $worker->worker_nationality_id);
        $nationality = $this->db->get('worker_nationality')->row()->nationality_in_arabic;

        $this->load->module('transfer_types');
        $transfer =  '';
        $transfer_type = '';
        $category_type = '';
        if ($payment_info->transfer_type != 0)
        {
            $type = $this->transfer_types->Transfer_type_model->get_by(array('id' => $payment_info->transfer_type), true);
            $transfer_type = $type->type;
            if ($type->parent_id != 0)
            {
                $category_type = $this->transfer_types->get_type_by_id($type->parent_id) . ' - ' ;
            }

            $transfer = $category_type . $transfer_type;
        }

        $this->data['transfer'] = $transfer;

        $this->data['customer_name'] = $customer->customer_name_in_arabic;
        $this->data['amount'] = $payment_info->payment_amount;
        $this->data['payment_date'] = date('d/m/Y', strtotime($payment_info->payment_date));
        $this->data['job'] = $job;
        $this->data['nationality'] = $nationality;
        $this->load->view('print_payment_band', $this->data);

    }

    public function print_payment($contract_number, $customer_name)
    {
        if ($contract_number && $customer_name)
        {
            $customer_name = urldecode($customer_name);
            $this->db->where('contract_number', $contract_number);
            $contract_info = $this->db->get('contract')->row();

            $this->db->where('contract_number', $contract_number);
            $services_contract = $this->db->get('services_finance')->row();
            if ($services_contract->prepaid_money != 0)
            {
                $this->data['amount'] = $services_contract->prepaid_money;
                $this->data['customer_name'] = $customer_name;
                $this->data['payment_date'] = date('d/m/Y', strtotime($contract_info->contract_date));
                $this->load->view('test', $this->data);
            }
        }
    }


    public function get_customer()
    {
        $customer_name = filter_input(INPUT_POST, 'query');
        $query = $this->db->query("SELECT * FROM services_customer WHERE customer_name_in_arabic LIKE ?", array('%'.$customer_name.'%'));
//        var_dump($customer_name);
        if ($query->num_rows())
        {
            $data = [];
            foreach ($query->result() as $row)
            {
                $data[] = $row->customer_name_in_arabic;
            }
            echo json_encode($data);
        }
    }


    public function agents_payment()
    {
        $this->load->module('services_entry');
        $this->lang->load('services_entry');
        $this->data['datatables'] = true;
        $this->data['css_files'][] = 'assets/admin_panel/css/bootstrap-editable.css';
        $this->data['js_files'][] = 'assets/admin_panel/js/bootstrap-editable.js';
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();

        $this->data['js_files'] = ['assets/admin_panel/js/agents_payment.js'];

        $this->adminTemplate('agents_payment', $this->data);
    }

    public function load_all_contracts()
    {
        $this->Finance_model->get_all_arrived_contracts();
    }


    public function get_agent_payment_by_contract_number()
    {
        $payment_data = $this->db->get_where('agents_payment_amount', array('contract_number' => $_POST['contract_number']))->row();
        if ($payment_data && count($payment_data)) {
            echo json_encode($payment_data);
            return;
        }
        echo json_encode(['contract_number' => $_POST['contract_number']]);
    }


    public function update_agent_payment_amount()
    {
        return $this->Finance_model->update_agent_payment_amount($_POST);
    }


    public function save_agent_payment()
    {
        $action = $_POST['action'];
        $contract_number = $_POST['contract_number'];
        $agent_id = $_POST['agent_id'];
        if ($action == 'insert') {
            $this->db->where('contract_number', $contract_number);
            $query = $this->db->get('agents_payment');
            $row = $query->row();
            if ($row && count($row)) {
                return true;
            } else {
                $this->db->set(['contract_number' => $contract_number, 'agent_id' => $agent_id]);
                $this->db->insert('agents_payment');
            }

        }
        if ($action == 'delete') {
            $this->db->where('contract_number', $contract_number);
            $this->db->limit(1);
            $this->db->delete('agents_payment');
        }
    }


    public function save_agent_payment_note()
    {
        $contract_number = $this->input->post('contractNumber');
        $note = $this->input->post('note');
        $query = $this->db->query("SELECT * FROM agent_payment_note WHERE contract_number = ?", array($contract_number));

        if ($query->num_rows()) {
            $q2 = $this->db->query("UPDATE agent_payment_note SET note = ? WHERE contract_number = ?", array($note, $contract_number));
            return $q2;
        } else {
            $q2 = $this->db->query("INSERT INTO agent_payment_note(note, contract_number) VALUES (?, ?)", array($note, $contract_number));
            return $q2;
        }

    }


//    public function print_prepaid_customer_payment()
//    {
//        $this->data['prepaid_customers_payment'] = [];
//        $query = "
//            SELECT customers.*, customers_payment.payment_amount
//            FROM customers
//            INNER JOIN customers_payment
//            ON customers.visa_number = customers_payment.visa_number
//        ";
//        $result = $this->db->query($query);
//        if ($result->num_rows())
//        {
//            $this->data['prepaid_customers_payment'] = $result->result();
//        }
//        $this->adminTemplate('print_prepaid_customer_payment', $this->data);
//    }

    public function prepaid_customer_payment()
    {
        if (isset($_GET['visa_number']) && $_GET['visa_number'] != '')
        {
            $this->data['datepicker'] = true;
            $this->data['css_files'] = ['assets/admin_panel/css/lightbox.css'];
            $this->data['js_files'][] = 'assets/admin_panel/js/lightbox.js';
            $this->data['css_files'][] = 'assets/admin_panel/css/bootstrap-editable.css';
            $this->data['js_files'][] = 'assets/admin_panel/js/bootstrap-editable.js';
            $this->data['js_files'][] = 'assets/admin_panel/js/finance.js';

            $visa_number = $_GET['visa_number'];
            $this->load->module('customers_payment');

//            $this->load->module('customers');
//            $customer = $this->customers->Customer_model->get_by(array('visa_number' => $visa_number), true);
            $customer = $this->Finance_model->get_customer($visa_number);

            if ($customer && count($customer))
            {
                $customer_finance_info = $this->Finance_model->get_by(array('contract_number' => $customer->contract_number), true);
                $customer_prepaid_date = date('Y-m-d');
                if ($customer_finance_info && count($customer_finance_info))
                {
                    $customer_prepaid_date = date('Y-m-d', strtotime($customer_finance_info->created_at));
                }
                else
                {
                    $customer_contract = $this->db->get_where('contract', array('contract_number' => $customer->contract_number))->row();
                    $customer_prepaid_date = date('Y-m-d', strtotime($customer_contract->contract_date));
                }


                $this->data['customer'] = $customer;
                // get customer payment
                $customer_payment = $this->Finance_model->get_customer_payment($customer->contract_number);
                $this->data['customer_payment'] = $customer_payment;
                $prepaid_money = (float) $customer_payment->prepaid_money;
                if ($customer_payment && count($customer_payment))
                {
                    $customer_payment_table = $this->customers_payment->Customer_payment_model->get_by(array('visa_number' => $visa_number), true);
                    if ($customer_payment_table && count($customer_payment_table))
                    {

                    }
                    else
                    {
                        if ($prepaid_money != 0)
                        {
                            $this->customers_payment->make_payment($customer->customer_id, $customer->visa_number, $customer->contract_number,
                                $prepaid_money, $customer_prepaid_date);
                        }
                    }
                }

                $customer_payment_data = $this->customers_payment->Customer_payment_model->get_by(array('visa_number' => $visa_number));
                $this->data['customer_payment_data'] = $customer_payment_data;
            }
        }
        $this->adminTemplate('prepaid_customer_payment', $this->data);
    }



    public function update_payment_date()
    {
        $query = "UPDATE customers_payment SET {$_POST['name']} = ? WHERE payment_number = ?";
        $this->db->query($query, array($_POST['value'], $_POST['pk']));
    }

    public function save_prepaid_customer_payment()
    {
        $payment_amount = $this->input->post('payment_amount');
        $visa_number = $this->input->post('visa_number');
        $this->load->module('customers_payment');
        $customer_payment = $this->customers_payment->Customer_payment_model->get_by(array('visa_number' => $visa_number), true);
        if ($customer_payment && count($customer_payment))
        {
            $this->customers_payment->Customer_payment_model->save(array('payment_amount' => $payment_amount), $visa_number);
        }
        else
        {
            $this->db->set(array('payment_amount' => $payment_amount, 'visa_number' => $visa_number));
            $this->db->insert('customers_payment');
        }

        $this->session->set_flashdata('success', 'تم دفع القيمة بنجاح');
        redirect(site_url('finance/prepaid_customer_payment?visa_number=' . $visa_number));
    }


    public function test()
    {
        $this->load->view('test');

//        $query = $this->db->query("SELECT * FROM services_finance");
//        foreach ($query->result() as $row) {
//            $sql = "INSERT INTO finance_operations(contract_number, payment_amount)
//            VALUES($row->contract_number, {$row->prepaid_money})";
//            $this->db->query($sql);
//        }
    }
}