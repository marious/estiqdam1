<?php

class Home extends MX_Controller
{
    public $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->library('config');
        $this->load->module('templates');

        if (!isset($this->data['view_module']))
        {
            $this->data['view_module'] = $this->uri->segment(1);
        }
        $this->load->model('Site_model');
        $this->data['view_module'] = 'home';
//        if (! isset($_SESSION['user_language']) || $_SESSION['language'] == '')
//        {
//            $this->config->set_item('language', 'arabic');
//        }


        if (!isset($_SESSION['public_site_language']) || empty($_SESSION['public_site_language']))
        {
            $this->config->set_item('language', 'arabic');

//            if (isset($_SESSION['user_language'])) {
//                $_SESSION['language'] = get_language($_SESSION['user_language']);
//                $this->config->set_item('language', $_SESSION['language']);
//            }
        }
        else
        {
            $this->config->set_item('language', $_SESSION['public_site_language']);
        }

        $this->lang->load('home');


//        var_dump($this->config->item('language'));exit;
//        var_dump($_SESSION);exit;
    }


    /**
     * admin template view
     * @param string view file
     * @param array $data
     */
    protected function publicTemplate($view_file, $data)
    {
        $data['view_file'] = $view_file;
        $this->templates->public_bootstrap($data);
    }

    public function index()
    {
        // Get agent worker not accepted
        $workers = $this->Site_model->get_not_accepted_agent_workers();
        $accepted_workers = false;
        if (file_exists(FCPATH . '/workers.json'))
        {
            $accepted_workers = json_decode(file_get_contents(FCPATH . '/workers.json'));
        }
        $this->data['workers'] = $workers;
        $this->data['accepted_workers'] = $accepted_workers;

        $this->publicTemplate('all_jobs', $this->data);
    }


    public function seo_pages($page_title)
    {

//        echo $page_title;
        $page_title = str_replace('-', ' ', urldecode($page_title));
        $this->load->module('seo_pages');
        $seo_page = $this->seo_pages->Seo_pages_model->get_by(['title' => $page_title], true);
        $this->data['seo_page'] = $seo_page;
        if ($seo_page && count($seo_page)) {
            $this->publicTemplate('seo_page', $this->data);
        } else {
            redirect(site_url('home'));
        }

    }


    public function tanazul()
    {

        $advs = $this->db->get('tanazul')->result();
        $this->data['advs'] = $advs;

        $validation_rules = [
            [
                'field' => 'adv_text',
                'label' => 'نص الاعلان',
                'rules' => 'trim|required|max[256]',
            ],
            [
                'field' => 'mobile_number',
                'label' => 'رقم التواصل',
                'rules' => 'trim|required|max[20]',
            ]
        ];


        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validation_rules);


        if ($this->form_validation->run($this) == true)
        {

            $data = $this->Site_model->array_from_post([
                    'adv_text',
                    'mobile_number',
                ]
            );

//            $this->Site_model->save_message_contact($data);
            $this->db->set($data);
            $this->db->insert('tanazul');
            $this->session->set_flashdata('success', 'تم إرسال اعلانك بنجاح');
            redirect('home/tanazul');
        }

        $this->publicTemplate('tanazul', $this->data);
    }




    public function search()
    {
        $this->data['workers'] = $this->Site_model->get_workers_by_search($_GET);
        $this->data['search'] = true;
        $this->publicTemplate('all_jobs', $this->data);
    }


    public function country($country_name)
    {
        if ($country_name)
        {
            $country_name = urldecode($country_name);
            $workers = $this->Site_model->get_workers_by_country($country_name);
            $this->data['workers'] = $workers;
            $this->data['country'] = true;
            $this->publicTemplate('all_jobs', $this->data);
        }
        else
        {
            redirect(site_url());
        }
    }


    public function alljobs()
    {
        // Get agent worker not accepted
        $workers = $this->Site_model->get_not_accepted_agent_workers();
        $accepted_workers = false;
        if (file_exists(FCPATH . '/workers.json'))
        {
            $accepted_workers = json_decode(file_get_contents(FCPATH . '/workers.json'));
        }
        $this->data['accepted_workers'] = $accepted_workers;
        $this->data['workers'] = $workers;

        $this->publicTemplate('all_jobs', $this->data);
    }



    public function maidinfo($worker_first_name = '')
    {
        if ($worker_first_name == '') {redirect(site_url('home'));}
        $worker_first_name = str_replace('.html', '', $worker_first_name);
        $worker_first_name = str_replace('-', ' ', $worker_first_name);
//        $this->data['customer'] = false;
        if ($worker_first_name)
        {
            $worker = $this->Site_model->get_worker($worker_first_name);
            if ($worker && count($worker))
            {
                if (isset($_SESSION['id']   ))
                {
                    $this->data['customer'] = $this->Site_model->get_customer($_SESSION['id']);
                }
                $this->data['worker'] = $worker;
//                $this->data['img_preview'] = true;
                $this->publicTemplate('maid_info', $this->data);
            }
            else
            {
                redirect(site_url('home/alljobs'));
            }
        }
    }


    public function customer_favorite_list()
    {
        if (isset($_SESSION['id']))
        {
            $favorites = $this->Site_model->get_customer_favorites($_SESSION['id']);
            $this->data['favorites'] = $favorites;
            $this->publicTemplate('customer_favorite', $this->data);
        }
    }





    public function selected_maidinfo($worker_first_name = '')
    {
        if ($worker_first_name == '') {redirect(site_url('home'));}
        $worker_first_name = str_replace('.html', '', $worker_first_name);
        $worker_first_name = str_replace('-', ' ', $worker_first_name);
//        $this->data['customer'] = false;
        if ($worker_first_name)
        {
            $worker = $this->Site_model->get_accepted_worker($worker_first_name);
            if ($worker && count($worker))
            {
                if (isset($_SESSION['id']   ))
                {
                    $this->data['customer'] = $this->Site_model->get_customer($_SESSION['id']);
                }
                $this->data['worker'] = $worker;
//                $this->data['img_preview'] = true;
                $this->publicTemplate('selected_maid_info', $this->data);
            }
            else
            {
                redirect(site_url('home/alljobs'));
            }
        }
    }






    public function remove_from_fav($worker_id)
    {
        if (isset($_SESSION['id']))
        {
            if ($this->Site_model->delete_from_fav($_SESSION['id'], $worker_id))
            {
                $this->session->set_flashdata('success', 'تم حذف العنصر من المفضلة بنجاح');
                redirect(site_url('home/customer_favorite_list'));
            }
        }
    }



    public function demand_list()
    {
        if (isset($_SESSION['id']))
        {
            $customer = $this->Site_model->get_customer($_SESSION['id']);
            if ($customer->selected_worker_id)
            {
                $worker = $this->Site_model->get_worker_by_id($customer->selected_worker_id);
                if ($worker && count($worker))
                {
                    $this->data['worker'] = $worker;
                    $this->publicTemplate('demand', $this->data);
                }
            }
            else
            {
                $this->publicTemplate('demand', $this->data);
            }
        }
    }


    public function customer_favorite($worker_id)
    {
        if (isset($_SESSION['logged_in']) && isset($_SESSION['id']))
        {
            $worker = $this->Site_model->get_worker_by_id($worker_id);
            if ($worker && count($worker))
            {
                if ($this->Site_model->get_count_customer_fav($_SESSION['id']) <= 3)
                {
                    if ($this->Site_model->add_to_customer_fav($_SESSION['id'], $worker_id))
                    {
                        $this->session->set_flashdata('success', 'تم اضافة عنصر الى المفضلة بنجاح');
                        redirect('home/customer_favorite_list');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error_message', 'المسموح للمفضلة هو 3 عناصر فقط');
                    redirect(site_url('home'));
                }
            }
        }
    }

    public function test()
    {
        $name = explode(' ' , 'محمد سعود عشبان الحربي');
        $first_name = reset($name);
        $last_name = end($name);
        $full_name = $first_name . ' ' . $last_name;
        $this->load->module('worker_nationality');
        $country = $this->worker_nationality->Worker_nationality_model->get(1, true)->nationality_in_arabic;
        var_dump($country);exit;
        $job_name = 'عاملة منزلية';
        $country = 'نيجريا';
        $msg = "شكرا لعميلنا{$full_name} على اختياره {$job_name}  من دولة {$country} عن طريق مكتب السلام للاسنقدام ";
        echo $msg;
    }

    public function make_service($customer_id, $worker_id)
    {
        if ($customer_id && $worker_id)
        {
            $customer = $this->Site_model->get_customer($customer_id);
            if ($customer && count($customer))
            {
                $worker = $this->Site_model->get_worker_by_id($worker_id);
                if ($worker && count($worker))
                {

                    $this->db->set('selected_worker_id', $worker_id);
                    $this->db->where('staff_id', $customer_id);
                    $this->db->update('customers');

                    $this->db->set('accepted', '1');
                    $this->db->where('id', $worker_id);
                    $this->db->update('agent_worker');

                    $this->load->module('jobs');
                    $job_name = $this->jobs->Job_model->get($worker->job_id, true)->name_in_arabic;

                    $this->load->module('worker_nationality');
                    $country = $this->worker_nationality->Worker_nationality_model->get($worker->nationality_id, true)->nationality_in_arabic;

                    $customer_name = explode(' ', $customer->customer_name_in_arabic);
                    $first_name = reset($customer_name);
                    $last_name = end($customer_name);
                    $full_name = $first_name . ' ' . $last_name;

                    $msg = " شكرا لعميلنا {$full_name} على اختياره {$job_name}  من دولة {$country} عن طريق مكتب السلام للاسنقدام ";
                    $this->load->module('tweet_messages');
                    $this->tweet_messages->Tweet_model->save([
                        'message' => $msg,
                    ]);

                    $this->session->set_flashdata('success', 'تم اختيار العاملة بنجاح');
                    redirect('home/demand_list');
                }
            }
        }
    }



    public function contact()
    {
        $this->load->library('cicaptcha');
        $this->data['cicaptcha_html'] = $this->cicaptcha->show();

        $validation_rules = [
            [
                'field' => 'name',
                'label' => 'الاسم',
                'rules' => 'trim|required|max[100]',
            ],
            [
                'field' => 'mobile_number',
                'label' => 'رقم الجوال',
                'rules' => 'trim|required|max[50]',
            ],
            [
                'field' => 'message',
                'label' => 'الرسالة',
                'rules' => 'trim|required',
            ]
        ];


        // process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validation_rules);

        if ($this->form_validation->run($this) == true)
        {
            if( $this->cicaptcha->validate()===false ){
                $this->session->set_flashdata('error_message', 'الرقم التأكيدى غير صحيح');
                // $this->session->set_userdata(array(
                //   '_POST_DATA' => $_POST,
                // ));
                redirect("home/contact", 301 );
            }

            $data = $this->Site_model->array_from_post([
                        'name',
                        'mobile_number',
                        'message',
                    ]
            );

            $this->Site_model->save_message_contact($data);
            $this->session->set_flashdata('success', 'تم إرسال رسالتك بنجاح');
            redirect('home/contact');
        }

        $this->publicTemplate('contact', $this->data);
    }


    public function login()
    {
        $this->publicTemplate('login', $this->data);
    }


    public function change_password()
    {
//        $this->load->module('site_security');
//        echo $this->site_security->_hash_string('123456');
//        var_dump($_SESSION);exit;
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'الرقم السرى', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'تأكيد الرقم السرى', 'trim|required|matches[password]');

            if ($this->form_validation->run($this) == true)
            {
                $this->load->module('site_security');
                $password = $this->site_security->_hash_string($this->input->post('password'));
                $this->db->where('id', $_SESSION['id']);
                $this->db->set(['password' => $password]);
                $id = $this->db->update('staff');
                if ($id) {
                    $this->session->set_flashdata('success', 'تم تغيير الرقم السرى بنجاح');
                    redirect('home/change_password');
                }

            }

            $this->publicTemplate('change_password', $this->data);
        } else {
            redirect(site_url());
        }
    }



    public function lang($lang)
    {
        $_SESSION['public_site_language'] = $lang;
        redirect($_SERVER['HTTP_REFERER']);
    }



    public function handle_twitter()
    {

        $this->load->module('tweet_messages');
        $messages = $this->tweet_messages->Tweet_model->get_by(array('sended' => '0'));

        echo '<style>table, tr, td, th {border: 1px solid #000;} table {width: 100%;} textarea {padding: 20px; height: 100px; width: 100%;}</style>';
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Message</th>';
        echo '<th>Image</th>';
        echo '<th>Action</th>';
        echo '</tr>';
        foreach ($messages as $message) {
            echo '<form action="'.site_url('home/save_tweet').'" method="post">';
            echo '<tr>';
            echo '<td>'.$message->id.'</td>';
            echo '<td><textarea name="message">' . $message->message . '</textarea></td>';
            echo '<td>';
            if ($message->image != '0') {
                echo '<img src="'.$message->image.'">';
                echo '<br>';
            }
            echo '<input type="text" name="image" value="'.$message->image.'" style="display: block; width: 100%;">';
            echo '</td>';
            echo '<td><a href="home/make_tweet?id='.$message->id.'">Send</a> &nbsp;&nbsp;<button type="submit">Save</button></td>';
            echo '<td>';
            echo '</tr>';
            echo '<input type="hidden" name="id" value="'.$message->id.'">';
            echo '</form>';
        }
        echo '</table>';


//        $this->tweet_messages->Tweet_model->save(array('sended' => '1'), $message->id);
//        $reply = $cb->statuses_update('status=' .$message->message);
//        var_dump($reply);
//        $reply = $cb->statuses_destroy_ID([
//            'id' => '962335364471025664'
//        ]);
//        var_dump($reply);
    }


    public function delete_tweet($tweet_id)
    {
        $tweet_id = (string) $tweet_id;
        require 'codebird.php';
        \Codebird\Codebird::setConsumerKey('ttsHT8RV48yZtD92CdZyWysi1', 'FnyKgPqiGjobrM9rKAMbGZtCdGmAYzjfqpeevoUWcsg0XzLo2Y');
        $cb = \Codebird\Codebird::getInstance();
        $cb->setReturnFormat(CODEBIRD_RETURNFORMAT_ARRAY);
        $cb->setToken('3140595078-dPJnUF6itjZbXqIBUjWNh7Iqq4NrH8G716CgXVm', 'IxwyKzHFj12yP7JED3612j1wx9X1FXJQCOUs9ghXeF6lt');
        $reply = $cb->statuses_destroy_ID([
            'id' => $tweet_id,
        ]);
        var_dump($reply);
    }

    public function make_tweet()
    {
        $tweet_id = $_GET['id'];
        $this->load->module('tweet_messages');
        $message = $this->tweet_messages->Tweet_model->get($tweet_id, true);
        if ($message && count($message))
        {
            $this->load->module('tweet_messages');
            $this->tweet_messages->Tweet_model->save(array('sended' => '1'), $tweet_id);

            require 'codebird.php';
            \Codebird\Codebird::setConsumerKey('ttsHT8RV48yZtD92CdZyWysi1', 'FnyKgPqiGjobrM9rKAMbGZtCdGmAYzjfqpeevoUWcsg0XzLo2Y');
            $cb = \Codebird\Codebird::getInstance();
            $cb->setReturnFormat(CODEBIRD_RETURNFORMAT_ARRAY);
            $cb->setToken('3140595078-dPJnUF6itjZbXqIBUjWNh7Iqq4NrH8G716CgXVm', 'IxwyKzHFj12yP7JED3612j1wx9X1FXJQCOUs9ghXeF6lt');

            if ($message->image != '0') {
                $reply = $cb->media_upload(array(
                    'media' => $message->image,
                ));
                $mediaID = $reply['media_id_string'];
                $params = array(
                    'status' => $message->message,
                    'media_ids' => $mediaID,
                );
                $reply = $cb->statuses_update($params);
                echo '<pre>';
                print_r($message);
                echo '</pre>';
            } else {
                $reply = $cb->statuses_update('status=' . $message->message);
                echo '<pre>';
                print_r($reply);
                echo '</pre>';
            }
        }
    }


    public function save_tweet()
    {
        $message = trim($_POST['message']);
        $image = trim($_POST['image']);
        $id = $_POST['id'];
        $this->load->module('tweet_messages');
        $this->tweet_messages->Tweet_model->save(array('message' => $message, 'image' => $image), $id);
        redirect('home/handle_twitter');
    }








    public function make_workers_json()
    {
        $sql = "SELECT name,image,first_name, date_of_birth, religions.arabic_religion as religion, religions.religion AS english_religion, jobs.name_in_arabic AS job,
                  jobs.name_in_english AS job_english,
                  agent_worker.id as worker_id
                  FROM agent_worker
                   INNER JOIN religions
                   ON religions.id = agent_worker.religion
                   INNER JOIN jobs ON agent_worker.job_id = jobs.id
                   WHERE accepted = '1'
                   AND hide='0'
                   AND agent_worker.id <> 163
                   ";
        $sql1 = $sql . '  AND agent_worker.nationality_id = 1
                   ORDER BY agent_worker.created_at DESC
                   LIMIT 15';
        $sql2 = $sql . '  AND agent_worker.nationality_id = 11
                   ORDER BY agent_worker.created_at DESC
                   ';

        $query = $this->db->query($sql1);
        $query2 = $this->db->query($sql2);
        $result = [];

        if ($query2->num_rows())
        {
            $result[] = $query2->result();
        }

        if ($query->num_rows())
        {
            $result[] = $query->result();
        }


        $result = call_user_func_array('array_merge', $result);
        $result = json_encode($result);
        file_put_contents(FCPATH . '/workers.json', $result);
    }



    public function delete_contract($contract_number)
    {
        if (isset($contract_number))
        {
            $tables = array('contract', 'services_contract', 'services_customer', 'services_finance', 'services_order', 'services_worker');
            $this->db->where('contract_number', $contract_number);
            var_dump($this->db->delete($tables));
        }
    }


    public function show_log()
    {
        $logViewer = new \CILogViewer\CILogViewer();
        echo $logViewer->showLogs();

    }

}