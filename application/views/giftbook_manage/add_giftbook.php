<!-- multiselect -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/multi-select/css/multi-select.css" />
<!-- enhanced select -->
<link rel="stylesheet" href="<?php echo RES; ?>lib/chosen/chosen.css" />
<?php $this->load->view('shared/upload-file-css'); ?>
<?php $this->load->view('shared/alert'); ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <h3 class="heading">新建礼册</h3>
        <form class="form-horizontal" id="fileupload">
            <fieldset>
                <div class="form-group">
                    <label for="a_name" class="control-label col-sm-2">礼册名称</label>
                    <div class="col-sm-5">
                        <input name="a_name" id="a_name" class="input-xlarge form-control" value="" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_price" class="control-label col-sm-2">销售价格</label>
                    <div class="col-sm-2">
                        <input name="a_price" id="a_price" class="input-xlarge form-control" value="" type="text">
                    </div>
                    <label for="a_type" class="control-label col-sm-1">礼册类型</label>
                    <div class="col-sm-2">
                        <select name="a_type" id="a_type" data-placeholder="选择类型..." class="chzn_a form-control">
                            <option value="1" selected="selected">普通卡</option>
                            <option value="2">年卡</option>
                            <option value="3">半年卡</option>
                            <option value="4">季卡</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_theme" class="control-label col-sm-2">礼册主题</label>
                    <div class="col-sm-2">
                        <select name="a_theme" id="a_theme" data-placeholder="选择礼册主题..." class="chzn_a form-control">
                            <?php foreach($theme as $v):?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <label for="a_set" class="control-label col-sm-1">礼册系列</label>
                    <div class="col-sm-2">
                        <select name="a_set" id="a_set" data-placeholder="选择礼册系列..." class="chzn_a form-control">
                            <?php foreach($set as $v):?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_giftids" class="control-label col-sm-2">商品id</label>
                    <div class="col-sm-5">
                        <textarea name="a_giftids" id="a_giftids" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="a_description" class="control-label col-sm-2">礼册描述</label>
                    <div class="col-sm-5">
                        <textarea name="a_description" id="a_description" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileinput" class="control-label col-sm-2">宣传图片</label>
                    <!-- The table listing the files available for upload/download -->
                    <span role="presentation" class="table table-striped">
                        <ul class="files">
                            
                        </ul>
                    </span>
                    <span class="btn btn-success fileinput-button" id="fileupload-bnt" title="添加图片">
                        <i class="glyphicon glyphicon-plus"></i>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload-img" type="file" name="files" multiple="" data-url="/upload_file/img_upload?" onclick="return checkUpload(5);">
                    </span>
                </div>
                <div class="form-group">
                    <label for="a_remark" class="control-label col-sm-2">礼册备注</label>
                    <div class="col-sm-5">
                        <textarea name="a_remark" id="a_remark" cols="10" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <br/>
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-5"  style="margin-left: 30%;">
                        <div class="btn btn-success col-sm-4" id="add-giftbook-ok">完成</div>
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

<?php $this->load->view('shared/upload-file'); ?>

<script>
    var upload_path = "<?php echo UPLOAD; ?>";
    $('#fileupload-img').fileupload({
        formData: {script: true}
        , add: function (e, data) {
            data.submit();
        }
        , done: function (e, data) {
            if(data.result.errCode==0){
                var file_name = data.result.val.name;
                var file_id = data.result.val.id;
                var file_path = upload_path + data.result.val.path;
                var html = '<li class="template-download fade none-list-style in">';
                    html += '<p class="preview">';
                    html += '<a href="'+file_path+ file_name+'" target="_blank" class="img-uploaded" title="'+file_name+'" >';
                    html += '<img src="'+file_path+'thumb_'+file_name+'">';
                    html += '</a></p>';
                    html += '<span class="delete text-center btn-danger img-uploaded" id="'+file_id+'">删除</span>';
                    html += '</li>';
                $("ul.files").append(html);
            }else{
                alertError("#alert-error",'文件上传失败');
            }
        }
    });

</script>

<script>
    $(document).ready(function () {
        $(".chzn_a").chosen({
            allow_single_deselect: true
        });
        //成功提示框设置
        $('#alert-success').modal({
            backdrop: false,
            show:false
        });
        
        $("span.delete").die().live('click',function(){
            $(this).parent().remove();
        })
        
        $("#add-giftbook-ok").die().live('click',function(){
            var flag = true;
            var name = $("#a_name").val();
            var type = $('#a_type').val();
            var price = $("#a_price").val();
            var theme = $("#a_theme").val();
            var set = $("#a_set").val();
            var gift_ids = $("#a_giftids").val();
            var description = $("#a_description").val();
            var remark = $("#a_remark").val();
            var pic_ids = getUploadImg();
            var price_preg = /^([0-9]+[\.]?[0-9]+|\d+)$/;
            if(name=='' || name==undefined){
                flag = flag & false;
                alertError("#alert-error",'礼册名称不能为空！');
                return ;
            }
            if(price=='' || !price_preg.test(price)){
                flag = flag & false;
                alertError("#alert-error",'请填写正确的销售价格！');
                return ;
            }
            if(type==''||type==undefined){
                flag = flag & false;
                alertError("#alert-error",'请选择礼册类型！');
                return ;
            }
            if(theme==''||theme==undefined){
                flag = flag & false;
                alertError("#alert-error",'请选择礼册主题！');
                return ;
            }
            if(set==''||set==undefined){
                flag = flag & false;
                alertError("#alert-error",'请选择礼册系列！');
                return ;
            }
            if(gift_ids==''||gift_ids==undefined){
                flag = flag & false;
                alertError("#alert-error",'请填写商品id！');
                return ;
            }
            if(description==''||description==undefined){
                flag = flag & false;
                alertError("#alert-error",'请填写礼册描述！');
                return ;
            }
            if(pic_ids==''){
                flag = flag & false;
                alertError("#alert-error",'请上传宣传图片！');
                return ;
            }
            if(flag){
                $.post('/giftbook_manage/add_giftbook',
                {
                    name:name,price:price,type:type,theme:theme,
                    set:set,gift_ids:gift_ids,des:description,
                    pic_ids:pic_ids,remark:remark
                },function(ret){
                    var d = $.parseJSON(ret);
                    if(d.errCode==0){
                        alertSuccess("#alert-success",'/giftbook_manage/add_giftbook');
                    }else{
                        alertError("#alert-error",d.msg);
                    }
                });
            }
            
        });
    });
</script>
