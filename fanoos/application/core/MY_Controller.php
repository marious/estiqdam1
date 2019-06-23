<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller 
{

  
 public $data = [];

  public function __construct()
  {
      parent::__construct();
      $this->data['css_file'] = [];
      $this->data['js_file'] = [];
      $this->load->module('templates');
      $this->lang->load('general');
      if (!isset($this->data['view_module']))
      {
          $this->data['view_module'] = $this->uri->segment(1);
      }

      $this->data['logged_in_user_permissions'] = [];
    if (isset($_SESSION['user_id']))
    {
        $this->data['logged_in_user_permissions'] = Modules::run('roles/get_active_user_permissions');
    }

    $this->data['lang'] = 'en';

  }


    /**
     * Load i check plugin
     */
    public function load_icheck()
    {
        $this->data['css_file'] = [site_url('assets/admin/plugins/iCheck/all.css')];
        $this->data['js_file'] = [site_url('assets/admin/plugins/iCheck/icheck.min.js')];
        $this->data['icheck'] = true;
    }


    public function load_datepicker()
    {
        array_push($this->data['css_file'], site_url('assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'));
        array_push($this->data['js_file'], site_url('assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')) ;
        $this->data['datepicker'] = true;
    }

    public function load_datatable()
    {
        array_push($this->data['css_file'], site_url( 'assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'));
        array_push($this->data['js_file'], site_url( 'assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js'));
        array_push($this->data['js_file'], site_url('assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'));
    }


  /**
   * admin template view 
   * @param $view_file
   * @param $data
   */
  public function admin_template($view_file, $data) 
  {
      $data['view_file'] = $view_file;
      $this->templates->admin_temp($data);
  }



  /**
   * public template view 
   * @param $view_file
   * @param $data
   */
  public function public_template($view_file, $data)
  {
      $data['view_file'] = $view_file;
      $this->templates->public_temp($data);
  }




}