<?php 

class Agent_model extends MY_Model
{
    protected $table_name = 'staff';

	public $rules = [
        [
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'password_confirm',
            'label' => 'lang:password_confirm',
            'rules' => 'trim|required|matches[password]',
        ],
        [
            'field' => 'user_language',
            'label' => 'lang:default_language',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'representative_id',
            'label' => 'lang:representative',
            'rules' => 'trim|required',
        ],
    ];



    public function get_rules_without_password()
    {
        return [
            [
                'field' => 'username',
                'label' => 'lang:username',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'user_language',
                'label' => 'lang:default_language',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'representative_id',
                'label' => 'lang:representative',
                'rules' => 'trim|required',
            ],
        ];
    }


	public function get_agents()
    {
        $sql = "SELECT staff.*, worker_nationality.country_name_in_arabic FROM 
                staff
                INNER JOIN worker_nationality
                ON worker_nationality.id = staff.nationality_id 
                WHERE staff.access_id NOT IN (1,2,3)";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }



    public function get_agent($agent_id)
    {
        $sql = "SELECT staff.*, worker_nationality.country_name_in_arabic 
                FROM staff 
                INNER JOIN worker_nationality 
                ON worker_nationality.id = staff.nationality_id
                WHERE staff.access_id = 4 
                AND staff.id = ?";
        $query = $this->db->query($sql, array($agent_id));
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }



    public function save_agent_representative($agent_id, $representative_id)
    {
        $sql = "SELECT * FROM agent_representative WHERE agent_id = ?";
        $query = $this->db->query($sql, array($agent_id));
        if ($query->num_rows())
        {
            $sql1 = "UPDATE agent_representative SET representative_id = ? WHERE agent_id = ?";
            $this->db->query($sql1, array($representative_id, $agent_id));
        }
        else
        {
            $sql1 = 'INSERT INTO agent_representative(agent_id, representative_id) 
                    VALUES(?, ?)';
            $this->db->query($sql1, array($agent_id, $representative_id));
        }
    }


    public function get_agent_representative($agent_id = false)
    {
        if ($agent_id)
        {
            $sql = 'SELECT * FROM agent_representative WHERE agent_id = ? LIMIT 1';
            $query = $this->db->query($sql, array($agent_id));
            if ($query->num_rows())
            {
                return $query->row();
            }
            return false;
        }

        return false;
    }

}