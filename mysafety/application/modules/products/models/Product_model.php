<?php

class Product_model extends MY_Model
{
    protected $table_name = 'products';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'en_name',
            'label' => 'lang:en_product_name',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'ar_name',
            'label' => 'lang:ar_product_name',
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
            'field' => 'category_id',
            'label' => 'lang:category',
            'rules' => 'trim|required|callback__valid_category_id'
        ]
    ];


    public function get_all_products()
    {

        // for ordering
        $columns[0] = 'products.id';
        $columns[6] = 'products.created_at';


        $query = "SELECT products.*, categories.name AS category_name 
                  FROM products INNER JOIN categories 
                  ON products.category_id = categories.id";

        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE products.name LIKE ? ';
            $query .= ' OR products.slug LIKE ? ';
            $query .= ' OR categories.name LIKE ? ';
            $query .= ' OR products.description LIKE ? ';
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
            $sub_array[] = transText($row->category_name, 'en');
            $sub_array[] = shortDescrip(transText($row->description, 'en'), 25);
            $sub_array[] = shortDescrip(transText($row->description, 'ar'), 25);
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = '<a href="'.site_url('products/product/' . $row->id).'" class="btn btn-primary btn-info" title="product Images"><i class="fa fa-photo"></i></a>&nbsp;&nbsp;'. draw_actions_button(site_url('products/edit/' . $row->id), site_url('products/delete/'.$row->id), 'products');
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_products_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }


    public function get_products_count()
    {
        $query = "SELECT * FROM products";
        $q = $this->db->query($query);
        return $q->num_rows();
    }






    public function get_product_images($product_id)
    {
        $query = "SELECT * FROM product_images WHERE product_id = ? ";
        $query1 = '';
          if (isset($_POST['length']) && $_POST['length'] != -1)
          {
              $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
              $q = $this->db->query($query . ' ' . $query1, $product_id);
          }

          $q2 = $this->db->query($query, [$product_id]);
  
          $number_filter_row = $q2->num_rows();
          $data = [];
          $i = 1;
          foreach ($q->result() as $row) {
            $sub_array =[];
            $sub_array[] = $i;
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = '<a data-href="'.site_url('products/delete_product_image/' . $row->id).'" class="btn btn-sm btn-danger" title="Delete" 
                    data-toggle="modal" data-target="#confirm-delete">
            <i class="fa fa-trash-o"></i></a>';
            $data[] = $sub_array;
            $i++;
        }

        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_product_images_count($product_id),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }


    public function get_product_images_count($id)
    {
        $query = "SELECT * FROM product_images WHERE product_id = ?";
        $q = $this->db->query($query, [$id]);
        return $q->num_rows();
    }


    public function product_images($id)
    {
        $query = "SELECT * FROM product_images WHERE product_id = ?";
        $q = $this->db->query($query, [$id]);
        return $q->result();
    }


    public function save_image_for_product($id = false, $image = false)
    {
        if ($id && $image)
        {
            $data = [
                'product_id' => $id,
                'image' => $image,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            return $this->db->insert('product_images', $data);
        }
    }


    public function get_by_slug($slug)
    {
        $slugs = $this->get_all_slugs();
        if (array_key_exists($slug, $slugs))
        {
            $product_id = $slugs[$slug];
        } else {
            return false;
        }

        if ($product_id && is_numeric($product_id))
        {
            return $this->get($product_id, true);
        }
        return false;
    }

    public function get_all_slugs()
    {
        $this->db->select('*');
        $this->db->from('products');
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