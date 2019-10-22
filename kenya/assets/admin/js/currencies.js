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

var v = new Vue({
    el: '#currencies',
    data: {
        addModal: false,
        editModal: false,
        deleteModal: false,
        emptyResult: false,
        currencies: [],
        newCurrency: {
            code: '',
            symbol: '',
        },
        chooseCurrency: {},
        formValidate: [],
    },
    created() {
      this.showAll();
    },
    methods: {
        showAll() {
            axios.get(root + 'currencies/all').then(function(response) {
                if (response.data.currencies && response.data.currencies.length) {
                    v.emptyResult = false;
                    v.currencies = response.data.currencies;
                } else {
                    v.noResult();
                }
            });
        },

        addCurrency() {
            const formData = this.formData(this.newCurrency);
            axios.post(root + 'currencies/add', formData).then(function(response) {
                if (response.data.error) {
                    v.formValidate = response.data.msg;
                } else {
                    v.clearAll();
                    toastr['success'](response.data.msg);
                    v.showAll();
                }
            });
        },

        updateCurrency() {
            var formData = v.formData(v.chooseCurrency);
            axios.post(root + 'currencies/update', formData).then(function (response) {
                if (response.data.error) {
                    v.formValidate = response.data.msg;
                } else {
                    toastr['success'](response.data.msg);
                    v.clearAll();
                    v.showAll();
                }
            })
        },

        deleteCurrency() {
          var formData = v.formData(v.chooseCurrency);
          axios.post(root + 'currencies/delete', formData)
              .then(function(response) {
                  if (response.data.errror) {
                      v.formValidate = response.data.msg;
                  } else {
                      toastr['success'](response.data.msg);
                      v.clearAll();
                      v.showAll();
                  }
              });
        },

        selectCurrency(currency) {
            v.chooseCurrency = currency;
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
            this.currencies = [];
        },

        clearAll() {
          v.newCurrency = {
              code: '',
              symbol: '',
          };
          v.formValidate = false;
          v.addModal = false;
          v.editModal = false;
          v.deleteModal = false;
        },


        closeModal() {
          this.addModal = false;
          this.editModal = false;
          this.deleteModal = false;
          this.formValidate = false;
          this.newCurrency = {
              code: '',
              symbol: '',
          };
          this.chooseCurrency = {
              code: '',
              symbol: '',
          };
        },

    }

});