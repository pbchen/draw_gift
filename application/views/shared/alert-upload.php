<!---------数据导入弹层---------->
<div class="modal fade" id="load-classify-modal">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-max-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">数据导入</h3>
            </div>
            <div class="modal-body">
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-8" style="margin-left: 30%;">
                        <div class="btn btn-success fileinput-button col-sm-4">上传数据文件
                            <input id="uploadButton" type="file" name="files" multiple="" data-url="/upload_file/file_upload?" data-sequential-uploads="true">
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin: 40px auto;">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$('#uploadButton').fileupload({
            formData:{script: true,tid:'id'}
            ,add: function(e, data) {
                data.url = '/upload_file/file_upload?'+$(this).attr('params');
                data.submit();
            }
            , done: function(e, data) {
                console.log(data);
             }
         });
    
</script>
