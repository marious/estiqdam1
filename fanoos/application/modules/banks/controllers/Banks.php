<?php
class Banks extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bank_model');
        $this->lang->load('banks');
    }


    public function all()
    {
        $this->data['page_header'] = '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('all_banks_accounts');
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/banks.js'));
        $this->admin_template('all', $this->data);
    }


    public function load_all_banks()
    {
        $this->Bank_model->get_all_banks();
    }


    public function add($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? '<i class="fa fa-arrow-circle-o-right"></i> '.lang('edit_bank_account')
                    : '<i class="fa fa-arrow-circle-o-right"></i> '.lang('add_new_bank_account');

        if ($id && is_numeric($id))
        {
            $account = $this->Bank_model->get($id);
            $account || redirect('banks/all');
            $this->data['account'] = $account;
        }
        else
        {
            $this->data['account'] = $this->Bank_model->get_new();
        }

        $this->data['id'] = $id;


        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Bank_model->rules);

        if ($this->form_validation->run($this) == true)
        {
            if (!$id) {$data['balance'] = $_POST['balance'];}
            $data['account'] = $_POST['account_title'];
            $data['branch'] = $_POST['branch'];
            $data['description'] = $_POST['description'];
            $data['account_number'] = $_POST['account_number'];
            if ($this->Bank_model->save($data, $id))
            {
                $_SESSION['success_toastr'] = $id ? lang('account_edited') : lang('account_added');
                $this->session->mark_as_flash('success_toastr');
                redirect('banks/all');
            }
        }

        $this->admin_template('add', $this->data);
    }


    public function edit($id = false)
    {
        $this->add($id);
    }

    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('banks/all');
        $this->Bank_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_account_delete');
        $this->session->mark_as_flash('success_toastr');
        redirect('banks/all');
    }



}