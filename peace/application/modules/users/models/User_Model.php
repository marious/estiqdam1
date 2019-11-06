<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends MY_Model
{
    protected $table_name = 'users';

    public $rules = [
        [
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[2]|callback__unique_username',
        ],
        [
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => 'trim|required|valid_email|callback__unique_email',
        ],
        [
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[4]',
        ],
        [
            'field' => 'conf_password',
            'label' => 'lang:conf_password',
            'rules' => 'trim|required|matches[password]',
        ],
        [
            'field' => 'role_group[]',
            'label' => 'lang:role_group',
            'rules' => 'required|callback__verify_role_group',
        ]
    ];



    public function rules_without_password()
    {
        $rules = $this->User_Model->rules;
        $id = array_search('password', array_column($rules, 'field'));
        $id2 = array_search('conf_password', array_column($rules, 'field'));
        unset($rules[$id], $rules[$id2]);
        $rules[] =  [
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|min_length[4]',
        ];
        $rules[] = [
            'field' => 'conf_password',
            'label' => 'lang:conf_password',
            'rules' => 'trim|matches[password]',
        ];
        return $rules;
    }


    public function get_all_groups()
    {
        $query = 'SELECT * FROM groups';
        $q = $this->db->query($query);
        return $q->result();
    }


    public function get_all_users()
    {
        // for ordering
        $columns[0] = 'users.id';
        $columns[4] = 'users.created_at';
        $query = "SELECT * FROM users";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE username LIKE ? ';
            $query .= ' OR email LIKE ? ';
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
        foreach ($q->result() as $row) {
            $sub_array =[];
            $sub_array[] = $row->id;
            $sub_array[] = $row->username;
            $sub_array[] = $row->email;
            $sub_array[] = $this->ion_auth->get_users_groups($row->id)->row()->name;
            $sub_array[] = date('j M Y h:i a', $row->created_on);
//            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button(site_url('users/edit/' . $row->id), site_url('users/delete/'.$row->id), 'users');
            $data[] = $sub_array;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_users_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }

    public function get_users_count()
    {
        $query = "SELECT * FROM users";
        $q = $this->db->query($query);
        return $q->num_rows();
    }
}