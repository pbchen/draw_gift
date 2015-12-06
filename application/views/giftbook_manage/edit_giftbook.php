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
                    <label for="e_id" class="control-label col-sm-2">礼册id</label>
                    <div class="col-sm-5">
                        <span class="input-xlarge form-control"><?php echo $giftbook['id'] ?></span>
                        <input name="e_id" id="e_id" type="hidden" value="<?php echo $giftbook['id'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="e_name" class="control-label col-sm-2">礼册名称</label>
                    <div class="col-sm-5">
                        <input name="e_name" id="e_name" class="input-xlarge form-control" value="<?php echo $giftbook['name'] ?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="e_price" class="control-label col-sm-2">销售价格</label>
                    <div class="col-sm-2">
                        <input name="e_price" id="e_price" class="input-xlarge form-control" value="<?php echo $giftbook['sale_price'] ?>" type="text">
                    </div>
                    <label for="e_type" class="control-label col-sm-1">礼册类型</label>
                    <div class="col-sm-2">
                        <select name="e_type" id="e_type" data-placeholder="选择类型..." class="chzn_a form-control">
                            <option value="1" <?php echo $giftbook['type_id']==1 ? 'selected' : '' ?>>普通卡</option>
                            <option value="2" <?php echo $giftbook['type_id']==2 ? 'selected' : '' ?>>年卡</option>
                            <option value="3" <?php echo $giftbook['type_id']==3 ? 'selected' : '' ?>>半年卡</option>
                            <option value="4" <?php echo $giftbook['type_id']==4 ? 'selected' : '' ?>>季卡</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="e_theme" class="control-label col-sm-2">礼册主题</label>
                    <div class="col-sm-2">
                        <select name="e_theme" id="e_theme" data-placeholder="选择礼册主题..." class="chzn_a form-control">
                            <?php foreach($theme as $v):?>
                            <option value="<?php echo $v['id']?>" <?php echo $v['id']==$giftbook['theme_id'] ? 'selected' : '' ?>><?php echo $v['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <label for="e_set" class="control-label col-sm-1">礼册系列</label>
                    <div class="col-sm-2">
                        <select name="e_set" id="e_set" data-placeholder="选择礼册系列..." class="chzn_a form-control">
                            <?php foreach($set as $v):?>
                            <option value="<?php echo $v['id']?>" <?php echo $v['id']==$giftbook['set_id'] ? 'selected' : '' ?>><?php echo $v['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="e_giftids" class="control-label col-sm-2">商品id</label>
                    <div class="col-sm-5">
                        <textarea name="e_giftids" id="e_giftids" cols="10" rows="3" class="form-control"><?php echo $giftbook['group_ids'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="e_description" class="control-label col-sm-2">礼册描述</label>
                    <div class="col-sm-5">
                        <textarea name="e_description" id="e_description" cols="10" rows="3" class="form-control"><?php echo $giftbook['describe'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileinput" class="control-label col-sm-2">宣传图片</label>
                    <!-- The table listing the files available for upload/download -->
                    <span role="presentation" class="table table-striped">
                        <ul class="files">
                            <?php foreach ($giftbook['pic_id'] as $img): ?>
                                <li class="template-download fade none-list-style in">
                                    <p class="preview">
                                        <a href="<?php echo UPLOAD.$img['path'].$img['name']; ?>" class="img-uploaded" title="<?php echo $img['name']; ?>">
                                            <img src="<?php echo UPLOAD.$img['path'].'thumb_'.$img['name']; ?>">
                                        </a>
                                    </p>
                                    <span class="delete text-center btn-danger img-uploaded" id="<?php echo $img['id'];?>">
                                        删除
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </span>
                    <span class="btn btn-success fileinput-button" id="fileupload-bnt" title="添加图片">
                        <i class="glyphicon glyphicon-plus"></i>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload-img" type="file" name="files" multiple="" data-url="/upload_file/img_upload?" onclick="return checkUpload(1);">
                    </span>
                </div>
                <div class="form-group">
                    <label for="e_remark" class="control-label col-sm-2">礼册备注</label>
                    <div class="col-sm-5">
                        <textarea name="e_remark" id="e_remark" cols="10" rows="3" class="form-control"><?php echo $giftbook['remark'] ?></textarea>
                    </div>
                </div>
                <br/>
                <div class="form-group" style="text-align: center;">
                    <div class="col-sm-8"  style="margin-left: 30%;">
                        <div class="btn btn-success col-sm-4" id="update-giftbook-ok">完成</div>
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
        
        $("#update-giftbook-ok").die().live('click',function(){
            var flag = true;
            var id = $("#e_id").val();
            var name = $("#e_name").val();
            var type = $('#e_type').val();
            var price = $("#e_price").val();
            var theme = $("#e_theme").val();
            var set = $("#e_set").val();
            var gift_ids = $("#e_giftids").val();
            var description = $("#e_description").val();
            var remark = $("#e_remark").val();
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
                $.post('/giftbook_manage/update_giftbook_info',
                {
                    name:name,price:price,type:type,theme:theme,
                    set:set,gift_ids:gift_ids,desciption:description,
                    pic_id:pic_ids,remark:remark,id:id
                },function(ret){
                    var d = $.parseJSON(ret);
                    if(d.errCode==0){
                        alertSuccess("#alert-success",'/giftbook_manage/giftbook_list');
                    }else{
                        alertError("#alert-error",d.msg);
                    }
                });
            }
            
        });
    });
</script>
