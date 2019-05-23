class ChangePassword
{
    constructor() {
        this.initObject();
        this.initValidator();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#password-change-form');
        this.$btn = $('#submit-btn');
    }

    initValidator() {
        this.$form.validate({
            rules: {
                old_password: {
                    required: true,
                    remote: {
                        url: $('#old_password').data('url'),
                        type: 'get'
                    }
                },
                new_password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                old_password: {
                    required: '请输入你的当前密码',
                    remote: '输入的密码于你当前密码不匹配'
                },
                new_password: {
                    required: '请输入你的旧密码',
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

new ChangePassword();
