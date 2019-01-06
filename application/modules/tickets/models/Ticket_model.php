<?php

class Ticket_model extends MY_Model
{

    public function get_data()
    {
        $columns = [
            'agent_worker.first_name',
            'agent_worker.sur_name',
            'services_customer.customer_name_in_arabic',
            'representative_name',
            'agent_name',
            'agent_worker.date_of_birth',
            'passport_number',
            'agent_worker.date_of_expiry',
            'departure_airport',
            'arrived_airport',
        ];

        $query = 'SELECT 
        agent_worker.first_name,
        agent_worker.sur_name,
        agent_worker.date_of_birth,
        agent_worker.date_of_expiry,
        services_worker.contract_number,
        services_worker.passport_number,             
        services_customer.customer_name_in_arabic , 
        representatives.name AS representative_name, 
        contract.contract_date, 
        services_contract.*, 
        staff.username AS agent_name,
        arrival_airports.name_in_arabic AS arrival_airport,
        departure_airports.name_in_arabic AS departure_airport
        FROM services_worker
        INNER JOIN 	services_contract ON services_worker.contract_number = 	services_contract.contract_number
        INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
        INNER JOIN representatives ON services_contract.representative_id = representatives.id
        INNER JOIN contract ON services_worker.contract_number = contract.contract_number
        INNER JOIN staff ON services_worker.agent_id = staff.id
        INNER JOIN agent_worker ON services_worker.passport_number = agent_worker.passport_number
        INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
        INNER JOIN departure_airports ON agent_worker.departure_airport = departure_airports.id
        WHERE services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
        ';

        $query .= " AND (services_contract.arrived_date IS NULL OR  TRIM(services_contract.arrived_date) LIKE '' )
                AND (NOT services_contract.stamp_date IS NULL OR TRIM(services_contract.stamp_date) LIKE '' )
            ";




        $binds = [];


        if (  (isset($_POST['is_representative']) && $_POST['is_representative'] != '' && $_POST['is_representative'] != 'false') && (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '') )
        {
            $query .= ' AND representatives.id = ? AND staff.id = ? AND ';
        }

        else if (isset($_POST['is_representative']) && $_POST['is_representative'] != 'false' && $_POST['is_representative'] != '')
        {
            $query .= ' AND representatives.id = ? AND ';
        }

        else if (isset($_POST['is_agent']) && $_POST['is_agent'] != 'false' && $_POST['is_agent'] != '')
        {
            $query .= ' AND staff.id = ? AND ';
        }

        if (isset($_POST['search']['value']) && $_POST['search']['value'] != '')
        {
            $query .=  ' AND (customer_name_in_arabic LIKE ? ';
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

        if (isset($_POST['search']['value']) && $_POST['search']['value'] != '')
        {
            $binds[] =  '%' . $_POST['search']['value'] . '%';
            $binds[] =  '%' . $_POST['search']['value'] . '%';
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
            $sub_array[] = $row->first_name;
            $sub_array[] = $row->sur_name;
            $sub_array[] = $row->customer_name_in_arabic;
            $sub_array[] = $row->representative_name;
            $sub_array[] = $row->agent_name;
            $sub_array[] = $row->passport_number;
            $sub_array[] = $row->date_of_expiry;
            $sub_array[] = $row->departure_airport;
            $sub_array[] = $row->arrival_airport;
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


    public function get_tickets()
    {
        $query = 'SELECT 
        agent_worker.first_name,
        agent_worker.sur_name,
        agent_worker.date_of_birth,
        agent_worker.date_of_expiry,
        services_worker.contract_number,
        services_worker.passport_number,             
        services_customer.customer_name_in_arabic , 
        representatives.name AS representative_name, 
        contract.contract_date, 
        services_contract.*, 
        staff.username AS agent_name,
        arrival_airports.name_in_arabic AS arrival_airport,
        departure_airports.name_in_arabic AS departure_airport
        FROM services_worker
        INNER JOIN 	services_contract ON services_worker.contract_number = 	services_contract.contract_number
        INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
        INNER JOIN representatives ON services_contract.representative_id = representatives.id
        INNER JOIN contract ON services_worker.contract_number = contract.contract_number
        INNER JOIN staff ON services_worker.agent_id = staff.id
        INNER JOIN agent_worker ON services_worker.passport_number = agent_worker.passport_number
        INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
        INNER JOIN departure_airports ON agent_worker.departure_airport = departure_airports.id
        INNER JOIN services_finance ON services_finance.contract_number = services_worker.contract_number
        WHERE services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
        ';

        $query .= " AND (services_contract.arrived_date IS NULL OR  TRIM(services_contract.arrived_date) LIKE '' )
                AND (NOT services_contract.stamp_date IS NULL OR TRIM(services_contract.stamp_date) LIKE '' )
                AND services_finance.recruitment_cost = services_finance.prepaid_money 
                AND services_finance.remains_money = 0
            ";

        $q = $this->db->query($query);
        if ($q->num_rows())
        {
            return $q->result();
        }
        return false;
    }






    public function get_agent_tickets($agent_id)
    {
        $query = 'SELECT 
        agent_worker.first_name,
        agent_worker.sur_name,
        agent_worker.date_of_birth,
        agent_worker.date_of_expiry,
        services_worker.contract_number,
        services_worker.passport_number,             
        services_customer.customer_name_in_arabic , 
        services_customer.customer_name_in_english , 
        representatives.name AS representative_name, 
        contract.contract_date, 
        services_contract.*, 
        staff.username AS agent_name,
        arrival_airports.name_in_english AS arrival_airport,
        departure_airports.name_in_arabic AS departure_airport
        FROM services_worker
        INNER JOIN 	services_contract ON services_worker.contract_number = 	services_contract.contract_number
        INNER JOIN services_customer ON services_worker.contract_number = services_customer.contract_number
        INNER JOIN representatives ON services_contract.representative_id = representatives.id
        INNER JOIN contract ON services_worker.contract_number = contract.contract_number
        INNER JOIN staff ON services_worker.agent_id = staff.id
        INNER JOIN agent_worker ON services_worker.passport_number = agent_worker.passport_number
        INNER JOIN arrival_airports ON services_worker.arrival_airport_id = arrival_airports.id
        INNER JOIN departure_airports ON agent_worker.departure_airport = departure_airports.id
        INNER JOIN services_finance ON services_finance.contract_number = services_worker.contract_number
        WHERE agent_worker.agent_id = ?
        AND services_contract.contract_number NOT IN (select contract_number from cancelled_contracts)
        ';

        $query .= " AND (services_contract.arrived_date IS NULL OR  TRIM(services_contract.arrived_date) LIKE '' )
                AND (NOT services_contract.stamp_date IS NULL OR TRIM(services_contract.stamp_date) LIKE '' )
            ";

        $q = $this->db->query($query, array($agent_id));
        if ($q->num_rows())
        {
            return $q->result();
        }
        return false;
    }


}