<?php
function admin_assets($file) {
    return base_url() . 'assets/admin_panel/' . $file;
}

function format_money($locale = 'en-US', $num) {
    $locale = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    return $locale->format($num);
}

function active_tab($checkTab) {
    $ci =& get_instance();
    if ($ci->uri->segment(1) == $checkTab) {
        return 'active';
    }
    return '';
}

function calculate_age($birth_date)
{
    if ($birth_date) {
        $birthDate = explode("/", $birth_date);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 0)
            : (date("Y") - $birthDate[2]));
        return $age;
    }
}


function arabic_day($day)
{
    $day = strtolower($day);
    $arabic_days = [
        'saturday' => 'السبت',
        'sunday' => 'الاحد',
        'monday' => 'الاثنين',
        'tuesday' => 'الثلاثاء',
        'wednesday' => 'الاربعاء',
        'thursday' => 'الخميس',
        'friday' => 'الجمعة',
    ];
    if (array_key_exists($day, $arabic_days)) {
        return $arabic_days[$day];
    }
}



function langOption()
{
    $lang = scandir( APPPATH.'/language/');
    $t = array();
    foreach($lang as $value) {
        if($value === '.' || $value === '..') {continue;}
        if(is_dir( APPPATH . '/language/' . $value) && file_exists(APPPATH.'/language/'.$value.'/info.json'))
        {
            $fp = file_get_contents('application/language/'.$value.'/info.json');
            $fp = json_decode($fp,true);
            $t[] =  $fp ;
        }

    }
    return $t;
}


function get_language($lang)
{
    switch ($lang)
    {
        case 'en':
            return 'english';
            break;
        case 'ar':
            return 'arabic';
            break;
    }
}


function get_agent_allowed_url()
{
    return [
        'dashboard',
        'Admin',
        'agent_worker',
    ];
}

function get_yes_or_no($value)
{
    switch ($value) {
        case '0':
            return 'لا';
        break;
        case '1':
            return 'نعم';
            break;
    }
}

function calculate_after_tax_amount($total)
{
    $CI =& get_instance();

    $query = $CI->db->query("SELECT tax_amount FROM institution_details")->result();
    $percentage = (float) $query[0]->tax_amount;
    $total = (float) $total;
    $tax_amount = ($percentage/100) * $total;
    $total = $total + $tax_amount;
    return ['tax_amount' => $tax_amount, 'total' => $total];
}

function get_day_lang()
{
    if (isset($_SESSION['language']) && $_SESSION['language'] == 'arabic')
    {
        return ' يوم ';
    }
    return ' days ';
}




function value_exists($table,$col,$value,$id='',$id_value='')
{
    $CI	=&	get_instance();
    $CI->load->database();
    $rowcount=0;

    if($id=='' && $id_value==''){
        $CI->db->select($col);
        $CI->db->from($table);
        $CI->db->where($col,$value);
        $CI->db->where('user_id',$_SESSION['id']);
        $query=$CI->db->get();
        $rowcount = $query->num_rows();
    }else{
        $CI->db->select($col);
        $CI->db->from($table);
        $CI->db->where($col,$value);
        $CI->db->where('user_id',$_SESSION['id']);
        $CI->db->where_not_in($id,$id_value);
        $query=$CI->db->get();
        $rowcount = $query->num_rows();

    }

    if($rowcount>0){
        return true;
    }else{
        return false;
    }

}

function value_exists2($table,$col,$value,$type,$type_value,$id='',$id_value='')
{
    $CI =&  get_instance();
    $CI->load->database();
    $rowcount=0;

    if($id=='' && $id_value==''){
        $CI->db->select($col);
        $CI->db->from($table);
        $CI->db->where($col,$value);
//        $CI->db->where('user_id',$CI->session->userdata('user_id'));
        $CI->db->where($type,$type_value);
        $query=$CI->db->get();
        $rowcount = $query->num_rows();
    }else{
        $CI->db->select($col);
        $CI->db->from($table);
        $CI->db->where($col,$value);
        $CI->db->where($type,$type_value);
//        $CI->db->where('user_id',$CI->session->userdata('user_id'));
        $CI->db->where_not_in($id,$id_value);
        $query=$CI->db->get();
        $rowcount = $query->num_rows();

    }

    if($rowcount>0){
        return true;
    }else{
        return false;
    }

}


function getOld($id,$id_value,$table){
    $CI =&  get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from($table);
    $CI->db->where($id,$id_value);
    $query=$CI->db->get();
    $result=$query->row();
    return $result;
}


if ( ! function_exists('get_current_setting'))
{

    function get_current_setting($setting) {
        $CI =&	get_instance();
        $CI->load->database();
        $CI->db->select('value');
        $CI->db->from('settings');
        $CI->db->where('settings',$setting);
        $query=$CI->db->get();
        $result=$query->row();
        return $result->value;
    }

}

if ( ! function_exists('decimalPlace'))
{

    function decimalPlace($number){
        return number_format((float)$number, 2);
    }

}
