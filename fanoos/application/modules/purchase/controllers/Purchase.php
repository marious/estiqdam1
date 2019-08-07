<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('form_builder');
        $this->lang->load('sales');
        $this->lang->load('purchase');
        $this->load->module('crud');
    }

    public function new_purchase()
    {
        $this->cart->destroy();
        $data = [
            'tax'       => '',
            'discount'  => '',
            'shipping'  => '',
        ];
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }

        $vendor_id = $this->input->get('nameID');

        if (!empty($vendor_id))
        {
            $v_detail = $this->db->get_where('vendors', [
                'id' => $vendor_id,
            ])->row();
            if ($v_detail) {
                $this->data['v_detail'] = $v_detail;
            }
        }
        else
        {
            $this->data['v_detail'] = (Object) [
                'id'        => '',
                'b_address' => '',
                'email'     => '',
            ];
        }

        $this->data['form'] = $this->form_builder->create_form('purchase/save_purchase', true, ['id' => 'form-invoice']);
        $this->data['vendors'] = $this->db->get('vendors')->result();

        $categories = $this->db->order_by('category', 'asc')->get('product_category')->result();

        $products = [];
        if (is_array($categories) && count($categories))
        {
            foreach ($categories as $category) {
                $product = $this->db->order_by('name', 'asc')->get_where('items', [
                    'category_id' => $category->id,
                    'type'        => 'Inventory',
                ])->result();

                if (!$product) {
                    continue;
                }

                $products[$category->category] = $product;
            }
        }

        $this->data['products'] = $products;
        $this->admin_template('create_invoice', $this->data);

    }



    public function select_vendor_by_id()
    {
        $row = $this->db->get_where('vendors', ['id' => $this->input->post('vendor_id')])->row();
        if ($row) {
            echo json_encode([
                'id'          => $row->id,
                'email'       => $row->email,
                'b_address'   => $row->b_address,
            ]);
        } else {
            echo json_encode([
                'id'          => '',
                'email'       => '',
                'b_address'   => '',
            ]);
        }
        return;
    }



    public function show_cart()
    {
        $categories = $this->db->order_by('category', 'asc')->get('product_category')->result();

        if(!empty($categories)){
            foreach ($categories as $item){
                $tm_product = $this->db->order_by('name', 'asc')->get_where('items', array(
                    'category_id' => $item->id,
                    'type' => 'Inventory',
                ))->result();

                if(!count($tm_product))
                    continue;

                $products[$item->category] = $tm_product;
            }
        }
        $data['products'] = $products;
        $this->load->view('add_product_cart',$data);
    }





    public function add_to_cart()
    {
        $id = $this->input->post('product_id');
        $product = $this->db->get_where('items', array( 'id' => $id ))->row();
        if(!empty($this->input->post('rowid'))){
            $data = array(
                'rowid' => $this->input->post('rowid'),
                'qty'   => 0
            );
            $this->cart->update($data);
        }

        if($product)
        {
            $data = array(
                'id'                => $product->id,
                'qty'               => 1,
                'price'             => $product->purchase_cost,
                'name'              => $product->name,
                'description'       => $product->buying_info,
                //'options' => array('Size' => 'L', 'Color' => 'Red')
            );
            $this->cart->insert($data);
        }
    }



    public function update_cart_item()
    {
        $type = $this->input->post('type');
        if ($type == 'qty')
        {
            $data = array(
                'rowid' => $this->input->post('rowid'),
                'qty'   => (int)$this->input->post('o_val')
            );
        }
        elseif ($type === 'prc')
        {
            $data = array(
                'rowid' => $this->input->post('rowid'),
                'price'   => (float)$this->input->post('o_val')
            );
        }
        elseif ($type === 'des')
        {
            $data = array(
                'rowid' => $this->input->post('rowid'),
                'description'   => $this->input->post('o_val')
            );
        }

        $this->cart->update($data);
    }


    public function remove_item()
    {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty'   => 0
        );
        $this->cart->update($data);

    }

}