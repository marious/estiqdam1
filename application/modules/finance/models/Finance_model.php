<?php

class Finance_model extends MY_Model
{

    protected $table_name = 'finance_operations';


    public function get_not_paid_customers()
    {
        $columns = [
            'services_customer.customer_name',
            'contract.contract_date',
            'services_customer.customer_mobile',
            'representative_name',
            'services_finance.recruitment_cost',
            'services_finance.prepaid_money',
            'services_finance.remains_money',
        ];

        $query = 'select 
      services_worker.contract_number,
        services_worker.worker_name_in_english,                
        services_worker.passport_number,             
        services_finance.*,
          services_customer.* , worker_nationality.country_name_in_arabic, worker_nationality.country_name_in_english, contract.contract_date, services_finance.credit_card_id, credit_card.credit_card, 	services_contract.* 
                          ,visa_issued_city.city, services_order.order_number, order_types.name_in_english AS order_name_english
             , order_types.name_in_arabic AS order_name_arabic, jobs.name_in_english AS job_name_english, jobs.name_in_arabic             AS job_name_arabic, staff.username AS agent_name
            FROM services_worker
            INNER JOIN 	services_contract ON services_worker.contract_number = 	services_contract.contract_number
            INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
            INNER JOIN representatives ON services_contract.representative_id = representatives.id
            INNER JOIN worker_nationality ON services_worker.worker_nationality_id = worker_nationality.id
            INNER JOIN visa_issued_city ON services_worker.visa_issued_city_id = visa_issued_city.id
            INNER JOIN services_order ON services_worker.contract_number = services_order.contract_number
            INNER JOIN order_types ON services_order.order_type_id = order_types.id
            INNER JOIN jobs ON services_worker.job_id = jobs.id
            INNER JOIN services_finance ON services_worker.contract_number = services_finance.contract_number
            INNER JOIN credit_card ON services_finance.credit_card_id = credit_card.id
            INNER JOIN contract ON services_worker.contract_number = contract.contract_number
            INNER JOIN staff ON services_worker.agent_id = staff.id 
            WHERE services_finance.remains_money != 0 AND services_order.order_type_id = 4
            AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
            AND representatives.id = 3
            ';

        $binds = [];

        if (isset($_POST['is_country']) && $_POST['is_country'] != '' && $_POST['is_country'] != 'false')
        {
            $query .= ' AND services_worker.worker_nationality_id = ?  ';
        }

        if (isset($_POST['contract_date']) && $_POST['contract_date'] != '' && $_POST['contract_date'] != 'false')
        {
            $query .= ' AND contract.contract_date ' . $_POST['contract_date'];
        }



        if (isset($_POST['search']['value']))
        {
            $query .=  ' AND (customer_name_in_arabic LIKE ? ';
            $query .= ' OR customer_mobile LIKE ? ) ';
        }


        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
                $_POST['order'][0]['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY contract.contract_date DESC';
        }


        $query1 = '';
        if ($_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['is_country']) && $_POST['is_country'] != 'false')
        {
            $binds[] = $_POST['is_country'];
        }


        if (isset($_POST['search']['value']))
        {
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
        $data = [];
        $number_filter_row = $q2->num_rows();

        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->contract_number;
            $sub_array[] = $row->contract_date;
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = $row->customer_mobile;
            $sub_array[] = $row->country_name_in_arabic;
            //$sub_array[] = calculate_after_tax_amount($row->recruitment_cost)['total'];
            $sub_array[] = $row->recruitment_cost;
            $sub_array[] = $row->prepaid_money;
            $sub_array[] = $row->remains_money;

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



    public function get_paid_customers()
    {
        $columns = [
            'services_customer.customer_name_in_arabic',
            'services_customer.mobile',
            'representative_name',
            'services_customer.visa_number',
            'services_customer.customer_id',
        ];

        $query = 'SELECT 
        services_worker.contract_number,
        services_worker.worker_name_in_english,                
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
        INNER JOIN staff ON services_worker.agent_id = staff.id';
    }






    public function get_all_arrived_contracts()
    {
        $columns = [
            'contract.contract_number',
            'services_worker.worker_name_in_english',
            'staff.username',
            'services_customer.customer_name_in_arabic',
            'arrived_date',
            '',
            ''
        ];

        $query = 'select services_worker.contract_number,
                            services_worker.worker_name_in_english,
                            services_worker.worker_name_in_arabic,
                            services_worker.agent_id,
                            services_worker.passport_number,
                            services_customer.customer_name_in_arabic , representatives.name AS representative_name, 
                            representatives.id, contract.*
                          ,services_contract.*,
                          staff.username AS agent_name,
                          agent_payment_note.note,
                          agents_payment_amount.total_payment,agents_payment_amount.first_payment,agents_payment_amount.second_payment
      FROM services_worker
      INNER JOIN services_contract ON services_worker.contract_number = 	services_contract.contract_number
      INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
      INNER JOIN representatives ON services_contract.representative_id = representatives.id
      INNER JOIN services_order ON services_worker.contract_number = services_order.contract_number
      INNER JOIN contract ON services_worker.contract_number = contract.contract_number
      INNER JOIN staff ON services_worker.agent_id = staff.id
      LEFT JOIN agents_payment_amount ON agents_payment_amount.contract_number = contract.contract_number
      LEFT JOIN agent_payment_note ON agent_payment_note.contract_number = contract.contract_number
';

        $query .= ' WHERE NOT ((services_contract.arrived_date IS NULL) OR (TRIM(services_contract.arrived_date) LIKE "")) AND ';

        $binds = [];

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $query .= ' staff.id = ? AND ';
        }

        if (isset($_POST['search']['value']))
        {
            $query .=  ' (customer_name_in_arabic LIKE ?) ';
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
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $binds[] = $_POST['is_agent'];
        }

        if (isset($_POST['search']['value']))
        {
            $binds[] =  '%' . $_POST['search']['value'] . '%';
        }


        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
            $num_rows = $q->num_rows(); // Temp
        }
        else
        {
            $q = $this->db->query($query, $binds);
            $num_rows = $q->num_rows();
        }

