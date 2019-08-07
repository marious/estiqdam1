<?php
class Items extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('items');
        $this->load->model('Item_model');
        $this->load->module('taxes');
    }


    public function products()
    {
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/items.js'));
        $this->data['page_header'] = lang('all_products');
        $this->admin_template('products', $this->data);
    }

    public function load_all_products()
    {
        $this->Item_model->get_all_items('product');
    }


    public function add_product($id = false)
    {
        $this->load_icheck();

        $this->data['page_header'] = $id && is_numeric($id) ? '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('edit_product'):
            '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('add_new_product');

        if ($id && is_numeric($id))
        {
            $product = $this->Item_model->get($id);
            $product || redirect('items/products');
            $this->data['product'] = $product;
        }
        else
        {
            $this->data['product'] = $this->Item_model->get_new();
            $this->data['product']->item_code = $this->Item_model->next_counter('product');
        }

        $this->data['item_taxes'] = !empty($this->data['product']->tax) ? unserialize($this->data['product']->tax) : [];

        $this->data['id'] = $id;
        $this->data['taxes'] = $this->taxes->Tax_model->get();
        $this->data['categories'] = $this->db->order_by('category', 'asc')->get('product_category')->result();


        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Item_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data['name']           = $_POST['name'];
            $data['tax']            = isset($_POST['tax']) ? serialize($_POST['tax']) : null;
            $data['item_code']      = $this->data['product']->item_code;
            $data['sales_price']    = $_POST['sales_price'];
            $data['description']    = $_POST['description'];
            $data['category_id']    = $this->input->post('category_id');
            $data['purchase_cost']  = $this->input->post('purchase_cost');
            $data['user_id']        = $_SESSION['user_id'];


            if ($this->Item_model->save($data, $id))
            {
                if (!$id)
                {
                    $this->Item_model->increment_counter('product');
                }
                $_SESSION['success_toastr'] = $id ? lang('product_edited') : lang('product_added');
                $this->session->mark_as_flash('success_toastr');
                redirect('items/products');
            }
        }

        $this->admin_template('add_product', $this->data);
    }

    public function edit_products($id = false)
    {
        $this->add_product($id);
    }


    public function services()
    {
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/items.js'));
        $this->data['page_header'] = lang('all_services');
        $this->admin_template('services', $this->data);
    }

    public function load_all_services()
    {
        $this->Item_model->get_all_items('service');
    }


    public function add_service($id = false)
    {
        $this->load_icheck();

        $this->data['page_header'] = $id && is_numeric($id) ? '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('edit_service'):
            '<i class="fa fa-arrow-circle-o-right"></i> ' . lang('add_new_service');

        if ($id && is_numeric($id))
        {
            $service = $this->Item_model->get($id);
            $service || redirect('items/services');
            $this->data['service'] = $service;
        }
        else
        {
            $this->data['service'] = $this->Item_model->get_new();
            $this->data['service']->item_code = $this->Item_model->next_counter('service');
        }

        $this->data['item_taxes'] = !empty($this->data['service']->tax) ? unserialize($this->data['service']->tax) : [];

        $this->data['id'] = $id;
        $this->data['taxes'] = $this->taxes->Tax_model->get();
        $this->data['categories'] = $this->db->order_by('category', 'asc')->get('product_category')->result();

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Item_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data['name']           = $_POST['name'];
            $data['tax']            = isset($_POST['tax']) ? serialize($_POST['tax']) : null;
            $data['item_code']      = $this->data['service']->item_code;
            $data['sales_price']    = $_POST['sales_price'];
            $data['purchase_cost']  = $this->input->post('purchase_cost');
            $data['category_id']    = $this->input->post('category_id');
            $data['description']    = $_POST['description'];
            $data['user_id']        = $_SESSION['user_id'];
            $data['is_service']     = 1;

            if ($this->Item_model->save($data, $id))
            {
                if (!$id)
                {
                    $this->Item_model->increment_counter('service');
                }
                $_SESSION['success_toastr'] = $id ? lang('service_edited') : lang('service_added');
                $this->session->mark_as_flash('success_toastr');
                redirect('items/services');
            }
        }

        $this->admin_template('add_service', $this->data);
    }


    public function edit_services($id = false)
    {
        $this->add_service($id);
    }


    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('items/products');
        $item = $this->Item_model->get($id);
        $this->Item_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_item_delete');
        $this->session->mark_as_flash('success_toastr');
        if ($item->is_service == 1) {
            redirect('items/services');
        } else {
            redirect('items/products');
        }
    }

    //=============================================================
    //  Categories
    //=============================================================

    public function categories($id = null)
    {
        if ($id) {
            $this->data['category'] = $this->db->get_where('product_category', ['id' => $id])->row();
        }
        $this->data['categories'] = $this->db->get('product_category')->result();
        $this->admin_template('categories', $this->data);
    }

    /**
     * Deals with save category in product
     * @return bool|void
     */
    public function save_category()
    {
        $data['category'] = $this->input->post('category');

        if ($data['category'] == '')
        {
            echo json_encode(['danger', lang('category_field_required')]);
            return false;
        }

        $this->db->insert('product_category', $data);
        echo json_encode(['success', lang('record_saved')]);
        return true;
    }


    public function save_product_category()
    {
        $data = [];
        $data['category'] = $this->input->post('category');
        $id = $this->input->post('category_id');
        if ($id)
        {
            $this->db->where('id', $id);
            $this->db->update('product_category', $data);
            $this->message->save_success('items/categories');
        }
        else
        {
            $this->db->insert('product_category', $data);
            $this->message->save_success('items/categories');
        }
    }


    public function delete_category($id = null)
    {
        $item = $this->db->get_where('items', ['category_id' => $id])->row();

        if ($item)
        {
            $this->message->custom_error_msg('items/categories', lang('cannot_delete_category'));
        }
        else
        {
            // delete
            $this->db->delete('product_category', ['id' => $id]);
            $this->message->delete_success('items/categories');
        }
    }
}