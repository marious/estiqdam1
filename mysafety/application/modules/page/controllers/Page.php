<?php
class Page extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_m');

    }


    public function index()
    {
        $slug = $this->uri->segment(2);

        if ($this->Page_m->slug_exist($slug))
        {
            $page = $this->Page_m->get_page_slug($slug);
            $page_layout = $this->Page_m->get_method_layout($page->page_layout);
            $method = $page_layout->method;
            if (method_exists($this, $method)) {
                $this->$method($page);
                return;
            }

        }
    }



    private function main($page)
    {
        $this->data['page_header'] = transText($page->name, get_current_front_lang());
        $this->data['page'] = $page;
        $this->public_template('main', $this->data);
    }


    private function news()
    {

        $this->data['page_header'] = lang('news');
        $this->load->module('news');
        // Count All News 
        $count = $this->db->count_all_results('news');

        // Setup pagination
        $per_page = 6;
        if ($count > $per_page) 
        {
            $this->load->library('pagination');

            $config['base_url'] = site_url('page/'.$this->uri->segment(2)) . '/';
            $config['total_rows'] = $count;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 3;

            $this->pagination->initialize($config);
            $this->data['pagination'] = $this->pagination->create_links();
            $offset = $this->uri->segment(3);
        }
        else 
        {
            $this->data['pagination'] = '';
            $offset = 0;
        }


        $this->data['news'] = $this->news->News_model->get_news_with_limit('created_at', 'DESC', $per_page, $offset);


        $this->public_template('news', $this->data);
    }



    public function our_categoreis()
    {
        $this->data['page_header'] = lang('our_categories');
        $this->load->module('categories');
        $this->data['categories'] = $this->categories->Category_model->get();
        $this->public_template('categories', $this->data);
    }


    private function clients()
    {
        $this->data['page_header'] = lang('clients');
        $this->load->module('clients');
        $this->data['css_file'] = [site_url('assets/css/prettyphoto.css')];
        $this->data['js_file'] = [site_url('assets/js/prettyphoto.js')];
        $this->data['clients'] = $this->clients->Client_model->get();
        $this->public_template('clients', $this->data);
    }



    public function contact_us()
    {
        $this->data['page_header'] = lang('contact_us');
        $this->public_template('contact_us', $this->data);
    }

}