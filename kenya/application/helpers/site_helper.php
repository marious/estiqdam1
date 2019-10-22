<?php
//$num = '1.999,369€';
//var_dump(tofloat($num)); // float(1999.369)
//$otherNum = '126,564,789.33 m²';
//var_dump(tofloat($otherNum)); // float(126564789.33)

function tofloat($num) {
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    }

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}
/**
 * Check if the current sidebar menu is active or not
 */
function is_sidebar_menu_active($current) 
{
    $CI =& get_instance();
    if ($CI->uri->segment(1) == $current) {
      return 'active';
    }
    return '';
}


function is_tree_sidebar_menu_active($first, $second) {
  $CI =& get_instance();
    if ($CI->uri->segment(2) == $second && $CI->uri->segment(1) == $first) {
      return 'active';
    }
    return '';
}


/**
 * Get the setting by it's name
 */
function setting($setting_name = null) {
  $CI =& get_instance();
  if ($setting_name) {
    $query = $CI->db->get_where('settings', ['name' => $setting_name]);
    return $query->row() ? $query->row()->value : '';
  }
}

function default_currency()
{
    $CI =& get_instance();
    $query = $CI->db->get_where('currencies', ['is_default' => 1]);
    return $query->row() ? $query->row()->symbol : '';
}


function active_tab($current)
{
    if (isset($_SESSION['active_tab']) && $_SESSION['active_tab'] == $current) {
        return 'active';
    }
}


function addToJson($ar , $en)
{
    $text = [
        'en' => $en,
        'ar' => $ar,
    ];

    $json = json_encode($text , JSON_UNESCAPED_UNICODE);

    return $json;
}

function make_slug($title, $lang = 'en')
{
    return $lang == 'ar' ? preg_replace('/[^\x{0600}-\x{06FF}0-9-]+/u', '-', $title) :
        strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $title));
}

function transText($dataField , $lang = null)
{
    if($dataField != '') {
        $text = json_decode($dataField);
        return $text->$lang;
    }
    return '';

//    if ($lang == null)
//        $lang = app()->getLocale();

}

function shortDescrip($descrip , $numb)
{
    $desc = words(strip_tags($descrip) , $numb ,' ....');
    return $desc;
}

 function words($value, $words = 100, $end = '...')
{
    preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $value, $matches);

    if (! isset($matches[0]) || get_length($value) === get_length($matches[0])) {
        return $value;
    }

    return rtrim($matches[0]).$end;
}

function get_length($value, $encoding = null)
{
    if ($encoding) {
        return mb_strlen($value, $encoding);
    }

    return mb_strlen($value);
}

function dateFormat($date = null){
    return date(setting('date_format'), strtotime($date));
}




function draw_actions_button($dit_link = '', $delete_link = '', $permission_group = '')
{
    $output = '';
    $logged_in_user_permissions = Modules::run('roles/get_active_user_permissions');

    
    if ($dit_link && in_array('edit' . '_' . $permission_group, $logged_in_user_permissions)) {
        $output .= '<a href="'.$dit_link.'" class="btn btn-sm btn-primary" title="'.lang('edit').'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;';
    }
    if ($delete_link && in_array('delete' . '_' . $permission_group, $logged_in_user_permissions))
    {
        $output .= '<a data-href="'.$delete_link.'" class="btn btn-sm btn-danger" title="'.lang('delete').'" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>';
    }
    return $output;
}



function get_current_lang()
{
    if (!isset($_SESSION['lang']) && !isset($_GET['lang']) && isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
    {
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    } 
    else if (isset($_SESSION['lang'])) {
        $lang = $lang;
    }

    return $lang;
}


function trans_date_to_timestamp($date, $format)
{
    $dateObj = \DateTime::createFromFormat($format, $date);
    return date("Y-m-d H:i:s", $dateObj->getTimestamp());
}


function csrf_field() {
    $CI =& get_instance();
    $token_name = $CI->security->get_csrf_token_name();
    $token_value = $CI->security->get_csrf_hash();
    return '<input type="hidden" name="'.$token_name.'" value="'.$token_value.'">';
}

function get_orderId($id) {
    return INVOICE_PRE + $id;
}


function currency($currency)
{
    $currency_format = setting('currency_format');

    if(!empty($currency_format)){

        if($currency_format == 1){
            echo number_format($currency, 2, '.', '');
        }
        elseif($currency_format == 2)
        {
            echo number_format($currency, 2, '.', ',');
        }
        elseif($currency_format == 3)
        {
            echo number_format($currency, 2, ',', '');
        }
        elseif($currency_format == 4)
        {
            echo number_format($currency, 2, ',', '.');
        }else{
            echo number_format($currency);
        }

    }else{
        echo number_format($currency, 2, '.', ',');
    }

}