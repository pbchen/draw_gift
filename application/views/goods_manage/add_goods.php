<!-- multiselect -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/multi-select/css/multi-select.css" />
<!-- enhanced select -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/chosen/chosen.css" />
<link rel="stylesheet" href="<?php echo RES; ?>lib/jquery-file-upload/css/jquery.fileupload.css">

<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">新建商品</h3>
        <form class="form-horizontal">
            <fieldset>
                <div class="form-group">
                    <label for="g_name" class="control-label col-sm-2">商品名称</label>
                    <div class="col-sm-4">
                        <input name="g_name" id="g_name" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input value="1" name="g_type" checked="checked" type="radio">
                            单品
                        </label>
                        <label class="radio-inline">
                            <input value="2" name="g_type" type="radio">
                            组合商品
                        </label>
                    </div>
                </div>
                <div class="form-group goods-single-own">
                    <label for="g_classify" class="control-label col-sm-2">商品分类</label>
                    <div class="col-sm-2">
                        <select name="g_classify" id="g_classify" data-placeholder="选择商品分类..." class="chzn_a form-control">
                            <option value="DZ">Algeria</option><option value="AO">Angola</option>
                            <option value="BJ">Benin</option><option value="BW">Botswana</option>
                        </select>
                    </div>
                    <label for="g_brand" class="control-label col-sm-1">商品品牌</label>
                    <div class="col-sm-2">
                        <select name="g_brand" id="g_brand" data-placeholder="选择商品品牌..." class="chzn_a form-control">
                            <option value="DZ">Algeria</option><option value="AO">Angola</option>
                            <option value="BJ">Benin</option><option value="BW">Botswana</option>
                        </select>
                    </div>
                    <label for="g_supplier" class="control-label col-sm-1">供应商</label>
                    <div class="col-sm-2">
                        <select name="g_supplier" id="g_supplier" data-placeholder="选择供应商..." class="chzn_a form-control">
                            <option value="DZ">Algeria</option><option value="AO">Angola</option>
                            <option value="BJ">Benin</option><option value="BW">Botswana</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_prize" class="control-label col-sm-2">销售价格</label>
                    <div class="f_success col-sm-3 col-md-3">
                        <div class="input-group">
                            <input name="g_prize" id="g_prize" size="16" class="form-control" type="text">
                            <span class="input-group-addon">￥</span>
                        </div>
                    </div>
                    <label for="g_cost" class="control-label col-sm-1">采购价格</label>
                    <div class="f_success col-sm-3 col-md-3">
                        <div class="input-group">
                            <input name="g_cost" id="g_cost" size="16" class="form-control" type="text">
                            <span class="input-group-addon">￥</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="g_inventory" class="control-label col-sm-2">商品库存</label>
                    <div class="col-sm-3">
                        <input name="g_inventory" id="g_inventory" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <label for="g_unit" class="control-label col-sm-1">商品单位</label>
                    <div class="col-sm-3">
                        <input name="g_unit" id="g_unit" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_deliver" class="control-label col-sm-2">默认快递</label>
                    <div class="col-sm-2">
                        <select name="g_deliver" id="g_deliver" data-placeholder="选择商品快递..." class="chzn_a form-control">
                            <option value="DZ">Algeria</option><option value="AO">Angola</option>
                            <option value="BJ">Benin</option><option value="BW">Botswana</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="g_description" class="control-label col-sm-2">产品描述</label>
                    <div class="col-sm-6">
                        <textarea name="g_description" id="g_description" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileinput" class="control-label col-sm-2">宣传图片</label>
                    
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="files[]" multiple="">
                    </span>
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files"></div>
                </div>
                <div class="form-group">
                    <label for="g_remark" class="control-label col-sm-2">产品备注</label>
                    <div class="col-sm-6">
                        <textarea name="g_remark" id="g_remark" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- multiselect -->
<script src="<?php echo RES; ?>lib/multi-select/js/jquery.multi-select.js"></script>
<script src="<?php echo RES; ?>lib/multi-select/js/jquery.quicksearch.js"></script>
<!-- enhanced select (chosen) -->
<script src="<?php echo RES; ?>lib/chosen/chosen.jquery.min.js"></script>
<!-- autosize textareas -->
<script src="<?php echo RES; ?>js/forms/jquery.autosize.min.js"></script>
<!-- user profile functions -->
<script src="<?php echo RES; ?>js/pages/gebo_user_profile.js"></script>
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>

<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<script>
    $(document).ready(function () {
        $(".chzn_a").chosen({
            allow_single_deselect: true
        });
        //* jQuery.browser.mobile (http://detectmobilebrowser.com/)
        //* jQuery.browser.mobile will be true if the browser is a mobile device
        (function (a) {
            jQuery.browser.mobile = /android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
        })(navigator.userAgent || navigator.vendor || window.opera);
        //replace themeforest iframe
        if (jQuery.browser.mobile) {
            if (top !== self)
                top.location.href = self.location.href;
        }
        'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'http://jquery-file-upload.appspot.com/server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>