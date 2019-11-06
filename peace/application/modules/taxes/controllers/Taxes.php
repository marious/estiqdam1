<?php
class Taxes extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('settings');
        $this->load->model('Tax_model');
    }


    public function all()
    {
        $data['taxes'] = $this->Tax_model->get();
        echo json_encode($data);
    }


    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Tax_model->rules);
        if ($this->form_validation->run() == true)
        {
            $data = [
                'name' => $this->input->post('name'),
                'rate' => $this->input->post('rate'),
                'tax_authority' => $this->input->post('tax_authority'),
            ];
            if ($this->Tax_model->save($data))
            {
                $result['error'] = false;
                $result['msg'] = lang('new_tax_added');
            }
        } else {
            $result['error'] = true;
            $result['msg'] = [
                'name' => form_error('name'),
                'rate' => form_error('rate'),
                'tax_authority' => form_error('tax_authority'),
            ];
        }
        echo json_encode($result);

    }


    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Tax_model->rules);
        if ($this->form_validation->run() == true)
        {
            $id = $this->input->post('id');
            $data = [
                'name' => $this->input->post('name'),
                'rate' => $this->input->post('rate'),
                'tax_authority' => $this->input->post('tax_authority'),
            ];

            if ($this->Tax_model->save($data, $id)) {
                $result['error'] = false;
                $result['msg'] = lang('tax_updated');
            }

        }
        else
        {
            $result['error'] = true;
            $result['msg'] = [
                'name' => form_error('name'),
                'rate' => form_error('rate'),
                'tax_authority' => form_error('tax_authority'),
            ];
        }
        echo json_encode($result);
    }



    public function delete()
    {
        $id = $this->input->post('id');
        if ($this->Tax_model->delete($id))
        {
            $msg['error'] = false;
            $msg['msg'] = lang('tax_deleted');
        } else {
            $msg['error'] = true;
        }
        echo json_encode($msg);
    }
}