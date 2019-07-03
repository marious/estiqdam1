<?php 
class Slider extends MY_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
        $this->middleware->only(['check_permission:show_slider'], ['all']);
        $this->middleware->only(['check_permission:add_slider'], ['add']);
        $this->middleware->only(['check_permission:edit_slider'], ['edit']);
        $this->middleware->only(['check_permission:delete_slider'], ['delete']);
        $this->load->model('Slider_model');
        $this->lang->load('slider');
    }


    public function get_all()
    {
        return $this->Slider_model->get_by(['status' => '1']);
    }


    public function all()
    {
        $this->data['page_header'] = lang('all_sliders');
        $this->load_datatable();
        array_push($this->data['js_file'], site_url('assets/admin/js/slider.js'));
        $this->admin_template('all', $this->data);
    }


    public function load_all_sliders()
    {
        $this->Slider_model->get_all();
    }


    public function add($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_slider')  :
            lang('add_new_slider');

        if ($id && is_numeric($id))
        {
            $slider = $this->Slider_model->get($id);
            $slider || redirect('slider');
            $this->data['slider'] = $slider;    // Check if valid slider id 
        }
        else
        {
            $this->data['slider'] = $this->Slider_model->get_new();
        }

        $this->data['id'] = $id;


            

        // Process the form 
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Slider_model->rules);




        // Upload the slider image
        // only required on first adding not updating so we put $id == false
        if (isset($_FILES['image']) && $_FILES['image'] != '' && $id == false)
        {
           
            if ($file = $this->Slider_model->do_upload($this->Slider_model->upload_path, 'image')) {
                $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
            }
        }

    
        if ($this->form_validation->run($this) == true)
        {

            if (isset($_SESSION['error']))
            {
                $this->session->mark_as_flash('error');
                $this->admin_template('add', $this->data);
                return;
            }
            $data['heading'] = addToJson($this->input->post('ar_heading'), $this->input->post('en_heading'));
            $data['content'] = addToJson($this->input->post('ar_content'), $this->input->post('en_content'));
            $data['button_text'] = addToJson($this->input->post('ar_button_text'), $this->input->post('en_button_text'));
            $data['position'] = $this->input->post('position');
            $data['status'] = $this->input->post('status');
            $data['button_url'] = $this->input->post('button_url');
            $this->Slider_model->save($data, $id);
            $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
            $this->session->mark_as_flash('success');
            redirect('slider/all');

        }


        


        $this->admin_template('add', $this->data);
    }


    public function edit($id)
    {
        $this->add($id);
    }


    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('slider/all');
        $this->Slider_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_delete');
        $this->session->mark_as_flash('success_toastr');
        redirect('slider/all');
    }





    public function _valid_position()
    {
        $position = $this->input->post('position');
        if (!in_array($position, array('Left', 'Right', 'Center')))
        {
            $this->form_validation->set_message('_valid_position', lang('unkown_position'));
            return false;
        }
        return true;
    }


    public function _valid_status()
    {
        $status = $this->input->post('status');
        if (!in_array($status, array('1', '0')))
        {
            $this->form_validation->set_message('_valid_status', lang('unkown_status'));
            return false;
        }
        return true;
    }



    
}