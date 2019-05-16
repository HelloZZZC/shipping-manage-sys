class ImportFile
{
    constructor() {
        this.initObject();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#import-form');
        this.$selectFileInput = $('.js-select-file');
        this.$fileInput = $('.js-file');
        this.$showFileInput = $('.js-show-file');
        this.$saveBtn = $('#save-btn');
    }

    initEvent() {
        this.$selectFileInput.on('click', () => {
            this.$fileInput.click();
        });

        this.$fileInput.on('change', () => {
            this.$showFileInput.val(this.$fileInput.val());
        });

        this.$saveBtn.on('click', () => {

        });
    }
}

new ImportFile();
