<?php
class Category_model extends MY_Model
{
    protected $timestamps = true;
    protected $table_name = 'categories';

    public function get_dattable_categories($type)
    {
        $this->load->library('datatable');
        $this->datatable->setQuery('SELECT * FROM categories WHERE type = ' . $type);
        $this->datatable->setSearchedValues(['title'], true);
        $result = $this->datatable->getResult();
        $i = 1;
        $data = [];
        foreach ($result as $row) {
            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = $row->name;
            $sub_array[] ='' ;
            $data[] = $sub_array;
            $i++;
        }
        $count = $this->get_categories_count($type);
        echo $this->datatable->output($data, $count);
    }


    public function get_categories_count($type)
    {
        $q = $this->db->query('SELECT * FROM categories WHERE type = ' . $type);
        return $q->num_rows();
    }
}