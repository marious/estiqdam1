<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_settings extends MY_Controller
{

    public $module = 'site_settings';


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Site_setting_model');
        $this->load->library('form_validation');
        $this->adminSecurity();
    }



    public function tax()
    {
        $institution = $this->Site_setting_model->get();
        if ($institution && count($institution))
        {
            $this->data['institution'] = $institution[0];
        } else
        {
            $this->data['institution'] = $this->Site_setting_model->get_new();
        }


        $this->load->library('form_validation');
        $this->form_validation->set_rules('tax_amount', 'lang:tax_amount', 'trim|required');
        if ($this->form_validation->run($this) == true)
        {
            $this->db->query("UPDATE institution_details SET tax_amount = ?", array($this->input->posT('tax_amount')));
            $this->session->set_flashdata('success', 'Tax Amount Saved Successfully');

        }
        $this->adminTemplate('tax', $this->data);
    }

    public function index()
    {
        $this->lang->load('site_settings');

        // fetch exist institution details
        $institution = $this->Site_setting_model->get();
        if ($institution && count($institution))
        {
            $this->data['institution'] = $institution[0];
        } else
        {
            $this->data['institution'] = $this->Site_setting_model->get_new();
        }


        if ($this->input->is_ajax_request())
        {
            $this->output->set_content_type('application_json');
            $this->form_validation->set_rules($this->Site_setting_model->rules);
            if ($this->form_validation->run() == FALSE)
            {
                $this->output->set_output(json_encode([
                    'result' => 0,
                    'errors' => $this->form_validation->error_array(),
                ]));
                return false;
            } else {
                $data = $this->Site_setting_model->array_from_post([
                    'name_in_english', 'name_in_arabic',
                    'phone', 'mobile',
                    'fax', 'email',
                    'address_in_english',
                    'address_in_arabic', 'licence_number',
                    'commercial_licence', 'website', 'tax_amount'
                ]);
                if ($this->data['institution']->id != '')
                {
                    $this->Site_setting_model->save($data, $this->data['institution']->id);
                    $this->output->set_output(json_encode([
                        'result' => 1,
                        'success' => 'Institution Details Updated Successfully',
                    ]));
                    return false;
                } else
                {
                    $this->Site_setting_model->save($data);
                    $this->output->set_output(json_encode([
                        'result' => 1,
                        'success' => 'Institution Details Added Successfully',
                    ]));
                    return false;
                }
            }
            exit;
        }


        // admin Template
        $this->adminTemplate('index', $this->data);
    }



    public function site_logo()
    {
        $this->data['logo'] = $this->Site_setting_model->get_field(null, 'logo');

        $this->adminTemplate('site_logo', $this->data);
    }



    public function do_upload()
    {
        // fetch exist institution details
        $institution = $this->Site_setting_model->get();
        if ($institution && count($institution))
        {
            $this->data['institution'] = $institution[0];
        } else
        {
            $this->data['institution'] = $this->Site_setting_model->get_new();
        }


        $config['upload_path']          = FCPATH . "assets/img";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4096;
        $config['max_width']            = 10240;
        $config['max_height']           = 20240;

        $this->load->library('upload');
        $this->upload->initialize($config);


        if (!$this->upload->do_upload('photo'))
        {
            $error = ['error' => $this->upload->display_errors()];
            $this->session->set_flashdata('error', $error);	// set error in flash message
            redirect('site_settings/site_logo');	// redirect to upload image
        }
        else
        {
            // upload was successfully
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            if ($upload_data['image_width'] > 1024 && $upload_data['image_height'] > 2024)
            {
                $this->resize_image(700, 500, $file_name);
//                $this->delete_image($file_name);
            }

            // Save in database
            if ($this->data['institution']->id == '')
            {
                $this->Site_setting_model->save([
                    'name_in_english' => '', 'name_in_arabic' => '',
                    'phone' => '', 'mobile' => '',
                    'fax' => '', 'email' => '',
                    'address_in_english' => '',
                    'address_in_arabic' => '', 'licence_number' => '',
                    'commercial_licence' => '', 'website' => '', 'tax_amount' => '',
                    'logo' => $file_name,
                ]);
            } else
            {
                $this->Site_setting_model->save(['logo' => $file_name], $this->data['institution']->id);
            }


//
//            $this->data['headline'] = 'Upload Successfully';
//            $this->data['upload_data'] = $upload_data;
            // load view
            redirect('site_settings/site_logo');	// redirect to upload image
        }


    }





    public function get_translation()
    {
        $this->adminTemplate('translation/index', $this->data);
    }


    public function post_add_translation()
    {
        $folder = strtolower($this->input->post('language_name'));
        mkdir(APPPATH . "/language/" . $folder, 0777);
        $language_dir = $this->input->post('language_direction');
        $info = json_encode(array('name' => $folder, 'language_direction' => $language_dir, 'folder' => $folder, 'author' => 'marious'));
        file_put_contents('./application/language/' . $folder . '/info.json', $info);
//        $fp = fopen('./application/langauge/' . $folder . '/info.json', 'w+');
//        fwrite($fp, $info);
//        fclose($fp);
        $files = scandir('./application/language/english/');
        foreach ($files as $f)
        {
            if ($f != "." and $f != ".." and $f != 'info.json')
            {
                copy('./application/language/english/'.$f, './application/language/'.$folder.'/'.$f);
            }
        }
        redirect(site_url('site_settings/get_translation'));
    }




    public function get_translation_edit($type = null)
    {
        if ($this->input->get('edit') != '')
        {
            $cur_lang = $this->input->get('edit');

            $file = ($this->input->get('file')? $this->input->get('file') : 'general_lang.php' );
            $files = scandir( FCPATH .'application/language/'.$this->input->get('edit').'/');

            $path = FCPATH.'/application/language/'.$cur_lang.'/'.$file;

            if( file_exists($path)){
                include ($path) ;
            }else{
                exit('file lang '.$file.' not exists');
            }

            $this->data['page_title']   = 'Helper Manual';
            $this->data['page_note']    = 'Documnetation';
            $this->data['lang']         = $this->input->get('edit');
            $this->data['string_lang']  = $lang;
            $this->data['files']        = $files;
            $this->data['file']         = $file;

            $template = 'translation/edit';
        }
        else
        {
            $this->data['page_title']   = 'Helper Manual';
            $this->data['page_note']    = 'Documnetation';
            $template = 'translation/index';
        }

        $this->adminTemplate($template, $this->data);
    }


    function post_save_translation()
    {
        $form    = "<?php \n";
        foreach($_POST as $key => $val)
        {
            if($key !='_token' && $key !='lang' && $key !='file')
            {
                $form .= '$lang["'.$key.'"]  = "'.$this->input->post($key , true).'"; '." \n ";
            }
        }
        $form .= '';
        //echo $form; exit;

        $lang = $this->input->post('lang', true);
        $file  = $this->input->post('file', 1);
        $filename = './application/language/'.$lang.'/'.$file;
        //  $filename = 'lang.php';
        $fp = fopen($filename,"w+");
        fwrite($fp,$form);
        fclose($fp);

//        SiteHelpers::alert('success','Translation has been saved !');
        redirect('site_settings/get_translation_edit?edit='.$lang.'&file='.$file);
    }

    /**
     * Set the site lang specified by user
     *
     * @param $lang
     */
    public function lang($lang)
    {
        $_SESSION['language'] = $lang;
        redirect($_SERVER['HTTP_REFERER']);
    }



    protected function resize_image($width = 200, $height = 200, $filename)
    {
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= FCPATH . "assets/img/" . $filename;
        $config['new_image'] 		= FCPATH . "assets/img/" . $filename;
        $config['maintain_ratio'] 	= TRUE;
        $config['width']         	= $width;
        $config['height']       	= $height;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }


    protected function delete_image($file_name)
    {
        $img_path = FCPATH . 'assets/img/' . $file_name;

        // attempt to remove images
        if (file_exists($img_path))
        {
            unlink($img_path);
        }
    }

}	