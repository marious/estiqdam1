<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
        $this->middleware->only(['check_permission:show_pages'], ['all']);
        $this->middleware->only(['check_permission:add_pages'], ['add']);
        $this->middleware->only(['check_permission:edit_pages'], ['edit']);
        $this->middleware->only(['check_permission:delete_pages'], ['delete']);
        $this->lang->load('offers');
        $this->load->model('Offer_model');
    }


    public function offer($id = false)
    {
        if ($id)
        {
            $id = decrypt($id);
            $this->data['offer'] = $this->Offer_model->get($id, true);
            if ($this->data['offer'])
            {
                $this->data['page_header'] = transText($this->data['offer']->offer_heading, get_current_front_lang());

                $this->public_template('offer', $this->data);
            } else {
                redirect(site_url());
            }
        } else {
            redirect(site_url());
        }

    }


    public function all()
    {
        $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
        $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
            base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/offers.js'];
        $this->data['page_header'] = lang('all_offers');
        $this->admin_template('all', $this->data);
    }


    public function load_all_offers()
    {
        $this->Offer_model->get_all_offers();
    }

    public function add($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_offer') : lang('add_offer');
        $this->data['css_file'] = [base_url() . '/assets/admin/css/summernote.css', base_url() . '/assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css'];
        $this->data['js_file'] = [base_url() . '/assets/admin/js/summernote.js', base_url() . 'assets/admin/js/handle_editor.js', base_url() . '/assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js'];

        if ($id && is_numeric($id))
        {
            $this->Offer_model->get($id) || redirect('offers/all');
            $this->data['offer'] = $this->Offer_model->get($id);
        }
        else
        {
            $this->data['offer'] = $this->Offer_model->get_new();
        }

        $this->data['id'] = $id;


        if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
        {
            if ($file = $this->Offer_model->do_upload($this->Offer_model->upload_path, 'image')) {
                $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
            }
        }

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Offer_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            if (isset($_SESSION['error']))
            {
                $this->session->mark_as_flash('error');
                $this->admin_template('add', $this->data);
                return;
            }

            $data['offer_heading'] = addToJson($this->input->post('ar_offer_heading'), $this->input->post('en_offer_heading'));
            $data['offer_content'] = addToJson($this->input->post('ar_offer_content'), $this->input->post('en_offer_content'));
            $data['start_at'] =  date('Y-m-d H:i:s', strtotime($this->input->post('start_at')));
            $data['end_at'] =  date('Y-m-d H:i:s', strtotime($this->input->post('end_at')));

            $this->Offer_model->save($data, $id);
            $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
            $this->session->mark_as_flash('success');
            redirect('offers/all');
        }

        $this->admin_template('add', $this->data);

    }


    public function edit($id)
    {
        $this->add($id);
    }


    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('offers/all');
        $this->Offer_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_delete');
        $this->session->mark_as_flash('success_toastr');
        redirect('offers/all');
    }
}