<?php
class Currencies extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Currency_model');
        $this->lang->load('settings');
    }

    public function all()
    {
        $data['currencies'] = $this->Currency_model->get();
        echo json_encode($data);
    }

    public function add()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Currency_model->rules);
        if ($this->form_validation->run() == true)
        {
            $data = [
                'symbol' => $this->input->post('symbol'),
                'code' => $this->input->post('code'),
                'created_at' => time(),
            ];
            if ($this->Currency_model->save($data))
            {
                $result['error'] = false;
                $result['msg'] = lang('new_currency_added');
            }
        } else {
            $result['error'] = true;
            $result['msg'] = [
                'code' => form_error('code'),
                'symbol' => form_error('symbol'),
            ];
        }
        echo json_encode($result);
    }


    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Currency_model->rules);
        if ($this->form_validation->run() == true)
        {
            $id = $this->input->post('id');
            $data = [
                'symbol' => $this->input->post('symbol'),
                'code' => $this->input->post('code'),
            ];

            if ($this->Currency_model->save($data, $id)) {
                $result['error'] = false;
                $result['msg'] = lang('currency_updated');
            }

        }
        else
        {
            $result['error'] = true;
            $result['msg'] = [
                'code' => form_error('code'),
                'symbol' => form_error('symbol'),
            ];
        }
        echo json_encode($result);
    }


    public function delete()
    {
        $id = $this->input->post('id');
        if ($this->Currency_model->delete($id))
        {
            $msg['error'] = false;
            $msg['msg'] = lang('currency_deleted');
        } else {
            $msg['error'] = true;
        }
        echo json_encode($msg);
    }
}