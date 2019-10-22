Vue.component('modal', {
    template: `
            <transition name="modal">
                <div class="modal modal-mask" style="display: block;">
                   <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <slot name="head"></slot>
                            </div>
                            
                            <div class="modal-body">
                               <slot name="body"></slot>
                            </div>
                            
                            <div class="modal-footer">
                                <slot name="foot"></slot>
                            </div>
                            
                        </div>
                   </div>            
                </div>
            </transition>
    `,
});

var v2 = new Vue({
    el: '#taxes',
    data: {
        addModal: false,
        editModal: false,
        deleteModal: false,
        emptyResult: false,
        taxes: [],
        newTax: {
            name: '',
            rate: '',
            tax_authority: '',
        },
        chooseTax: {},
        formValidate: [],
    },
    created() {
      this.showAll();
    },
    methods: {
        showAll() {
            axios.get(root + 'taxes/all').then(function(response) {
                if (response.data.taxes && response.data.taxes.length) {
                    v2.emptyResult = false;
                    v2.taxes = response.data.taxes;
                } else {
                    v2.noResult();
                }
            });
        },

        addTax() {
            const formData = this.formData(this.newTax);
            axios.post(root + 'taxes/add', formData).then(function(response) {
                if (response.data.error) {
                    v2.formValidate = response.data.msg;
                } else {
                    v2.clearAll();
                    toastr['success'](response.data.msg);
                    v2.showAll();
                }
            });
        },

        updateTax() {
            var formData = v2.formData(v2.chooseTax);
            axios.post(root + 'taxes/update', formData).then(function (response) {
                if (response.data.error) {
                    v2.formValidate = response.data.msg;
                } else {
                    toastr['success'](response.data.msg);
                    v2.clearAll();
                    v2.showAll();
                }
            })
        },

        deleteTax() {
          var formData = v2.formData(v2.chooseTax);
          axios.post(root + 'taxes/delete', formData)
              .then(function(response) {
                  if (response.data.errror) {
                      v2.formValidate = response.data.msg;
                  } else {
                      toastr['success'](response.data.msg);
                      v2.clearAll();
                      v2.showAll();
                  }
              });
        },

        selectTax(tax) {
            v2.chooseTax = tax;
        },

        formData(obj) {
            var formData = new FormData();
            for (var key in obj) {
                formData.append(key, obj[key]);
            }
            return formData;
        },

        noResult() {
            this.emptyResult = true;
            this.taxes = [];
        },

        clearAll() {
          v2.newTax = {
              name: '',
              rate: '',
              tax_authority: '',
          };
          v2.formValidate = false;
          v2.addModal = false;
          v2.editModal = false;
          v2.deleteModal = false;
        },


        closeModal() {
          this.addModal = false;
          this.editModal = false;
          this.deleteModal = false;
          this.formValidate = false;
          this.newTax = {
              name: '',
              rate: '',
              tax_authority: '',
          };
          this.chooseTax = {
              name: '',
              rate: '',
              tax_authority: '',
          };
        },

    }

});