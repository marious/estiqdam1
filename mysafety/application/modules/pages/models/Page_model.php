<?php

class Page_model extends MY_Model
{
    protected $table_name = 'pages';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'en_name',
            'label' => 'lang:en_page_name',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'ar_name',
            'label' => 'lang:ar_page_name',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'en_content',
            'label' => 'lang:en_content',
            'rules' => 'trim',
        ],
        [
            'field' => 'ar_content',
            'label' => 'lang:ar_content',
            'rules' => 'trim',
        ],
    ];


    public function get_all_pages()
    {
        // for ordering
        $columns[0] = 'pages.id';
        $columns[6] = 'pages.created_at';

        $query = "SELECT pages.*, pages_layout.layout FROM pages
                  INNER JOIN pages_layout ON pages.page_layout = pages_layout.id";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE name LIKE ? ';
            $query .= ' OR slug LIKE ? ';
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
            $sub_array =[];
            $sub_array[] = $i;
            $sub_array[] = transText($row->name, 'en');
            $sub_array[] = transText($row->name, 'ar');
            $sub_array[] = $row->layout;
            $sub_array[] = $row->status == '1' ? 'Active' : 'Not Active';
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button(site_url('pages/edit/' . $row->id), site_url('pages/delete/'.$row->id), 'pages');
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_pages_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);


    }


    public function get_pages_count()
    {
        $query = "SELECT * FROM pages";
        $q = $this->db->query($query);
        return $q->num_rows();
    }


    public function get_pages_layout()
    {
        $q = $this->db->get('pages_layout');
        if ($q->num_rows()) {
            return $q->result();
        }
        return false;
        
    }
}