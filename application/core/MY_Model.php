<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model 
{
    const CREATED_FIELD = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table_name = '';
    protected $primary_key = 'id';
    protected $primary_filter = 'intval';
    protected $order_by = '';
    protected $type_of_order = 'asc';
    protected $rules = array();
    protected $timestamps = false;
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function order_by($order_by)
    {
        $this->db->order_by($order_by);
        return $this;
    }


    /**
     * return all records 
     * if $id it will return this rcord represent it 
     * it not $id and $single is true it return one record 
     * if $id is null and $single is false it will return all records 
     * @param int $id
     * @param boolean $single
     */
    public function get($id = null, $single = false)
    {
        if ($id != null) {
            $filter = $this->primary_filter;
            $id = $filter($id);
            $this->db->where($this->primary_key, $id);
            $method = 'row';
        } elseif ($single == true) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if (!empty($this->order_by)) {
            $this->db->order_by($this->order_by, $this->type_of_order);
        }
        return $this->db->get($this->table_name)->$method();
    }


    /**
     * A convenience method to return only a single field of the specified row.
     *
     * @param mixed  $id    The primary_key value to match against.
     * @param string $field The field to search for.
     *
     * @return bool|mixed The value of the field.
     */
    public function get_field($id=NULL, $field='')
    {
        $this->db->select($field);
        if ($id) {
            $this->db->where($this->primary_key, $id);
        }
        $query = $this->db->get($this->table_name);
        if ($query && $query->num_rows() > 0)
        {
            return $query->row()->$field;
        }
        return FALSE;
    }


    public function get_column($id = NULL, $column = '')
    {
        $this->db->select($column);
        if ($id) {
            $this->db->where($this->primary_key, $id);
        }
        $query = $this->db->get($this->table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->result();
        }
        return FALSE;
    }

    //=======================================================================================


    /**
     * Get by method will return the rcords that match the where array condition 
     * if $single is true it will return one record 
     * @param array $where
     * @param boolean $single
     */
    public function get_by($where, $single = false)
    {
        $this->db->where($where);
        return $this->get(null, $single);
    }

    public function count_where($where) {
        $result = $this->get_by($where);
        return count($result);
    }

    //========================================================================================

    public function get_with_limit($limit, $offset, $where = null)
    {
        $this->db->limit($limit, $offset);
        if (!empty($this->order_by)) {
            $this->order_by($this->order_by);
        }
        if ($where) {
            $this->db->where($where);
        }
        return $this->get(null, false);
    }

    //================================================================================================

    public function get_max()
    {
        $this->db->select_max($this->primary_key);
        $row = $this->get(null, true);
        $id = $row->id;
        return $id;
    }

    //================================================================================================

   public function count_all()
    {
        $result = $this->get(null, false);
        return count($result);
    }

    //=======================================================================================

    /**
     * save and update recored in the database
     * @param  mix $data data that you want to update or insert
     * @param  int $id   table primary ke
     * @return $id
     */
    public function save($data = array(), $id = NULL)
    {
          // set timestamps
        if ($this->timestamps == true) {
            $now = date('Y-m-d H:i:s');
            $id OR $data[static::CREATED_FIELD] = $now;
            $data[static::UPDATED_AT] = $now;
        }

        // insert
        if ($id == null) {

            !isset($data[$this->primary_key]) OR $data[$this->primary_key] = null;
            $this->db->set($data);
            $this->db->insert($this->table_name);
            $id = $this->db->insert_id();
        }
        // update
        else {
            $filter = $this->primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->primary_key, $id);
            $this->db->update($this->table_name);
        }

        return $id;
    }

    //=====================================================================================



    /**
     * delete record from the database
     * @param  int $id
     * @return [type]     [description]
     */
    public function delete($id)
    {
        if (!$id) {
            return false;
        }
        if (is_array($id)) {
            foreach ($id as $value) {
                $this->db->where($this->primary_key, $value);
                $this->db->limit($value);
                $this->db->delete($this->table_name);
            }
            return true;
        }
        $this->db->where($this->primary_key, $id);
        $this->db->limit(1);
        return $this->db->delete($this->table_name);
    }


     public function delete_where($where = array())
     {
         if (empty($where)) {
             return;
         }

         $_where = [];
         foreach ($where as $field => $val) {
             if (is_array($val)) {
                 $_where[] = "`{$field}` IN (" . implode("', '", $val) . "')";
             } else {
                 if (is_numeric($val)) {
                     $_where[] = "`{$field}` = {$val}";
                 } else {
                     $_where[] = "`{$field}` = '{$val}'";
                 }
             }
         }

         $sql = "DELETE FROM {$this->table_name} WHERE (" . implode(') AND (', $_where).")";

         if (!($query = $this->db->query($sql))) {
             return false;
         }

         return true;
     }

    //=======================================================================================

    public function get_table_field()
    {
        $columns = array();
        $query = $this->db->query("SHOW COLUMNS FROM {$this->table_name}");
        foreach ($query->result() as $column) {
            $columns[$column->Field] = $column->Field;
        }
        return $columns;
    }


    public function get_new()
    {
        $obj = new stdClass();
        $fields = $this->get_table_field();
        foreach ($fields as $key => $field) {
            $obj->$key = '';
        }
        return $obj;
    }
     


    //=========================================================================================


    public function array_from_post($fields = array())
    {
        $data = array();
        foreach($fields as $field) {
            $data[$field] = $this->input->post($field);
        }

        return $data;
    }


    //=========================================================================================


}