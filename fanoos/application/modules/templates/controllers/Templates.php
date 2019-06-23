<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Templates extends MY_Controller 
{

    public function admin_temp($data)
    {
        $this->load->view('admin/index', $data);
    }


    public function public_temp($data) 
    {
        $this->load->view('public/index', $data);
    }


   

}