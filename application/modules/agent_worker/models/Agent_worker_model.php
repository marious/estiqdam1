<?php

class Agent_worker_model extends MY_Model
{
    protected $table_name = 'agent_worker';
 

    public $rules = [
        [
            'field' => 'job_id',
            'label' => 'lang:position_applied',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'salary',
            'label' => 'lang:worker_salary',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'contract_period',
            'label' => 'lang:contract_period',
            'rules' => 'trim',
        ],
        [
            'field' => 'name',
            'label' => 'lang:name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'name_in_arabic',
            'label' => 'Name In Arabic',
            'rules' => 'trim',
        ],
        [
            'field' => 'first_name',
            'label' => 'lang:first_name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'sur_name',
            'label' => 'lang:sur_name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'qualification',
            'label' => 'lang:qualification',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'religion',
            'label' => 'lang:religion',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'date_of_birth',
            'label' => 'lang:date_of_birth',
            'rules' => 'trim|required|valid_date',
        ],
        [
            'field' => 'date_of_expiry',
            'label' => 'lang:date_of_expiry',
            'rules' => 'trim|required|valid_date',
        ],
        [
            'field' => 'marital_status',
            'label' => 'lang:marital_status',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'height',
            'label' => 'lang:height',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'weight',
            'label' => 'lang:weight',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'passport_number',
            'label' => 'lang:passport_number',
            'rules' => 'trim|required|callback__unique_passport_number',
        ],
        [
            'field' => 'date_of_issue',
            'label' => 'lang:date_of_issue',
            'rules' => 'trim|required|valid_date',
        ],
        [
            'field' => 'place_of_issue',
            'label' => 'lang:place_of_issue',
            'rules' => 'trim',
        ],
        [
            'field' => 'experience_period',
            'label' => 'lang:experience_period',
            'rules' => 'trim',
        ],
        [
            'field' => 'experience_country',
            'label' => 'Experience Country',
            'rules' => 'trim',
        ]
    ];


    public function get_customer_workers_data()
    {
        $sql = "SELECT agent_worker.*, staff.*, customers.*, agent_worker.id AS worker_id
                FROM agent_worker
                INNER JOIN staff
                ON agent_worker.agent_id = staff.id
                INNER JOIN customers ON customers.selected_worker_id = agent_worker.id
                WHERE customers.make_contract = '0'
                ";
        $query = $this->db->query($sql);

        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }

    public function get_customer_worker_data($worker_id)
    {
        $sql = "SELECT agent_worker.*, staff.*, customers.*, customers.id AS customerID,
              agent_worker.id AS worker_id
                FROM agent_worker
                INNER JOIN staff
                ON agent_worker.agent_id = staff.id
                INNER JOIN customers ON customers.selected_worker_id = agent_worker.id
                WHERE agent_worker.id = ?
                ";
        $query = $this->db->query($sql, array($worker_id));

        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }


