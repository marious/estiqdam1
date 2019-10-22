<?php
class Item_model extends MY_Model
{
    public $timestamps = true;
    public $table_name = 'items';

    public $rules = [
        [
            'field' => 'name',
            'label' => 'lang:name',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'sales_price',
            'label' => 'lang:sales_price',
            'rules' => 'trim|required|numeric',
        ],
        [
          'field' => 'category_id',
          'label' => 'lang:category',
          'rules' => 'trim|required',
        ],
        [
            'field' => 'purchase_cost',
            'label' => 'lang:purchase_cost',
            'rules' => 'trim|numeric',
        ],
        [
            'field' => 'description',
            'label' => 'lang:description',
            'rules' => 'trim',
        ],
        [
            'field' => 'retail_unit',
            'label' => 'lang:retail_unit',
            'rules' => 'trim|callback__check_retail_unit',
        ],
        [
            'field' => 'retail_qty',
            'label' => 'lang:retail_qty',
            'rules' => 'trim|integer|callback__check_retail_qty',
        ],
        [
            'field' => 'retail_price',
            'label' => 'lang:retail_price',
            'rules' => 'trim|numeric|callback__check_retail_price',
        ],
        [
            'field' => 'wholesale_unit',
            'label' => 'lang:wholesale_unit',
            'rules' => 'trim|callback__check_wholesale_unit',
        ],
        [
            'field' => 'wholesale_qty',
            'label' => 'lang:wholesale_qty',
            'rules' => 'trim|integer|callback__check_wholesale_qty',
        ],
        [
            'field' => 'wholesale_price',
            'label' => 'lang:wholesale_price',
            'rules' => 'trim|numeric|callback__check_wholesale_price',
        ],
    ];


    public function next_counter($key)
    {
        $found = $this->db->get_where('counters', ['key' => $key])->row();
        if (!$found)
        {
            throw new Exception('No record for counter found');
        }
        return $found->prefix.$found->value;
    }

    public function increment_counter($key)
    {
        $nex_counter = $this->next_counter($key);
        $counter = str_replace('-', '', substr($nex_counter, strpos($nex_counter, '-')));
        $this->db->set('value', $counter + 1);
        $this->db->where('key', $key);
        $this->db->update('counters');
    }





    public function get_all_items($type = 'product')
    {
        $columns = [];

        $query = "SELECT * FROM items";
        if ($type == 'product') {
            $query .= ' WHERE is_service = 0 ';
        } else {
            $query .= ' WHERE is_service = 1 ';
        }

        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' AND name LIKE ? ';
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

        if ($type == 'product') {

            foreach ($q->result() as $row)
            {
                $sub_array =[];
                $sub_array[] = $i;
                $sub_array[] = $row->name;
                $sub_array[] = $row->sales_price;
                $sub_array[] = $row->inventory;
                $sub_array[] = '<div class="manage-buttons">' . draw_actions_button(site_url('items/edit_'.$type.'s/' . $row->id), site_url('items/delete/'.$row->id), $type . 's') . '</div>';
                $data[] = $sub_array;
                $i++;
            }

        } else {
            foreach ($q->result() as $row)
            {
                $sub_array =[];
                $sub_array[] = $i;
                $sub_array[] = $row->name;
                $sub_array[] = $row->sales_price;
                $sub_array[] = '<div class="manage-buttons">' . draw_actions_button(site_url('items/edit_'.$type.'s/' . $row->id), site_url('items/delete/'.$row->id), $type . 's') . '</div>';
                $data[] = $sub_array;
                $i++;
            }
        }


        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_items_count($type),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);
    }

    public function get_items_count($type = 'product')
    {
        $query = "SELECT * FROM items ";
        if ($type == 'product') {
            $query .= 'WHERE is_service = 0';
        } else {
            $query .= 'WHERE is_service = 1';
        }

        $q = $this->db->query($query);
        return $q->num_rows();
    }


}