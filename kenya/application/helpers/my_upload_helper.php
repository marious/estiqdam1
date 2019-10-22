<?php


function upload_bill()
{
    if (isset($_FILES['bill']['name']) && $_FILES['bill']['name'] != '') {
        $CI =& get_instance();
        $config['upload_path'] = UPLOAD_BILL;
        $config['allowed_types'] = 'pdf|png|jpeg|jpg|gif';
        $config['max_size'] = '2024';
        $config['max_size'] = '2024';

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('bill')) {
            $fdata = $CI->upload->data();
            return $fdata['file_name'];
        }
    }

    return false;
}