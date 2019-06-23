<div id="currencies">

    <div class="panel panel-default">
        <div class="panel-body">
            <a href="#" class="btn btn-primary" id="add_currency" @click="addModal = true"><i class="fa fa-plus"></i> <?= lang('new_currency'); ?></a>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover primary-table">
            <thead>
            <tr>
                <th><?= lang('currency_code') ?></th>
                <th><?= lang('currency_symbol'); ?></th>
                <th><?= lang('manage'); ?></th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="currency in currencies">
                    <td>{{ currency.code }}</td>
                    <td>{{ currency.symbol }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" title="Edit" @click="editModal = true; selectCurrency(currency)"><i class="fa fa-edit"></i></button>
                        &nbsp;&nbsp;
                        <button class="btn btn-sm btn-danger" title="Delete" @click="deleteModal = true; selectCurrency(currency)">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                </tr>
                <tr v-if="emptyResult">
                    <td colspan="4" rowspan="4" class="text-center h1">No Record Found</td>
                </tr>
            </tbody>
        </table>
    </div>


    <modal v-if="addModal">
        <h3 slot="head"><?= lang('add_currency'); ?></h3>
        <div slot="body" class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="currency_code"><?= lang('currency_symbol') ?></label>
                    <input type="text" class="form-control" id="currency_code" name="code" v-model="newCurrency.code" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.code"></div>
                </div>
                <div class="form-group">
                    <label for="currency_symbol"><?= lang('currency_code') ?></label>
                    <input type="text" class="form-control" id="currency_symbol" name="symbol" v-model="newCurrency.symbol" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.symbol"></div>
                </div>
            </div>
        </div>
        <div slot="foot">
            <button class="btn btn-success btn-lg" @click="addCurrency"><?= lang('save'); ?></button>
            <button class="btn btn-danger btn-lg" @click="closeModal"><?= lang('cancel'); ?></button>
        </div>
    </modal>


    <modal v-if="editModal">
        <h3 slot="head"><?= lang('update_currency'); ?></h3>
        <div slot="body" class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="currency_code"><?= lang('currency_symbol') ?></label>
                    <input type="text" class="form-control" id="currency_code" name="code" v-model="chooseCurrency.code" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.code"></div>
                </div>
                <div class="form-group">
                    <label for="currency_symbol"><?= lang('currency_code') ?></label>
                    <input type="text" class="form-control" id="currency_symbol" name="symbol" v-model="chooseCurrency.symbol" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.symbol"></div>
                </div>
            </div>
        </div>
        <div slot="foot">
            <button class="btn btn-success btn-lg" @click="updateCurrency"><?= lang('save'); ?></button>
            <button class="btn btn-default btn-lg" @click="closeModal"><?= lang('cancel'); ?></button>
        </div>
    </modal>


    <!--  Delete Modal  -->
    <modal v-if="deleteModal" @close="clearAll()">
        <h3 slot="head"><?= lang('delete') ?></h3>
        <div slot="body" class="text-center"><?= lang('delete_record') ?></div>
        <div slot="foot">
            <button class="btn btn-danger" @click="deleteModal = false; deleteCurrency()" >Delete</button>
            <button class="btn" @click="deleteModal = false">Cancel</button>
        </div>
    </modal>

</div>