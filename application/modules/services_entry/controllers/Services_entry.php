<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_entry extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Service_model');
//
//        $this->load->module('site_settings');
//        $this->data['tax'] = (float) $this->site_settings->Site_setting_model->get(4, true)->tax_amount;
    }




    public function index()
    {
        $this->lang->load('services_entry');
       $contract_date = isset($_GET['contract_date']) ? date('Y-m-d', strtotime($_GET['contract_date'])) : date('Y-m-d');
       $this->data['contract_date'] = $contract_date;

//        $this->data['datatables'] = true;
        $this->data['datepicker'] = true;
        $this->data['css_arabic'] = true;
        $this->data['services'] = $this->Service_model->get_services_entry($contract_date);
//        var_dump($this->data['services']);exit;
//        var_dump($this->data['services']);exit;
        $this->adminTemplate('index', $this->data);
    }


    public function print_daily_reports()
    {
        $contract_date = isset($_GET['contract_date']) ? date('Y-m-d', strtotime($_GET['contract_date'])) : date('Y-m-d');
        $this->data['contract_date'] = $contract_date;
        $this->data['services'] = $this->Service_model->get_services_entry($contract_date);
        $this->load->view('print_daily_reports', $this->data);
    }




    public function all_contracts()
    {
        $this->lang->load('services_entry');
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/all_contracts.js'];
        $this->load->module('representatives');
        $representatives = $this->representatives->Representative_model->get();
        $this->data['representatives'] = $representatives;
        $this->data['agents'] = $this->Service_model->get_agents();
//        $contracts =  $this->Service_model->get_all_contracts();
//        $this->output->enable_profiler(TRUE);


        $this->adminTemplate('all_contracts', $this->data);
    }


    public function load_all_contracts()
    {
        $this->Service_model->get_all_contracts();

    }


    public function add()
    {
        $this->lang->load('services_entry');

        $this->data['datepicker'] = true;
        $this->data['id'] = false;
        $this->data['contract_number'] = $this->Service_model->get_last_contract_number() ?
            ($this->Service_model->get_last_contract_number() + 1) : 1;


        $this->data['credit_cards']             = $this->get_credit_cards();
        $this->data['order_types']              = $this->get_order_types();
        $this->data['customer_nationalities']   = $this->get_customer_nationalities();
        $this->data['representatives']          = $this->get_representatives();
        $this->data['worker_nationalities']     = $this->get_worker_nationalities();
        $this->data['worker_jobs']              = $this->get_worker_jobs();
        $this->data['arrival_airports']         = $this->get_arrival_airports();
        $this->data['departure_airports']       = $this->get_departure_airports();
        $this->data['visa_issued_cities']       = $this->get_visa_issued_cities();
        $this->data['agents']                   = $this->get_agents();


       $this->load->library('form_validation');
       $this->form_validation->set_rules($this->Service_model->rules);


       if ($this->form_validation->run($this) == true)
       {
           // save the contract number in contract table and contract date
           $contract_number = $this->input->post('contract_number', true);
           $contract_date = date('Y-m-d', strtotime($this->input->post('contract_date')));

           $save_contract_number = $this->Service_model->save_contract_number(
               $contract_number, $contract_date
           );

           if ($save_contract_number)
           {
                $this->Service_model->save($this->Service_model->array_from_post(
                    [
                    'contract_number', 'contract_period', 'vacation_period', 'marketer', 'notes_1', 'notes_2', 'representative_id',
                    ]
                ));

                $data_service_finance['contract_number']        = $contract_number;
                $data_service_finance['recruitment_cost']       = $this->input->post('recruitment_cost');
                $data_service_finance['prepaid_money']          = $this->input->post('prepaid_money');
                $data_service_finance['credit_card_id']         = 1;
                $data_service_finance['remains_money']          = ($data_service_finance['recruitment_cost'] - $data_service_finance['prepaid_money']);

                $this->Service_model->save_service_finance($data_service_finance);

                $data_service_order['order_type_id']            = $this->input->post('order_type', true);
                $data_service_order['contract_number']          = $contract_number;
                $data_service_order['order_number']             = $this->input->post('order_number', true);

                $this->Service_model->save_service_order($data_service_order);

                $data_service_customer['customer_name_in_english']      = $this->input->post('customer_name_in_english', true);
               $data_service_customer['customer_name_in_arabic']        = $this->input->post('customer_name_in_arabic', true);
               $data_service_customer['customer_id']                    = $this->input->post('customer_id', true);
               $data_service_customer['customer_nationality_id']           = $this->input->post('customer_nationality', true);
               $data_service_customer['visa_number']                    = $this->input->post('visa_number', true);
               $data_service_customer['visa_date']                      = $this->input->post('visa_date', true);
               $data_service_customer['customer_mobile']                = $this->input->post('customer_mobile', true);
               $data_service_customer['contract_number']                = $contract_number;


               $this->Service_model->save_customer_service($data_service_customer);


               $data_service_wokrer['worker_name_in_english']       = $this->input->post('worker_name_in_english');
               $data_service_wokrer['worker_name_in_arabic']        = $this->input->post('worker_name_in_arabic');
               $data_service_wokrer['worker_salary']                = $this->input->post('worker_salary');
               $data_service_wokrer['qualification']                = $this->input->post('qualification');
               $data_service_wokrer['passport_number']              = $this->input->post('passport_number');
               $data_service_wokrer['representative_id']            = $this->input->post('representative');
               $data_service_wokrer['arrival_airport_id']           = $this->input->post('arrival_airport');
               $data_service_wokrer['departure_airport_id']         = $this->input->post('departure_airport');
               $data_service_wokrer['visa_issued_city_id']          = $this->input->post('visa_issued_city');
               $data_service_wokrer['contract_number']              = $contract_number;
               $data_service_wokrer['worker_nationality_id']        = $this->input->post('worker_nationality');
               $data_service_wokrer['worker_job']                   = $this->input->post('worker_job');
               $data_service_wokrer['agent_id']                     = $this->input->post('agent');


               $this->Service_model->save_worker_service($data_service_wokrer);


               $this->session->set_flashdata('success', 'New Service Added Successfully');
               redirect('services_entry');

           }

       }

        $this->adminTemplate('add', $this->data);
    }







    public function update($contract_id)
    {
        $this->lang->load('services_entry');
        $this->data['datepicker'] = true;


        $contract           = $this->db->get_where('contract', ['contract_number' => $contract_id])->row();
        $service_finance    = $this->db->get_where('services_finance', ['contract_number' => $contract_id])->row();
        $credit_card        = $this->db->get_where('credit_card', ['id' => $service_finance->credit_card_id])->row();
        $order_type         = $this->db->get_where('services_order', ['contract_number' => $contract_id])->row();
        $services_contract  = $this->db->get_where('services_contract', ['contract_number' => $contract_id])->row();
        $services_customer  = $this->db->get_where('services_customer', ['contract_number' => $contract_id])->row();
        $services_worker    = $this->db->get_where('services_worker', ['contract_number' => $contract_id])->row();

        if (count($contract) && count($service_finance) && count($credit_card) && count($order_type))
        {
            $contract_number = $contract->contract_number;
            $this->data['contract']                 = $contract;
            $this->data['service_finance']          = $service_finance;
            $this->data['credit_cards']             = $this->get_credit_cards();
            $this->data['credit_card_id']           = $credit_card->id;
            $this->data['order_types']              = $this->get_order_types();
            $this->data['order_type_id']            = $this->db->get_where('order_types', ['id' => $order_type->order_type_id])->row()->id;
            $this->data['order_number']             = $order_type->order_number;
            $this->data['notes1']                   = $services_contract->notes_1;
            $this->data['notes2']                   = $services_contract->notes_2;
            $this->data['services_customer']        = $services_customer;
            $this->data['customer_nationalities']   = $this->get_customer_nationalities();
            $this->data['customer_nationality']     = $this->db->get_where('customer_nationality', ['id' => $this->data['services_customer']->customer_nationality_id])->row();
            $this->data['services_worker']          = $services_worker;
            $this->data['representatives']          = $this->get_representatives();
            $this->data['representative']           = $this->db->get_where('representatives', ['id' => $services_contract->representative_id])->row();
            $this->data['worker_nationalities']    = $this->get_worker_nationalities();
            $this->data['worker_nationality']      = $this->db->get_where('worker_nationality', ['id' => $this->data['services_worker']->worker_nationality_id])->row();

            $this->data['worker_jobs']              = $this->get_worker_jobs();
            $this->data['worker_job']               = $this->db->get_where('jobs', ['id' => $this->data['services_worker']->job_id])->row();

            $this->data['arrival_airports']         = $this->get_arrival_airports();
            $this->data['arrival_airport']          = $this->db->get_where('arrival_airports', ['id' => $this->data['services_worker']->arrival_airport_id])->row();


            $this->data['departure_airports']       = $this->get_departure_airports();
            $this->data['departure_airport'] = $this->db->get_where('departure_airports', ['id' => $this->data['services_worker']->departure_airport_id]);

            $this->data['visa_issued_cities']       = $this->get_visa_issued_cities();
            $this->data['visa_issued_city']          = $this->db->get_where('visa_issued_city', ['id' => $this->data['services_worker']->visa_issued_city_id])->row();

            $this->data['services_contract'] = $services_contract;
            $this->data['agents']                   = $this->get_agents();

            // Validate posted

            $this->load->library('form_validation');
            $this->form_validation->set_rules($this->Service_model->rules);
            if ($this->form_validation->run($this) == true)
            {
                // save the contract number in contract table

                $contract_date = date('Y-m-d', strtotime($this->input->post('contract_date')));
                $this->db->set(array('contract_date' => $contract_date));
                $this->db->where('contract_number', $contract_number);
                $this->db->update('contract');


                $this->db->set($this->Service_model->array_from_post(array(
                    'contract_period', 'vacation_period', 'marketer', 'notes_1', 'notes_2', 'representative_id',
                )));
                $this->db->where('contract_number', $contract_number);
                $this->db->update('services_contract');

                $data_service_finance['contract_number']        = $contract_number;
                $data_service_finance['recruitment_cost']       = $this->input->post('recruitment_cost');
                $data_service_finance['prepaid_money']          = $this->input->post('prepaid_money');
                $data_service_finance['credit_card_id']         = $this->input->post('credit_card_id');
                $data_service_finance['remains_money']          = ($data_service_finance['recruitment_cost'] - $data_service_finance['prepaid_money']);

                $this->Service_model->save_service_finance($data_service_finance, $contract_number);

                $data_service_order['order_type_id']            = $this->input->post('order_type', true);
                $data_service_order['contract_number']          = $contract_number;
                $data_service_order['order_number']             = $this->input->post('order_number', true);

                $this->Service_model->save_service_order($data_service_order, $contract_number);

                $data_service_customer['customer_name_in_english']      = $this->input->post('customer_name_in_english', true);
                $data_service_customer['customer_name_in_arabic']        = $this->input->post('customer_name_in_arabic', true);
                $data_service_customer['customer_id']                    = $this->input->post('customer_id', true);
                $data_service_customer['customer_nationality_id']           = $this->input->post('customer_nationality', true);
                $data_service_customer['visa_number']                    = $this->input->post('visa_number', true);
                $data_service_customer['visa_date']                      = $this->input->post('visa_date', true);
                $data_service_customer['customer_mobile']                = $this->input->post('customer_mobile', true);
                $data_service_customer['contract_number']                = $contract_number;


                $this->Service_model->save_customer_service($data_service_customer, $contract_number);




                $data_service_wokrer['worker_name_in_english']       = $this->input->post('worker_name_in_english');
                $data_service_wokrer['worker_name_in_arabic']        = $this->input->post('worker_name_in_arabic');
                $data_service_wokrer['worker_salary']                = $this->input->post('worker_salary');
                $data_service_wokrer['qualification']                = $this->input->post('qualification');
                $data_service_wokrer['passport_number']              = $this->input->post('passport_number');
                $data_service_wokrer['arrival_airport_id']           = $this->input->post('arrival_airport');
                $data_service_wokrer['departure_airport_id']           = $this->input->post('departure_airport');
                $data_service_wokrer['visa_issued_city_id']          = $this->input->post('visa_issued_city');
                $data_service_wokrer['contract_number']              = $contract_number;
                $data_service_wokrer['worker_nationality_id']        = $this->input->post('worker_nationality');
                $data_service_wokrer['worker_job']                   = $this->input->post('worker_job');
                $data_service_wokrer['agent_id']                     = (int) $this->input->post('agent');


                $this->Service_model->save_worker_service($data_service_wokrer, $contract_number);


                $this->session->set_flashdata('success', 'Service Updated Successfully');
                redirect(site_url('services_entry?contract_date=' . date('d-m-Y', strtotime($this->data['contract']->contract_date))));
            }

            $this->adminTemplate('update', $this->data);
        }
        else
        {
            echo 'This contract not found';
        }
    }







    public function print_contract($contract_number, $header = false, $show_date = true)
    {
        if ($header)
        {
            $this->data['contract_header'] = true;
        }

        $worker_info = $this->Service_model->get_worker_info($contract_number);
        $customer_info = $this->Service_model->get_customer_info($contract_number);
        $contract_info = $this->Service_model->get_contract_info($contract_number);
        $finance_info = $this->Service_model->get_finance_info($contract_number);
        $service_order_info = $this->Service_model->get_service_order_info($contract_number);


        $this->data['worker_info']          = $worker_info;
        $this->data['customer_info']        = $customer_info;
        $this->data['contract_info']        = $contract_info;
        $this->data['finance_info']         = $finance_info;
        $this->data['service_order_info']   = $service_order_info;

        $this->data['show_date'] = $show_date;

        $this->load->view('contract', $this->data);

    }



    public function print_contract_2($contract_number, $header = false)
    {
        if ($header)
        {
            $this->data['contract_header'] = true;
        }

        $worker_info = $this->Service_model->get_worker_info($contract_number);
        $customer_info = $this->Service_model->get_customer_info($contract_number);
        $contract_info = $this->Service_model->get_contract_info($contract_number);
        $finance_info = $this->Service_model->get_finance_info($contract_number);
        $service_order_info = $this->Service_model->get_service_order_info($contract_number);

        $this->data['worker_info']          = $worker_info;
        $this->data['customer_info']        = $customer_info;
        $this->data['contract_info']        = $contract_info;
        $this->data['finance_info']         = $finance_info;
        $this->data['service_order_info']   = $service_order_info;

        if ($worker_info->worker_nationality_id == 11)
        {
            $this->load->library('Arabic', []);
            $this->load->module('customers');
            $this->data['customer_data'] = $this->customers->Customer_model->get_by(array('visa_number' => $customer_info->visa_number), true);
            $this->load->module('agent_worker');
            $this->data['worker_data'] = $this->agent_worker->Agent_worker_model->get_by(array('passport_number' => $worker_info->passport_number), true);
            $this->load->module('agents');
            $this->data['agent'] = $this->agents->Agent_model->get($this->data['worker_data']->agent_id, true);
            $this->load->view('phcontract', $this->data);
            return;
        }

//        var_dump($this->data['worker_info']);
//        var_dump($this->data['customer_info']);
//        exit;

        $this->load->view('contract2', $this->data);
    }



    public function get_arrival_airports()
    {
        $this->load->module('arrival_airports');
        $arrival_airports_t = $this->arrival_airports->Arrival_airport_model->get();
        $arrival_airports = [];
        $lang = ($_SESSION['language'] == 'arabic') ? 'name_in_arabic' : 'name_in_english';
        $arrival_airports[''] = '-- '.lang('select').' --';
        if ($arrival_airports_t && count($arrival_airports_t)) {
            foreach ($arrival_airports_t as $arrival_airport) {
                $arrival_airports[$arrival_airport->id] =
                    $arrival_airport->$lang;
            }
        }
        return $arrival_airports;
    }

    public function get_departure_airports()
    {
        $this->load->module('departure_airports');
        $departure_airports_t = $this->departure_airports->Departure_airport_model->get();
        $departure_airports = [];
        $lang = ($_SESSION['language'] == 'arabic') ? 'name_in_arabic' : 'name_in_english';
        $departure_airports[''] = '-- '.lang('select').' --';
        if ($departure_airports_t && count($departure_airports_t)) {
            foreach ($departure_airports_t as $departure_airport) {
                $departure_airports[$departure_airport->id] =
                    $departure_airport->$lang;
            }
        }
        return $departure_airports;
    }



    public function get_worker_nationalities()
    {
        $this->load->module('worker_nationality');
        $worker_nationalities_t = $this->worker_nationality->Worker_nationality_model->get();
        $worker_nationalities = [];
        $lang = ($_SESSION['language'] == 'arabic') ? 'nationality_in_arabic' : 'nationality_in_english';
        $worker_nationalities[''] = '-- '.lang('select').' --';
        if ($worker_nationalities_t && count($worker_nationalities_t)) {
            foreach ($worker_nationalities_t as $worker_nationality) {
                $worker_nationalities[$worker_nationality->id] = $worker_nationality->$lang;
            }

            return $worker_nationalities;
        }
    }



    public function get_representatives()
    {
        $this->load->module('representatives');
        $representatives_t = $this->representatives->Representative_model->get();
        $representatives = [];
        $representatives[''] = '-- '.lang('select').' --';
        if ($representatives && count($representatives)) {
            foreach ($representatives_t as $representative) {
                $representatives[$representative->id] = $representative->name;
            }

            return $representatives;
        }
    }


    public function get_customer_nationalities()
    {
        $this->load->module('customer_nationality');
        $c_nationalities = $this->customer_nationality->Customer_nationality_model->get();
        $customer_nationalities = [];
        $lang = ($_SESSION['language'] == 'arabic') ? 'nationality_in_arabic' : 'nationality_in_english';
        $customer_nationalities[''] = '-- '.lang('select').' --';
        if ($customer_nationalities && count($customer_nationalities)) {
            foreach ($c_nationalities as $c_nationality) {
                $customer_nationalities[$c_nationality->id] = $c_nationality->$lang;
            }
            return $customer_nationalities;
        }
    }


    protected function get_order_types()
    {
        $this->load->module('order_types');
        $orders = $this->order_types->Order_type_model->get();
        $order_types = [];
        $lang = ($_SESSION['language'] == 'arabic') ? 'name_in_arabic' : 'name_in_english';
        $order_types[''] = '-- '.lang('select').' --';
        if ($orders && count($orders)) {
            foreach ($orders as $order) {
                $order_types[$order->id] = $order->$lang;
            }
            return $order_types;
        }
    }



    protected function get_credit_cards()
    {
        $this->load->module('credit_card');
        $cards = $this->credit_card->Credit_card_model->get();
        $credit_cards = [];
        $credit_cards[''] = '-- '.lang('select').' --';
        if ($cards && count($cards)) {
            foreach ($cards as $card) {
                $credit_cards[$card->id] = $card->credit_card;
            }
            return $credit_cards;
        }
    }


    public function get_worker_jobs()
    {
        $this->load->module('jobs');
        $jobs_t = $this->jobs->Job_model->get();
        $jobs = [];
        $jobs[''] = '-- '.lang('select').' --';
        if ($jobs_t && count($jobs_t)) {
            foreach ($jobs_t as $job) {
                $jobs[$job->id] = $job->name_in_arabic;
            }
            return $jobs;
        }
    }


    public function get_agents()
    {
        $agents_t = $this->Service_model->get_agents();
        $agents = [];
        $agents[''] = '-- ' . lang('select') . ' --';
        if ($agents_t && count($agents_t))
        {
            foreach ($agents_t as $agent) {
                $agents[$agent->id] = $agent->username;
            }
            return $agents;
        }
    }


    public function get_visa_issued_cities()
    {
        $this->load->module('visa_issued_city');
        $visa_issued_cities_t = $this->visa_issued_city->Visa_issued_model->get();
        $visa_issued_cities = [];
        $visa_issued_cities[''] = '-- '.lang('select').' --';
        if ($visa_issued_cities_t && count($visa_issued_cities_t)) {
            foreach ($visa_issued_cities_t as $visa_issued_city) {
                $visa_issued_cities[$visa_issued_city->id] =
                    $visa_issued_city->city;
            }
            return $visa_issued_cities;
        }
    }





    public function advanced_search()
    {
        $this->lang->load('services_entry');

        $this->data['js_files'] = [
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js',
        ];

        $searched_by = array(
            'contract_number'           => lang('contract_number'),
            'order_type'                => lang('order_type'),
            'order_number'              => lang('order_number'),
            'customer_name_in_arabic'   => lang('customer_name_in_arabic'),
            'customer_name_in_english'  => lang('customer_name_in_english'),
            'customer_id'               => lang('customer_id'),
            'visa_number'               => lang('visa_number'),
            'visa_date'                 => lang('visa_date'),
            'worker_name_in_arabic'     => lang('worker_name_in_arabic'),
            'worker_name_in_english'    => lang('worker_name_in_english'),
            'month'                     => lang('month'),
        );

        $tables = array(
            'contract_number'           => 'contract',
            'order_number'              => 'services_order',
            'order_type'                => 'order_types',
            'customer_name_in_arabic'   => 'services_customer',
            'customer_name_in_english'  => 'services_customer',
            'customer_id'               => 'services_customer',
            'visa_number'               => 'services_customer',
            'visa_date'                 => 'services_customer',
            'worker_name_in_arabic'     => 'services_worker',
            'worker_name_in_english'    => 'services_worker',
        );

        $this->data['searched_by'] = $searched_by;
        $this->data['view_services'] = false;

//        $this->load->library('form_validation');
//        $this->form_validation->set_rules($searched_by, lang($searched_by), 'trim|required');
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searched_by']) && isset($_GET['searched_value']))
        {
            $searched_key = trim(filter_input(INPUT_GET, 'searched_by'));
            $searched_value = trim(filter_input(INPUT_GET, 'searched_value'));

            if ($searched_key != '0')
            {
                $searched_services = [];


                switch ($searched_key) {
                    case 'order_type':
                        $searched_key = 'name_in_arabic';
                        $tables[$searched_key] = 'order_types';
                        $searched_key = $tables[$searched_key] . '.'. $searched_key;
                        $searched_services = $this->Service_model->get_searched_services($searched_key, $searched_value);
                    break;
                    case 'month':
                        $searched = explode('-', $searched_value);
                        $month = isset($searched[0])? $searched[0] : 0;
                        $year = isset($searched[1])? $searched[1] : 0;
                        $searched_services = $this->Service_model->get_searched_services_by_month($month, $year);
                    break;
                    case 'customer_name_in_arabic':
                    case 'worker_name_in_english':
                        $searched_key = $tables[$searched_key] . '.'. $searched_key;
                        $searched_value = '%' . $searched_value . '%';
                        $searched_services = $this->Service_model->get_searched_services($searched_key, $searched_value, false, true);
                    break;
                    default:
                        $searched_key = $tables[$searched_key] . '.'. $searched_key;
                        $searched_services = $this->Service_model->get_searched_services($searched_key, $searched_value);
                }

                $this->data['view_services'] = true;
                $this->data['services'] = $searched_services;

//                if ($searched_key == 'order_type')
//                {
//                    $searched_key = 'name_in_arabic';
//                    $tables[$searched_key] = 'order_types';
//                }

//                if ($searched_key == 'month')
//                {
//                    $searched = explode('-', $searched_value);
//                    $month = isset($searched[0])? $searched[0] : 0;
//                    $year = isset($searched[1])? $searched[1] : 0;
//                    $searched_services = $this->Service_model->get_searched_services_by_month($month, $year);
//                    $this->data['view_services'] = true;
//                    $this->data['services'] = $searched_services;
//                }

//                else
//                {
//                    if ($searched_key == 'customer_name_in_arabic' || $searched_key = 'worker_name_in_english') {
//                        $searched_key = $tables[$searched_key] . '.'. $searched_key;
//                        $searched_value = '%' . $searched_value . '%';
//                        $searched_services = $this->Service_model->get_searched_services($searched_key, $searched_value, false, true);
//                    } else {
//                        $searched_key = $tables[$searched_key] . '.'. $searched_key;
//
//
//                        $searched_services = $this->Service_model->get_searched_services($searched_key, $searched_value);
//                    }
//
//
//                    $this->data['view_services'] = true;
//                    $this->data['services'] = $searched_services;
//                }
            }
        }

        $this->adminTemplate('advanced_search', $this->data);
    }



