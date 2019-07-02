<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model
{
    protected $table_name = 'categories';

    public $rules = [
        [
            'field' => 'en_name',
            'label' => 'lang:en_category_name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'ar_name',
            'label' => 'lang:ar_category_name',
            'rules' => 'trim|required'
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
        [
            'field' => 'service_id',
            'label' => 'lang:service',
            'rules' => 'trim|required|callback__valid_service_id'
        ]
    ];


    public function get_all_categories()
    {

       // for ordering
       $columns[0] = 'categories.id';
       $columns[6] = 'categories.created_at';


        $query = "SELECT categories.*, services.name AS service_name 
                  FROM categories INNER JOIN services 
                  ON services.id = categories.service_id";

          $binds = [];
          if (isset($_POST['search']['value']))
          {
              $query .= ' WHERE categories.name LIKE ? ';
              $query .= ' OR categories.slug LIKE ? ';
              $query .= ' OR services.name LIKE ? ';
              $query .= ' OR categories.description LIKE ? ';
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
            $sub_array[] = transText($row->service_name, 'en');
            $sub_array[] = shortDescrip(transText($row->description, 'en'), 25);
            $sub_array[] = shortDescrip(transText($row->description, 'ar'), 25);
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button(site_url('categories/edit/' . $row->id), site_url('categories/delete/'.$row->id), 'categories');
            $data[] = $sub_array;
            $i++;
        }

          $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_categories_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
  
    }


    public function get_categories_count()
    {
        $query = "SELECT * FROM categories";
        $q = $this->db->query($query);
        return $q->num_rows();
    }


    public function get_by_slug($slug)
    {
        $slugs = $this->get_all_slugs();
        if (array_key_exists($slug, $slugs))
        {
            $category_id = $slugs[$slug];
        } else {
            return false;
        }

        if ($category_id && is_numeric($category_id))
        {
            return $this->get($category_id, true);
        }
        return false;
    }

    public function get_all_slugs()
    {
        $this->db->select('*');
        $this->db->from('categories');
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