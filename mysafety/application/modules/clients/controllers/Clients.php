<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
        $this->middleware->only(['check_permission:show_clients'], ['all']);
        $this->middleware->only(['check_permission:add_clients'], ['add']);
        $this->middleware->only(['check_permission:edit_clients'], ['edit']);
        $this->middleware->only(['check_permission:delete_clients'], ['delete']);
        $this->lang->load('clients');
        $this->load->model('Client_model');
    }

    public function all()
    {
        $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
        $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
            base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/clients.js'];
        $this->data['page_header'] = lang('all_clients');
        $this->admin_template('all', $this->data);
    }


    public function load_all_clients()
    {
        $this->Client_model->get_all_clients();
    }


    public function add($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_client')  : lang('add_new_client');

        if ($id && is_numeric($id))
        {
            $this->Client_model->get($id) || redirect('clients/all');     // check if valid category id
            $this->data['client'] = $this->Client_model->get($id);
        }
        else
        {
            $this->data['client'] = $this->Client_model->get_new();
        }


        $this->data['id'] = $id;

        // upload featured image
        // Will produce $_SESSION['error'] is something happen
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
        {
            if ($file = $this->Client_model->do_upload($this->Client_model->upload_path, 'image')) {
                $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
            }
        }


        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Client_model->rules);

        if ($this->form_validation->run($this) == true)
        {
            if (isset($_SESSION['error']))
            {
                $this->session->mark_as_flash('error');
                $this->admin_template('add', $this->data);
                return;
            }
            $data['name'] = addToJson($this->input->post('ar_name'), $this->input->post('en_name'));
            $this->Client_model->save($data, $id);
            $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
            $this->session->mark_as_flash('success');
            redirect('clients/all');

        }


        $this->admin_template('add', $this->data);


    }



    public function edit($id)
    {
        $this->add($id);
    }



    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('clients/all');
        $this->Client_model->delete($id);
        $_SESSION['success'] = lang('success_delete');
        $this->session->mark_as_flash('success');
        redirect('clients/all');
    }
}
