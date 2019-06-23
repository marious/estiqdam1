<?php
class Customer_model extends MY_Model
{
    protected $table_name = 'customers';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'customer_name',
            'label' => 'lang:customer_name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => 'trim|valid_email',
        ],
        [
            'field' => 'opening_balance',
            'label' => 'lang:opening_balance',
            'rules' => 'trim|numeric',
        ],
    ];


    public function add($data, $id = false)
    {
        $dateStamp = null;
        if (isset($data['balance_date']) && $data['balance_date'] != '')
        {
            $dateObj = \DateTime::createFromFormat('d/m/Y', $data['balance_date']);
            $dateStamp = date("Y-m-d H:i:s", $dateObj->getTimestamp());
        }

        $data = [
            'title' => $data['customer_name'],
            'branch_id' => $data['branch_id'],
            'status' => $data['status'],
            'tel' => $data['telephone'],
            'mobile' => $data['mobile'],
            'fax' => $data['fax'],
            'email' => $data['email'],
            'work_address' => $data['work_address'],
            'home_address' => $data['home_address'],
            'tax_record_no' => $data['tax_record_no'],
            'customer_level' => $data['customer_level'],
            'sell_price_type' => $data['price_type'],
            'customer_type' => $data['customer_type'],
            'notes' => $data['notes'],
            'start_balance' => $data['start_balance'],
            'balance_type' => $data['balance_type'],
            'balance_date' => $dateStamp,
        ];

        $this->db->set($data);

        if ($id == false)
        {
            $this->db->insert('customers');
            $id = $this->db->insert_id();
        }
        else
        {
            $this->db->where('id', $id);
            $this->db->update('customers');
        }

        return $id;

    }


    public function get_all()
    {
        // For ordering
        $columns = [];

        $query = "SELECT * FROM customers";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= " WHERE title LIKE ? ";
        }

        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
                $_POST['order'][0]['dir'] . ' ';
        }
        else {
            $query .= ' ORDER BY id  ';
        }

        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        if (isset($_POST['search']['value']))
        {
            $search_value = trim($_POST['search']['value']);
            $binds[] =  '%' . $search_value . '%';
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

        $number_filter_row = $q2->num_rows();
        $data = [];
        $i = 1;

        foreach ($q->result() as $row) {
            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = $row->title;
            $sub_array[] = $row->mobile;
            $sub_array[] = '<div class="manage-buttons">' . draw_actions_button(site_url('customers/edit/' . $row->id), site_url('customers/delete/'.$row->id), 'customers') . '</div>';
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_customers_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }


    public function get_customers_count()
    {
        $query = "SELECT * FROM customers";
        $q = $this->db->query($query);
        return $q->num_rows();
    }
}