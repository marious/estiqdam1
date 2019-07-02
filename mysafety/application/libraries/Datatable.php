<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Datatable
{


    protected $orderingColumns;

    protected $query;

    protected $searchedValues;

    protected $setWhere;

    protected $numberFilteredRows;


    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    
    public function getResult()
    {
        $query = $this->getFormattedQuery();
        $binds = [];

        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $this->orderingColumns[$_POST['order'][0]['column']] . ' ' .
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
            if (is_array($this->searchedValues) && count($this->searchedValues))
            {
                foreach ($this->searchedValues as $key => $value) {
                    $binds[] = '%' . $search_value . '%';
                }
            }
            
        }

        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->CI->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->CI->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);
        $this->numberFilteredRows = $q2->num_rows();

        return $q->result();
    }


    public function output($data, $count)
    {
        $draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
        $output = [
            "draw" => $draw,
            "recordsTotal"  	=>  $count,
            "recordsFiltered" 	=> $this->numberFilteredRows,
            "data"    			=> $data,
        ];
        return json_encode($output);
    }



    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function setSearchedValues($searchedValues, $setWhere = true)
    {
        $this->setWhere = $setWhere;
        if (is_array($searchedValues))
        {
            $this->searchedValues = $searchedValues;
            return;
        }
        throw new Exception('Searched values must be an array.');
    }

    public function setOrderingColumns($orderingColumns = [])
    {
        if (is_array($orderingColumns))
        {
            $this->orderingColumns = $orderingColumns;
            return;
        }
        throw new Exception('Ordering Columns Muste be an array.    ');
    }



    public function getFormattedQuery()
    {

        if (isset($_POST['search']['value']))
        {
            if (is_array($this->searchedValues) && count($this->searchedValues))
            {

                if ($this->setWhere)
                {
                    $this->query .= ' WHERE ';
                }
                else
                {
                    $this->query .= ' AND ';
                }

            }

           
            if (is_array($this->searchedValues) && count($this->searchedValues))
            {
                foreach ($this->searchedValues as $searchedValue)
                {
                    $this->query .= $searchedValue . ' LIKE ? OR ';
                }
            }
           
        }

        return rtrim(trim($this->query), 'OR');
    }

}