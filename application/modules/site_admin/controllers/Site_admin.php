<?php

class Site_admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->model('Site_admin_model');
    }



    public function contact_messages()
    {
        $this->data['messages'] = $this->Site_admin_model->get_contact_messages();

        $this->adminTemplate('contact_messages', $this->data);
    }

}