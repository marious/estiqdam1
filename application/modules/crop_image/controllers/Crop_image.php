<?php
class Crop_image extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->adminSecurity();
        $this->load->library('pagination');
        //per page limit
        $this->perPage = 10;
    }

    public function index()
    {
        $this->data['pagination'] = true;
        // get rows count
        $conditions['returnType'] = 'count';
        $total_rec = $this->get_workers($conditions);

        // pagination config
        $config['base_url']    = base_url().'crop_image/index/';
        $config['uri_segment'] = 3;
        $config['total_rows']  = $total_rec;
        $config['per_page']    = $this->perPage;

        //styling
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //initialize pagination library
        $this->pagination->initialize($config);

        //define offset
        $page = $this->uri->segment(3);
        $offset = !$page?0:$page;

        //get rows
        $conditions['returnType'] = '';
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        $this->data['workers'] = $this->get_workers($conditions);


        $this->load->view('index', $this->data);
    }


    public function get_maid()
    {
        $worker_number = $_GET['worker_number'];
        $worker = $this->get_workers(array('id' => $worker_number));
        $this->data['worker'] = $worker;
        $this->data['pagination'] = false;

        $this->load->view('index', $this->data);

    }


    public function crop()
    {
//        var_dump($_POST);exit;
        $large_image = substr($_POST['imgSrc'], strpos($_POST['imgSrc'], 'assets'));
//        var_dump($large_image);exit;
        $thumbImageLoc = 'assets/img/workers/cropped/' .basename($large_image);

        if (file_exists($large_image))
        {

            $info = getimagesize($large_image);
            $file_type = $info['mime'];

            //file permission
//            chmod ($large_image, 0777);

            //get dimensions of the original image
            list($width_org, $height_org) = getimagesize($large_image);

            //get image coords
            $x = (int) $_POST['x'];
            $y = (int) $_POST['y'];
            $width = (int) $_POST['w'];
            $height = (int) $_POST['h'];

            //define the final size of the cropped image
            $width_new = $width;
            $height_new = $height;

            //crop and resize image
            $newImage = imagecreatetruecolor($width_new,$height_new);


            switch($file_type) {
                case "image/gif":
                    $source = imagecreatefromgif($large_image);
                    break;
                case "image/pjpeg":
                case "image/jpeg":
                case "image/jpg":
                    $source = imagecreatefromjpeg($large_image);
                    break;
                case "image/png":
                case "image/x-png":
                    $source = imagecreatefrompng($large_image);
                    break;
            }
            imagecopyresampled($newImage,$source,0,0,$x,$y,$width_new,$height_new,$width,$height);

            switch($file_type) {
                case "image/gif":
                    imagegif($newImage,$thumbImageLoc);
                    break;
                case "image/pjpeg":
                case "image/jpeg":
                case "image/jpg":
                    imagejpeg($newImage,$thumbImageLoc,90);
                    break;
                case "image/png":
                case "image/x-png":
                    imagepng($newImage,$thumbImageLoc);
                    break;
            }
            imagedestroy($newImage);
            echo 'CROP IMAGE:<br/><img src="'.site_url($thumbImageLoc).'"/>';
            echo '<br>';
            echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Back</a>';

        }

    }


    public function get_workers($params = [])
    {
        $this->db->select('*');
        $this->db->from('agent_worker');
        $this->db->order_by('id', 'desc');
        if (array_key_exists('id', $params))
        {
            $this->db->where('id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }
        else
        {
            // set start and limit
            if (array_key_exists('start', $params) && array_key_exists('limit', $params))
            {
                $this->db->limit($params['limit'],$params['start']);
            } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params))
            {
                $this->db->limit($params['limit']);
            }
            if (array_key_exists('returnType', $params) && $params['returnType'] == 'count')
            {
                $result = $this->db->count_all_results();
            }
            else
            {
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        //return fetched data
        return $result;
    }


    public function update_image_name()
    {
        $new_image = 'cropped/' . $_POST['image'];
        $this->db->set(array('image' => $new_image));
        $this->db->where('id', $_POST['id']);
        $this->db->update('agent_worker');
        redirect($_SERVER["HTTP_REFERER"]);
    }

}