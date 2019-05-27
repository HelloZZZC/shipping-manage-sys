import { notify } from "../../common/notify";

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
                $.post(this.$form.attr('action'), this.$form.serialize(), (response) => {
                    if (!response.code) {
                        notify('success', '用户新密码保存成功过');
                        setTimeout("window.location.reload();",1000);
                    } else {
                        notify('danger', '新密码保存失败，请联系网站管理员');
                    }
                });
            }
        });
    }
}

new ChangePassword();