//
//    public function handle_advanced_search()
//    {
//        $this->data['view_services'] = false;
//        $searched_key = filter_input(INPUT_POST, 'searched_by');
//        $searched_value = filter_input(INPUT_POST, 'searched_value');
//
//        $tables = array(
//            'contract_number'           => 'contract',
//            'order_number'              => 'services_order',
//            'order_type'                => 'order_types',
//            'customer_name_in_arabic'   => 'services_customer',
//            'customer_name_in_english'  => 'services_customer',
//            'customer_id'               => 'services_customer',
//            'visa_number'               => 'services_customer',
//            'visa_date'                 => 'services_customer',
//            'worker_name_in_arabic'     => 'services_worker',
//        );
//
//        if ($searched_key == 'order_type')
//        {
//            $searched_key = 'name_in_arabic';
//            $tables[$searched_key] = 'order_types';
//        }
//        $searched_key = $tables[$searched_key] . '.'. $searched_key;
//
//
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules($searched_key, lang($searched_key), 'trim|required');
//        if ($this->form_validation->set_rules($this) == true)
//        {
//            $searched_services = $this->Service_model->get_searched_services($searched_key, $searched_value);
//            $this->data['view_services'] = true;
//            $this->data['services'] = $searched_services;
//            $this->adminTemplate('searched_services', $this->data);
//        }
//
//    }


    public function advanced_search_ajax()
    {
        $this->lang->load('services_entry');

        $searched_by = trim(filter_input(INPUT_POST, 'searched_by', FILTER_SANITIZE_STRING));
        echo lang($searched_by);exit;
        if ('0' === $searched_by)
        {
           echo '';
           return;
        }

        if ('order_type' == $searched_by)
        {
            $output     = '<div class="col-md-4">';
            $output     .= '<label>ادخل '.lang($searched_by).'</label>';
            $output     .= form_dropdown('searched_value', $this->get_order_types(), '', 'class="form-control"');
            $output     .= '</div>';
            $output     .= $this->get_search_btn();
            echo $output;
            exit;
        }


        $output = '<div class="col-md-4">';
        $output .= '<label>'. lang('enter') . ' ' .lang($searched_by).'</label>';
        $output .= '<input class="form-control" id="searched_query">';
        $output .= '</div>';
        $output .= $this->get_search_btn();

        echo $output;
    }



    public function do_advanced_search()
    {
        $tables = array(
            'contract_number'           => 'contract',
            'order_number'              => 'services_order',
            'customer_name_in_arabic'   => 'services_customer',
            'customer_name_in_english'  => 'services_customer',
            'customer_id'               => 'services_customer',
            'visa_number'               => 'services_customer',
            'visa_date'                 => 'services_customer',
            'worker_name_in_arabic'     => 'services_worker',
        );

        $value      = $_POST['query'];
        $searched   = $_POST['searched'];
        $this->output->enable_profiler(TRUE);

         $query = $this->db->query("SELECT {$searched} FROM {$tables[$searched]} WHERE {$searched} LIKE '%{$value}%'");
        if ($query->num_rows())
        {
           // var_dump($query->result_array());
            echo json_encode($query->result_array());
        }
    }






    public function get_search_btn()
    {
        $output      = '<div class="col-md-3">';
        $output     .= '<label>&nbsp;</label>';
        $output     .= '<button type="submit" class="btn btn-primary btn-block">'.lang('search').'</button>';
        $output     .= '</div>';
        return $output;
    }



    public function processing_list()
    {
        $this->lang->load('services_entry');
        $this->data['datatables'] = true;
        $this->load->module('representatives');
        $this->data['representatives'] = $this->representatives->Representative_model->get();
        $this->data['agents'] = $this->Service_model->get_agents();

        $this->data['js_files'][] = 'assets/admin_panel/js/processing_contracts.js';
        $this->adminTemplate('processing_list', $this->data);
    }

    public function load_processing_contracts()
    {
        echo $this->Service_model->get_contracts_for_processing();
    }


    public function processing()
    {
        $this->lang->load('services_entry');
        $this->data['datepicker'] = true;

        $this->data['css_files'] = ['assets/admin_panel/css/lightbox.css'];
        $this->data['js_files'][] = 'assets/admin_panel/js/lightbox.js';
        $this->data['css_files'][] = 'assets/admin_panel/css/bootstrap-editable.css';
        $this->data['js_files'][] = 'assets/admin_panel/js/bootstrap-editable.js';


        $this->data['view_service'] = false;

//        $this->load->library('form_validation');
//        $this->form_validation->set_rules($searched_by, lang($searched_by), 'trim|required');
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['searched_value']))
        {
            $searched_value = trim(filter_input(INPUT_GET, 'searched_value'));
            $searched_services = $this->Service_model->get_searched_services('contract.contract_number', $searched_value);
            $this->load->module('agent_worker');
            if (isset($searched_services[0]->passport_number)) {
                $this->data['worker'] = $this->agent_worker->Agent_worker_model->get_by(['passport_number' => $searched_services[0]->passport_number], true);
            } else {
                $this->data['worker'] = false;
            }
            $this->data['view_service'] = true;
            $this->data['service'] = $searched_services[0];
        }
