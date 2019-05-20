class CreateUser {
    constructor() {
        this.initObject();
        this.initRules();
        this.initValidator();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#create-user-form');
        this.$btn = $('#save-btn');
    }

    initRules() {
        jQuery.validator.addMethod('mobile', function(value, element) {
            let reg = /^1\d{10}$/;
            return this.optional(element) || reg.test(value);
        } , '请输入正确的手机号格式');

        jQuery.validator.addMethod('nickname', function (value, element) {
            let reg = /^[a-zA-Z0-9_]+$/i;
            return this.optional(element) || reg.test(value);
        }, '账号必须是英文字母、数字及下划线组成');
    }

    initValidator() {
        this.$form.validate({
            rules: {
                nickname: {
                    required: true,
                    nickname: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    mobile: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                nickname: {
                    required: '请输入账号'
                },
                email: {
                    required: '请输入邮箱',
                    email: '请输入正确格式的邮箱'
                },
                mobile: {
                    required: '请输入手机号'
                },
                password: {
                    required: '请输入密码',
                    minlength: '密码长度不能小于6位'
                },
                confirm_password: {
                    required: '请输入确认密码',
                    equalTo: '两次输入的确认密码不一致，请重新输入'
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
    }

}

new CreateUser();
