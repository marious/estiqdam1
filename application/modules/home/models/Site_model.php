<?php

class Site_model extends MY_Model
{

    public function get_workers_by_search($search_array)
    {
        $sql = "SELECT agent_worker.*, agent_worker.id as worker_id,religions.arabic_religion as religion, jobs.name_in_arabic AS job,
                  jobs.name_in_english AS job_english
                  FROM agent_worker
                   INNER JOIN religions
                   ON religions.id = agent_worker.religion
                   INNER JOIN jobs ON agent_worker.job_id = jobs.id
                   INNER JOIN worker_nationality 
                   ON agent_worker.nationality_id = worker_nationality.id
                   WHERE accepted = '0'
                   AND hide = '0'
                    ";
        $search_keys = [];
        $search_values = [];
        foreach ($search_array as $key => $value)
        {
            if (isset($search_array[$key]) && $search_array[$key] != '')
            {
                if ($key == 'religion') {$key = 'agent_worker.religion';}
                $search_keys[] = $key;
                $search_values[] = $value;
            }
        }

        $search_query = '';
        foreach ($search_keys as $value) {
            $search_query .= ' AND ' . $value . ' = ?';
        }

        $sql .= $search_query;


        $query = $this->db->query($sql, $search_values);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_workers_by_country($country_name)
    {
        $sql = "SELECT agent_worker.id AS worker_id, name,image,first_name, date_of_birth, religions.arabic_religion as religion, religions.religion AS english_religion, jobs.name_in_arabic AS job,
jobs.name_in_english AS job_english, worker_nationality.id AS nationality_id
                  FROM agent_worker
                   INNER JOIN religions
                   ON religions.id = agent_worker.religion
                   INNER JOIN jobs ON agent_worker.job_id = jobs.id
                   INNER JOIN worker_nationality 
                   ON agent_worker.nationality_id = worker_nationality.id
                   WHERE accepted = '0'
                   AND hide = '0'
                   AND worker_nationality.country_name_in_arabic = ?
                   ORDER BY agent_worker.created_at DESC";
        $query = $this->db->query($sql, array($country_name));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_not_accepted_agent_workers()
    {
        $sql = "SELECT name,image,first_name, date_of_birth, religions.arabic_religion as religion, religions.religion AS english_religion, jobs.name_in_arabic AS job,
                  jobs.name_in_english AS job_english,
                  agent_worker.id as worker_id, agent_worker.nationality_id
                  FROM agent_worker
                   INNER JOIN religions
                   ON religions.id = agent_worker.religion
                   INNER JOIN jobs ON agent_worker.job_id = jobs.id
                   WHERE accepted = '0'
                   AND hide='0'
                   ORDER BY nationality_id DESC, agent_worker.created_at DESC
                   ";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_worker($worker_first_name)
    {
        if ($worker_first_name)
        {
            $sql = "SELECT agent_worker.*, religions.arabic_religion
                        AS religion, religions.religion as english_religion,
                        jobs.name_in_arabic AS job,
                        jobs.name_in_english AS job_english
                        FROM agent_worker 
                        INNER JOIN religions
                        ON religions.id = agent_worker.religion
                        INNER JOIN jobs ON jobs.id = agent_worker.job_id
                        WHERE accepted = '0'
                        AND agent_worker.hide = '0'
                ";
            if (is_numeric($worker_first_name)) {
                $condition = ' AND agent_worker.id = ? ';
            } else {
                $condition = ' AND agent_worker.first_name = ? ';
            }
            $query = $this->db->query($sql . $condition, array($worker_first_name));
            if ($query->num_rows())
            {
                return $query->row();
            }
            return false;
        }
    }



    public function get_accepted_worker($worker_first_name)
    {
        if ($worker_first_name)
        {
            $sql = "SELECT agent_worker.*, religions.arabic_religion
                        AS religion, religions.religion as english_religion,
                        jobs.name_in_arabic AS job,
                        jobs.name_in_english AS job_english
                        FROM agent_worker 
                        INNER JOIN religions
                        ON religions.id = agent_worker.religion
                        INNER JOIN jobs ON jobs.id = agent_worker.job_id
                        WHERE accepted = '1'
                        AND agent_worker.hide = '0'
                ";
            if (is_numeric($worker_first_name)) {
                $condition = ' AND agent_worker.id = ? ';
            } else {
                $condition = ' AND agent_worker.first_name = ? ';
            }
            $query = $this->db->query($sql . $condition, array($worker_first_name));
            if ($query->num_rows())
            {
                return $query->row();
            }
            return false;
        }
    }



    public function get_accepted_workers()
    {
        $sql = "SELECT name,image,first_name, date_of_birth, religions.arabic_religion as religion, religions.religion AS english_religion, jobs.name_in_arabic AS job,
                  jobs.name_in_english AS job_english,
                  agent_worker.id as worker_id
                  FROM agent_worker
                   INNER JOIN religions
                   ON religions.id = agent_worker.religion
                   INNER JOIN jobs ON agent_worker.job_id = jobs.id
                   WHERE accepted = '1'
                   AND hide='0'
                   ORDER BY agent_worker.created_at DESC
                   LIMIT 5
                   ";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function get_customer($customer_id)
    {
        $sql = 'SELECT customers.* FROM customers WHERE staff_id = ?';
        $query = $this->db->query($sql, [$customer_id]);
        if ($query->num_rows())
        {
            return $query->row();
        }
        return false;
    }


    public function get_worker_by_id($worker_id)
    {
        $worker = $this->db->get_where('agent_worker', array('id' => $worker_id));
        if ($worker->num_rows())
        {
            return $worker->row();
        }
        return false;
    }






    public function get_count_customer_fav($customer_id)
    {
        $sql = 'SELECT * from customer_fav WHERE customer_id = ?';
        $query = $this->db->query($sql, array($customer_id));
        if ($query->num_rows())
        {
            return count($query->result());
        }
        return 0;
    }

    public function get_customer_favorites($customer_id)
    {
        $sql = "SELECT customer_fav.*, customers.*, agent_worker.*,
                jobs.name_in_arabic AS job,
                jobs.name_in_english AS job_english
                FROM customer_fav
                INNER JOIN customers
                ON customers.staff_id = customer_fav.customer_id
                INNER JOIN agent_worker 
                ON agent_worker.id = customer_fav.worker_id
                INNER JOIN jobs 
                ON jobs.id = agent_worker.job_id
                WHERE customer_fav.customer_id = ?
        ";
        $query = $this->db->query($sql, array($customer_id));
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }


    public function delete_from_fav($customer_id, $worker_id)
    {
        $sql = 'DELETE FROM customer_fav WHERE customer_id = ? AND worker_id = ?';
        return $this->db->query($sql, array($customer_id, $worker_id));
    }

    public function check_in_customer_fav($customer_id, $worker_id)
    {
        $sql = 'select * from customer_fav where customer_id = ? AND worker_id = ?';
        $query = $this->db->query($sql, array($customer_id, $worker_id));
        if ($query->num_rows()) {
            return true;
        }
        return false;
    }


    public function add_to_customer_fav($customer_id, $worker_id)
    {
        $sql = 'INSERT INTO customer_fav (customer_id, worker_id) VALUES(?, ?)';
        return $this->db->query($sql, array($customer_id, $worker_id));
    }


    /**
     * Save message contacts
     *
     * @param $data
     * @return mixed
     */
    public function save_message_contact($data)
    {
        $this->db->set($data);
        $this->db->insert('site_contacts');
        $id = $this->db->insert_id();
        return $id;
    }

}