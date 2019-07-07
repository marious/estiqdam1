<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware->only(['not_authinticated'], ['all', 'add', 'edit', 'delete']);
        $this->middleware->only(['check_permission:show_news'], ['all']);
        $this->middleware->only(['check_permission:add_news'], ['add']);
        $this->middleware->only(['check_permission:edit_news'], ['edit']);
        $this->middleware->only(['check_permission:delete_news'], ['delete']);
        $this->lang->load('news');
        $this->load->model('News_model');
    }


    public function item($slug = false)
    {
        if ($slug)
        {
            $slug = urldecode($slug);
            $news = $this->News_model->get_news_by_slug($slug);
            if ($news)
            {
                $this->data['news'] = $news;
                $this->data['page_header'] = transText($this->data['news']->slug, get_current_front_lang());

                $this->public_template('news_item', $this->data);
            }
            else
            {
                redirect('page/news');

            }
        }
    }


    public function get_latest()
    {
        return $this->News_model->get_latest_news();
    }


    public function all()
    {
        $this->data['css_file'] = [base_url(). '/assets/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'];
        $this->data['js_file'] = [base_url(). '/assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js',
            base_url(). '/assets/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', base_url() . '/assets/admin/js/news.js'];
        $this->data['page_header'] = lang('all_news');
        $this->admin_template('all', $this->data);
    }


    public function load_all_news()
    {
        $this->News_model->get_all_news();
    }


    public function add($id = false)
    {
        $this->data['page_header'] = $id && is_numeric($id) ? lang('edit_news')  : lang('add_news');
        $this->data['css_file'] = [base_url() . '/assets/admin/css/summernote.css'];
        $this->data['js_file'] = [base_url() . '/assets/admin/js/summernote.js', base_url() . 'assets/admin/js/handle_editor.js'];

        if ($id && is_numeric($id))
        {
            $this->News_model->get($id) || redirect('news/all');     // check if valid news id

            $this->data['news'] = $this->News_model->get($id);
        }
        else
        {
            $this->data['news'] = $this->News_model->get_new();
        }

        $this->data['id'] = $id;

        // Will produce $_SESSION['error'] is something happen
        if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
        {
            if ($file = $this->News_model->do_upload($this->News_model->upload_path, 'image')) {
                $data['image'] = substr($file['full_path'], strpos($file['full_path'], 'assets'));
            }
        }

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->News_model->rules);
        if ($this->form_validation->run($this) == true)
        {
            if (isset($_SESSION['error']))
            {
                $this->session->mark_as_flash('error');
                $this->admin_template('add', $this->data);
                return;
            }

            $data['name'] = addToJson($this->input->post('ar_name'), $this->input->post('en_name'));
            $data['description'] = addToJson($this->input->post('ar_description'), $this->input->post('en_description'));
            $data['slug'] = addToJson(make_slug($this->input->post('ar_name'), 'ar'), make_slug($this->input->post('en_name'), 'en'));

            $this->News_model->save($data, $id);
            $_SESSION['success'] = $id ? lang('scucess_edit') : lang('success_add');
            $this->session->mark_as_flash('success');
            redirect('news/all');
        }

        $this->admin_template('add', $this->data);
    }


    public function edit($id)
    {
        $this->add($id);
    }


    public function delete($id = false)
    {
        $id && is_numeric($id) || redirect('news/all');
        $this->News_model->delete($id);
        $_SESSION['success_toastr'] = lang('success_delete');
        $this->session->mark_as_flash('success_toastr');
        redirect('news/all');
    }


}
