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
        $this->load_daterange_datepicker();

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
        $this->load->module('banks');
        $this->data['accounts'] = $this->banks->Bank_model->get();
        $this->data['categories'] = $this->db->get_where('categories', ['type' => 'Income'])->result();




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



//------------------------------------------------------------------------------------------------------------
//************************* Add to cart *****************************************************************
//------------------------------------------------------------------------------------------------------------

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



    public function order_discount()
    {
        $discount = (float) $this->input->post('discount');
        $data = !empty($discount) ? ['discount' => $discount] : ['discount' => 0];
        $_SESSION['discount'] = $data['discount'];
    }


    public function order_tax()
    {
        $tax = (float) $this->input->post('tax');
        $data = !empty($tax) ? ['tax' => $tax] : ['tax' => 0];
        $_SESSION['tax'] = $data['tax'];
    }


    public function order_shipping()
    {
        $shipping = (float) $this->input->post('shipping');
        $data = !empty($shipping) ? ['shipping' => $shipping] : ['shipping' => 0];
        $_SESSION['shipping'] = $data['shipping'];
    }




    public function save_purchase()
    {
        if ($this->form_validation->run($this))
        {
            $sales_person           = $this->ion_auth->user()->row();

            $data['email']          = $this->input->post('email');
            $data['b_address']      = $this->input->post('b_address');
            $data['order_note']     = $this->input->post('order_note');
            $data['ref']            = $this->input->post('bill_ref');

            $data['cart_total']     = $this->cart->total();
            $data['discount']       = (float) $_SESSION['discount'];
            $data['tax']            = (float) $_SESSION['tax'];
            $data['shipping']       = (float) $_SESSION['shipping'];

            $data['grand_total']    = $this->cart->total() + $data['tax'] + $data['shipping'] - $data['discount'];
            $data['due_payment']    = $data['grand_total'];
            $data['cart']           = json_encode($this->cart->contents());

            $data['sales_person']   = $sales_person->first_name . ' ' . $sales_person->last_name;
            $data['vendor_id']      = $this->input->post('vendor_id');

            $data['vendor_name'] = $this->db->get_where('vendors', [
                'id' => $data['vendor_id'],
            ])->row()->company_name;

            // Save Purchase order table
            $this->db->insert('purchase_order', $data);
            $purchase_id = $this->db->insert_id();

            // Save purchase order details
            foreach ($this->cart->contents() as $item) {
                $o_details['purchase_id']       = $purchase_id;
                $o_details['product_id']        = $item['id'];
                $o_details['product_name']      = $item['name'];
                $o_details['description']       = $item['description'] ? $item['description'] : '';
                $o_details['qty']               = $item['qty'];
                $o_details['unit_price']        = $item['price'];
                $o_details['sub_total']         = $item['subtotal'];
                //save order details
                $this->db->insert('purchase_details', $o_details);
            }

            if ($purchase_id)
            {
                $payment_date = $this->input->post('payment_date');
                $payment_amount = $this->input->post('amount');
                $from_account = $this->input->post('from_account');
                if ($payment_date && $payment_amount && $from_account)
                {
                    $purchase = $this->db->get_where('purchase_order', ['id' => $purchase_id])->row();
                    $payment_data['payment_date'] = DateTime::createFromFormat(setting('date_format'), $this->input->post('payment_date'))->format('Y-m-d H:i:s');
                    $order_ref = $this->input->post('order_ref');
                    $payment_data['order_id'] = $purchase_id;
                    $payment_data['order_ref'] = $order_ref == '' ? get_orderId($payment_data['order_id']) . '/' . date('d/m/Y') : $order_ref;
                    $payment_data['amount'] = (float) $this->input->post('amount');
                    $payment_data['method'] = $this->input->post('payment_method');
                    $payment_method = $payment_data['method'];

                    switch ($payment_method) {
                        case 'cash':
                            $payment_data['payment_method'] = 'Cash';
                            break;
                        case 'bank':
                            $payment_data['payment_method'] = 'Bank Transfer';
                            //$payment_data['payment_ref'] = $this->input->post('payment_ref');
                            break;
                    }
                    $payment_data['type'] = 'Purchase';
                    $sales_person = $this->ion_auth->user()->row();
                    $payment_data['received_by'] = $sales_person->first_name.' '.$sales_person->last_name;

                    // Some required validation

                    if ((int) $purchase->due_payment == 0)
                    {
                        $this->message->custom_error_msg('purchase/purchase_invoice/'.get_orderId($purchase->id), 'error due payment = 0');
                    }
                    else if ((float) $this->input->post('amount') > (float) $purchase->due_payment)
                    {
                        $this->message->custom_error_msg('purchase/purchase_invoice/'.get_orderId($purchase->id), 'error amount bigger due');
                    }

                    $this->load->module('banks');

                    // Check account has the specified amount
                    $account_id = $this->input->post('from_account');
                    $account = $this->banks->Bank_model->get($account_id, true);
                    if ($payment_data['amount'] > $account->balance)
                    {
                        $this->message->custom_error_msg('purchase/purchase_invoice/'.get_orderId($purchase->id), lang('amount_greater_account_balance'));
                    }


                    $account_data = [];
                    $account_data['account'] = $this->input->post('from_account');
                    $account_data['amount'] = $payment_data['amount'];
                    $account_data['payee'] = $purchase->vendor_id;
                    $account_data['payee_type'] = 'Vendor';
                    $account_data['category'] = $this->input->post('category') ? $this->input->post('category') : '';
                    $account_data['date'] = $payment_data['payment_date'];
                    $account_data['ref'] = $payment_data['order_ref'];
                    $account_data['description'] = $this->input->post('description');


                    //insert
                    $this->db->insert('payment', $payment_data);

                    //update purchase order
                    $p_data['paid_amount'] = $purchase->paid_amount + $payment_data['amount'];
                    $p_data['due_payment'] = $purchase->due_payment - $payment_data['amount'];
                    $this->db->where('id', $purchase->id);
                    $this->db->update('purchase_order', $p_data);
                    $this->save_account_purchase_expense($account_data);


                    redirect('purchase/purchase_invoice/'.get_orderId($purchase->id));


                }
            }


         //   $this->message->save_success('purchase/purchase_list');

        }



        $this->system_message->set_error(validation_errors());
        redirect('purchase/new_purchase');
    }




    public function purchase_list()
    {

        $this->load_daterange_datepicker();
        $this->load_js_validation();
        $this->load->model('crud/Crud_model');
        $this->load->library('Grocery_CRUD');
        $this->load->model('Purchase_model');
        $crud = new Grocery_CRUD();

        $this->data['due']              = $this->Purchase_model->total_purchase_due_by_vendor();
        $this->data['paid']             = $this->Purchase_model->total_purchase_paid_by_vendor();
        $this->data['total_invoice']    = $this->Purchase_model->total_purchase_invoice_by_vendor();
        $this->data['return_purchase']  = $this->Purchase_model->total_return_purchase_by_vendor();

        $crud->columns('date', 'purchase_id', 'vendor_name', 'purchase_status', 'grand_total', 'paid_amount', 'due_payment', 'actions');

        $crud->display_as('date', lang('date'));
        $crud->display_as('purchase_id',lang('purchase_no'));
        $crud->display_as('vendor_name',lang('supplier'));
        $crud->display_as('purchase_status',lang('status'));
        $crud->display_as('grand_total', lang('grand_total'));
        $crud->display_as('paid_amount', lang('paid'));
        $crud->display_as('due_payment', lang('balance'));
        $crud->display_as('actions', lang('actions'));

        $crud->set_table('purchase_order');
        $crud->callback_column('date',array($this->Crud_model,'_callback_pur_action_date'));
        $crud->callback_column('purchase_id',array($this->Crud_model,'_callback_action_purchase_order_no'));
        $crud->callback_column('grand_total',array($this->Crud_model,'_callback_action_grand_total'));
        $crud->callback_column('paid_amount',array($this->Crud_model,'_callback_action_pur_paid_amount'));
        $crud->callback_column('due_payment',array($this->Crud_model,'_callback_action_pur_due_amount'));
        $crud->callback_column('actions',array($this->Crud_model,'_callback_action_purchase_order'));
        $crud->callback_column('purchase_status',array($this->Crud_model,'_callback_action_purchase_status'));
        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_read();

        $this->data['crud'] = $crud->render();

        $this->admin_template('purchase_list', $this->data);
    }


    public function purchase_invoice($id = null)
    {
        $this->load_daterange_datepicker();
        $this->load_js_validation();

        $id = $id - INVOICE_PRE;
        $this->data['order'] = $this->db->get_where('purchase_order', ['id' => $id])->row();

        if (!$this->data['order'])
        {
            redirect('purchase/purchase_list', 'refresh');
        }

        // purchase
        $this->data['order_details'] = $this->db->get_where('purchase_details', [
            'purchase_id'   => $id,
            'type'          => 'Purchase',
        ])->result();

        // return
        $this->data['return'] = $this->db->get_where('purchase_details', [
            'purchase_id'   => $id,
            'type'          => 'Return',
        ])->result();

        // payment
        $this->data['payment'] = $this->db->get_where('payment', [
            'order_id'  => $id,
            'type'      => 'Purchase',
        ])->result();

        // vendor
        $this->data['vendor'] = $this->db->get_where('vendors', [
            'id' => $this->data['order']->vendor_id,
        ])->row();

        $this->data['categories'] = $this->db->get_where('categories', ['type' => 'Expense'])->result();

        $this->admin_template('invoice', $this->data);
    }



    public function add_payment($id = null)
    {
        $id = $id - INVOICE_PRE;
        $this->load->module('banks');
        $data['categories'] = $this->db->get_where('categories', ['type' => 'Expense'])->result();
        $data['accounts'] = $this->banks->Bank_model->get();
        $data['purchase_order'] = $this->db->get_where('purchase_order', ['id' => $id])->row();
        $data['modal_subview'] = $this->load->view('modal/_add_payment', $data, false);
    }


    public function received_payment()
    {
        $this->load->module('banks');

        $id = $this->input->post('payment_id');
        $data['order_id'] = $this->input->post('order_id');
        $purchase_order = $this->db->get_where('purchase_order', ['id' => $data['order_id']])->row();
        $data['payment_date'] = DateTime::createFromFormat(setting('date_format'), $this->input->post('payment_date'))->format('Y-m-d H:i:s');
        $order_ref = $this->input->post('order_ref');
        $data['order_ref'] = $order_ref == '' ? get_orderId($data['order_id']) . '/' . date('d/m/Y') : $order_ref;
        $data['amount'] = (float) $this->input->post('amount');
        $data['method'] = $this->input->post('payment_method');
        $payment_method = $data['method'];

        switch ($payment_method) {
            case 'cash':
                $data['payment_method'] = 'Cash';
                break;
            case 'bank':
                $data['payment_method'] = 'Bank Transfer';
                $data['payment_ref'] = $this->input->post('payment_ref');
                break;
        }

        $data['type'] = 'Purchase';
        $sales_person = $this->ion_auth->user()->row();
        $data['received_by'] = $sales_person->first_name.' '.$sales_person->last_name;

        $path = UPLOAD_BILL;
        mkdir_if_not_exist($path);
        $file = upload_bill();


        if ($file) {
            $data['attachment'] = $file;
        }


        // Some required validation

        if ((int) $purchase_order->due_payment == 0)
        {
            $this->message->custom_error_msg('purchase/purchase_invoice/'.get_orderId($purchase_order->id), 'error');
        }
        else if ((float) $this->input->post('amount') > (float) $purchase_order->due_payment)
        {
            $this->message->custom_error_msg('purchase/purchase_invoice/'.get_orderId($purchase_order->id), 'error');
        }

        // Check account has the specified amount
        $account_id = $this->input->post('from_account');
        $account = $this->banks->Bank_model->get($account_id, true);
        if ($data['amount'] > $account->balance)
        {
            $this->message->custom_error_msg('purchase/purchase_invoice/'.get_orderId($purchase_order->id), lang('amount_greater_account_balance'));
        }


        $account_data = [];
        $account_data['account'] = $this->input->post('from_account');
        $account_data['amount'] = $data['amount'];
        $account_data['payee'] = $purchase_order->vendor_id;
        $account_data['payee_type'] = 'Vendor';
        $account_data['category'] = $this->input->post('category');
        $account_data['date'] = $data['payment_date'];
        $account_data['ref'] = $data['order_ref'];
        $account_data['description'] = $this->input->post('description');




        if ($id)
        {
            // update
            $payment =  $this->db->get_where('payment', array('id' => $id ))->row();

            $t_data['payment_method'] = '';
            $t_data['payment_ref'] = '';

            $this->db->where('id', $id);
            $this->db->update('payment', $t_data);

            $this->db->where('id', $id);
            $this->db->update('payment', $data);

            //update purchase order
            $p_data['paid_amount'] = $purchase_order->paid_amount + $data['amount'] - $payment->amount;
            $p_data['due_payment'] = $purchase_order->grand_total - $p_data['paid_amount'];
            $this->db->where('id', $purchase_order->id);
            $this->db->update('purchase_order', $p_data);


        }
        else
        {
            // insert
            //insert
            $this->db->insert('payment', $data);

            //update purchase order
            $p_data['paid_amount'] = $purchase_order->paid_amount + $data['amount'];
            $p_data['due_payment'] = $purchase_order->due_payment - $data['amount'];
            $this->db->where('id', $purchase_order->id);
            $this->db->update('purchase_order', $p_data);
            $this->save_account_purchase_expense($account_data);
        }


        redirect('purchase/purchase_invoice/'.get_orderId($purchase_order->id));

    }


    public function save_account_purchase_expense($data)
    {
        $this->load->module('banks');
        $this->load->module('transactions');
        $current_account = $this->banks->Bank_model->get($data['account'], true);
        if ($current_account)
        {
            $current_account_balance = $current_account->balance;
            $balance_after_expense = abs($current_account_balance - $data['amount']);
            $this->db->trans_start();
            $this->banks->Bank_model->save(array('balance' => $balance_after_expense), $current_account->id);
            $this->transactions->Transaction_model->save([
                'account_id' => $data['account'],
                'account' => $current_account->account,
                'type' => 'Expense',
                'payeeid' => $data['payee'],
                'amount' => $data['amount'],
                'category' => $data['category'],
                'date'  => $data['date'],
                'ref' => $data['ref'],
                'description' => $data['description'],
                'dr' => $data['amount'],
                'cr' => '0.00',
                'tax' => '0.00',
                'balance' => $balance_after_expense,
                'payee_type' => $data['payee_type'],
            ]);
            $this->db->trans_complete();
            if ($this->db->trans_status === false)
            {
                $_SESSION['error'] = 'Something error happen transaction try again';
                $this->session->mark_as_flash('error');
                redirect('purchase/purchase_list');
            }

            return;
        }

    }


    public function payment_list($id = null)
    {
        $id = $id - INVOICE_PRE;
        $data['payment'] = $this->db->get_where('payment', [
            'order_id' => $id,
            'type' => 'Purchase',
        ])->result();
        $data['modal_subview'] = $this->load->view('modal/payment_list', $data, false);
    }


    public function received_product($id = null)
    {
        $id = $id - INVOICE_PRE;
        $data['purchase_order'] = $this->db->get_where('purchase_order', ['id' => $id])->row();
        $data['purchase_product'] = $this->db->get_where('purchase_details', [
            'purchase_id' => $id,
            'type' => 'Purchase',
        ])->result();

        $this->load->view('modal/received_product', $data);
    }


    public function submit_received_product()
    {
        $receiver = $this->ion_auth->user()->row();
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $order_id = $this->input->post('order_id');
        
        $purchase_order = $this->db->get_where('purchase_order', ['id' => $order_id])->row();
        
        foreach ($id as $key => $item) 
        {
            if ($qty[$key] <= 0)
                continue;
            $purchase_product = $this->db->get_where('purchase_details', ['id' => $item])->row();
            
            $data = [];
            $data['order_id']       = $purchase_order->id;
            $data['vendor_id']      = $purchase_order->vendor_id;
            $data['vendor_name']    = $purchase_order->vendor_name;
            $data['product_id']     = $purchase_product->product_id;
            $data['product_name']   = $purchase_product->product_name;
            $data['qty']            = $qty[$key];
            $data['receiver']       = $receiver->first_name . ' ' . $receiver->last_name;
            
            // insert Received Product 
            $this->db->insert('received_product', $data);
            // update
            $total_received = $purchase_product->total_received + $qty[$key];
            $this->db->set('total_received', $total_received, false)->where('id', $item)->update('purchase_details');
            // update inventory 
            $product = $this->db->get_where('items', ['id' => $purchase_product->product_id])->row();
            $inventory_data = [];
            $inventory_data['inventory'] = $product->inventory + $qty[$key];
            $this->db->where('id', $purchase_product->product_id);
            $this->db->update('items', $inventory_data);
        }
        
        redirect('purchase/received_product_list');
    }


    public function received_product_list()
    {
        $this->load->library('Grocery_CRUD');
        $this->load->model('crud/Crud_model');

        $crud = new grocery_CRUD;
        $crud->columns('created_at','order_id','vendor_name','product_name','qty','receiver');
        $crud->order_by('id','desc');

        $crud->display_as('date', lang('date'));
        $crud->display_as('order_id',lang('purchase_no'));
        $crud->display_as('vendor_name',lang('supplier'));
        $crud->display_as('product_name',lang('product'));
        $crud->display_as('qty',lang('qty'));
        $crud->display_as('receiver',lang('received_by'));

        $crud->display_as('purchase_status',lang('status'));
        $crud->display_as('grand_total', lang('grand_total'));
        $crud->display_as('paid_amount', lang('paid'));
        $crud->display_as('due_payment', lang('balance'));
        $crud->display_as('actions', lang('actions'));


        $crud->set_table('received_product');

        $crud->callback_column('created_at',array($this->Crud_model,'_callback_action_created_at'));
        $crud->callback_column('order_id',array($this->Crud_model,'_callback_action_received_Product'));

        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_read();

        $this->data['crud'] = $crud->render();
        $this->data['title'] = lang('received_product');
        $this->admin_template('received_crud', $this->data);

    }

}