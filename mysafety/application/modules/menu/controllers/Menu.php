<?php 

class Menu extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
    }


    public function get_menu()
    {
        return $this->Menu_model->get_menu();
    }


    public function index()
    { 
        $this->data['page_header'] = 'Manage Menu';
        $this->data['css_file'] = [site_url('assets/admin/plugins/iCheck/all.css')];
        $this->data['js_file'] = [site_url('assets/admin/plugins/jquery.nestable/jquery.nestable.js'), site_url('assets/admin/plugins/iCheck/icheck.min.js'), site_url('assets/admin/js/menu.js')];
        $this->data['c_menu'] = $this->Menu_model->get_new();
        $this->data['icheck'] = true;
        $this->load->module('pages');
        $this->data['pages'] = $this->pages->Page_model->get();
        $this->data['id'] = false;


        $this->data['menus'] = $this->Menu_model->get_menu('top', 0);
        $this->admin_template('index', $this->data);
    }



    public function save_order()
    {
        $menus = json_decode($this->input->post('reorder'), true);



			$child = array();
			$a=0;
			foreach($menus as $m)
			{			
				if(isset($m['children']))
				{
					$b=0;
					foreach($m['children'] as $l)					
					{
						if(isset($l['children']))
						{
							$c=0;
							foreach($l['children'] as $l2)
							{
                $level3[] = $l2['id'];
                $this->db->where('id', $l2['id']);
                $this->db->update('menu', array('parent_id'=> $l['id'],'ordering'=>$c));
								$c++;	
							}		
            }
            $this->db->where('id', $l['id']);
            $this->db->update('menu', array('parent_id'=> $m['id'],'ordering'=>$b));
						$b++;
					}							
        }
        $this->db->where('id', $m['id']);
        $this->db->update('menu', array('parent_id'=>'0','ordering'=>$a) );
				$a++;		
			}


        redirect('menu');
    }


    public function save($id = false)
    {

        $this->data['page_header'] = 'Manage Menu';
        $this->data['css_file'] = [site_url('assets/admin/plugins/iCheck/all.css')];
        $this->data['js_file'] = [site_url('assets/admin/plugins/jquery.nestable/jquery.nestable.js'), site_url('assets/admin/plugins/iCheck/icheck.min.js'), site_url('assets/admin/js/menu.js')];
        $this->data['icheck'] = true;
        $this->load->module('pages');
        $this->data['pages'] = $this->pages->Page_model->get();
        $this->data['menus'] = $this->Menu_model->get_menu('top', 0);

        $rules = [
            [
                'field' => 'menu_name',
                'label' => 'Menu Name',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'active',
                'label' => 'active',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'page',
                'label' => 'Page',
                'rules' => 'trim|required',
            ]
        ];


        if (isset($id) && is_numeric($id))
        {
            $this->Menu_model->get($id) || redirect('menu');     // check if valid menu id
            $this->data['c_menu'] = $this->Menu_model->get($id);
        }
        else 
        {
            $this->data['c_menu'] = $this->Menu_model->get_new();
        }


        $this->data['id'] = $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);
        $data = [];
        if ($this->form_validation->run($this) == true)
        {
            $data['menu_name'] = $this->input->post('menu_name');
            $data['active'] = $this->input->post('active');
            $data['page'] = $this->input->post('page');
            $menu_lang = isset($_POST['language_title']) ? $this->input->post('language_title') : '';
            $language = [];
            $language['title']['id'] = $menu_lang;
            $data['menu_lang'] = json_encode($language);
            $this->Menu_model->save($data, $id);
            redirect('menu');
        }

        $_SESSION['error'] = validation_errors();
        $this->session->mark_as_flash('error');
        $this->admin_template('index', $this->data);
    }



    public function delete($id)
    {
        $id && is_numeric($id) || redirect('menu');
        $this->Menu_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_delete');
        $this->session->mark_as_flash('success_toastr');
        redirect('menu');
    }




}