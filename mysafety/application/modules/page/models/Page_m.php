<?php
class Page_m extends MY_Model
{

    protected $table_name = 'pages';

    public function slug_exist($slug)
    {
        return array_key_exists($slug, $this->get_all_slugs());
    }

    public function get_page_slug($slug)
    {
        return $this->get($this->get_all_slugs()[$slug]);
    }

    public function get_all_slugs()
    {
        $this->db->select('id, slug');
        $this->db->from('pages');
        $q = $this->db->get();
        $result = $q->result();

        $data = [];
        foreach ($result as $row) {
            $data[transText($row->slug, 'en')] = $row->id;
            $data[transText($row->slug, 'ar')] = $row->id;
        }

        return $data;
    }


    public function get_method_layout($layout_id)
    {
        $q = $this->db->get_where('pages_layout', ['id' => $layout_id]);
        return $q->row();

    }

}