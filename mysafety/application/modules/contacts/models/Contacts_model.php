<?php

class Contacts_model extends MY_Model
{
    protected $table_name= 'contact_messages';

    public $rules = [
        [
            'field' => 'name',
            'label' => 'lang:name',
            'rules' => 'trim|required|max_length[50]',
        ],
        [
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => 'trim|required|valid_email',
        ],
        [
            'field' => 'phone',
            'label' => 'lang:contact_phone',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'subject',
            'label' => 'lang:subject',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'message',
            'label' => 'lang:message',
            'rules' => 'trim|required|max_length[255]',
        ]
    ];

    public function get_all()
    {
        // for ordering
        $columns[5] = 'contact_messages.created_at';

        $query = "SELECT contact_messages.* from contact_messages";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE contact_messages.name LIKE ? ';
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
            $sub_array =[];
            $sub_array[] = $i;
            $sub_array[] = $row->name;
            $sub_array[] = $row->email;
            $sub_array[] = $row->subject;
            $sub_array[] = $row->message;
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button('', site_url('contacts/delete/'.$row->id), 'contacts');
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_contacts_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }

    public function get_contacts_count()
    {
        $query = "SELECT * FROM contact_messages";
        $q = $this->db->query($query);
        return $q->num_rows();
    }
}