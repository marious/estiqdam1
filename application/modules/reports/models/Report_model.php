<?php

class Report_model extends MY_Model
{


    public function get_not_stamp()
    {
        $columns = [
            'services_customer.customer_name_in_arabic',
            'services_customer.visa_number',
            'services_worker.worker_name_in_english',
            'services_worker.passport_number',
            'agent_name',
            'representatives.name',
            'contract.contract_date',
        ];

        $query = $this->get_report_query();

        $query .= ' WHERE ((services_contract.stamp_date IS NULL) OR (TRIM(services_contract.stamp_date) LIKE ""))
                AND services_contract.delegation_date IS NOT NULL 
                AND services_contract.delegation_date <> ""
            AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
            AND services_order.order_type_id = 4
            AND representatives.id = 3
         ';

        $binds = [];
//        if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false')
//        {
//            $query .= ' AND representatives.id = ?  ';
//        }

        if (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false')
        {
            $query .= ' AND services_worker.worker_nationality_id = ?  ';
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' AND staff.id = ? ';
        }

//        if (isset($_POST['order']))
//        {
//            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
//                $_POST['order'][0]['dir'] . ' ';
//        }
//        else
//        {
//            $query .= ' ORDER BY contract.contract_number ASC';
//        }

        $query .= ' ORDER BY services_contract.delegation_date ASC ';

        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

//        if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false')
//        {
//            $binds[] = $_POST['is_representative'];
//        }

        if (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false')
        {
            $binds[] = $_POST['is_country'];
//            var_dump($_POST['is_country']);exit;
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
            $sub_array[] = $row->visa_number;
            if ($row->worker_name_in_english == '') {
                $sub_array[] = $row->worker_name_in_arabic;
            }  else {
                $sub_array[] = $row->worker_name_in_english;
            }
            $sub_array[] = $row->customer_id;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->agent_name;
            $sub_array[] = $row->country_name_in_arabic;
            $sub_array[] = $row->delegation_date;
            $num_days = '';
            if ($row->delegation_date != null || $row->delegation_date != '')
            {
                $now = time();
                $vd_date = strtotime($row->delegation_date);
                $date_diff = $now - $vd_date;
                $num_days = abs(floor($date_diff / (60 * 60 * 24))) . get_day_lang();
            }


            $sub_array[] = $num_days;
            $sub_array[] = '<a href="'.site_url("services_entry/processing?searched_value=" . $row->contract_number).'"><i class="glyphicon glyphicon-cog"></i></a>';
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


    public function get_not_arrived()
    {
        $columns = [
            'services_customer.customer_name_in_arabic',
            'services_customer.visa_number',
            'services_worker.worker_name_in_english',
            'services_worker.passport_number',
            'agent_name',
            'representatives.name',
            'services_contract.stamp_date',
        ];

        $query = $this->get_report_query();

      $query .= ' WHERE ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE ""))
                AND services_contract.stamp_date IS NOT NULL
                AND (TRIM(services_contract.stamp_date) != \'\')
                AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
                AND services_order.order_type_id = 4
                AND representatives.id = 3
       ';
        $binds = [];
        if (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false')
        {
            $query .= ' AND services_worker.worker_nationality_id = ?  ';
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false')
        {
            $query .= ' AND staff.id = ? ';
        }

        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
                $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY contract.contract_number ASC';
        }

        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false')
        {
            $binds[] = $_POST['is_country'];
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
            $sub_array[] = $row->visa_number;
            $sub_array[] = $row->worker_name_in_english;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->agent_name;
            $sub_array[] =  $row->country_name_in_arabic;
            $sub_array[] = $row->stamp_date;
            $now = time();
            $not_arrived_date = strtotime($row->stamp_date);
            $date_diff = $now - $not_arrived_date;
            $num_days = abs(floor($date_diff / (60 * 60 * 24))) . get_day_lang();
            $sub_array[] = $num_days;
            $sub_array[] = '<a href="'.site_url("services_entry/processing?searched_value=" . $row->contract_number).'"><i class="glyphicon glyphicon-cog"></i></a>';
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





    public function get_report_query()
    {
        $query = 'SELECT 
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
        staff.username AS agent_name,
        worker_nationality.country_name_in_arabic, worker_nationality.country_name_in_english
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
        INNER JOIN worker_nationality ON services_worker.worker_nationality_id = worker_nationality.id
        INNER JOIN staff ON services_worker.agent_id = staff.id';

        return $query;
    }


    public function get_arrived()
    {
        $columns = [
            'services_contract.contract_number',
            'services_contract.contract_date',
            'customer_name_in_arabic',
            'visa_number',
            'worker_name_in_english',
            'passport_number',
            'agent_name',
            'representative_name',
            'arrived_date',
        ];

        $query = $this->get_report_query();
        $query .= ' WHERE NOT ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE ""))
            AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
            AND services_order.order_type_id = 4
              AND representatives.id = 3
        ';
        $binds = [];

        if (  (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $query .= ' AND services_worker.worker_nationality_id = ? AND staff.id = ?  ';
        }

        else if (isset($_POST['is_country']) && $_POST['is_country'] != 'false' && $_POST['is_country'] != '')
        {
            $query .= ' AND services_worker.worker_nationality_id = ?  ';
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
            $query .= ' OR passport_number LIKE ?) ';
        }

//        if (isset($_POST['order']))
//        {
//            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
//                $_POST['order'][0]['dir'] . ' ';
//        }
//        else
//        {
//            $query .= ' ORDER BY contract.contract_number DESC';
//        }

        $query .= ' ORDER BY services_contract.arrived_date DESC ';
        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (  (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $binds[] = $_POST['is_country'];
            $binds[] = $_POST['is_agent'];
        }

        else if (isset($_POST['is_country']) && $_POST['is_country'] != 'false' && $_POST['is_country'] != '')
        {
            $binds[] = $_POST['is_country'];
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
//        if ($q->num_rows())
//        {
        $data = [];
        $number_filter_row = $q2->num_rows();
        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->contract_number;
            $sub_array[] = $row->contract_date;
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = $row->visa_number;
            $sub_array[] = $row->worker_name_in_english;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->agent_name;
            $sub_array[] = $row->country_name_in_arabic;
            $sub_array[] = date('Y-m-d', strtotime($row->arrived_date));
            $now = time();
            $vd_date = date('Y-m-d', strtotime($row->arrived_date));
            $date_diff = $now - strtotime($vd_date);
            $after_arrived = (floor($date_diff / (60 * 60 * 24))) . get_day_lang();
            $sub_array[] = $after_arrived;
            $sub_array[] = '<a href="'.site_url("services_entry/processing?searched_value=" . $row->contract_number).'"><i class="glyphicon glyphicon-cog"></i></a>';
            $data[] = $sub_array;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_contract_numbers(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }


    public function get_contract_numbers()
    {
        $query = "SELECT * FROM services_contract";
        $q = $this->db->query($query);
        return $q->num_rows();
    }



    public function get_searched_operations($search_for, $agent, $representative, $when)
    {
        if ($search_for == 'workers')
        {
            $query = 'SELECT agent_worker.*, agent_worker.id AS worker_id, staff.username, staff.id, agent_worker.id AS worker_id,
                  jobs.name_in_arabic AS job, customers.customer_name_in_arabic
                  FROM agent_worker 
                  INNER JOIN staff
                  ON agent_worker.agent_id = staff.id
                  INNER JOIN jobs 
                  ON jobs.id = agent_worker.job_id
                  LEFT JOIN customers 
                  ON customers.selected_worker_id = agent_worker.id WHERE 1 = 1';
            if ( !in_array($agent, array('1', '0')) )
            {
                $query .= ' AND agent_id =  ' . $agent;
            }

            if ($when != '')
            {
                $when_date = explode(' - ', $when);
                $start_date = date('Y-m-d', strtotime($when_date[0]));
                $end_date = date('Y-m-d', strtotime($when_date[1]));
                $query .= " AND agent_worker.created_at between '" . $start_date . "' AND '" . $end_date . "'";
            }

            $result = $this->db->query($query);
            if ($result->num_rows())
            {
                return $result->result();
            }

        }

        if ($search_for == 'customers')
        {
            $query = 'select services_worker.contract_number, services_customer.* , representatives.name AS representative_name, services_worker.worker_name_in_english,
                        contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
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
                    WHERE 1 = 1
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts) ';

                if (!in_array($agent, array('1', '0')))
                {
                    $query .= ' AND services_worker.agent_id =  ' . $agent;
                }

                if (!in_array($representative, array('1', '0')))
                {
                    $query .= ' AND representatives.id =  ' . $representative;
                }

            if ($when != '')
            {
                $when_date = explode(' - ', $when);
                $start_date = date('Y-m-d', strtotime($when_date[0]));
                $end_date = date('Y-m-d', strtotime($when_date[1]));
                $query .= " AND contract.contract_date between '" . $start_date . "' AND '" . $end_date . "' ORDER BY contract.contract_date ASC";
            }

            $result = $this->db->query($query);
            if ($result->num_rows())
            {
                return $result->result();
            }

        }

    }


    public function get_financial_search($agent, $representative, $when)
    {
        $query = 'select 
      services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.passport_number,             
        services_finance.*,
          services_customer.* , representatives.name AS representative_name, contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
             , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic             AS job_name_arabic, staff.username AS agent_name
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
            WHERE services_order.order_type_id = 4
            AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)';

        if ($representative != '')
        {
            $query .= ' AND representatives.id =  ' . $representative;
        }

        if ($agent != '')
        {
            $query .= ' AND services_worker.agent_id = ' . $agent;
        }

        if ($when != '')
        {
            $when_date = explode(' - ', $when);
            $start_date = date('Y-m-d', strtotime($when_date[0]));
            $end_date = date('Y-m-d', strtotime($when_date[1]));
            $query .= " AND contract.contract_date between '" . $start_date . "' AND '" . $end_date . "' ORDER BY contract.contract_date ASC";
        }

        $result = $this->db->query($query);
        if ($result->num_rows())
        {
            return $result->result();
        }


    }



    public function get_recruitment_count($when, $representative)
    {
        if ($when != '')
        {
            $when_date = explode(' - ', $when);
            $start_date = date('Y-m-d', strtotime($when_date[0]));
            $end_date = date('Y-m-d', strtotime($when_date[1]));
            if ($representative == '')
            {
                $query = "SELECT COUNT(contract.contract_number) AS recruitment_count,
                      SUM(services_finance.prepaid_money) AS finance_prepaid_money, SUM(services_finance.remains_money) AS finance_remains_money,
                      SUM(recruitment_cost) AS finance_recruitment_cost
                    FROM contract
                    INNER JOIN services_order 
                    ON services_order.contract_number = contract.contract_number
                    INNER JOIN services_finance
                    ON services_finance.contract_number = contract.contract_number
                    WHERE contract_date BETWEEN '{$start_date}' AND '{$end_date}'
                    AND services_order.order_type_id = 4
                    AND contract.created_at NOT IN (select contract_number from cancelled_contracts)
                    
                    ";
            }
            else
            {
                $query = "SELECT COUNT(contract.contract_number) AS recruitment_count,
                    SUM(services_finance.prepaid_money) AS finance_prepaid_money, SUM(services_finance.remains_money) AS finance_remains_money,
                    SUM(recruitment_cost) AS finance_recruitment_cost
                    FROM contract
                    INNER JOIN services_order 
                    ON services_order.contract_number = contract.contract_number
                    INNER JOIN services_contract 
                    ON services_contract.contract_number = contract.contract_number
                    INNER JOIN services_finance
                    ON services_finance.contract_number = contract.contract_number
                    WHERE contract.created_at BETWEEN '{$start_date}' AND '{$end_date}'
                    AND services_order.order_type_id = 4
                    AND services_contract.representative_id = $representative
                   AND contract.contract_number NOT IN (select contract_number from cancelled_contracts)
                    ";
            }
           $result = $this->db->query($query);
           if ($result->num_rows())
           {
               return $result->row();
           }
        }
    }


    public function get_recruitment_details($when, $representative)
    {
        if ($when != '')
        {
            $when_date = explode(' - ', $when);
            $start_date = date('Y-m-d', strtotime($when_date[0]));
            $end_date = date('Y-m-d', strtotime($when_date[1]));
            if ($representative == '')
            {
                $query = "select services_worker.worker_nationality_id, COUNT(*) AS count_recruitment, worker_nationality.nationality_in_arabic, services_order.order_type_id, contract.contract_date,
                      SUM(services_finance.prepaid_money) AS finance_prepaid_money, SUM(services_finance.remains_money) AS finance_remains_money,
                      SUM(recruitment_cost) AS finance_recruitment_cost
                    FROM services_worker
                    INNER JOIN worker_nationality
                    ON worker_nationality.id = services_worker.worker_nationality_id
                    INNER JOIN services_order
                    ON services_order.contract_number = services_worker.contract_number
                    INNER JOIN contract 
                    ON contract.contract_number = services_worker.contract_number
                    INNER JOIN services_finance
                    ON services_finance.contract_number = services_worker.contract_number
                    where services_order.order_type_id = 4
                    AND (contract.created_at BETWEEN '{$start_date}' AND '{$end_date}')
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
                    GROUP BY services_worker.worker_nationality_id";
            }
            else
            {
                $query = "select services_worker.worker_nationality_id, COUNT(*) AS count_recruitment, worker_nationality.nationality_in_arabic, services_order.order_type_id, contract.contract_date,
                        SUM(services_finance.prepaid_money) AS finance_prepaid_money, SUM(services_finance.remains_money) AS finance_remains_money,
                        SUM(recruitment_cost) AS finance_recruitment_cost
                    FROM services_worker
                    INNER JOIN worker_nationality
                    ON worker_nationality.id = services_worker.worker_nationality_id
                    INNER JOIN services_order
                    ON services_order.contract_number = services_worker.contract_number
                    INNER JOIN contract 
                    ON contract.contract_number = services_worker.contract_number
                    INNER JOIN services_contract
                    ON services_contract.contract_number = services_worker.contract_number
                    INNER JOIN services_finance
                    ON services_finance.contract_number = services_worker.contract_number
                    where services_order.order_type_id = 4
                    AND (contract.created_at BETWEEN '{$start_date}' AND '{$end_date}')
                    AND services_contract.representative_id = $representative
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
                    GROUP BY services_worker.worker_nationality_id";
            }

            $result = $this->db->query($query);
            if ($result->num_rows())
            {
                return $result->result();
            }
        }
    }


    public function get_details_advanced_reports($nationality_id, $when, $representative = '')
    {
        $when_date = explode(' - ', $when);
        $start_date = date('Y-m-d', strtotime($when_date[0]));
        $end_date = date('Y-m-d', strtotime($when_date[1]));

        $query = "
            SELECT services_worker.worker_name_in_english, services_customer.customer_name_in_arabic,
            services_customer.customer_mobile, services_finance.prepaid_money, services_finance.remains_money, services_contract.representative_id,
            worker_nationality.nationality_in_arabic, representatives.name, contract.contract_number, contract.contract_date, staff.username
            FROM services_worker
            INNER JOIN services_customer
            ON services_customer.contract_number = services_worker.contract_number
            INNER JOIN services_finance 
            ON services_finance.contract_number = services_worker.contract_number
            INNER JOIN contract 
            ON contract.contract_number = services_worker.contract_number
            INNER JOIN services_order 
            ON services_order.contract_number = services_worker.contract_number
            INNER JOIN worker_nationality 
            ON worker_nationality.id = services_worker.worker_nationality_id
            INNER JOIN services_contract
            ON services_worker.contract_number = services_contract.contract_number
            INNER JOIN representatives
            ON services_contract.representative_id = representatives.id
            INNER JOIN staff 
            ON staff.id = services_worker.agent_id
            WHERE services_worker.worker_nationality_id = $nationality_id 
            AND (contract.created_at BETWEEN '{$start_date}' AND '$end_date')
              AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
            AND services_order.order_type_id = 4
        ";

        if ($representative != '') {
            $query .= " AND services_contract.representative_id = $representative";
        }

        $result = $this->db->query($query);
        if ($result->num_rows()) {
            return $result->result();
        }
    }




    public function get_num_of_contracts()
    {
        $query = "SELECT COUNT(contract.contract_number) AS recruitment_count,
                    SUM(services_finance.prepaid_money) AS finance_prepaid_money, SUM(services_finance.remains_money) AS finance_remains_money,
                    SUM(recruitment_cost) AS finance_recruitment_cost
                    FROM contract
                    INNER JOIN services_order 
                    ON services_order.contract_number = contract.contract_number
                    INNER JOIN services_contract 
                    ON services_contract.contract_number = contract.contract_number
                    INNER JOIN services_finance
                    ON services_finance.contract_number = contract.contract_number
                    WHERE contract.created_at BETWEEN ? AND ?
                    AND services_order.order_type_id = 4
                    AND services_contract.representative_id = 3
                    AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)";


        $current_year = date('Y');
        $months = [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $num_of_contracts = [];

        foreach ($months as $key => $month) {
            if ($key < 10) {$key = '0' . $key;}
            $number_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $key, $current_year);
            $q = $this->db->query($query, array($current_year . '-' . $key . '-' . '01',
                $current_year . '-' . $key . '-' . $number_of_days_in_month));
            // $arr = array($current_year . '-' . $key . '-' . '01', $current_year . '-' . $key . '-' . $number_of_days_in_month);
            // var_dump($arr);
            $num_of_contracts[] = $q->row()->recruitment_count;
        }
        return json_encode($num_of_contracts);
    }



    public function get_num_of_workers()
    {
        $query = "SELECT COUNT(agent_worker.id) AS count_workers from agent_worker WHERE created_at BETWEEN ? AND ?";

        $current_year = date('Y');
        $months = [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $num_of_workers = [];


        foreach ($months as $key => $month) {
            if ($key < 10) {$key = '0' . $key;}
            $number_of_days_in_month = cal_days_in_month(CAL_GREGORIAN, $key, $current_year);
            $start_date = $current_year . '-' . $key . '-' . '01' . ' 00:00:00.000000';
            $end_date = $current_year . '-' . $key . '-' . $number_of_days_in_month . ' 00:00:00.000000';
            $q = $this->db->query($query, array($start_date, $end_date));
            $num_of_workers[] = $q->row()->count_workers;
        }
        return json_encode($num_of_workers);
    }


}