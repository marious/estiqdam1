<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_pages extends MY_Controller
{

    public $module = 'seo_pages';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Seo_pages_model');
//        $this->adminSecurity();
        $this->load->library('form_validation');
    }


    public function index()
    {
        $this->data['seo_pages'] = $this->Seo_pages_model->get();
        $this->adminTemplate('index', $this->data);
    }


    public function add($id = null)
    {
        $this->data['ckeditor'] = true;

        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['seo_page'] = $this->Seo_pages_model->get($id);
            count($this->data['seo_page']) || redirect('seo_pages/index');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['seo_page'] = $this->Seo_pages_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        //$this->load->library('form_validation');
        $this->form_validation->set_rules($this->Seo_pages_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Seo_pages_model->array_from_post([
                'title',
            ]);
            $data['content'] = $this->input->post('content', false);
            $this->Seo_pages_model->save($data, $id);
            $message = ($id == null) ? 'New Seo Page Added Successfully' : 'Seo Page Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('seo_pages');
        }

        $this->adminTemplate('add', $this->data);
    }



    public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Seo_pages_model->delete($id);
        $this->session->set_flashdata('success', 'SEO Page Deleted Successfully');
        redirect('seo_pages');
    }







}