<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends MY_Model
{
    protected $table_name = 'groups';



    public function get_roles()
    {
        $g_query = $this->db->select('id, name, description')->from('groups')->get();
        if ($g_query->num_rows())
        {
            return $groups = $g_query->result();
            $group_permissions = [];
            foreach ($groups as $group) {
                $group_permissions[$group->id] =  $this->format_permissions_for_view($this->get_permissions_for_group($group->id));
            }
        }

        return false;

    }

    public function get_permissions_for_group($group_id = false)
    {
        $query = "SELECT permissions.name, groups.id, permissions.description
                    FROM permissions 
                    INNER JOIN permission_group 
                    ON permission_group.permission_id = permissions.id 
                    INNER JOIN groups 
                    ON permission_group.group_id = groups.id
                    WHERE groups.id = ?
        ";
        if ($group_id)
        {
            $query = $this->db->query($query, $group_id);
            if ($query->num_rows())
            {
                return $query->result();
            }
            return false;
        }

        return false;
    }


    public function get_permissions()
    {
        $q = $this->db->select('id, name, display_name')
            ->from('permissions');
        return $q;
    }


    public function format_permissions_for_view($permissions)
    {
        if (is_array($permissions) && count($permissions))
        {
            $output = '';
            foreach ($permissions as $i => $permission) {
                if ($i == 0) {
                    $output = ' ' . $permission->name . ' ';
                } else {
                    $output .= ' , ' . $permission->name . ' ';
                }
            }
            return $output;
        }

        return '';

    }


    public function create_permission_group($permissions = [], $group_id)
    {
        foreach ($permissions as $permission) {
            $this->db->set(['permission_id' => $permission, 'group_id' => $group_id]);
            $this->db->insert('permission_group');
        }
        return ;
    }


    public function get_permissions_id_by_group($group_id)
    {
        $q = $this->db->select('permission_id')->from('permission_group')->where('group_id', $group_id)->get();
        if ($q->num_rows()){
            foreach ($q->result() as $row) {
                $permision_arr[] = $row->permission_id;
            }
            return $permision_arr;
        }
        return [];
    }


    public function delete_all_permissions_for_group($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->delete('permission_group');
        return;
    }
}