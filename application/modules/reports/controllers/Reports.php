<?php

class Reports extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Report_model');
        $this->lang->load('services_entry');
    }

    public function not_stamp()
    {
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/not_stamp.js'];
        $this->data['report_title'] = 'Not Stamp Report ';
//        $this->load->module('representatives');
        $this->load->module('services_entry');
//        $representatives = $this->representatives->Representative_model->get();
//        $this->data['representatives'] = $representatives;
        $this->load->module('worker_nationality');
        $countries = $this->worker_nationality->Worker_nationality_model->get_ordered();
        $this->data['countries'] = $countries;
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();
        $this->adminTemplate('not_stamp_report', $this->data);
    }

    public function load_not_stamp()
    {
        $this->Report_model->get_not_stamp();
    }


    public function not_arrived()
    {
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/not_arrived.js'];
        $this->data['report_title'] = 'Not Arrived Report ';
//        $this->load->module('representatives');
        $this->load->module('services_entry');
//        $representatives = $this->representatives->Representative_model->get();
//        $this->data['representatives'] = $representatives;
        $this->load->module('worker_nationality');
        $countries = $this->worker_nationality->Worker_nationality_model->get_ordered();
        $this->data['countries'] = $countries;
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();
        $this->adminTemplate('not_arrived_report', $this->data);
    }

    public function load_not_arrived()
    {
        $this->Report_model->get_not_arrived();
    }


    public function arrived ()
    {
        $this->data['report_title'] = 'Arrived Report';
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/arrived.js'];
//        $this->load->module('representatives');
        $this->load->module('services_entry');
//        $representatives = $this->representatives->Representative_model->get();
//        $this->data['representatives'] = $representatives;
        $this->load->module('worker_nationality');
        $countries = $this->worker_nationality->Worker_nationality_model->get_ordered();
        $this->data['countries'] = $countries;
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();
        $this->adminTemplate('arrived_report', $this->data);
    }


    public function load_arrived()
    {
        $this->Report_model->get_arrived();
    }


    public function not_paid()
    {
        $this->data['datatables'] = true;
        $this->data['js_files'][] = 'assets/admin_panel/js/finance.js';
//        $this->load->module('representatives');
//        $representatives = $this->representatives->Representative_model->get();
//        $this->data['representatives'] = $representatives;
        $this->load->module('worker_nationality');
        $countries = $this->worker_nationality->Worker_nationality_model->get_ordered();
        $this->data['countries'] = $countries;
        $this->adminTemplate('not_paid', $this->data);
    }

    public function load_not_paid()
    {
        $this->load->module('finance');
        $this->finance->Finance_model->Finance_model->get_not_paid_customers();
    }


    public function operation_reports()
    {
        $this->data['datepicker_range'] = true;
        $this->load->module('services_entry');
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();
        $this->load->module('representatives');
        $this->data['representatives'] = $this->representatives->Representative_model->get();
        $this->data['info'] = [];


        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search_for']))
        {
            $search_for = $this->input->get('search_for');
            $agent = $this->input->get('agent');
            $representative = $this->input->get('representative');
            $when = $this->input->get('daterange');

            $this->data['info'] = $this->Report_model->get_searched_operations($search_for, $agent, $representative, $when);
            $this->data['search_for'] = $search_for;
        }


        $this->adminTemplate('operation_reports', $this->data);
    }



    public function financial_reports()
    {
        $this->check_permission();

        $this->data['datepicker_range'] = true;
        $this->load->module('services_entry');
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();
        $this->load->module('representatives');
        $this->data['representatives'] = $this->representatives->Representative_model->get();
        $this->data['info'] = [];

        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['daterange']))
        {
            $agent = $this->input->get('agent');
            $representative = $this->input->get('representative');
            $when = $this->input->get('daterange');
            if ($agent == 1) {$agent = '';}
            if ($representative == 1) {$representative = '';}
            $this->data['info'] = $this->Report_model->get_financial_search($agent, $representative, $when);
        }

        $this->adminTemplate('financial_reports', $this->data);
    }


    public function print_financial_reports()
    {
        $agent = $this->input->get('agent');
        if ($agent == 1 || $agent == 0) {$agent = '';}
        $representative = $this->input->get('representative');
        if ($representative == 1 || $representative == 0) {$representative = '';}
        $when = $this->input->get('daterange');
        $this->data['when'] = $when;
        $this->data['agent'] = $agent;
        $this->data['representative'] = $representative;
        $this->data['info'] = $this->Report_model->get_financial_search($agent, $representative, $when);
        $this->load->view('print_financial_reports', $this->data);
    }


    public function advanced_reports()
    {
        $this->check_permission();

        $this->data['datepicker_range'] = true;
        $this->load->module('representatives');
        $this->data['representatives'] = $this->representatives->Representative_model->get();
        $this->data['info'] = new stdClass();
        if (isset($_GET['daterange']) && $_GET['daterange'] != '')
        {
            $representative = isset($_GET['representative']) ? $_GET['representative'] : '';
            if ($representative == 'all') { $representative = ''; }
            $this->data['info'] = $this->Report_model->get_recruitment_count($_GET['daterange'], $representative);
            $this->data['details'] = $this->Report_model->get_recruitment_details($_GET['daterange'], $representative);

        }

        $this->adminTemplate('advanced_reports', $this->data);
    }



    public function details_advanced_reports()
    {
        $nationality_id = $this->input->get('nationality_id');
        $when = $this->input->get('when');
        $representative = '';
        if (isset($_GET['representative']))
        {
            $representative = $_GET['representative'];
        }
        if ($representative == 'all') {$representative = '';}
        $this->data['info'] = $this->Report_model->get_details_advanced_reports($nationality_id, $when, $representative);
        $this->adminTemplate('details_advanced_reports', $this->data);
    }



    public function chart_reports()
    {
        $this->check_permission();

        if (isset($_GET['chart_type']))
        {
            if ($_GET['chart_type'] == 'num_of_workers')
            {
                $this->data['chart_data'] = $this->Report_model->get_num_of_workers();
                $this->data['chart_title'] = 'عدد العاملين';
            }
            else
            {
                $this->data['chart_data'] = $this->Report_model->get_num_of_contracts();
                $this->data['chart_title'] = 'عدد العقود';
            }
        }
        else
        {
            $this->data['chart_data'] = $this->Report_model->get_num_of_contracts();
            $this->data['chart_title'] = 'عدد العقود';
        }

        $this->load->view('chart_reports', $this->data);
    }


}