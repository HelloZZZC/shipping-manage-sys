class SystemSetting
{
    constructor() {
        this.initObject();
        this.initValidator();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#system-setting-form');
        this.$btn = $('#submit-btn');
    }

    initValidator() {
        this.$form.validate({
            rules: {
                exchange_rate: {
                    required: true,
                    min: 0
                },
                commission: {
                    required: true,
                    min: 0
                },
                e_mail_discount: {
                    required: true,
                    min: 0
                },
                china_post_discount: {
                    required: true,
                    min: 0
                },
                ali_standard_discount: {
                    required: true,
                    min: 0
                }
            },
            messages: {
                exchange_rate: {
                    required: '请输入汇率',
                    min: '汇率的值不能小于0'
                },
                commission: {
                    required: '请输入佣金',
                    min: '佣金的值不能小于0'
                },
                e_mail_discount: {
                    required: '请输入E邮宝物流折扣',
                    min: 'E邮宝物流折扣的值不能小于0'
                },
                china_post_discount: {
                    required: '请输入挂号小包物流折扣',
                    min: '挂号小包物流折扣的值不能小于0'
                },
                ali_standard_discount: {
                    required: '请输入无忧标准物流折扣',
                    min: '无忧标准物流折扣的值不能小于0'
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
        this.$btn.click(() => function () {
            if (this.$form.valid()) {
                this.$form.submit();
            }
        })
    }
}

new SystemSetting();
