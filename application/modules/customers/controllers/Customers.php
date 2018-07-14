<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller
{

    public $module = 'customers';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->adminSecurity();
        modules::run('site_security/_make_sure_is_admin');
    }


    public function index()
    {
        $this->data['customers'] = $this->Customer_model->get();
        $this->data['datatables'] = true;
        $this->data['js_files'][] = 'assets/admin_panel/js/load_customers.js';

        $this->adminTemplate('index', $this->data);
    }



    public function add($id = null)
    {
        $this->load->module('staff');

        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['customer'] = $this->Customer_model->get($id);
            if ($this->data['customer'] && count($this->data['customer']))
            {
                $this->data['staff'] = $this->staff->Staff_model->get($this->data['customer']->staff_id);

            }
            else
            {
                count($this->data['customer']) || redirect('customers');
            }
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['customer'] = $this->Customer_model->get_new();
            $this->data['staff'] = $this->staff->Staff_model->get_new();
            $this->data['id'] = false;
        }


        $this->lang->load('services_entry');
        $this->load->module('services_entry');


        // process the form
        $this->load->library('form_validation');

//        if (false != $this->data['id'])
//        {
//            if (isset($_POST['password']) && $_POST['password'] == '') {
//                $rules = $this->Customer_model->get_rules_without_password();
//            } else {
//                $rules = $this->Customer_model->rules;
//            }
//        }
//        else
//        {
            $rules = $this->Customer_model->rules;
//        }

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true)
        {
            $customer_data = $this->Customer_model->array_from_post([
                'customer_name_in_arabic',
                'customer_name_in_english',
                'customer_mobile',
                'visa_number',
                'visa_date',
                'customer_id',
                'customer_address',
                'english_customer_address',
                'street',
                'area',
                'city',
                'english_area',
                'english_city',
                'civil_status',
                'family_members',
                'phone_number',
            ]);

            $staff_data = $this->Customer_model->array_from_post([
                'username', 'nationality_id',
            ]);
            $staff_data['access_id'] = 3;
            $staff_data['user_language'] = 'ar';


            if (isset($_POST['password']) && $_POST['password'] != '')
            {
                $staff_data['password'] = $this->site_security->_hash_string($this->input->post('password'));
            }


           if (isset($_FILES['id_image']) && $_FILES['id_image']['name'] != '')
           {
               $upload_image = $this->do_upload('id_image');
               if ($upload_image) {
                   if (isset($upload_image['file_name'])) {
                       $customer_data['id_image'] = $upload_image['file_name'];
                   }
                   if (isset($upload_image['error'])) {
                       $error = $upload_image['error'];
                       $this->session->set_flashdata('error', $error);
                       redirect('customers/add/' . $id);
                   }
               }
           }

            if (isset($_FILES['visa_image']) && $_FILES['visa_image']['name'] != '')
            {
                $upload_image = $this->do_upload('visa_image');
                if ($upload_image) {
                    if (isset($upload_image['file_name'])) {
                        $customer_data['visa_image'] = $upload_image['file_name'];
                    }
                    if (isset($upload_image['error'])) {
                        $error = $upload_image['error'];
                        $this->session->set_flashdata('error', $error);
                        redirect('customers/add/' . $id);
                    }
                }
            }


            if (isset($this->data['staff']->id) && $this->data['staff']->id != ''
                    && isset($this->data['customer']->staff_id))
            {
                $this->staff->Staff_model->save($staff_data, $this->data['customer']->staff_id);
                $this->Customer_model->save($customer_data, $id);
            }
            else
            {
                $staff_id = $this->staff->Staff_model->save($staff_data, $id);
                $customer_data['staff_id'] = $staff_id;
                $this->Customer_model->save($customer_data, $id);
            }

            $message = ($id == null) ? 'New customer added successfully' : 'Customer updated successfully';
            $this->session->set_flashdata('success', $message);
            redirect('customers');
        }


        $this->data['nationalities'] = $this->services_entry->get_customer_nationalities();
        $this->adminTemplate('add', $this->data);
    }


    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $customer = $this->Customer_model->get($id);
        if ($customer && count($customer))
        {
            $this->load->module('staff');
            $this->staff->Staff_model->delete($customer->staff_id);
            $this->Customer_model->delete($id);
            $this->session->set_flashdata('success', 'Customer Deleted Successfully');
        }
        redirect('customers');
    }




    protected function do_upload($file_input_name)
    {
        $config['upload_path']          = FCPATH . "assets/img/customers";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 1024;
        $config['max_height']           = 2024;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (! $this->upload->do_upload($file_input_name))
        {
            $error = ['error' => $this->upload->display_errors()];
            return ['error' => $error];
        }
        else
        {
            // upload was done successfully
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            return ['file_name' => $file_name];
        }

        return false;

    }




    public function show($id = null)
    {
        if (! $this->input->is_ajax_request()) {
            redirect('customers');
        }

        if ($id && is_numeric($id))
        {
            $customer = $this->Customer_model->get($id);
            if ($customer && count($customer)) {
                echo json_encode($customer);
            }
        }
    }




    public function fetch()
    {
        if (! $this->input->is_ajax_request()) {
            redirect('customers');
        }

        $query = '';
        $output = [];
        $binds = [];
        $column = array(
                        'customers.customer_name_in_arabic',
                        'staff.username',
                        'customer_nationality.nationality_in_arabic',
                        'customers.customer_mobile',
            );

        $query = "SELECT customers.*, staff.username, customer_nationality.nationality_in_arabic
                  FROM customers
                  INNER JOIN staff ON customers.staff_id = staff.id 
                  INNER JOIN customer_nationality ON staff.nationality_id = customer_nationality.id
                  ";
        if (isset($_POST['search']['value']) && !empty($_POST['search']['value']))
        {
            $query .= ' WHERE username LIKE ? ';
        }

        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' .
                $_POST['order']['0']['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY customers.id ';
        }

        if ($_POST['length'] != -1)
        {
            $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }


        if (isset($_POST['search']['value']) && !empty($_POST['search']['value']))
        {
            $binds[] = '%' . $_POST['search']['value'] . '%';
        }


        $q = $this->db->query($query, $binds);
        $result = $q->result_array();
        $data = [];
        $filtered_rows = count($result);
        foreach ($result as $row) {
            $sub_array = [];
            $sub_array[] = $row['customer_name_in_arabic'];
            $sub_array[] = $row['username'];
            $sub_array[] = $row['nationality_in_arabic'];
            $sub_array[] = $row['customer_mobile'];
//            $sub_array[] = $row['image'];
            $sub_array[] = '
                <div class="btn-group">    
            <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu icons-left">             

                         <li><a href="" class="tips view-customer" title="" data-original-title="view"
                            data-customer="'.$row['id'].'">
                         <i class="glyphicon  glyphicon-search"></i> View </a></li>
                        <li><a href="'.site_url('customers/add/' . $row['id']).'" class="tips " title="" data-original-title="edit"> 
                        <i class="glyphicon glyphicon-edit"></i>  Edit </a> </li>
                        <li><a href="'.site_url('customers/delete/' . $row['id']).'" class="delete-btn">
                            <i class="glyphicon glyphicon-remove"></i> Delete</a></li>
                                    
            </ul>
          </div>
            ';
            $data[] = $sub_array;
        }

        $records_filtered = $this->db->count_all_results('customers');
        $output = [
            'draw' => intval($_POST['draw']),
            'recordsTotal'		=> $filtered_rows,
            'recordsFiltered'	=> $records_filtered,
            'data'				=> $data
        ];

        echo json_encode($output);

    }


}