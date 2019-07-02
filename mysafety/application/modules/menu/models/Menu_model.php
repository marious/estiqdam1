<?php 

class Menu_model extends MY_Model 
{
    protected $table_name = 'menu';
//    protected $timestamps = true;



    public function get_menu($position = 'top', $active = '1')
    {
        $data= [];
        $menu = $this->get_nested_menu(0, $position, $active);
        
        if (!$menu) {return $data;}
        

        foreach ($menu as $row) {
          $child_level = [];
          // $p = json_decode($row->access_data, true);
          $menu2 = $this->get_nested_menu($row->id, $position, $active);
          if (is_array($menu2) && count($menu2))
          {
            $level2 = [];
            foreach ($menu2 as $row2) {
              $menu2 = [
                'id'          => $row2->id,
                'page'      => $row2->page,
                'menu_type'   => $row2->menu_type,
                'url'         => $row2->url,
                'menu_name'   => $row2->menu_name,
                'menu_lang'   => json_decode($row2->menu_lang, true),
                'menu_icons'  => $row2->menu_icons,
                'childs'      => [],
              ];

              $menu3 = $this->get_nested_menu($row2->id, $position, $active);
              if (is_array($menu3) && count($menu3)) {
                $child_level_3 = [];
                foreach ($menu3 as $row3) {
                  $menu3 = [
                    'id'          => $row3->id,
                    'page'      => $row3->page,
                    'menu_type'   => $row3->menu_type,
                    'url'         => $row3->url,
                    'menu_name'   => $row3->menu_name,
                    'menu_lang'   => json_decode($row3->menu_lang, true),
                    'menu_icons'  => $row3->menu_icons,
                    'childs'      => [],
                  ];
                  $child_level_3[] = $menu3;
    
                }
                $menu2['childs'] = $child_level_3;              
              }

              $level2[] = $menu2;

            }

            $child_level = $level2;
          }

          $level = [
						'id'		      => $row->id,
						'page'		  => $row->page,
						'menu_type'		=> $row->menu_type,
						'url'			    => $row->url,						
						'menu_name'		=> $row->menu_name,
						'menu_lang'		=> json_decode($row->menu_lang,true),
						'menu_icons'	=> $row->menu_icons,
						'childs'		  => $child_level
          ];			
        
          $data[] = $level;
        }

       

        return $data;
    }





    public function get_nested_menu($parent = 0, $position = 'top', $active = '1')
    {
      $active = ($active == 'all') ? '' : " AND active ='1' ";
        $query = "SELECT menu.*
                  FROM menu
                  WHERE parent_id = ? $active AND position = ?
                  ORDER BY ordering
              ";
        $q = $this->db->query($query, [$parent, $position]);
        if ($q->num_rows()) {
          return $q->result();
        }
        return false;
    }
}