<?php
class News_model extends MY_Model
{
    protected $table_name = 'news';
    protected $timestamps = true;

    public $rules = [
        [
            'field' => 'en_name',
            'label' => 'lang:en_news_title',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'ar_name',
            'label' => 'lang:ar_news_title',
            'rules' => 'trim|required|max_length[255]',
        ],
        [
            'field' => 'en_description',
            'label' => 'lang:en_description',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'ar_description',
            'label' => 'lang:ar_description',
            'rules' => 'trim|required',
        ],
    ];



    public function get_news_with_limit($order_by = 'created_at', $sort = 'DESC', $limit = null, $offset = 0)
    {
        $this->db->select('news.*');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        if ($order_by) {
            $this->db->order_by($order_by, $sort);
        }
        return parent::get();
    }


    public function get_all_news()
    {
        // for ordering
        $columns[0] = 'news.id';
        $columns[6] = 'news.created_at';


        $query = "SELECT * FROM news";
        $binds = [];
        if (isset($_POST['search']['value']))
        {
            $query .= ' WHERE name LIKE ? ';
            $query .= ' OR slug LIKE ? ';
            $query .= ' OR description LIKE ? ';
        }



        if (isset($_POST['order']))
        {
            $query .= ' ORDER BY ' . $columns[$_POST['order'][0]['column']] . ' ' .
                $_POST['order'][0]['dir'] . ' ';
        }
        else {
            $query .= ' ORDER BY id  ';
        }

        $query1 = '';
        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $query1 .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
        if (isset($_POST['search']['value']))
        {
            $search_value = trim($_POST['search']['value']);
            $binds[] =  '%' . $search_value . '%';
            $binds[] =  '%' . $search_value . '%';
            $binds[] =  '%' . $search_value . '%';
        }

        if (isset($_POST['length']) && $_POST['length'] != -1)
        {
            $q = $this->db->query($query . ' ' . $query1, $binds);
        }
        else
        {
            $q = $this->db->query($query, $binds);
        }

        $q2 = $this->db->query($query, $binds);

        $number_filter_row = $q2->num_rows();
        $data = [];
        $i = 1;
        foreach ($q->result() as $row) {
            $sub_array =[];
            $sub_array[] = $i;
            $sub_array[] = transText($row->name, 'en');
            $sub_array[] = transText($row->name, 'ar');
            $sub_array[] = shortDescrip(transText($row->description, 'en'), 25);
            $sub_array[] = shortDescrip(transText($row->description, 'ar'), 25);
            $sub_array[] = ($row->image) ? '<img src="'.site_url($row->image).'" width="80px" height="60px">' : '';
            $sub_array[] = dateFormat($row->created_at);
            $sub_array[] = draw_actions_button(site_url('news/edit/' . $row->id), site_url('news/delete/'.$row->id), 'services');
            $data[] = $sub_array;
            $i++;
        }
        $output = [
            "draw" => intval($_POST['draw']),
            "recordsTotal"  	=>  $this->get_news_count(),
            "recordsFiltered" 	=> $number_filter_row,
            "data"    			=> $data,
        ];
        echo json_encode($output);

    }

    public function get_news_count()
    {
        $query = "SELECT * FROM news";
        $q = $this->db->query($query);
        return $q->num_rows();
    }


    public function get_latest_news()
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(6);
        $q = $this->db->get('news');
        return $q->result();
    }




    public function get_news_by_slug($slug)
    {
        $slugs = $this->get_all_slugs();
        if (array_key_exists($slug, $slugs))
        {
            $news_id = $slugs[$slug];
        } else {
            return false;
        }
    
        if ($news_id && is_numeric($news_id))
        {
            return $this->get($news_id, true);
        }
        return false;
    }


    public function get_all_slugs()
    {
        $this->db->select('*');
        $this->db->from('news');
        $q = $this->db->get();
        $result = $q->result();

        $data = [];
        foreach ($result as $row) {
            $data[transText($row->slug, 'en')] = $row->id;
            $data[transText($row->slug, 'ar')] = $row->id;
        }

        return $data;
    }


}