<div id="taxes">

    <div class="panel panel-default">
        <div class="panel-body">
            <a href="#" class="btn btn-primary" id="add_tax" @click="addModal = true"><i class="fa fa-plus"></i> <?= lang('new_tax'); ?></a>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover primary-table">
            <thead>
            <tr>
                <th><?= lang('name') ?></th>
                <th><?= lang('rate'); ?></th>
                <th><?= lang('tax_authority'); ?></th>
                <th><?= lang('manage'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="tax in taxes">
                <td>{{ tax.name }}</td>
                <td>{{ tax.rate }}</td>
                <td>{{ tax.tax_authority }}</td>
                <td>
                    <button class="btn btn-sm btn-primary" title="Edit" @click="editModal = true; selectTax(tax)"><i class="fa fa-edit"></i></button>
                    &nbsp;&nbsp;
                    <button class="btn btn-sm btn-danger" title="Delete" @click="deleteModal = true; selectTax(tax)">
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
        <h3 slot="head"><?= lang('add_tax'); ?></h3>
        <div slot="body" class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name"><?= lang('name') ?></label>
                    <input type="text" class="form-control" id="name" name="name" v-model="newTax.name" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.name"></div>
                </div>
                <div class="form-group">
                    <label for="rate"><?= lang('rate') ?></label>
                    <input type="number" class="form-control" id="rate" name="rate" v-model="newTax.rate" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.rate"></div>
                </div>
                <div class="form-group">
                    <label for="tax_authority"><?= lang('tax_authority') ?></label>
                    <input type="text" class="form-control" id="tax_authority" name="tax_authority" v-model="newTax.tax_authority" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.tax_authority"></div>
                </div>
            </div>
        </div>
        <div slot="foot">
            <button class="btn btn-success btn-lg" @click="addTax"><?= lang('save'); ?></button>
            <button class="btn btn-danger btn-lg" @click="closeModal"><?= lang('cancel'); ?></button>
        </div>
    </modal>


    <modal v-if="editModal">
        <h3 slot="head"><?= lang('update_tax'); ?></h3>
        <div slot="body" class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name"><?= lang('name') ?></label>
                    <input type="text" class="form-control" id="name" name="name" v-model="chooseTax.name" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.name"></div>
                </div>
                <div class="form-group">
                    <label for="rate"><?= lang('rate') ?></label>
                    <input type="number" class="form-control" id="rate" name="rate" v-model="chooseTax.rate" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.rate"></div>
                </div>
                <div class="form-group">
                    <label for="tax_authority"><?= lang('tax_authority') ?></label>
                    <input type="text" class="form-control" id="tax_authority" name="tax_authority" v-model="chooseTax.tax_authority" autocomplete="off">
                    <div class="text-danger" v-html="formValidate.tax_authority"></div>
                </div>
            </div>
        </div>
        <div slot="foot">
            <button class="btn btn-success btn-lg" @click="updateTax"><?= lang('save'); ?></button>
            <button class="btn btn-default btn-lg" @click="closeModal"><?= lang('cancel'); ?></button>
        </div>
    </modal>


    <!--  Delete Modal  -->
    <modal v-if="deleteModal" @close="clearAll()">
        <h3 slot="head"><?= lang('delete') ?></h3>
        <div slot="body" class="text-center"><?= lang('delete_record') ?></div>
        <div slot="foot">
            <button class="btn btn-danger" @click="deleteModal = false; deleteTax()" >Delete</button>
            <button class="btn" @click="deleteModal = false">Cancel</button>
        </div>
    </modal>

</div>