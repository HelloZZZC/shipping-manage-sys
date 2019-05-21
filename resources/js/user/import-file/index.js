class UserImportFile
{
    constructor() {
        this.initObject();
        this.initValidator();
        this.initEvent();
    }

    initObject() {
        this.$form = $('#import-form');
        this.$selectFileInput = $('.js-select-file');
        this.$fileInput = $('.js-file');
        this.$showFileInput = $('.js-show-file');
        this.$saveBtn = $('#save-btn');
        this.$progress = $('.progress');
        this.$progressBar = this.$progress.find('.progress-bar');
        this.$formContainer = $('.js-form-container');
        this.$jsFooter = $('.js-footer');
        this.$jsImportMessage = $('.js-import-message');
    }

    initValidator() {
        this.$form.validate({
            ignore: [],
            rules: {
                file: "required"
            },
            messages: {
                file: {
                    required: '请选择一个excel文件'
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
        this.$selectFileInput.on('click', () => {
            this.$fileInput.click();
        });

        this.$fileInput.on('change', () => {
            this.$showFileInput.val(this.$fileInput.val());
            this.$form.valid();
        });

        this.$saveBtn.on('click', () => {
            if (this.$form.valid()) {
                this.$formContainer.hide();
                this.$jsFooter.hide();
                this.$progress.show();

                this.import();
            }
        });
    }

    import() {
        let formData = new FormData(this.$form[0]);
        let importUrl = this.$saveBtn.data('importUrl');

        $.ajax({
            url: importUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (!response.code) {
                    this.$progressBar.css('width', response.data.progress + '%');
                    this.$progressBar.attr('aria-valuenow', response.data.progress);
                    this.$progressBar.addClass('bg-success');
                    this.$jsImportMessage.html(response.data.importMsg);
                    let dismissBtn = `<button type="button" class="btn btn-primary" onClick="window.location.reload();">确定</button>`;
                    this.$jsFooter.html(dismissBtn).show();
                } else {
                    this.showError(response.data.progress)
                }
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    showError(progress) {
        this.$progressBar.css('width', progress + '%');
        this.$progressBar.attr('aria-valuenow', progress);
        this.$progressBar.addClass('bg-danger');
        let dismissBtn = `<button type="button" class="btn btn-primary" onClick="window.location.reload();">确定</button>`;
        this.$jsFooter.html(dismissBtn).show();
    }
}

new UserImportFile();
