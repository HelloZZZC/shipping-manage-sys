class Import
{
    constructor() {
        this.initObject();
        this.initEvent();
    }

    initObject() {
        this.$btn = $('#import-btn');
        this.$modal = $('#modal');
    }

    initEvent() {
        let url = this.$btn.data('url');
        this.$btn.click(() => {
            $.get(url, (response) => {
                this.$modal.modal({
                    backdrop: 'static'
                });
                this.$modal.html(response);
                this.$modal.modal('show');
            });
        });
    }
}

new Import();
