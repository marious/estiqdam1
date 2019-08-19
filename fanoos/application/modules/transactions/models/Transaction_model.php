<?php
class Transaction_model extends MY_Model
{
    protected $table_name = 'transactions';
    protected $timestamps = true;


    public $transaction_rules = [
        [
            'field' => 'from',
            'label' => 'lang:from',
            'rules' => 'trim|required|differs[to]',
        ],
        [
            'field' => 'to',
            'label' => 'lang:to',
            'rules' => 'trim|required|differs[from]',
        ],
        [
            'field' => 'date',
            'label' => 'lang:date',
            'rules' => 'trim|required|callback__valid_date',
        ],
        [
            'field' => 'amount',
            'label' => 'lang:amount',
            'rules' => 'trim|required|numeric',
        ],
        [
            'field' => 'description',
            'label' => 'lang:description',
            'rules' => 'trim|required',
        ]
    ];





    public function get_recent_transaction($type = '')
    {
        $query = "SELECT * FROM transactions WHERE type = ? ORDER BY id LIMIT 10";
        $result = $this->db->query($query, [$type]);
        if ($result->num_rows())
        {
            return $result->result();
        }
        return false;
    }



    public function get_all_transactions()
    {
        $this->load->library('datatable');
        $this->datatable->setQuery('SELECT * FROM transactions');

        if (isset($_POST['is_date_search']) && $_POST['is_date_search'] == 'yes')
        {
            $start_date = isset($_POST['start_date']) && !empty($_POST['start_date']) ? DateTime::createFromFormat('d/m/Y', $_POST['start_date'])->format('Y-m-d') . ' 23:59:59' : '';
            $end_date = isset($_POST['end_date']) && !empty($_POST['end_date']) ? DateTime::createFromFormat('d/m/Y', $_POST['end_date'])->format('Y-m-d') . ' 23:59:59' : '';
            $this->datatable->setDateRange($start_date, $end_date, 'date');
        }
        $searchStatus = isset($_POST['is_date_search']) && $_POST['is_date_search'] == 'yes' ? false : true;
        if (isset($_POST['type']) && !empty($_POST['type']))
        {
            $this->datatable->setSpecificValue($_POST['type'], 'type', $searchStatus);
        }
        $result = $this->datatable->getResult();

        $i = 1;
        $data = [];

        $this->load->module('banks');

        foreach ($result as $row)
        {

            $account = $this->banks->Bank_model->get($row->account_id);
            $sub_array = [];
            $sub_array[] = $i;
            $sub_array[] = date('d/m/Y', strtotime($row->date));
            $sub_array[] = $row->account;
            switch ($row->type) {
                case 'Income':
                    $sub_array[] = '<span class="label label-success">'.$row->type.'</span>';
                    break;
                case 'Transfer':
                    $sub_array[] = '<span class="label label-info">'.$row->type.'</span>';
                    break;
                case 'Expense':
                    $sub_array[] = '<span class="label label-warning">'.$row->type.'</span>';

                break;

            }
            $sub_array[] = $row->amount;
            $sub_array[] = $row->description;
            $sub_array[] = '<span class="dr">' . $row->dr . '</span>';
            $sub_array[] = '<span class="cr">' . $row->cr . '</span>';
            $sub_array[] = $row->balance;
            $sub_array[] = '';
            $data[] = $sub_array;
            $i++;
        }

        $count = $this->get_transactions_count();
        echo $this->datatable->output($data, $count);
    }


    public function get_transactions_count()
    {
        $query = "SELECT * FROM transactions";
        $q = $this->db->query($query);
        return $q->num_rows();
    }




    public function get_expense_rules()
    {
        return [
            [
                'field' => 'account',
                'label' => 'lang:account',
                'rules' => 'trim|required|callback__valid_account',
            ],
            [
                'field' => 'date',
                'label' => 'lang:date',
                'rules' => 'trim|required|callback__valid_date',
            ],
            [
                'field' => 'amount',
                'label' => 'lang:amount',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'description',
                'label' => 'lang:description',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'ref_number',
                'label' => 'lang:ref_number',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'category',
                'label' => 'lang:category',
                'rules' => 'trim',
            ],
            [
                'field' => 'payee',
                'label' => 'lang:payee',
                'rules' => 'trim',
            ],


        ];
    }


    public function get_deposite_rules()
    {
        return [
            [
                'field' => 'account',
                'label' => 'lang:account',
                'rules' => 'trim|required|callback__valid_account',
            ],
            [
                'field' => 'date',
                'label' => 'lang:date',
                'rules' => 'trim|required|callback__valid_date',
            ],
            [
                'field' => 'amount',
                'label' => 'lang:amount',
                'rules' => 'trim|required|numeric',
            ],
            [
                'field' => 'description',
                'label' => 'lang:description',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'ref_number',
                'label' => 'lang:ref_number',
                'rules' => 'trim|required',
            ],
            [
                'field' => 'category',
                'label' => 'lang:category',
                'rules' => 'trim',
            ],
            [
                'field' => 'payee',
                'label' => 'lang:payee',
                'rules' => 'trim',
            ],
        ];
    }

}