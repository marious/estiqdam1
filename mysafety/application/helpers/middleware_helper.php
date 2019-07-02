<?php 

function not_authinticated()
{
    
    $CI =& get_instance();
    if (! $CI->ion_auth->logged_in())
    {
        redirect('auth/login');
    }

    return true;
}



function check_permission($permission_name)
{
    //return true;
    $CI =& get_instance();
    $user_groups = $CI->ion_auth->get_users_groups()->result();
        $permissions = [];
        foreach ($user_groups as $user_group) {
            $permissions[] = Modules::run('roles/get_permissions_for_group', $user_group->id);
        }
        if (isset($permissions[0]) && $permissions[0])
        {
            $result = [];
            array_walk_recursive($permissions,function($v) use (&$result){ $result[] = $v->name; });
            if (in_array($permission_name, $result)) {
                return true;
            }
            show_404();
            return false;
        }

}