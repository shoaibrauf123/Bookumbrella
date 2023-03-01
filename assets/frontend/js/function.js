/* profile pic upload*/

$(document).ready(function () {
    $("#profile_picture").uploadFile({
        url: base_url + "upload_user_pic",
        multiple: false,
        allowedTypes: "png,gif,jpg,jpeg",
        autoSubmit: true,
        fileName: "profile_pic",
        maxFileCount: 100,
        showStatusAfterSuccess: false,
        dragDrop: false,
        dragDropStr: "<span><b>drop image here</b></span>",
        abortStr: "Abort",
        cancelStr: "Cancel",
        showCancel: true,
        showAbort: true,
        doneStr: "Success",
        multiDragErrorStr: "Only one file allowed",
        extErrorStr: "File type not allowed. <br> Allowed Types: ",
        uploadErrorStr: "An error occurred, try later.",
        onLoad: function (obj) {
            $('#pic_form div.ajax-upload-dragdrop').css('width', 'auto');
        },
        onSubmit: function (files) {
            $('#pic_form').parent().find('img').css('opacity', '0.5');

            var baseUrl = window.location.protocol + "//" + window.location.host + "/vested/";
            var loadingGifUrl = base_url + "assets/frontend/img/loading.gif";
            var loadingHtml = "<img src='" + loadingGifUrl + "' width='25'>";
            $('#pic_form div.ajax-file-upload-statusbar').css('width', '100%');
            $('#pic_form div.ajax-file-upload-statusbar').html(loadingHtml);
            $('#pic_form div.ajax-file-upload-progress').hide();
        },

        onSuccess: function (files, data, xhr) {
            var obj = jQuery.parseJSON(data);
            $('#pic_form').parent().find('img').css('opacity', '1');
            if (obj.success == 'ok') {
                $("#upload_pic_status").html(obj.message);
                $('#profile_img').attr("src", base_url + 'uploads/img_gallery/user_images/' + obj.user_profile_pic);

                setTimeout(function () {
                    $("#upload_pic_status").fadeOut("medium").html();
                }, 1000);
            }
            else {
                $("#upload_pic_status").html(obj.message);
            }
        },

        onError: function (files, status, errMsg) {
            $("#upload_pic_status").html("<br/>Error for: " + JSON.stringify(files));
        }

    });
});

	

	

	