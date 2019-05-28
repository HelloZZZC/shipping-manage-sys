class Shipping
{
    constructor() {
        this.initObject();
        this.initValidator();
        this.initEvent();
        this.fixTableColumn();
    }

    initObject() {
        this.$form = $('#price-calculate-form');
        this.$radio = $('[ name = "calc_mode"]');
        this.$priceInput = $('[ name = "price"]');
        this.$fixedGrossMarginInput = $('[ name = "fixed_gross_margin"]');
        this.$btn = $('#search-btn');
        this.$table = $('.table');
    }

    initValidator() {
        this.$form.validate({
            rules: {
                price_basis_type: "required",
                discount_rate: "required",
                weight: "required",
                profit: "required",
                fixed_gross_margin: "required"
            },
            messages: {
                price_basis_type: {
                    required: '请选择重量范围'
                },
                discount_rate: {
                    required: '请输入平台折扣率'
                },
                weight: {
                    required: '请输入重量'
                },
                profit: {
                    required: '请输入产品成本'
                },
                fixed_gross_margin: {
                    required: '请输入固定毛利率'
                }
            },
            errorClass: 'invalid-tooltip',
            errorElement: 'span',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
    }

    initEvent() {
        this.$btn.click(() => {
            if (this.$form.valid()) {
                this.$form.submit();
            }
        });

        this.$radio.click(() => {
            let mode = $('[ name = "calc_mode"]:checked').val();
            if (mode === 'fixed_gross_margin') {
                this.$priceInput.val('').attr("disabled", true);
                this.$fixedGrossMarginInput.attr("disabled", false);
                this.$fixedGrossMarginInput.rules('add', {required:true,messages:{required:'请输入固定毛利率'}});
                this.$priceInput.rules('remove', 'required');
            } else {
                this.$priceInput.attr("disabled", false);
                this.$fixedGrossMarginInput.val('').attr("disabled", true);
                this.$priceInput.rules('add', {required:true,messages:{required:'请输入售价'}});
                this.$fixedGrossMarginInput.rules('remove', 'required');
            }
            this.$form.valid();
        });
    }

    fixTableColumn() {
        this.$table.bootstrapTable('destroy').bootstrapTable({
            fixedColumns: true,
            fixedNumber: 1
        });
    }
}

new Shipping();
