import {notify} from "../common/notify";

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
        this.$lockUserBtn = $('.js-lock-user');
        this.$unlockUserBtn = $('.js-unlock-user');
        this.$changePasswordBtn = $('.js-change-password');
        this.$changeRoleBtn = $('.js-change-role');
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

        this.$changePasswordBtn.click((event) => {
            let url = $(event.currentTarget).data('url');
            $.get(url, (response) => {
                this.$modal.html(response);
                this.$modal.modal('show');
            });
        });

        this.$changeRoleBtn.click((event) => {
            let url = $(event.currentTarget).data('url');
            $.get(url, (response) => {
                this.$modal.html(response);
                this.$modal.modal('show');
            });
        });

        this.$lockUserBtn.click((event) => {
            if (!confirm('确定要将该用户设置成离职吗?')) {
                return false;
            }

            let url = $(event.currentTarget).data('url');
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                contentType: false,
                processData: false,
                success: (response) => {
                    if (!response.code) {
                        notify('success', '设置用户离职成功');
                        setTimeout("window.location.reload();",1000);
                    } else {
                        notify('danger', '操作执行失败，请联系管理员');
                    }
                },
                error: (response) => {
                    console.log(response);
                }
            });
        });

        this.$unlockUserBtn.click((event) => {
            if (!confirm('确定要将该用户设置成在职吗?')) {
                return false;
            }

            let url = $(event.currentTarget).data('url');
            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'POST',
                contentType: false,
                processData: false,
                success: (response) => {
                    if (!response.code) {
                        notify('success', '设置用户在职成功');
                        setTimeout("window.location.reload();",1000);
                    } else {
                        notify('danger', '操作执行失败，请联系管理员');
                    }
                },
                error: (response) => {
                    console.log(response);
                }
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