       // $q2 = $this->db->query($query, $binds);


        $data = [];
        $number_filter_row = $num_rows;
        foreach ($q->result() as $row)
        {
            $sub_array = [];
            $sub_array[] = $row->contract_number;
            $sub_array[] = $row->worker_name_in_english;
            $sub_array[] = $row->agent_name;
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = date('Y-m-d', strtotime($row->arrived_date));
            $checked = '';
            $checked_not_paid = '';
            if ($this->check_agent_payment($row->contract_number)) {
                $checked = 'checked';
            }
            if ($checked == '') {
                $checked_not_paid = 'checked';
            }

            $sub_array[] = '<input data-agent-id="'.$row->agent_id.'" data-contract-number="'.$row->contract_number.'" value="1" type="radio" name="payment_status'.$row->contract_number.'" id="paid'.$row->contract_number.'" data-action="insert" '.$checked.'>
            <label for="paid'.$row->contract_number.'"> دفع</label> 
                                     <input '.$checked_not_paid.' data-action="delete" data-agent-id="'.$row->agent_id.'" data-contract-number="'.$row->contract_number.'" value="0" type="radio" name="payment_status'.$row->contract_number.'" id="not_paid'.$row->contract_number.'"><label for="not_paid'.$row->contract_number.'"> لم يدفع</label>';

            $total_payment = 0;
            $first_payment = 0;
            $second_payment = 0;
            if ($row->total_payment) { $total_payment = $row->total_payment; }
            if ($row->first_payment) { $first_payment = $row->first_payment; }
            if ($row->second_payment) { $second_payment = $row->second_payment; }
            $sub_array[] = $total_payment;
            $sub_array[] = $first_payment;
            $sub_array[] = $second_payment;
            $sub_array[] = $total_payment - ($first_payment + $second_payment);


            $sub_array[] = $row->note . '<br>
                            <button type="button" name="update" data-contract-number="'.$row->contract_number.'" class="make-note btn btn-warning btn-xs">الملاحظة</button>
                            <button type="button" id="'.$row->contract_number.'" class="update-payment btn btn-success btn-xs">تحديث</button>
                            ';


            $data[] = $sub_array;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_num_contracts(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }



    public function get_num_contracts()
    {
        $query = $this->db->query("SELECT COUNT(*) AS num_contracts FROM contract");
        return $query->row()->num_contracts;
    }



    public function check_agent_payment($contract_number)
    {
        $this->db->where('contract_number', $contract_number);
        $query = $this->db->get('agents_payment');
        $row = $query->row();
        if ($row && count($row)) {
            return true;
        }
    }



    public function get_customer($visa_number = null)
    {
        $sql = "SELECT * FROM services_customer
                INNER JOIN services_order ON services_customer.contract_number = services_order.contract_number 
                WHERE visa_number = ? 
                AND services_customer.contract_number NOT IN (select contract_number from cancelled_contracts)
                AND services_order.order_type_id = 4
                ";
        $query = $this->db->query($sql, array($visa_number));
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }


    public function get_customer_by_contract_number($contract_number = null)
    {
        $sql = "SELECT * FROM services_customer
                INNER JOIN services_order ON services_customer.contract_number = services_order.contract_number 
                WHERE services_customer.contract_number = ? 
                AND services_customer.contract_number NOT IN (select contract_number from cancelled_contracts)
                AND services_order.order_type_id = 4
                ";
        $query = $this->db->query($sql, array($contract_number));
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }


    public function get_customer_payment($contract_number = null)
    {
        $sql = "SELECT * FROM services_finance WHERE contract_number = ?";
        $query = $this->db->query($sql, array($contract_number));
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }


    public function update_agent_payment_amount($data)
    {
        $inserted_data = [
            'total_payment' => $data['total_payment'],
            'second_payment' => $data['second_payment'],
            'first_payment' => $data['first_payment'],
        ];
        $row_exist = $this->db->get_where('agents_payment_amount', array('contract_number' => $data['contract_number']))->row();
        if ($row_exist && count($row_exist))
        {
            $this->db->set($inserted_data);
            $this->db->where('contract_number', $data['contract_number']);
            $this->db->update('agents_payment_amount');
        }
        else
        {
            $inserted_data['contract_number'] = $data['contract_number'];
            $this->db->set($inserted_data);
            $this->db->insert('agents_payment_amount');
        }
    }

}