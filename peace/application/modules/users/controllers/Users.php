<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->middleware->only(['check_permission:add_users'], ['add']);
        $this->middleware->only(['check_permission:edit_users'], ['edit']);
        $this->middleware->only(['check_permission:show_users'], ['all']);
        $this->middleware->only(['check_permission:delete_users'], ['delete']);
        $this->lang->load('users');
        $this->load->model('User_Model');
    }

    public function all()
    {
        $this->data['page_header'] = lang('all_users');
        $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
        $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
            base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', site_url('assets/admin/js/users.js')];
        $this->admin_template('all', $this->data);
    }

    public function load_all_users()
    {
        $this->User_Model->get_all_users();
    }


    public function add($id = null)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_user') : lang('add_new_user');
        $this->data['css_file'] = [site_url('assets/admin/plugins/iCheck/all.css')];
        $this->data['js_file'] = [site_url('assets/admin/plugins/iCheck/icheck.min.js')];
        $this->data['icheck'] = true;
    
        if ($id && is_numeric($id))
        {
            $this->User_Model->get($id) || redirect('users/all');     // check if valid user id
            $this->data['user'] = $this->ion_auth->user($id)->row();
            $this->data['id'] = $id;
            $this->data['note'] = lang('password_note');
            $rules = $this->User_Model->rules_without_password();
        }
        else
        {
            $this->data['user'] = $this->User_Model->get_new();
            $this->data['id'] = false;
            $rules = $this->User_Model->rules;
        }

        // Process the form
        $this->load->library('form_validation');


        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run($this) == true)
        {
    
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $group = $this->input->post('role_group');
            
            if ($id) {
                $data = ['username' => $username, 'email' => $email];
                if (!empty($password)) {
                    $data['password'] = $password;
                }
                $this->ion_auth->update($id, $data);
                $this->ion_auth->remove_from_group(false, $id);
                $this->ion_auth->add_to_group($group, $id);
                $_SESSION['success'] = 'User Updated Successfully';
            } else {
                $this->ion_auth->register($username, $password, $email, [], $group);
                $_SESSION['success'] = 'User Created Successfully';

            }
            $this->session->mark_as_flash('success');
            redirect('users/all');
        }


        // $this->data['groups'] = $this->ion_auth->groups()->result();
        $this->data['groups'] = $this->User_Model->get_all_groups();
        $this->admin_template('add', $this->data);
    }


    // For middleware purposes
    public function edit($id)
    {
        $this->add($id);
    }


    public function delete($id)
    {
        $id && is_numeric($id) || redirect('users/all');
        $this->ion_auth->delete_user($id);
        $_SESSION['success'] = lang('success_delete');
        $this->session->mark_as_flash('success');
        redirect('users/all');
    }


    public function _unique_username($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('username', $this->input->post('username'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->User_Model->get();
        if (!empty($item)) {
            $this->form_validation->set_message('_unique_username', '%s already exist please choose another one');
            return false;
        }
        return true;
    }

    public function _unique_email($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->User_Model->get();
        if (!empty($item)) {
            $this->form_validation->set_message('_unique_email', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


    public function _verify_role_group()
    {

        $groups = $this->input->post('role_group');
        
        $valid = true;
        if (is_array($groups) && count($groups)) {
            foreach ($groups as $group) {
                if ($this->ion_auth->group($group)->row() == null) {
                    $valid = false;
                    break;
                }
            }
        }
        if ($valid == false) {
            $this->form_validation->set_message('_verify_role_group', 'Please select a valid role group');
            return false;
        }

        return true;

    }


   public function test()
   {
       
   }


}