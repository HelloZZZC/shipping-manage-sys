import { init } from '../../common/validator-rule';
import { notify } from "../../common/notify";

class MyHomepage
{
    constructor() {
        this.initObject();
        this.initDatePicker();
        this.initValidator();
        this.initUploader();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#my-profile-form');
        this.$saveBtn = $('#save-btn');
        this.$birthdayInput = $('#birthday');
        this.$emailInput = $('#email');
        this.$mobileInput = $('#mobile');
        this.$uploadBtn = $('.js-avatar-uploader');
        this.$fileInput = $('.js-avatar');
        this.$uploadContainer = $('.js-upload-container');
        this.$modal = $('#static-modal');
    }

    initUploader() {
        let url = this.$uploadContainer.data('url');
        this.$uploadContainer.dmUploader({
            url: url,
            multiple: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            allowedTypes: "image/*",
            extFilter: ["jpg", "jpeg", "png", "gif"],
            maxFileSize: 2097152, // 2M
            onUploadError: (id, xhr, status, message) => {
                notify('danger', '上传图片失败');
            },
            onUploadSuccess: (id, data) => {
                let jsonResponse = JSON.stringify(data);
                let response = JSON.parse(jsonResponse);
                if (!response.code) {
                    let gotoUrl = response.data.goto_url;
                    let avatarUrl = response.data.avatar_url;
                    $.get(gotoUrl, {avatar_url: avatarUrl} , (response) => {
                        this.$modal.html(response);
                        this.$modal.modal('show');
                    });
                } else {
                    notify('danger', '服务处理上传图片失败');
                }
            }
        });
    }

    initValidator() {
        init();
        this.$form.validate({
            rules: {
                mobile: {
                    required: true,
                    remote: {
                        url: this.$mobileInput.data('url'),
                        type: 'get',
                        data: { exclude: this.$mobileInput.val() }
                    },
                    mobile: true
                },
                email: {
                    required: true,
                    remote: {
                        url: this.$emailInput.data('url'),
                        type: 'get',
                        data: { exclude: this.$emailInput.val() }
                    },
                    email: true
                },
                age: {
                    digits:true,
                    min: 0,
                    max: 100
                },
                address: {
                    maxlength: 300
                },
                about: {
                    maxlength: 500
                }
            },
            messages: {
                verified_mobile: {
                    required: '请输入手机号',
                    mobile: '请输入正确格式的手机号',
                    remote: '该手机号已被占用，请换一个手机号输入'
                },
                email: {
                    required: '请输入邮箱',
                    email: '请输入正确格式的邮箱',
                    remote: '该邮箱已被占用，请换一个邮箱输入'
                },
                age: {
                    digits: '年龄必须为整数',
                    min: '年龄最小值为0',
                    max: '年龄最大值为100'
                },
                address: {
                    maxlength: '地址的最大长度为300字符（一个汉子一个字符）'
                },
                about: {
                    maxlength: 'About ME的最大长度为500字符（一个汉子一个字符）'
                }
            },
            errorClass: 'invalid-tooltip unset-top',
            errorElement: 'span',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });
    }

    initEvent() {
        this.$saveBtn.click(() => {
            if (this.$form.valid()) {
                $.post(this.$form.attr('action'), this.$form.serialize(), (response) => {
                   if (!response.code) {
                       notify('success', '主页数据保存成功');
                       setTimeout("window.location.reload();",1000);
                   } else {
                       notify('danger', '主页数据保存失败，请联系网站管理员');
                   }
                });
            }
        });

        this.$uploadBtn.click(() => {
            this.$fileInput.click();
        });
    }

    initDatePicker() {
        this.$birthdayInput.datepicker({
            format: 'mm-dd',
            autoclose: true,
            maxViewMode: 'months',
            startView: 'months'
        });
    }
}

new MyHomepage();