//var_dump($this->data['service']);exit;
        $this->data['js_files'][] = 'assets/admin_panel/js/processing.js';
        $this->adminTemplate('processing', $this->data);
    }


    public function processing_upload()
    {
        $contract_number = $_POST['contract_number'];
        $upload_path = FCPATH . 'assets/contracts/' . $contract_number;
        if (!is_dir($upload_path))
        {
            mkdir($upload_path, 0777, true);
        }


        if (isset($_FILES['visa_image']) && $_FILES['visa_image']['name'] != '')
        {
            $upload_image = $this->do_upload('visa_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('visa_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }



        if (isset($_FILES['id_image']) && $_FILES['id_image']['name'] != '')
        {
            $upload_image = $this->do_upload('id_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('id_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }


        if (isset($_FILES['contract_image']) && $_FILES['contract_image']['name'] != '')
        {
            $upload_image = $this->do_upload('contract_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('contract_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }

        if (isset($_FILES['delegation_image']) && $_FILES['delegation_image']['name'] != '')
        {
            $upload_image = $this->do_upload('delegation_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('delegation_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }


        if (isset($_FILES['ticket_image']) && $_FILES['ticket_image']['name'] != '')
        {
            $upload_image = $this->do_upload('ticket_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('ticket_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }

        if (isset($_FILES['stamping_image']) && $_FILES['stamping_image']['name'] != '')
        {
            $upload_image = $this->do_upload('stamping_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('stamping_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }

        if (isset($_FILES['passport_image']) && $_FILES['passport_image']['name'] != '')
        {
            $upload_image = $this->do_upload('passport_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('passport_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }


        redirect(site_url('services_entry/processing?searched_value=' . $contract_number));

    }


    public function customer_worker_contract()
    {
        $this->load->module('agent_worker');
        $this->load->module('customers');
        $this->data['workers'] = $this->agent_worker->Agent_worker_model->get_customer_workers_data();
//        var_dump($this->data['workers']);exit;

        $this->adminTemplate('auto_contract/index', $this->data);
    }

    public function make_auto_contract($worker_id)
    {
        if (isset($worker_id))
        {
            $this->data['datepicker'] = true;
            $this->lang->load('services_entry');
            $this->load->module('agent_worker');
            $worker_customer_data = $this->agent_worker->Agent_worker_model->get_customer_worker_data($worker_id);
            $this->load->module('customers');
            $customer_nationality = $this->customers->Customer_model->get_customer_nationality_id($worker_customer_data->staff_id);
            $this->data['customer_nationality'] = $customer_nationality;
            if ($worker_customer_data && count($worker_customer_data))
            {
                $this->data['worker_customer'] = $worker_customer_data;
                $this->data['contract_number'] = $this->Service_model->get_last_contract_number() ?
                    ($this->Service_model->get_last_contract_number() + 1) : 1;
                $this->data['credit_cards']             = $this->get_credit_cards();
                $this->data['order_types']              = $this->get_order_types();
                $this->data['representatives']          = $this->get_representatives();
                $this->data['customer_nationalities']   = $this->get_customer_nationalities();
                $this->data['agents'] = $this->get_agents();
                $this->data['arrival_airports']         = $this->get_arrival_airports();
                $this->data['departure_airports']       = $this->get_departure_airports();
                $this->data['worker_nationalities']     = $this->get_worker_nationalities();
                $this->data['visa_issued_cities']       = $this->get_visa_issued_cities();
                $this->data['worker_jobs']              = $this->get_worker_jobs();


                $this->load->library('form_validation');
                $this->form_validation->set_rules($this->Service_model->rules);


                if ($this->form_validation->run($this) == true)
                {
                    // save the contract number in contract table and contract date
                    $contract_number = $this->input->post('contract_number', true);
                    $contract_date = date('Y-m-d', strtotime($this->input->post('contract_date')));

                    $save_contract_number = $this->Service_model->save_contract_number(
                        $contract_number, $contract_date
                    );

                    if ($save_contract_number)
                    {
                        $this->Service_model->save($this->Service_model->array_from_post(
                            [
                                'contract_number', 'contract_period', 'vacation_period', 'marketer', 'notes_1', 'notes_2', 'representative_id',
                            ]
                        ));

                        $data_service_finance['contract_number']        = $contract_number;
                        $data_service_finance['recruitment_cost']       = $this->input->post('recruitment_cost');
                        $data_service_finance['prepaid_money']          = $this->input->post('prepaid_money');
                        $data_service_finance['credit_card_id']         = $this->input->post('credit_card_id');
                        $data_service_finance['remains_money']          = ($data_service_finance['recruitment_cost'] - $data_service_finance['prepaid_money']);

                        $this->Service_model->save_service_finance($data_service_finance);

                        $data_service_order['order_type_id']            = $this->input->post('order_type', true);
                        $data_service_order['contract_number']          = $contract_number;
                        $data_service_order['order_number']             = $this->input->post('order_number', true);

                        $this->Service_model->save_service_order($data_service_order);

                        $data_service_customer['customer_name_in_english']      = $this->input->post('customer_name_in_english', true);
                        $data_service_customer['customer_name_in_arabic']        = $this->input->post('customer_name_in_arabic', true);
                        $data_service_customer['customer_id']                    = $this->input->post('customer_id', true);
                        $data_service_customer['customer_nationality_id']           = $this->input->post('customer_nationality', true);
                        $data_service_customer['visa_number']                    = $this->input->post('visa_number', true);
                        $data_service_customer['visa_date']                      = $this->input->post('visa_date', true);
                        $data_service_customer['customer_mobile']                = $this->input->post('customer_mobile', true);
                        $data_service_customer['contract_number']                = $contract_number;


                        $this->Service_model->save_customer_service($data_service_customer);


                        $data_service_wokrer['worker_name_in_english']       = $this->input->post('worker_name_in_english');
                        $data_service_wokrer['worker_name_in_arabic']        = $this->input->post('worker_name_in_arabic');
                        $data_service_wokrer['worker_salary']                = $this->input->post('worker_salary');
                        $data_service_wokrer['qualification']                = $this->input->post('qualification');
                        $data_service_wokrer['passport_number']              = $this->input->post('passport_number');
                        $data_service_wokrer['representative_id']            = $this->input->post('representative');
                        $data_service_wokrer['arrival_airport_id']           = $this->input->post('arrival_airport');
                        $data_service_wokrer['departure_airport_id']            = $this->input->post('departure_airport');
                        $data_service_wokrer['visa_issued_city_id']          = $this->input->post('visa_issued_city');
                        $data_service_wokrer['contract_number']              = $contract_number;
                        $data_service_wokrer['worker_nationality_id']        = $this->input->post('worker_nationality');
                        $data_service_wokrer['worker_job']                   = $this->input->post('worker_job');
                        $data_service_wokrer['agent_id']                     = $this->input->post('agent');


                        $this->Service_model->save_worker_service($data_service_wokrer);

                        $this->customers->Customer_model->save(array('make_contract' => '1'), $worker_customer_data->customerID);


                        $this->session->set_flashdata('success', 'New Service Added Successfully');
                        redirect('services_entry');

                    }

                }


                $this->adminTemplate('auto_contract/auto_contract', $this->data);
            }
        }
    }



    public function update_processing_date()
    {
        if ($_POST['value'] == '') {$_POST['value'] = NULL;}
        $query = "UPDATE services_contract SET {$_POST['name']} = ? WHERE contract_number = ?";
        $this->db->query($query, array($_POST['value'], $_POST['pk']));
    }


    public function do_upload($file_input_name, $path)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|pdf|jpeg';
        $config['max_size']             = 4096;
        $config['max_width']            = 6024;
        $config['max_height']           = 5024;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (! $this->upload->do_upload($file_input_name))
        {
            $error = ['error' => $this->upload->display_errors()];
            return ['error' => $error];
        }
        else
        {
            // upload was done successfully
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            if ($upload_data['image_width'] > 1024 && $upload_data['image_height'] > 1024)
            {
                $this->resize_image(700, 500, $file_name);
//                $this->delete_image($file_name);
            }
            return ['file_name' => $file_name];
        }

        return false;
    }

    protected function resize_image($width = 500, $height = 500, $filename)
    {
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= FCPATH . "assets/img/workers" . $filename;
        $config['new_image'] 		= FCPATH . "assets/img/workers" . $filename;
        $config['maintain_ratio'] 	= TRUE;
        $config['width']         	= $width;
        $config['height']       	= $height;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }


    public function cancel_delegation($contract_number = false)
    {
        $this->data['contracts'] = $this->Service_model->get_cancel_delegation_contracts();
        $this->adminTemplate('cancel_contract_delegation', $this->data);
    }


    public function print_cancel_delegation($contract_number)
    {
        $worker_info = $this->Service_model->get_worker_info($contract_number);
        $customer_info = $this->Service_model->get_customer_info($contract_number);
        $contract_info = $this->Service_model->get_contract_info($contract_number);
        $finance_info = $this->Service_model->get_finance_info($contract_number);
        $service_order_info = $this->Service_model->get_service_order_info($contract_number);

        $this->data['customer_name'] = $customer_info->customer_name_in_arabic;
        $this->data['visa_number'] = $customer_info->visa_number;
        $this->data['customer_mobile'] = $customer_info->customer_mobile;

//        echo $this->data['visa_number'];exit;

        $this->load->view('cancel_delegation_print', $this->data);
    }

    public function make_confirm_contract($contract_number)
    {
        $exist = $this->db->get_where("services_order", array('contract_number' => $contract_number, 'make_confirm' => '1'))->row();
        if ($exist && count($exist)) {
            $this->session->set_flashdata("error", 'تم عمل عقد تصديق لهذا العقد من قبل');
            redirect("services_entry/cancel_delegation");
        }




        // Contract Table
        $contract = $this->db->get_where('contract', array('contract_number' => $contract_number))->row();
        $contract_number_plus = $this->Service_model->get_max_contract_number() + 1;
        $this->Service_model->save_contract_number($contract_number_plus, $contract->contract_date);

        // services_contract Table
        $services_contract = $this->db->get_where('services_contract', array('contract_number' => $contract_number))->row();
        $services_contract_data = [];
        $services_contract_data['contract_number'] = $contract_number_plus;
        $services_contract_data['contract_period'] = $services_contract->contract_period;
        $services_contract_data['vacation_period'] = $services_contract->vacation_period;
        $services_contract_data['marketer'] = $services_contract->marketer;
        $services_contract_data['notes_1'] = $services_contract->notes_1;
        $services_contract_data['notes_2'] = $services_contract->notes_2;
        $services_contract_data['representative_id'] = $services_contract->representative_id;
        $this->Service_model->save($services_contract_data);

        // services_customer table
        $services_customer = $this->db->get_where('services_customer', array('contract_number' => $contract_number))->row_array();
        unset($services_customer['id']);
        $services_customer['contract_number'] = $contract_number_plus;
        $this->Service_model->save_customer_service($services_customer);

        // services_finance table
        $services_finance = $this->db->get_where('services_finance', array('contract_number' => $contract_number))->row_array();
        unset($services_finance['id']);
        $services_finance['contract_number'] = $contract_number_plus;
        $this->Service_model->save_service_finance($services_finance);

        // services_order table
        $services_order = $this->db->get_where('services_order', array('contract_number' => $contract_number))->row_array();
        unset($services_order['id']);
        $services_order['order_type_id'] = 4;
        $services_order['contract_number'] = $contract_number_plus;
        $this->Service_model->save_service_order($services_order);

        // services_worker table
        $services_worker = $this->db->get_where('services_worker', array('contract_number' => $contract_number))->row_array();
        unset($services_worker['id']);
        $services_worker['worker_job'] = $services_worker['job_id'];
//        var_dump($services_worker);exit;
        $services_worker['contract_number'] = $contract_number_plus;
        $this->Service_model->save_worker_service($services_worker);


        $this->db->set(array('make_confirm' => '1'));
        $this->db->where('contract_number', $contract_number);
        $this->db->update('services_order');



        redirect('services_entry');

    }

    public function cancel_contract($contract_number = false)
    {
        if ($contract_number)
        {
            $this->data['contract_number'] = $contract_number;

            $this->load->library('form_validation');
            $rules = [
                [
                    'field' => 'reason',
                    'label' => 'السبب',
                    'rules' => 'trim|required',
                ]
            ];
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run($this) == true)
            {
                $this->save_cancel_contract($contract_number, $this->input->post('reason', true));
                $this->session->set_flashdata('success', 'تم الغاء العقد بنجاح');
                redirect(site_url('services_entry/cancel_contract/' . $contract_number));
            }
            $this->adminTemplate('cancel_contract_form', $this->data);

        }
        else
        {
            $cancel_contracts = $this->Service_model->get_canceled_contracts();
            $this->data['contracts'] = $cancel_contracts;
            $this->adminTemplate('cancel_contract', $this->data);
        }

        }



    public function save_cancel_contract($contract_number, $reason)
    {
        $this->db->where('contract_number', $contract_number);
        $query = $this->db->get('cancelled_contracts');
        $row = $query->row();
        if ($row && count($row)) {
            return true;
        } else {
            $this->db->set(['contract_number' => $contract_number, 'reason' => $reason]);
            $this->db->insert('cancelled_contracts');
        }
    }



}