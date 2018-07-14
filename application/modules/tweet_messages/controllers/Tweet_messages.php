<?php

class Tweet_messages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tweet_model');
    }
}