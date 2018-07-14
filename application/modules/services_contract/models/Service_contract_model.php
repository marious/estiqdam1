<?php

class Service_contract_model extends MY_Model
{
    protected $table_name = 'services_contract';

    public function update($data, $contract_number)
    {
        $this->db->set($data);
        $this->db->where('contract_number', $contract_number);
        $this->db->update($this->table_name);
        return true;
    }
}