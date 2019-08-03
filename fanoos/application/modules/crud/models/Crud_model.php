<?php
class Crud_model extends MY_Model
{
    function test() {
        echo 'hello';exit;
    }

    function _callback_action_date($value, $row){
        return $this->localization->dateFormat($row->date);
    }

    function _callback_action_date_time($value, $row){
        return $this->localization->dateFormat($row->date_time);
    }

    function _callback_action_dueDate($value, $row){
        return $this->localization->dateFormat($row->due_date);
    }

    function _callback_action_due_payment($value, $row){
        $val = $this->localization->currencyFormat($row->due_payment);
        return '<span style="color: red"><strong>'.$val.'</strong></span>';
    }


    function _callback_action_grand_total($value, $row){
        $val = $this->localization->currencyFormat($row->grand_total);
        return '<span style="color: green"><strong>'.$val.'</strong></span>';
    }

    function _callback_action_orderNo($value, $row){
        //return INVOICE_PRE+$row->id;
        return '<a href="'. base_url().'sales/sale_preview/'.get_orderID($row->id).'"><strong>'.get_orderID($row->id).'</strong></a>';
    }



    function _callback_action_all_order($value, $row){

        $orderId = strip_tags($row->id);
        if($row->type == 'Quotation'){
            return '
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                 '. lang('actions').'                                    <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                                <li> <a href="sales/sale_preview/' . $orderId . '"><i class="fa fa-eye text-success"></i>'. lang('view').'</a> </li>
                                <li> <a href="sales/updateSales/' .$orderId . '"><i class="fa fa-shopping-cart text-success"></i>'. lang('edit').'</a></li>
                                <li> <a href="sales/createPdfInvoice/' . $orderId . '"><i class="fa fa-file-pdf-o text-success"></i>'. lang('pdf_quotation').'</a> </li>
                                <li> <a href="sales/sendInvoice/' . $orderId . '" data-target="#modalSmall" data-toggle="modal"><i class="fa fa-envelope-o text-success" ></i>'. lang('email_quotation').'</a> </li>
                                
                                <li>  <a  data-target="#modalSmall" data-toggle="modal" href="sales/cancelQuotation/' . $orderId . '">
                                        <i class="fa fa-times-circle-o text-danger"></i>'. lang('cancel_quotation').' </a> </li>
                                <li><a onclick="return confirm(\'Are you sure want to delete this Invoice ?\');" href="sales/deleteInvoice/' . $orderId . '"><i class="fa fa-trash-o text-danger"></i>'. lang('delete').'</a> </li>
                            </ul>
                        </div>
                    ';
        }else{
            return '
                        <div class="btn-group dropdown">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                '. lang('actions').'                                  <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right">
                              
                                <li> <a href="sale_preview/' . $orderId . '"><i class="fa fa-eye text-success"></i>'. lang('view').'</a> </li>
                                <li> <a href="updateSales/' . $orderId . '"><i class="fa fa-shopping-cart text-success"></i>'. lang('edit').'</a></li>
                                <li> <a href="add_payment/' . $orderId . '" data-target="#modalSmall" data-toggle="modal"><i class="fa fa-money text-success"></i>'. lang('add_payment').'</a> </li>
                                <li> <a href="paymentList/' . $orderId . '" data-target="#myModal" data-toggle="modal"><i class="fa fa-money text-success"></i>'. lang('view_payment').'</a> </li>
                                <li> <a href="sales/createPdfInvoice/' . $orderId . '"><i class="fa fa-file-pdf-o text-success"></i>'. lang('pdf_invoice').'</a> </li>
                                <li> <a href="sales/sendInvoice/' . $orderId . '" data-target="#modalSmall" data-toggle="modal"><i class="fa fa-envelope-o text-success" ></i>'. lang('email_invoice').'</a> </li>
                                <li>  <a  data-target="#modalSmall" data-toggle="modal" href="sales/cancelSales/' . $orderId . '">
                                        <i class="fa fa-times-circle-o text-danger"></i> '. lang('cancel_order').' </a> </li>
                                <li><a onclick="return confirm(\'Are you sure want to delete this Invoice ?\');" href="sales/deleteInvoice/' . $orderId . '"><i class="fa fa-trash-o text-danger"></i>'. lang('delete').'</a> </li>
                            </ul>
                        </div>
                    ';
        }
    }



    function _callback_action_order_status($value, $row)
    {
        if($row->status === 'Cancel'){
            return '<span class="label bg-red">'. lang('cancel_order').'</span>';
        }elseif ($row->delivery_status === 'Processing Order'){
            return '<span class="label bg-aqua-active">'. lang('processing_order').'</span>';
        }elseif ($row->delivery_status === 'Awaiting Delivery'){
            return '<span class="label bg-orange">'. lang('awaiting_delivery').'</span>';
        }elseif ($row->delivery_status === 'Done'){
            return '<span class="label bg-olive-active">'. lang('delivery_done').'</span>';
        }
    }

}