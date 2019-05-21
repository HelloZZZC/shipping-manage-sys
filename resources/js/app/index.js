class App {
    constructor() {
        this.initObject();
        this.initEvent();
    }

    initObject() {
        this.$logout = $('.js-logout');
        this.$form = $('.js-logout-form');
    }

    initEvent() {
        this.$logout.click(() => {
            this.$form.submit();
        });
    }
}

new App();
