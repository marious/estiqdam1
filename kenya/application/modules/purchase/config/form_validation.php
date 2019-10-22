<?php

$config = array(


    'purchase/save_purchase' => array(
        array(
            'field' => 'vendor_id',
            'label' => 'lang:vendor',
            'rules' => 'trim|required|xss_clean',
        ),
        array(
            'field' => 'product',
            'label' => 'lang:product',
            'rules' => 'trim|xss_clean',
        ),
        array(
            'field' => 'qty',
            'label' => 'lang:qty',
            'rules' => 'trim|xss_clean|integer'
        ),
        array(
            'field' => 'discount',
            'label' => 'lang:discount',
            'rules' => 'trim|numeric',
        ),
        array(
            'field' => 'payment_date',
            'label' => 'lang:payment_date',
            'rules' => 'trim|valid_date|xss_clean',
        ),
        array(
            'field' => 'order_ref',
            'label' => 'lang:order_ref',
            'rules' => 'trim|xss_clearn',
        ),
        array(
            'field' => 'amount',
            'label' => 'lang:amount',
            'rules' => 'trim|numeric',
        ),
        array(
            'field' => 'description',
            'label' => 'lang:description',
            'rules' => 'trim',
        ),
    ),

);