    public function get_accepted_workers_by_agent()
    {
        $query = 'SELECT services_worker.worker_name_in_english,
                  agent_worker.id AS worker_id,
                  agent_worker.biometric_date,
                    services_worker.passport_number,
                    services_worker.contract_number,
                    services_contract.stamp_date,
                    services_contract.arrived_date,
                    services_contract.delegation_date,
                    services_customer.customer_name_in_english,
                    services_customer.visa_number,
                    services_customer.customer_id,
                    contract.contract_date,
                    agent_worker.memo,
                    agent_worker.owwa_sched,
                    agent_worker.contract_received_date
                    FROM services_worker
                    INNER JOIN services_contract
                    ON services_contract.contract_number = services_worker.contract_number
                    INNER JOIN services_customer 
                    ON services_customer.contract_number = services_worker.contract_number
                    INNER JOIN contract
                    ON services_worker.contract_number = contract.contract_number
                    INNER JOIN agent_worker
                    ON services_worker.passport_number = agent_worker.passport_number
                    WHERE services_worker.agent_id = ?
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts) 
                    AND  ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE "")) 
                    ORDER BY contract.contract_date 
                    ';
        $result_query = $this->db->query($query, array($_SESSION['id']));
        if ($result_query->num_rows())
        {
            return $result_query->result();
        }
        return false;

        $binds = [];

        if (isset($_POST['search']['value']) && $_POST['search']['value'] != '')
        {
            $query .=  ' AND (worker_name_in_english LIKE ? ';
            $query .= ' OR passport_number LIKE ?';
        }

        $query1 = '';
        if ($_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['search']['value']) && $_POST['search']['value'] != '')
        {
            $binds[] = $_SESSION['id'];
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
        } else {
            $binds[] = $_SESSION['id'];
        }

        if ($_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);
        $data = [];
        $number_filter_row = $q2->num_rows();

        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->worker_name_in_english;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->stamp_date;
            $sub_array[] = "
                <a href='".site_url('agent_worker/view_documents_for_pdf/' . $row->contract_number)."'><i class='glyphicon glyphicon-file'></i></a>
                <a class='accept-link' href='".site_url('agent_worker/view_documents/' . $row->contract_number)."'>
            <i class='glyphicon glyphicon-eye-open'></i></a>
            ";
            $data[] = $sub_array;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $q->num_rows(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }



    public function get_accepted_agent_contract($agent_id, $contract_number)
    {
        $agent_query = 'SELECT services_worker.id
                        FROM services_worker
                        WHERE services_worker.agent_id = ?
                        AND services_worker.contract_number = ?';
        $q = $this->db->query($agent_query, array($agent_id, $contract_number));
        if ($q->num_rows())
        {
            $q2 = $this->db->query("SELECT services_contract.*,
                          services_worker.passport_number,
                          agent_worker.passport_image as agent_worker_passport_image
                          FROM services_contract
                          INNER JOIN services_worker
                          ON services_worker.contract_number = services_contract.contract_number
                          INNER JOIN agent_worker
                          ON agent_worker.passport_number = services_worker.passport_number 
                          WHERE services_contract.contract_number = ?", array($contract_number));
            if ($q2->num_rows())
            {
                return $q2->row();
            }
            return false;
        }
        return false;
    }




    public function get_all_workers()
    {
        $columns = ['agent_worker.id','agent_worker.image', 'agent_worker.passport_number', 'agent_worker.name', 'agent_worker.job',
                'agent_worker.salary', 'staff.username', 'customer_name_in_arabic'];
        $query = "SELECT agent_worker.*, agent_worker.id AS worker_id, staff.username, staff.id, agent_worker.id AS worker_id,
                  jobs.name_in_arabic AS job, customers.customer_name_in_arabic, customers.id AS customer_id, customers.visa_number
                  FROM agent_worker 
                  INNER JOIN staff
                  ON agent_worker.agent_id = staff.id
                  INNER JOIN jobs 
                  ON jobs.id = agent_worker.job_id
                  LEFT JOIN customers 
                  ON customers.selected_worker_id = agent_worker.id
                  WHERE
              ";

        $query1 = '';
        $binds = [];

        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }


        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' staff.id = ? AND ';
        }
        if (isset($_POST['search']['value']))
        {
            $query .= ' (name LIKE ? ';
            $query .= ' OR customers.customer_name_in_arabic LIKE ? ';
            $query .= ' OR passport_number LIKE ? ) ';
        }
        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY  ' . $columns[$_POST['order'][0]['column']] . ' ' .  $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY agent_worker.id DESC ';
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $binds[] = $_POST['is_agent'];
        }
        if (isset($_POST['search']['value']))
        {
            $binds[] = '%' . $_POST['search']['value'] . '%';
            $binds[] = '%' . $_POST['search']['value'] . '%';
            $binds[] = '%' . $_POST['search']['value'] . '%';
        }

        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }


        $q2 = $this->db->query($query, $binds);
        $data = [];
        $number_filter_row = $q2->num_rows();
        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->worker_id;
            $sub_array[] = '<img src="'.base_url() . 'assets/img/workers/' . $row->image.'" class="worker-img-2">';
            $sub_array[] = $row->name;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->job;
            $sub_array[] = $row->salary;
            $sub_array[] = $row->username;
            $sub_array[] = $row->customer_name_in_arabic;

            $contract_number = $this->get_contract_number_by_visa($row->visa_number);
            $view_documents = ($row->customer_name_in_arabic) ? '<li><a href="'.site_url('services_entry/processing?searched_value=' . $contract_number).'" target="_blank">View Documents</a></li>' : '';

            $cv_link = ($row->nationality_id == 11) ? 'agent_worker/view_ph_cv/' . $row->worker_id : "agent_worker/view_cv/" . $row->worker_id;
            $cancel_selection = ($row->customer_name_in_arabic) ? '<li><a href="'.site_url('agent_worker/cancel_selection/' . $row->worker_id . '/' . $row->customer_id).'" class="delete-btn">
                        <i class="glyphicon glyphicon-hand-right"></i> Cancel Selection</a></li>' : '';
            if ($row->hide == '0') { $hide_link = '<li><a href="'.site_url("agent_worker/hide_worker/" . $row->worker_id).'"> <i class="glyphicon glyphicon-thumbs-down"></i> Hide
                                                                            
                                                                            </a>
                                                                          
                                                                            </li>'; } else { $hide_link = '<li><a href="'.site_url("agent_worker/show_worker/" . $row->worker_id).'"> <i class="glyphicon glyphicon-thumbs-up"></i> Show
                                                                            
                                                                            </a>
                                                                          
                                                                            </li>'; }
            $sub_array[] = '
            <div class="btn-group">
                                                                <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                                                </button>
                                                                <ul class="datatable-dropdown dropdown-menu icons-left" role="menu">
                                                                    <li>
                                                                       <a href="'.site_url($cv_link).'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                                    </li>
                                                                    <li><a href="'.site_url("agent_worker/testpdf/" . $row->worker_id).'" class="tips " title="" target="_blank">
                                                                            <i class="glyphicon glyphicon-file"></i>  View PDF</a> </li>
                                                                            '.$view_documents.'
                                                                           '.$cancel_selection.'
                                                                            <li><a href="'.site_url("agent_worker/add_worker/" . $row->worker_id).'"><i class="	glyphicon glyphicon-edit"></i> Edit</a></li>
                                                                            '.$hide_link.'
                                                                            <li><a href="'.site_url("agent_worker/delete_worker/" . $row->worker_id).'" class="delete-btn"><i class="	glyphicon glyphicon-remove-sign"></i> Delete</a></li>
                                                                </ul>
                                                            </div>
            ';
            $data[] = $sub_array;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_workers_number(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }



    public function get_contract_number_by_visa($visa_number)
    {
        $query = "SELECT contract_number FROM services_customer WHERE visa_number = ?";
        $q = $this->db->query($query, array($visa_number));
        if ($q->num_rows()) {
            return $q->row()->contract_number;
        }
        return false;
    }


    public function get_agents()
    {
        $query = "SELECT * FROM staff WHERE access_id = ?";
        $q = $this->db->query($query, array(4));
        if ($q->num_rows())
        {
            return $q->result();
        }
        return false;
    }

    public function get_workers_number()
    {
        $query = $this->db->query("SELECT * FROM agent_worker");
        return $query->num_rows();
    }


    /**
     * Get all agent worker that not accepted
     *
     * @param $agent_worker_id
     * @return bool
     */
    public function get_agent_workers($agent_worker_id)
    {
        $sql = "
            SELECT agent_worker.*, jobs.name_in_english AS job
            FROM agent_worker
            INNER JOIN jobs 
            ON agent_worker.job_id = jobs.id
            WHERE agent_worker.agent_id = ?
        ";
        $query = $this->db->query($sql, array($agent_worker_id));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    /**
     * Get agent worker that are selected and not yet make contract
     *
     * @param $agent_worker_id
     * @return bool
     */
    public function get_agent_workers_underprocessing($agent_worker_id)
    {
        $sql = "
        SELECT agent_worker.*,
        jobs.name_in_english as job
        FROM agent_worker 
        INNER JOIN customers 
        ON customers.selected_worker_id = agent_worker.id
        INNER JOIN jobs
        ON jobs.id = agent_worker.job_id
        WHERE customers.make_contract = '0'
        AND agent_worker.agent_id = ? 
        ";
        $query = $this->db->query($sql, array($agent_worker_id));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    /**
     * Get worker status: New, Underprocessing, Selected, Arrived
     * @param null $worker_id
     */
    public function get_worker_status($worker_id = null)
    {
        if ($worker_id)
        {
            $worker = $this->get($worker_id, true);
            if ($worker && count($worker))
            {
                if ($worker->accepted == '0')
                {
                    return 'New';
                }
                else if ($worker->accepted == '1')
                {
                    $this->load->module('customers');
                    $customer = $this->customers->Customer_model->get_by(['selected_worker_id' => $worker->id], true);
                    if ($customer && count($customer))
                    {
                        $is_worker_arrived = $this->get_agent_worker_arrived($worker->passport_number);
                        if ($is_worker_arrived && count($is_worker_arrived))
                        {
                            return 'arrived';
                        }
                        else if ($customer->make_contract != '0')
                        {
                            return 'Selected';
                        }
                        else
                        {
                            return 'Under Processing';
                        }
                    }
                    return 'Undefined';
                }
            }
        }
    }




    public function get_accepted_workers()
    {
        $columns = ['agent_worker.id','agent_worker.image', 'agent_worker.name', 'agent_worker.passport_number', 'agent_worker.job',
            'agent_worker.salary', 'staff.username', 'customer_name_in_arabic'];
        $query = "SELECT agent_worker.*, agent_worker.id AS worker_id, staff.username, staff.id as agent_id, agent_worker.id AS worker_id,
                  jobs.name_in_arabic AS job, customers.customer_name_in_arabic, customers.visa_number
                   , services_worker.passport_number, services_contract.stamp_date, services_contract.contract_number
                  FROM agent_worker 
                  INNER JOIN staff
                  ON agent_worker.agent_id = staff.id
                  INNER JOIN jobs 
                  ON jobs.id = agent_worker.job_id
                  LEFT JOIN customers 
                  ON customers.selected_worker_id = agent_worker.id 
                  INNER JOIN services_worker
                  ON services_worker.passport_number = agent_worker.passport_number
                  INNER JOIN services_contract 
                  ON services_worker.contract_number = services_contract.contract_number
                  WHERE 
                     agent_worker.accepted = '1'
                   
                    AND 
                  
              ";
        $binds = [];

        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' staff.id = ? AND ';
        }
        if (isset($_POST['search']['value']))
        {
            $query .= ' (name LIKE ? ';
            $query .= ' OR agent_worker.passport_number LIKE ? ';
            $query.= ' OR customers.customer_name_in_arabic LIKE ? )';
//            $query .= ' OR salary LIKE ? )';
        }


        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY  ' . $columns[$_POST['order'][0]['column']] . ' ' .  $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY agent_worker.id DESC ';
        }




        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $binds[] = $_POST['is_agent'];
        }
        if (isset($_POST['search']['value']))
        {
            $binds[] = '%' . $_POST['search']['value'] . '%';
            $binds[] = '%' . $_POST['search']['value'] . '%';
            $binds[] = '%' . $_POST['search']['value'] . '%';
        }


        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);
        $data = [];
        $number_filter_row = $q2->num_rows();



        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->worker_id;
            $sub_array[] = '<img src="'.base_url() . 'assets/img/workers/' . $row->image.'" class="worker-img-2">';;
            $sub_array[] = $row->name;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->job;
            $sub_array[] = $row->salary;
            $sub_array[] = $row->username;
            $sub_array[] = $row->customer_name_in_arabic;

            $contract_number = $this->get_contract_number_by_visa($row->visa_number);
            $view_documents = ($row->customer_name_in_arabic) ? '<li><a href="'.site_url('services_entry/processing?searched_value=' . $row->contract_number).'" target="_blank">'.lang('view_documents').'</a></li>' : '';


            $sub_array[] = '
            <div class="btn-group">
            <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
            </button>
            <ul class="datatable-dropdown dropdown-menu icons-left" role="menu">
                <li>
                   <a href="'.site_url("agent_worker/view_cv/" . $row->worker_id).'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> '.lang('view').'</a>
                </li>
                '.$view_documents.'
                <li><a href="'.site_url("agent_worker/testpdf/" . $row->worker_id).'" class="tips " title="" target="_blank">
                        <i class="glyphicon glyphicon-file"></i>  View PDF</a> </li>
                <li><a href="'.site_url("").'" class="refuse-work" data-worker-id="'.$row->worker_id.'" data-contract-number="'.$contract_number.'" 
                data-agent-id="'.$row->agent_id.'" data-passport-number="'.$row->passport_number.'"><i class="glyphicon glyphicon-remove"></i> '.lang('refuse_to_work').'</a></li>                        
                 <li><a href="'.site_url("agent_worker/add_worker/" . $row->worker_id).'">'. lang('edit') .'</a></li>       
            </ul>
        </div>
            ';
            $data[] = $sub_array;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_workers_number(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }



    public function get_accepted_workers_2()
    {
        $query = 'SELECT services_worker.worker_name_in_english,
                    agent_worker.id AS worker_id,
                    agent_worker.biometric_date,
                    services_worker.passport_number,
                    services_worker.contract_number,
                    services_contract.stamp_date,
                    services_contract.arrived_date,
                    services_contract.ticket_image,
                    services_contract.delegation_date,
                    services_customer.customer_name_in_english,
                    services_customer.customer_name_in_arabic,
                    services_customer.visa_number,
                    services_customer.customer_id,
                    contract.contract_date,
                    agent_worker.memo,
                    agent_worker.passport_number,
                    agent_worker.contract_received_date,
                    staff.username AS agent_name
                    FROM services_worker
                    INNER JOIN services_contract
                    ON services_contract.contract_number = services_worker.contract_number
                    INNER JOIN services_customer 
                    ON services_customer.contract_number = services_worker.contract_number
                    INNER JOIN contract
                    ON services_worker.contract_number = contract.contract_number
                    INNER JOIN agent_worker
                    ON services_worker.passport_number = agent_worker.passport_number
                    INNER JOIN staff 
                    ON agent_worker.agent_id = staff.id                   
                    WHERE ((services_contract.stamp_date IS NULL) OR (TRIM(services_contract.stamp_date) LIKE ""))
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts) 
                
                    ';

                $binds = [];

                if (isset($_POST['search']['value']) && $_POST['search']['value'] != '')
                {
                    $query .= ' AND (services_worker.worker_name_in_english LIKE ? OR services_customer.customer_name_in_arabic LIKE ? )';
                }

            if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '0')
            {
                $query .= ' AND staff.id = ? ';
            }

                $query1 = '';
                if ($_POST['length'] != -1)
                {
                    $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
                }

            if (isset($_POST['search']['value']) && $_POST['search']['value'] != '')
            {
                $binds[] =  '%' . $_POST['search']['value'] . '%';
                $binds[] = '%' . $_POST['search']['value'] . '%';
            }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '0')
        {
            $binds[] = $_POST['is_agent'];
        }


        if ($_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);
        $data = [];
        $number_filter_row = $q2->num_rows();

        $i = 1;
        foreach ($q->result() as $row)
        {

            $contract_received_date = '';
            $biometric_date = '';
            if ($row->contract_received_date) { $contract_received_date = strpos($row->contract_received_date, '/')  ?
                DateTime::createFromFormat('d/m/Y', $row->contract_received_date)->format('d/m/Y') : date('d/m/Y', strtotime($row->contract_received_date));
            }

            if ($row->biometric_date) { $biometric_date = strpos($row->biometric_date, '/')  ?
                DateTime::createFromFormat('d/m/Y', $row->biometric_date)->format('d/m/Y') : date('d/m/Y', strtotime($row->biometric_date));
            }





            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = $row->worker_name_in_english;
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = $row->customer_id;
            $sub_array[] = $row->visa_number;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->agent_name;
            $sub_array[] = $contract_received_date;
            $sub_array[] = $biometric_date;
            $sub_array[] = $row->memo;
            $sub_array[] = '<button type="button" name="update" id="'.$row->worker_id.'" class="btn btn-primary btn-xs update">Update</button>';
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $q->num_rows(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
//        $this->output->enable_profiler(TRUE);

        echo json_encode($output);

    }



    public function get_new_workers()
    {
        $columns = ['worker_id', 'agent_worker.image', 'agent_worker.name', 'agent_worker.job',
            'agent_worker.salary', 'staff.username', 'customer_name_in_arabic'];
        $query = "SELECT agent_worker.*, staff.username, staff.id, agent_worker.id AS worker_id,
                  jobs.name_in_arabic AS job, customers.customer_name_in_arabic
                  FROM agent_worker 
                  INNER JOIN staff
                  ON agent_worker.agent_id = staff.id
                  INNER JOIN jobs 
                  ON jobs.id = agent_worker.job_id
                  LEFT JOIN customers 
                  ON customers.selected_worker_id = agent_worker.id
                  WHERE agent_worker.accepted = '0' AND 
              ";
        $binds = [];
        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' staff.id = ? AND ';
        }
        if (isset($_POST['search']['value']))
        {
            $query .= ' (name LIKE ? ';
            $query .= ' OR agent_worker.passport_number LIKE ? ';
            $query .= ' OR salary LIKE ? )';
        }
        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY  ' . $columns[$_POST['order'][0]['column']] . ' ' .  $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY agent_worker.id DESC ';
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $binds[] = $_POST['is_agent'];
        }
        if (isset($_POST['search']['value']))
        {
            $binds[] = '%' . $_POST['search']['value'] . '%';
            $binds[] = '%' . $_POST['search']['value'] . '%';
            $binds[] = '%' . $_POST['search']['value'] . '%';
        }
        $q = $this->db->query($query, $binds);
        $data = [];
        $number_filter_row = $q->num_rows();
        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->worker_id;
            $sub_array[] = '<img src="'.base_url() . 'assets/img/workers/' . $row->image.'" class="worker-img-2">';;
            $sub_array[] = $row->name;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->job;
            $sub_array[] = $row->salary;
            $sub_array[] = $row->username;
            $sub_array[] = $row->customer_name_in_arabic;

            $cv_link = ($row->nationality_id == 11) ? 'agent_worker/view_ph_cv/' . $row->worker_id : "agent_worker/view_cv/" . $row->worker_id;
            $cancel_selection = ($row->customer_name_in_arabic) ? '<li><a href="'.site_url('agent_worker/cancel_selection/' . $row->worker_id . '/' . $row->customer_id).'" class="delete-btn">
                        <i class="glyphicon glyphicon-hand-right"></i> Cancel Selection</a></li>' : '';
            if ($row->hide == '0') { $hide_link = '<li><a href="'.site_url("agent_worker/hide_worker/" . $row->worker_id).'"> <i class="glyphicon glyphicon-thumbs-down"></i> Hide
                                                                            
                                                                            </a>
                                                                          
                                                                            </li>'; } else { $hide_link = '<li><a href="'.site_url("agent_worker/show_worker/" . $row->worker_id).'"> <i class="glyphicon glyphicon-thumbs-up"></i> Show
                                                                            
                                                                            </a>
                                                                          
                                                                            </li>'; }
            $sub_array[] = '
            <div class="btn-group">
                                                                <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                                                                </button>
                                                                <ul class="datatable-dropdown dropdown-menu icons-left" role="menu">
                                                                    <li>
                                                                       <a href="'.site_url($cv_link).'" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                                                    </li>
                                                                    <li><a href="'.site_url("agent_worker/testpdf/" . $row->worker_id).'" class="tips " title="" target="_blank">
                                                                            <i class="glyphicon glyphicon-file"></i>  View PDF</a> </li>
                                                                           '.$cancel_selection.'
                                                                            <li><a href="'.site_url("agent_worker/add_worker/" . $row->worker_id).'"><i class="	glyphicon glyphicon-edit"></i> Edit</a></li>
                                                                            '.$hide_link.'
                                                                            <li><a href="'.site_url("agent_worker/delete_worker/" . $row->worker_id).'" class="delete-btn"><i class="	glyphicon glyphicon-remove-sign"></i> Delete</a></li>
                                                                </ul>
                                                            </div>
            ';
            $data[] = $sub_array;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_workers_number(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }


    /**
     * Get agnet worker not stamp report
     *
     * @return bool
     */
    public function get_agent_workers_not_stamp()
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
        AND staff.id = ?
        ';

        $query = $this->db->query($sql, array($_SESSION['id']));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;

    }


    public function get_agent_workers_not_arrived()
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
        WHERE ((services_contract.stamp_date IS NOT NULL) OR (TRIM(services_contract.stamp_date) NOT LIKE "")) 
        AND ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE ""))
      
        AND staff.id = ?
        ';

        $query = $this->db->query($sql, array($_SESSION['id']));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_agent_workers_arrived()
    {
        $sql = 'SELECT 
        services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.worker_name_in_arabic,                
        services_worker.passport_number,          
        services_customer.customer_name_in_arabic,
        services_finance.remains_money,
        services_customer.* , 
        agent_payment_note.note,
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
        LEFT JOIN agent_payment_note ON services_contract.contract_number = agent_payment_note.contract_number
        WHERE NOT ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE "")) 
        AND staff.id = ?
        ORDER BY services_contract.arrived_date DESC
        ';

        $query = $this->db->query($sql, array($_SESSION['id']));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }




    public function get_accepted_worker_by_contact_number($contract_number)
    {
        $sql = "
            SELECT services_worker.*,
            services_contract.*
            FROM services_worker
            INNER JOIN services_contract 
            ON services_worker.contract_number = services_contract.contract_number
            WHERE services_worker.contract_number = ?
            AND services_worker.agent_id = ?
        ";
        $query = $this->db->query($sql, array($contract_number, $_SESSION['id']));
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }




    public function hide_worker($worker_id)
    {
        if ($worker_id)
        {
            $row = $this->db->get_where('agent_worker', array('id' => $worker_id))->row();
            if ($row && count($row))
            {
                $this->db->where('id', $worker_id);
                $this->db->set(array('hide' => '1'));
                return $this->db->update('agent_worker');
            }
        }
    }

    public function show_worker($worker_id)
    {
        if ($worker_id)
        {
            $row = $this->db->get_where('agent_worker', array('id' => $worker_id))->row();
            if ($row && count($row))
            {
                $this->db->where('id', $worker_id);
                $this->db->set(array('hide' => '0'));
                return $this->db->update('agent_worker');
            }
        }
    }


    public function delete_worker($worker_id)
    {
        if ($worker_id)
        {
            $row = $this->db->get_where('agent_worker', array('id' => $worker_id))->row();
            if ($row && count($row))
            {
                $this->db->where('id', $worker_id);
                return $this->db->delete('agent_worker');
            }

            return false;
        }
    }




    public function get_agent_worker_arrived($worker_passport_number)
    {
        $sql = 'SELECT 
        services_worker.contract_number,
        services_customer.customer_name_in_arabic,
        contract.contract_date, 
        services_contract.*, 
        staff.username AS agent_name
        FROM services_worker
        INNER JOIN 	services_contract ON services_worker.contract_number = 	services_contract.contract_number
        INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
        INNER JOIN contract ON services_worker.contract_number = contract.contract_number
        INNER JOIN staff ON services_worker.agent_id = staff.id
        WHERE NOT ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE "")) 
        AND staff.id = ?
        AND services_worker.passport_number = ?
        ';

        $query = $this->db->query($sql, array($_SESSION['id'], $worker_passport_number));
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }










    public function get_vfs_workers_by_agent($agent_id, $vfs = false)
    {
        $sql = 'SELECT services_worker.worker_name_in_english,
                  agent_worker.id AS worker_id,
                  agent_worker.biometric_date,
                    services_worker.passport_number,
                    services_worker.contract_number,
                    services_contract.stamp_date,
                    services_contract.arrived_date,
                    services_contract.ticket_image,
                    services_contract.delegation_date,
                    services_customer.customer_name_in_english,
                    services_customer.customer_name_in_arabic,
                    services_customer.visa_number,
                    services_customer.customer_id,
                    contract.contract_date,
                    agent_worker.memo,
                    agent_worker.contract_received_date,
                    staff.username AS agent_name
                    FROM services_worker
                    INNER JOIN services_contract
                    ON services_contract.contract_number = services_worker.contract_number
                    INNER JOIN services_customer 
                    ON services_customer.contract_number = services_worker.contract_number
                    INNER JOIN contract
                    ON services_worker.contract_number = contract.contract_number
                    INNER JOIN agent_worker
                    ON services_worker.passport_number = agent_worker.passport_number
                    INNER JOIN staff 
                    ON agent_worker.agent_id = staff.id                   
                    WHERE ((services_contract.stamp_date IS NULL) OR (TRIM(services_contract.stamp_date) LIKE ""))
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts) 
                    ';

            if ($agent_id != '0') {
                $sql .= "  AND agent_worker.agent_id= ? ";
            }

            if ($vfs == true) {
                $sql .= 'AND (agent_worker.biometric_date <> "" AND agent_worker.biometric_date IS NOT NULL)';
            }

            if ($vfs == false) {
                $sql .= 'AND (agent_worker.biometric_date = "" OR agent_worker.biometric_date IS NULL)';
            }

            $query = $this->db->query($sql, array($agent_id));
            return $query->result();


    }





    public function get_refuse_workers()
    {
        $columns = [
            'contract.contract_number',
            'contract.contract_date',
            'services_customer.customer_name_in_arabic',
            'services_customer.visa_number',
            'services_worker.worker_name_in_english',
            'services_worker.passport_number',
            'agent_name',
            'refuse_workers.reason',
        ];


        $query = "SELECT refuse_workers.*, services_worker.worker_name_in_english, services_worker.worker_name_in_arabic, 
                   services_customer.customer_name_in_arabic,
                contract.contract_number, contract.contract_date, staff.username AS agent_name, agent_worker.name as worker_name
                FROM refuse_workers
                INNER JOIN services_worker
                ON services_worker.id = refuse_workers.worker_id
                INNER JOIN services_customer
                ON services_customer.contract_number = refuse_workers.contract_number
                INNER JOIN contract ON refuse_workers.contract_number = contract.contract_number
                INNER JOIN staff ON refuse_workers.agent_id = staff.id
                INNER JOIN agent_worker ON agent_worker.passport_number = refuse_workers.passport_number
                ";


        $binds = [];


        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' WHERE staff.id = ? ';
        }


        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $binds[] = $_POST['is_agent'];
        }

        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);

        $data = [];
        $number_filter_row = $q2->num_rows();

        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->contract_number;
            $sub_array[] = $row->contract_date;
            $sub_array[] = $row->customer_name_in_arabic;
           $sub_array[] = $row->worker_name;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->agent_name;
            $sub_array[] = $row->refuse_date;
            $sub_array[] = $row->reason;
            $data[] = $sub_array;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $q->num_rows(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }



    public function load_worker_documents()
    {
        $query = "
            SELECT contract.contract_number,contract.contract_date,
                services_contract.visa_image, services_contract.id_image,
                services_contract.contract_image, services_contract.delegation_image,
                services_contract.stamping_image, services_contract.passport_image,
                services_worker.passport_number,
                agent_worker.name AS worker_name,
                services_customer.customer_name_in_arabic,
                staff.username AS agent_name
            FROM services_worker
            INNER JOIN contract 
            ON services_worker.contract_number = contract.contract_number
            INNER JOIN agent_worker
            ON agent_worker.passport_number = services_worker.passport_number
            INNER JOIN services_customer 
            ON services_worker.contract_number = services_customer.contract_number
            INNER JOIN services_contract 
            ON services_worker.contract_number = services_contract.contract_number
             INNER JOIN staff ON services_worker.agent_id = staff.id
             WHERE services_worker.contract_number NOT IN (select contract_number from cancelled_contracts)

             
        ";

        $binds = [];


        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' AND staff.id = ? ';
        }


        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $binds[] = $_POST['is_agent'];
        }

        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ORDER BY contract.contract_date DESC ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query . ' ORDER BY contract.contract_date DESC ', $binds);
        }

        $q2 = $this->db->query($query . ' ORDER BY contract.contract_date DESC', $binds);

        $data = [];
        $number_filter_row = $q2->num_rows();

        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = $row->worker_name;
            $sub_array[] =  '<a href="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->visa_image).'" data-lightbox="image-gallery">
                                    <img  class="small-img img-thumbnail" src="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->visa_image).'" data-title="Visa Image"></a>';
            $sub_array[] =  '<a href="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->id_image).'" data-lightbox="image-gallery" data-title="ID image">
                                                       <img class="small-img img-thumbnail" src="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->id_image).'"></a>';
            $sub_array[] =  '<a data-lightbox="image-gallery" href="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->passport_image).'" data-title="passport image">
                                        <img class="small-img img-thumbnail" src="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->passport_image).'"></a>';
            $sub_array[] =  '<a href="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->contract_image).'" data-lightbox="image-gallery" data-title="Contract Image">
                                        <img class="small-img img-thumbnail" src="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->contract_image).'"></a>';
            $sub_array[] =  '<a href="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->delegation_image).'" data-lightbox="image-gallery" data-title="delegation iamge">
                                            <img class="small-img img-thumbnail" src="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->delegation_image).'"></a>';
            $sub_array[] =  '<a href="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->stamping_image).'" data-lightbox="image-gallery" data-title="Stamping Image">
                                    <img class="small-img img-thumbnail" src="'.site_url('assets/contracts/' . $row->contract_number . '/' . $row->stamping_image).'">';
            $sub_array[] = $row->agent_name;
            $data[] = $sub_array;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $q->num_rows(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }





}