<?php
class Dashboard extends MY_Controller
{
    public function __construct()
    {
        $this->middleware->execute_middlewares(['not_authinticated']);
        parent::__construct();

    }

    public function index()
    {
        $this->admin_template('index', $this->data);
    }


    public function lang($lang = false)
    {
        if ($lang && in_array($lang, ['en', 'ar']))
        {
            if ($lang == 'en')
            {
                $lang = 'english';
            } else if ($lang == 'ar') {
                $lang = 'arabic';
            }
            $_SESSION['public_site_language'] = $lang;
        }
        redirect(site_url('/dashboard'));
    }
}