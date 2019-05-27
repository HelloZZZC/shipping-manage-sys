import {notify} from "../../common/notify";

class ChangeRole
{
    constructor() {
        this.initObject();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#role-change-form');
        this.$btn = $('#submit-btn');
    }

    initEvent() {
        this.$btn.click(() => {
            $.post(this.$form.attr('action'), this.$form.serialize(), (response) => {
                if (!response.code) {
                    notify('success', '角色设置成功');
                    setTimeout("window.location.reload();",1000);
                } else {
                    notify('danger', '角色设置失败，请联系管理员');
                }
            });
        });
    }
}

new ChangeRole();
