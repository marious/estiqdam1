<?php

class Permission_model extends MY_Model
{
    protected $table_name = 'permissions';
    protected $timestamps = true;


    public function create_permission($display_name)
    {
        if ($display_name == 'dashboards')
        {
            $data['display_name'] = $display_name;
            $data['name'] = 'admin_dashboard';
            $data['description'] = 'This permission to access admin dashboard';
            $data['created_at'] = time();
            $data['updated_at'] = time();
            $this->save($data);
            return true;
        }
        else
        {
            $permissions = [
                ['name' => 'show', 'description' => 'show ? list'],
                ['name' => 'add', 'description' => 'add ? permission'],
                ['name' => 'edit', 'description' => 'edit ? permission'],
                ['name' => 'delete', 'description' => 'delete ? permission'],
            ];
            foreach ($permissions as $permission) {
                $data['display_name'] = $display_name;
                $data['name'] = $permission['name'] . '_' . $display_name;
                $data['description'] = str_replace('?', $display_name, $permission['description']);
                $data['created_at'] = time();
                $data['updated_at'] = time();
                $this->save($data);
            }

            return true;
        }
    }
}