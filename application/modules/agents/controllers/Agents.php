<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends MY_Controller 
{
	public $module = 'agents';


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Agent_model');
		$this->adminSecurity();
	}


	public function index()
	{
		$this->data['agents'] = $this->Agent_model->get_agents();
		//$this->data['datatables'] = true;

		$this->adminTemplate('index', $this->data);
	}


	public function suspend($agent_id)
    {
        $agent = $this->Agent_model->get($agent_id, true);
        if ($agent && count($agent))
        {
            $this->Agent_model->save(array('suspended' => 1), $agent_id);
            $this->session->set_flashdata('success', 'User has been successfully suspend');
            redirect('agents');
        }
    }


    public function activate($agent_id)
    {
        $agent = $this->Agent_model->get($agent_id, true);
        if ($agent && count($agent))
        {
            $this->Agent_model->save(array('access_id' => 4, 'suspended' => 0), $agent_id);
            $this->session->set_flashdata('success', 'User has been successfully Activated');
            redirect('agents');
        }
    }


	public function add($id = null)
	{
		// Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['agent'] = $this->Agent_model->get_agent($id);
            $this->data['agent'] && count($this->data['agent']) || redirect('agents');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['agent'] = $this->Agent_model->get_new();
            $this->data['id'] = false;
        }


        // process the form
        $this->load->library('form_validation');

        if (false != $this->data['id'])
        {
            if (isset($_POST['password']) && $_POST['password'] == '') {
                $rules = $this->Agent_model->get_rules_without_password();
            } else {
                $rules = $this->Agent_model->rules;
            }
        }
        else
        {
            $rules = $this->Agent_model->rules;
        }

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == true)
        {
            $data = $this->Agent_model->array_from_post([
                'username', 'user_language', 'nationality_id', 'address', 'email',
            ]);

            if (isset($_POST['password']) && $_POST['password'] != '')
            {
                $data['password'] = $this->site_security->_hash_string($this->input->post('password'));
                $data['access_id'] = 4;
            }

            $agent_id = $this->Agent_model->save($data, $id);
            $this->Agent_model->save_agent_representative($agent_id, $this->input->post('representative_id', true));
            $message = ($id == null) ? 'New agent added successfully' : 'Agent updated successfully';
            $this->session->set_flashdata('success', $message);
            redirect('agents');
        }

        $this->lang->load('services_entry');
        $this->load->module('services_entry');
        $this->data['nationalities'] = $this->services_entry->get_worker_nationalities();
        $this->data['representatives'] = $this->services_entry->get_representatives();
        $this->data['representative'] = $this->Agent_model->get_agent_representative($this->data['id']);
        $this->adminTemplate('add', $this->data);
	}


	public function delete($id = null)
    {
        $id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
        // delete item
        $this->Agent_model->delete($id);
        $this->session->set_flashdata('success', 'Agent Deleted Successfully');
        redirect('agents');
    }



     public function show($id = null)
    {
        if (! $this->input->is_ajax_request()) {
            redirect('agents');
        }

        if ($id && is_numeric($id))
        {
            $agent = $this->Agent_model->get($id);
            if ($agent && count($agent)) {
                echo json_encode($agent);
            }
        }
    }



    protected function do_upload($file_input_name)
    {
        $config['upload_path']          = FCPATH . "assets/img/agents";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 1024;
        $config['max_height']           = 2024;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (! $this->upload->do_upload($file_input_name))
        {
            $error = ['error' => $this->upload->display_errors()];
            return ['error' => $error];
        }
        else
        {
            // upload was done successfully
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            return ['file_name' => $file_name];
        }

        return false;

    }



        public function fetch()
    {
        if (! $this->input->is_ajax_request()) {
            redirect('agents');
        }

        $query = '';
        $output = [];
        $binds = [];
        $column = array('agents.name', 'agents.email', 'agents.country', 'agents.phone',
            'agents.image');

        $query = "SELECT * FROM agents ";
        if (isset($_POST['search']['value']) && !empty($_POST['search']['value']))
        {
            $query .= ' WHERE name LIKE ? ';
        }

        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' .
                $_POST['order']['0']['dir'] . ' ';
        }
        else
        {
            $query .= ' ORDER BY agents.id ';
        }

        if ($_POST['length'] != -1)
        {
            $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }


        if (isset($_POST['search']['value']) && !empty($_POST['search']['value']))
        {
            $binds[] = '%' . $_POST['search']['value'] . '%';
        }


        $q = $this->db->query($query, $binds);
        $result = $q->result_array();
        $data = [];
        $filtered_rows = count($result);
        foreach ($result as $row) {
            $sub_array = [];
            $sub_array[] = $row['name'];
            $sub_array[] = $row['email'];
            $sub_array[] = $row['country'];
            $sub_array[] = $row['phone'];
//            $sub_array[] = $row['image'];
            $sub_array[] = '
                <div class="btn-group">    
            <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu icons-left">             

                         <li><a href="" class="tips view-agent" title="" data-original-title="view"
                            data-agent="'.$row['id'].'">
                         <i class="glyphicon  glyphicon-search"></i> View </a></li>
                        <li><a href="'.site_url('agents/add/' . $row['id']).'" class="tips " title="" data-original-title="edit"> 
                        <i class="glyphicon glyphicon-edit"></i>  Edit </a> </li>
                        <li><a href="'.site_url('agents/delete/' . $row['id']).'" class="delete-btn">
                            <i class="glyphicon glyphicon-remove"></i> Delete</a></li>
                                    
            </ul>
          </div>
            ';
            $data[] = $sub_array;
        }

        $records_filtered = $this->db->count_all_results('agents');

        $output = [
            'draw' 				=> intval($_POST['draw']),
            'recordsTotal'		=> $filtered_rows,
            'recordsFiltered'	=> $records_filtered,
            'data'				=> $data
        ];

        echo json_encode($output);

    }


}