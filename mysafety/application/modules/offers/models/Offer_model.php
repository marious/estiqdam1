<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Offer_model extends MY_Model
{
    protected $table_name = 'offers';

    public $rules = [
       [
           'field' => 'en_offer_heading',
           'label' => 'lang:en_offer_heading',
           'rules' => 'trim|required|max_length[100]',
       ],
        [
            'field' => 'ar_offer_heading',
            'label' => 'lang:ar_offer_heading',
            'rules' => 'trim|required|max_length[100]',
        ],
        [
            'field' => 'en_offer_content',
            'label' => 'lang:en_offer_content',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'ar_offer_content',
            'label' => 'lang:ar_offer_content',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'start_at',
            'label' => 'lang:start_at',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'end_at',
            'label' => 'lang:end_at',
            'rules' => 'trim|required',
        ],

    ];


    public function get_all_offers()
    {
        // for ordering
        $columns[0] = 'offers.id';


        $query = "SELECT * FROM offers";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE offer_heading LIKE ? ';
            $query .= ' OR offer_content LIKE ? ';
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
            $sub_array[] = transText($row->offer_heading, 'en');
            $sub_array[] = transText($row->offer_heading, 'ar');
            $sub_array[] = shortDescrip(transText($row->offer_content, 'en'), 25);
            $sub_array[] = shortDescrip(transText($row->offer_content, 'ar'), 25);
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->start_at, 'd-m-Y');
            $sub_array[] = dateFormat($row->end_at, 'd-m-Y');
            $sub_array[] = draw_actions_button(site_url('offers/edit/' . $row->id), site_url('offers/delete/'.$row->id), 'offers');
            $data[] = $sub_array;
            $i++;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_offers_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }


    public function get_offers_count()
    {
        $query = "SELECT * FROM offers";
        $q = $this->db->query($query);
        return $q->num_rows();
    }
}