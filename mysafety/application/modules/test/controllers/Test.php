<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller 
{

   
   public function __construct()
   {
       parent::__construct();
       $this->middleware->execute_middlewares(['not_authinticated']);
   }


    public function index() 
    {
        $this->admin_template('test', $this->data);
    }


    public function test2()
    {
        echo 'test';
    }
}

