<?php
class Service_model extends MY_Model
{
    protected $table_name = 'services';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'en_name',
            'label' => 'lang:en_service_name',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'ar_name',
            'label' => 'lang:ar_service_name',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'en_description',
            'label' => 'lang:en_description',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'ar_description',
            'label' => 'lang:ar_description',
            'rules' => 'trim|required',
        ],
    ];


    public function get_all_services()
    {
        // for ordering
        $columns[0] = 'services.id';
        $columns[6] = 'services.created_at';
     

        $query = "SELECT * FROM services";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE name LIKE ? ';
            $query .= ' OR slug LIKE ? ';
            $query .= ' OR description LIKE ? ';
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
            $sub_array[] = transText($row->name, 'en');
            $sub_array[] = transText($row->name, 'ar');
            $sub_array[] = shortDescrip(transText($row->description, 'en'), 25);
            $sub_array[] = shortDescrip(transText($row->description, 'ar'), 25);
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button(site_url('services/edit/' . $row->id), site_url('services/delete/'.$row->id), 'services');
            $data[] = $sub_array;
            $i++;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_services_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }

    public function get_services_count()
    {
        $query = "SELECT * FROM services";
        $q = $this->db->query($query);
        return $q->num_rows();
    }



    public function get_service_by_slug($slug)
    {
        $slugs = $this->get_all_slugs();
        if (array_key_exists($slug, $slugs))
        {
            $service_id = $slugs[$slug];
        } else {
            return false;
        }

        if ($service_id && is_numeric($service_id))
        {
            return $this->get($service_id, true);
        }
        return false;
    }


    public function get_all_slugs()
    {
        $this->db->select('*');
        $this->db->from('services');
        $q = $this->db->get();
        $result = $q->result();

        $data = [];
        foreach ($result as $row) {
            $data[transText($row->slug, 'en')] = $row->id;
            $data[transText($row->slug, 'ar')] = $row->id;
        }

        return $data;
    }
}