<?php

class Site_admin_model extends MY_Model
{
    public function get_contact_messages()
    {
        $sql = "SELECT * FROM site_contacts ORDER BY created_at DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows())
        {
            return $query->result();
        }
        return false;
    }
}