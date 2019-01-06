<?php

class Service_model extends MY_Model
{

    protected $table_name = 'services_contract';


    public $rules = [
        [
            'field' => 'contract_number',
            'label' => 'lang:contract_number',
            'rules' => 'trim|required|integer',
        ],
        [
            'field' => 'contract_date',
            'label' => 'lang:contract_date',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'contract_period',
            'label' => 'lang:contract_period',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'vacation_period',
            'label' => 'lang:vacation_period',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'recruitment_cost',
            'label' => 'lang:recruitment_cost',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'prepaid_money',
            'label' => 'lang:prepaid_money',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'credit_card_id',
            'label' => 'lang:credit_card',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'order_type',
            'label' => 'lang:order_type',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'order_number',
            'label' => 'lang:order_number',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'notes_1',
            'label' => 'lang:notes_1',
            'rules' => 'trim',
        ],

        [
            'field' => 'notes_2',
            'label' => 'lang:notes_2',
            'rules' => 'trim',
        ],


        [
            'field' => 'customer_name_in_english',
            'label' => 'lang:customer_name_in_english',
            'rules' => 'trim',
        ],

        [
            'field' => 'customer_name_in_arabic',
            'label' => 'lang:customer_name_in_arabic',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'customer_id',
            'label' => 'lang:customer_id',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'customer_nationality',
            'label' => 'lang:customer_nationality',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'customer_nationality',
            'label' => 'lang:customer_nationality',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'worker_name_in_english',
            'label' => 'lang:worker_name_in_english',
            'rules' => 'trim',
        ],

        [
            'field' => 'worker_name_in_arabic',
            'label' => 'lang:worker_name_in_arabic',
            'rules' => 'trim',
        ],

        [
            'field' => 'representative_id',
            'label' => 'lang:representative',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'agent',
            'label' => 'lang:agent',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'worker_nationality',
            'label' => 'lang:worker_nationality',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'worker_salary',
            'label' => 'lang:worker_salary',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'arrival_airport',
            'label' => 'lang:arrival_airport',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'worker_job',
            'label' => 'lang:worker_job',
            'rules' => 'trim|required',
        ],


        [
            'field' => 'visa_issued_city',
            'label' => 'lang:visa_issued_city',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'visa_issued_city',
            'label' => 'lang:visa_issued_city',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'qualification',
            'label' => 'lang:qualification',
            'rules' => 'trim',
        ],

        [
            'field' => 'passport_number',
            'label' => 'lang:passport_number',
            'rules' => 'trim',
        ],

        [
            'field' => 'visa_number',
            'label' => 'lang:visa_number',
            'rules' => 'trim|required',
        ],


        [
            'field' => 'visa_date',
            'label' => 'lang:visa_date',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'customer_mobile',
            'label' => 'lang:customer_mobile',
            'rules' => 'trim|required',
        ],





    ];


