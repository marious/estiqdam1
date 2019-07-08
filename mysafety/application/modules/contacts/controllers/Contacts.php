<?php
class Contacts extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'delete']);
        $this->middleware->only(['check_permission:delete_contacts'], ['delete']);
        $this->middleware->only(['check_permission:show_contacts'], ['all']);


        $this->load->model('Contacts_model');
    }


    public function all()
    {
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/contact_messages.js'));
        $this->data['page_header'] = lang('site_messages');
        $this->admin_template('index', $this->data);
    }


    public function load_all_contacts()
    {
        $this->Contacts_model->get_all();
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Contacts_model->rules);
        if ($this->form_validation->run() == TRUE)
        {
            $data = [];
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['subject'] = $this->input->post('subject');
            $data['message'] = $this->input->post('message');
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->Contacts_model->save($data);
            $_SESSION['success'] = lang('success_contact_message');
            $this->session->mark_as_flash('success');
            redirect(site_url('page/contact-us'));
        }

        $errors = [];
        $errors['name'] = form_error('name') != '' ? form_error('name') : '';
        $errors['email'] = form_error('email') != '' ? form_error('email') : '';
        $errors['phone'] = form_error('phone') != '' ? form_error('phone') : '';
        $errors['subject'] = form_error('subject') != '' ? form_error('subject') : '';
        $errors['message'] = form_error('message') != '' ? form_error('message') : '';
        $_SESSION['errors'] = $errors;
        $this->session->mark_as_flash('errors');
        redirect(site_url('page/contact-us'));

    }

    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('contacts/all');
        $this->Contacts_model->delete($id);
        $_SESSION['success'] = lang('success_delete');
        $this->session->mark_as_flash('success');
        redirect('contacts/all');
    }

}