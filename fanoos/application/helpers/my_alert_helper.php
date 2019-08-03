<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('message_box'))
{
    function message_box($message_type, $close_button = TRUE)
    {
        $CI =& get_instance();
        $message = isset($_SESSION[$message_type]) ? $_SESSION[$message_type] : false;
        $val = '';

        if ($message == false) return '';

        if ($message)
        {
            switch ($message_type) {
                case 'success':
                    $val .= '<div class="alert alert-success">';
                    break;
                case 'error':
                    $val .= '<div class="alert alert-danger">';
                    break;
                case 'info':
                    $val .= '<div class="alert alert-info">';
                    break;
                case 'warning':
                    $val .= '<div class="alert alert-warning">';
                    break;
            }
        }

        if ($close_button)
        {
            $val .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';
            $val .= $message;
            $val .= '</div>';
            return $val;
        }
    }
}


if (!function_exists('set_message'))
{
    function set_message($type, $message)
    {
        $CI =& get_instance();
        $_SESSION['message_type'] = $type;
        $_SESSION['message'] = $message;
        $CI->session->mark_as_flash([$type, $message]);
        return true;
    }
}
