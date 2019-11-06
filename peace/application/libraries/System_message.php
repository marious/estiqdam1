<?php

/**
 * Library to set / get system messages
 */
class System_message
{
    protected $CI;

    // key for storing into session / flashdata
    protected $mSessionKey = 'system_messages';

    // array to store success / error messages
    protected $mMessages;


    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('session');

        $this->mMessages = [
            'success' => [],
            'error' => [],
        ];
    }


    // Set a message of specific type (clear other messages)
    public function set($type, $msg, $save_to = 'flash')
    {
        $this->mMessages[$type] = array($msg);
        $this->save($save_to);
    }


    // Append message of specific type
    public function add($type, $msg, $save_to = 'flash')
    {
        $this->mMessages[$type][] = $msg;
        $this->save($save_to);
    }


    // Set a success message (clear other success messages)
    public function set_success($msg, $save_to = 'flash')
    {
        $this->set('success', $msg);
    }


    public function add_success($msg, $save_to = 'flash')
    {
        $this->add('success', $msg);
    }

    // Set an error message (clear other error messages)
    public function set_error($msg, $save_to = 'flash')
    {
        $this->set('error', $msg);
    }

    // Append error message
    public function add_error($msg, $save_to = 'flash')
    {
        $this->add('error', $msg);
    }


    // Save messages to Flashdata
    public function save($to = 'flash')
    {
        switch ($to) {
            case 'flash':
                $_SESSION[$this->mSessionKey] = $this->mMessages;
                $this->CI->session->mark_as_flash($this->mSessionKey);
                break;
            case 'session':
                $_SESSION[$this->mSessionKey] = $this->mMessages;
                break;
            case 'temp':
                $_SESSION[$this->mSessionKey] = $this->mMessages;
                $this->CI->session->mark_as_temp($this->mSessionKey);
        }
    }


    // Restore message from flashdata
    public function restore($from = 'flash', $keep_flash = false)
    {
        switch ($from) {
            case 'flash':
                $this->mMessages = $this->CI->session->flashdata($this->mSessionKey);

                // keep flashdata for longer time
                if ($keep_flash) {
                    $this->CI->session->mark_as_flah($this->mSessionKey);
                }
                break;
            case 'session':
                $this->mMessages = $_SESSION[$this->mSessionKey];
            case 'temp':
                $this->CI->session->tempdata($this->mSessionKey);
                break;

        }
    }


    // Render all system messages
    public function render($from = 'flash')
    {
        $this->restore($from);
        return $this->render_by_type('success').$this->render_by_type('error');
    }


    public function render_by_type($type)
    {
        $class_names = [
            'success'   => 'success',
            'error'     => 'danger',
            'warning'   => 'warning',
        ];

        $class_name = $class_names[$type];

        // compose Alert Box HTML string
        $str = '';
        if (!empty($this->mMessages[$type]))
        {
            $str .= '<div class="alert alert-'.$class_name.'">';
            foreach ($this->mMessages[$type] as $msg)
            {
                $str .= "<p>$msg</p>";
            }
            $str .= '</div>';
        }
        return $str;
    }
}