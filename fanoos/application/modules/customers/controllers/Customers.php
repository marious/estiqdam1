<?php
class Customers extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->lang->load('customers');
        $this->load->module('general');
    }


    public function get()
    {

        if (!isset($_POST['searchTerm']))
        {
            $this->db->limit(5);
            $fetched_data = $this->Customer_model->get();
        } else {
            $search_term = trim($_POST['searchTerm']);
            $fetched_data = $this->Customer_model->search('title', $search_term, 5);
        }
        echo json_encode($fetched_data);
    }

    public function all_customers()
    {
        $this->data['page_header'] = '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('customers_info');
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/customers.js'));
        $this->admin_template('all_customers', $this->data);
    }


    public function load_all_customers()
    {
        $this->Customer_model->get_all();
    }


    public function add_customer($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('edit_customer'):
                '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('add_new_customer');
        $this->load_icheck();
        $this->load_datepicker();
        $this->data['customer_levels'] = $this->general->get_customer_level();
        $this->data['price_types'] = $this->general->get_price_types();
        $this->data['customer_types'] = $this->general->get_customer_types();
        $this->data['balance_types'] = $this->general->get_balance_types();
        $this->data['branches'] = $this->general->get_branches();


        if ($id && is_numeric($id))
        {
            $customer = $this->Customer_model->get($id);
            $customer || redirect('customers/all');
            $this->data['customer'] = $customer;
        }
        else
        {
            $this->data['customer'] = $this->Customer_model->get_new();
            $this->data['customer']->customer_type = '1';   // default customer type is customer
            $this->data['customer']->status = 1;
            $this->data['customer']->balance_date = date('Y-m-d H:i:s');
        }

        $this->data['id'] = $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Customer_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Customer_model->array_from_post([
                'customer_name',
                'branch_id',
                'status',
                'telephone',
                'mobile',
                'fax',
                'email',
                'work_address',
                'home_address',
                'tax_record_no',
                'customer_level',
                'price_type',
                'customer_type',
                'notes',
                'start_balance',
                'balance_type',
                'balance_date',
            ], true);

            if ($this->Customer_model->add($data, $id))
            {
                $_SESSION['success_toastr'] = lang('new_customer_added');
                $this->session->mark_as_flash('success_toastr');
                redirect('customers/all_customers');
            }
        }


        $this->admin_template('add', $this->data);
    }


    public function edit_customer($id = false)
    {
        $this->add_customer($id);
    }


    public function delete_customer($id = false)
    {
        $id && is_numeric($id) || redirect('customers/all');
        $this->Customer_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_delete');
        $this->session->mark_as_flash('success_toastr');
        redirect('customers/all_customers');
    }




    //******************************************************************************************************************
    //                                              Vendors Section
    //******************************************************************************************************************
    public function all_vendors()
    {
        $this->data['page_header'] = '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('vendors_info');
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/customers.js'));
        $this->admin_template('all_vendors', $this->data);
    }


    public function load_all_vendors()
    {
        $this->Customer_model->get_vendors();
    }




    public function add_vendor($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('edit_vendor'):
            '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('add_new_vendor');



        if ($id && is_numeric($id))
        {
            $vendor = $this->db->get_where('vendors', ['id' => $id])->row();
            $vendor || redirect('customers/all_vendors');
            $this->data['vendor'] = $vendor;
        }
        else
        {
            $this->data['vendor'] = (object) [
                'vendor_code'   => '',
                'name'          => '',
                'company_name'  => '',
                'phone'         => '',
                'fax'           => '',
                'email'         => '',
                'website'       => '',
                'b_address'     => '',
                'note'          => '',
            ];
        }

        $this->data['id'] = $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Customer_model->vendor_rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Customer_model->array_from_post([
                'name',
                'company_name',
                'phone',
                'fax',
                'email',
                'website',
                'b_address',
                'note',
            ], true);

            if ($this->Customer_model->save_vendor($data, $id))
            {
                $_SESSION['success_toastr'] = lang('saved_vendor');
                $this->session->mark_as_flash('success_toastr');
                redirect('customers/all_vendors');
            }
        }


        $this->admin_template('add_vendor', $this->data);
    }


    public function edit_vendor($id)
    {
        $this->add_vendor($id);
    }


    public function delete_vendor($id = null)
    {
        $purchase = $this->db->get_where('purchase_order', ['vendor_id' => $id])->row();
        if ($purchase)
        {
            $this->message->custom_error_msg('customers/all_vendors', lang('sorry_you_cannot_delete_used_by_other'));
        }
        else
        {
            $this->db->delete('vendors', ['id' => $id]);
            $this->message->delete_success('customers/all_vendors');
        }
        return false;
    }

}