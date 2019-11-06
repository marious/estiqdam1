<?php
class Bank_model extends MY_Model
{
    protected $table_name = 'accounts';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'account_title',
            'label' => 'lang:account_title',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'balance',
            'label' => 'lang:balance',
            'rules' => 'trim|numeric',
        ],
        [
            'field' => 'account_number',
            'label' => 'lang:account_number',
            'rules' => 'trim',
        ],

        [
            'field' => 'branch',
            'label' => 'lang:branch',
            'rules' => 'trim',
        ],


        [
            'field' => 'description',
            'label' => 'lang:description',
            'rules' => 'trim',
        ],



    ];


    public function get_all_banks()
    {
        $columns = [];

        $query = "SELECT * FROM accounts";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= " WHERE account LIKE ? ";
            $query .= " OR branch LIKE ? ";
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
            $currency = $this->db->get_where('currencies', ['id' => $row->currency])->row();
            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = $row->account;
            $sub_array[] = $row->balance;
            $sub_array[] = $currency->name ? $currency->name : '';
            $sub_array[] = $row->account_number;
            $sub_array[] = $row->branch;
            $sub_array[] = '<div class="manage-buttons">' . draw_actions_button(site_url('banks/edit/' . $row->id), site_url('banks/delete/'.$row->id), 'banks') . '</div>';
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_banks_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }


    public function get_banks_count()
    {
        $query = "SELECT * FROM accounts";
        $q = $this->db->query($query);
        return $q->num_rows();
    }
    
}