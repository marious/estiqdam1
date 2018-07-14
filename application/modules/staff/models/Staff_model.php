<?php

class Staff_model extends MY_Model
{
    protected $table_name = 'staff';


    public $rules = [
        [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[2]|callback__unique_username',
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[4]'
        ],
        [
            'field' => 'password_confirm',
            'label' => 'password_confirm',
            'rules' => 'trim|required|matches[password]',
        ],
        [
            'field' => 'access_id',
            'label' => 'lang:user_type',
            'rules' => 'trim|required',
        ]
    ];


    public function get_rules()
    {
        return $this->rules;
    }


    public function get_rules_without_password()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|min_length[2]|callback__unique_username',
            ],
            [
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password_confirm',
                'label' => lang('password_confirm'),
                'rules' => 'trim|required|matches[password]',
            ],
            [
                'field' => 'access_id',
                'label' => 'lang:user_type',
                'rules' => 'trim|required',
            ],
        ];
    }


    public function get_staff_rules()
    {
        return [
            [
                'field' => 'username',
                'label' => lang('username'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password_confirm',
                'label' => lang('password_confirm'),
                'rules' => 'trim|required|matches[password]',
            ],
            [
                'fields' => 'user_language',
                'label' => lang('default_language'),
                'rules' => 'trim|required',
            ],
        ];
    }


    public function get_agent_rules()
    {
        return [
            [
                'field' => 'username',
                'label' => lang('username'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password_confirm',
                'label' => lang('password_confirm'),
                'rules' => 'trim|required|matches[password]',
            ],
            [
                'field' => 'user_language',
                'label' => lang('default_language'),
                'rules' => 'trim|required',
            ],
        ];
    }

    public function get_customer_rules()
    {
        return [
            [
                'field' => 'username',
                'label' => lang('username'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'customer_name_in_arabic',
                'label' => lang('customer_name_in_arabic'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'customer_name_in_english',
                'label' => lang('customer_name_in_english'),
                'rules' => 'trim|required',
            ], [
                'field' => 'customer_nationality_id',
                'label' => lang('customer_nationality'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'customer_id',
                'label' => lang('customer_id'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'visa_number',
                'label' => lang('visa_number'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'visa_date',
                'label' => lang('visa_date'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'customer_mobile',
                'label' => lang('customer_mobild'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password',
                'label' => lang('password'),
                'rules' => 'trim|required',
            ],
            [
                'field' => 'password_confirm',
                'label' => lang('password_confirm'),
                'rules' => 'trim|required|matches[password]',
            ],
            [
                'field' => 'access_id',
                'label' => 'lang:access_id',
                'rules' => 'trim|required',
            ]
        ];
    }


    public function get_user_access_levels()
    {
        return $this->db->get('user_access')->result();
    }


    public function get_staff()
    {
        $this->db->select('staff.*, user_access.access');
        $this->db->where('access_id', 2);
        $this->db->or_where('access_id', 1);
        $this->db->from($this->table_name);
        $this->db->join('user_access', 'user_access.id = staff.access_id');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }



    public function do_login($username, $password)
    {
        $this->db->select('staff.*, user_access.access');
        $this->db->from($this->table_name);
        $this->db->join('user_access', 'user_access.id = staff.access_id');
//        $this->db->join('permissions', 'permissions.user_id = staff.id');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if (count($user))
        {
            if (password_verify($password, $user->password))
            {
                // User is authnticated make login lets build our session data 
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user->username;
                $_SESSION['id'] = $user->id;
                $_SESSION['access_id'] = $user->access_id;
                $permission_query = $this->db->get_where('permissions', array('user_id' => $user->id));
                $permission = $permission_query->row();
                if ($permission && count($permission)) {
                    $_SESSION['permission_role'] = $permission->role;
                } else {
                    $_SESSION['permission_role'] = 'user';
                }
                if (isset($user->user_language))
                {
                    $_SESSION['user_language'] = $user->user_language;
                }
                return $user;
            }
        }

        return false;

    }


    public function do_login_customer($customer_name, $password)
    {
        $this->db->select('staff.*');
        $this->db->where('staff.access_id', 3);
        $this->db->from($this->table_name);
        $this->db->join('user_access', 'user_access.id = staff.access_id');
        $this->db->where('username', $customer_name);
        $query = $this->db->get();
        $user = $query->row();

        if (count($user))
        {
            if (password_verify($password, $user->password))
            {
                // User is authnticated make login lets build our session data
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user->username;
                $_SESSION['id'] = $user->id;
                $_SESSION['access_id'] = $user->access_id;
                if (isset($user->user_language))
                {
                    $_SESSION['user_language'] = $user->user_language;
                }
                return $user;
            }
        }

        return false;

    }



    public function logout()
    {
        log_message('custom', 'User: ' . $_SESSION['username'] . ' has been logout at '  . date('Y-m-d H:i'));
        session_destroy();
    }


    public function save_user_staff($data)
    {
        $data = [
            'username'          => $data['username'],
            'password'          => $data['password'],
            'user_language'     => $data['user_language'],
            'access_id'         => $data['access_id']
        ];

        $this->db->set($data);
        $this->db->insert('staff');
        $id = $this->db->insert_id();
        return $id;

    }


    public function save_user_agent($data, $id = false)
    {
        $data = [
            'username'          => $data['username'],
            'password'          => $data['password'],
            'user_language'     => $data['user_language'],
            'nationality_id'    => $data['nationality_id'],
            'access_id'         => $data['access_id'],
        ];

        $this->db->set($data);
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('staff');
            return $id;
        }
        $this->db->insert('staff');
        $id = $this->db->insert_id();
        return $id;
    }


    public function save_user_customer($data)
    {
        $data = [
            'customer_name_in_english'      => $data['customer_name_in_english'],
            'customer_name_in_arabic'       => $data['customer_name_in_arabic'],
            'customer_id'                   => $data['customer_id'],
            'visa_number'                   => $data['visa_number'],
            'visa_date'                     => $data['visa_date'],
            'customer_mobile'               => $data['customer_mobile'],
            'customer_nationality_id'       => $data['customer_nationality_id'],
            'password'                      => $data['password'],
        ];

        $this->db->set($data);
        $this->db->insert('services_customer');
        $id = $this->db->insert_id();
        return $id;

    }



}