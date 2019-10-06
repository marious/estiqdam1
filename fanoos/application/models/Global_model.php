<?php
class Global_model extends CI_Model
{
    public $table;
    public $column_order; //set column field database for datatable orderable
    public $column_search; //set column field database for datatable searchable just firstname , lastname , address are searchable
    public $order; // default order
    Public $col;
    public $colId;



    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();

        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function render_table($data)
    {
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $this->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function validation($rules)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
            foreach ($rules as $r) {
                $data['inputerror'][] = $r['field'];
                $this->form_validation->set_error_delimiters('', '');
                $data['error_string'][] = $this->form_validation->error($r['field']);
                $data['status'] = FALSE;
            }
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    function get_transactions_dataTables($column = null,$id = null)
    {
        $term = $_REQUEST['search']['value'];

        $this->_get_datatables_transactions_query($term);
        if($_REQUEST['length'] != -1)
            $this->db->limit($_REQUEST['length'], $_REQUEST['start']);


        $query = $this->db->get();
        return $query->result();

    }

    private function _get_datatables_transactions_query($term='')
    {
        $column = array(
            'transactions.transaction_id','transactions.transaction_type' ,'transactions.account_id','transactions.category_id',
            'account_head.account_title', 'transaction_category.name', 'account_head.balance', 'transactions.date_time',
        );
        $this->db->select('transactions.*, account_head.account_title as account_name, transaction_category.name as category_name, 
            account_head.account_currency');
        $this->db->from('transactions');

        $this->db->join('account_head', 'account_head.id = transactions.account_id','left');
        $this->db->join('transaction_category', 'transaction_category.id = transactions.category_id','left');

        if($this->col != '' && $this->colId !='') {
            $this->db->where('transactions.'.$this->col, $this->colId);
        }
        //$this->db->where($where);
        $this->db->group_start();
        $this->db->like('transactions.transaction_id', $term);
        $this->db->or_like('account_head.account_title', $term);
        $this->db->or_like('transactions.transaction_type', $term);
        $this->db->or_like('transaction_category.name', $term);
        $this->db->or_like('transactions.amount', $term);
        $this->db->or_like('transactions.balance', $term);
        $this->db->or_like('transactions.date_time', $term);
        $this->db->group_end();

        if(isset($_REQUEST['order'])) // here order processing
        {
            $this->db->order_by($column[$_REQUEST['order']['0']['column']], $_REQUEST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }

    function count_filtered_transactions(){
        $term = $_REQUEST['search']['value'];
        $this->_get_datatables_transactions_query($term);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all_transactions()
    {
        $this->db->from($this->table);
        if($this->col != '' && $this->colId !='') {
            $this->db->where($this->col, $this->colId);
        }
        return $this->db->count_all_results();
    }
}