<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
        $this->middleware->only(['check_permission:show_products'], ['all']);
        $this->middleware->only(['check_permission:add_products'], ['add']);
        $this->middleware->only(['check_permission:edit_products'], ['edit']);
        $this->middleware->only(['check_permission:delete_products'], ['delete']);
        $this->lang->load('products');
        $this->load->model('Product_model');
    }


    public function all()
    {
        $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
        $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
            base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/products.js'];
        $this->data['page_header'] = lang('all_products');
        $this->admin_template('all', $this->data);
    }

    public function load_all_products()
    {
        $this->Product_model->get_all_products();
    }



    public function product($id = false)
    {
        if($id && is_numeric($id))
        {
            $this->data['product'] = $this->Product_model->get($id);
            $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
            $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
            base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/product.js'];
            $this->data['product'] || redirect('products/all');   // check if valid products id 
            $this->data['page_header'] = lang('product_images');


            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
                {
                if ($file = $this->Product_model->do_upload($this->Product_model->upload_path, 'image')) {
                        $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
                        $this->Product_model->save_image_for_product($id, $data['image']);
                        echo json_encode([true, 'Image Uploaded Successfully']);
                        exit;
                    } else {
                        if (isset($_SESSION['error'])) {
                            $error = $_SESSION['error'];
                            unset($_SESSION['error']);
                            echo json_encode([false, $error]);
                            exit;
                        }
                    }
                }
            }

            $this->admin_template('product', $this->data);

        }   
        else {
            redirect('products/all');
        }
    }



    public function load_all_product_images($id)
    {
        $this->Product_model->get_product_images($id);
    }



    public function delete_product_image($id)
    {
        if ($id && is_numeric($id)) {
            $product = $this->db->get_where('product_images', ['id' => $id])->row();
            if ($this->db->delete('product_images', ['id' => $id])) {
                unlink(FCPATH . $product->image);
                $_SESSION['success_toastr'] = 'Image Deleted Successfully';
                $this->session->mark_as_flash('success_toastr');
                redirect(site_url('products/product/' . $product->product_id));
            }
        }
    }


    public function add($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_product')  : lang('add_new_product');
        $this->data['css_file'] = [base_url() . '/assets/admin/css/summernote.css'];
        $this->data['js_file'] = [base_url() . '/assets/admin/js/summernote.js', base_url() . 'assets/admin/js/handle_editor.js'];

        $this->load->module('categories');
        $this->data['categories'] = $this->categories->Category_model->get();

        if ($id && is_numeric($id))
        {
            $this->Product_model->get($id) || redirect('products/all');     // check if valid produt id 
            $this->data['product'] = $this->Product_model->get($id);
        }
        else
        {
            $this->data['product'] = $this->Product_model->get_new();
            $this->data['product']->category_id = '';
        }

        $this->data['id'] = $id;


        // Will produce $_SESSION['error'] is something happen
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
        {
            if ($file = $this->Product_model->do_upload($this->Product_model->upload_path, 'image')) {
                $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
            }
        }

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Product_model->rules);

        if ($this->form_validation->run($this) == true)
        {
            if (isset($_SESSION['error']))
            {
                $this->session->mark_as_flash('error');
                $this->admin_template('add', $this->data);
                return;
            }

            $data['name'] = addToJson($this->input->post('ar_name'), $this->input->post('en_name'));
            $data['description'] = addToJson($this->input->post('ar_description'), $this->input->post('en_description'));
            $data['slug'] = addToJson(make_slug($this->input->post('ar_name'), 'ar'), make_slug($this->input->post('en_name'), 'en'));
            $data['category_id'] = $this->input->post('category_id');

            $this->Product_model->save($data, $id);
            $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
            $this->session->mark_as_flash('success');
            redirect('products/all');
        }
        $this->admin_template('add', $this->data);

    }



    public function edit($id)
    {
        $this->add($id);
    }

    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('products/all');
        $this->Product_model->delete($id);
        $_SESSION['success'] = lang('success_delete');
        $this->session->mark_as_flash('success');
        redirect('products/all');
    }



    public function _valid_category_id()
    {
        $category_id = $this->input->post('category_id');
        if ($category_id == 0) {
            $this->form_validation->set_message('_valid_category_id', 'The Category Field is required');
            return false;
        }
        $this->load->module('categories');
        $category = $this->categories->Category_model->get($category_id);
        if (!$category) {
            $this->form_validation->set_message('_valid_category_id', 'The Category Field is required');
            return false;
        }
        return true;
    }
}