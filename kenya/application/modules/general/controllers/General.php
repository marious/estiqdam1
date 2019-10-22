<?php

class General extends MY_Controller
{
    /**
     * Get customer level
     * @return bool
     * @throws Exception
     */
    public function get_customer_level()
    {
        $levels = $this->db->get('customer_level')->result();
        if (is_array($levels) && count($levels)) {
            return $levels;
        }
        throw new Exception("No Customer Level Found");
    }


    /**
     * Get price types
     * @return bool
     * @throws Exception
     */
    public function get_price_types()
    {
        $types = $this->db->get('price_types')->result();
        if (is_array($types) && count($types))
        {
            return $types;
        }
        throw new Exception('No price types found');
    }


    /**
     * Get customer types
     * @return mixed
     * @throws Exception
     */
    public function get_customer_types()
    {
        $types = $this->db->get('customer_types')->result();
        if (is_array($types) && count($types))
        {
            return $types;
        }
        throw new Exception('No Customer types found');
    }


    /**
     * Get balance Types
     * @return mixed
     * @throws Exception
     */
    public function get_balance_types()
    {
        $types = $this->db->get('balance_type')->result();
        if (is_array($types) && count($types))
        {
            return $types;
        }
        throw new Exception('No balance types found');
    }


    /**
     * Get all branches
     * @return mixed
     * @throws Exception
     */
    public function get_branches()
    {
        $branches = $this->db->get('branches')->result();
        if (is_array($branches) && count($branches))
        {
            return $branches;
        }
        throw new Exception('No Branches Found');
    }

}