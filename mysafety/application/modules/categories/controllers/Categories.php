<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
        $this->middleware->only(['check_permission:show_categories'], ['all']);
        $this->middleware->only(['check_permission:add_categories'], ['add']);
        $this->middleware->only(['check_permission:edit_categories'], ['edit']);
        $this->middleware->only(['check_permission:delete_categories'], ['delete']);
        $this->lang->load('categories');
        $this->load->model('Category_model');
    }




    public function item($slug = false)
    {
        if ($slug)
        {
            $slug = urldecode($slug);
            $category = $this->Category_model->get_by_slug($slug);
            if ($category)
            {
                $this->data['category'] = $category;
                $this->public_template('item', $this->data);
            }
            else
            {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }

    }


    public function product($slug = false)
    {
        if ($slug)
        {
            $slug = urldecode($slug);
            $this->load->module('products');
            $product = $this->products->Product_model->get_by_slug($slug);
            if ($product)
            {
                $this->data['product'] = $product;
                $this->public_template('product', $this->data);
            }
            else
            {
                redirect(site_url());
            }
        }
        else
        {
            redirect(site_url());
        }
    }




    public function get_all()
    {
      return $this->Category_model->get();
    }



    public function all()
    {
      $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
      $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
          base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/categories.js'];
        $this->data['page_header'] = lang('all_categories');
        $this->admin_template('all', $this->data);
    }


    public function load_all_categories()
    {
        $this->Category_model->get_all_categories();
    }



    public function add($id = false)
    {
      $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_category')  : lang('add_new_category');
      $this->data['css_file'] = [base_url() . '/assets/admin/css/summernote.css'];
      $this->data['js_file'] = [base_url() . '/assets/admin/js/summernote.js', base_url() . 'assets/admin/js/handle_editor.js'];

      $this->load->module('services');
      $this->data['services'] = $this->services->Service_model->get();

      if ($id && is_numeric($id))
      {
          $this->Category_model->get($id) || redirect('categories/all');     // check if valid category id
          $this->data['category'] = $this->Category_model->get($id);
      } 
      else
      {
          $this->data['category'] = $this->Category_model->get_new();
          $this->data['category']->service_id = '';
      }

      $this->data['id'] = $id;

      // upload featured image
      // Will produce $_SESSION['error'] is something happen
      if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
      {
          if ($file = $this->Category_model->do_upload($this->Category_model->upload_path, 'image')) {
              $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
          } 
      }

      // Process the form 
      $this->load->library('form_validation');
      $this->form_validation->set_rules($this->Category_model->rules);

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
          $data['service_id'] = $this->input->post('service_id');
          
          $this->Category_model->save($data, $id);
          $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
          $this->session->mark_as_flash('success');
          redirect('categories/all');
      }

      $this->admin_template('add', $this->data);
    }



    public function edit($id)
    {
        $this->add($id);
    }


    public function delete($id = false)
    {
      $id && is_numeric($id) || redirect('categories/all');
      $this->Category_model->delete($id);
      $_SESSION['success'] = lang('success_delete');
      $this->session->mark_as_flash('success');
      redirect('categories/all');
    }


    public function _valid_service_id()
    {
      $service_id = $this->input->post('service_id');
      if ($service_id == 0) {
        $this->form_validation->set_message('_valid_service_id', 'The Service Field is required');
        return false;
      }
      $this->load->module('services');
      $service = $this->services->Service_model->get($service_id);
      if (!$service) {
        $this->form_validation->set_message('_valid_service_id', 'The Service Field is required');
        return false;
      }
      return true;
    }

}
