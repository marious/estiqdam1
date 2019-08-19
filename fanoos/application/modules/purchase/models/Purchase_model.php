<?php
class Purchase_model extends MY_Model
{
    public function purchase_due_invoice($id = null)
    {
        $query = $this->db->select('vendor_id, SUM(due_payment) AS due_payment')
                        ->from('purchase_order')
                        ->groub_by('vendor_id')
                        ->where('vendor_id', $id)
                        ->where('type', 'Purchase')
                        ->get()
                        ->row();

        return !empty($query) ? $query->due_payment : 0;
    }



    public function total_purchase_invoice_by_vendor($id = null)
    {
        $this->db->select('vendor_id, COUNT(id) AS total_invoice, SUM(grand_total) AS grand_total');
        $this->db->from('purchase_order');
        if ($id)
        {
            $this->db->group_by('vendor_id');
            $this->db->where('vendor_id', $id);
        }

        $this->db->where('type', 'Purchase');
        $query_result = $this->db->get();
        $query = $query_result->row();

        return !empty($query) ? (object) ['total_invoice' => $query->total_invoice, 'total_purchase' => $query->grand_total] :
            (object) ['total_invoice ' =>0, 'total_purchase' => 0];
     }



     public function total_purchase_due_by_vendor($id = null)
     {
         $this->db->select('vendor_id, COUNT(id) AS total_invoice, SUM(due_payment) AS due_payment');
         $this->db->from('purchase_order');
         if ($id)
         {
             $this->db->group_by('vendor_id');
             $this->db->where('vendor_id', $id);
         }

         $this->db->where('due_payment > ', 0);
         $this->db->where('type', 'Purchase');

         $query_result = $this->db->get();
         $query = $query_result->row();

         return !empty($query) ? (object) ['total_invoice' => $query->total_invoice, 'due_payment' => $query->due_payment] :
             (object) ['total_invoice' => 0, 'due_payment' => 0];
     }


     public function total_purchase_paid_by_vendor($id = null)
     {
         $this->db->select('vendor_id, SUM(paid_amount) AS paid_amount');
         $this->db->from('purchase_order');
         if ($id)
         {
             $this->db->group_by('vendor_id');
             $this->db->where('vendor_id', $id);
         }

         $this->db->where('type', 'Purchase');

         $query_result = $this->db->get();
         $query = $query_result->row();
         return !empty($query) ? (object) ['paid_amount' => $query->paid_amount] : (object) ['paid_amount' => 0];
     }



     public function total_return_purchase_by_vendor($id = null)
     {
         $this->db->select('vendor_id, COUNT(id) AS total_invoice, SUM(grand_total) AS grand_total');
         $this->db->from('purchase_order');
         if ($id)
         {
             $this->db->group_by('vendor_id');
             $this->db->where('vendor_id', $id);
         }

         $this->db->where('type', 'Return');
         $query_result = $this->db->get();
         $query = $query_result->row();

         return !empty($query) ? (object) ['total_invoice' => $query->total_invoice, 'grand_total' => $query->grand_total] :
                (Object) ['total_invoice' => 0, 'grand_total' => 0];
     }

}