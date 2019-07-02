<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends MY_Model
{
    protected $table_name = 'clients';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'ar_name',
            'label' => 'lang:ar_name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'en_name',
            'label' => 'lang:en_name',
            'rules' => 'trim|required',
        ],

    ];



    public function get_all_clients()
    {
        // for ordering
        $columns[0] = 'categories.id';
        $columns[4] = 'categories.created_at';

        $query = "SELECT clients.* from clients";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE clients.name LIKE ? ';
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
            $sub_array[] = transText($row->name, 'en');
            $sub_array[] = transText($row->name, 'ar');
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button(site_url('clients/edit/' . $row->id), site_url('clients/delete/'.$row->id), 'clients');
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_clients_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }

    public function get_clients_count()
    {
        $query = "SELECT * FROM categories";
        $q = $this->db->query($query);
        return $q->num_rows();
    }

}