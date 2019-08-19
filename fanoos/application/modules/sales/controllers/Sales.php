<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends MY_Controller
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



    public function all_invoices()
    {
        $this->load_daterange_datepicker();
        $this->load_js_validation();

        $this->load->model('crud/Crud_model');

        $this->load->library('Grocery_CRUD');
        $crud = new Grocery_CRUD();

        $crud->columns('date', 'id', 'customer_name', 'grand_total', 'amount_received', 'due_payment', 'actions');
        $crud->order_by('id','desc');
        $crud->where('type','Invoice');
        $crud->order_by('id','desc');

        $crud->display_as('date', lang('date'));
        $crud->display_as('id', lang('order_no'));
        $crud->display_as('customer_name', lang('customer'));
        $crud->display_as('due_date', lang('due_date'));
        $crud->display_as('grand_total', lang('grand_total'));
        $crud->display_as('due_payment', lang('balance'));
        $crud->display_as('amount_received', lang('paid'));
        $crud->display_as('actions', lang('actions'));

        $crud->set_table('invoices');

        $crud->callback_column('date',array($this->Crud_model,'_callback_action_date'));
        $crud->callback_column('id',array($this->Crud_model,'_callback_action_orderNo'));
        $crud->callback_column('due_date',array($this->Crud_model,'_callback_action_dueDate'));
        $crud->callback_column('due_payment',array($this->Crud_model,'_callback_action_due_payment'));
        $crud->callback_column('grand_total',array($this->Crud_model,'_callback_action_grand_total'));
        $crud->callback_column('actions',array($this->Crud_model,'_callback_action_all_order'));

        $crud->unset_add();
        $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_read();

        $this->data['crud'] = $crud->render();

        $this->admin_template('sales_list', $this->data);

    }


    /**
     * Create a new invoice
     */
    public function invoice()
    {
        $this->load_daterange_datepicker();
        $this->load_js_validation();
        array_push($this->data['js_file'], site_url('assets/admin/js/invoices.js'));
        $this->load->module('items');
        $this->data['form'] = $this->form_builder->create_form('sales/save_invoice', true, ['id' => 'from-invoice']);

        $categories = $this->db->order_by('category', 'desc')->get('product_category')->result();
//        $this->data['products'] = $this->items->Item_model->get();
        $products = [];
        if (is_array($categories) && count($categories))
        {
            foreach ($categories as $category) {
                $product = $this->db->order_by('name', 'asc')->get_where('items', [
                    'category_id' => $category->id,
                ])->result();
                if (!count($product)) {
                    continue;
                }
                $products[$category->category] = $product;
            }
        }

        $this->data['products'] = $products;


        $this->_discount_session();
        $this->admin_template('create_invoice', $this->data);
    }


    public function add_to_cart()
    {
        $id = $this->input->post('product_id');
        $this->load->module('items');
        $product = $this->items->Item_model->get($id);

        if (!empty($this->input->post('rowid')))
        {
            $data = [
                'rowid' => $this->input->post('rowid'),
                'qty'   => 0,
            ];
            $this->cart->update($data);
        }

        if ($product)
        {
            // Product tax check
            $tax = $this->product_tax_calculate($product->tax, $qty = 1, $product->sales_price);
            $data = [
                'id'            => $product->id,
                'qty'           => 1,
                'price'         => $product->sales_price,
                'purchase_cost' => $product->purchase_cost,
                'name'          => $product->name,
                'description'   => $product->description,
                'tax'           => $tax,
                'type'          => FALSE,
                'bundle'        => '',
            ];
            $this->cart->insert($data);
        }
    }



    public function update_cart_item()
    {
        $type = $this->input->post('type');

        // Product Tax Check
        $this->load->module('items');
        $product = $this->items->Item_model->get($this->input->post('p_id'));
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $tax = $this->product_tax_calculate($product->tax, $qty, $price);

        if ($type == 'qty')
        {
            $data = [
                'rowid' => $this->input->post('rowid'),
                'qty' => (int)$this->input->post('o_val'),
                'tax' => $tax,
            ];
        }
        else if ($type == 'prc')
        {
            $data = [
                'rowid' => $this->input->post('rowid'),
                'price' => (float) $this->input->post('o_val'),
                'tax'   => $tax,

            ];
        }
        else if ($type == 'des')
        {
            $data = [
                'rowid' => $this->input->post('rowid'),
                'description' => $this->input->post('o_val'),
            ];
        }

        $this->cart->update($data);

    }

    public function show_cart()
    {
        $products = [];
        $categories = $this->db->order_by('category', 'desc')->get('product_category')->result();

        if (is_array($categories) && count($categories))
        {
            foreach ($categories as $category) {
                $product = $this->db->order_by('name', 'asc')->get_where('items', [
                    'category_id' => $category->id,
                ])->result();
                if (!count($product)) {
                    continue;
                }
                $products[$category->category] = $product;
            }
        }

        $data['products'] = $products;

        $this->load->view('add_product_cart', $data);
    }


    public function remove_item()
    {
        $data = [
            'rowid' => $this->input->post('rowid'),
            'qty'   => 0,
        ];
        $this->cart->update($data);
    }



    /* Product Tax Calculation */
    protected function product_tax_calculate($tax, $qty, $sales_price)
    {
        $tax_arr = unserialize($tax);
        $this->load->module('taxes');
        $taxes = $this->taxes->Tax_model->where_in('id', $tax_arr);
        if (is_array($taxes) && count($taxes))
        {
            $taxRate = 0;
            foreach ($taxes as $tax) {
                $taxRate += $tax->rate;
            }
            $subtotal = $sales_price * $qty;
            return ($taxRate * $subtotal) / 100;
        }

        return 0;
    }


    public function _discount_session()
    {
        $_SESSION['discount'] = 0;
    }




    public function save_invoice()
    {
        if (empty($this->cart->contents()))
        {
            $this->message->custom_error_msg('test', 'hi');
        }

        // Check the qty of product needed is in our inventory
        foreach ($this->cart->contents() as $item) {
            $o_details['product_id']        = $item['id'];
            $o_details['qty']               = $item['qty'];

            $product = $this->db->get_where('items', ['id' => $o_details['product_id']])->row();
            if ($product->type == 'Inventory')
            {
                if ($product->inventory < $o_details['qty'])
                {
                    $this->message->custom_error_msg('sales/invoice', lang('qty_is_greater_than_inventory'));
                }
            }

        }

        $this->load->library('encryption');

//        $order_id = $this->input->post('order_id') ? $this->encryption->encrypt($this->input->post('order_id')) : '';
        $order_id = $this->input->post('order_id') ? $this->input->post('order_id') : '';
        $sales_person = $this->ion_auth->user()->row();

        $data['invoice_date'] = DateTime::createFromFormat(setting('date_format'), $this->input->post('invoice_date'))->format('Y-m-d');
        $data['due_date'] = DateTime::createFromFormat(setting('date_format'), $this->input->post('due_date'))->format('Y-m-d');
        $data['cart_total'] = $this->cart->total();
        $total_tax = 0.00;
        foreach ($this->cart->contents() as $item) {
            $total_tax += $item['tax'];
        }

        $data['tax'] = $total_tax;
        $gtotal = $this->cart->total();
        $discount = $_SESSION['discount'];
        $discount_amount = ($gtotal * $discount)/100;
        $data['grand_total'] = $this->cart->total() + $total_tax - $discount_amount;
        $data['cart'] = json_encode($this->cart->contents());
//        $data['type']           = ucwords($this->session->userdata('type'));
        if ($order_id != '')
        {
            $data['status'] = 'Open';
            $data['sales_person'] = $sales_person->first_name . ' ' . $sales_person->last_name;
            $data['due_payment'] = $data['grand_total'];
        }
        else
        {
            $data['customer_id'] = $this->input->post('customer_id');
            $data['customer_name'] = $this->db->get_where('customers', ['id' => $data['customer_id']])->row()->title;
            $data['sales_person'] = $sales_person->first_name . ' ' . $sales_person->last_name;
//            $data['type']           = str_replace("_"," ",$this->input->post('type'));
            $data['discount'] = (float) $_SESSION['discount'];
            $data['amount_received'] = (float) $this->input->post('amount_received');
            $data['due_payment'] = $data['grand_total'] - $data['amount_received'];

            if ($data['due_payment'] <= 0) {
                $data['status'] = 'Close';
            } else {
                $data['status'] = 'Open';
            }
        }


        //check first time booking made or update
        date_default_timezone_set(setting('timezone'));
        $history[] = array(
            'sales' => array(
                'sales_person'      => $data['sales_person'],
                'date'              => date("F j, Y, H:i:s")
            ),
            'list' => array(
                'status'            =>  'Order Created',
                'activities'        => $this->input->post('order_activities'),
                'amount_received'   => $this->input->post('amount_received'),
                'payment_method'    => $this->input->post('payment_method'),
                'p_reference'       => $this->input->post('p_reference'),
            )
        );
        $data['history'] = json_encode($history);

        if (empty($order_id)) {
            $this->db->insert('invoices', $data);
            $order_id = $this->db->insert_id();
        } else {
            // update
            $this->db->where('id', $order_id);
            $this->db->update('invoices', $data);
        }

        $o_details['order_id'] = $order_id;
        foreach ($this->cart->contents() as $item) {
            $o_details['product_id']        = $item['id'];
            $o_details['product_name']      = $item['name'];
            $o_details['purchase_cost']     = $item['purchase_cost'];
            $o_details['sales_cost']        = $item['price'];
            $o_details['qty']               = $item['qty'];
            $o_details['tax_amount']        = $item['tax'];
            $o_details['description']       = $item['description'];

            //save order details
            $this->db->insert('order_details', $o_details);

            //TODO: track this product in inventory
            $p_details = $this->db->get_where('items', ['id' => $item['id']])->row();
            if ($p_details->type == 'Inventory')
            {
                $p_qty['inventory'] = $p_details->inventory - $item['qty'];
                $this->db->where('id', $item['id']);
                $this->db->update('items', $p_qty);
            }
        }

        redirect('sales/sale_preview/'.get_orderId($order_id));

    }




    public function sale_preview($id = null)
    {
        $this->load_daterange_datepicker();
        $this->load_js_validation();
        array_push($this->data['js_file'], site_url('assets/admin/js/invoices.js'));

        $id = $id - INVOICE_PRE;
        $this->data['order'] = $this->db->get_where('invoices', ['id' => $id])->row();
        if (!$this->data['order']) {
            redirect('/', 'refresh');
        }

        $this->data['type'] = $this->data['order']->type;

        if ($this->data['type'] == 'Quotation')
        {

        }
        else
        {
            $this->data['order_details'] = $this->db->get_where('order_details', ['order_id' => $id])->result();
        }


        $this->data['payment'] = $this->db->get_where('payment', [
            'order_id' => $id,
            'type' => 'Sales',
        ])->result();

        // Customer
        $this->data['customer'] = $this->db->get_where('customers', [
            'id' => $this->data['order']->customer_id,
        ])->row();

        $this->admin_template('sales_preview', $this->data);
    }



    public function add_payment($id = null)
    {
        $id = $id - INVOICE_PRE;
        $data['order'] = $this->db->get_where('invoices', ['id' => $id])->row();

        $this->load->module('banks');
        $data['accounts'] = $this->banks->Bank_model->get();
        $data['categories'] = $this->db->get_where('categories', ['type' => 'Income'])->result();


        $data['modal_subview'] = $this->load->view('modal/_add_payment', $data, false);
//        $this->load->view();
    }

    public function received_payment()
    {
        $id = $this->input->post('payment_id');
        $data['order_id'] = $this->input->post('order_id');
        $order = $this->db->get_where('invoices', ['id' => $data['order_id']])->row();

        if ((int) $order->due_payment == 0)
        {
            $this->message->custom_error_msg('sales/sale_preview/'.get_orderId($order->id), 'error');
        }
        else if ((float) $this->input->post('amount') > (float) $order->due_payment)
        {
            $this->message->custom_error_msg('sales/sale_preview/'.get_orderId($order->id), 'error');
        }

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

        $data['type'] = 'Sales';
        $sales_person = $this->ion_auth->user()->row();
        $data['received_by'] = $sales_person->first_name.' '.$sales_person->last_name;

        $path = UPLOAD_BILL;
        mkdir_if_not_exist($path);
        $file = upload_bill();
        if ($file) {
            $data['attachment'] = $file;
        }


        $account_data = [];
        $account_data['account'] = $this->input->post('to_account');
        $account_data['amount'] = $data['amount'];
        $account_data['category'] = $this->input->post('category');
        $account_data['date'] = $data['payment_date'];
        $account_data['ref'] = $data['order_ref'];
        $account_data['payer'] = $order->customer_id;
        $account_data['description'] = $this->input->post('description');

        if ($id)
        {
            // update
            $payment = $this->db->get_where('payment', ['id' => $id])->row();

            //trancate Payment
            $t_data['payment_method'] = '';
            $t_data['payment_ref'] = '';

            $this->db->where('id', $id);
            $this->db->update('payment', $t_data);

            //update payment table
            $this->db->where('id', $id);
            $this->db->update('payment', $data);

            //update purchase order
            $p_data['amount_received'] = $order->amount_received + $data['amount'] - $payment->amount;
            $p_data['due_payment'] = $order->grand_total - $p_data['amount_received'];
            $this->db->where('id', $order->id);
            $this->db->update('sales_order', $p_data);
        }
        else
        {
            // insert

            $this->db->insert('payment', $data);

            // Update purchase order
            $p_data['amount_received'] = $order->amount_received + $data['amount'];
            $p_data['due_payment'] = $order->due_payment - $data['amount'];

            $this->db->where('id', $order->id);
            $this->db->update('invoices', $p_data);
            $this->save_income_sale_to_account($account_data);

        }

        redirect('sales/sale_preview/'.get_orderId($order->id));

    }



    public function save_income_sale_to_account($data)
    {
        $this->load->module('banks');
        $this->load->module('transactions');
        $current_account = $this->banks->Bank_model->get($data['account'], true);
        if ($current_account)
        {
            $balance_after_deposite = $current_account->balance + $data['amount'];
            $this->db->trans_start();
            $this->Bank_model->save(['balance' => $balance_after_deposite], $current_account->id);
            $this->Transaction_model->save([
                'account_id'    => $data['account'],
                'account'       => $current_account->account,
                'type'          => 'Income',
                'amount'        => $data['amount'],
                'date'          => $data['date'],
                'description'   => $data['description'],
                'ref'           => $data['ref'],
                'dr'            => '0.00',
                'cr'            => $data['amount'],
                'tax'           => '0.00',
                'category'      => $data['category'],
                'payerid'       => $data['payer'],
                'balance'       => $balance_after_deposite,

            ]);
            $this->db->trans_complete();
            if ($this->db->trans_status === false)
            {
                $_SESSION['error'] = 'Something error happen transaction try again';
                $this->session->mark_as_flash('error');
                redirect('sales/all_invoices');
            }

            return;


        }
    }


}