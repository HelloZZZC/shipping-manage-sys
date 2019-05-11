class Login
{
    constructor() {
        this.initObject();
        this.initValidator();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#login-form');
        this.$btn = $('#login-btn');
    }

    /**
     * 约定所有的错误提示class均为invalid-tooltip保持整个系统样式统一
     */
    initValidator() {
        this.$form.validate({
            rules: {
                nickname: "required",
                password: "required"
            },
            messages: {
                nickname: '请输入账号',
                password: '请输入密码'
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

new Login();
