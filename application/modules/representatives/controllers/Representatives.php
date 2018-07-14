<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Representatives extends MY_Controller 
{
	public $module = 'representatives';


	public function __construct()
	{
		parent::__construct();
		$this->adminSecurity();
		$this->load->model('Representative_model');
		$this->adminSecurity();
	}


	public function index()
	{
		$this->data['representatives'] = $this->Representative_model->get();
		$this->data['datatables'] = true;
		$this->adminTemplate('index', $this->data);
	}


	  public function add($id = null)
    {
        // Fetch one or set new one
        if ($id && is_numeric($id))
        {
            $this->data['representative'] = $this->Representative_model->get($id);
            count($this->data['representative']) || redirect('representatives');
            $this->data['id'] = $id;    // flag to used in view
        }
        else if ($id == null)
        {
            $this->data['representative'] = $this->Representative_model->get_new();
            $this->data['id'] = false;
        }

        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Representative_model->rules);
        if ($this->form_validation->run() == true)
        {
            $data = $this->Representative_model->array_from_post([
                'name',
            ]);

            $this->Representative_model->save($data, $id);
            $message = ($id == null) ? 'New representative added successfully' : 'Representative updated successfully';
            $this->session->set_flashdata('success', $message);
            redirect('representatives');
        }

        $this->adminTemplate('add', $this->data);
    }



	public function delete($id = null)
	{
		$id && is_numeric($id) || redirect(static::ADMIN_NOTALLOWED_REDIRECT);
		// delete item
		$this->Representative_model->delete($id);
		$this->session->set_flashdata('success', 'Represenstative Deleted Successfully');
		redirect('representatives');
	}





	public function show($id = null)
	{
	    if (! $this->input->is_ajax_request()) {
	        redirect('representatives');
	    }

	    if ($id && is_numeric($id))
	    {
	        $represenstative = $this->Representative_model->get($id);
	        if ($represenstative && count($represenstative)) {
	            echo json_encode($represenstative);
	        }
	    }
	}



	    public function fetch()
	    {
	        if (! $this->input->is_ajax_request()) {
	            redirect('representatives');
	        }

	        $query = '';
	        $output = [];
	        $binds = [];
	        $column = array('representatives.name');

	        $query = "SELECT * FROM representatives ";
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
	            $query .= ' ORDER BY representatives.id ';
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
	//            $sub_array[] = $row['image'];
	            $sub_array[] = '
	                <div class="btn-group">    
	            <button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	            <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
	            </button>
	            <ul class="datatable-dropdown dropdown-menu icons-left">             

	                         <li><a href="" class="tips view-representative" title="" data-original-title="view"
	                            data-representative="'.$row['id'].'">
	                         <i class="glyphicon  glyphicon-search"></i> View </a></li>
	                        <li><a href="'.site_url('representatives/add/' . $row['id']).'" class="tips " title="" data-original-title="edit"> 
	                        <i class="glyphicon glyphicon-edit"></i>  Edit </a> </li>
	                        <li><a href="'.site_url('representatives/delete/' . $row['id']).'" class="delete-btn">
	                            <i class="glyphicon glyphicon-remove"></i> Delete</a></li>
	                                    
	            </ul>
	          </div>
	            ';
	            $data[] = $sub_array;
	        }

	        $records_filtered = $this->db->count_all_results('representatives');

	        $output = [
	            'draw' => intval($_POST['draw']),
	            'recordsTotal'		=> $filtered_rows,
	            'recordsFiltered'	=> $records_filtered,
	            'data'				=> $data
	        ];

	        echo json_encode($output);

	    }



	protected function do_upload($file_input_name)
    {
        $config['upload_path']          = FCPATH . "assets/img/representatives";
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


}