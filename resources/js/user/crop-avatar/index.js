import {notify} from "../../common/notify";

class CropAvatar {
    constructor() {
        this.initObject();
        this.initCropper();
        this.initEvent();
    }

    initObject() {
        this.$img = $('#crop_avatar');
        this.$cropBtn = $('#crop-btn');
        this.$form = $('#crop-form');
    }

    initCropper() {
        this.$img.cropper({
            aspectRatio: 1,
            zoomable: false,
            zoomOnTouch: false,
            zoomOnWheel: false,
        });
        this.$cropper = this.$img.data('cropper');
    }

    initEvent() {
        this.$cropBtn.click(() => {
            this.$cropper.getCroppedCanvas().toBlob((blob) => {
                const formData = new FormData(this.$form);
                formData.append('crop_avatar', blob);
                formData.append('_token', this.$form.find('[name = "_token"]').val());
                formData.append('tmp_avatar', this.$form.find('[name = "tmp_avatar"]').val());
                $.ajax({
                    url: this.$form.attr('action'),
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (!response.code) {
                            notify('success', '头像保存成功');
                            setTimeout("window.location.reload();",1000);
                        } else {
                            notify('danger', '头像保存失败');
                            setTimeout("window.location.reload();",1000);
                        }
                    },
                    error: (response) => {
                        console.log(response);
                    }
                });
            });
        });
    }
}

new CropAvatar();