    public function get_agents()
    {
        $sql = 'SELECT staff.id, staff.username FROM staff WHERE access_id = ?';
        $query = $this->db->query($sql, array(4));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_last_contract_number()
    {
        $row = $this->db->select('contract_number')
                            ->order_by('contract_number', 'desc')
                            ->limit(1)
                            ->get('contract')
                            ->row();
        if ($row && count($row)) {
            return $row->contract_number;
        }
        return false;
    }



    public function get_services_entry($current_date = null)
    {

        if (null == $current_date) {
            $current_date = date('Y-m-d');
        }

        $query = 'select services_worker.contract_number, services_worker.worker_name_in_english, services_worker.passport_number
                    ,services_customer.* , representatives.name AS \'representative_name\', contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic AS job_name_arabic, staff.username AS agent_name
                          ,arrival_airports.name_in_english AS arrival_airport
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
        INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
WHERE contract.contract_date = ?
AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
';

        $q = $this->db->query($query, array($current_date));
        if ($q->num_rows()) {
            return $q->result();
        }
        return false;

    }


    public function get_searched_services($searched_key, $searched_value, $not = false, $name_search = false)
    {
        $query = 'select 
      services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.passport_number,             
        services_finance.remains_money,
          services_customer.* , representatives.name AS representative_name, contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic AS job_name_arabic, staff.username AS agent_name
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
WHERE services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
';
        if ($not)
        {
            $query .= ' AND ' . $searched_key . '!=?;';
        }
        else if ($name_search)
        {
            $query .= ' AND ' . $searched_key . ' LIKE ?';
        }
        else
        {
            $query .= ' AND ' . $searched_key . ' = ?;';
        }


        $q = $this->db->query($query, array($searched_value));
        if ($q->num_rows()) {
            return $q->result();
        }
        return false;

    }



    public function get_searched_services_by_month($month, $year)
    {
        $query = 'select 
      services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.passport_number,             
        services_finance.remains_money,
          services_customer.* , representatives.name AS representative_name, contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic AS job_name_arabic, staff.username AS agent_name,
                          contract.*
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
WHERE MONTH(contract.contract_date) = ? AND YEAR(contract.contract_date) = ?
 AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
';


        $q = $this->db->query($query, array($month, $year));
        if ($q->num_rows()) {
            return $q->result();
        }
        return false;

    }




    public function get_all_contracts()
    {
        $columns = [
            'contract.contract_number',
            'services_customer.customer_name_in_arabic',
            'services_worker.worker_name_in_english',
            'services_customer.visa_number',
            'services_customer.customer_id',
            'services_customer.customer_mobile',
            'services_contract.marketer',
            'representatives.name',
            'agent_name',
            'services_finance.prepaid_money',
            'services_finance.remains_money',
            'arrival_airports.name_in_arabic',
            'services_contract.delegation_date',
            'services_contract.stamp_date',
            'services_contract.arrived_date',
            ];

        $query = 'select services_worker.contract_number,
                            services_worker.worker_name_in_english,
                            services_worker.worker_name_in_arabic,
                            services_customer.* , representatives.name AS representative_name, 
                            representatives.id, contract.*, services_finance.*, credit_card.credit_card 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english, services_contract.* 
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english,
                          jobs.name_in_arabic AS job_name_arabic,
                          order_types.*, arrival_airports.name_in_arabic AS arrival_airport,
                          services_contract.marketer,staff.username AS agent_name
  FROM services_worker
  INNER JOIN services_contract ON services_worker.contract_number = services_contract.contract_number
  INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
  INNER JOIN representatives ON services_contract.representative_id = representatives.id
  INNER JOIN visa_issued_city ON services_worker.visa_issued_city_id = visa_issued_city.id
  INNER JOIN services_order ON services_worker.contract_number = services_order.contract_number
  INNER JOIN order_types ON services_order.order_type_id = order_types.id
  INNER JOIN jobs ON services_worker.job_id = jobs.id
  INNER JOIN services_finance ON services_worker.contract_number = services_finance.contract_number
  INNER JOIN credit_card ON services_finance.credit_card_id = credit_card.id
  INNER JOIN contract ON services_worker.contract_number = contract.contract_number
  INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
  INNER JOIN staff ON services_worker.agent_id = staff.id
';

        $query .= ' WHERE services_contract.contract_number NOT IN (select contract_number from cancelled_contracts) ';
        $binds = [];

        if (  (isset($_POST['is_representative']) && $_POST['is_representative'] != '' && $_POST['is_representative'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $query .= ' AND representatives.id = ? AND staff.id = ?  ';
        }

        else if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false' && $_POST['is_representative'] != '')
        {
            $query .= ' AND representatives.id = ?  ';
        }

        else if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $query .= ' AND staff.id = ?  ';
        }

        if (isset($_POST['search']['value']))
        {
            $query .=  ' AND (customer_name_in_arabic LIKE ? ';
            $query .= ' OR visa_number LIKE ?';
            $query .= ' OR customer_id LIKE ? ';
            $query .= ' OR marketer LIKE ? ';
            $query .= ' OR customer_mobile LIKE ? ';
            $query .= ' OR arrival_airports.name_in_arabic LIKE ? ) ';
        }

        if (isset($_POST['order']) && ($columns[$_POST['order'][0]['column']] == 'services_contract.delegation_date') ) {
            $query .= ' ORDER BY STR_TO_DATE(' . $columns[$_POST['order'][0]['column']] . ', "%Y-%m-%d") ' .
                $_POST['order'][0]['dir'] . ' ';
        }

        else if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
                $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY contract.contract_number DESC';
        }

        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }


        if (  (isset($_POST['is_representative']) && $_POST['is_representative'] != '' && $_POST['is_representative'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $binds[] = $_POST['is_representative'];
            $binds[] = $_POST['is_agent'];
        }

        else if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false' && $_POST['is_representative'] != '')
        {
            $binds[] = $_POST['is_representative'];
        }

        else if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $binds[] = $_POST['is_agent'];
        }

        if (isset($_POST['search']['value']))
        {
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
//            $q = $this->db->query($query, array('%' . $_POST['search']['value'] . '%',
//                '%' . $_POST['search']['value'] . '%', '%' . $_POST['search']['value'] . '%',
//                '%' . $_POST['search']['value'] . '%', '%' . $_POST['search']['value'] . '%'));
        }
//        else
//        {
//            $q = $this->db->query($query);
//        }
        if ($_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);
//        if ($q->num_rows())
//        {
            $data = [];
            $number_filter_row = $q2->num_rows();
            foreach ($q->result() as $row)
            {
                $sub_array = [];
                $sub_array[] = $row->contract_number;
                $sub_array[] = $row->customer_name_in_arabic;
                $sub_array[] = $row->worker_name_in_english;
                $sub_array[] = $row->visa_number;
                $sub_array[] = $row->customer_id;
                $sub_array[] = $row->customer_mobile;
                $sub_array[] = $row->marketer;
                $sub_array[] = $row->representative_name;
                $sub_array[] = $row->agent_name;
                $sub_array[] = $row->prepaid_money;
                $sub_array[] = $row->remains_money;
                $sub_array[] = $row->arrival_airport;
                $sub_array[] = $row->delegation_date;
                $sub_array[] = $row->stamp_date;
                $sub_array[] = $row->arrived_date;
                $data[] = $sub_array;
            }
            $output = [
                "draw" => intval($_POST['draw']),
                "recordsTotal"  	=>  $this->get_contract_numbers(),
                "recordsFiltered" 	=> $number_filter_row,
                "data"    			=> $data,
            ];
            echo json_encode($output);
//        }
//        return [];

    }



    public function get_contract_numbers()
    {
        $query = "SELECT * FROM services_contract";
        $q = $this->db->query($query);
        return $q->num_rows();
    }




    public function save_contract_number($contract_number, $contract_date = false)
    {
        $this->db->set(['contract_number' => $contract_number, 'contract_date' => $contract_date, 'created_at' => $contract_date]);
        $this->db->insert('contract');
        $id = $this->db->insert_id();
        return $id;
    }

    public function get_max_contract_number()
    {
        $query = $this->db->query('select max(contract_number) as max_contract from contract');
        return $query->row()->max_contract;
    }


    public function save_service_finance($finance_data, $contract_number = false)
    {
        $data = [
            'recruitment_cost'  => $finance_data['recruitment_cost'],
            'prepaid_money'     => $finance_data['prepaid_money'],
            'remains_money'     => $finance_data['remains_money'],
            'credit_card_id'    => $finance_data['credit_card_id'],
        ];

        if (!$contract_number)
        {
            $data['contract_number']  = $finance_data['contract_number'];
        }

        $this->db->set($data);

        if ($contract_number)
        {
            $this->db->where('contract_number', $contract_number);
            $this->db->update('services_finance');
            return $contract_number;
        }

        $this->db->insert('services_finance');
        $id = $this->db->insert_id();
        return $id;
    }


    public function save_service_order($order, $contract_number = false)
    {
        $data = [
            'order_number' => $order['order_number'],
            'order_type_id' => $order['order_type_id'],
        ];
        if (!$contract_number)
        {
            $data['contract_number'] = $order['contract_number'];
        }

        $this->db->set($data);

        if ($contract_number)
        {
            $this->db->where('contract_number', $contract_number);
            $this->db->update('services_order');
            return $contract_number;
        }

        $this->db->insert('services_order');
        $id = $this->db->insert_id();
        return $id;
    }


    public function save_customer_service($customer_data, $contract_number = false)
    {
        $data = [
            'customer_name_in_english' => $customer_data['customer_name_in_english'],
            'customer_name_in_arabic' => $customer_data['customer_name_in_arabic'],
            'customer_id' => $customer_data['customer_id'],
            'visa_number' => $customer_data['visa_number'],
            'visa_date' => $customer_data['visa_date'],
            'customer_mobile' => $customer_data['customer_mobile'],
            'customer_nationality_id' => $customer_data['customer_nationality_id'],
        ];

        if (! $contract_number)
        {
            $data['contract_number'] = $customer_data['contract_number'];
        }

        $this->db->set($data);

        if ($contract_number)
        {
            $this->db->where('contract_number', $contract_number);
            $this->db->update('services_customer');
            return $contract_number;
        }

        $this->db->insert('services_customer');
        $id = $this->db->insert_id();
        return $id;
    }



    public function save_worker_service($worker_data, $contract_number = false)
    {

        $data = [
            'worker_name_in_english' => $worker_data['worker_name_in_english'],
            'worker_name_in_arabic' => $worker_data['worker_name_in_arabic'],
            'worker_salary'         => $worker_data['worker_salary'],
            'qualification'         => $worker_data['qualification'],
            'worker_nationality_id' => $worker_data['worker_nationality_id'],
            'arrival_airport_id'    => $worker_data['arrival_airport_id'],
            'departure_airport_id'    => $worker_data['departure_airport_id'],
            'visa_issued_city_id'   => $worker_data['visa_issued_city_id'],
            'passport_number'       => $worker_data['passport_number'],
            'job_id'                => $worker_data['worker_job'],
            'agent_id'              => $worker_data['agent_id'],
        ];


        if (! $contract_number)
        {
            $data['contract_number'] = $worker_data['contract_number'];
        }


        $this->db->set($data);


        if ($contract_number)
        {
            $this->db->where('contract_number', $contract_number);
            $this->db->update('services_worker');
            return $contract_number;
        }

        $this->db->insert('services_worker');
        $id = $this->db->insert_id();
        return $id;
    }




    public function get_worker_info($contract_number)
    {
        $query = 'SELECT
                    services_worker.id,
                    services_worker.worker_name_in_english,
                    services_worker.worker_name_in_arabic,
                    services_worker.worker_salary,
                    services_worker.qualification,
                    services_worker.passport_number,
                    services_contract.representative_id,
                    services_worker.worker_nationality_id,
                    services_worker.arrival_airport_id,
                    services_worker.visa_issued_city_id,
                    services_worker.contract_number,
                    representatives.`name`,
                    worker_nationality.nationality_in_english,
                    worker_nationality.nationality_in_arabic,
                    worker_nationality.country_name_in_arabic,
                    worker_nationality.country_name_in_english,
                    arrival_airports.name_in_english,
                    arrival_airports.name_in_arabic,
                    visa_issued_city.city,
                    jobs.name_in_arabic AS job_name_in_arabic,
                    jobs.name_in_english AS job_name_in_english
                    FROM
                    services_worker
                    INNER JOIN services_contract ON services_contract.contract_number = services_worker.contract_number 
                    INNER JOIN representatives ON services_contract.representative_id = representatives.id
                    INNER JOIN worker_nationality ON services_worker.worker_nationality_id = worker_nationality.id
                    INNER JOIN jobs ON jobs.id = services_worker.job_id
                    INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
                    INNER JOIN visa_issued_city ON services_worker.visa_issued_city_id = visa_issued_city.id
                    WHERE services_worker.contract_number = ?
                    ';


        $q = $this->db->query($query, array($contract_number));
        if ($q->num_rows()) {
            return $q->row();
        }
        return false;

    }



    public function get_customer_info($contract_number)
    {
        $query = 'SELECT services_customer.*, customer_nationality.* FROM services_customer
                  INNER JOIN customer_nationality 
                  ON customer_nationality.id = services_customer.customer_nationality_id
                WHERE services_customer.contract_number=? ';
        $q = $this->db->query($query, array($contract_number));
        if ($q->num_rows()) {
            return $q->row();
        }
        return false;
    }



    public function get_contract_info($contract_number)
    {
        $query = 'SELECT
                    services_contract.contract_period,
                    services_contract.contract_number,
                    contract.contract_date,
                    services_contract.vacation_period,
                    services_contract.notes_1,
                    services_contract.notes_2
                    FROM
                    contract
                    INNER JOIN services_contract ON services_contract.contract_number = contract.contract_number WHERE services_contract.contract_number = ?';

        $q = $this->db->query($query, array($contract_number));
        if ($q->num_rows()) {
            return $q->row();
        }
        return false;
    }


    public function get_finance_info($contract_number)
    {
        $q = $this->db->query('SELECT * FROM services_finance WHERE services_finance.contract_number = ?',
                    array($contract_number));
        if ($q->num_rows()) {
            return $q->row();
        }
        return false;
    }


    public function get_service_order_info($contract_number)
    {
        $query = 'SELECT
                order_types.id,
                order_types.name_in_english,
                order_types.name_in_arabic,
                services_order.order_number
                FROM
                services_order
                INNER JOIN order_types ON services_order.order_type_id = order_types.id 
                WHERE services_order.contract_number = ?';
        $q = $this->db->query($query, array($contract_number));
        if ($q->num_rows()) {
            return $q->row();
        }
        return false;
    }


    public function get_contracts_for_processing()
    {
        $columns = [
            'services_customer.customer_name_in_arabic',
            'services_customer.visa_number',
            'services_worker.worker_name_in_english',
            'services_worker.passport_number',
            'representatives.name',
            'agent_name',
            '',
        ];

        $query = 'select services_worker.contract_number,
                          services_worker.passport_number,
                            services_worker.worker_name_in_english,
                            services_worker.worker_name_in_arabic,
                            services_customer.* , representatives.name AS representative_name, 
                            representatives.id, contract.*, services_finance.*, credit_card.credit_card 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english, services_contract.* 
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english,
                          jobs.name_in_arabic AS job_name_arabic,
                          order_types.*, arrival_airports.name_in_arabic AS arrival_airport,
                          services_contract.marketer,staff.username AS agent_name
  FROM services_worker
  INNER JOIN services_contract ON services_worker.contract_number = 	services_contract.contract_number
  INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
  INNER JOIN representatives ON services_contract.representative_id = representatives.id
  INNER JOIN visa_issued_city ON services_worker.visa_issued_city_id = visa_issued_city.id
  INNER JOIN services_order ON services_worker.contract_number = services_order.contract_number
  INNER JOIN order_types ON services_order.order_type_id = order_types.id
  INNER JOIN jobs ON services_worker.job_id = jobs.id
  INNER JOIN services_finance ON services_worker.contract_number = services_finance.contract_number
  INNER JOIN credit_card ON services_finance.credit_card_id = credit_card.id
  INNER JOIN contract ON services_worker.contract_number = contract.contract_number
  INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
  INNER JOIN staff ON services_worker.agent_id = staff.id
';

        $query .= ' WHERE ';
        $binds = [];

        if (  (isset($_POST['is_representative']) && $_POST['is_representative'] != '' && $_POST['is_representative'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $query .= ' representatives.id = ? AND staff.id = ? AND ';
        }

        else if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false' && $_POST['is_representative'] != '')
        {
            $query .= ' representatives.id = ? AND ';
        }

        else if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $query .= ' staff.id = ? AND ';
        }

        if (isset($_POST['search']['value']))
        {
            $query .=  ' (customer_name_in_arabic LIKE ? ';
            $query .= ' OR visa_number LIKE ?';
            $query .= ' OR customer_id LIKE ? ';
            $query .= ' OR marketer LIKE ? ';
            $query .= ' OR customer_mobile LIKE ? ';
            $query .= ' OR arrival_airports.name_in_arabic LIKE ? ) ';
        }

        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
                $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY contract.contract_number DESC';
        }

        $query1 = '';
        if ($_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }


        if (  (isset($_POST['is_representative']) && $_POST['is_representative'] != '' && $_POST['is_representative'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $binds[] = $_POST['is_representative'];
            $binds[] = $_POST['is_agent'];
        }

        else if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false' && $_POST['is_representative'] != '')
        {
            $binds[] = $_POST['is_representative'];
        }

        else if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $binds[] = $_POST['is_agent'];
        }

        if (isset($_POST['search']['value']))
        {
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
//            $q = $this->db->query($query, array('%' . $_POST['search']['value'] . '%',
//                '%' . $_POST['search']['value'] . '%', '%' . $_POST['search']['value'] . '%',
//                '%' . $_POST['search']['value'] . '%', '%' . $_POST['search']['value'] . '%'));
        }
//        else
//        {
//            $q = $this->db->query($query);
//        }
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
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = $row->visa_number;
            $sub_array[] = $row->worker_name_in_english;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->representative_name;
            $sub_array[] = $row->agent_name;
            $sub_array[] = '<a href="'.site_url('services_entry/processing?searched_value=' . $row->contract_number).'"><i class="glyphicon glyphicon-cog"></i></a>';
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



    public function get_canceled_contracts()
    {
        $sql = "
        select 
      services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.passport_number,             
        services_finance.remains_money,
          services_customer.* , representatives.name AS representative_name, contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic AS job_name_arabic, staff.username AS agent_name,
                          cancelled_contracts.*
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
INNER JOIN cancelled_contracts ON cancelled_contracts.contract_number = services_contract.contract_number
        ";

        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_cancel_delegation_contracts()
    {
        $sql = "
        select 
      services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.passport_number,             
        services_finance.remains_money,
          services_customer.* , representatives.name AS representative_name, contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
                          , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic AS job_name_arabic, staff.username AS agent_name
                          
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
WHERE services_order.order_type_id = 5
ORDER BY contract.contract_number DESC
        ";

        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }

}