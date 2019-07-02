<?php 
class Slider_model extends MY_Model
{
    protected $table_name = 'slider';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'en_heading',
            'label' => 'lang:en_heading',
            'rules' => 'trim',
        ],

        [
            'field' => 'ar_heading',
            'label' => 'lang:ar_heading',
            'rules' => 'trim',
        ],

        [
            'field' => 'en_content',
            'label' => 'lang:en_content',
            'rules' => 'trim',
        ],

        [
            'field' => 'ar_content',
            'label' => 'lang:ar_content',
            'rules' => 'trim',
        ],

        [
            'field' => 'en_button_text',
            'label' => 'lang:en_button_text',
            'rules' => 'trim',
        ],

        [
            'field' => 'ar_button_text',
            'label' => 'lang:ar_button_text',
            'rules' => 'trim',
        ],

        [
            'field' => 'button_url',
            'label' => 'lang:button_url',
            'rules' => 'trim',
        ],

        [
            'field' => 'position',
            'label' => 'lang:position',
            'rules' => 'trim|callback__valid_position',
        ],


        [
            'field' => 'status',
            'label' => 'lang:status',
            'rules' => 'trim|callback__valid_status',
        ],
        
    ];



    public function get_all()
    {
        $this->load->library('datatable');
        $this->datatable->setQuery('SELECT * FROM slider');
       // $this->datatable->setSearchedValues([]);
        $result = $this->datatable->getResult();
        $i = 1;
        $data = [];
        foreach ($result as $row) {
            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = transText($row->heading, 'en');
            $sub_array[] = transText($row->heading, 'ar');
            $sub_array[] = transText($row->button_text, 'en');
            $sub_array[] = transText($row->button_text, 'ar');
            $sub_array[] = $row->status == 1 ? '<span class="label label-success">' . lang('active') .'</span>' : 
                '<span class="label label-danger">'.lang('inactive').'</span>';
            $sub_array[] = lang($row->position);
            $sub_array[] =  ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = '<div class="manage-buttons">' . draw_actions_button(site_url('slider/edit/' . $row->id), site_url('slider/delete/'.$row->id), 'slider') . '</div>';
            $data[] = $sub_array;
            $i++;
        }
        $count = $this->get_slider_count();
        echo $this->datatable->output($data, $count);

    }



    public function get_slider_count()
    {
        $query = "SELECT * FROM slider";
        $q = $this->db->query($query);
        return $q->num_rows();
    }

}