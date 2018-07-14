<?php

class Tickets extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Ticket_model');
    }

    public function index()
    {
        $this->data['tickets'] = $this->Ticket_model->get_tickets();
        $this->lang->load('services_entry');
//        var_dump($this->data['tickets']);exit;
//        $this->data['datatables'] = true;
//        $this->data['datepicker'] = true;
//        $this->data['js_files'][] = 'assets/admin_panel/js/tickets_contracts.js';
        $this->adminTemplate('index', $this->data);
    }

    public function load_tickets_contracts()
    {
        $this->Ticket_model->get_data();
    }


    public function save_ticket()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $contract_number = $this->input->post('contract_number');
            $departure_date = date('Y-m-d H:i:s', strtotime( $this->input->post('departure_date')));
            $arrived_date = date('Y-m-d H:i:s', strtotime($this->input->post('arrived_date')));

            var_dump($contract_number, $departure_date, $arrived_date);
            $this->db->set(array('departure_date' => $departure_date, 'arrived_date' => $arrived_date));
            $this->db->where('contract_number', $contract_number);
            $q = $this->db->update('services_contract');
        }
    }

}