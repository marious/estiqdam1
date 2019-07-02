<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends MY_Controller 
{

  public function __construct()
  {
      parent::__construct();
      $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
      $this->middleware->only(['check_permission:show_services'], ['all']);
      $this->middleware->only(['check_permission:add_services'], ['add']);
      $this->middleware->only(['check_permission:edit_services'], ['edit']);
      $this->middleware->only(['check_permission:delete_services'], ['delete']);
      $this->lang->load('services');
      $this->load->model('Service_model');
  }

    public function item($slug = false)
    {
        if ($slug)
        {
            $slug = urldecode($slug);
            $service = $this->Service_model->get_service_by_slug($slug);
            if ($service)
            {
                $this->data['service'] = $service;
                $this->public_template('service_item', $this->data);
            }
            else
            {
                redirect(site_url());

            }
        }
    }


  public function get_all()
  {
      return $this->Service_model->get();
  }


  public function all()
  {
      $this->data['page_header'] = lang('all_services');
      $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
      $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
          base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/services.js'];
      $this->admin_template('all', $this->data);
  }

  public function load_all_services()
  {
      $this->Service_model->get_all_services();
  }


  public function add($id = null)
  {
    $this->data['page_header'] = $id && is_numeric($id) ? '<i class="fa fa-arrow-circle-o-right"></i> '.lang('edit_service')  : '<i class="fa fa-arrow-circle-o-right"></i> '.lang('add_new_service');
    $this->data['css_file'] = [base_url() . '/assets/admin/css/summernote.css'];
    $this->data['js_file'] = [base_url() . '/assets/admin/js/summernote.js', base_url() . 'assets/admin/js/handle_editor.js'];

      if ($id && is_numeric($id))
      {
            $this->Service_model->get($id) || redirect('services/all');     // check if valid service id
            $this->data['service'] = $this->Service_model->get($id);
            $this->data['id'] = $id;    // flag used in view
      }
      else if ($id == null)
      {
          $this->data['service'] = $this->Service_model->get_new();
          $this->data['id'] = false;
      }



      // Process the form
      $this->load->library('form_validation');
      $this->form_validation->set_rules($this->Service_model->rules);

      // upload featured image
      // Will produce $_SESSION['error'] is something happen
      if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
      {
          if ($file = $this->Service_model->do_upload($this->Service_model->upload_path, 'image')) {
              $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
          } 
      }

      // upload banner image
      // Will produce $_SESSION['error'] is something happen
      if (isset($_FILES['banner']) && $_FILES['banner']['name'] != '')
      {
          if ($file = $this->Service_model->do_upload($this->Service_model->upload_path, 'banner')) {
              $data['banner'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
          } 
      }



      if ($this->form_validation->run($this) == TRUE)
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
            $this->Service_model->save($data, $id);
            $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
            $this->session->mark_as_flash('success');
            redirect('services/all');
      }
    $this->admin_template('add', $this->data);
  }


  public function edit($id)
  {
      $this->add($id);
  }



  public function delete($id = null) 
  {
      $id && is_numeric($id) || redirect('services/all');
      $this->Service_model->delete($id);
      $_SESSION['success'] = lang('success_delete');
      $this->session->mark_as_flash('success');
      redirect('services/all');
  }

}