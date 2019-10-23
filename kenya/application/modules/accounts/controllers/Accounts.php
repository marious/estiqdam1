<?php
class Accounts extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->execute_middlewares(['not_authinticated']);
        $this->middleware->only(['check_permission:show_accounts'], ['chart_of_account']);
        $this->middleware->only(['check_permission:add_account'], ['add_account']);
        $this->middleware->only(['check_permission:edit_account'], ['edit_account']);
        $this->middleware->only(['check_permission:delete_account'], ['delete_account']);

        $this->lang->load('transactions');
    }

    public function chart_of_account()
    {
        $account_type = $this->db->get('account_type')->result();

        $result = [];
        foreach ($account_type as $type) {
            $tem_head = $this->db->select('account_head.*, account_type.account_type')
                ->from('account_head')
                ->join('account_type', 'account_head.account_type_id = account_type.id', 'left')
                ->where('account_head.account_type_id', $type->id)
                ->get()
                ->result();

            foreach ($tem_head as $item) {
                $result[] = $item;
            }
        }


        $this->data['account_head'] = $result;
        $this->admin_template('chart_of_account', $this->data);

    }

    public function add_account()
    {
        $data['countries'] = $this->db->get('countries')->result();
        $data['modal_subview'] = $this->load->view('_modal/add_account', $data, false);
    }

    public function save_new_account()
    {
        $id = $this->input->post('id');
        if (!empty($id))
        {
            $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
            if (empty($id))
            {
                $this->message->norecord_found('accounts/chart_of_account');
            }
        }

        $this->form_validation->set_rules('account_title', lang('account_title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('account_number', lang('account_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('balance', lang('balance'), 'trim|xss_clean|numeric');

        if (MULTI_CURRENCY)
        {
            $this->form_validation->set_rules('account_currency', lang('account_currency'), 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE)
        {
            $data['account_title']              = $this->input->post('account_title');
            $data['description']                = $this->input->post('description');
            $data['account_number']             = $this->input->post('account_number');
            if (empty($id)) {
                $data['balance']                    = $this->input->post('balance') ? $this->input->post('balance') : 0;
            }
            $data['account_type_id']            = 1;
            $data['account_currency']           = MULTI_CURRENCY ? $this->input->post('account_currency') : setting('default_currency');

            if ($id) {
                $this->db->where('id', $id);
                $this->db->update('account_head', $data);
            } else {
                $this->db->insert('account_head', $data);
            }
            $this->message->save_success('accounts/chart_of_account');
        }
        else
        {
            $error = validation_errors();
            $this->message->custom_error_msg('accounts/chart_of_account', $error);
        }
    }

    public function edit_account($id = null)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $result = $this->db->get_where('account_head', [
            'id' => $id,
        ])->row();
        $result == TRUE || $this->message->norecord_found('accounts/chart_of_account');
        $data['account'] = $result;
        $data['countries'] = $this->db->get('countries')->result();

        $data['modal_subview'] = $this->load->view('_modal/add_account', $data, false);
    }


    public function delete_account($id = null)
    {
        $id = $this->encryption->decrypt(str_replace(array('-', '_', '~'), array('+', '/', '='), $id));
        $id == TRUE || $this->message->norecord_found('accounts/chart_of_account');

        $result = $this->db->get_where('transactions', [
            'account_id' => $id,
        ])->row();

        if ($result)
        {
            $this->message->custom_error_msg('accounts/chart_of_account', lang('record_has_been_used'));
        }
        else
        {
            $this->db->delete('account_head', ['id' => $id]);
            $this->message->delete_success('accounts/chart_of_account');
        }
    }


}