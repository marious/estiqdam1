<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->middleware->only(['check_permission:show_roles'], ['all']);
        $this->middleware->only(['check_permission:add_roles'], ['add']);
        $this->middleware->only(['check_permission:edit_roles'], ['edit']);
        $this->middleware->only(['check_permission:delete_roles'], ['delete']);
        $this->lang->load('roles');
        $this->load->model('Role_model');
    }



    
    public function all()
    {
        $this->data['page_header'] = lang('all_roles');
        $this->data['roles'] = $this->Role_model->get_roles();
        $this->admin_template('all', $this->data);
    }

    public function add($id = false)
    {
        $this->data['page_header'] = lang('add_new_role');
        $this->data['css_file'] = [site_url('assets/admin/plugins/iCheck/all.css')];
        $this->data['js_file'] = [site_url('assets/admin/plugins/iCheck/icheck.min.js'), site_url('assets/admin/js/roles.js')];
        $this->data['icheck'] = true;

        if ($id && is_numeric($id))
        {
            $this->data['group'] = $this->Role_model->get($id);
        } 
        else 
        {
            $this->data['group'] = $this->Role_model->get_new();
        }

        $this->data['id'] = $id;

        // Process The form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('role_name', 'lang:role_name', 'trim|required');
        $this->form_validation->set_rules('role_description', 'lang:role_description', 'trim|required');

        if ($this->form_validation->run($this) == true)
        {
            $permissions = $this->input->post('permissions');
            $group_name = $this->input->post('role_name');
            $description = $this->input->post('role_description');


            if ($id)
            {
                // update
                $this->Role_model->delete_all_permissions_for_group($id);
                $this->Role_model->create_permission_group($permissions, $id);
                $this->ion_auth->update_group($id, $group_name, ['description' => $description]);
                $_SESSION['succes'] = 'Role Updated Successfully';
                $this->session->mark_as_flash('scucess');
                redirect('roles/all');
            }
            else {
                $group_id = $this->ion_auth->create_group($group_name, $description);
                if (! $group_id)
                {
                    $_SESSION['error'] = $this->ion_auth->messages();
                    $this->session->mark_as_flash('error');
                    redirect('roles/all');
                }
                $this->Role_model->create_permission_group($permissions, $group_id);
                $_SESSION['success'] = 'New Role Added Successfully';
                $this->session->mark_as_flash('scucess');
                redirect('roles/add');
            }

           
        }

        $this->admin_template('add', $this->data);
    }


    public function edit($id)
    {
        $this->add($id);
    }



    public function role($group_id = false)
    {
        if ($group_id && is_numeric($group_id))
        {
            $group = $this->ion_auth->group($group_id)->row();
            if (!$group) redirect('roles/all');
            $this->data['page_header'] = ucfirst($group->name) . ' Role';
            $this->data['permissions'] = $this->Role_model->get_permissions_for_group($group_id);
            $this->admin_template('role', $this->data);
        }
        else {
            redirect('roles/all');
        }
    }




    public function delete($group_id)
    {
        if ($group_id)
        {
            if ($this->ion_auth->delete_group($group_id))
            {
                $_SESSION['success'] = 'Role Delete Successfully';
                $this->session->mark_as_flash('success');
            } else {
                $_SESSION['error'] = 'Error happen';
                $this->session->mark_as_flash('error');
            }
            redirect('roles/all');
        }
        return false;
    }



    public function get_permissions_for_group($group_id)
    {
        return $this->Role_model->get_permissions_for_group($group_id);
    }


    public function get_active_user_permissions()
    {
        $this->load->model('Role_model');
        $user_groups = $this->ion_auth->get_users_groups()->result();
        $permissions = [];
        foreach ($user_groups as $user_group) {
            $permissions[] = $this->get_permissions_for_group($user_group->id);
        }

        if (isset($permissions[0]) && $permissions[0])
        {
            $result = [];
            array_walk_recursive($permissions,function($v) use (&$result){ $result[] = $v->name; });
            return $result;
        }
        return [];
        
    }

    

}