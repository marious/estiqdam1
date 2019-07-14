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
        $this->load->library('datatable');
        $this->datatable->setQuery('SELECT * FROM customers');
        $this->datatable->setSearchedValues(['title']);
        $result = $this->datatable->getResult();
        $i = 1;
        $data = [];
        foreach ($result as $row) {
            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = $row->title;
            $sub_array[] = $row->mobile;
            $sub_array[] = '<div class="manage-buttons">' . draw_actions_button(site_url('customers/edit/' . $row->id), site_url('customers/delete/'.$row->id), 'customers') . '</div>';
            $data[] = $sub_array;
            $i++;
        }
        $count = $this->get_customers_count();
        echo $this->datatable->output($data, $count);
    }





    public function get_customers_count()
    {
        $query = "SELECT * FROM customers";
        $q = $this->db->query($query);
        return $q->num_rows();
    }



    public function search($search_keyword, $value, $limit = false)
    {
        $query = 'SELECT * FROM customers WHERE ' . $search_keyword . ' LIKE ?';
        if ($limit) {
            $query .= ' LIMIT ' . $limit;
        }
        $query = $this->db->query($query, ['%'.$value.'%']);
        if ($query->num_rows()){
            return $query->result();
        }
        return [];
    }
}