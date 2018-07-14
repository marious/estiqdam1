<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_worker extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (! isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true && !in_array($_SESSION['access_id'], array(4)))
        {
            redirect('site_security/login');
        }
        $this->load->model('Agent_worker_model');
    }




    public function index()
    {
        $this->data['workers'] = $this->Agent_worker_model->get_agent_workers($_SESSION['id']);
        $this->data['status'] = true;
        $this->data['title'] = 'All Workers';
        $this->load->module('agents');
        $this->data['agent'] = $this->agents->Agent_model->get($_SESSION['id'], true);
        $this->adminTemplate('index', $this->data);
    }


    public function underprocessing()
    {
        $this->data['workers'] = $this->Agent_worker_model->get_agent_workers_underprocessing($_SESSION['id']);
        $this->data['status'] = false;
        $this->data['title'] = 'UnderProcessing Workers';
        $this->load->module('agents');
        $this->data['agent'] = $this->agents->Agent_model->get($_SESSION['id'], true);
        $this->adminTemplate('index', $this->data);
    }



    public function workers()
    {
        $this->data['agents'] = $this->Agent_worker_model->get_agents();
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/all_workers.js'];
        $this->adminTemplate('all_workers', $this->data);
    }




    public function load_all_workers()
    {
        $this->Agent_worker_model->get_all_workers();
    }

    public function cancel_selection($worker_id, $customer_id)
    {
        $this->Agent_worker_model->save(array('accepted' => '0'), $worker_id);
        $this->load->module('customers');
        $this->customers->Customer_model->save(array('make_contract' => '0', 'selected_worker_id' => 0), $customer_id);
        $this->session->set_flashdata('success', 'تم الرجوع فى الاختيار');
        redirect(site_url('agent_worker/workers'));
    }


    public function hide_worker($worker_id)
    {
        if ($this->Agent_worker_model->hide_worker($worker_id))
        {
            $this->session->set_flashdata('success', 'Worker has been hidden successfully');
            redirect("agent_worker/workers");
        }
    }

    public function show_worker($worker_id)
    {
        if ($this->Agent_worker_model->show_worker($worker_id))
        {
            $this->session->set_flashdata('success', 'Worker has been revealed successfully');
            redirect("agent_worker/workers");
        }
    }


    public function delete_worker($worker_id)
    {
        if ($this->Agent_worker_model->delete_worker($worker_id))
        {
            $this->session->set_flashdata('success', 'Worker has been deleted successfully');
            redirect("agent_worker/workers");
        }
    }


    public function accepted_workers()
    {
        $this->data['agents'] = $this->Agent_worker_model->get_agents();
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/all_accepted_workers.js'];
        $this->adminTemplate('all_accepted_workers', $this->data);
    }

    public function load_accepted_workers()
    {
        $this->Agent_worker_model->get_accepted_workers();
    }


    public function new_workers()
    {
        $this->data['agents'] = $this->Agent_worker_model->get_agents();
        $this->data['datatables'] = true;
        $this->data['js_files'] = ['assets/admin_panel/js/new_workers.js'];
        $this->adminTemplate('new_workers', $this->data);
    }

    public function load_new_workers()
    {
        $this->Agent_worker_model->get_new_workers();
    }


    public function accepted()
    {
        $this->load->module('agents');
        $agent = $this->agents->Agent_model->get($_SESSION['id'], true);
//        if ($agent->suspended == 1) {
//            redirect(site_url('agent_worker'));
//        }

        $this->data['agent']  = $agent;
       // $this->data['datatables'] = true;
        $this->data['datepicker'] = true;
        $this->data['css_files'][] = 'assets/admin_panel/css/bootstrap-editable.css';
        $this->data['js_files'][] = 'assets/admin_panel/js/bootstrap-editable.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/accepted_workers_agent.js';
        $this->data['css_files'][] = 'assets/admin_panel/css/bootstrap-editable.css';
        $this->data['js_files'][] = 'assets/admin_panel/js/bootstrap-editable.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/accepted_workers.js';
        $this->data['workers'] =  $this->Agent_worker_model->get_accepted_workers_by_agent();
        $this->adminTemplate('accepted_workers', $this->data);
    }

    public function load_accepted_worker()
    {
        $this->Agent_worker_model->get_accepted_workers_by_agent();
    }


    public function update_worker_editable_data()
    {
        $sql = "UPDATE agent_worker SET {$_POST['name']} = ? WHERE id = ?";
        $this->db->query($sql, array($_POST['value'], $_POST['pk']));
    }


    public function accepted_worker($contract_number)
    {
        $this->data['worker'] = $this->Agent_worker_model->get_accepted_worker_by_contact_number($contract_number);

        $this->data['js_files'][] = 'assets/admin_panel/js/processing.js';
        $this->adminTemplate('accepted_worker', $this->data);
    }


    public function tickets()
    {
        $this->load->module('tickets');
        $agent_tickets = $this->tickets->Ticket_model->get_agent_tickets($_SESSION['id']);
        $this->data['tickets'] = $agent_tickets;
        $this->load->module('agents');
        $this->data['agent'] = $this->agents->Agent_model->get($_SESSION['id'], true);
        $this->data['css_files'] = ['assets/admin_panel/css/lightbox.css'];
        $this->data['js_files'][] = 'assets/admin_panel/js/lightbox.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/agent_tickets.js';



        $this->adminTemplate('tickets', $this->data);
    }

    public function upload_agent_ticket()
    {
        $contract_number = $_POST['contract_number'];
        $upload_path = FCPATH . 'assets/contracts/' . $contract_number;
        if (!is_dir($upload_path))
        {
            mkdir($upload_path, 0777, true);
        }


        if (isset($_FILES['ticket_image']) && $_FILES['ticket_image']['name'] != '')
        {
            $this->load->module('services_entry');
            $upload_image = $this->services_entry->do_upload('ticket_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('ticket_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker/tickets');
                }
            }
        }


        $this->session->set_flashdata('success', 'Ticket Photo Uploaded Successfully');
        redirect('agent_worker/tickets');


    }



    public function view_documents()
    {
        $contract_number = $this->uri->segment(3);
        $contract_data = $this->Agent_worker_model->get_accepted_agent_contract($_SESSION['id'], $contract_number);
//        echo '<pre>';
//        print_r($contract_data);
//        echo '</pre>';
//        exit;
        $this->data['contract'] = $contract_data;
        $this->data['contract_number'] = $contract_number;
        $this->load->view('documents', $this->data);
    }

    public function view_documents_for_pdf()
    {
        $contract_number = $this->uri->segment(3);
        $worker_name = $this->uri->segment(4);
        $contract_data = $this->Agent_worker_model->get_accepted_agent_contract($_SESSION['id'], $contract_number);
        $this->data['contract'] = $contract_data;
        $this->data['contract_number'] = $contract_number;
        $view = $this->load->view('documents_pdf', $this->data, true);
        require_once FCPATH . 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf\Dompdf();
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->loadHtml($view);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($worker_name);
    }





    public function download($contract_number ='', $name = '')
    {
        $image = urldecode($_GET['file']);
        $this->load->helper('download');
        $data = file_get_contents(site_url('assets/contracts/' . $contract_number . '/' .$image));
        $name = $name . '.'. pathinfo($image, PATHINFO_EXTENSION);
        force_download($name, $data);
    }

    public function download2($passport)
    {
        $image = urldecode($_GET['file']);
        $this->load->helper('download');
        $data = file_get_contents('assets/img/workers/' . $passport);
        force_download($passport, $data);
    }

    public function testpdf2()
    {

    }


    public function view_cv($id)
    {
        $this->lang->load('worker_cv');

        if ($id && is_numeric($id))
        {
            $this->data['worker'] = $this->Agent_worker_model->get_by(array('id' => $id), true);
            count($this->data['worker']) || redirect('agent_worker');
            $this->load->module('jobs');
            $job = $this->jobs->Job_model->get_by(array('id' => $this->data['worker']->job_id), true);
            $this->data['job'] = $job->name_in_arabic;
            $this->data['id'] = $id;
            $this->data['html'] = true;
            $this->load->view('worker_view', $this->data);
        }
        else
        {
            redirect('agent_worker');
        }
    }


    public function testpdf($id)
    {
//        require_once FCPATH . 'dompdf/autoload.inc.php';
//        $dompdf = new Dompdf\Dompdf();
//        $dompdf->set_option('isRemoteEnabled', true);
//        $dompdf->loadHtml($view);
//        // (Optional) Setup the paper size and orientation
//        $dompdf->setPaper('A4', 'portrait');
//
//        // Render the HTML as PDF
//        $dompdf->render();
//
//        // Output the generated PDF to Browser
//        $dompdf->stream();
//        exit;
        if ($id && is_numeric($id))
        {
            $this->data['worker'] = $this->Agent_worker_model->get_by(array('id' => $id), true);;
            count($this->data['worker']) || redirect('agent_worker');
            $this->data['id'] = $id;
            $view = $this->load->view('worker_view', $this->data, true);
            require_once FCPATH . 'dompdf/autoload.inc.php';
            $dompdf = new Dompdf\Dompdf();
            $dompdf->set_option('isRemoteEnabled', true);
            $dompdf->loadHtml($view);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();
        }
        else
        {
            redirect('agent_worker');
        }
    }


    public function view($id)
    {
        if ($id && is_numeric($id))
        {
            $this->data['worker'] = $this->Agent_worker_model->get_by(array('id' => $id, 'agent_id' => $_SESSION['id']), true);
            $this->load->module('jobs');
            $this->data['job'] = $this->jobs->Job_model->get_by(array('id' => $this->data['worker']->job_id), true)->name_in_english;
            count($this->data['worker']) || redirect('agent_worker');
            $this->data['id'] = $id;
            $this->load->view('worker_view', $this->data);
        }
        else
        {
            redirect('agent_worker');
        }


    }


    public function add($id = null)
    {
        // handle suspended agent
        $this->load->module('agents');
        $agent = $this->agents->Agent_model->get($_SESSION['id'], true);
        if ($id == null) {
            if ($agent->suspended == 1) {
                redirect(site_url('agent_worker'));
            }
        }
        $this->lang->load('services_entry');
        $this->load->module('religions');
        $this->load->module('staff');
        $this->load->module('jobs');
        $this->load->module('departure_airports');
        $this->data['jobs'] = $this->jobs->Job_model->get();
        $this->data['religions'] = $this->religions->Religion_model->get();
        $agent_user = $this->staff->Staff_model->get($_SESSION['id'], true);
        $this->data['agent'] = $agent_user;
        $this->data['departure_airports'] = $this->departure_airports->Departure_airport_model->get_by(['nationality_id' => $agent_user->nationality_id]);
        //var_dump($this->data['departure_airports']);

        // Fetch or set new one
        if ($id && is_numeric($id))
        {
            $this->data['worker'] = $this->Agent_worker_model->get($id);
            count($this->data['worker']) || redirect('agent_workers');
            $this->data['id'] = $id;
        }
        else if ($id == null)
        {
            $this->data['worker'] = $this->Agent_worker_model->get_new();
            $this->data['id'] = false;
        }

        $this->data['js_files'][] = 'assets/admin_panel/js/moment.min.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/combodate.js';


        // Process the form
        $this->load->library('form_validation');
        $rules = $this->Agent_worker_model->rules;
        // nationality_id == 11 is philipine
        if ($agent_user->nationality_id == 11)
        {
            $rules[] = [
                'field' => 'middle_name',
                'label' => 'Middle Name',
                'rules' => 'trim|required',
            ];
        }
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Agent_worker_model->array_from_post([
                'job_id', 'salary', 'name', 'name_in_arabic', 'first_name', 'sur_name', 'religion', 'marital_status',
                'height', 'weight', 'qualification', 'passport_number', 'date_of_issue', 'date_of_expiry', 'date_of_birth', 'experience_period', 'experience_country',
                'arabic_language', 'english_language', 'cleaning', 'ironing', 'cooking', 'baby_sitting', 'old_care', 'departure_airport','biometric_date', 'memo',
            ]);

            if ($agent_user->nationality_id == 11)
            {
                $data['middle_name']  = $this->input->post('middle_name');
                $data['worker_phone'] = $this->input->post('worker_phone');
                $data['address'] = $this->input->post('address');
                $data['place_of_issue'] = $this->input->post('place_of_issue');
                $data['next_kin_name'] = $this->input->post('next_kin_name');
                $data['next_kin_address'] = $this->input->post('next_kin_address');
                $data['next_kin_phone'] = $this->input->post('next_kin_phone');
                $data['contract_received_date'] = $this->input->post('contract_received_date');
                $data['owwa_sched'] = $this->input->post('owwa_sched');
             }

//            $data['date_of_birth'] = trim($_POST['day']) . '/' . trim($_POST['month']) . '/' . trim($_POST['year']);
//            $data['date_of_issue'] = trim($_POST['day_of_issue']) . '/' . trim($_POST['month_of_issue']) . '/' . trim($_POST['year_of_issue']);
//            $data['date_of_expiry'] = trim($_POST['day_of_expiry']) . '/' . trim($_POST['month_of_expiry']) . '/' . trim($_POST['year_of_expiry']);
            if ($data['arabic_language'] == null) {$data['arabic_language'] = '0';}
            if ($data['english_language'] == null) {$data['english_language'] = '0';}
            if ($data['cleaning'] == null) {$data['cleaning'] = '0';}
            if ($data['ironing'] == null) {$data['ironing'] = '0';}
            if ($data['cooking'] == null) {$data['cooking'] = '0';}
            if ($data['baby_sitting'] == null) {$data['baby_sitting'] = '0';}
            if ($data['old_care'] == null) {$data['old_care'] = '0';}

            $data['contract_period'] = '2';
            $data['agent_id'] = $_SESSION['id'];
            $data['nationality_id'] = $agent_user->nationality_id;

            // $data['image'] = 'no-image.png';

            //var_dump($_FILES);exit;

            if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
            {
                $upload_image = $this->do_upload('image');
                if ($upload_image) {
                    if (isset($upload_image['file_name'])) {
                        $data['image'] = $upload_image['file_name'];
                    }
                    if (isset($upload_image['error'])) {
                        $error = $upload_image['error'];
                        $this->session->set_flashdata('error', $error);
                        redirect('agent_worker');
                    }
                }
            }

            if (isset($_FILES['passport_image']) && $_FILES['passport_image']['name'] != '')
            {
                $upload_image = $this->do_upload('passport_image');
                if ($upload_image) {
                    if (isset($upload_image['file_name'])) {
                        $data['passport_image'] = $upload_image['file_name'];
                    }
                    if (isset($upload_image['error'])) {
                        $error = $upload_image['error'];
                        $this->session->set_flashdata('error', $error);
                        redirect('agent_worker');
                    }
                }
            }



            $returned = $this->Agent_worker_model->save($data, $id);
            $message = ($id == null) ? 'New Worker Added Successfully' : 'Worker Updated Successfully';
            if ($id == null)
            {
                $this->load->module('worker_nationality');
                $country = $this->worker_nationality->Worker_nationality_model->get($agent_user->nationality_id, true)->nationality_in_arabic;
                $msg = "التفاصيل على الرابط https://peace4r.com/home/maidinfo/ {$country}للاستقدام عاملة منزلية من ";
                $this->load->module('tweet_messages');
                $this->tweet_messages->Tweet_model->save([
                    'message' => $msg,
                ]);

            }

            $this->session->set_flashdata('success', $message);
            redirect('agent_worker');
        }

        $this->adminTemplate('add_test', $this->data);
    }


    /**
     * The purpose of this for staff user
     */
    public function add_worker($id = null)
    {
        $this->lang->load('services_entry');
        $this->load->module('religions');
        $this->load->module('staff');
        $this->load->module('jobs');
        $this->load->module('departure_airports');
        $this->load->module('agents');

        $this->data['jobs'] = $this->jobs->Job_model->get();
        $this->data['religions'] = $this->religions->Religion_model->get();
        $this->data['departure_airports'] = $this->departure_airports->Departure_airport_model->get();
        $this->data['agents'] = $this->agents->Agent_model->get();


        $this->data['js_files'][] = 'assets/admin_panel/js/moment.min.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/combodate.js';

        // Fetch or set new one
        if ($id && is_numeric($id))
        {
            $this->data['worker'] = $this->Agent_worker_model->get($id);
            count($this->data['worker']) || redirect('agent_workers');
            $this->data['id'] = $id;
        }
        else if ($id == null)
        {
            $this->data['worker'] = $this->Agent_worker_model->get_new();
            $this->data['id'] = false;
        }

        // Process the form
        $rules = $this->Agent_worker_model->rules;
        $rules[] = [
            'field'     => 'agent_id',
            'name'      => 'Agent',
            'rules'     => 'trim|required',
        ];

        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run($this) == true)
        {
            $data = $this->Agent_worker_model->array_from_post([
                'job_id', 'salary', 'name', 'name_in_arabic', 'first_name', 'sur_name', 'date_of_birth', 'religion', 'marital_status',
                'height', 'weight', 'qualification', 'passport_number', 'date_of_issue', 'date_of_expiry', 'experience_period', 'experience_country','date_of_birth',
                'arabic_language', 'english_language', 'cleaning', 'ironing', 'cooking', 'baby_sitting', 'old_care', 'departure_airport',
            'agent_id', 'memo']);


            if (isset($_POST['middle_name']))
            {
                $data['middle_name']  = $this->input->post('middle_name');
                $data['worker_phone'] = $this->input->post('worker_phone');
                $data['address'] = $this->input->post('address');
                $data['place_of_issue'] = $this->input->post('place_of_issue');
                $data['next_kin_name'] = $this->input->post('next_kin_name');
                $data['next_kin_address'] = $this->input->post('next_kin_address');
                $data['next_kin_phone'] = $this->input->post('next_kin_phone');
            }


//            $data['date_of_birth'] = trim($_POST['day']) . '/' . trim($_POST['month']) . '/' . trim($_POST['year']);
//            $data['date_of_issue'] = trim($_POST['day_of_issue']) . '/' . trim($_POST['month_of_issue']) . '/' . trim($_POST['year_of_issue']);
//            $data['date_of_expiry'] = trim($_POST['day_of_expiry']) . '/' . trim($_POST['month_of_expiry']) . '/' . trim($_POST['year_of_expiry']);

            if ($data['arabic_language'] == null) {$data['arabic_language'] = '0';}
            if ($data['english_language'] == null) {$data['english_language'] = '0';}
            if ($data['cleaning'] == null) {$data['cleaning'] = '0';}
            if ($data['ironing'] == null) {$data['ironing'] = '0';}
            if ($data['cooking'] == null) {$data['cooking'] = '0';}
            if ($data['baby_sitting'] == null) {$data['baby_sitting'] = '0';}
            if ($data['old_care'] == null) {$data['old_care'] = '0';}

            $data['contract_period'] = '2';
//            $data['agent_id'] = $_SESSION['id'];
            $agent = $this->agents->Agent_model->get($this->input->post('agent_id'));
            $data['nationality_id'] = $agent->nationality_id;

            // $data['image'] = 'no-image.png';

            //var_dump($_FILES);exit;

            if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
            {
                $upload_image = $this->do_upload('image');
                if ($upload_image) {
                    if (isset($upload_image['file_name'])) {
                        $data['image'] = $upload_image['file_name'];
                    }
                    if (isset($upload_image['error'])) {
                        $error = $upload_image['error'];
                        $this->session->set_flashdata('error', $error);
                        redirect('agent_worker');
                    }
                }
            }

            if (isset($_FILES['passport_image']) && $_FILES['passport_image']['name'] != '')
            {
                $upload_image = $this->do_upload('passport_image');
                if ($upload_image) {
                    if (isset($upload_image['file_name'])) {
                        $data['passport_image'] = $upload_image['file_name'];
                    }
                    if (isset($upload_image['error'])) {
                        $error = $upload_image['error'];
                        $this->session->set_flashdata('error', $error);
                        redirect('agent_worker');
                    }
                }
            }



            $returned = $this->Agent_worker_model->save($data, $id);
            $message = ($id == null) ? 'New Worker Added Successfully' : 'Worker Updated Successfully';
            if ($id == null)
            {
                $this->load->module('worker_nationality');
                $country = $this->worker_nationality->Worker_nationality_model->get($agent->nationality_id, true)->nationality_in_arabic;
                $msg = "التفاصيل على الرابط https://peace4r.com/home/maidinfo/ {$country}للاستقدام عاملة منزلية من ";
                $this->load->module('tweet_messages');
                $this->tweet_messages->Tweet_model->save([
                    'message' => $msg,
                ]);

            }
            $this->session->set_flashdata('success', $message);
            redirect('agent_worker/workers');


        }



        $this->adminTemplate('add', $this->data);
    }


    public function test($id = null)
    {
        $this->lang->load('services_entry');
        $this->load->module('religions');
        $this->load->module('staff');
        $this->data['religions'] = $this->religions->Religion_model->get();
        $agent_user = $this->staff->Staff_model->get($_SESSION['id'], true);


        // Fetch or set new one
        if ($id && is_numeric($id))
        {
            $this->data['worker'] = $this->Agent_worker_model->get($id);
            count($this->data['worker']) || redirect('agent_workers');
            $this->data['id'] = $id;
        }
        else if ($id == null)
        {
            $this->data['worker'] = $this->Agent_worker_model->get_new();
            $this->data['id'] = false;
        }

        // Process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->Agent_worker_model->rules);
        if ($this->form_validation->run() == true)
        {
            $data = $this->Agent_worker_model->array_from_post([
                'job_id','salary', 'name', 'name_in_arabic', 'first_name', 'sur_name', 'date_of_birth', 'religion', 'marital_status',
                'height', 'weight', 'qualification', 'passport_number', 'date_of_issue', 'experience_period',
                'arabic_language', 'english_language', 'cleaning', 'ironing', 'cooking', 'baby_sitting', 'old_care', 'departure_airport',
            ]);
            if ($data['arabic_language'] == null) {$data['arabic_language'] = '0';}
            if ($data['english_language'] == null) {$data['english_language'] = '0';}
            if ($data['cleaning'] == null) {$data['cleaning'] = '0';}
            if ($data['ironing'] == null) {$data['ironing'] = '0';}
            if ($data['cooking'] == null) {$data['cooking'] = '0';}
            if ($data['baby_sitting'] == null) {$data['baby_sitting'] = '0';}
            if ($data['old_care'] == null) {$data['old_care'] = '0';}

            $data['contract_period'] = '2';
            $data['agent_id'] = $_SESSION['id'];
            $data['nationality_id'] = $agent_user->nationality_id;


            $data['image'] = 'no-image.png';

            if (isset($_FILES['image']) && $_FILES['image']['name'] != '')
            {
                $upload_image = $this->do_upload('image');
                if ($upload_image) {
                    if (isset($upload_image['file_name'])) {
                        $data['image'] = $upload_image['file_name'];
                    }
                    if (isset($upload_image['error'])) {
                        $error = $upload_image['error'];
                        $this->session->set_flashdata('error', $error);
                        redirect('agent_worker/add/' . $id);
                    }
                }
            }

            $this->Agent_woerk_model->save($data, $id);
            $message = ($id == null) ? 'New Worker Added Successfully' : 'Worker Updated Successfully';
            $this->session->set_flashdata('success', $message);
            redirect('agent_worker');

        }

        $this->lang->load('services_entry');
        $this->adminTemplate('add', $this->data);
    }




    protected function do_upload($file_input_name)
    {
        $config['upload_path']          = FCPATH . "assets/img/workers";
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 4096;
        $config['max_width']            = 3024;
        $config['max_height']           = 3024;

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
            if ($upload_data['image_width'] > 1024 && $upload_data['image_height'] > 1024)
            {
                $this->resize_image(700, 500, $file_name);
//                $this->delete_image($file_name);
            }
            return ['file_name' => $file_name];
        }

        return false;

    }


    public function reports_not_stamp()
    {
        $this->data['workers'] = $this->Agent_worker_model->get_agent_workers_not_stamp();
        $this->adminTemplate('agent_not_stamp', $this->data);
    }

    public function reports_not_arrived()
    {
        $this->data['workers'] = $this->Agent_worker_model->get_agent_workers_not_arrived();

        $this->adminTemplate('agent_not_arrived', $this->data);
    }


    public function reports_arrived()
    {
        $this->data['workers'] = $this->Agent_worker_model->get_agent_workers_arrived();

        $this->adminTemplate('agent_arrived', $this->data);
    }


    public function payment_report()
    {
        $this->data['workers'] = $this->Agent_worker_model->get_agent_workers_arrived();

        $this->adminTemplate('payment_status', $this->data);
    }

    protected function resize_image($width = 500, $height = 500, $filename)
    {
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= FCPATH . "assets/img/workers" . $filename;
        $config['new_image'] 		= FCPATH . "assets/img/workers" . $filename;
        $config['maintain_ratio'] 	= TRUE;
        $config['width']         	= $width;
        $config['height']       	= $height;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }



    public function _unique_passport_number($str)
    {
        $id = $this->uri->segment(3);
        $this->db->where('passport_number', $this->input->post('passport_number'));
        !$id || $this->db->where('id !=', $id);
        $item = $this->Agent_worker_model->get();
        if (count($item)) {
            $this->form_validation->set_message('_unique_passport_number', '%s already exist please choose another one');
            return false;
        }
        return true;
    }


    public function update_processing_date()
    {
        $query = "UPDATE services_contract SET {$_POST['name']} = ? WHERE contract_number = ?";
        $this->db->query($query, array($_POST['value'], $_POST['pk']));
    }


    public function processing_upload()
    {
        $contract_number = $_POST['contract_number'];
        $upload_path = FCPATH . 'assets/contracts/' . $contract_number;
        if (!is_dir($upload_path))
        {
            mkdir($upload_path, 0777, true);
        }




        if (isset($_FILES['ticket_image']) && $_FILES['ticket_image']['name'] != '')
        {
            $upload_image = $this->do_upload_2('ticket_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('ticket_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }

        if (isset($_FILES['stamping_image']) && $_FILES['stamping_image']['name'] != '')
        {
            $upload_image = $this->do_upload_2('stamping_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('stamping_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }


        if (isset($_FILES['passport_image']) && $_FILES['passport_image']['name'] != '')
        {
            $upload_image = $this->do_upload_2('passport_image', FCPATH . 'assets/contracts/' . $contract_number);
            if ($upload_image) {
                if (isset($upload_image['file_name'])) {
                    $data['image'] = $upload_image['file_name'];
                    $this->load->module('services_contract');
                    $this->services_contract->Service_contract_model->update(array('passport_image' => $data['image']), $contract_number);
                }
                if (isset($upload_image['error'])) {
                    $error = $upload_image['error'];
                    var_dump($error);exit;
                    $this->session->set_flashdata('error', $error);
                    redirect('agent_worker');
                }
            }
        }


        redirect(site_url('agent_worker/accepted_worker/' . $contract_number));

    }


    protected function do_upload_2($file_input_name, $path)
    {
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|pdf|jpeg';
        $config['max_size']             = 4096;
        $config['max_width']            = 6024;
        $config['max_height']           = 5024;

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



    public function vfs()
    {
//        $this->load->module('agents');
//        $agent = $this->agents->Agent_model->get($_SESSION['id'], true);
////        if ($agent->suspended == 1) {
////            redirect(site_url('agent_worker'));
////        }

//        $this->data['agent']  = $agent;
        // $this->data['datatables'] = true;
        $this->load->module('services_entry');
        $this->data['agents'] = $this->services_entry->Service_model->get_agents();
        $this->data['js_files'][] = 'assets/admin_panel/js/moment.min.js';
        $this->data['js_files'][] = 'assets/admin_panel/js/combodate.js';
        $this->data['datatables'] = true;
        $this->data['js_files'][] = 'assets/admin_panel/js/vfs.js';

        $this->adminTemplate('vfs', $this->data);
    }

    public function get_all_accepted()
    {
        $this->Agent_worker_model->get_accepted_workers_2();
    }


    public function update_worker_2()
    {
        return true;
    }


    public function get_worker_by_id()
    {
        $worker_data = $this->Agent_worker_model->get_by(array('id' => $_POST['worker_id']), true);
        echo json_encode($worker_data);
    }


    public function update_worker_contract_received_biometric()
    {
        $names = $_POST['name'];
        $values = $_POST['value'];

        foreach ($names as $key => $name) {
            if ($values[$key] != '') {
//                echo $values[$key] . '<br>';
//                echo $_POST['pk'] . '<br>';
                $this->db->query("UPDATE agent_worker SET $name = '{$values[$key]}' WHERE id = {$_POST['pk']}");
//                $this->db->query($sql, array($values[$key]), $_POST['pk']);
            }
        }
        return true;
    }



    public function print_vfs_worker()
    {
        $agent_id = $_POST['agent_id'];
        $this->data['title'] = 'تقرير من لهم تاريخ VFS';
        $this->data['workers'] = $this->Agent_worker_model->get_vfs_workers_by_agent($agent_id, true);

        $this->load->view('print_vfs_worker', $this->data);
    }


    public function print_not_vfs_worker()
    {
        $agent_id = $_POST['agent_id'];
        $this->data['title'] = 'تقرير من ليس لهم تاريخ VFS';
        $this->data['workers'] = $this->Agent_worker_model->get_vfs_workers_by_agent($agent_id);

        $this->load->view('print_vfs_worker', $this->data);
    }

}