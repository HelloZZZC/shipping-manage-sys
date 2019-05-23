export function init() {
    jQuery.validator.addMethod('mobile', function(value, element) {
        let reg = /^1\d{10}$/;
        return this.optional(element) || reg.test(value);
    } , '请输入正确的手机号格式');

    jQuery.validator.addMethod('nickname', function (value, element) {
        let reg = /^[a-zA-Z0-9]+$/i;
        return this.optional(element) || reg.test(value);
    }, '账号必须是英文字母、数字组成');
}
