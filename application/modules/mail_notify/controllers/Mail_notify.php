<?php

class Mail_notify extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function send_mail($msg)
    {
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mx1.hostinger.co.uk';
        $config['smtp_user'] = 'followup@peace4r.com';
        $config['smtp_pass'] = 'followup2018';
        $config['smtp_port'] = 587;
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype('html');
        $this->email->from($config['smtp_user'], 'Follow Up Peace4r Recruitment');
        $this->email->to('az.peacer@gmail.com');
        $this->email->subject('Send Email Codeigniter');
        $this->email->message($msg);
        $this->email->send();
//        var_dump($this->email->print_debugger(array('headers')));
    }


    public function index()
    {
        // Get agents that their nationality_id in_array(1, 11) and their access_id = 4
        $sql = "SELECT * FROM staff WHERE nationality_id IN (1, 11) AND access_id = 4";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            $view = '';
            foreach ($query->result() as $row)
            {
                if (in_array($row->username, array('agent', 'agent1'))) {continue;}
                $not_stamped_workers = $this->get_not_stamped_workers($row->id);
                $view .= $this->make_mail_view($not_stamped_workers, $row->username);
            }
            $this->send_mail($view);
        }
        // Get agents that their worker not stamped yet
    }


    public function show_email()
    {
        // Get agents that their nationality_id in_array(1, 11) and their access_id = 4
        $sql = "SELECT * FROM staff WHERE nationality_id IN (1, 11) AND access_id = 4";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            $view = '';
            foreach ($query->result() as $row)
            {
                if (in_array($row->username, array('agent', 'agent1'))) {continue;}
                $not_stamped_workers = $this->get_not_stamped_workers($row->id);
//                var_dump($not_stamped_workers, $row->username);exit;
               $view .=  $this->make_mail_view($not_stamped_workers, $row->username);
            }
            echo $view;
        }
        // Get agents that their worker not stamped yet
    }


    public function make_mail_view($data, $agent_name = '')
    {
        if ($data && count($data)) {
            echo '<style>table th {font-size: 12px;} table {width: 100%; margin: 0 auto;} td {padding: 3px;}</style>';
            $output = '<div style="width: 800px; margin: 0 auto;">';
            $output .= '<h1 style="color: red; text-align: center; font-size: 18px;">Not Stamped Workers Yet For Agent "' . $agent_name . '"</h1>';
            $output .= '<table border="1">';
            $output .= '<tr>';
            $output .= '<th>#</th>';
            $output .= '<th>Name</th>';
            $output .= '<th>Passport Number</th>';
            $output .= '<th>Visa Delegation Date</th>';
            $output .= '<th>Days After Visa Delegation</th>';
            $i = 1;
            foreach ($data as $row) {
                $output .= '<tr>';
                $output .= '<td style="padding: 4px;">' . $i . '</td>';
                $output .= '<td>' . $row->worker_name_in_english . '</td>';
                $output .= '<td>' . $row->passport_number . '</td>';
                $delegation_date = $row->contract_date;
                if (!is_null($row->delegation_date) || $row->delegation_date != '') {
                    $delegation_date = $row->delegation_date;
                }
                $output .= '<td>' . $delegation_date . '</td>';
                $now = time();
                $vd_date = strtotime($delegation_date);
                $date_diff = $now - $vd_date;
                $num_days = abs(floor($date_diff / (60 * 60 * 24))) . ' days';
                $output .= '<td>' . $num_days . '</td>';
                $output .= '</tr>';
                $i++;
            }
            $output .= '</tr>';
            $output .= '</table>';
            $output .= '</div>';
            return $output;
        }
    }




    public function get_not_stamped_workers($agent_id)
    {
        $sql = 'SELECT 
        services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.worker_name_in_arabic,                
        services_worker.passport_number,             
        services_finance.remains_money,
        services_customer.* , 
        representatives.name AS representative_name, 
        contract.contract_date, 
        services_finance.credit_card_id, 
        credit_card.credit_card, 	
        services_contract.*, 
        visa_issued_city.city, 
        services_order.order_number, 
        order_types.name_in_english AS order_name_english,
        order_types.name_in_arabic AS order_name_arabic, 
        jobs.name_in_english AS job_name_english, 
        jobs.name_in_arabic AS job_name_arabic, 
        staff.username AS agent_name
        FROM services_worker
        INNER JOIN 	services_contract ON services_worker.contract_number = 	services_contract.contract_number
        INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
        INNER JOIN representatives ON services_contract.representative_id = representatives.id
        INNER JOIN visa_issued_city ON services_worker.visa_issued_city_id = visa_issued_city.id
        INNER JOIN services_order ON services_worker.contract_number = services_order.contract_number
        INNER JOIN order_types ON services_order.order_type_id = order_types.id
        INNER JOIN jobs ON services_worker.job_id = jobs.id
        INNER JOIN services_finance ON services_worker.contract_number = services_finance.contract_number
        INNER JOIN credit_card ON services_finance.credit_card_id = credit_card.id
        INNER JOIN contract ON services_worker.contract_number = contract.contract_number
        INNER JOIN staff ON services_worker.agent_id = staff.id
       WHERE ((services_contract.stamp_date IS NULL) OR (TRIM(services_contract.stamp_date) LIKE ""))
                AND services_contract.delegation_date IS NOT NULL 
                AND services_contract.delegation_date <> ""
            AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
            AND services_order.order_type_id = 4
            AND staff.id = ?
        ';

        $query = $this->db->query($sql, array($agent_id));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;

    }


}