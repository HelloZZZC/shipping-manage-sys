class User {
    constructor() {
        this.initObject();
        this.initEvent();
        this.fixTableColumn();
    }

    initObject() {
        this.$table = $('.table');
        this.$createBtn = $('#create-user-btn');
        this.$importBtn = $('#import-user-btn');
        this.$modal = $('#modal');
        this.$staticModal = $('#static-modal');
    }

    initEvent() {
        let url = this.$createBtn.data('url');
        this.$createBtn.click(() => {
            $.get(url, (response) => {
                this.$modal.html(response);
                this.$modal.modal('show');
            });
        });

        let importUrl = this.$importBtn.data('url');
        this.$importBtn.click(() => {
            $.get(importUrl, (response) => {
                this.$staticModal.html(response);
                this.$staticModal.modal('show');
            });
        });
    }

    /**
     * 将第一列固定在最左侧仅在手机下显示
     */
    fixTableColumn() {
        let $fixedColumn = this.$table.clone().insertBefore(this.$table).addClass('fixed-column');
        $fixedColumn.find('th:not(:first-child),td:not(:first-child)').remove();
        $fixedColumn.find('tr').each((i) => {
            $(this).height(this.$table.find('tr:eq(' + i + ')').height());
        });
    }
}

new User();
