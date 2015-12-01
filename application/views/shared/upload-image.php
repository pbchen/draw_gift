<script>
    image_server = "<?php echo IMAGE_SERVER;?>";
</script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-upload fade none-list-style" style="float:left;">
    <p class="preview"></p>
    {% if (!i && !o.options.autoUpload) { %}
    <span class="start text-center btn-primary" disabled>上传</span>
    {% } %}
    {% if (!i) { %}
    <span class="cancel text-center btn-warning">撤销</span>
    {% } %}
    </li>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-download fade none-list-style">

    <p  class="preview">
    {% if (file.thumbnailUrl) { %}
    <a href="{%=file.url%}" class="img-uploaded" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
        <img src="{%=file.thumbnailUrl%}">
    </a>
    {% } %}
    </p>

    {% if (file.error) { %}
    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
    {% } %}

    {% if (file.deleteUrl) { %}
    <span class="delete text-center btn-danger">
    删除
    </span>
    {% } else { %}
    <span class="cancel text-center btn-warning">
    撤销
    </span>
    {% } %}

    </li>
    {% } %}
</script>
<!---------------------------------加载图片使用------------------------->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/tmpl.min.js"></script>
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/Gallery/js/jquery.blueimp-gallery.min.js">
</script>
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
<!-- The File Upload user interface plugin -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?php echo RES; ?>lib/jquery-file-upload/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<!---------------------------------加载图片使用结束------------------------->
<script>
function checkUpload(num){
    if( num !== undefined ){
        MaxNum = num;
    }
    var img_li = $("li.none-list-style");
    if(img_li.length>=MaxNum){
        return false;
    }else{
        return true;
    }
}
/**
 * 获取上传图片名称
 * @returns {String}
 */
function getUploadImg(){
    var img_uploaded = $("a.img-uploaded");
    var img_name_str = '';
    for(var i=0;i<img_uploaded.length;i++){
        img_name_str += img_uploaded[i].title + ',';
    }
    return img_name_str;
}

</script>
